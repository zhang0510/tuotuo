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
<script>
	function del(obj){
		var id = $(obj).attr('name');
		$.post('/Back/Logistics/del',{'id':id},function(data){
			if(data.sign=='Y'){
				layer.msg(data.con);
				window.location.reload();
			}else{
				layer.msg(data.con);
			}
		})
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
								<a href="">物流公司</a>
							</li>
							<li>
								<a href="/Back/Logistics/driverShow">司机</a>
							</li>
						</ul>

						<div class="tab-content1">
							<div class="tab-content">
								<div class="tab-pane active">
									<form id="edit-profile" class="form-horizontal" >
									<fieldset>
										<div class="l_uit">
											<div class="control-group">
												<div style="float:left;" class="controls clec_t">
													<div class="v_pb">
														<input type="text" placeholder="请输入公司名称|负责人|调度员|跟踪员" name="name" value="<?php echo ($name); ?>" class="i_n text2 width360">
														<button class="btn btn-default5" type="submit">搜索</button>
													</div>
												</div>
												<!-- /controls -->
												<a href="/Back/Logistics/companyAdd/type/a"><button class="red btn btn-default5 fr" type="button">添加公司</button></a>
											</div>
											<script>
												$(function(){
													$('table tr.tr2:odd').css('background','#F0F0F0');
												});
											</script>
											<input type="hidden" id="num" value="<?php echo ($num); ?>" />
											<div class="l_table">
												<table>
													<tr class="tr1">
														<td>公司简称</td>
														<td>负责人|电话</td>
														<td>调度员|电话</td>
														<td>跟踪员|电话</td>
														<td>合同</td>
														<td>有效状态</td>
														<td>操作</td>
													</tr>
													<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr class="tr2">
															
															<td><?php echo ($vo["lc_short_name"]); ?></td>
															<td><?php echo ($vo["lc_lxrs"]); ?>|<?php echo ($vo["lc_tel"]); ?></td>
															<td><?php echo ($vo["lc_diao"]); ?>|<?php echo ($vo["lc_diao_tel"]); ?></td>
															<td><?php echo ($vo["lc_gen"]); ?>|<?php echo ($vo["lc_gen_tel"]); ?></td>
															<td>	
																<?php if(($vo["lc_ht_code"] != '')): echo ($vo["lc_ht_code"]); ?>
																<?php else: ?>
																	--<?php endif; ?>
															</td>
															<td>
																<?php if(($vo["lc_status"] == 'Y')): ?>有效
																<?php else: ?>
																	无效<?php endif; ?>
															
															</td>
															<td>
																<a class="see1" href="/Back/Logistics/companyAdd/id/<?php echo ($vo["lc_id"]); ?>/type/e">修改</a>
																<a class="see2" href="javascript:;" name="<?php echo ($vo["lc_id"]); ?>" onclick="del(this);">删除</a>
															</td>
														</tr><?php endforeach; endif; ?>

												</table>

											</div>
											<div class="l_fenye">
											<?php if($num != 0): echo ($page); endif; ?>
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