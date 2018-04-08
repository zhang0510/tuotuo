<?php
namespace Back\Controller;
use Back\Controller\BaseController;
class CarTakerController extends BaseController{
    /**
     * 展示提车人
     * @date: 2016-8-4 下午5:31:18
     * @author: liuxin
     * 
     */
    public function showCarTakers(){
        $name = I('get.car_name');
        $obj = D('CarHeader');
        $info = $obj -> getCarTakers($name);
        $this -> assign('search',$name);
        $this -> assign('page',$info['page']);
        $this -> assign('info',$info['info']);
        $this -> assign('num',$info['num']);
        $this -> display('car_taker:car_taker_manage');
    }
    /**
     * 添加提车人页面
     * @date: 2016-8-5 下午12:13:30
     * @author: liuxin
     */
    public function carTakerAdd(){
        $model = D('Area');
        $obj = D('CarHeader');
        $list = $obj -> getCom();
        $provincea = $model->getArea(1);
        $this->assign("provincea",$provincea);
        $this -> assign('list',$list);
        $this -> display('car_taker:car_taker_add');
    }
    /**
     * 添加提车人
     * @date: 2016-8-5 下午12:13:52
     * @author: liuxin
     */
    public function doAdd(){
        $car_name = I('post.car_name');
        $car_identity = I('post.car_identity');
        $car_pwd = I('post.car_pwd');
        //$lc_code = I('post.lc_code');
        $car_tel = I('post.car_tel');
        $car_flag = I('post.car_flag');
        /* $car_lxr = I('post.car_lxr');
        $car_lxfs = I('post.car_lxfs');
        $car_gsm = I('post.car_gsm'); */
        $lc_code = I('post.lc_code');
        $car_sheng=I('car_sheng');
        $car_shi =I('car_shi');
        $car_gsm=I('car_gsm');
        if($car_name==''||$car_pwd==''||$car_identity==''||$car_tel==""||$car_flag==''||$lc_code==''){
            //$this -> error('请按要求填写数据',U('CarTaker/carTakerAdd'));
            parent::error('请按要求填写数据');
        }
        $car_pwd = md5($car_pwd);
        $obj = D('CarHeader');
        $res = $obj -> carTakerAdd($car_name,$car_identity,$car_pwd,$car_tel,$car_flag,$car_lxr='',$car_lxfs='',$car_gsm,$lc_code,$car_sheng,$car_shi);
        if($res){
            //$this -> success('添加成功',U('CarTaker/showCarTakers'));
            parent::success('添加成功',U('CarTaker/showCarTakers'));
        }else{
            parent::error('添加失败');
        }
    }
    /**
     * 编辑提车人页面
     * @date: 2016-8-5 下午12:14:17
     * @author: liuxin
     */
    public function carTakerEdit(){
        $car_id = I('get.car_id');
        $obj = D('CarHeader');
        $list = $obj -> getCom();
        $this -> assign('list',$list);
        $info = $obj -> getOneInfo($car_id);
        $this -> assign('com',$info['cominfo']);
        //$this -> assign('comCode',$info['comCode']); */
        $this -> assign('info',$info);
        //省
        $model = D('Area');
        $provincea = $model->getArea(1);
        $this->assign("provincea",$provincea);
        //市
        $city = $model->getSon($info['car_sheng']);
        $this->assign("city",$city);
        $this -> display('car_taker:car_taker_edit');
    }
    /**
     * 更改提车人
     * @date: 2016-8-5 下午12:14:39
     * @author: liuxin
     */
    public function doEdit(){
        $car_name = I('post.car_name');
        $car_identity = I('post.car_identity');
        $car_pwd = I('post.car_pwd');
       
        $car_tel = I('post.car_tel');
        $car_flag = I('post.car_flag');
        $car_id = I('post.car_id');
        $car_sheng=I('car_sheng');
        $car_shi=I('car_shi');
        $car_gsm=I('car_gsm');
        if($car_name==''||$car_pwd==''||$car_identity==''||$car_tel==""||$car_flag==''){
            //$this -> error('请按要求填写数据',U('CarTaker/carTakerEdit',array('car_id'=>$car_id)));
            parent::error('请按要求填写数据');
        }
        
        $car_pwd = md5($car_pwd);
        $obj = D('CarHeader');
        $res = $obj -> carTakerEdit($car_id,$car_name,$car_identity,$car_pwd,$car_tel,$car_flag,$car_sheng,$car_shi,$car_gsm);
        if($res){
            //$this -> success('修改成功',U('CarTaker/showCarTakers'));
            parent::success('修改成功',U('CarTaker/showCarTakers'));
        }else{
            //$this -> error('修改失败',U('CarTaker/carTakerEdit',array('car_id'=>$car_id)));
            parent::error('修改失败');
        }
    }
    /**
     * 删除提车人（单一）
     * @date: 2016-8-5 下午12:15:09
     * @author: liuxin
     */
    public function carTakerDel(){
        $car_id = I('post.car_id');
        $obj = D('CarHeader');
        $res = $obj -> carTakerDel($car_id);
        
        if($res){
            $data['sign'] = 'Y';
            $data['msg'] = '删除成功';
        }else{
            $data['sign'] = 'N';
            $data['msg'] = '删除失败';
        }
        $this -> ajaxReturn($data);
    }
    /**
     * 删除提车人（多条）
     * @date: 2016-8-5 下午12:15:45
     * @author: liuxin
     */
    public function carTakerDelAll(){
        $arr = I('post.arr');
        //$arr = json_encode($arr);
        $obj = D('CarHeader');
        $res = $obj -> carTakerDelAll($arr);
        if($res){
            $data['sign'] = 'Y';
            $data['msg'] = '删除成功';
        }else{
            $data['sign'] = 'N';
            $data['msg'] = '删除失败';
        }
        $this -> ajaxReturn($data);
    }
}