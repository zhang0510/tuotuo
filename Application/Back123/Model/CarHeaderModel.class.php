<?php
namespace Back\Model;
class CarHeaderModel extends BaseModel{
    /**
     * 获取提车人信息
     * @date: 2016-8-4 下午3:45:35
     * @author: liuxin
     * @return Ambigous <\Think\mixed, boolean, string, NULL, mixed, multitype:, unknown, object>
     */
    public function getCarTakers($name='',$tel){
        $obj = M('car_header');
        //$arr = array('car_name'=>$name);
        $map[] = '1=1';
        if($name!=''){
            $map1['car_name'] = array('like','%'.$name.'%');
            $map1['car_tel'] = array('like','%'.$name.'%');
        }
        if (!empty($tel)){
        	$map1['car_tel'] = array('like','%'.$tel.'%');
        }
        if($name!=''||!empty($tel)){
            $map1['_logic']='or';
            $map['_complex']= $map1;
        }
        $num = $obj ->where($map)->count();
        $page = set_page($num,10);
        $info = $obj -> limit($page->limit) ->where($map)-> order("car_create desc") -> select();
        $page = $page -> BackPage();
        $area=D("Area");
        foreach($info as &$va){
            if(!empty($va['car_sheng'])){
                $va['car_sheng']=$area->getOne($va['car_sheng'])['area_name'];
            }
            if(!empty($va['car_shi'])){
                $va['car_shi']=$area->getOne($va['car_shi'])['area_name'];
            }
            
        }
        $res['info'] = $info;
        $res['page'] = $page;
        $res['num'] = $num;
        return $res;
    }
    /**
     * 添加提车人
     * @date: 2016-8-5 下午12:10:30
     * @author: liuxin
     * @param string $car_name 提车人姓名
     * @param string $car_identity  身份证号
     * @param string $car_pwd   密码
     * @param string $car_tel   手机
     * @param string $car_flag  标识
     * @return Ambigous <\Think\mixed, boolean, unknown, string>
     */
    public function carTakerAdd($car_name='',$car_identity='',$car_pwd='',$car_tel='',$car_flag='',$car_lxr='',$car_lxfs='',$car_gsm='',$lc_code='',$car_sheng='',$car_shi=''){
        $data['car_name'] = $car_name;
        $data['car_identity'] = $car_identity;
        $data['car_pwd'] = $car_pwd;
        $data['car_tel'] = $car_tel;
        $data['car_flag'] = $car_flag;
        $data['car_create'] = date('Y-m-d H:i:s',time());
        $data['car_code'] = get_code('tch');
        $data['car_lxr'] = $car_lxr;
        $data['car_lxfs'] = $car_lxfs;
        $data['car_gsm'] = $car_gsm;
        $data['lc_code'] = $lc_code;
        $data['car_sheng']=$car_sheng;
        $data['car_shi']=$car_shi;
        $obj = M('car_header');
        $res = $obj -> add($data);
        return $res;
        
    }
    /**
     * 获取提车人信息（单一）
     * @date: 2016-8-5 下午12:11:03
     * @author: liuxin
     * @param string $car_id 提车人id
     * @return Ambigous <\Think\mixed, boolean, NULL, multitype:, mixed, unknown, string, object>
     */
    public function getOneInfo($car_id=''){
        $obj = M('car_header');
        $map['car_id'] = array('eq',$car_id);
        $info = $obj -> where($map) -> find();
        
        $comObj = M('logistics_company');
        $maps['lc_code'] = array('eq',$info['lc_code']);
        $infos = $comObj -> where($maps) -> find();
        $info['cominfo'] = $infos;
        /*$data['com'] = $infos['lc_name'];
        $data['comCode'] = $infos['lc_code']; */
        return $info;
    }
    /**
     * 编辑提车人
     * @date: 2016-8-5 下午12:11:34
     * @author: liuxin
     * @param string $car_id 提车人id
     * @param string $car_name 姓名
     * @param string $car_identity  身份证号
     * @param string $car_pwd   密码
     * @param string $car_tel   手机
     * @param string $car_flag  标识
     * @return Ambigous <boolean, unknown>
     */
    public function carTakerEdit($car_id='',$car_name='',$car_identity='',$car_pwd='',$car_tel='',$car_flag='',$car_sheng='',$car_shi='',$car_gsm=''){
        $obj = M('car_header');
        $data['car_name'] = $car_name;
        $data['car_identity'] = $car_identity;
        $data['car_pwd'] = $car_pwd;
        $data['car_tel'] = $car_tel;
        $data['car_flag'] = $car_flag;
        $data['car_sheng'] =$car_sheng;
        $data['car_shi']=$car_shi;
        $data['car_gsm']= $car_gsm;
        $map['car_id'] = array('eq',$car_id);
        $res = $obj -> where($map) -> save($data);
        return $res;
        
    }
    /**
     * 删除提车人（单一）
     * @date: 2016-8-5 下午12:12:05
     * @author: liuxin
     * @param string $car_id 提车人id
     * @return Ambigous <\Think\mixed, boolean, unknown>
     */
    public function carTakerDel($car_id=''){
        $obj = M('car_header');
        $res = $obj -> delete($car_id);
        return $res;
    }
    /**
     * 删除提车人（多条）
     * @date: 2016-8-5 下午12:12:50
     * @author: liuxin
     * @param unknown $arr 由要删除的提车人id组成的数组
     * @return Ambigous <\Think\mixed, boolean, unknown>
     */
    public function carTakerDelAll($arr){
        $obj = M('car_header');
        $map['car_id'] = array('in',$arr);
        $res = $obj -> where($map) -> delete();
        return $res;
        
    }
    
    /*
     * 根据code查询提车人信息
     * @author: yao
     * @date: 2016-8-8 
     * @param $code 提车人的编号
     * @return array
     */
    public function getData($code){
    	$where['car_code'] = $code;
    	$data = $this->where($where)->find();
    	return $data;
    }
	
	/**
	 * 获取提车人数目
	 * @date: 2016-8-9 下午3:01:25
	 * @author: liuxin
	 * @return int
	 */
	public function getCarHeaderNum(){
		$map['car_flag'] = array('eq','Y');
		$num = $this -> where($map) -> count();
		return $num;
	}
	public function getCom(){
		$obj = M('LogisticsCompany');
		$list = $obj -> select();
		return $list;
	}
}