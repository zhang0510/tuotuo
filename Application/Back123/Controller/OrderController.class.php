<?php
namespace Back\Controller;
class OrderController extends BaseController{
	//订单列表
	public function orderlist(){
	    $oc = "";
	    $jg = "";
	    $star = I('star');
	    $end = I('end');
	    $order_status = I('get.order_status');
	    print_log("订单---条件---查询:".$order_status);
	    $order = I('get.order');
	    $pay = I('get.pay');
	    $model = D('Area');
	    $omodel = D('Order');
	    $oimodel = D('OrderInfo');
	    if ($order){
	        $map['order_code'] = array('like','%'.$order.'%');//订单号
	        //车辆
	        $mapc['order_info_brand'] = array('like','%'.$order.'%');
	        $cl = $oimodel->getInfo($mapc);
	        if ($cl){
	            foreach ($cl as $v){
	                $oc .= $v['order_code'].',';
	            }
	            $map['order_code'] = array('in',substr($oc, 0,-1));
	        }
	        //线路
	        $xl = $model->getCityName($order);
	        if ($xl){
	            $map1['order_info_star'] = array('like','%'.','.$xl['area_id'].','.'%');
	            $map1['order_info_end'] = array('like','%'.','.$xl['area_id'].','.'%');
	            $map1['_logic'] = 'or';
	            $jieguo = $oimodel->getInfo($map1);
	            if ($jieguo){
	                foreach ($jieguo as $v){
	                    $jg .= $v['order_code'].',';
	                }
	                $map['order_code'] = array('in',substr($jg, 0,-1));
	            }
	        }
	        $map['user_name'] = array('like','%'.$order.'%');//用户名
	        $map['_logic'] = 'or';
	        $where['_complex'] = $map;
	    }
	    if ($order_status){
	        print_log("订单---条判断条件中的件---查询:".$order_status);
	        $where['order_status'] = array('eq',$order_status);
	    }
	    if ($pay){$where['pay_way'] = array('eq',$pay);}
	    if ($star and $end){$where['order_time'] = array('between',array($star,$end));}
	    $where[] = "1=1";
	    print_log("订单条件查询:".json_encode($where));
	    $info = $omodel->getInfo($where);
	    print_log("查询条件:".json_encode($where));
	    //print_log("订单列表:".json_encode($info['list']));
	    foreach ($info['list'] as &$v){
	        if ($v['OrderInfo']!=""){
	            //车品牌
	            $v['brand'] = $v['OrderInfo']['order_info_brand'];
	            //车型
	            $v['type'] = $v['OrderInfo']['order_info_type'];
	            //车牌
	            $v['carmark'] = $v['OrderInfo']['order_info_carmark'];
	            //起始地
	            $st = $model->getOne(explode(',', $v['OrderInfo']['order_info_star'])[1]);
	            $v['star'] = $st['area_name'];
	            //目的地
	            $en = $model->getOne(explode(',', $v['OrderInfo']['order_info_end'])[1]);
	            $v['end'] = $en['area_name'];
	            //总金额
	            $v['price'] = $v['OrderInfo']['order_info_zj'];
	        }else{
	            //车品牌
	            $v['brand'] = "";
	            //车型
	            $v['type'] = "";
	            //车牌
	            $v['carmark'] = "";
	            //起始地
	            $v['star'] = "";
	            //目的地
	            $v['end'] = "";
	            //总金额
	            $v['price'] = "";
	        }
	    }
	    $num['num'] = $omodel->getNum();//总订单数
	    $num['s'] = $omodel->getNum('S');//待审核总订单数
	    $num['a'] = $omodel->getNum('A');//待安排总订单数
	    $num['t'] = $omodel->getNum('T');//待提车总订单数
	    $num['z'] = $omodel->getNum('Z');//待装板总订单数
	    $num['y'] = $omodel->getNum('Y');//运输中总订单数
	    $num['d'] = $omodel->getNum('D');//已到达总订单数
	    $num['w'] = $omodel->getNum('W');//已完成总订单数
	    $num['n'] = $omodel->getNum('N');//未通过审核订单数
	    if(count($info['list'])>0){
	        $this->assign('page',$info['page']);
	    }
	    $this->assign('list',$info['list']);
	    $this->assign('order',$order);
	    $this->assign('pay',$pay);
	    $this->assign('num',$num);
	    $this->assign('order_status',$order_status);
		$this->display('Order:orderlist');
	}
	
