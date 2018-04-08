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
<script src="/Public/JS/jquery.Huploadify.js"></script>
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
			</div> -->
			<div class="row">
			<form action="/Back/Worklwt/adv_insert" method="post" id='formMaster'>
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
						
						<div class="dw6">
						   <div class="dw61">
						   <dl>
						   <div class="dropdown">
								<button type="button" value="" class="btn1 dropdown-toggle" id="dropdownMenu1" style="" data-toggle="dropdown">
									<span id="awdawd" class="sss1"><?php if($des == ''): ?>请选择广告位置<?php else: echo ($des); endif; ?></span>
									 <span class="caret"></span>
									</button>
									<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
									<?php if(is_array($sk)): foreach($sk as $k=>$vo): ?><li role="presentation">
											<a role="menuitem" tabindex="-1" onclick="clickFuns(this,'<?php echo ($k); ?>');" data="<?php echo ($k); ?>" href="javascript:;"><?php echo ($vo); ?></a>
									 	</li><?php endforeach; endif; ?>
								   </ul>
								</div>
						   </dl>
						
							<dl><input type="text" name="title" id="title" class="i_n text2" placeholder="请输入广告标题" value="<?php echo ($data["adv_img_title"]); ?>"></dl>
							<dl><input type="text" name="adv_img_info" id="adv_img_info" class="i_n text2" placeholder="请输入描述" value="<?php echo ($data["adv_img_info"]); ?>"></dl>			
							<dl><input type="text" name="adv_img_url" class="i_n text2" placeholder="请输入指向链接http://" value="<?php echo ($data["adv_img_url"]); ?>" ></dl>
							<input type="hidden" name="adv_img" id="adv_img" value="<?php echo ($data["adv_img"]); ?>" >
							<input type="hidden" name="adv_code" id="adv_code" value="<?php echo ($data["adv_code"]); ?>" >
							<input type="hidden" name='token' value='<?php echo ($token); ?>'>
		 					<input type="hidden" id='adv_img_id' name='adv_img_id' value='<?php echo ($data["adv_img_id"]); ?>'>
							<div class="dw62">
							   <div class="dw62a">
							    <h2>上传广告图片</h2>
							     <div class="dw62c">
							     <?php if($data["adv_img"] == ''): ?><img id="oneclick" src="/Public/Back/images/de1.png">
							     <?php else: ?>
							    	 <img id="oneclick" src="<?php echo ($data["adv_img"]); ?>"><?php endif; ?>
								 
								 </div>
							   </div>
							   <div class="dw62b">
							   </div>
							</div>
						   </div>
						</div>
						
						<hr>
						<div class="sad1">
						<button class="btn btn-default7" type="button" onclick="bttonFun();">确定</button>
						<!-- <button class="btn btn-default8" type="button">取消</button> -->
						</div>
						</div>
						</div> <!-- /widget -->
					</div> <!-- /span11 -->
				</div> <!-- /row -->
				</form>
			</div>
		</div>
		<div id="upload" style="display:none;"></div>
		<script>
  		function clickFuns(obj,code){
  			$("#upload").html('');
  			var name = $(obj).html();
  			$("#awdawd").html(name);
  			var up = $('#upload').Huploadify({
				auto:true,
				fileTypeExts:'*.jpg;*.gif;*.png;*.jpeg',
				multi:false,
				fileSizeLimit:1024,
				showUploadedPercent:false,
				showUploadedSize:false,
				removeTimeout:1000,
				abs:1,
				canshu:code,
				uploader:'<?php echo U("Base/upload");?>',
				onUploadStart:function(file){
					console.log(file.name+'开始上传');
				},
				onInit:function(obj){
					console.log('初始化');
					console.log(obj);
				},
				onUploadComplete:function(file,data){
					var datas = $.parseJSON(data);
					if(datas.flag){
						$("#adv_img").val(datas.fileurl);
						$("#oneclick").attr('src',datas.fileurl);
					}else{
						$.anewAlert(datas.msg);
					}
				},
			});
  			$("#adv_code").val(code);
  		}
  		function bttonFun(){
	  		var us = $("#title").val();
	  		var ps = $("#adv_img").val();
	  		var adv_code = $("#adv_code").val();
	  		if(us==''){
	  			$.anewAlert('名称不能为空');
	  			return false;
	  		}
	  		if(ps==''){
	  			$.anewAlert('请选择一张图片上传');
	  			return false;
	  		}
	  		if(adv_code==''){
	  			$.anewAlert('请选择广告位置');
	  			return false;
	  		}
	  		$('#formMaster').submit();
	  	}
  		var codes_img = $("#adv_code").val();
  		var up = $('#upload').Huploadify({
			auto:true,
			fileTypeExts:'*.jpg;*.gif;*.png;*.jpeg',
			multi:false,
			fileSizeLimit:1024,
			showUploadedPercent:false,
			showUploadedSize:false,
			removeTimeout:1000,
			abs:1,
			canshu:codes_img,
			uploader:'<?php echo U("Base/upload");?>',
			onUploadStart:function(file){
				console.log(file.name+'开始上传');
			},
			onInit:function(obj){
				console.log('初始化');
				console.log(obj);
			},
			onUploadComplete:function(file,data){
				var datas = $.parseJSON(data);
				if(datas.flag){
					$("#adv_img").val(datas.fileurl);
					$("#oneclick").attr('src',datas.fileurl);
				}else{
					$.anewAlert(datas.msg);
				}
			},
		});
	  	$(function(){
			$("#oneclick").click(function(){
				$("#file_upload_1-button").click();
			});
			
		});
  	</script>
	</body>
</html>