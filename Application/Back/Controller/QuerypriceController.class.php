<?php
namespace Back\Controller;

header("Content-type:text/html;charset=utf-8");

class QuerypriceController extends BaseController{
	//查价
	public function index(){
        /*$zhuan = M('zhuan')->select();
        foreach($zhuan as $k=>$v){
            $arr = array(
                'start_prov' => $v['start_prov'],
                'start_city' => $v['start_city'],
                'end_prov' => $v['end_prov'],
                'end_city' => $v['end_city'],
                'cb_price' => $v['zhuan_price'],
                'zz_price' => '0',
                'zhi_mark' => $v['zhuan_mark'],
                'zhi_man' => $v['zhuan_man'],
            );
            $aa = M('zhi')->add($arr);
            if(!$aa){
                echo "<pre/>";
                print_r($arr);
            }
        }die;*/
        $area = M('area_price')->where('area_pid = 0')->order('area_name asc')->select();
	    $this->assign('area',$area);
	    $this->display();
	}

	public function getcity(){
        $id = I('id');
        $str = '';
        $area = M('area_price')->where('area_pid = '.$id)->order('area_name asc')->select();
        foreach ($area as $k=>$v){
            $str .= '<option value="'.$v['area_id'].'">'.$v['area_name'].'</option>';
        }
        echo $str;
    }

    public function getprice(){
        //查询地址表，并将id作为key
        $area_price = M('area_price')->select();
        $area = $zhi = array();
        foreach($area_price as $k=>$v){
            $area[$v['area_id']] = $v['area_name'];
        }

	    //查询价格表并将key设置为：出发地省会/出发地城市
        $arr = M('zhi')->select();
	    foreach($arr as $k=>$v){
            $zhi[$v['start_prov'].'/'.$v['start_city']][] = $v;
        }
        //接收值
        $start = I('start');
        $start_city = I('start_city');
        $end = I('end');
        $end_city = I('end_city');
        $z_k = $start.'/'.$start_city;

        //查询目的地符合条件的信息
        $map['end_prov'] = array('eq',$end);
        $map['end_city'] = array('eq',$end_city);
        $e_arr = M('zhi')->where($map)->select();
        $end_arr = $end_content = array();
        foreach($e_arr as $k=>$v){
            $end_arr[$v['start_prov'].'/'.$v['start_city']] = $v['start_prov'].'/'.$v['start_city'];
            $end_content[$v['start_prov'].'/'.$v['start_city']] =$v;
        }

        if(empty($end_arr)){
            echo '系统暂无目的地为此地的价格';die;
        }

        if(!isset($zhi[$z_k])){
            echo '系统暂无出发地为此地的价格';die;
        }

        $return = array();
        //循环出发地符合查询条件的价格信息
        foreach ($zhi[$z_k] as $k=>$v) {
            if ($v['end_prov'] == $end && $v['end_city'] == $end_city) {
                $str = $area[$v['start_prov']].'/'.$area[$v['start_city']].'——'.$area[$v['end_prov']].'/'.$area[$v['end_city']];
                $return = "<br><br>直发：".$str.'；成本->'.$v['cb_price'].'；最终价格->'.$v['zz_price'].'；备注->'.$v['zhi_mark'];
                echo $return;die;
            }else{
                $z_k1 = $v['end_prov'].'/'.$v['end_city'];
                foreach ($zhi[$z_k1] as $key=>$value) {
                    if ($value['end_prov'] == $end && $value['end_city'] == $end_city) {
                        $arr = array($v,$value);
                        $re = $this->line_content($arr,$area);
                        $return[$re['0']] = $re['1'];
                    }else{
                        $z_k2 = $value['end_prov'].'/'.$value['end_city'];
                        foreach ($zhi[$z_k2] as $key2=>$value2) {
                            if ($value2['end_prov'] == $end && $value2['end_city'] == $end_city) {
                                $arr = array($v,$value,$value2);
                                $re = $this->line_content($arr,$area);
                                $return[$re['0']] = $re['1'];
                            }/*else{
                                $z_k3 = $value2['end_prov'].'/'.$value2['end_city'];
                                if(in_array($z_k3,$end_arr)){
                                    $arr = array($v,$value,$value2,$end_content[$z_k3]);
                                    $re = $this->line_content($arr,$area);
                                    $return[$re['0']] = $re['1'];
                                }
                            }*/
                        }
                    }
                }
            }
        }
        ksort($return);
        if(empty($return)){
            echo '';
        }else{
            echo reset($return);
        }
    }

