<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>妥妥运车管理后台</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, ,initial-scale=0.5,minimum-scale=0.5,maximum-scale=0.5, user-scalable=no" />
	<link rel="stylesheet" href="/Public/Back/css/bootstrap.min.css" />
	<link rel="stylesheet" href="/Public/Back/css/bootstrap-responsive.min.css" />
	<link rel="stylesheet" href="/Public/Back/css/unicorn.main.css" />
	<link rel="stylesheet" href="/Public/Back/css/unicorn.grey.css" class="skin-color" />
	<link rel="stylesheet" href="/Public/Back/css/li.css" class="skin-color" />
	<link href="/Public/Back/css/adminia.css" rel="stylesheet" />
	<link href="/Public/Back/css/yao.css" rel="stylesheet" class="skin-color" />
	<script src="/Public/Back/js/jquery.js"></script>
	<script src="/Public/Back/js/bootstrap.js"></script>
	<script src="/Public/JS/jquerytool_1.0v.js"></script>
	<script src="/Public/JS/layer/layer.js"></script>
	<script src="/Public/Back/laydate/laydate.js"></script>
	<!--[if lt IE 9]>
	<script src="js/html5.js"></script>
	<![endif]-->
	<script>
	$(document).ready(function(){
		var height=$(window).height()-80;
		$("#content").css('min-height',height);


	});

	</script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style>.l_table table tr td.td_d{width:200px;}</style>
</head>
<script src="/Public/JS/jquerytool_1.0v.js"></script>
<script>
	function submits(){
		var car_name = $("#car_name").val().trim();//公司简称
		var car_identity = $("#car_identity").val().trim();//负责人
		var car_tel = $("#car_tel").val().trim();//负责人电话
		var car_flag = $("#car_flag").val();//调度员
		var car_sheng = $("#car_sheng").val().trim();//调度员电话
		var car_shi = $("#car_shi").val().trim();//调度员电话
		
		if(car_name!=''&&car_tel!=''&&car_flag!=''&&car_sheng!=''&&car_shi!=''){
			$("#sub").submit();
		}else{
			alert('请先完善数据填写');
		}
	}
	
	function getArea(obj){
		var id = $(obj).val();
		$.post("/Back/Logistics/getSon",{id:id},function(data){
			if(data.sign){
				$("#car_shi").empty();
				var list = data.data;
				var size = list.length;
				var str = "";
				for(var i=0;i<size;i++){
					str+="<option value='"+list[i]['area_id']+"' >"+list[i]['area_name']+"</option>";
				}
				$("#car_shi").append(str);
			}
			
		});
	}
</script>
	<body>
		<div id="header">
			<h1><a href=""><img src="/Public/Back/images/logo.png"></a></h1>
           <h1><a href="">happy every day！</a></h1>					
		
		<div class="set1"><a href=""><img class="Rotation" src="/Public/Back/images/set1.png"></a></div>
			<div id="user-nav1" class="navbar navbar-inverse">
            <div class="user_p"><span class="sp1">欢迎您:</span><span  class="sp2"><?php echo ($master["admin_name"]); ?></span><span   class="sp3">
			<ul>
			 <li><a href="/Back">主页</a></li>
			 <li><a href="/Back/Login/logout">退出</a></li>
			</ul>
			
			</span></div>
        </div>
</div>
<div class="clear_both"></div>
		<div class="clear_both"></div>
     <div id="main-pyf">
		<div id="sidebar">
			<ul>
				<?php if(is_array($leftprower)): $i = 0; $__LIST__ = $leftprower;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="/Back/<?php echo ($vo["name"]); ?>"  class="flag" type="<?php echo ($vo["id"]); ?>"><span><?php echo ($vo["title"]); ?></span><b></b></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		
		</div>
<script type="text/javascript">
		var id = "<?php echo ($id); ?>";
		$('#sidebar ul li a').each(function(index, el) {
			console.log($(this).attr('type'));
			if ($(this).attr('type') == id) {
				$(this).parent().addClass('active');
			}
		});
