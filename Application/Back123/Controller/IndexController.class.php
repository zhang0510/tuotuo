<?php
namespace Back\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index(){
    	$userObj = D('User');
    	$userNum = $userObj -> getCommonUserNum();
    	$companyNum = $userObj -> getCompanyUserNum();
    	$carObj = D('CarHeader');
    	$carHeaderNum = $carObj -> getCarHeaderNum();
    	$orderObj = D('Order');
    	$orderNum = $orderObj -> getOrderNum();
    	//$orderInfoObj = D('OrderInfo');
    	//$orderFee = $orderInfoObj -> getOrderFee();

    	$cwglObj = D('Cwgl');
    	$cwglNum =  $cwglObj -> getCwglNum();
    	$premium = $cwglObj -> getTotalPrem();
    	$maoli = $orderFee - $cwglNum;
    	$this -> assign('userNum',$userNum);
    	$this -> assign('companyNum',$companyNum);
    	$this -> assign('carHeaderNum',$carHeaderNum);
    	$this -> assign('orderNum',$orderNum);
    	$this -> assign('orderFee',$this -> transNum($orderFee));
    	$this -> assign('cwglNum',$this -> transNum($cwglNum));
    	$this -> assign('premium',$this -> transNum($premium));
    	$this -> assign('maoli',$this -> transNum($maoli));
    	
    	$this -> display('Index:index');
    }
    public function transNum($str=''){
        $num = strlen($str);
        if($num>=11){
            $ret = round($str/10000000000,2).'亿';
        }else if($num>=7&&$num<11){
            $ret = round($str/1000000,2).'万';
        }else{
            $ret = ceil($str/100);
        }
        return $ret;
    }
}