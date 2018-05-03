<?php
namespace Back\Controller;
class ProductController extends BaseController{
	//区域管理
	public function area(){
		$provinceaa = I('provincea');
		$citya = I('city');
		$county = I('county');
		$model = D('Area');
		if ($provinceaa)
		$pval = $model->getOne($provinceaa);
		$pval['pid'] = $provinceaa;
		if ($citya)
		$cval = $model->getOne($citya);
		$cval['cid'] = $citya;
		if ($county)
		$coval = $model->getOne($county);
		$coval['cid'] = $county;
		if(!($provinceaa!=''&&$citya=='')||($provinceaa==''&&$citya!='')){
        	if($citya==''&&$county==''){
        	    $info = $model->getAreaInfo();
        	}else if($citya!=''&&$county==''){
        	    $info = $model->getAreaInfo($citya);
        	}
        	if($county!=''){
        	    $info = $model->getAreaInfo($county,1);
        	}
		}else{
		    $info = $model->getAreaInfo();
		}
		//$info = $model->getInfo(3,$county);
		foreach ($info['list'] as &$v){
			$city = D('Area')->getData($v['area_pid']);
			$v['city'] =  $city['area_name'];
			$v['area_set'] = $city['area_set'];
			$province = D('Area')->getData($city['area_pid']);
			$v['province'] = $province['area_name'];
			
		}
		//获取所有省级
		$provincea = $model->getArea(1);
		$this->assign('pval',$pval);
		$this->assign('cval',$cval);
		$this->assign('coval',$coval);
		$this->assign('provincea',$provincea);
		$this->assign('list',$info['list']);
		$this->assign('page',$info['page']);
		$this -> assign('sec','area');
		$this->display('Product:area');
	}
	//修改区域可到达 可提车 状态
	public function changeStatus(){
	    $id=I("id");
	    $status=I("status");
	    $lev=I("lev");
	    $where['area_id']=$id;
	    if($lev==1){
	        $data['area_set']=$status;
	    }else{
	        $data['area_get']=$status;
	    }
	    $res=M("area")->where($where)->save($data);
	    if($res){
	        $this->ajaxReturn("修改成功");
	    }else{
	        $this->ajaxReturn("修改失败");
	    }
	}
	//添加省
	public function areaadd(){
		$model = D('Area');
		$province = I('post.sheng');
		$p = $model->getAreaName($province);
		if ($p){
			$res['status'] = 'N';
			$res['info'] = '省已经存在,请从新添加！';
		} else {
			$data = array(
					'area_name'=>$province,
					'area_pid'=>0,
					'area_type'=>'1',
					'area_add_time'=>date('Y-m-d H:i:s',time()),
			);
			if ($model->add($data)){
				$res['status'] = 'Y';
				$res['info'] = '添加成功！';
			} else {
				$res['status'] = 'N';
				$res['info'] = '添加失败,请从新添加！';
			}
		}
		$this->ajaxReturn($res);
	}
	/**
	 * 导入
	 */
	function daoRuArea(){
		$areaObj = M("area");
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
    			for($currentRow=3;$currentRow<=$allRow;$currentRow++){
    				$cid = $currentSheet->getCell("A".$currentRow)->getValue();
    				$v['area_id'] =  $cid!="" && $cid!=null && is_object($cid) ? $cid->__toString():$cid;
    				
    				$type_pid_ = $currentSheet->getCell('B'.$currentRow)->getValue();
    				$v["area_name"]= $type_pid_!="" && $type_pid_!=null && is_object($type_pid_) ? $type_pid_->__toString():$type_pid_;
    				
    	
    				$type_id_ = $currentSheet->getCell('C'.$currentRow)->getValue();
    				$v['area_pid']=$type_id_!="" && $type_id_!=null && is_object($type_id_) ? $type_id_->__toString():$type_id_;
    	
    	
    				$description_ = $currentSheet->getCell('D'.$currentRow)->getValue();
    				$v['area_type']= $description_!="" && $description_!=null && is_object($description_) ? $description_->__toString():$description_;
    				
    				$set_ = $currentSheet->getCell('E'.$currentRow)->getValue();
    				$set_ = $set_ == '是' ? 'Y' : 'N';
    				$v['area_set']= $set_!="" && $set_!=null && is_object($set_) ? $set_->__toString():$set_;
    				
    				$get_ = $currentSheet->getCell('F'.$currentRow)->getValue();
    				$get_ = $get_ == '是' ? 'Y' : 'N';
    				$v['area_get']= $get_!="" && $get_!=null && is_object($get_) ? $get_->__toString():$get_;
    				
    				$v['area_add_time'] = $datatime;
    				$map = null;
    				if($v['area_id']!=""){
    					$map['area_id'] = array("eq",$v['area_id']);
    				}
    				$vo=null;
    				if($map!=null){
    					$vo = $areaObj->where($map)->find();
    				}
    				if($vo!=null&&count($vo)>0){
    					$map_['area_id'] = array("eq",$vo['area_id']);
    					$res = $areaObj ->where($map_)->save($v);
    				}else{
    					$res = $areaObj->add($v);
    				}
    			}
    			@unlink ($savePath.$file_name);
    			$this->success("导入成功");
    		}else{
    			$this->error ( '不是Excel文件，重新上传' );
    		}
	    }
	}
	//添加市
	public function areaaddcity(){
		$province = I('post.sheng');
		$city = I('post.shi');
		$model = D('Area');
		$p = $model->getAreaName($city);
		if ($p){
			$res['status'] = 'N';
			$res['info'] = '市已经存在,请从新添加！';
		} else {
			$data = array(
					'area_name'=>$city,
					'area_pid'=>$province,
					'area_type'=>'2',
					'area_add_time'=>date('Y-m-d H:i:s',time()),
			);
			if ($model->add($data)){
				$res['status'] = 'Y';
				$res['info'] = '添加成功！';
			} else {
				$res['status'] = 'N';
				$res['info'] = '添加失败,请从新添加！';
			}
		}
		$this->ajaxReturn($res);
	}
	
	//添加区
	public function areaaddcounty(){
		$city = I('post.shi');
		$county = I('post.xian');
		$area_id = I('post.area_id');
		$model = D('Area');
		$p = $model->getAreaName($county);
		/*
		if (!empty($p)){
			$res['status'] = 'N';
			$res['info'] = '区县已经存在,请从新添加！';
		} else {
			*/
			$data = array(
					'area_name'=>$county,
					'area_pid'=>$city,
					'area_type'=>'3',
			);
			if ($area_id){
				if ($model->where(array('area_id'=>$area_id))->save($data)){
					$res['status'] = 'Y';
					$res['info'] = '修改成功！';
				} else {
					$res['status'] = 'N';
					$res['info'] = '修改失败,请从新添加！';
				}
			} else {
				$data['area_add_time'] = date('Y-m-d H:i:s',time());
				if ($model->add($data)){
					$res['status'] = 'Y';
					$res['info'] = '添加成功！';
				} else {
					$res['status'] = 'N';
					$res['info'] = '添加失败,请从新添加！';
				}
			}			
		//}
		$this->ajaxReturn($res);
	}
	
	//删除处理
	public function areadel(){
		$did = I('post.did');
		$where['area_id'] = $did;
		$del = M('Area')->where($where)->delete();
		if ($del){
			$data = '删除成功';
		} else {
			$data = '删除失败';
		}
		$this->ajaxReturn($data);
	}
	
	
	//集散地管理
	public function bulk(){
	    $linemodel = D('LineSan');
		$provinceaa = I('provincea');
		$citya = I('city');
		
		$provinceaa1 = I('e_provincea');
		$citya1 = I('e_city');
		
		$model = D('Area');
		if ($provinceaa)
		$pval = $model->getOne($provinceaa);
		$pval['pid'] = $provinceaa;
		if ($citya)
		$cval = $model->getOne($citya);
		$cval['cid'] = $citya;
		if ($provinceaa1)
		    $pval1 = $model->getOne($provinceaa1);
		$pval1['pid'] = $provinceaa1;
		if ($citya1)
		    $cval1 = $model->getOne($citya1);
		$cval1['cid'] = $citya1;
		/* if ($provinceaa and $citya)
		$star = $provinceaa.','.$citya; */
		if($provinceaa!='f'&&$citya == 'f'){
		    $star = $provinceaa;
		}else if($provinceaa=='f'&&$citya == 'f'){
		    $star = '';
		}else if($provinceaa!='f'&&$citya != 'f'){
		    $star = $provinceaa.','.$citya;
		}
		
		if($provinceaa1!='f'&&$citya1 == 'f'){
		    $end = $provinceaa1;
		}else if($provinceaa1=='f'&&$citya1 == 'f'){
		    $end = '';
		}else if($provinceaa1!='f'&&$citya1 != 'f'){
		    $end = $provinceaa1.','.$citya1;
		}
		
		$info = $linemodel->getPages($star,1,$end);
		
		//获取所有省级
		$provincea = $model->getArea(1);
		
		//$info = $linemodel->getPage($star);
		foreach ($info['list'] as &$v){
			//拆分逗号拼接的地区
			$arr = array_flip(array_flip(explode(',',$v['san_star'])));
			$psn = $model->getOne($arr['0']);
			$v['p_s_name'] = $psn['area_name'];
			$csn = $model->getOne($arr['1']);
			$v['c_s_name'] = $csn['area_name'];
			$newarr = array_flip(array_flip(explode(',',$v['san_end'])));
			$pen = $model->getOne($newarr['0']);
			$v['p_e_name'] = $pen['area_name'];
			$cen = $model->getOne($newarr['1']);
			$v['c_e_name'] = $cen['area_name'];
		}
		//获取所有省级
		$provincea = $model->getArea(1);
		$this->assign('list',$info['list']);
		$this->assign('page',$info['page']);
		$this->assign('provincea',$provincea);
		$this->assign('pval',$pval);
		$this->assign('cval',$cval);
		$this->assign('pval1',$pval1);
		$this->assign('cval1',$cval1);
		$this->assign('coval',$coval['area_name']);
		$this->assign('sec','bulk');
		$this->display('Product:bulk');
	}
	
	//添加集散地
	public function bulkadd(){
		$model = D('LineSan');
		$sprovince = I('post.sprovince');
		$scity = I('post.scity');
		$eprovince = I('post.eprovince');
		$ecity = I('post.ecity');
		$price = I('post.price');
		$san_code = I('post.san_code');
		$star = $sprovince.','.$scity;
		$end = $eprovince.','.$ecity;
		$data = array(
				'san_star'	=>	$star,
				'san_end'	=>	$end,
				'san_price'	=>	$price*100,
		);
		if ($san_code){
			if ($model->where(array('san_code'=>$san_code))->save($data)){
				$res['status'] = 'Y';
				$res['info'] = '修改成功！';
			} else {
				$res['status'] = 'Y';
				$res['info'] = '修改失败！';
			}
		} else {
			$res = $model->verify($star,$end);
			if ($res){
				$res['status'] = 'N';
				$res['info'] = '集散地已经存在了！';
			} else {
				$data['san_code'] = create_random_code(7);
				$data['san_time'] = date('Y-m-d H:i:s',time());
				if ($model->add($data)){
					$res['status'] = 'Y';
					$res['info'] = '添加成功！';
				} else {
					$res['status'] = 'N';
					$res['info'] = '添加失败！';
				}
			}
		}
		$this->ajaxReturn($res);
	}
	
	//集散地删除处理
	public function bulkdel(){
		$code = I('post.code');
		$where['san_code'] = $code;
		$del = M('LineSan')->where($where)->delete();
		if ($del){
			$data = '删除成功';
		} else {
			$data = '删除失败';
		}
		$this->ajaxReturn($data);
	}
	
	
	//出发地管理
	public function star(){
		$provinceaa = I('provincea');
		$citya = I('city');
		$county = I('county');
		$model = D('Area');
		if ($provinceaa)
		$pval = $model->getOne($provinceaa);
		$pval['pid'] = $provinceaa;
		if ($citya)
		$cval = $model->getOne($citya);
		$cval['cid'] = $citya;
		if ($county)
		$tval = $model->getOne($county);
		$tval['cid'] = $county;
		if ($provinceaa && $citya && $county)
		//$star = $provinceaa.','.$citya.','.$county;
		//获取所有省级
		$provincea = $model->getArea(1);
		$starmodel = D('Ti');
		if($provinceaa!='f'&&$citya == 'f'){
		    $star = $provinceaa;
		    $info = $starmodel->getPages($star,1);
		}else if($provinceaa=='f'&&$citya == 'f'){
		    $star = '';
		    $info = $starmodel->getPages($star,1);
		}else if($provinceaa!='f'&&$citya != 'f' && $county!="f"){
		    $star = $provinceaa.','.$citya.','.$county;
		    $info = $starmodel->getPages($star);
		}else if($provinceaa!='f'&&$citya != 'f' && $county=="f"){
            $star = $provinceaa.','.$citya;
            $info = $starmodel->getPages($star,1);
        }
		//$info = $starmodel->getPage($star);
		foreach ($info['list'] as &$v){
			//拆分逗号拼接的地区
			$arr = array_flip(array_flip(explode(',',$v['ti_star'])));
			$psn = $model->getOne($arr['0']);
			$v['p_s_name'] = $psn['area_name'];
			$csn = $model->getOne($arr['1']);
			$v['c_s_name'] = $csn['area_name'];
			$cosn = $model->getOne($arr['2']);
			$v['co_s_name'] = $cosn['area_name'];
			$newarr = array_flip(array_flip(explode(',',$v['ti_end'])));
			$pen = $model->getOne($newarr['0']);
			$v['p_e_name'] = $pen['area_name'];
			$cen = $model->getOne($newarr['1']);
			$v['c_e_name'] = $cen['area_name'];
			$v['ti_driver_price'] = $v['ti_driver_price']/100;
			$v['ti_platelets_price'] = $v['ti_platelets_price']/100;
		}
		$this->assign('list',$info['list']);
		$this->assign('page',$info['page']);
		$this->assign('provincea',$provincea);
		$this->assign('pval',$pval);
		$this->assign('cval',$cval);
		$this->assign('tval',$tval);
		$this->assign('coval',$coval['area_name']);
		$this -> assign('sec','star');
		$this->display('Product:star');
	}
	
	//出发地添加
	public function staradd(){
		$model = D('Ti');
		$sprovince = I('post.sprovince');
		$scity = I('post.scity');
		$scounty = I('post.scounty');
		$eprovince = I('post.eprovince');
		$ecity = I('post.ecity');
		$ti_driver_price = I('post.ti_driver_price');
		$ti_platelets_price = I('post.ti_platelets_price');
		$ti_code = I('post.ti_code');
		$star = $sprovince.','.$scity.','.$scounty;
		$end = $eprovince.','.$ecity;
// 		if (empty($sprovince)){
// 			$this->error('起始省不能为空！','star');
// 		} elseif (empty($scity)) {
// 			$this->error('起始市不能为空！','star');
// 		} elseif (empty($scounty)){
// 			$this->error('起始区不能为空！','star');
// 		} elseif (empty($eprovince)){
// 			$this->error('目的地省不能为空！','star');
// 		} elseif (empty($ecity)){
// 			$this->error('目的地市不能为空！','star');
// 		} elseif (empty($price) or !is_numeric($price)){
// 			$this->error('价格错误！','star');
// 		}
		$data = array(
				'ti_star'	=>	$star,
				'ti_end'	=>	$end,
				'ti_driver_price'	=>	$ti_driver_price*100,
				'ti_platelets_price'	=>	$ti_platelets_price*100,
		);
		if ($ti_code){
			if ($model->where(array('ti_code'=>$ti_code))->save($data)){
				$res['status'] = 'Y';
				$res['info'] = '修改成功！';
			} else {
				$res['status'] = 'N';
				$res['info'] = '修改失败！';
			}
		} else {
			$res = $model->verify($star,$end);
			if ($res){
				$res['status'] = 'N';
				$res['info'] = '集散地已经存在！';
			} else {
				$data['ti_code'] = create_random_code(7);
				if ($model->add($data)){
					$res['status'] = 'Y';
					$res['info'] = '添加成功！';
				} else {
					$res['status'] = 'N';
					$res['info'] = '添加失败！';
				}
			}
		}
		$this->ajaxReturn($res);
	}
	
	//出发地删除处理
	public function stardel(){
		$code = I('post.code');
		$where['ti_code'] = $code;
		$del = M('Ti')->where($where)->delete();
		if ($del){
			$data = '删除成功';
		} else {
			$data = '删除失败';
		}
		$this->ajaxReturn($data);
	}
	
	
	//送车地管理
	public function end(){
		$provinceaa = I('provincea');
		$citya = I('city');
		$this->assign('pro',$provinceaa);
		$this->assign('city',$citya);
		$county = I('county');
		$model = D('Area');
		if ($provinceaa)
		$pval = $model->getOne($provinceaa);
		if ($citya)
		$cval = $model->getOne($citya);
		if ($provinceaa and $citya)
		$end = $provinceaa.','.$citya;
		//获取所有省级
		$provincea = $model->getArea(1);
		$starmodel = D('Song');
		if($provinceaa!='f'&&$citya == 'f'){
		    $star = $provinceaa;
		    $info = $starmodel->getPages($star,1);
		}else if($provinceaa=='f'&&$citya == 'f'){
		    $star = '';
		    $info = $starmodel->getPages($star,1);
		}else if($provinceaa!='f'&&$citya != 'f'){
		    $star = $provinceaa.','.$citya;
		    $info = $starmodel->getPages($star);
		}
		//$info = $starmodel->getPage($end);
		foreach ($info['list'] as &$v){
			//拆分逗号拼接的地区
			$arr = array_flip(array_flip(explode(',',$v['song_star'])));
			$psn = $model->getOne($arr['0']);
			$v['p_s_name'] = $psn['area_name'];
			$csn = $model->getOne($arr['1']);
			$v['c_s_name'] = $csn['area_name'];
			$newarr = array_flip(array_flip(explode(',',$v['song_end'])));
			$pen = $model->getOne($newarr['0']);
			$v['p_e_name'] = $pen['area_name'];
			$cen = $model->getOne($newarr['1']);
			$v['c_e_name'] = $cen['area_name'];
			$v['song_driver_price'] = $v['song_driver_price']/100;
			$v['song_platelets_price'] = $v['song_platelets_price']/100;
		}
		$this->assign('list',$info['list']);
		$this->assign('page',$info['page']);
		$this->assign('provincea',$provincea);
		$this->assign('pval',$pval['area_name']);
		$this->assign('cval',$cval['area_name']);
		$this->assign('coval',$coval['area_name']);	
		$this -> assign('sec','end');
		$this->display('Product:end');
	}
	
	//送车地添加
	public function endadd(){
		$model = D('Song');
		$sprovince = I('post.sprovince');
		$scity = I('post.scity');
		$eprovince = I('post.eprovince');
		$ecity = I('post.ecity');
		$song_driver_price = I('post.song_driver_price');
		$song_platelets_price = I('post.song_platelets_price');
		$song_code = I('post.song_code');
		$star = $sprovince.','.$scity;
		$end = $eprovince.','.$ecity;
// 		if (empty($sprovince)){
// 			$this->error('起始省不能为空！','end');
// 		} elseif (empty($scity)) {
// 			$this->error('起始市不能为空！','star');
// 		} elseif (empty($eprovince)){
// 			$this->error('目的地省不能为空！','end');
// 		} elseif (empty($ecity)){
// 			$this->error('目的地市不能为空！','end');
// 		} elseif (empty($price) or !is_numeric($price)){
// 			$this->error('价格错误！','end');
// 		}
		$data = array(
				'song_star'	=>	$star,
				'song_end'	=>	$end,
				'song_driver_price'	=>	$song_driver_price*100,
				'song_platelets_price'	=>	$song_platelets_price*100,
		);
		if ($song_code){
			if ($model->where(array('song_code'=>$song_code))->save($data)){
				$res['status'] = 'Y';
				$res['info'] = '修改成功！';
			} else {
				$res['status'] = 'N';
				$res['info'] = '添加失败！';
			}
		} else {
			$res = $model->verify($star,$end);
			if ($res){
				$res['status'] = 'N';
				$res['info'] = '集散地已经存在！';
			} else {
				$data['song_code'] = create_random_code(7);
				if ($model->add($data)){
					$res['status'] = 'Y';
					$res['info'] = '添加成功！';
				} else {
					$res['status'] = 'N';
					$res['info'] = '添加失败！';
				}
			}
		}
		$this->ajaxReturn($res);
	}
	
	//送车地删除处理
	public function enddel(){
		$code = I('post.code');
		$where['song_code'] = $code;
		$del = M('Song')->where($where)->delete();
		if ($del){
			$data = '删除成功';
		} else {
			$data = '删除失败';
		}
		$this->ajaxReturn($data);
	}
	
	
	//上门送车地管理
	public function visitend(){
	    $linemodel = D('Sm');
		$provinceaa = I('provincea');
		$citya = I('city');
		$county = I('county');
		$this->assign('pro',$provinceaa);
		$this->assign('city',$citya);
		$this->assign('cou',$county);
		$model = D('Area');
		if ($provinceaa)
		$pval = $model->getOne($provinceaa);
		if ($citya)
		$cval = $model->getOne($citya);
		if ($county)
		$coval = $model->getOne($county);
		/* if ($provinceaa and $citya and $county)
		$end = $provinceaa.','.$citya.','.$county; */
		//dump($pval);
		if($provinceaa!='f'&&$citya=='f'&&$county=='f'){
		    $end = $provinceaa;
		    $info = $linemodel->getPages($end,1);
		}else if($provinceaa!='f'&&$citya!='f'&&$county=='f'){
		    $end = $provinceaa.','.$citya;
		    $info = $linemodel->getPages($end,1);
		}else if($provinceaa!='f'&&$citya!='f'&&$county!='f'){
		    $end = $provinceaa.','.$citya.','.$county;
		    $info = $linemodel->getPages($end);
		}else if($provinceaa=='f'&&$citya=='f'&&$county=='f'){
		    $end = '';
		    $info = $linemodel->getPages($end,1);
		}
		
		
		//获取所有省级
		$provincea = $model->getArea(1);
		
		
		//$info = $linemodel->getPage($end);
		foreach ($info['list'] as &$v){
			//拆分逗号拼接的地区
			$arr = array_flip(array_flip(explode(',',$v['sm_star'])));
			$psn = $model->getOne($arr['0']);
			$v['p_s_name'] = $psn['area_name'];
			$csn = $model->getOne($arr['1']);
			$v['c_s_name'] = $csn['area_name'];
			$newarr = array_flip(array_flip(explode(',',$v['sm_end'])));
			$pen = $model->getOne($newarr['0']);
			$v['p_e_name'] = $pen['area_name'];
			$cen = $model->getOne($newarr['1']);
			$v['c_e_name'] = $cen['area_name'];
			$coen = $model->getOne($newarr['2']);
			$v['co_e_name'] = $coen['area_name'];
			$v['sm_driver_price'] = $v['sm_driver_price']/100;
			$v['sm_platelets_price'] = $v['sm_platelets_price']/100;
		}
		$this->assign('list',$info['list']);
		$this->assign('page',$info['page']);
		$this->assign('provincea',$provincea);
		$this->assign('pval',$pval['area_name']);
		$this->assign('pvals',$pval);
		$this->assign('cvals',$cval);
		$this->assign('covals',$coval);
		$this->assign('cval',$cval['area_name']);
		$this->assign('coval',$coval['area_name']);
		$this -> assign('sec','visitend');
		$this->display('Product:visitend');
	}
	
	//上门送车添加
	public function visitendadd(){
		$model = D('Sm');
		$sprovince = I('post.sprovince');
		$scity = I('post.scity');
		$eprovince = I('post.eprovince');
		$ecity = I('post.ecity');
		$ecounty = I('post.ecounty');
		$sm_driver_price = I('post.sm_driver_price');
		$sm_platelets_price = I('post.sm_platelets_price');
		$price = I('post.price');
		$sm_code = I('post.sm_code');
		$star = $sprovince.','.$scity;
		$end = $eprovince.','.$ecity.','.$ecounty;
// 		if (empty($sprovince)){
// 			$this->error('起始省不能为空！','visitend');
// 		} elseif (empty($scity)) {
// 			$this->error('起始市不能为空！','visitend');
// 		}elseif (empty($eprovince)){
// 			$this->error('目的地省不能为空！','visitend');
// 		} elseif (empty($ecity)){
// 			$this->error('目的地市不能为空！','visitend');
// 		} elseif (empty($ecounty)){
// 			$this->error('目的地区不能为空！','visitend');
// 		}  elseif (empty($price) or !is_numeric($price)){
// 			$this->error('价格错误！','visitend');
// 		}
		$data = array(
				'sm_star'	=>	$star,
				'sm_end'	=>	$end,
				'sm_driver_price'	=>	$sm_driver_price*100,
				'sm_platelets_price'	=>	$sm_platelets_price*100,
		);
		if ($sm_code){
			if ($model->where(array('sm_code'=>$sm_code))->save($data)){
				$res['status'] = 'Y';
				$res['info'] = '修改成功！';
			} else {
				$res['status'] = 'N';
				$res['info'] = '修改失败！';
			}
		} else {
			$res = $model->verify($star,$end);
			if ($res){
				$res['status'] = 'N';
				$res['info'] = '上门送车地已经存在！';
			} else {
				$data['sm_code'] = create_random_code(7);
				if ($model->add($data)){
					$res['status'] = 'Y';
					$res['info'] = '添加成功！';
				} else {
					$res['status'] = 'N';
					$res['info'] = '添加失败！';
				}
			}
		}
		$this->ajaxReturn($res);
	}
	
	//上门送车地删除处理
	public function visitenddel(){
		$code = I('post.code');
		$where['sm_code'] = $code;
		$del = M('Sm')->where($where)->delete();
		$a = M('Sm')->getLastSql();
		if ($del){
			$data = '删除成功';
		} else {
			$data = '删除失败';
		}
		$this->ajaxReturn($data);
	}
	
	
	//产品线拼装
	public function product_line(){
	    $lmodel = D('Line');
		//$huodong = I('get.huodong');
		$provinceaa = I('provincea');
		//dump($provinceaa);
		$citya = I('city');
		$e_provinceaa = I('e_provincea');
		//dump($provinceaa);
		$e_citya = I('e_city');
		//dump($citya);
		//$county = I('county');
		/* if ($huodong) $where['line_status'] = $huodong;
		if (!empty($provinceaa) and !empty($citya) and !empty($county))
			$where['line_star'] = $provinceaa.','.$citya.','.$county; */
		//$map['line_status'] = array('eq',$huodong);
	    if($provinceaa!='f'&&$citya=='f'){
		    $map['line_star'] = array('like',$provinceaa.'%');
		   
		}else if($provinceaa!='f'&&$citya!='f'){
		    $map['line_star'] = array('like',$provinceaa.','.$citya.'%');
		    //$end = $provinceaa.','.$citya;
		   
		}
		
		if($e_provinceaa!='f'&&$e_citya=='f'){
		    $map['line_end'] = array('like',$e_provinceaa.'%');
		     
		}else if($e_provinceaa!='f'&&$e_citya!='f'){
		    $map['line_end'] = array('like',$e_provinceaa.','.$e_citya.'%');
		    //$end = $provinceaa.','.$citya;
				 
		}
		if($provinceaa=='f'&&$citya=='f'&&$e_provinceaa=='f'&&$e_citya=='f'){
		    $info = $lmodel->getPages();
		}else{
		    $info = $lmodel->getPages($map);
		}
		$model = D('Area');
		
		//$info = $lmodel->getPage($where);
		foreach ($info['list'] as &$v){
			//拆分逗号拼接的地区
			$arr = array_flip(array_flip(explode(',',$v['line_star'])));
			$psn = $model->getOne($arr['0']);
			$v['p_s_name'] = $psn['area_name'];
			$csn = $model->getOne($arr['1']);
			$v['c_s_name'] = $csn['area_name'];
			//$cosn = $model->getOne($arr['2']);
			//$v['co_s_name'] = $cosn['area_name'];
			$newarr = array_flip(array_flip(explode(',',$v['line_end'])));
			$pen = $model->getOne($newarr['0']);
			$v['p_e_name'] = $pen['area_name'];
			$cen = $model->getOne($newarr['1']);
			$v['c_e_name'] = $cen['area_name'];
		}
		//获取所有省级
		$provincea = $model->getArea(1);
		$paa = $model->getOne($provinceaa);
		$caa = $model->getOne($citya);
		$caoa = $model->getOne($county);
		
		$paa1 = $model->getOne($e_provinceaa);
		$caa1 = $model->getOne($e_citya);
		
		$arry = array(
			'pid' => $provinceaa,
			'pname' => $paa['area_name'],
			'cid' => $provinceaa,
			'cname' => $caa['area_name'],
			'coid' => $provinceaa,
			'coname' => $caoa['area_name'],
			//'coid' => $provinceaa,
			//'coname' => $caoa['area_name'],
			//'huodong' => $huodong,
		);	
		$arry1 = array(
		    'pid' => $e_provinceaa,
		    'pname' => $paa1['area_name'],
		    'cid' => $e_provinceaa,
		    'cname' => $caa1['area_name'],
		    'coid' => $e_provinceaa,
		    'coname' => $caoa['area_name'],
		    //'coid' => $provinceaa,
		    //'coname' => $caoa['area_name'],
		    //'huodong' => $huodong,
		);
		$this->assign('arry',$arry);
		$this->assign('arry1',$arry1);
		$this->assign('provincea',$provincea);
		$this->assign('province',$provinceaa);
		$this->assign('citya',$citya);
		$this->assign('e_province',$e_provinceaa);
		$this->assign('e_citya',$e_citya);
		$this->assign('huodong',$huodong);
		$this->assign('county',$county);
		$this->assign('list',$info['list']);
		$this->assign('page',$info['page']);
		$this -> assign('sec','product_line');
		$this->display('Product:product_line');
	}
	
	//添加直发线
	public function lineadd(){
		$model = D('Line');
		$sprovince = I('post.sprovince');
		$scity = I('post.scity');
		//$scounty = I('post.scounty');
		$eprovince = I('post.eprovince');
		$ecity = I('post.ecity');
		//$line_status = I('post.line_status');
		$line_discount = I('post.line_discount');
		//$price = I('post.price');
		$line_code = I('post.code');
		//$line_img = I('post.line_img');
		//$line_name = I('post.line_name');
// 		if (empty($sprovince)){
// 			$this->error('起始省不能为空！','product_line');
// 		} elseif (empty($scity)) {
// 			$this->error('起始市不能为空！','product_line');
// 		} elseif (empty($scounty)){
// 			$this->error('起始区不能为空！','product_line');
// 		} elseif (empty($eprovince)){
// 			$this->error('目的地省不能为空！','product_line');
// 		} elseif (empty($ecity)){
// 			$this->error('目的地市不能为空！','product_line');
// 		} elseif (empty($line_status)){
// 			$this->error('路线类型不能为空！','product_line');
// 		} elseif (!empty($line_discount) and !is_numeric($line_discount)){
// 			$this->error('百分比错误！','product_line');
// 		}
		$star = $sprovince.','.$scity;
		$end = $eprovince.','.$ecity;
		print_log($star);
		print_log($end);
		/* //提车费
		$e = D('Ti')->star($star);
		if (!$e['ti_driver_price']){
			$res['status'] = 'N';
			$res['info'] = '提车费不存在！';
			$this->ajaxReturn($res);
		}
		//送车费
		$s = D('Song')->end($end);
		if (!$s['song_driver_price']){
			$res['status'] = 'N';
			$res['info'] = '送车费不存在！';
			$this->ajaxReturn($res);
		}
		//长途费
		$ls = D('LineSan')->verify($e['ti_end'],$s['song_star']);
		if ($ls['ti_price']){
			$res['status'] = 'N';
			$res['info'] = '长途费不存在！';
			$this->ajaxReturn($res);
		}
		$zprice = $s['song_driver_price'] + $e['ti_driver_price'] + $ls['san_price'];
		$zpriceban = $s['song_platelets_price'] + $e['ti_platelets_price'] + $ls['san_price'];
		if ($line_discount){
			$line_discounta = $line_discount;
			$zprice = $zprice-$line_discounta;
		} */
		$data = array(
				'line_star'	=>	$star,
				'line_end'	=>	$end,
				//'line_discount'	=>	$line_discount*100,
				//'line_status'	=>	$line_status,
				'line_price'	=>	$line_discount*100,//$zprice,
		        //'line_price_ban'=>  $zpriceban,
				//'line_name'	=>	$line_name,
				//'line_img'	=>	$line_img,
		);
		if ($line_code){
			if ($model->where(array('line_code'=>$line_code))->save($data)){
					$res['status'] = 'Y';
					$res['info'] = '修改成功！';
			} else {
					$res['status'] = 'N';
					$res['info'] = '修改失败！';
			}
		} else {
			//$res = $model->verify($star,$end);
			//if ($res){
			//		$res['status'] = 'N';
			//		$res['info'] = '集散地已经存在！';
			//} else {
				$data['line_code'] = create_random_code(7);
				if ($model->add($data)){
					$res['status'] = 'Y';
					$res['info'] = '添加成功！';
				} else {
					$res['status'] = 'N';
					$res['info'] = '添加失败！';
				}
			//}
		}
		$this->ajaxReturn($res);
	}
	
	//删除产品线
	public function linedel(){
		$code = I('post.code');
		$where['line_code'] = $code;
		$del = M('Line')->where($where)->delete();
		if ($del){
			$data = '删除成功';
		} else {
			$data = '删除失败';
		}
		$this->ajaxReturn($data);
	}
	
	
	//毛利
	public function maoli(){
		$province = I('provincea');
		$provinceb = I('provinceb');
		$model = D('Area');
		$mlmodel = D('Maoli');
		//获取所有省级
		$provincea = $model->getArea(1);
		$info = $mlmodel->getPage($province,$provinceb);
		foreach ($info['list'] as &$v){
			$sp = $model->getOne($v['ml_star']);
			$v['starp'] = $sp['area_name'];
			$ep = $model->getOne($v['ml_end']);
			$v['endp'] = $ep['area_name'];
			$v['ml_price'] = $v['ml_price']/100;
		}
		$p = $model->getOne($province);
		$pb = $model->getOne($provinceb);
		$this->assign('list',$info['list']);
		$this->assign('page',$info['page']);
		$this->assign('province',$province);
		$this->assign('provincea',$provincea);
		$this->assign('provinceb',$provinceb);
		$this->assign('p',$p['area_name']);
		$this->assign('pb',$pb['area_name']);
		$this -> assign('sec','maoli');
		$this->display('Product:maoli');
	}
	
	//毛利添加
	public function maoliadd(){
		$mlmodel = D('Maoli');
		$code = I('code');
		$star = I('mi_star');
		$end = I('mi_end');
		if ($_POST){
			$data = array(
				'ml_star' => $star,
				'ml_end' => $end,
				'ml_price_one' => I('mi_price1')*100,
			    'ml_price_two' => I('mi_price2')*100,
			    'ml_price_three' => I('mi_price3')*100,
			    'ml_price_four' => I('mi_price4')*100,
			    'ml_price_five' => I('mi_price5')*100,
			);
			if ($code){
				$save = $mlmodel->where(array('ml_code'=>$code))->save($data);
				if ($save){
					$res['status'] = 'Y';
					$res['info'] = '修改成功！';
				} else {
					$res['status'] = 'N';
					$res['info'] = '修改失败！';
				}
			} else {
				$pp = $mlmodel->piPei($star,$end);
				print_log('-----------------'.json_encode($pp));
				if ($pp){
					$res['status'] = 'N';
					$res['info'] = '已经存在，请从新添加！';
				} else {
					$data['ml_code'] = create_random_code(7);
					$add = $mlmodel->add($data);
					if ($add){
						$res['status'] = 'Y';
						$res['info'] = '添加成功！';
					} else {
						$res['status'] = 'N';
						$res['info'] = '添加失败！';
					}
				}				
			}
		}
		$this->ajaxReturn($res);
	}
	
	//毛利删除处理
	public function maolidel(){
		$code = I('post.code');
		$where['ml_code'] = $code;
		$del = M('Maoli')->where($where)->delete();
		if ($del){
			$data = '删除成功';
		} else {
			$data = '删除失败';
		}
		$this->ajaxReturn($data);
	}
	
	
	//车型加价
	public function arctic(){
		$brands = I('get.brand');
		$type =  I('get.type');
		$model = D('Carxing');
		
		if($brands!='f'&&$type=='f'){
		    $map['cxjj_pid'] = array('eq',$brands);
		}else if($brands!='f'&&$type!='f'){
		    $map['cxjj_id'] = array('eq',$type);
		}else if($brands=='f'&&$type=='f'){
		    $map['cxjj_pid'] = array('neq',0);
		}
		$info = $model->getPages($map);
		//$info = $model->getPage(2,$type);
		foreach ($info['list'] as &$v){
			$branda = $model->getData($v['cxjj_pid']);	
			$v['branda'] = $branda['cxjj_brand'];
			$v['cxjj_price'] = $v['cxjj_price']/100;
		}
		//获取所有车品牌
		$brand = $model->getAll(0);
		$this->assign('list',$info['list']);
		$this->assign('page',$info['page']);
		//dump($brand);die();
		$this->assign('brand',$brand);
		$this->assign('brands',$brands);
		$this->assign('type',$type);
		$this -> assign('sec','arctic');
		$this->display('Product:arctic');
	}
	public function by_getCarx() {
	    $name =I('name');
	    $pid =I('pid');
	    $model =D('Carxing');
	    $data = $model ->by_getCarx($name,$pid);
	    $this -> ajaxReturn($data);
	}
	
	//车型加价添加
	public function arcticadd(){
		$model = D('Carxing');
		$branda = I('post.branda');
		$brand = I('post.brand');
		$cxjj_types = I('post.cxjj_types');
		$cxjj_quality =I('post.cxjj_quality');
		$cxjj_category =I('post.cxjj_category');

// 		if (empty($branda)){
// 			$this->error('品牌不能为空！','arctic');
// 		} elseif (empty($brand)) {
// 			$this->error('车型不能为空！','arctic');
// 		} elseif (empty($price) or !is_numeric($price)){
// 			$this->error('价格错误！','arctic');
// 		}
		$data = array(
			'cxjj_types'	=>	$cxjj_types,
		    'cxjj_quality'	=>	$cxjj_quality,
		    'cxjj_category'	=>	$cxjj_category,
		);
		if ($model->where(array('cxjj_id'=>$brand))->save($data)){
			$res['status'] = 'Y';
			$res['info'] = '成功！';
		} else {
			$res['status'] = 'N';
			$res['info'] = '失败！';
		}
		$this->ajaxReturn($res);
	}
	
	//车型加价删除处理
	public function arcticdel(){
		$code = I('post.code');
		$where['cxjj_id'] = $code;
		$del = M('carxing')->where($where)->delete();
		if ($del){
			$data = '删除成功';
		} else {
			$data = '删除失败';
		}
		$this->ajaxReturn($data);
	}
	
	
	//区域处理
	public function area_act(){
		$model = D('Area');
		$provinceid = I('post.provinceid','16');
		$data = $model->getSon($provinceid);
		$this->ajaxReturn($data);
	}
	
	
	//车型处理
	public function car_act(){
		$model = D('Carxing');
		$brand = I('post.brand','16');
		$data = $model->getSon($brand);
		$this->ajaxReturn($data);
	}
	
	/**
	 * 导入
	 */
	function daoru_bulk(){
	    $area = M("line_san");
	    //$areaObj = M("area");
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
	            $datatime = date('Y-m-d',time());
	            for($currentRow=3;$currentRow<=$allRow;$currentRow++){
	                $cid = $currentSheet->getCell("A".$currentRow)->getValue();
	                $v['san_id'] =  $cid!="" && $cid!=null && is_object($cid) ? $cid->__toString():$cid;
	    
	                $type_pid_ = $currentSheet->getCell('B'.$currentRow)->getValue();
	                $v["san_code"]= $type_pid_!="" && $type_pid_!=null && is_object($type_pid_) ? $type_pid_->__toString():$type_pid_;
	    
	                 
	                $type_id_ = $currentSheet->getCell('C'.$currentRow)->getValue();
	                $type_id_arr =explode(",",$type_id_);
	                $type_id_ = get_areaid($type_id_arr[0]).",".get_areaid($type_id_arr[1]);
	                $v['san_star']=$type_id_!="" && $type_id_!=null && is_object($type_id_) ? $type_id_->__toString():$type_id_;
	                 
	                 
	                $description_ = $currentSheet->getCell('D'.$currentRow)->getValue();
	                $description_arr =explode(",",$description_);
	                $description_ = get_areaid($description_arr[0]).",".get_areaid($description_arr[1]);
	                $v['san_end']= $description_!="" && $description_!=null && is_object($description_) ? $description_->__toString():$description_;
	    
	                $quality_ = $currentSheet->getCell('E'.$currentRow)->getValue();
	                $v['san_name']= $quality_!="" && $quality_!=null && is_object($quality_) ? $quality_->__toString():$quality_;
	               
	                $price_ = $currentSheet->getCell('F'.$currentRow)->getValue();
	                $v['san_price']= ($price_!="" && $price_!=null && is_object($price_) ? $price_->__toString():$price_)*100;
	                
	                $v['san_time'] = date("Y-m-d H:i:s",time());
	                
	                //$v['area_add_time'] = $datatime;
	                $map = null;
	                if($v['san_id']!=""){
	                    $map['san_id'] = array("eq",$v['san_id']);
	                }
	                //if($v['area_type']!=""){
	                //	$map['area_type'] = array("eq",$v['area_type']);
	                //}
	                $vo=null;
	                if($map!=null){
	                    $vo = $area->where($map)->find();
	                }
	                if($vo!=null&&count($vo)>0){
	                    $map_['san_id'] = array("eq",$vo['san_id']);
	                    $area ->where($map_)->save($v);
	                }else{
	                    $area->add($v);
	                }
	            }
	            @unlink ($savePath.$file_name);
	            $this->success("导入成功");
	        }else{
	            $this->error ( '不是Excel文件，重新上传' );
	        }
	    } 
	}
	/**
	 * 导出
	 */
	function daochu_bulk(){
	    $pro =I('pro');
	    $city =I('city');
	    $whe = $pro.",".$city;
	    
	    $pro1 =I('e_pro');
	    $city1 =I('e_city');
	    $whe1 = $pro1.",".$city1;
	    if($city !='f'){
	        $where['san_star'] = $whe;
	    }else if($pro !='f'){
	        $where['san_star'] = array('like' ,'%'.$pro.'%');
	    }
	    if($city1 !='f'){
	        $where['san_end'] = $whe1;
	    }else if($pro1 !='f'){
	        $where['san_end'] = array('like' ,'%'.$pro1.'%');
	    }
	    if($pro1 !='f' || $pro !='f'){
	        $ret = M("line_san")->where($where)->select();
	    }else{
	        $ret = M("line_san")->select();
	    }
	   
	    $data['xlsName']  = "集散地--导出".date("Y-m-d H:i:s",time());
	    $data['xlsCell']  = array(
	        array('san_id','集散地ID'),
	        array('san_code','集散地编号'),
	        array('san_star','起始'),
	        array('san_end','终点'),
	        array('san_name','集散地名称'),
	        array('san_price','费用'),
	        array('san_time','创建时间')
	    );
	    $size = count($ret);
	    for($i=0;$i<$size;$i++){
	        $data['xlsData'][$i]['san_id'] = $ret[$i]['san_id'];
	        $data['xlsData'][$i]['san_code'] = $ret[$i]['san_code'];
	        $star=explode(",",$ret[$i]['san_star']);
	        $star=get_areaname($star[0]).",".get_areaname($star[1]);
	        $data['xlsData'][$i]['san_star'] = $star;
	        $end=explode(",",$ret[$i]['san_end']);
	        $end=get_areaname($end[0]).",".get_areaname($end[1]);
	        $data['xlsData'][$i]['san_end'] = $end;
	        $data['xlsData'][$i]['san_name'] = $ret[$i]['san_name'];
	        $data['xlsData'][$i]['san_price'] = $ret[$i]['san_price']/100;
	        $data['xlsData'][$i]['san_time'] = $ret[$i]['san_time'];
	    }
	    exportExcel($data['xlsName'],$data['xlsCell'],$data['xlsData']);
	}
	
	/**
	 * 导入
	 */
	function daoru_star(){
	    $area = M("ti");
	    //$areaObj = M("area");
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
	            $datatime = date('Y-m-d',time());
	            for($currentRow=3;$currentRow<=$allRow;$currentRow++){
	                $cid = $currentSheet->getCell("A".$currentRow)->getValue();
	                $v['ti_id'] =  $cid!="" && $cid!=null && is_object($cid) ? $cid->__toString():$cid;
	                 
	                $type_pid_ = $currentSheet->getCell('B'.$currentRow)->getValue();
	                $v["ti_code"]= $type_pid_!="" && $type_pid_!=null && is_object($type_pid_) ? $type_pid_->__toString():$type_pid_;
	                 
	    
	                $type_id_ = $currentSheet->getCell('C'.$currentRow)->getValue();
	                $type_id_arr=explode(",",$type_id_);
	                $type_id_=get_areaid($type_id_arr[0]).",".get_areaid($type_id_arr[1]).",".get_areaid($type_id_arr[2]);
	                $v['ti_star']=$type_id_!="" && $type_id_!=null && is_object($type_id_) ? $type_id_->__toString():$type_id_;
	    
	    
	                $description_ = $currentSheet->getCell('D'.$currentRow)->getValue();
	                $description_arr = explode(",",$description_);
	                $description_ = get_areaid($description_arr[0]).",".get_areaid($description_arr[1]);
	                $v['ti_end']= $description_!="" && $description_!=null && is_object($description_) ? $description_->__toString():$description_;
	                 
	                $quality_ = $currentSheet->getCell('E'.$currentRow)->getValue();
	                $v['ti_driver_price']= ($quality_!="" && $quality_!=null && is_object($quality_) ? $quality_->__toString():$quality_)*100;
	    
	                $price_ = $currentSheet->getCell('F'.$currentRow)->getValue();
	                $v['ti_platelets_price']= ($price_!="" && $price_!=null && is_object($price_) ? $price_->__toString():$price_)*100;
	                 
	                //$v['area_add_time'] = $datatime;
	                $map = null;
	                if($v['ti_id']!=""){
	                    $map['ti_id'] = array("eq",$v['ti_id']);
	                }
	                //if($v['area_type']!=""){
	                //	$map['area_type'] = array("eq",$v['area_type']);
	                //}
	                $vo=null;
	                if($map!=null){
	                    $vo = $area->where($map)->find();
	                }
	                if($vo!=null&&count($vo)>0){
	                    $map_['ti_id'] = array("eq",$vo['ti_id']);
	                    $area ->where($map_)->save($v);
	                }else{
	                    $area->add($v);
	                }
	            }
	            @unlink ($savePath.$file_name);
	            $this->success("导入成功");
	        }else{
	            $this->error ( '不是Excel文件，重新上传' );
	        }
	    }
	}
	/**
	 * 导出
	 */
	function daochu_star(){
	    $pro =I('pro');
	    $city =I('city');
	    $cou =I('cou');
	    $s2 =$pro.",".$city;
	    $s3 =$pro.",".$city.",".$cou;
	    if($cou !='f'){
	        $where['ti_star'] = $s3;
	        $ret = M("ti")->where($where)->select();
	    }else if($city !='f'){
	        $where['ti_star'] = array('like' , $s2.'%');
	        $ret = M("ti")->where($where)->select();
	    }else if($pro !='f'){
	        $where['ti_star'] = array('like' , $pro.'%');
	        $ret = M("ti")->where($where)->select();
	    }else{
	        $ret = M("ti")->select();
	    }
	    $data['xlsName']  = "出发地管理--导出".date("Y-m-d H:i:s",time());
	    $data['xlsCell']  = array(
	        array('ti_id','提车ID'),
	        array('ti_code','提车编号'),
	        array('ti_star','起始'),
	        array('ti_end','终点'),
	        array('ti_driver_price','小板提车费'),
	        array('ti_platelets_price','司机提车')
	    );
	    $size = count($ret);
	    for($i=0;$i<$size;$i++){
	        $data['xlsData'][$i]['ti_id'] = $ret[$i]['ti_id'];
	        $data['xlsData'][$i]['ti_code'] = $ret[$i]['ti_code'];
	        $star=explode(",",$ret[$i]['ti_star']);
	        $star=get_areaname($star[0]).",".get_areaname($star[1]).",".get_areaname($star[2]);
	        $data['xlsData'][$i]['ti_star'] = $star;
	        $end=explode(",",$ret[$i]['ti_end']);
	        $end=get_areaname($end[0]).",".get_areaname($end[1]);
	        $data['xlsData'][$i]['ti_end'] = $end;
	        $data['xlsData'][$i]['ti_driver_price'] = $ret[$i]['ti_driver_price']/100;
	        $data['xlsData'][$i]['ti_platelets_price'] = $ret[$i]['ti_platelets_price']/100;
	    }
	    exportExcel($data['xlsName'],$data['xlsCell'],$data['xlsData']);
	}
	
	/**
	 * 导入
	 */
	function daoru_end(){
	    $area = M("song");
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
	            $datatime = date('Y-m-d',time());
	            for($currentRow=3;$currentRow<=$allRow;$currentRow++){
	                $cid = $currentSheet->getCell("A".$currentRow)->getValue();
	                $v['song_id'] =  $cid!="" && $cid!=null && is_object($cid) ? $cid->__toString():$cid;
	    
	                $type_pid_ = $currentSheet->getCell('B'.$currentRow)->getValue();
	                $v["song_code"]= $type_pid_!="" && $type_pid_!=null && is_object($type_pid_) ? $type_pid_->__toString():$type_pid_;
	    
	                 
	                $type_id_ = $currentSheet->getCell('C'.$currentRow)->getValue();
	                $type_id_arr=explode(",",$type_id_);
	                $type_id_=get_areaid($type_id_arr[0]).",".get_areaid($type_id_arr[1]);
	                $v['song_star']=$type_id_!="" && $type_id_!=null && is_object($type_id_) ? $type_id_->__toString():$type_id_;
	                 
	                 
	                $description_ = $currentSheet->getCell('D'.$currentRow)->getValue();
	                $description_arr = explode(",",$description_);
	                $description_ = get_areaid($description_arr[0]).",".get_areaid($description_arr[1]);
	                $v['song_end']= $description_!="" && $description_!=null && is_object($description_) ? $description_->__toString():$description_;
	    
	                $quality_ = $currentSheet->getCell('E'.$currentRow)->getValue();
	                $v['song_driver_price']= ($quality_!="" && $quality_!=null && is_object($quality_) ? $quality_->__toString():$quality_)*100;
	                 
	                $price_ = $currentSheet->getCell('F'.$currentRow)->getValue();
	                $v['song_platelets_price']= ($price_!="" && $price_!=null && is_object($price_) ? $price_->__toString():$price_)*100;
	    
	                //$v['area_add_time'] = $datatime;
	                $map = null;
	                if($v['song_id']!=""){
	                    $map['song_id'] = array("eq",$v['song_id']);
	                }
	                //if($v['area_type']!=""){
	                //	$map['area_type'] = array("eq",$v['area_type']);
	                //}
	                $vo=null;
	                if($map!=null){
	                    $vo = $area->where($map)->find();
	                }
	                if($vo!=null&&count($vo)>0){
	                    $map_['song_id'] = array("eq",$vo['song_id']);
	                    $area ->where($map_)->save($v);
	                }else{
	                    $area->add($v);
	                }
	            }
	            @unlink ($savePath.$file_name);
	            $this->success("导入成功");
	        }else{
	            $this->error ( '不是Excel文件，重新上传' );
	        }
	    }
	}
	/**
	 * 导出
	 */
	function daochu_end(){
	    $pro =I('pro');
	    $city =I('city');
	    $whe = $pro.",".$city;
	    if($city !='f'){
	        $where['song_end'] = $whe;
	        $ret = M("song")->where($where)->select();
	    }else if($pro !='f'){
	        $where['song_end'] = array('like' ,'%'.$pro.'%');
	        $ret = M("song")->where($where)->select();
	    }else{
	        $ret = M("song")->select();
	    }
	    $data['xlsName']  = "送车管理--导出".date("Y-m-d H:i:s",time());
	    $data['xlsCell']  = array(
	        array('song_id','提车ID'),
	        array('song_code','提车编号'),
	        array('song_star','起始'),
	        array('song_end','终点'),
	        array('song_driver_price','小板提车费'),
	        array('song_platelets_price','司机提车')
	    );
	    $size = count($ret);
	    for($i=0;$i<$size;$i++){
	        $data['xlsData'][$i]['song_id'] = $ret[$i]['song_id'];
	        $data['xlsData'][$i]['song_code'] = $ret[$i]['song_code'];
	        $star=explode(",",$ret[$i]['song_star']);
	        $star=get_areaname($star[0]).",".get_areaname($star[1]);
	        $data['xlsData'][$i]['song_star'] = $star;
	        $end=explode(",",$ret[$i]['song_end']);
	        $end=get_areaname($end[0]).",".get_areaname($end[1]);
	        $data['xlsData'][$i]['song_end'] = $end;
	        $data['xlsData'][$i]['song_driver_price'] = $ret[$i]['song_driver_price']/100;
	        $data['xlsData'][$i]['song_platelets_price'] = $ret[$i]['song_platelets_price']/100;
	    }
	    exportExcel($data['xlsName'],$data['xlsCell'],$data['xlsData']);
	}
	
	/**
	 * 导入
	 */
	function daoru_Sm(){
	    $area = M("sm");
	    $areaObj = M("area");
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
	            $datatime = date('Y-m-d',time());
	            for($currentRow=3;$currentRow<=$allRow;$currentRow++){
	                $cid = $currentSheet->getCell("A".$currentRow)->getValue();
	                $v['sm_id'] =  $cid!="" && $cid!=null && is_object($cid) ? $cid->__toString():$cid;
	    
	                $type_pid_ = $currentSheet->getCell('B'.$currentRow)->getValue();
	                $v["sm_code"]= $type_pid_!="" && $type_pid_!=null && is_object($type_pid_) ? $type_pid_->__toString():$type_pid_;
	    
	                $type_id_ = $currentSheet->getCell('C'.$currentRow)->getValue();
	                $arrs1 = explode(",", $type_id_);
	                $map_1['area_name'] = array('eq',$arrs1[0]);
	                $res = $areaObj->where($map_1)->find();
	                $map_2['area_name'] = array('eq',$arrs1[1]);
	                $res1 = $areaObj->where($map_2)->find();
	                $v['line_star']=$res['area_id'].",".$res1['area_id'];
	                 
	                $description_ = $currentSheet->getCell('D'.$currentRow)->getValue();
	                $arrs2 = explode(",", $description_);
	                $map_3['area_name'] = array('eq',$arrs2[0]);
	                $reb = $areaObj->where($map_2)->find();
	                $map_4['area_name'] = array('eq',$arrs2[1]);
	                $reb1 = $areaObj->where($map_4)->find();
	                $map_5['area_name'] = array('eq',$arrs2[2]);
	                $reb2 = $areaObj->where($map_5)->find();
	                $v['line_end']=$reb['area_id'].",".$reb1['area_id'].','.$reb2['area_id'];
	    
	                $quality_ = ($currentSheet->getCell('E'.$currentRow)->getValue())*100;
	                $v['sm_driver_price']= $quality_!="" && $quality_!=null && is_object($quality_) ? $quality_->__toString():$quality_;
	    
	                $quality_ = ($currentSheet->getCell('F'.$currentRow)->getValue())*100;
	                $v['sm_platelets_price']= $quality_!="" && $quality_!=null && is_object($quality_) ? $quality_->__toString():$quality_;
	                 
	                //$v['area_add_time'] = $datatime;
	                $map = null;
	                if($v['sm_id']!=""){
	                    $map['sm_id'] = array("eq",$v['sm_id']);
	                }
	                //if($v['area_type']!=""){
	                //	$map['area_type'] = array("eq",$v['area_type']);
	                //}
	                $vo=null;
	                if($map!=null){
	                    $vo = $area->where($map)->find();
	                }
	                if($vo!=null&&count($vo)>0){
	                    $map_['sm_id'] = array("eq",$vo['sm_id']);
	                    $area ->where($map_)->save($v);
	                }else{
	                    $area->add($v);
	                }
	    
	            }
	            @unlink ($savePath.$file_name);
	            $this->success("导入成功");
	        }else{
	            $this->error ( '不是Excel文件，重新上传' );
	        }
	    }
	}
	/**
	 * 导出
	 */
	function daochu_Sm(){
	    $pro =I('pro');
	    $city =I('city');
	    $cou =I('cou');
	    $s2 =$pro.",".$city;
	    $s3 =$pro.",".$city.",".$cou;
	    if($cou !='f'){
	        $where['sm_end'] = $s3;
	        $ret = M("sm")->where($where)->select();
	    }else if($city !='f'){
	        $where['sm_end'] = array('like' , $s2.'%');
	        $ret = M("sm")->where($where)->select();
	    }else if($pro !='f'){
	        $where['sm_end'] = array('like' , $pro.'%');
	        $ret = M("sm")->where($where)->select();
	    }else{
	        $ret = M("sm")->select();
	    }
	    $area= M("area");
	    foreach ($ret as &$va){
	        $star=$va['sm_star'];
	        $end=$va['sm_end'];
	        //dump($star);dump($end);die();
	        if(!empty($star)){
	            $arr=explode(",",$star);
	            $star_1= $area ->where("area_id =".$arr[0])->field("area_name")->find();
	            $star_2= $area ->where("area_id =".$arr[1])->field("area_name")->find();
	            $va['sm_star']=$star_1['area_name'].",".$star_2['area_name'];
	        }
	        
	        if(!empty($end)){
	            $arr=explode(",",$end);
	            $end_1= $area ->where("area_id =".$arr[0])->field("area_name")->find();
	            $end_2= $area ->where("area_id =".$arr[1])->field("area_name")->find();
	            $end_3= $area ->where("area_id =".$arr[2])->field("area_name")->find();
	            $va['sm_end']=$end_1['area_name'].",".$end_2['area_name'].','.$end_3['area_name'];
	        }
	        
	    }
	    $data['xlsName']  = "上门送车费--导出".date("Y-m-d H:i:s",time());
	    $data['xlsCell']  = array(
	        array('sm_id','上门送车ID'),
	        array('sm_code','上门送车编号'),
	        array('sm_star','起始'),
	        array('sm_end','终点'),
	        array('sm_driver_price','小板提车费'),
	        array('sm_platelets_price','司机提车')
	    );
	    $size = count($ret);
	    for($i=0;$i<$size;$i++){
	        $data['xlsData'][$i]['sm_id'] = $ret[$i]['sm_id'];
	        $data['xlsData'][$i]['sm_code'] = $ret[$i]['sm_code'];
	        $data['xlsData'][$i]['sm_star'] = $ret[$i]['sm_star'];
	        $data['xlsData'][$i]['sm_end'] = $ret[$i]['sm_end'];
	        $data['xlsData'][$i]['sm_driver_price'] = $ret[$i]['sm_driver_price']/100;
	        $data['xlsData'][$i]['sm_platelets_price'] = $ret[$i]['sm_platelets_price']/100;
	    }
	    exportExcel($data['xlsName'],$data['xlsCell'],$data['xlsData']);
	}
	
	/**
	 * 导入
	 */
	function daoru_line(){
	    $area = M("line");
	    $areaObj = M("area");
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
    			$datatime = date('Y-m-d',time());
    			for($currentRow=3;$currentRow<=$allRow;$currentRow++){
    				$cid = $currentSheet->getCell("A".$currentRow)->getValue();
    				$v['line_id'] =  $cid!="" && $cid!=null && is_object($cid) ? $cid->__toString():$cid;
    				
    				$type_pid_ = $currentSheet->getCell('B'.$currentRow)->getValue();
    				$v["line_code"]= $type_pid_!="" && $type_pid_!=null && is_object($type_pid_) ? $type_pid_->__toString():$type_pid_;
                    
    				$type_id_ = $currentSheet->getCell('C'.$currentRow)->getValue();
    				$arrs1 = explode(",", $type_id_);
    				$map_1['area_name'] = array('eq',$arrs1[0]);
    				$res = $areaObj->where($map_1)->find();
    				$map_2['area_name'] = array('eq',$arrs1[1]);
    				$res1 = $areaObj->where($map_2)->find();
    				$v['line_star']=$res['area_id'].",".$res1['area_id'];
    	
    				$description_ = $currentSheet->getCell('D'.$currentRow)->getValue();
    				$arrs2 = explode(",", $description_);
    				$map_3['area_name'] = array('eq',$arrs2[0]);
    				$reb = $areaObj->where($map_2)->find();
    				$map_4['area_name'] = array('eq',$arrs2[1]);
    				$reb1 = $areaObj->where($map_4)->find();
    				$v['line_end']=$reb['area_id'].",".$reb1['area_id'];
    				
    				$quality_ = ($currentSheet->getCell('E'.$currentRow)->getValue())*100;
    				$v['line_price']= $quality_!="" && $quality_!=null && is_object($quality_) ? $quality_->__toString():$quality_;
    				
    				//$v['area_add_time'] = $datatime;
    				$map = null;
    				if($v['line_id']!=""){
    					$map['line_id'] = array("eq",$v['line_id']);
    				}
    				//if($v['area_type']!=""){
    				//	$map['area_type'] = array("eq",$v['area_type']);
    				//}
    				$vo=null;
    				if($map!=null){
    					$vo = $area->where($map)->find();
    				}
    				if($vo!=null&&count($vo)>0){
    					$map_['line_id'] = array("eq",$vo['line_id']);
    					$area ->where($map_)->save($v);
    				}else{
    					$area->add($v);
    				}
    				
    			}
    			@unlink ($savePath.$file_name);
    			$this->success("导入成功");
    		}else{
    			$this->error ( '不是Excel文件，重新上传' );
    		}
	    }
	}
	/**
	 * 导出
	 */
	function daochu_line(){
	    $pro =I('pro');
	    $city =I('city');
	    
	    $e_pro =I('e_pro');
	    $e_city =I('e_city');
	    
	    $whe = $pro.",".$city;
	    $e_whe =  $e_pro.",".$e_city;
	    if($city !='f'){
	        $where['line_star'] = $whe;
	    }else if($pro !='f'){
	        $where['line_star'] = array('like' ,'%'.$pro.'%');
	    }
	    
	    if($e_city !='f'){
	        $where['line_end'] = $e_whe;
	    }else if($e_pro !='f'){
	        $where['line_end'] = array('like' ,'%'.$e_pro.'%');
	    }
	    
	    if($pro =='f' && $e_pro =='f'){
	        $ret = M("line")->order("line_end asc")->select();
	    }else{
	        $ret = M("line")->where($where)->order("line_end asc")->select();
	    }

	    $area= M("area");
	    foreach ($ret as &$va){
	        $star=$va['line_star'];
	        $end=$va['line_end'];
	        if(!empty($star)){
	            $arr=explode(",",$star);
	            $star_1= $area ->where("area_id =".$arr[0])->field("area_name")->find();
	            $star_2= $area ->where("area_id =".$arr[1])->field("area_name")->find();
	            $va['line_star']=$star_1['area_name'].",".$star_2['area_name'];
	        }
	        if(!empty($end)){
	            $arr=explode(",",$end);
	            $end_1= $area ->where("area_id =".$arr[0])->field("area_name")->find();
	            $end_2= $area ->where("area_id =".$arr[1])->field("area_name")->find();
	            $va['line_end']=$end_1['area_name'].",".$end_2['area_name'];
	        }
	    }
	    $data['xlsName']  = "线路直发--导出".date("Y-m-d H:i:s",time());
	    $data['xlsCell']  = array(
	        array('line_id','线路ID'),
	        array('line_code','线路编号'),
	        array('line_star','起始'),
	        array('line_end','终点'),
	        array('line_price','价格')
	    );
	    $size = count($ret);
	    for($i=0;$i<$size;$i++){
	        $data['xlsData'][$i]['line_id'] = $ret[$i]['line_id'];
	        $data['xlsData'][$i]['line_code'] = $ret[$i]['line_code'];
	        $data['xlsData'][$i]['line_star'] = $ret[$i]['line_star'];
	        $data['xlsData'][$i]['line_end'] = $ret[$i]['line_end'];
	        $data['xlsData'][$i]['line_price'] = $ret[$i]['line_price']/100;
	    }
	    exportExcel($data['xlsName'],$data['xlsCell'],$data['xlsData']);
	}
	
	/**
	 * 导入
	 */
	function daoru_maoli(){
	    $area = M("maoli");
	    $areaObj = M("area");
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
    			$datatime = date('Y-m-d',time());
    			for($currentRow=3;$currentRow<=$allRow;$currentRow++){
    				$cid = $currentSheet->getCell("A".$currentRow)->getValue();
    				$v['ml_id'] =  $cid!="" && $cid!=null && is_object($cid) ? $cid->__toString():$cid;
    				
    				$type_pid_ = $currentSheet->getCell('B'.$currentRow)->getValue();
    				$v["ml_code"]= $type_pid_!="" && $type_pid_!=null && is_object($type_pid_) ? $type_pid_->__toString():$type_pid_;
                    
    				
    				
    				$type_id_ = $currentSheet->getCell('C'.$currentRow)->getValue();
    				$map_1['area_name'] = array('eq',$type_id_);
    				$res = $areaObj->where($map_1)->find();
    				$v['ml_star']=$res['area_id'];
    	
    				$description_ = $currentSheet->getCell('D'.$currentRow)->getValue();
    				$map_2['area_name'] = array('eq',$description_);
    				$reb = $areaObj->where($map_2)->find();
    				$v['ml_end']=$reb['area_id'];
    				
    				$quality_ = ($currentSheet->getCell('E'.$currentRow)->getValue())*100;
    				$v['ml_price_one']= $quality_!="" && $quality_!=null && is_object($quality_) ? $quality_->__toString():$quality_;
    				
    				$quality_2 = ($currentSheet->getCell('F'.$currentRow)->getValue())*100;
    				$v['ml_price_two']= $quality_2!="" && $quality_2!=null && is_object($quality_2) ? $quality_2->__toString():$quality_2;
    				
    				$quality_3 = ($currentSheet->getCell('G'.$currentRow)->getValue())*100;
    				$v['ml_price_three']= $quality_3!="" && $quality_3!=null && is_object($quality_3) ? $quality_3->__toString():$quality_3;
    				
    				$quality_4 = ($currentSheet->getCell('H'.$currentRow)->getValue())*100;
    				$v['ml_price_four']= $quality_4!="" && $quality_4!=null && is_object($quality_4) ? $quality_4->__toString():$quality_4;
    				
    				$quality_5 = ($currentSheet->getCell('I'.$currentRow)->getValue())*100;
    				$v['ml_price_five']= $quality_5!="" && $quality_5!=null && is_object($quality_5) ? $quality_5->__toString():$quality_5;
    				
    				//$v['area_add_time'] = $datatime;
    				$map = null;
    				if($v['ml_id']!=""){
    					$map['ml_id'] = array("eq",$v['ml_id']);
    				}
    				//if($v['area_type']!=""){
    				//	$map['area_type'] = array("eq",$v['area_type']);
    				//}
    				$vo=null;
    				if($map!=null){
    					$vo = $area->where($map)->find();
    				}
    				if($vo!=null&&count($vo)>0){
    					$map_['ml_id'] = array("eq",$vo['ml_id']);
    					$area ->where($map_)->save($v);
    				}else{
    					$area->add($v);
    				}
    				
    			}
    			@unlink ($savePath.$file_name);
    			$this->success("导入成功");
    		}else{
    			$this->error ( '不是Excel文件，重新上传' );
    		}
	    }
	}
	/**
	 * 导出
	 */
	function daochu_maoli(){
	    $start =I('pro');
	    $end =I('city');
	    if($start !='f'){
	        $where['ml_star'] = $start;
	    }
	    if($end !='f'){
	        $where['ml_end'] = $end;
	    }
	    $ret = M("maoli")->where($where)->select();
	    $area = M("area");
	    
	    foreach ($ret as &$va){
	        $star=$va['ml_star'];
	        $end=$va['ml_end'];
	        if(!empty($star)){
	            //$arr=explode(",",$star);
	            $star_1= $area ->where("area_id =".$star)->field("area_name")->find();
	            //$star_2= $area ->where("area_id =".$arr[1])->field("area_name")->find();
	            $va['ml_star']=$star_1['area_name'];//.",".$star_2['area_name'];
	        }
	        if(!empty($end)){
	            //$arr=explode(",",$end);
	            $end_1= $area ->where("area_id =".$end)->field("area_name")->find();
	            //$end_2= $area ->where("area_id =".$arr[1])->field("area_name")->find();
	            $va['ml_end']=$end_1['area_name'];//.",".$end_2['area_name'];
	        }
	    }
	    //dump($ret);die();
	    $data['xlsName']  = "毛利管理--导出".date("Y-m-d H:i:s",time());
	    $data['xlsCell']  = array(
	        array('ml_id','毛利ID'),
	        array('ml_code','毛利编号'),
	        array('ml_star','起始'),
	        array('ml_end','终点'),
	        array('ml_price_one','1类车毛利'),
	        array('ml_price_two','2类车毛利'),
	        array('ml_price_three','3类车毛利'),
	        array('ml_price_four','4类车毛利'),
	        array('ml_price_five','5类车毛利')
	    );
	    $size = count($ret);
	    for($i=0;$i<$size;$i++){
	        $data['xlsData'][$i]['ml_id'] = $ret[$i]['ml_id'];
	        $data['xlsData'][$i]['ml_code'] = $ret[$i]['ml_code'];
	        $data['xlsData'][$i]['ml_star'] = $ret[$i]['ml_star'];
	        $data['xlsData'][$i]['ml_end'] = $ret[$i]['ml_end'];
	        $data['xlsData'][$i]['ml_price_one'] = $ret[$i]['ml_price_one']/100;
	        $data['xlsData'][$i]['ml_price_two'] = $ret[$i]['ml_price_two']/100;
	        $data['xlsData'][$i]['ml_price_three'] = $ret[$i]['ml_price_three']/100;
	        $data['xlsData'][$i]['ml_price_four'] = $ret[$i]['ml_price_four']/100;
	        $data['xlsData'][$i]['ml_price_five'] = $ret[$i]['ml_price_five']/100;
	    }
	    exportExcel($data['xlsName'],$data['xlsCell'],$data['xlsData']);
	}
	
	/**
	 * 导入
	 */
	function daoru_carXing(){
	    $area = M("carxing");
	    //$areaObj = M("area");
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
    			$datatime = date('Y-m-d',time());
    			for($currentRow=3;$currentRow<=$allRow;$currentRow++){
    				$cid = $currentSheet->getCell("A".$currentRow)->getValue();
    				$v['cxjj_id'] =  $cid!="" && $cid!=null && is_object($cid) ? $cid->__toString():$cid;
    				
    				$type_pid_ = $currentSheet->getCell('B'.$currentRow)->getValue();
    				$v["cxjj_brand"]= $type_pid_!="" && $type_pid_!=null && is_object($type_pid_) ? $type_pid_->__toString():$type_pid_;
    	
    				$type_id_ = $currentSheet->getCell('C'.$currentRow)->getValue();
    				$v['cxjj_pid']=$type_id_!="" && $type_id_!=null && is_object($type_id_) ? $type_id_->__toString():$type_id_;
    	
    				$description_ = $currentSheet->getCell('D'.$currentRow)->getValue();
    				$v['cxjj_types']= $description_!="" && $description_!=null && is_object($description_) ? $description_->__toString():$description_;
    				
    				$quality_ = $currentSheet->getCell('E'.$currentRow)->getValue();
    				$v['cxjj_quality']= $quality_!="" && $quality_!=null && is_object($quality_) ? $quality_->__toString():$quality_;
    				
    				$category_ = $currentSheet->getCell('F'.$currentRow)->getValue();
    				if($category_ == '1类车毛利'){
    				    $category_ = 'ml_price_one';
    				}else if($category_ == '2类车毛利'){
    				    $category_ = 'ml_price_two';
    				}else if($category_ == '3类车毛利'){
    				    $category_ = 'ml_price_three';
    				}else if($category_ == '4类车毛利'){
    				    $category_ = 'ml_price_four';
    				}else if($category_ == '5类车毛利'){
    				    $category_ = 'ml_price_five';
    				}else{
    				    $category_ = "";
    				}
    				$v['cxjj_category']= $category_;
    				$v['cxjj_name'] = _getFirstCharter($v["cxjj_brand"]);
    				//$v['area_add_time'] = $datatime;
    				$map = null;
    				if($v['cxjj_id']!=""){
    					$map['cxjj_id'] = array("eq",$v['cxjj_id']);
    				}
    				if($v['cxjj_pid']!=""){
    					$map['cxjj_pid'] = array("eq",$v['cxjj_pid']);
    				}
    				//if($v['area_type']!=""){
    				//	$map['area_type'] = array("eq",$v['area_type']);
    				//}
    				$vo=null;
    				if($map!=null){
    					$vo = $area->where($map)->find();
    				}
    				if($vo!=null&&count($vo)>0){
    					$map_['cxjj_id'] = array("eq",$vo['cxjj_id']);
    					$area ->where($map_)->save($v);
    				}else{
    					$area->add($v);
    				}
    				
    			}
    			@unlink ($savePath.$file_name);
    			$this->success("导入成功");
    		}else{
    			$this->error ( '不是Excel文件，重新上传' );
    		}
	    }
	}
	/**
	 * 导出
	 */
	function daochu_carXing(){
	    $brands =I('b');
	    $type =I('t');
	    if($brands!='f'&&$type=='f'){
	        $map['cxjj_pid'] = array('eq',$brands);
	    }else if($brands!='f'&&$type!='f'){
	        $map['cxjj_id'] = array('eq',$type);
	    }else if($brands=='f'&&$type=='f'){
	        $map['cxjj_pid'] = array('neq',0);
	    }
	    $ret = M("carxing")->where($map)->select();
	    $arr=array(
	        'ml_price_one' => '1类车毛利',
	        'ml_price_two' => '2类车毛利',
	        'ml_price_three' => '3类车毛利',
	        'ml_price_four' => '4类车毛利',
	        'ml_price_five' => '5类车毛利'
	    );
	    foreach($ret as &$va){
	        $va['cxjj_category']=$arr[$va['cxjj_category']];
	    }
	    $data['xlsName']  = "车型加价--导出".date("Y-m-d H:i:s",time());
	    $data['xlsCell']  = array(
	        array('cxjj_id','车型加价提车ID'),
	        array('cxjj_brand','车品牌'),
	        array('cxjj_pid','父ID'),
	        array('cxjj_types','类型'),
	        array('cxjj_quality','整备质量'),
	        array('cxjj_category','类别')
	    );
	    $size = count($ret);
	    for($i=0;$i<$size;$i++){
	        $data['xlsData'][$i]['cxjj_id'] = $ret[$i]['cxjj_id'];
	        $data['xlsData'][$i]['cxjj_brand'] = $ret[$i]['cxjj_brand'];
	        $data['xlsData'][$i]['cxjj_pid'] = $ret[$i]['cxjj_pid'];
	        $data['xlsData'][$i]['cxjj_types'] = $ret[$i]['cxjj_types'];
	        $data['xlsData'][$i]['cxjj_quality'] = $ret[$i]['cxjj_quality'];
	        $data['xlsData'][$i]['cxjj_category'] = $ret[$i]['cxjj_category'];
	    }
	    exportExcel($data['xlsName'],$data['xlsCell'],$data['xlsData']);
	}
	public function get_area_bycon(){
	    $name =I('name');
	    $pid =I('pid');
	    $model = D('Area');
	    $data = $model->get_area_bycon($name,$pid);
	    $this->ajaxReturn($data);
	}
}