</script>
	
		<div id="content">
	<!-- 		<div class="ico-pt span12">
				<h4>店铺管理</h4>
			</div> -->
			<div class="row">
					
					<div class="tsan113">
				
						<div class="widget">

								<div class="tabbable">
						<ul class="nav nav-tabs" id="tabnav">
					
					 	  <li class="active">
						    <a>司机添加|编辑</a>
						  </li>
					
			
						</ul>
						
						<div class="tab-content1">
						<form method="post" action="/Back/Logistics/driverDoAdd" id="sub">
						<div class="dw7">
						   <div class="dw71">
							<dl>
							<div class="fh1">
							<span>*司机名称:</span>
							<input type="text" class="i_n text2" name="car_name" id="car_name"  value="<?php echo ($list["car_name"]); ?>">
							</div>
							</dl>
							
							<dl>
							<div class="fh1">
							<span>*司机身份证:</span>
							<input type="text" class="i_n text2" name="car_identity" id="car_identity"  value="<?php echo ($list["car_identity"]); ?>">
							</div>
							</dl>
							
							
							<dl>
							<div class="fh1">
							<span>*司机电话:</span>
							<input type="text" class="i_n text2" name="car_tel" id="car_tel"  value="<?php echo ($list["car_tel"]); ?>">
							</div>
							</dl>
							<dl>
							<div class="fh1">
							<span>*省市:</span>
							<select name="car_sheng" id="car_sheng" onchange="return getArea(this);">
								<option value="">选择省份</option>
								<?php if(is_array($area)): foreach($area as $key=>$vo): if(($vo["area_id"] == $sheng) ): ?><option value="<?php echo ($vo["area_id"]); ?>" selected="selected"><?php echo ($vo["area_name"]); ?></option>
									<?php else: ?>
										<option value="<?php echo ($vo["area_id"]); ?>" ><?php echo ($vo["area_name"]); ?></option><?php endif; endforeach; endif; ?>
							</select>
							<select name="car_shi" id="car_shi">
								
								
								<?php if(($list["car_sheng"] != '') ): ?><option value="<?php echo ($list["car_shi"]); ?>" selected="selected"><?php echo ($list["car_shi_name"]); ?></option>
									<?php else: ?>
										<option value="">选择市</option><?php endif; ?>
							</select>
							</div>
							</dl>
							
							<dl>
							<div class="fh1">
							<span>*是否有效:</span>
							<?php if(($list["lc_status"] == 'Y')): ?><input type="radio" class="i_n text2" name="car_flag" value="Y" checked="checked">是
								<input type="radio" class="i_n text2" name="car_flag" value="N">否
							<?php elseif(($list["lc_status"] == 'N')): ?>
								<input type="radio" class="i_n text2" name="car_flag" value="Y">是
								<input type="radio" class="i_n text2" name="car_flag" value="N" checked="checked">否
							<?php else: ?>
								<input type="radio" class="i_n text2" name="car_flag" value="Y" checked="checked">是
								<input type="radio" class="i_n text2" name="car_flag" value="N">否<?php endif; ?>
														
							</div>
							</dl>
							
							<dl>
							<div class="fh1">
							<span>合同编号:</span>
							<input type="text" class="i_n text2" name="car_he_code" id="car_he_code" value="<?php echo ($list["car_he_code"]); ?>">
							</div>
							</dl>
							<!-- 
							<dl>
							<div class="fh1">
							<span>备注:</span>
							<textarea rows="20" cols="30" name="lc_bei" id="lc_bei" class="i_n text2"><?php echo ($list["lc_bei"]); ?></textarea>
							</div>
							</dl>
							 -->
						   </div>
						</div>
						<input type="hidden" name="car_code" value="<?php echo ($list["car_code"]); ?>" />
						</form>
						
						<hr>
						<div class="sad1">
						<button class="btn btn-default7"  type="button" onclick="submits();">确定</button>
						<a href="/Back/Logistics/companyShow"><button class="btn btn-default8" type="button">取消</button></a>
						</div>
						</div>
							
							
						</div> <!-- /widget -->
						
					</div> <!-- /span11 -->
					
				</div> <!-- /row -->

		</div>
		</div>

	</body>
	
</html>