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
	function del(obj){
		var uid = $(obj).attr('name');
		if(confirm("是否删除")){
			$.post('/Back/Memberyjh/commonMemDel',{'uid':uid},function(data){
				if(data.sign=='Y'){
					$.anewAlert(data.info);
					window.location.reload();
				}else{
					$.anewAlert(data.info);
				}
			})
		}else{
			return false;
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
													<form action="/Back/Memberyjh/getCommonMem">
														<input type="text" placeholder="请输入关键词搜索" name="user_name" value="<?php echo ($name); ?>" class="i_n text2 width360">
														<button class="btn btn-default5" type="submit">搜索</button>
													</form>
													</div>
												</div>
												<!-- /controls -->
												<a href="/Back/Member/commonMemAdd"><button class="red btn btn-default5 fr" type="button">添加会员</button></a>
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
														<td>用户ID</td>
														<td>用户姓名</td>
														<td>手机号</td>
														<td>注册时间</td>
														<td>操作</td>

													</tr>
													<?php if(is_array($info)): foreach($info as $key=>$vo): ?><tr class="tr2">
															<td class="td3"><?php echo ($vo["id"]); ?></td>
															<td><?php echo ($vo["user_name"]); ?></td>
															<td><?php echo ($vo["tel"]); ?></td>
															<td><?php echo ($vo["addtime"]); ?></td>
															
															<td>
															    <a class="see1 getHistory" data-id="<?php echo ($vo["id"]); ?>" >查看</a>
																<a class="see1" href="/Back/Memberyjh/userEdit/id/<?php echo ($vo["id"]); ?>">修改</a>
																<a class="see2" href="javascript:;" name="<?php echo ($vo["id"]); ?>" onclick="del(this);">删除</a>
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
<div id="astr1" style="display:none;z-index:9999" class="tan1">
	<div class="tan11">
		<a class="closed">X</a>
		<h2>查看</h2>
		<div class="asc">
			<div class="asc1" id="hisList">
				
			</div>
			
		</div>
	</div>
</div>
<script type="text/javascript">
$(".getHistory").click(function(){
	var id=$(this).attr("data-id");
		$.ajax({
			   url:"/Back/Memberyjh/getHistory",
			   async:false,
			   type:'post',
			   data:'id='+id,
			   dataType:'json',
			   success: function(data){
					$("#hisList").html('');
					var str="<h2>会员ID：<span>"+data['userinfo']['id']+"</span></h2><h2>微信ID：<span>"+data['userinfo']['opin']+"</span></h2><h2>历史备注：</h2><ul><li>称呼："+data['userinfo']['user_name']+"   电话："+data['userinfo']['tel']+"</li>";		
				    var len=data['list'].length;
					if(len > 0){
						for(var i=0;i<len;i++){
							str+="<li>"+data['list'][i]+"</li></ul>";
						}
					}else{
						str+="<li>无记录</li></ul>";
					}
					
					$("#hisList").append(str);
					$("#astr1").css('display','block');
			   }
		   });
});
$('.closed').click(function(){
	$('#astr1').css('display','none');
});
</script>
</body>
</html>