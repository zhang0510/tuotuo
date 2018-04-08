<?php
namespace Back\Model;
class LogisticsCompanyModel extends BaseModel{
    /**
     * 获取物流公司信息
     * @date: 2016-8-9 下午6:38:12
     * @author: liuxin
     * @param string $name 物流公司名
     * @return array
     */
    public function companyShow($name=''){
       
        if($name!=''){
            $where['lc_name'] = array('like','%'.$name.'%');
            $where['lc_short_name']  = array('like', '%'.$name.'%');
            $where['lc_lxrs']  = array('like','%'.$name.'%');
            $where['lc_tel']  = array('like','%'.$name.'%');
            $where['lc_diao']  = array('like','%'.$name.'%');
            $where['lc_diao_tel']  = array('like','%'.$name.'%');
            $where['lc_gen']  = array('like','%'.$name.'%');
            $where['lc_gen_tel']  = array('like','%'.$name.'%');
            $where['_logic'] = 'or';
            $map['_complex'] = $where;
        }
        $map[] = '1=1';
        $num = $this -> where($map) -> count();
        $page = set_page($num,10);
        $list = $this -> where($map) -> limit($page->limit) -> order("lc_id desc") -> select();
        $page = $page -> BackPage();
        $data['page'] = $page;
        $data['num'] = $num;
        $data['list'] = $list;
        return $data;
    }
    /**
     * 物流公司添加
     * @date: 2016-8-9 下午6:38:56
     * @author: liuxin
     * @param string $name 物流公司名
     * @param string $tel 联系人电话
     * @param string $member 公司联系人
     * @return array
     */
    public function companyAdd($data=null){
        $data['lc_code'] = get_code("LC");
        $data['lc_time'] = date('Y-m-d H:i:s',time());
        $res = $this -> add($data);
        return $res;
    }
    /**
     * 获取单条数据
     * @date: 2016-8-9 下午6:39:57
     * @author: liuxin
     * @param string $id 物流公司id
     * @return array
     */
    public function getOneInfo($id=''){
        $map['lc_id'] = array('eq',$id);
        $list = $this -> where($map) -> find();
        return $list;
    }
    /**
     * 编辑物流公司
     * @date: 2016-8-9 下午6:40:27
     * @author: liuxin
     * @param string $id 物流公司id
     * @param string $name  公司名称
     * @param string $tel   联系人电话
     * @param string $member    公司联系人
     * @return string
     */
    public function companyEdit($data=null){
        $map['lc_code'] = array('eq',$data['lc_code']);
        $res = $this -> where($map) -> save($data);
        return $res;
    }
    /**
     * 删除物流公司
     * @date: 2016-8-9 下午6:41:48
     * @author: liuxin
     * @param string $id 公司id
     * @return string
     */
    public function del($id=''){
        $map['lc_id'] = array('eq',$id);
        $res = $this ->where($map) -> delete();
        return $res;
    }
    
    /**
     * 获取司机信息
     * @date: 2016-8-9 下午6:38:12
     * @author: liuxin
     * @param string $name 
     * @return array
     */
    public function driverShow($name=''){
    	$chObj = M("car_header");
    	if($name!=''){
    		$where['car_name'] = array('like','%'.$name.'%');
    		$where['car_identity']  = array('like', '%'.$name.'%');
     		$where['car_tel']  = array('like','%'.$name.'%');
    		$where['_logic'] = 'or';
    		$map['_complex'] = $where;
    	}
    	$map[] = '1=1';
    	$num = $chObj -> where($map) -> count();
    	$page = set_page($num,10);
    	$list = $chObj -> where($map) -> limit($page->limit) -> select();
    	if($list){
    		$area = M('area');
    		$size = count($list);
    		for($i=0;$i<$size;$i++){
    			$map1['area_id'] = array("eq",$list[$i]['car_sheng']);
    			$map2['area_id'] = array("eq",$list[$i]['car_shi']);
    			$obj1 = $area->where($map1)->find();
    			$obj2 = $area->where($map2)->find();
    			$list[$i]['car_sheng_name'] = $obj1["area_name"];
    			$list[$i]['car_shi_name'] = $obj2["area_name"];
    		}
    	}
    	$page = $page -> BackPage();
    	$data['page'] = $page;
    	$data['num'] = $num;
    	$data['list'] = $list;
    	return $data;
    }
    /**
     * 删除司机信息
     * @date: 2016-8-9 下午6:41:48
     * @author: liuxin
     * @param string $id 公司id
     * @return string
     */
    public function driverDel($id=''){
    	$chObj = M("car_header");
    	$map['car_id'] = array('eq',$id);
    	$res = $chObj ->where($map) -> delete();
    	return $res;
    }
    /**
     * 获取单条数据
     * @date: 2016-8-9 下午6:39:57
     * @author: liuxin
     * @param string $id 物流公司id
     * @return array
     */
    public function driverOneInfo($id=''){
    	$chObj = M("car_header");
    	$map['car_id'] = array('eq',$id);
    	$area = M('area');
    	$list = $chObj -> where($map) -> find();
    	
    	
    	$map1['area_id'] = array("eq",$list['car_sheng']);
    	$map2['area_id'] = array("eq",$list['car_shi']);
    	$obj1 = $area->where($map1)->find();
    	$obj2 = $area->where($map2)->find();
    	$list['car_sheng_name'] = $obj1["area_name"];
    	$list['car_shi_name'] = $obj2["area_name"];
    	return $list;
    }
    
    /**
     * 司机添加
     * @date: 2016-8-9 下午6:38:56
     * @author: liuxin
     * @param string $name 物流公司名
     * @param string $tel 联系人电话
     * @param string $member 公司联系人
     * @return array
     */
    public function driverAdd($data=null){
    	$chObj = M("car_header");
    	$data['car_code'] = get_code("TCH");
    	$data['car_create'] = date('Y-m-d H:i:s',time());
    	$res = $chObj -> add($data);
    	return $res;
    }
    /**
     * 编辑司机信息
     * @date: 2016-8-9 下午6:40:27
     * @author: liuxin
     * @param string $id 物流公司id
     * @param string $name  公司名称
     * @param string $tel   联系人电话
     * @param string $member    公司联系人
     * @return string
     */
    public function driverEdit($data=null){
    	$chObj = M("car_header");
    	$map['car_code'] = array('eq',$data['car_code']);
    	$res = $chObj -> where($map) -> save($data);
    	return $res;
    }
}