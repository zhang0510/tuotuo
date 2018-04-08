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
							<li >
                                <a href="/Back/Worktwo/referOrder">咨询下单</a>
                            </li>
							<li class="active">
                                <a >咨询列表</a>
                            </li>
                            <li >
                                <a href="/Back/Worktwo/referMarkList">待回电</a>
                            </li>
							<li>
                                <a href="/Back/Worktwo/huiList">待回访</a>
                            </li>
							<li>
                                <a href="/Back/Worktwo/qHuiList">全部回访</a>
                            </li>
						</ul>

						<div class="tab-content1">
							<div class="tab-content">
								<div class="tab-pane active">
									<form id="edit-profile" class="form-horizontal" />
									<fieldset>
										<div class="l_uit">
											<!-- <div class="control-group">

												<div style="float:left;" class="controls clec_t">
													<div class="v_pb">
														<input type="text" id="fskj" placeholder="请输入手机号" value="<?php echo ($name); ?>" class="i_n text2 width360">
														<button class="btn btn-default5" onclick="awdfuns();" type="button">搜索</button>
													</div>
												</div>
												/controls
												<a href="/Back/Worklwt/latencyMemberAdd"><button class="red btn btn-default5 fr" type="button">添加潜在会员</button></a>
											</div> -->
											<script>
												$(function(){
													$('table tr.tr2:odd').css('background','#F0F0F0');
												});
												/* function awdfuns(){
													var ss = $("#fskj").val();
													window.location.href="/Back/Worklwt/latencyMemberList/name/"+ss;
												} */
											</script>
											<div class="l_table">
												<table>
													<tr class="tr1">
														<td>咨询日期</td>
														<td>咨询编号</td>
														<td>客服</td>
														<td>客户</td>
														<td>车辆信息</td>
														<td>发运线路</td>
														<td>共计费用</td>
														<td>是否回电</td>
														<td>回电备注</td>
													</tr>
													<?php if(is_array($list["list"])): foreach($list["list"] as $key=>$vo): ?><tr class="tr2">
														<td><?php echo ((isset($vo["tr_duan"]) && ($vo["tr_duan"] !== ""))?($vo["tr_duan"]):"-"); ?></td>
														<td><?php echo ((isset($vo["tr_id"]) && ($vo["tr_id"] !== ""))?($vo["tr_id"]):"-"); ?></td>
														<td><?php echo ((isset($vo["adname"]) && ($vo["adname"] !== ""))?($vo["adname"]):"-"); ?></td>
														<td><?php echo ((isset($vo["tr_name"]) && ($vo["tr_name"] !== ""))?($vo["tr_name"]):"-"); ?></td>
														<td><?php echo ((isset($vo["tr_carxing"]) && ($vo["tr_carxing"] !== ""))?($vo["tr_carxing"]):"-"); ?></td>
														<td><?php echo ((isset($vo["line"]) && ($vo["line"] !== ""))?($vo["line"]):"-"); ?></td>
														<td><?php echo ($vo['tr_yun']/100); ?></td>
														<td><?php if($vo["tr_mark"] == 'Y'): ?>是<?php else: ?>否<?php endif; ?></td>
														<td><?php echo ((isset($vo["tr_bei"]) && ($vo["tr_bei"] !== ""))?($vo["tr_bei"]):"-"); ?></td>
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
			<!-- /row
,<?php echo ($vo["order_info_zj"]); ?>,<?php echo ($vo["c_shi"]); ?>,<?php echo ($vo["z_shi"]); ?>,<?php echo ($vo["order_info_brand"]); ?>,<?php echo ($vo["order_info_type"]); ?>
tel,total,start,end,brand,type
			-->
		</div>
	</div>
<script>
		function queFun(id){
			if(window.confirm('确定回电?')){
				$.post("/Back/Worktwo/checkRefer",{id:id},function(data){
					if(data){
						layer.msg("确认成功");
						window.location.reload();
					}else{
						layer.msg("确认失败");
						return false;
					}
					
				},'json');
             }else{
                return false;
            }
		}
</script>
</body>
</html>