    public function line_content($arr,$area){
	    $str = $area[$arr['0']['start_prov']].'/'.$area[$arr['0']['start_city']];
        $sum = 0;
	    foreach($arr as $k=>$v){
            $str .= '——'.$area[$v['end_prov']].'/'.$area[$v['end_city']];
            $line = $area[$v['start_prov']].'/'.$area[$v['start_city']].'——'.$area[$v['end_prov']].'/'.$area[$v['end_city']];
            $return[] = $line.'：成本->'.$v['cb_price'].'；最终价格->'.$v['zz_price'].'；备注->'.$v['zhi_mark'];
            $price = $v['zz_price'] == '0'?$v['cb_price']:$v['zz_price'];
            $sum+=$price;
        }
        $return[] = '总价：'.$sum;
        $retu = implode('<br>',$return);
	    $return_str = '<br/>线路：'.$str.'<br/>'.$retu;
	    return array($sum,$return_str);
    }

    public function portform(){
	    $this->display();
    }

	public function portprice(){
        set_time_limit(0);
        import("Org.Util.PHPExcel");
        if (! empty ( $_FILES['csvFile']['name'])){
            $tmp_file = $_FILES['csvFile']['tmp_name'];
            $file_types = explode ( ".", $_FILES ['csvFile'] ['name'] );
            $file_type = $file_types [count ( $file_types ) - 1];
            print_log("文件导入:".$tmp_file);
            /*判别是不是.xls文件，判别是不是excel文件*/
            if (strtolower ( $file_type ) == "xls" || strtolower ( $file_type ) =="xlsx"){
                print_log("导入文件类型:".$file_type);
                /*设置上传路径*/
                $savePath = 'Upload/';
                /*以时间来命名上传的文件*/
                $str = date ( 'Ymdhis' );
                $file_name = $str . "." . $file_type;
                /*是否上传成功*/
                if (!copy ($tmp_file, $savePath.$file_name )){
                    $this->error ( '上传失败' );
                }

                $PHPExcel=new \PHPExcel();
                //如果excel文件后缀名为.xlsx，导入这个类
                if($file_type == 'xlsx'){
                    import("Org.Util.PHPExcel.Reader.Excel2007");
                    $PHPReader=new \PHPExcel_Reader_Excel2007();
                }else{
                    import("Org.Util.PHPExcel.Reader.Excel5");
                    $PHPReader=new \PHPExcel_Reader_Excel5();
                    //$this->error("文件后缀名为.xlsx");
                }
                print_log("上传文件名:".$savePath.$file_name);
                $PHPExcel=$PHPReader->load($savePath.$file_name);
                //获取表中的第一个工作表，如果要获取第二个，把0改为1，依次类推
                $currentSheet=$PHPExcel->getSheet(0);
                //获取总列数
                $allColumn=$currentSheet->getHighestColumn();
                print_log("获取总列数:".$allColumn);
                //获取总行数
                $allRow=$currentSheet->getHighestRow();
                print_log("获取总行数:".$allRow);
                //echo $allRow;
                //print_r($allRow);
                //print_log("文件导入:".$allRow);
                $datatime = date('Y-m-d H:i:s',time());
                $add_arr = $up_arr = $err_arr = array();
                for($currentRow=2;$currentRow<=$allRow;$currentRow++){
                    $arr = array();
                    $str='';
                    for($k='A';$k<=$allColumn;$k++){            //从A列读取数据
                        //这种方法简单，但有不妥，以'\\'合并为数组，再分割\\为字段值插入到数据库,实测在excel中，如果某单元格的值包含了\\导入的数据会为空
                        $str.=$currentSheet->getCell($k.$currentRow)->getValue().'\\';//读取单元格
                    }
                    //explode:函数把字符串分割为数组。
                    $str_arr = explode("\\",$str);
                    foreach($str_arr as $k=>&$v){
                        $v = trim($v);
                    }
                    //直发地入库
                    //出发地目的地处理
                    $start_prov_map['area_name'] = array('eq',$str_arr['0']);
                    $start_prov_map['area_pid'] = array('eq','0');
                    $start_prov = M('area_price')->where($start_prov_map)->find();
                    if(empty($start_prov)){
                        $start_pid = M('area_price')->add(array(
                                'area_pid' => '0',
                                'area_name' => $str_arr['0'],
                        ));
                        $start_id = M('area_price')->add(array(
                            'area_pid' => $start_pid,
                            'area_name' => $str_arr['1'],
                        ));
                    }else{
                        $start_pid = $start_prov['area_id'];
                        $start_area_map['area_name'] = array('eq',$str_arr['1']);
                        $start_area_map['area_pid'] = array('neq','0');
                        $start_area = M('area_price')->where($start_area_map)->find();
                        if(empty($start_area)){
                            $start_id = M('area_price')->add(array(
                                'area_pid' => $start_pid,
                                'area_name' => $str_arr['1'],
                            ));
                        }else{
                            $start_id = $start_area['area_id'];
                        }
                    }

                    $end_prov_map['area_name'] = array('eq',$str_arr['2']);
                    $end_prov_map['area_pid'] = array('eq','0');
                    $end_prov = M('area_price')->where($end_prov_map)->find();
                    if(empty($end_prov)){
                        $end_pid = M('area_price')->add(array(
                            'area_pid' => '0',
                            'area_name' => $str_arr['2'],
                        ));
                        $end_id = M('area_price')->add(array(
                            'area_pid' => $end_pid,
                            'area_name' => $str_arr['3'],
                        ));
                    }else{
                        $end_pid = $end_prov['area_id'];
                        $end_area_map['area_name'] = array('eq',$str_arr['3']);
                        $end_area_map['area_pid'] = array('neq','0');
                        $end_area = M('area_price')->where($end_area_map)->find();
                        if(empty($end_area)){
                            $end_id = M('area_price')->add(array(
                                'area_pid' => $end_pid,
                                'area_name' => $str_arr['3'],
                            ));
                        }else{
                            $end_id = $end_area['area_id'];
                        }
                    }

                    $map['start_prov'] = array('eq',$start_pid);
                    $map['start_city'] = array('eq',$start_id);
                    $map['end_prov'] = array('eq',$end_pid);
                    $map['end_city'] = array('eq',$end_id);
                    $result = M('zhi')->where($map)->find();
                    if(empty($result)){
                        $arr = array(
                            'start_prov' => $start_pid,
                            'start_city' => $start_id,
                            'end_prov' => $end_pid,
                            'end_city' => $end_id,
                            'cb_price' => $str_arr['4'],
                            'zz_price' => $str_arr['5'],
                            'zhi_mark' => $str_arr['6'],
                            'zhi_man' => $str_arr['7'],
                            'up_date' => date('Y-m-d H:i:s'),
                        );
                        $return = M('zhi')->add($arr);
                        if($return){
                            $ec_str = "添加成功：".$str_arr['0'].'/'.$str_arr['1'].'——'.$str_arr['2'].'/'.$str_arr['3'].'；成本：'.$str_arr['4'].'；报价：'.$str_arr['5'];
                            echo $ec_str;
                            echo "<br/>";
                            $add_arr[] = $ec_str;
                        }else{
                            $ec_str = "添加失败：".$str_arr['0'].'/'.$str_arr['1'].'——'.$str_arr['2'].'/'.$str_arr['3'].'；成本：'.$str_arr['4'].'；报价：'.$str_arr['5'];
                            echo '<span style="color:red">'.$ec_str.'</span>';
                            echo "<br/>";
                            $err_arr[] = $ec_str;
                            $err_arr[] = M('zhi')->_sql();
                        }
                    }else{
                        $arr = array(
                            'cb_price' => $str_arr['4'],
                            'zz_price' => $str_arr['5'],
                            'zhi_mark' => $str_arr['6'],
                            'zhi_man' => $str_arr['7'],
                            'up_date' => date('Y-m-d H:i:s'),
                        );
                        $up_map['zhi_id'] = array('eq',$result['zhi_id']);
                        $return = M('zhi')->where($up_map)->save($arr);
                        if($return){
                            $ec_str = "修改成功：".$str_arr['0'].'/'.$str_arr['1'].'——'.$str_arr['2'].'/'.$str_arr['3'].'；成本：'.$str_arr['4'].'；报价：'.$str_arr['5'];
                            echo $ec_str;
                            echo "<br/>";
                            $up_arr[] = $ec_str;
                        }else{
                            $ec_str = "修改失败：".$str_arr['0'].'/'.$str_arr['1'].'——'.$str_arr['2'].'/'.$str_arr['3'].'；成本：'.$str_arr['4'].'；报价：'.$str_arr['5'];
                            echo '<span style="color:red">'.$ec_str.'</span>';
                            echo "<br/>";
                            $err_arr[] = $ec_str;
                            $err_arr[] = M('zhi')->_sql();
                        }
                    }
                    if($currentRow%10 == 0){
                        ob_flush();
                        flush();
                    }
                }
                print_log("价格导入添加成功:".implode('<br/>',$add_arr));
                print_log("价格导入修改成功:".implode('<br/>',$up_arr));
                print_log("价格导入失败:".implode('<br/>',$err_arr));
                echo "<a href='index'>返回</a>";
            }else{
                $this->error( '不是Excel文件，重新上传' );
            }
        }
    }
}