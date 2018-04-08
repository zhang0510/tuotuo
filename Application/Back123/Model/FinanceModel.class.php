<?php
namespace Back\Model;

class FinanceModel extends BaseModel{
    //提车人订单
    public function carOrderList(){
        
        //初始化
        $map = array();
        $order_M = M('order');
        $orderInfo_M = M('order_info');
        $carOrder_M = M('car_order');
        $carHeader_M = M('car_header');
        $area_M = M('area');
        
        //查询(order)订单表
        $orderList = $order_M -> select();
        
        //进入循环
        for ($n=0;$n<count($orderList);$n++){
            
            //拼装条件
            $o_map['order_code'] = array('eq',$orderList[$n]['order_code']);
        
            //获取条数(根据订单CODE查询运单)
            $result['number'] += $carOrder_M -> where($o_map) -> count();
        }
        
        //计算页数
        $result['page'] = set_page($result['number'],8);
        
        //进入循环
        for ($i=0;$i<count($orderList);$i++){
            //拼装条件
            $o_map['order_code'] = array('eq',$orderList[$i]['order_code']);
            
            //查询订单详情
            $orderInfo = $orderInfo_M -> where($o_map) ->select();
            
            //查询提车人订单
            $carOrder = $carOrder_M -> where($o_map) -> order('car_id desc') -> limit($result['page']->limit) -> select();
            
            //去除数组空元素
            $carOrder = array_filter($carOrder);
            
            //进入循环
            for ($j=0;$j<count($carOrder);$j++){
                //订单
                $Finance[$i][$j]['id']=$orderList[$i]['order_id'];
                $Finance[$i][$j]['order_code']=$orderList[$i]['order_code'];
                $Finance[$i][$j]['user_name']=$orderList[$i]['user_name'];
                $Finance[$i][$j]['user_tel']=$orderList[$i]['user_tel'];
                $Finance[$i][$j]['order_time']=$orderList[$i]['order_time'];
                $Finance[$i][$j]['order_info_zj'] = $orderInfo[0]['order_info_zj']/100;
                
                //提车人
                //提车人CODE(星号)
                $Finance[$i][$j]['carCode']=substr($carOrder[$j]['car_code'],0,3)."*";
                
                //提车人CODE(完全)
                $Finance[$i][$j]['car_code']=$carOrder[$j]['car_code'];
                
                //组装条件
                $car_map['car_code'] = array("eq",$carOrder[$j]['car_code']);
                
                //查询提车人表
                $carHeader = $carHeader_M -> where($car_map)->find();
                
                //提车人名称
                $Finance[$i][$j]['car_name']=$carHeader['car_name'];
        
                //接车时间
                if($carOrder[$j]['car_jc_time']!=""){
                    $ls_time = explode(" ",$carOrder[$j]['car_jc_time']);
                    $Finance[$i][$j]['car_jc_time'] = $ls_time[0];
                }else{
                    $Finance[$i][$j]['car_jc_time'] = "";
                }
                
                //送车时间
                if($carOrder[$j]['car_sc_time']!=""){
                    $ls_time = explode(" ",$carOrder[$j]['car_sc_time']);
                    $Finance[$i][$j]['car_sc_time'] = $ls_time[0];
                }else{
                    $Finance[$i][$j]['car_sc_time'] = "";
                }
                
                //判断起始地是否为空
                if($carOrder[$j]['car_cfd']!=""){
                    //获取起始地参数
                    $star = explode(",",$carOrder[$j]['car_cfd']);
                    
                    //循环读取地点
                    for ($a=0;$a<count($star);$a++){
                        //查询起始地名称
                        $map['area_id'] = array('eq',$star[$a]);
                        if ($a<2){
                            $ssList[$a]= implode($area_M -> where($map)->field('area_name')->find());
                        }else {
                            $qList[$a]= implode($area_M -> where($map)->field('area_name')->find());
                        }
                    }
                    
                    //存储起始地 省市/区
                    $Finance[$i][$j]['ss_cfd']=implode($ssList);
                    $Finance[$i][$j]['q_cfd']=implode($qList);
                    
                }else{
                    //存储起始地
                    $Finance[$i][$j]['ss_cfd']="";
                    $Finance[$i][$j]['q_cfd']="";
                }
                
                //判断目的地是否为空
                if($carOrder[$j]['car_mdd']!=""){
                    //获取结束地参数
                    $end = explode(",",$carOrder[$j]['car_mdd']);
                    
                    //循环读取地点
                    for ($b=0;$b<count($end);$b++){
                        //查询起始地名称
                        $map['area_id'] = array('eq',$end[$b]);
                        $endList[$a]= implode($area_M -> where($map)->field('area_name')->find());
                    }
                    
                    //存储结束地
                    $Finance[$i][$j]['car_mdd']=implode($endList);
                    
                }else{
                    //存储结束地
                    $Finance[$i][$j]['car_mdd']=implode($endList);
                }
            }
        }
        
        //传入值
        $result['list'] = $this->array_merge_rec($Finance);
        
        //分页条
        $result['show'] = $result['page']->BackPage();
        
        //返回值
        return $result;
    }
    