	//查看详细订单
	public function orderinfo(){
		$code = I('order_code');
		$this -> assign('code',$code);
		$model = D('Area');
		$omodel = D('Order');
		$info = $omodel->getAll($code);
		//车总价
		$info['price'] = $info['OrderInfo']['order_info_zj']/100;
		//车价
		$info['cj'] = $info['OrderInfo']['order_info_price']/100;
		//接车费
		$info['jc'] = $info['OrderInfo']['order_info_t_car']/100;
		//运车费
		$info['yc'] = $info['OrderInfo']['order_info_c_car']/100;
		//送车价
		$info['sc'] = $info['OrderInfo']['order_info_s_car']/100;
		//毛利
		$info['ml'] = $info['OrderInfo']['order_info_margin']/100;
		//车型加价
		$info['cxjj'] = $info['OrderInfo']['order_info_add_price']/100;
		//保险费
		$info['bx'] = $info['OrderInfo']['order_info_bxd']/100;
		
		//起始省
		$info['p'] = $info['OrderInfo']['order_info_stars'][0];
		//起始市
		$info['c'] = $info['OrderInfo']['order_info_stars'][1];
		//起始区
		$info['b'] = $info['OrderInfo']['order_info_stars'][2];
		//目的地联系信息
		$info['stinfo'] = array_flip(array_flip(explode(',',$info['OrderInfo']['order_info_tclxr'])));
		//目的地省
		$info['pe'] = $info['OrderInfo']['order_info_ends'][0];
		//目的地市
		$info['ce'] = $info['OrderInfo']['order_info_ends'][1];
		//目的地联系信息
		$info['eninfo'] = array_flip(array_flip(explode(',',$info['OrderInfo']['order_info_sclxr'])));
		//提车人信息
		$info['tcr'] = D('CarHeader')->getData($info['CarOrder']['car_code']);
		//车型信息
		$cmodel = D('Carxing');
		$arr = array_flip(array_flip(explode(',',$info['CarOrder']['car_info_pai'])));
		$info['brand'] = $cmodel->getData($arr[0]);
		$info['type'] = $cmodel->getData($arr[1]);
		//分割图片
		$arrimg = array_flip(array_flip(explode(',',substr($info['CarOrder']['car_order_img'], 0,-1))));
		//价格
		foreach ($info['YunDan'] as $v){
			$v['yd_price'] = $v['yd_price']/100;
		}
		$this->assign('stut',$info['CarOrder']['car_info_status']);
		$this->assign('data',$info);
		$this->assign("yundan",$info['YunDan']);
		$this->assign('img',$arrimg);
		$this->assign("times",date("Y-m-d",time()));
		$this->display('Order:orderinfo');
	}
	
	//运单状态更改
	public function yd_status(){
		$code = I('post.code');
		$data['yd_status'] = 'Y';
		$save = D('Yundan')->where(array('yd_code'=>$code))->save($data);
		if ($save){
			$data = '修改成功！';
		} else {
			$data = "已经修改完成，不可再修改！";
		}
		$this->ajaxReturn($data);
	}
	
	//审核处理
	public function audit(){
		$code = I('post.code');
		$textaa = I('post.textaa');
		$sign = I('post.sign');
		if($sign==1){
		      $data['order_status'] = 'A';
		      $data['check_res'] = 'Y';
		}else{
		      $data['order_status'] = 'N';
		      $data['check_res'] = 'N';
		}
		$dataa['order_info_remark'] = $textaa;
		$save = D('Order')->where(array('order_code'=>$code))->save($data);
		$savea = D('OrderInfo')->where(array('order_code'=>$code))->save($dataa);
		$datas['flag'] = false;
		if (!empty($save)){
			$datas['msg'] = '提交成功！';
			$datas['flag'] = true;
		} else {
			$datas = "提交失败！";
			$datas['flag'] = false;
		}
		$this->ajaxReturn($datas);
	}
	
	//安排提车员
	public function tcy(){
		$people = I('post.people');
		$data = D('CarHeader')->getCarTakers($people);
		$this->ajaxReturn($data['info']);
	}
	
