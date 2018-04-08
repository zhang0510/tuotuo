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
								<a href="/Back/Auth/grouplist">管理角色</a>
							</li>
							<li>
								<a href="/Back/Auth/operator">操作员管理</a>
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
														<input type="text" value="<?php echo ($val); ?>" placeholder="请输入关键词搜索" class="i_n text2 width360">
														<button id="btn" class="btn btn-default5" type="button">搜索</button>
													</div>
												</div>
												<!-- /controls -->
												<a href="/Back/Auth/groupadd" style="color:#fff"><button class="red btn btn-default5 fr" type="button">添加角色</button></a>
											</div>
											<script>
												$(function(){
													$('table tr.tr2:odd').css('background','#F0F0F0');
												});
												
											</script>
											<div class="l_table">
												<table>
													<tr class="tr1">
														<td>角色</td>
														<td>下属操作员数量</td>
														<td>管理描述</td>
														<td>操作</td>

													</tr>
													<?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr class="tr2">
														<td class="td3"><?php echo ($vo["title"]); ?></td>
														<td><?php echo ($vo["num"]); ?></td>
														<td><?php echo ($vo["description"]); ?></td>
														<td>
														<?php if($k == 1 ): ?><a class="see1">修改</a>
														<?php else: ?>
															<a  href="/Back/Auth/groupadd/pid/<?php echo ($vo["id"]); ?>" class="see1">修改</a>
															<a del="<?php echo ($vo["id"]); ?>" class="see2">删除</a><?php endif; ?>
														</td>
													</tr><?php endforeach; endif; else: echo "" ;endif; ?>

												</table>

											</div>
											<div class="l_fenye">
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
<script>
	$('#btn').click(function(event) {
		var val = $('.text2').val();
		window.location.href="/Back/Auth/grouplist/val/"+val;
	});
    //删除    
    $('.see2').click(function(event) {
        var pid = $(this).attr('del');
        if (confirm('确定删除此信息吗？')) {
            $.post('/Back/Auth/group_del', {pid: pid}, function(data) {
                alert(data);
                window.location.reload();
            },'json');
        }
    })
</script>
</body>
</html>