<?php
namespace Back\Controller;
use Think\Db;
use OT\Database; 
use OT\MySQLReback;

/**
 * 数据库备份还原控制器
 */
class DatabaseController extends BaseController{
    /**
     * 进入备份页面
     */
    function exportPage(){
        
       $this->index('export');
    }
    /**
     * 进入还原页面
     */
    function importPage(){
        
        $this->index('import');
    }
    /**
     * 数据库备份设置页
     */
    /* function setexport(){
        $dbObj = M('db_backupsset');
        $this->assign('dbvo',$dbObj->find());
        $this->display("Database:export");
    } */
    
    /**
     * 数据库备份设置
     */
   function setexportsave(){
      // $dbpart = I('dbpart')==""||I('dbpart')==null?"":I('dbpart');
       $dbcompress = I('dbcompress')==""||I('dbcompress')==null?"":I('dbcompress');
       $dblevel = I('dblevel')==""||I('dblevel')==null?"":I('dblevel');
       $id = I('id');
       $flag = false;
       if($dbcompress!=""&&$dblevel!=""){
           $dbObj = M('db_backupsset');
           $dbVo['db_part'] = 1;//分卷大小 20M
           $dbVo['db_compress'] = $dbcompress;//0:不压缩 1:启用压缩
           $dbVo['db_level'] = $dblevel;  //压缩级别, 1:普通 4:一般  9:最高
           $dbVo['db_setman'] = 'admin';//session('loginAdmin');
           $dbVo['db_settime'] = date('Y-m-d H:i:s',time());
           $map['id'] = array("eq",$id);
           $ret = $dbObj->where($map)->save($dbVo);
           print_log("设置数据备份参数:".$ret);
           if($ret){
               $data['flag'] = true;
               $data['msg'] = "设置成功!";
               $this->ajaxReturn($data);
           }else{
               $data['msg'] = "设置失败!";
               $this->ajaxReturn($data);
           }
       }else{
           $data['msg'] = "设置失败!";
           $this->ajaxReturn($data);
       }
   }

    /**
     * 数据库备份/还原列表
     * @param  String $type import-还原，export-备份
     */
    public function index($type = null){
        //$dataleft = $this->setleftmenus();
        /* $this->assign('adm_acc',$dataleft['adm_acc']);
        $this->assign('leftmenus',$dataleft['leftmenus']); */
        switch ($type) {
            /* 数据还原 */
            case 'import':
            	//判断目录是否存在
            	is_writeable(C("DB_PATH_DP") || mkdir('./'.C("DB_PATH_NAME").'',0777,true));
            	//print_log("判断目录是否存在:".$config['path']);
                //列出备份文件列表
                $path = realpath(C('DB_PATH'));
                $flag = \FilesystemIterator::KEY_AS_FILENAME;
                $glob = new \FilesystemIterator($path,  $flag);
                $list = array();
                foreach ($glob as $name => $file) {
                    if(preg_match('/^\d{8,8}-\d{6,6}-\d+\.sql(?:\.gz)?$/', $name)){
                        $name = sscanf($name, '%4s%2s%2s-%2s%2s%2s-%d');
                        $date = "{$name[0]}-{$name[1]}-{$name[2]}";
                        $time = "{$name[3]}:{$name[4]}:{$name[5]}";
                        $part = $name[6];

                        if(isset($list["{$date} {$time}"])){
                            $info = $list["{$date} {$time}"];
                            $info['part'] = max($info['part'], $part);
                            $info['size'] = $info['size'] + $file->getSize();
                        } else {
                            $info['part'] = $part;
                            $info['size'] = $file->getSize();
                        }
                        $extension        = strtoupper(pathinfo($file->getFilename(), PATHINFO_EXTENSION));
                        $info['compress'] = ($extension === 'SQL') ? '-' : $extension;
                        $info['time']     = strtotime("{$date} {$time}");

                        $list["{$date} {$time}"] = $info;
                    }
                }
                $title = '数据还原';
                break;

            /* 数据备份 */
            case 'export':
                $Db    = Db::getInstance();
                $list  = $Db->query('SHOW TABLE STATUS');
                $list  = array_map('array_change_key_case', $list);
                $title = '数据备份';
                $dblObj = M('db_backups_log');
                $sizet = count($list);
                if($sizet>0){
                    for ($i = 0; $i < $sizet; $i++) {
                        $dblMap['db_tab_name'] = array("eq",$list[$i]['name']);
                        $dblVo = $dblObj->where($dblMap)->find();
                        if($dblVo){
                            $list[$i]['status'] = $dblVo['backups_status'];
                            $list[$i]['backups_date'] = $dblVo['db_backups_date'];
                        }else{
                            $list[$i]['status'] = "N";
                        }
                    }
                }
                break;

            default:
                $this->error('参数错误！');
        }
        
        //渲染模板
        $this->assign('meta_title', $title);
        $this->assign('list', $list);
        $this->assign('count', count($list));
        $this->display($type);
    }

