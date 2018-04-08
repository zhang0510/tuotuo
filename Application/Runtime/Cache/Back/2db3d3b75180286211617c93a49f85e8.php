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
						<form action="/Back/Auth/groupadd_act" method="post" id="form">
							<div class="dq5">
								<dl>
									<input type="hidden" name="pid" value="<?php echo ($data["id"]); ?>">
									<input type="text" name="title" placeholder="请输入角色名称" class="i_n text2" value="<?php echo ($data["title"]); ?>"></dl>

								<dl class="dq54">
									<textarea class="dq53" name="description" placeholder="请对角色做出描述"><?php echo ($data["description"]); ?></textarea>
								</dl>
								<div class="dq55">请选择角色功能</div>
							</div>
							<div class="body_main0">
								<ul class="main_select1 checkbox">
									<?php if(is_array($arr)): foreach($arr as $key=>$vo): ?><!-- 一级 -->
										<LI class="part1">
											<label class="one">
												<input class="check_one" type="checkbox" onclick="chooseHeaderFun(this);" name='prower[]' value="<?php echo ($vo["id"]); ?>" <?php echo ($vo["che"]); ?>><?php echo ($vo["title"]); ?></label>
											<!-- 二级 -->
											<ul class="main_select2">
												<?php if(is_array($vo["son"])): $i = 0; $__LIST__ = $vo["son"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vos): $mod = ($i % 2 );++$i;?><li>
														<label class="two">
															<input class="check_two" type="checkbox" onclick="chooseFun(this);" name='prower[]' value="<?php echo ($vos["id"]); ?>" <?php echo ($vos["che"]); ?>><?php echo ($vos["title"]); ?></label>
														<!--三级 -->
														<ul class="main_select3">
															<?php if(is_array($vos["son"])): $i = 0; $__LIST__ = $vos["son"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voi): $mod = ($i % 2 );++$i;?><li>
																	<label class='three'>
																		<input class="check_three" type="checkbox" onclick="chooseFuns(this);" name='prower[]' value="<?php echo ($voi["id"]); ?>" <?php echo ($voi["che"]); ?>><?php echo ($voi["title"]); ?></label>
																</li><?php endforeach; endif; else: echo "" ;endif; ?>
														</ul>
														<!--三级 -->
													</li><?php endforeach; endif; else: echo "" ;endif; ?>
											</ul>
											<!-- 二级 -->
										</LI><?php endforeach; endif; ?>
									<!-- 一级 -->
								</ul>
								<input type="checkbox" id="quanxuan" onclick="quanxuanFun(this);">全选</div>

							<hr>
							<div class="sad1">
								<button class="btn btn-default7" id="btn" type="button">确定</button>

								<button class="btn btn-default8" type="button">
									<a href="/Back/Auth/grouplist" style="color:#fff">取消</a>
								</button>
							</div>
						</form>
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
	      //1级权限
	    	  function chooseHeaderFun(obj){
	    		if($(obj).is(':checked')=="checked"||$(obj).is(':checked')==true){
	  			//被选中情况
	  			$(obj).parent().siblings().find('input').prop("checked",true);
	  		}else{
	  			$(obj).parent().siblings().find('input').prop("checked",false);
	  			$("#quanxuan").attr("checked",false);
	  		}
	    	  }
	    	  //2级权限
	    	  function chooseFun(obj){
	    		if($(obj).is(':checked')=="checked"||$(obj).is(':checked')==true){
	  			//被选中情况
	  			$(obj).parent().siblings().find('input').prop("checked",true);
	  			$(obj).parent().parent().parent().siblings().find('input').prop("checked",true);
	  		}else{
	  			var flag = false;
	  			$(obj).parent().parent().siblings().find("input").each(function(){
	  				if($(this).is(':checked')==true){
	  					flag = true;
	  					return false;
	  				}
	  			})
	  			if(!flag){
	  				$(obj).parent().parent().parent().siblings().find("input").prop("checked",false);
	  			}
	  			$(obj).parent().siblings().find('input').prop("checked",false);
	  			$("#quanxuan").attr("checked",false);
	  		}
	    	  }
	    	  function chooseFuns(obj){
	    		if($(obj).is(':checked')=="checked"||$(obj).is(':checked')==true){
	  			//被选中情况
	    			$(obj).parent().parent().parent().siblings().find('input').prop("checked",true);
	  			$(obj).parent().parent().parent().parent().parent().siblings().find('input').prop("checked",true);
	  		}else{
	  			var flag = false;
	  			var bb = false;
	  			$(obj).parent().parent().siblings().find("input").each(function(){
	  				if($(this).is(':checked')==true){
	  					flag = true;
	  					return false;
	  				}
	  			})
	  			$(obj).parent().parent().parent().parent().parent().find(".check_two").each(function(){
	  				if($(this).is(':checked')==true){
	  					bb = true;
	  					return false;
	  				}
	  			})
	  			if(!flag){
	  				$(obj).parent().parent().parent().siblings().find("input").prop("checked",false);
	  				if($(obj).parent().parent().parent().parent().parent().find(".check_two:checked").length<=1){
	  					$(obj).parent().parent().parent().parent().parent().siblings().find('input').prop("checked",false);
	  				}
	  			}
	  			$(obj).parent().siblings().find('input').prop("checked",false);
	  			$("#quanxuan").attr("checked",false);
	  		}
	    	  }
	function quanxuanFun(obj){
	  			if(obj.checked == true){
	  				var ss = $("input[name='prower[]']");
	  				for(var i=0;i<ss.length;i++){
	  					ss[i].checked=true;
	  				}
	  			}else{
	  				var ss = $("input[name='prower[]']");
	  				for(var i=0;i<ss.length;i++){
	  					ss[i].checked=false;
	  				}
	  			}
	  		}
</script></body>
</html>