	//安排提车员订单
	public function tcy_order(){
	    $baseObj = D('Base');
		$tichecode = $baseObj->getTablecode('T');
		
		$people = I('post.tcyr');
		$coMap['car_code'] = array("eq",$people['car_code']);
		$coMap_xiu['order_code'] = $coMap['order_code'] = array("eq",$people['order_code']);
		$data['flag'] = false;
		$carorObj = M('car_order')->where($coMap_xiu)->find();
		if($carorObj){
			//$data['msg'] = "已经安排过了提车员！";
			//$people['car_info_status'] = 'N';
			$updates['car_order_price'] = $people['car_order_price'];
			$updates['car_code'] = $people['car_code'];
			$updates['car_jc_time'] = $people['car_jc_time'];
			$retddd = M('car_order')->where($coMap_xiu)->save($updates);
			print_log("----提车员修改数据-----:".$retddd);
			if($retddd){
				$carMapf['car_code'] = array("eq",$people['car_code']);
				$CARoBJj = M("car_header");
				$voss = $CARoBJj->where($carMapf)->find();
				$kehum = $people['kehu'];
				$qidianm = $people['qidian'];
				$telm = $people['tel'];
				//$shenfenzheng = $people['shenfenzheng'];
				$zhongdianm = $people['zhongdian'];
				$mesm = "您的【".$kehum."】从【".$qidianm."】到【".$zhongdianm."】托运订单，提车司机【".$voss['car_name']."】身份证号【".$voss['car_identity']."】司机上门后请一定核对司机信息。";
				//print_log("---提车员确定后发送给客户的短信-----".$mes);
				$tresm = $this->tel_SMS($telm,$mesm);
				if($tresm){
					$data['msg'] = "重新安排提车员成功！";
					$data['flag'] = true;
				}else{
					$data['msg'] = "短信发送失败！";
					$data['flag'] = false;
				}
			}else{
				$data['msg'] = "修改提车员失败！";
				$data['flag'] = false;	
			}
			$this->ajaxReturn($data);
		}else{
			$people['car_order_code'] = $tichecode;
			$people['car_info_status'] = 'N';
			$price = I('post.price');
			/* if (empty(D('CarOrder')->queryOrder($people['order_code']))){ */
			    
				if (M('car_order')->add($people)){
				   /*  $this->ajaxReturn(11);
				    die; */
					 /* if (empty(D('Cwgl')->queryOrder($price['order_code']))){  */
						$price['cwgl_code'] = create_random_code(7);
						if (M('cwgl')->add($price)){
						    $datas['car_code'] = $people['car_code'];
						    $datas['order_status'] = 'T';
						    $mapss['order_code'] = $price['order_code'];
						    $obj = M('order');
						    $res = $obj -> where($mapss) -> save($datas);
						    if($res){
								$carMap['car_code'] = array("eq",$people['car_code']);
								$CARoBJ = M("car_header");
								$vos = $CARoBJ->where($carMap)->find();
								$kehu = $people['kehu'];
								$qidian = $people['qidian'];
								$tel = $people['tel'];
								//$shenfenzheng = $people['shenfenzheng'];
								$zhongdian = $people['zhongdian'];
								$mes = "您的【".$kehu."】从【".$qidian."】到【".$zhongdian."】托运订单，提车司机【".$vos['car_name']."】身份证号【".$vos['car_identity']."】司机上门后请一定核对司机信息。";
						        //print_log("---提车员确定后发送给客户的短信-----".$mes);
								$tres = $this->tel_SMS($tel,$mes);
								//print_log("---提车员确定后发送给客户的短信-----短信发送返回值：".$tres);
								if($tres){
									$data['msg'] = "安排成功！";
									$data['flag'] = true;
								}else{
									$data['msg'] = "短信发送失败！";
									$data['flag'] = false;
								}
								
						    }else{
						        $data['msg'] = "安排失败，请重新安排！";
						    }
							
						} else {
							$data['msg'] = "安排失败，请从新安排2！";
						}
					/* } else {
						if (D('Cwgl')->where(array('order_code'=>$price['order_code']))->save($price)){
							$data = "安排成功！";
						} else {
							$data = "安排失败，请从新安排功！";
						}
					} */
				} else {
					$data['msg'] = "安排失败，请从新安排3！";
				}
			/* } else {
				$data = "已经安排过了提车员！";
			}	 */	
			$this->ajaxReturn($data);
			
		}
	}
	//发送短信验证码
    public function tel_SMS($tel="",$mes=""){
        //$tel = remove_xss(I("tel"));
        //$rand_num = mt_rand(1000, 9999);
        //$mes = "您的@从@到@托运订单，提车司机@-@身份证号@司机上门后请一定核对司机信息。";
        //$result['code'] = $rand_num;
		//print_log( "------短信发送------");
        $rets = send_mobile_sms($tel,$mes);
		
		print_log( "短信发送获取返回值：".json_encode($rets));
        if($rets['status']==0){
        	return true;
        }else{
        	return false;
        }
        
    }
	//确认提车
	public function ticar(){
		$code = I('post.code');
		$data['order_status'] = 'Z';
		$save = M('order')->where(array('order_code'=>$code))->save($data);
		if ($save){
			$data = '确认成功！';
		} else {
			$data = "确认失败！";
		}
		$this->ajaxReturn($data);		
	}
	
