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
<script src="/Public/laydate/laydate.js"></script>
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
<script language="javascript" src="/Public/JS/LodopFuncs.js"></script>
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
	</div>
	-->
	<div class="row">

		<div class="tsan113">

			<div class="widget">

				<div class="tabbable">
					<ul class="nav nav-tabs" id="tabnav">
						<li class="active">
							<a >留言列表</a>
							
						</li>
					
                    </ul>
                <script>
					$("#cctv").click(function(){
						if($(".cctv1").css("display")=="none"){
							$(".cctv1").show();
						}else{
							$(".cctv1").hide();
						}
					});
					$(function(){
						var order_status="<?php echo ($order_status); ?>";
						if(order_status=='C'||order_status=='Y'||order_status=='M'||order_status=='N'||order_status=='B'||order_status=='G'||order_status=='D'){
							$(".cctv1").show();
						}
					})
				</script>

					<div class="tab-content1">
						<div class="tab-content">
							<div class="tab-pane active">
								<form id="edit-profile" class="form-horizontal" />
								<fieldset>
									<div class="l_uit">
										<div class="control-group">

											<div style="float:left;" class="controls clec_t">
												<!-- <div class="dropdown">
													<select class="height46" name="" id="pay_status">
														<option value="0">请选择支付方式</option>
														<option value="W">网上支付</option>
														<option value="H">货到付款</option>
													</select>
												</div> -->
												<input type="text" style="float:left; margin-left:10px" class="i_n text2" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" id="startime" placeholder="起始时间" value="" readonly="readonly">					<input type="text" style="float:left;margin-left:10px;" class="i_n text2" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" id="endtime" value="" placeholder="结束时间" readonly="readonly">
												
												<div class="v_pb">	
													<input type="text" id="phone" value="<?php echo ($phone); ?>" name="phone" placeholder="请输入手机号"  class="i_n text2">
													<button class="btn btn-default5" id="btn" type="button">搜索</button>
												</div>

											</div>
											<!-- /controls -->

										</div>
										<script>
												$(function(){
													$('table tr.tr2:odd').css('background','#F0F0F0');
												});
												
											</script>
										<div class="l_table">
											<table>
												<tr class="tr1">
													
													<td>手机号</td>
													<td>内容</td>
													<td>时间</td>
													
												</tr>
												<?php if(is_array($data["list"])): $i = 0; $__LIST__ = $data["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="tr2">
													   <td><?php echo ($vo["phone"]); ?></td>
													   <td><?php echo ($vo["content"]); ?></td>
													   <td><?php echo ($vo["time"]); ?></td>
														
													</tr><?php endforeach; endif; else: echo "" ;endif; ?>
											</table>

										</div>
										<div class="l_fenye"><?php if($data["page"] != ''): echo ($data["page"]); endif; ?></div>
									</div>
								</fieldset>
							</form>
						</div>

					</div>
				</div>

			</div>

		</div>
		<!-- /widget -->

	</div>
	<!-- /span11 -->

</div>
<!-- /row -->
<style>
	.l_table table tr td a{
		color: #000;
	}
</style>
</div>
</div>
<script>
//搜索
$('#btn').click(function(event) {
    var phone = $('#phone').val();
    var startime = $('#startime').val();
    var endtime = $('#endtime').val();
   	if (startime == '') {
   		startime = 0;
   	}
   	if (endtime == '') {
   		endtime = 0;
   	}
    if (phone) {
    	window.location.href="/Back/Liu/index/star/"+startime+"/end/"+endtime+"/phone/"+phone;
    }else{
    	window.location.href="/Back/Liu/index/star/"+startime+"/end/"+endtime;
    }        
});
</script>
</body>
</html>