    /**
     * 优化表
     * @param  String $tables 表名
     */
    public function optimize($tables = null){
        $mark = I("mark");
        if($mark!='B'){
            if($tables) {
                $Db   = Db::getInstance();
                $list = $Db->query("OPTIMIZE TABLE `{$tables}`");
                if($list){
                    $this->success("数据表'{$tables}'优化完成！",'',5);
                } else {
                    $this->error("数据表'{$tables}'优化出错请重试！");
                }
                
            } else {
                $this->error("请指定要优化的表！");
            }
        }else{
            $retData['flag'] = false;
            if($tables) {
                $Db   = Db::getInstance();
                if(strpos($tables,';')){
                    print_log("进入带有数组的数据库表优化：");
                    $tables = explode(';', $tables);
                    $sizetab = count($tables);
                    for ($i = 0; $i < $sizetab; $i++) {
                        $list = $Db->query("OPTIMIZE TABLE `".$tables[$i]."`");
                    }
                    if($list){
                        $retData['msg'] = "数据表优化完成";
                        $retData['flag'] = true;
                        $this->ajaxReturn($retData);
                    } else {
                        $retData['msg'] = "数据表优化出错请重试！";
                        $this->ajaxReturn($retData);
                    }
                } else {
                    $list = $Db->query("OPTIMIZE TABLE `{$tables}`");
                    if($list){
                        $retData['msg'] = "数据表'{$tables}'优化完成！";
                        $retData['flag'] = true;
                        $this->ajaxReturn($retData);
                    } else {
                        $retData['msg'] = "数据表'{$tables}'优化出错请重试";
                        $this->ajaxReturn($retData);
                    }
                }
            } else {
                $retData['msg'] = "请指定要优化的表！";
                $this->ajaxReturn($retData);
            }
        }
    }

    /**
     * 修复表
     * @param  String $tables 表名
     */
    public function repair($tables = null){
        $mark = I("mark");
        $Db   = Db::getInstance();
        $retData['flag'] = false;
        if($tables) {
            if($mark!='C'){
                $list = $Db->query("REPAIR TABLE `{$tables}`");
                if($list){
                    $this->success("数据表'{$tables}'修复完成！");
                } else {
                    $this->error("数据表'{$tables}'修复出错请重试！");
                }
            }else{
                if(strpos($tables,';')){
                    $tables = explode(';', $tables);
                    $sizetab = count($tables);
                    for ($i = 0; $i < $sizetab; $i++) {
                        $list = $Db->query("OPTIMIZE TABLE `".$tables[$i]."`");
                    }
                    if($list){
                        $retData['msg'] = "数据表修复完成！";
                        $retData['flag'] = true;
                        $this->ajaxReturn($retData);
                    } else {
                        $retData['msg'] = "数据表修复出错请重试！";
                        $this->ajaxReturn($retData);
                    }
                } else {
                    $list = $Db->query("REPAIR TABLE `{$tables}`");
                    if($list){
                        $retData['msg'] = "数据表'{$tables}'修复完成！";
                        $retData['flag'] = true;
                        $this->ajaxReturn($retData);
                    } else {
                        $retData['msg'] = "数据表'{$tables}'修复出错请重试！";
                        $this->ajaxReturn($retData);
                    }
                }
            }
        } else {
            if($mark!='C'){
                $this->error("请指定要修复的表！");
            }else{
                $retData['msg'] = "请指定要修复的表！";
                $this->ajaxReturn($retData);
            }
        }
    }