    //财务列表(已作废)
    public function FinanceList($search='',$startDate='',$endDate=''){
        //初始化
        $map = array();
        $order_M = M('order');
        $orderInfo_M = M('order_info');
        $yundan_M = M('yundan');
        $result = array();
        $Finance = array();
        $yundan = array();
        
        //判断搜索条件
        if($search!=''){
            $sel['order_code'] = array('like','%'.$search.'%');
            $sel['user_name'] = array('like','%'.$search.'%');
            $sel['user_tel'] = array('like','%'.$search.'%');
            $sel['_logic'] = 'or';
            $map['_complex'] = $sel;
        }
        
        //判断时间搜索条件
        if($startDate!=''&&$endDate!=''){
            $map['order_time'] = array('between',array($startDate,$endDate));
        }
        
        //查询(order)订单表
        $list = $order_M -> where($map) -> select();
        
        //进入循环
        for ($n=0;$n<count($list);$n++){
            //拼装条件
            $o_map['order_code'] = array('eq',$list[$n]['order_code']);
            
            //获取条数(根据订单CODE查询运单)
            $result['number'] += $yundan_M -> where($o_map) -> count();
        }
        //计算页数
        $result['page'] = set_page($result['number'],3);
        
        //进入循环
        for ($i=0;$i<count($list);$i++){
            //拼装条件
            $o_map['order_code'] = array('eq',$list[$i]['order_code']);
            
            //查询
            $yundan = $yundan_M -> where($o_map) -> order('yd_time desc') -> limit($result['page']->limit) -> select();
            print_log("运单信息:".json_encode($yundan));
            //去除数组空元素
            $yundan = array_filter($yundan);
            
            //进入循环
            for ($j=0;$j<count($yundan);$j++){
                    //订单
                    $Finance[$i][$j]['id']=$list[$i]['order_id'];
                    $Finance[$i][$j]['order_code']=$list[$i]['order_code'];
                    $Finance[$i][$j]['user_name']=$list[$i]['user_name'];
                    $Finance[$i][$j]['user_tel']=$list[$i]['user_tel'];
                    $Finance[$i][$j]['order_time']=$list[$i]['order_time'];
                    //运单
                    //运单ID
                    $Finance[$i][$j]['yd_id']=$yundan[$j]['yd_id'];
                    
                    //运单CODE
                    $Finance[$i][$j]['yd_code']=$yundan[$j]['yd_code'];
                    
                    //承运人
                    $Finance[$i][$j]['yd_name']=$yundan[$j]['yd_name'];
                    
                    //切割运单时间
                    if($yundan[$j]['yd_j_time']!=""){
                        $ls_time = explode(" ",$yundan[$j]['yd_j_time']);
                        $Finance[$i][$j]['yd_j_time'] = explode("-",$ls_time[0]);
                    }else{
                        $Finance[$i][$j]['yd_j_time'] = "";
                    }
                    
                    //切割运单起始地点
                    $Finance[$i][$j]['yd_star'] = $yundan[$j]['yd_star'];
                    
                    //切割运单起始地点
                    $Finance[$i][$j]['yd_end'] = $yundan[$j]['yd_end'];
                    
                    //运费
                    $Finance[$i][$j]['yd_price']=$yundan[$j]['yd_price']/100;
                    
                    //支付状态
                    if ($yundan[$j]['yd_status']!=""){
                        if ($yundan[$j]['yd_status']=="Y"){
                            $Finance[$i][$j]['yd_status'] == "已支付";
                        }else if($yundan[$j]['yd_status']=="W"){
                            $Finance[$i][$j]['yd_status'] == "未支付";
                        }
                    }
            }

        }
        //传入值
        $result['list'] = $this->array_merge_rec($Finance);
        //分页条
        $result['show'] = $result['page']->BackPage();
        //返回值
        return $result;
    }
    
    //数组降维
    function array_merge_rec($array) {  // 参数是使用引用传递的
        // 定义一个新的数组
        $new_array = array ();
        // 遍历当前数组的所有元素
        foreach ($array as $item) {
                // 如果当前数组元素还是数组的话，就递归调用方法进行合并
                $this->array_merge_rec($item);
                // 将得到的一维数组和当前新数组合并
                $new_array = array_merge ($new_array,$item );
        }
        // 修改引用传递进来的数组参数值
        $array = $new_array;
        return $array;
    }
}