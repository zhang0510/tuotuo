<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>妥妥车管理后台</title>
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
							<li>
								<a href="/Back/Auth/grouplist">管理角色</a>
							</li>
							<li class="active">
								<a href="/Back/Auth/operator">操作员管理</a>
							</li>
						</ul>

						<div class="tab-content1">
							<form id="form" action="/Back/Auth/operatoradd_act" method="post">
							<div class="dq5  dq5x">
								<dl>
									<div class="dropdown">
										<select class="height46" style="width:100%" name="group" id="sel">
											<option value="0">请选择角色</option>
											<?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$na): $mod = ($i % 2 );++$i;?><option value="<?php echo ($na["id"]); ?>"><?php echo ($na["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
									</div>
								</dl>
								<input type="hidden" name="admin_code" value="<?php echo ($data["admin_code"]); ?>">
								<dl>
									<input type="text" name="admin_name" class="i_n text2" value="<?php echo ($data["admin_name"]); ?>" placeholder="请输入操作员姓名"></dl>
								<dl>
									<input type="text" name="admin_acc" class="i_n text2" value="<?php echo ($data["admin_acc"]); ?>" placeholder="请输入操作员帐号（手机号码，用作登陆）"></dl>
								<dl>
									<input type="text" name="admin_pwd" class="i_n text2" value="" placeholder="请输入操作员密码"></dl>

							</div>
							</form>
							<hr>
							<div class="sad1">
								<button id="btn" class="btn btn-default7" type="button">确定</button>

								<button class="btn btn-default8" type="button"><a href="/Back/Auth/operator" style="color:#fff">取消</a></button>
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
<script>
	$('#btn').click(function(event) {
		$('#form').submit();
	});

	var gid = "<?php echo ($data["gid"]); ?>";
	$('#sel option').each(function(index, el) {
		if ($(this).val() == gid) {
			$(this).attr('selected',true);
		}
	});
</script>
</body>
</html>