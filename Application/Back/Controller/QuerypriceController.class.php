<?php
namespace Back\Controller;
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
                'cb_price' => '0',
                'zz_price' => $v['zhuan_price'],
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
                                $z_k3 = $value['end_prov'].'/'.$value['end_city'];
                                if(in_array($z_k3,$end_arr)){
                                    $arr = array($v,$value,$value2,$end_content[$z_k3]);
                                    $return[] = $this->line_content($arr,$area);
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
            $sum+=$v['zz_price'];
        }
        $return[] = '总价：'.$sum;
        $retu = implode('<br>',$return);
	    $return_str = '<br/>线路：'.$str.'<br/>'.$retu;
	    return array($sum,$return_str);
    }

	public function portprice(){
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
                $arr = array();
                for($currentRow=2;$currentRow<=$allRow;$currentRow++){
                    $str='';
                    for($k='A';$k<=$allColumn;$k++){            //从A列读取数据
                        //这种方法简单，但有不妥，以'\\'合并为数组，再分割\\为字段值插入到数据库,实测在excel中，如果某单元格的值包含了\\导入的数据会为空
                        $str.=$currentSheet->getCell($k.$currentRow)->getValue().'\\';//读取单元格
                    }
                    //explode:函数把字符串分割为数组。
                    $str_arr = explode("\\",$str);
                    //直发地入库
                    /*$map['area_pid'] = array('neq','0');
                    $map['area_name'] = array('like',"%{$str_arr['2']}%");
                    $area = M('area_price')->where($map)->find();
                    if(empty($area)){
                        echo "<pre/>";
                        print_r($str_arr);
                    }elseif($str_arr['3'] == '' && $str_arr['4'] == ''){
                        echo "<pre/>";
                        print_r($str_arr);
                    }else{
                        $arr = array(
                            'start_prov' => '1',
                            'start_city' => '2',
                            'end_prov' => $area['area_pid'],
                            'end_city' => $area['area_id'],
                            'cb_price' => $str_arr['3'],
                            'zz_price' => $str_arr['4'],
                            'zhi_mark' => $str_arr['5'],
                        );
                        M('zhi')->add($arr);
                    }*/

                    //中转地入库
                    $map['area_pid'] = array('neq','0');
                    $map['area_name'] = array('like',"%".trim($str_arr['2'])."%");
                    $area = M('area_price')->where($map)->find();

                    $map1['area_pid'] = array('neq','0');
                    $map1['area_name'] = array('like',"%".trim($str_arr['3'])."%");
                    $area1 = M('area_price')->where($map1)->find();

                    if(empty($area) || empty($area1)){
                        echo M('area_price')->_sql();
                        echo "123<pre/>";
                        print_r($str_arr);
                    }elseif($str_arr['4'] == ''){
                        echo "456<pre/>";
                        print_r($str_arr);
                    }else{
                        $arr = array(
                            'start_prov' => $area['area_pid'],
                            'start_city' => $area['area_id'],
                            'end_prov' => $area1['area_pid'],
                            'end_city' => $area1['area_id'],
                            'zhuan_price' => $str_arr['4'],
                            'zhuan_man' => $str_arr['5'],
                            'zhuan_mark' => $str_arr['6'],
                        );
                        M('zhuan')->add($arr);
                    }
                    //直发地处理
                    //$arr[$str_arr['1']][$str_arr['2']] = $str_arr['2'];

                    //中转出发地处理
                    /*$arr[$str_arr['1']][$str_arr['2']] = $str_arr['2'];*/

                    //中转目的地处理
                    /*$map['area_pid'] = array('neq','1');
                    $map['area_name'] = array('like',"%{$str_arr['3']}%");
                    $area = M('area')->where($map)->find();
                    $map1['area_id'] = array('eq',$area['area_pid']);
                    $area1 = M('area')->where($map1)->find();
                    if($area1['area_pid'] != '1'){
                        $map2['area_id'] = array('eq',$area1['area_pid']);
                        $area1 = M('area')->where($map2)->find();
                    }
                    $arr[$area1['area_name']][$str_arr['3']] = $str_arr['3'];*/

                    //中转添加入库
                    /*$s_map['start_pid'] = array('neq','0');
                    $s_map['start_name'] = array('eq',$str_arr['2']);
                    $start = M('start')->where($s_map)->find();
                    $e_map['end_pid'] = array('neq','0');
                    $e_map['end_name'] = array('eq',$str_arr['3']);
                    $end = M('end')->where($e_map)->find();
                    $add = array(
                        'start_prov'=>$start['start_pid'],
                        'start_city'=>$start['start_id'],
                        'end_prov'=>$end['end_pid'],
                        'end_city'=>$end['end_id'],
                        'zhuan_price'=>$str_arr['4'],
                        'zhuan_mark'=>$str_arr['6'],
                        'zhuan_man'=>$str_arr['5'],
                    );
                    echo "<pre/>";
                    print_r($add);
                    M('zhuan')->add($add);*/

                }
                //中转出发地入库
                /*foreach($arr as $k=>$v){
                    $id = M('start')->add(array(
                        'start_pid' => '0',
                        'start_name' => $k,
                    ));
                    foreach($v as $key=>$val){
                        M('start')->add(array(
                            'start_pid' => $id,
                            'start_name' => $val,
                        ));
                    }
                }*/

                //中转目的地入库
                /*foreach($arr as $k=>$v){
                    $id = M('end')->add(array(
                        'end_pid' => '0',
                        'end_name' => $k,
                    ));
                    foreach($v as $key=>$val){
                        M('end')->add(array(
                            'end_pid' => $id,
                            'end_name' => $val,
                        ));
                    }
                }*/
            }else{
                $this->error( '不是Excel文件，重新上传' );
            }
        }
    }
}