	//修改价格
	public function xgjg(){
		$code = I('post.code');
		$price = I('post.price');
		//$data['cwgl_price'] = $price;原代码
		//$save = D('Cwgl')->where(array('order_code'=>$code))->save($data);原代码
		$data['order_info_zj'] = $price*100;
		$save = M('order_info')->where(array('order_code'=>$code))->save($data);
		if ($save){			
			$res = D('Order')->geLog('总价',$price);
			if($res){
			    $data = '修改成功！';
			}else{
			    $data = '写入日志失败！';
			}
		} else {
			$data = "修改失败！";
		}
		$this->ajaxReturn($data);
	}
	
	//确认到达
	public function qrdd(){
		$code = I('post.code');
		$data['order_status'] = 'D';
		$save = D('Order')->where(array('order_code'=>$code))->save($data);
		if ($save){
			$data = '确认成功！';
		} else {
			$data = "确认失败！";
		}
		$this->ajaxReturn($data);
	}
	
	//确认完成
	public function qrwc(){
		$code = I('post.code');
		$data['order_status'] = 'W';
		$save = D('Order')->where(array('order_code'=>$code))->save($data);
		if ($save){
			$data = '确认成功！';
		} else {
			$data = "确认失败！";
		}
		$this->ajaxReturn($data);
	}
	
	//添加运单
	public function addyd(){
		$baseObj = D('Base');
		$yuncode = $baseObj->getTablecode('Y');
		$data = I('post.data');
		$data['yd_company'] = I('post.yd_company');
		$data['yd_carmark'] = I('post.yd_carmark');
		$data['yd_price'] = $data['price']*100;
		$data['yd_code']	=	$yuncode;
		$data['yd_time'] = date('Y-m-d',time());
		print_log("添加运单：".json_encode($data));
		$y_Obj = D("Yundan");
        $myList = $y_Obj -> addYunDan($data);
		if ($myList){
			$flag['order_status'] = 'Y';
			M('Order')->where(array('order_code'=>$data['order_code']))->save($flag);
			$data['info'] = '添加成功！';
		} else {
			$data['info'] = "添加失败！";
		}
		$this->ajaxReturn($data);
	}
	
	//添加物流
	function addwl(){
		$data = I('aarr');
		$data['wl_time'] = date("Y-m-d H:i:s");
		$dzb = I('dzb');
		$data['wl_code']	=	create_random_code(7);		
		$add = M('Wuliu')->add($data);
		if ($add){
			$flag['order_status'] = $dzb;
			if ($dzb) 
				M('Order')->where(array('order_code'=>$data['order_code']))->save($flag);
			$data['info'] = '添加成功！';
		} else {
			$data['info'] = "添加失败！";
		}
		$this->ajaxReturn($data);		
	}
	
