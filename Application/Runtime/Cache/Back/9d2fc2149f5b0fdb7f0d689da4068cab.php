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
		var lc_short_name = $("#lc_short_name").val().trim();//公司简称
		var lc_lxrs = $("#lc_lxrs").val().trim();//负责人
		var lc_tel = $("#lc_tel").val().trim();//负责人电话
		var lc_diao = $("#lc_diao").val().trim();//调度员
		var lc_diao_tel = $("#lc_diao_tel").val().trim();//调度员电话
 		var lc_gen = $("#lc_gen").val().trim();//跟踪
		var lc_gen_tel = $("#lc_gen_tel").val().trim();//跟踪员电话
		
		if(lc_short_name!=''&&lc_lxrs!=''&&lc_tel!=''&&lc_diao!=''&&lc_diao_tel!=''&&lc_gen!=''&&lc_gen_tel!=''){
			$("#sub").submit();
		}else{
			alert('请先完善数据填写');
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
						<ul class="nav nav-tabs" id="tabnav">
					
					 	  <li class="active">
						    <a>物流公司添加|编辑</a>
						  </li>
					
			
						</ul>
						
						<div class="tab-content1">
						<form method="post" action="/Back/Logistics/compamyDoAdd" id="sub">
						<div class="dw7">
						   <div class="dw71">
							<dl>
							<div class="fh1">
							<span>*公司简称:</span>
							<input type="text" class="i_n text2" name="lc_short_name" id="lc_short_name"  value="<?php echo ($list["lc_short_name"]); ?>">
							</div>
							</dl>
							
							<dl>
							<div class="fh1">
							<span>公司全称:</span>
							<input type="text" class="i_n text2" name="lc_name" id="lc_name"  value="<?php echo ($list["lc_name"]); ?>">
							</div>
							</dl>
							
							
							<dl>
							<div class="fh1">
							<span>*负责人姓名:</span>
							<input type="text" class="i_n text2" name="lc_lxrs" id="lc_lxrs"  value="<?php echo ($list["lc_lxrs"]); ?>">
							</div>
							</dl>
							<dl>
							<div class="fh1">
							<span>*负责人手机号:</span>
							<input type="text" class="i_n text2" name="lc_tel" id="lc_tel"   value="<?php echo ($list["lc_tel"]); ?>">
							</div>
							</dl>
							
							<dl>
							<div class="fh1">
							<span>*调度员姓名:</span>
							<input type="text" class="i_n text2" name="lc_diao" id="lc_diao"   value="<?php echo ($list["lc_diao"]); ?>">
							</div>
							</dl>
							<dl>
							<div class="fh1">
							<span>*调度员手机号:</span>
							<input type="text" class="i_n text2" name="lc_diao_tel" id="lc_diao_tel"   value="<?php echo ($list["lc_diao_tel"]); ?>">
							</div>
							</dl>
							
							<dl>
							<div class="fh1">
							<span>*跟踪员姓名:</span>
							<input type="text" class="i_n text2" name="lc_gen" id="lc_gen"   value="<?php echo ($list["lc_gen"]); ?>">
							</div>
							</dl>
							<dl>
							<div class="fh1">
							<span>*跟踪员手机号:</span>
							<input type="text" class="i_n text2" name="lc_gen_tel" id="lc_gen_tel"   value="<?php echo ($list["lc_gen_tel"]); ?>">
							</div>
							</dl>
							
							<dl>
							<div class="fh1">
							<span>合同编号:</span>
							<input type="text" class="i_n text2" name="lc_ht_code" id="lc_ht_code" value="<?php echo ($list["lc_ht_code"]); ?>">
							</div>
							</dl>
							
							<dl>
							<div class="fh1">
							<span>*是否有效:</span>
							<?php if(($list["lc_status"] == 'Y')): ?><input type="radio" class="i_n " name="lc_status" value="Y" checked="checked">是
								<input type="radio" class="i_n " name="lc_status" value="N">否
							<?php elseif(($list["lc_status"] == 'N')): ?>
								<input type="radio" class="i_n " name="lc_status" value="Y">是
								<input type="radio" class="i_n " name="lc_status" value="N" checked="checked">否
							<?php else: ?>
								<input type="radio" class="i_n " name="lc_status" value="Y" checked="checked">是
								<input type="radio" class="i_n " name="lc_status" value="N">否<?php endif; ?>
														
							</div>
							</dl>
							
							<dl>
							<div class="fh1">
							<span>备注:</span>
							<textarea rows="20" cols="30" name="lc_bei" id="lc_bei" class="i_n text2"><?php echo ($list["lc_bei"]); ?></textarea>
							</div>
							</dl>
							
						   </div>
						</div>
						<input type="hidden" name="lc_code" value="<?php echo ($list["lc_code"]); ?>" />
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