    /**
     * 删除备份文件
     * @param  Integer $time 备份时间
     */
    public function del($time = 0){
        if($time){
            $name  = date('Ymd-His', $time) . '-*.sql*';
            $path  = realpath(C('DB_PATH')). DIRECTORY_SEPARATOR . $name;
            array_map("unlink", glob($path));
            if(count(glob($path))){
                $this->error('备份文件删除失败，请检查权限！');
            } else {
                $this->success('备份文件删除成功！',U('Back/Database/importPage/time/'.time()),3);
            }
        } else {
            $this->error('参数错误！');
        }
    }
    /**
     * 数据库备份启用
     */
    public function export(){
        $tables = I('tables')==""||I('tables')==null?null:explode(';',I('tables'));
        print_log("---------------------".json_encode($tables));
        import("Common.Org.MySQLReback");
        $dbObj = M('db_backupsset');
        $dbVo = $dbObj->find();
        $config = array(
            'host' => C('DB_HOST'),
            'port' => C('DB_PORT'),
            'userName' => C('DB_USER'),
            'userPassword' => C('DB_PWD'),
            'dbprefix' => C('DB_PREFIX'),
            'charset' => 'UTF8',
            'path' => "DBbackups/",
            'isCompress' => $dbVo['db_compress'], //是否开启gzip压缩
            'isDownload' => 0
        );
        $mr = new MySQLReback($config);
        $mr->setDBName(C('DB_NAME'));
        $retss = $mr->backup($tables);
        print_log("数据备份后返回:".json_encode($retss));
        if($retss['flag']){
            $arrTab = $retss['tables'];
            $sizes = count($arrTab);
            $dblogObj = M('db_backups_log');
            $time = time();
            $creatTime = date("Y-m-d H:i:s",$time);
            for ($i = 0; $i < $sizes; $i++) {
                $map['db_tab_name'] = array("eq",$arrTab[$i]);
                $dbDate['db_tab_name'] = $arrTab[$i];
                $dbDate['db_backups_date'] = $creatTime;
                $dbDate['operate_man'] = session('loginAdmin');
                $dbDate['backups_status'] = 'Y';
                print_log("是否备份保存:".json_encode($dbDate));
                $vo = $dblogObj->where($map)->find();
                print_log("查询是否已经备份过:".$vo);
                if($vo){
                    $rets = $dblogObj->where($map)->save($dbDate);
                }else{
                    $rets = $dblogObj->add($dbDate);
                }
            }
        }
        $this->ajaxReturn($retss);
    }
    