	//发送短信
function sms(){
	    $masObj = D('Worklwt');
		$code = I('code');
		$q = I('q');
		$z = I("z");
		$map['wl_code'] = array('eq',$code);
		$wl = M("wuliu")->where($map)->find();
		$maps['order_code'] = array('eq',$wl['order_code']);
		$or = M("order")->where($maps)->find();
		$map_1['user_code'] = array('eq',$or['user_code']);
		$us = M("user")->where($map_1)->find();
		$str = $us['user_name'].'您好，您的爱车从'.$q.'到'.$z.'托运订单'.$or['order_code'].'已到达'.$wl['wl_info'].'，祝您生活愉快。';
		$rets = send_mobile_sms($us['tel'],$str);
		$msg['flag'] = false;
		//print_log("----------------------------".json_encode($rets));
		if($rets['status']==0){
		    //发送微信通知
		    if($us['opid']!="" && $us['opid']!=null){
		        $opid = $us['opid'];
		        $access_token = $this->getAccsenToken();
		        print_log("----------------------------------token:".$access_token);
		        $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$access_token;
		        $data['template_id'] = "nGWNfdGnTC5K20rsqZMVaIBJjI-8M_8tNZ0hvUMYH_w";//消息模板id
		        $data['touser'] = $opid;
		        //print_log('opid~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~'.$opid);
		        $title = '物流信息';
		        $data['data'] = array(
		            'first'=>array("value"=>$title,"color"=>"#173177"),
		            'productInfo'=>array("value"=>'一份微信物流',"color"=>"#173177"),
		            'orderNumber'=>array("value"=>$or['order_code'],"color"=>"#173177"),
		            'status'=>array("value"=>$wl['wl_info'],"color"=>"#173177"),
		            'remark'=>array("value"=>"微信物流将持续为您推送物流状态变化通知，感谢您的支持。","color"=>"#173177")
		        );
		        $resi = $this -> curlPost($url,json_encode($data));
		        print_log("-------------------------------".$resi);
		    }
		    $msg['msg']="短信发送成功";
		    $msg['flag'] = true;
		}else{
		    $msg['msg']="短信发送失败";
		}
		$this->ajaxReturn($msg);
	}
	
	//上传保险单
	function bxd(){
		$data = I('data');
		$data['bxd_time'] = date("Y-m-d H:i:s",time());
		$model = M('bxd');
		if ($model->where(array('order_code'=>$data['order_code']))->find()){
			$save = $model->where(array('order_code'=>$data['order_code']))->save($data);
			if ($save){
				$info = '修改成功！';
			} else {
				$info = "修改失败！";
			}
		} else {
			$data['bxd_code'] = create_random_code(7);
			$add = $model->add($data);
			if ($add){
				$info = '上传成功！';
			} else {
				$info = "上传失败！";
			}
		}		
		$this->ajaxReturn($info);
	}
	
	//删除订单
	function orderdel(){
		$code = I('post.code');
		$where['order_code'] = $code;
		$del = M('order')->where($where)->delete();
		if ($del){
			if (M('orderInfo')->where($where)->delete()){
				$data = '删除成功';
			} else {
				$data = '删除失败';
			}
		} else {
			$data = '删除失败';
		}
		$this->ajaxReturn($data);
	}
	
	//订单修改
	function orderset(){
		$this->display();
	}
	/**
	 * curl Post请求
	 * @param unknown $url
	 * @param unknown $post
	 * @return mixed
	 */
	function curlPost($url,$post){
	    $ch = curl_init();
	    curl_setopt($ch,CURLOPT_URL,$url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_HEADER, false);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	    curl_setopt($ch, CURLOPT_POST,true);
	    curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
	
	    $returnInfo = curl_exec($ch);
	    curl_close ($ch);
	    return $returnInfo;
	}
	/**
	 * 确认用户已提车
	 * @date: 2016-10-12 上午11:44:31
	 * @author: liuxin
	 */
	public function confirmUC(){
	    $map['order_code'] = array('eq',I('code'));
	    $data['finish_time'] = date('Y-m-d H:i:s',time());
	    $data['order_status'] = 'W';
	    $res = M('order') -> where($map) -> save($data);
	    if($res){
	        $res = 'S';
	    }else{
	        $res = 'F';
	    }
	    $this -> ajaxReturn($res);
	}
	
	/**
	 * 确认装板
	 * @date: 2016-10-12 上午11:44:31
	 * @author: liuxin
	 */
	public function confirmZB(){
	    $map['order_code'] = array('eq',I('code'));
	    $data['order_status'] = 'Y';
	    $res = M('order') -> where($map) -> save($data);
	    if($res){
	        $res = 'S';
	    }else{
	        $res = 'F';
	    }
	    $this -> ajaxReturn($res);
	}
	
	/**
	 * 确认到达
	 * @date: 2016-10-12 上午11:44:31
	 * @author: liuxin
	 */
	public function confirmDD(){
	    $map['order_code'] = array('eq',I('code'));
	    $data['order_status'] = 'D';
	    $res = M('order') -> where($map) -> save($data);
	    if($res){
	        $res = 'S';
	    }else{
	        $res = 'F';
	    }
	    $this -> ajaxReturn($res);
	}
	
	
	
}