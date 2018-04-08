<?php
namespace Back\Controller;
class LogisticsController extends BaseController{
    /**
     * 物流公司展示
     * @date: 2016-8-9 下午6:43:07
     * @author: liuxin
     */
    public function companyShow(){
        $name = I('get.name');
        $obj = D('LogisticsCompany');
        $list = $obj -> companyShow($name);
        $this -> assign('list',$list['list']);
        $this -> assign('num',$list['num']);
        $this -> assign('page',$list['page']);
        $this -> assign('name',$name);
        $this -> display('Logistics:logistics_company_show');
    }
    /**
     * 物流公司添加页面
     * @date: 2016-8-9 下午6:43:27
     * @author: liuxin
     */
    public function companyAdd(){
        $type = I('get.type');
        if($type=='e'){
            $id = I('get.id');
            $obj = D('LogisticsCompany');
            $list = $obj -> getOneInfo($id);
            $this -> assign('list',$list);
        }
        $this -> assign('type',$type);
        $this -> display('Logistics:logistics_company_add');
    }
    /**
     * 物流公司添加
     * @date: 2016-8-9 下午6:43:45
     * @author: liuxin
     */
    public function compamyDoAdd(){
    	$data["lc_code"] = I('post.lc_code');
        $data["lc_name"] = I('post.lc_name');
        $data["lc_lxrs"] = I('post.lc_lxrs');
        $data["lc_tel"] = I('post.lc_tel');
        $data["lc_diao"] = I('post.lc_diao');
        $data["lc_diao_tel"] = I('post.lc_diao_tel');
        $data["lc_gen"] = I('post.lc_gen');
        $data["lc_gen_tel"] = I('post.lc_gen_tel');
        $data["lc_ht_code"] = I('post.lc_ht_code');
        $data["lc_bei"] = I('post.lc_bei');
        $data["lc_status"] = I('post.lc_status');
        $data["lc_short_name"] = I('post.lc_short_name');
        
        $obj = D('LogisticsCompany');
        if($data["lc_code"]==''||$data["lc_code"]==null){
                $res = $obj -> companyAdd($data);
                if($res){
                    parent::success('添加成功',U('Logistics/companyShow'));
                }else{
                    parent::error('添加失败');
                }
        }else{
                $res = $obj -> companyEdit($data);
                if($res){
                    parent::success("编辑成功",U('Logistics/companyShow'));
                }else{
                    parent::error('编辑失败');
                }
        }
    }
    /**
     * 物流公司删除
     * @date: 2016-8-9 下午6:44:14
     * @author: liuxin
     */
    public function del(){
        $id = I('post.id');
        $obj = D('LogisticsCompany');
        $res = $obj -> del($id);
        if($res){
            $data['con'] = '删除成功';
            $data['sign'] = 'Y';
        }else{
            $data['con'] = '删除失败';
            $data['sign'] = 'N';
        }
        $this -> ajaxReturn($data);
    }
    /**
     * 物流司机
     * @date: 2016-8-9 下午6:43:07
     * @author: liuxin
     */
    public function driverShow(){
    	$name = I('get.name');
    	$obj = D('LogisticsCompany');
    	$list = $obj -> driverShow($name);
    	$this -> assign('list',$list['list']);
    	$this -> assign('num',$list['num']);
    	$this -> assign('page',$list['page']);
    	$this -> assign('name',$name);
    	$this -> display('Logistics:logistics_driver_list');
    }
    /**
     * 司机删除
     * @date: 2016-8-9 下午6:44:14
     * @author: liuxin
     */
    public function driverDel(){
    	$id = I('post.id');
    	$obj = D('LogisticsCompany');
    	$res = $obj -> driverDel($id);
    	if($res){
    		$data['con'] = '删除成功';
    		$data['sign'] = 'Y';
    	}else{
    		$data['con'] = '删除失败';
    		$data['sign'] = 'N';
    	}
    	$this -> ajaxReturn($data);
    }
    
    /**
     * 司机添加页面
     * @date: 2016-8-9 下午6:43:27
     * @author: liuxin
     */
    public function driverAdd(){
    	$id = I('get.id');
    	$obj = D('LogisticsCompany');
    	$list = $obj -> driverOneInfo($id);
    	$this -> assign('list',$list);
    	$areaObj = D('Area');
    	$arealist = $areaObj->getSon(1);
    	$this -> assign('area',$arealist);
    	$this -> assign('sheng',$list['car_sheng']);
    	$this -> display('Logistics:logistics_driver_add');
    }
    /**
     * 根据父ID获取子市区
     */
    function getSon(){
    	$id = I('id');
    	$areaObj = D('Area');
    	$arealist = $areaObj->getSon($id);
    	print_log(json_encode($arealist));
    	if($arealist){
    		$data['sign'] = true;
    		$data['data'] = $arealist;
    	}else{
    		$data['sign'] = false;
    		$data['data'] = '';
    	}    	
    	$this -> ajaxReturn($data);
    }
    
    /**
     * 司机添加
     * @date: 2016-8-9 下午6:43:45
     * @author: liuxin
     */
    public function driverDoAdd(){
    	$data["car_code"] = I('post.car_code');
    	$data["car_name"] = I('post.car_name');
    	$data["car_identity"] = I('post.car_identity');
    	$data["car_tel"] = I('post.car_tel');
    	$data["car_flag"] = I('post.car_flag');
    	$data["car_sheng"] = I('post.car_sheng');
    	$data["car_shi"] = I('post.car_shi');
    	$data["car_he_code"] = I('post.car_he_code');
    	$obj = D('LogisticsCompany');
    	if($data["car_code"]==''||$data["car_code"]==null){
    		$res = $obj -> driverAdd($data);
    		if($res){
    			parent::success('添加成功',U('Logistics/companyShow'));
    		}else{
    			parent::error('添加失败');
    		}
    	}else{
    		$res = $obj -> driverEdit($data);
    		if($res){
    			parent::success("编辑成功",U('Logistics/companyShow'));
    		}else{
    			parent::error('编辑失败');
    		}
    	}
    }
}