    /**
     * 备份数据库  备用
     * @param  String  $tables 表名
     * @param  Integer $id     表ID
     * @param  Integer $start  起始行数
     */
    public function export_S($tables = null, $id = null, $start = null){
        $dbObj = M('db_backupsset');
        $dbVo = $dbObj->find();
        $tables = I('tables')==""||I('tables')==null?"":explode(';',I('tables'));
        $retData['flag'] = false;
        if(IS_POST && !empty($tables) && is_array($tables)){ //初始化
            //读取备份配置
            $time=time();
            $catalogue = date("Y-m-d",$time);
            $paths = C('DB_PATH');
            if(!is_dir($paths)){
                mkdir(iconv("UTF-8", "GBK", $paths),0777,true);
            }
            $config = array(
                'path'     => $paths,  //路径
                'part'     => $dbVo['db_part'],  //分卷大小 20M
                'compress' => $dbVo['db_compress'],  //0:不压缩 1:启用压缩
                'level'    => $dbVo['db_level'] //压缩级别, 1:普通 4:一般  9:最高
            );
            print_log('数据库备份路径:'.json_encode($config));
            //检查是否有正在执行的任务
            $lock = "{$config['path']}backup.lock";
            if(is_file($lock)){
                $retData['msg'] = "检测到有一个备份任务正在执行，请稍后再试！";
                $this->ajaxReturn($retData);
            } else {
                //创建锁文件
                file_put_contents($lock, NOW_TIME);
            }

            //检查备份目录是否可写 创建备份目录
            is_writeable($config['path']) || mkdir('./'.C("DB_PATH_NAME").'',0777,true);
            session('backup_config', $config);

            //生成备份文件信息
            $file = array(
                'name' => date('Ymd-His', NOW_TIME),
                'part' => 1,
            );
            $Database = new Database($file, $config);
            //$flag = $Database->create();
            $tab=array();
           // if(false !== $flag){
                $sizes = count($tables);
                $dblogObj = M('db_backups_log');
                $creatTime = date("Y-m-d H:i:s",$time);
                for ($i = 0; $i < $sizes; $i++) {
                    print_log("数据库表名:".$tables[$i]);
                    $start  = $Database->backup($tables[$i], 0);
                    if(false === $start){
                        $tab[] = array('tabName' => $tables[$i], 'status' => false);
                        $dbDate['db_tab_name'] = $tables[$i];
                        $dbDate['db_backups_date'] = $creatTime;
                        $dbDate['operate_man'] = session('loginAdmin');
                        $dbDate['backups_status'] = 'N';
                    }else{
                        $tab[] = array('tabName' => $tables[$i], 'status' => true);
                        $dbDate['db_tab_name'] = $tables[$i];
                        $dbDate['db_backups_date'] = $creatTime;
                        $dbDate['operate_man'] = session('loginAdmin');
                        $dbDate['backups_status'] = 'Y';
                    }
                    $map['db_tab_name'] = array("eq",$tables[$i]);
                    if($dblogObj->where($map)->find()){
                        $rets = $dblogObj->where($map)->save($dbDate);
                    }else{
                        $rets = $dblogObj->add($dbDate);
                    }
                    print_log("备份记录保存:".$rets);
                }
                unlink($paths. '/backup.lock');
                $retData['msg'] = "备份完毕!";
                $retData['flag'] = true;
                $retData['tab'] = $tab;
                $this->ajaxReturn($retData);
            }else{
                $retData['msg'] = "备份失败!";
                $this->ajaxReturn($retData);
            }
    }

    /**
     * 还原数据库
     */
    public function import($time = 0){
        import("Common.Org.MySQLReback");
        $dbObj = M('db_backupsset');
        $dbVo = $dbObj->find();
        if(is_numeric($time)){ //初始化
            //获取备份文件信息
            $name  = date('Ymd-His', $time) . '-*.sql*';
            $path  = realpath(C('DB_PATH')). DIRECTORY_SEPARATOR . $name;
            $files = glob($path);
            $config = array(
                'host' => C('DB_HOST'),
                'port' => C('DB_PORT'),
                'userName' => C('DB_USER'),
                'userPassword' => C('DB_PWD'),
                'dbprefix' => C('DB_PREFIX'),
                'charset' => 'UTF8',
                'path' => "DBbackups/",
                'isCompress' => $dbVo['db_compress'], //是否开启gzip压缩
                'isDownload' => 0
            );
            
            $size = count($files);
            $mr = new MySQLReback($config);
            $mr->setDBName(C('DB_NAME'));
            for ($i = 0; $i < $size; $i++) {
                $str = explode('\\',$files[$i]);
                $str = end($str);
                print_log("读取文件:".$str);
                $mr->recover($str);
            }
            $this->success('数据库还原成功！');
            
        } else {
            $this->error('参数错误！');
        }
    }

}
