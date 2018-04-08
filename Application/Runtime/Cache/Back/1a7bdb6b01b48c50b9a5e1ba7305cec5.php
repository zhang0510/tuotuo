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
								<a href="/Back/Worklwt/advList">广告列表</a>
							</li>
							<li class="">
								<a href="/Back/Worklwt/link">友情链接列表</a>
							</li>
						</ul>

						<div class="tab-content1">
							<div class="tab-content">
								<div class="tab-pane active">
									<form id="edit-profile" class="form-horizontal" />
									<fieldset>
										<div class="l_uit">
											<div class="control-group">

												<div style="float:left;" class="controls clec_t">
													<div class="v_pb">
														<input type="text" id="fskj" placeholder="请输入广告标题" value="<?php echo ($name); ?>" class="i_n text2 width360">
														<button class="btn btn-default5" onclick="awdfuns();" type="button">搜索</button>
													</div>
												</div>
												<!-- /controls -->
												<a href="/Back/Worklwt/advAdd"><button class="red btn btn-default5 fr" type="button">添加广告</button></a>

											</div>
											<script>
												$(function(){
													$('table tr.tr2 height70:odd').css('background','#F0F0F0');
												});
												function awdfuns(){
													var ss = $("#fskj").val();
													window.location.href="/Back/Worklwt/advList/name/"+ss;
												}
											</script>
											<div class="l_table">
												<table>
													<tr class="tr1">
														<td>广告标题</td>
														<td>广告图片</td>
														<td>位置</td>
														<td width="150" style="max-width:250px;width:150px;">链接</td>
														<td>操作</td>
													</tr>
													<?php if(is_array($list["list"])): foreach($list["list"] as $key=>$vo): ?><tr class="tr2 height70">
														<td><?php echo ($vo["adv_img_title"]); ?></td>
														<td><img src="<?php echo ($vo["adv_img"]); ?>" class="max" alt=""></td>
														<td><?php echo ($vo["dis"]); ?></td>
														<td class="td_d2" align="center"><?php echo ($vo["adv_img_url"]); ?></td>
														<td>
															<a href="/Back/Worklwt/advAdd/id/<?php echo ($vo["adv_img_id"]); ?>" class="see1">修改</a>
															<a href="/Back/Worklwt/advDels/id/<?php echo ($vo["adv_img_id"]); ?>" class="see2">删除</a>
														</td>
														</tr><?php endforeach; endif; ?>
												</table>
											</div>
											<div class="l_fenye">
												<?php echo ($list["show"]); ?>
											</div>
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
		</div>
	</div>
</body>
</html>