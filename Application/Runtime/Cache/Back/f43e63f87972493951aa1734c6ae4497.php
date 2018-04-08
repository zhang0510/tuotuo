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
 <script src="/Public/Back/laydate/laydate.js"></script>
 <script src="/Public/JS/jquerytool_1.0v.js"></script>
<script>

	/* $("#pro").click(function(){
		$.anewAlert(1);
		$.post('/Back/Coupon/provinceQuery',{},function(data){
			$.anewAlert(1);
				$(this).append(data);
		});
	}); */
	$.ajaxSetup({
	    async : false
	});
	/* function provinceFun(){
		//$.anewAlert(1);
		$.post('/Back/Coupon/provinceQuery',{},function(data){
			//$.anewAlert(1);
				$("#pro").append(data);
		});
	} */
	
	
	function subFun(){
		var r = /^[0-9]*[1-9][0-9]*$/;
		var price = $("#fav_price").val();
		var start = $("#startime").val();
		var end = $("#endtime").val();
		if(price==''){
			$.anewAlert('请输入价格');
		}else if(start==''||end==''||start>=end){
			$.anewAlert('请输入正确的优惠券有效期');
		}else if(price==0){
			$.anewAlert('请填写正确的数目');
		}else if(r.test(price)==false){
			$.anewAlert('请填写正确的价格');
		}else{
			 $("#forms").submit();
		}
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
						<ul class="nav nav-tabs dd" id="tabnav">

						<!-- <li class="active">
						    <a href="">未发放</a><em>200</em>
						  </li>
						  <li><a href="">已发放</a></li>
						   <li><a href="">已使用</a></li> -->



						</ul>

						<div class="tab-content1">
						<div class="dq5">
						<form method="post" action="/Back/Couponyjh/couponInsert" id="forms">
					 <!-- <p>请选择可用目的地</p>

			             <dl><select class="dh1" name="province" id="pro" onchange="cityFun();">
								<option id='proP' value="<?php echo ($proId); ?>"><?php echo ($pro?$pro:'请选择省份'); ?></option>
								<?php if(is_array($list)): foreach($list as $key=>$vo): ?><option  value="<?php echo ($vo["area_id"]); ?>"><?php echo ($vo["area_name"]); ?></option><?php endforeach; endif; ?>
								<option value="">石家庄</option>
								<option value="">北京</option>
								<option value="">郑州</option>
							</select>
							<select class="dh2" name="city" id="city" >
								<option id='cityP' value="<?php echo ($cityId); ?>"><?php echo ($city?$city:'请选择城市'); ?></option>
								<option value="">石家庄</option>
								<option value="">北京</option>
								<option value="">郑州</option>
							</select>
						</dl> -->
					
						<p>请输入优惠劵面值（元）</p>
						<dl><input type="text" class="i_n text2" id="fav_price" placeholder="请输入优惠劵面值（元）" name="fav_price" value="<?php echo ($info['fav_price']/100); ?>"/></dl>

						 <p>请选择优惠劵可用时间</p>


						<dl>
						<input type="text" id="startime"  onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" class="i_n text2 dh1" placeholder="开始时间" name="fav_startime" value="<?php echo ($info['fav_startime']); ?>"/>
						<input type="text" id="endtime" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" class="i_n text2 dh2" placeholder="结束时间" name="fav_endtime" value="<?php echo ($info['fav_endtime']); ?>"/>
						</dl>

								<input type="hidden" name="fav_id" value="<?php echo ($info["fav_id"]); ?>">

						</form>
					    </div>


						<div style="clear:both"></div>

						<hr>
						<div class="sad1">
											<button class="btn btn-default7" type="button" onclick="subFun();">确定</button>

											<a href="/Back/Couponyjh/couponList"><button class="btn btn-default8" type="button">取消</button></a>
											</div>
						</div>


						</div> <!-- /widget -->

					</div> <!-- /span11 -->

				</div> <!-- /row -->

		</div>
		</div>

	</body>
</html>