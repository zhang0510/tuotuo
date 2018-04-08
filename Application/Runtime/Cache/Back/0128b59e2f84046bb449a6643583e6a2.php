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
	function checkname(){
		var name = $('#user_name').val();
		if(name==''){
			$.anewAlert('请输入用户名');
			$("#namecheck").val('Y');
		}else{
			$("#namecheck").val('');
		}
	}
	function checkpwd(){
		var pwd = $('#user_pwd').val();
		if(pwd==''){
			$.anewAlert('请输入密码');
			$("#pwdcheck").val('Y');
		}else if(pwd.length<8||pwd.length>12){
			$.anewAlert('密码长度为8-12位');
			$("#pwdcheck").val('Y');
		}else{
			$("#pwdcheck").val('');
		}
	}
	function checkide(){
		var ide = $('#identity').val();
		if(!$.isIdCardNo(ide)){
			//$.anewAlert("身份证格式不对");
			$("#idecheck").val('Y');
		}else{
			$("#idecheck").val('');
		}
	}
	function checktel(){
		var tel = $("#tel").val();
		if(!$.check_Mobile(tel)){
			$.anewAlert("手机号格式不对");
			$("#telcheck").val('Y');
		}else{
			$("#telcheck").val('');
		}
	}
	function checkemail(){
		var email = $("#email").val();
		if(!$.check_Emails(email)){
			//$.anewAlert("邮箱格式不符");
			$("#emailcheck").val('Y');
		}else{
			$("#emailcheck").val('');
		}
	}
	function submits(){
		var name = $("#namecheck").val();
		var pwd = $("#pwdcheck").val();
		var email = $("#emailcheck").val();
		var ide = $("#idecheck").val();
		var tel = $("#telcheck").val();
		var pic = $('#pic').val();
		if(name!='Y'&&pwd!='Y'&&tel!='Y'){
			$("#sub").submit();
		}else{
			$.anewAlert('请先完善数据填写');
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
					
					 <!-- <li class="active">
						    <a href="">普通会员</a>
						  </li>
					 <li>
						    <a href="">大客户管理</a>
						  </li>
						   <li>
						    <a href="">潜在会员</a>
						  </li> -->
			
						</ul>
						
						<div class="tab-content1">
						<form method="post" action="/Back/Memberyjh/doEdit" id="sub">
						<div class="dw7">
						   <div class="dw71">
							<!-- <dl>
							<div class="fh1">
							<span>CODE:</span>
							<input type="text" class="i_n text2" value="CTT000000021">
							</div>
							</dl>-->
							<dl>
							<div class="fh1">
							<span>用户姓名:</span>
							<input type="text" class="i_n text2" name="user_name" id="user_name" placeholder="请输入用户名" onblur="checkname(this);" value="<?php echo ($info["user_name"]); ?>">
							</div>
							</dl>
							<dl>
							<div class="fh1">
							<span>手机号:</span>
							<input type="text" class="i_n text2" name="tel" id="tel" placeholder="请输入用户手机号用作登录" onblur="checktel(this);" value="<?php echo ($info["tel"]); ?>">
							</div>
							</dl>
							<dl>
							<div class="fh1">
							<span>用户身份证号码:</span>
							<input type="text" class="i_n text2" name="identity" id="identity" placeholder="请输入用户身份证号码" onblur="checkide(this);" value="<?php echo ($info["identity"]); ?>">
							</div>
							</dl>
							<dl>
							<div class="fh1">
							<span>邮箱:</span>
							<input type="text" class="i_n text2" name="email" id="email" placeholder="请输入邮箱" onblur="checkemail(this);" value="<?php echo ($info["email"]); ?>">
							</div>
							</dl>
							<!-- <dl>
							<div class="fh1">
							<span>关联微信号:</span>
							<input type="text" class="i_n text2" value="dudnadadaa">
							</div>
							</dl> -->
							<dl>
							<div class="fh1">
							<span>请输入密码:</span>
							
							<input type="text" class="i_n text2" name="user_pwd" id="user_pwd" placeholder="请输入用户密码" onblur="checkpwd(this);" >
							</div>
							
							</dl>
							<!--<div class="dw62">
							   <div class="dw62a">
							    <h2>上传用户头像</h2>
							     <div class="dw62c">
								 <img id="show"  src="<?php echo ($info["portrait"]); ?>" />
								 </div>
							   </div>
							   <div class="dw62b">
							   <input type="hidden" id="pic" name="portrait" value="<?php echo ($info["portrait"]); ?>">
								<div id="upload" style="display:none;"></div>
							   <!-- <input type="file" class="i_n text2" value=""> 
							   <button class="btn btn-default7" id="oneclick" type="button">点击上传</button>
							   </div>
							</div>-->
						   </div>
						</div>
						<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>" />
						</form>
						
						<input type="hidden" id="namecheck"/>
						<input type="hidden" id="emailcheck"/>
						<input type="hidden" id="idecheck"/>
						<input type="hidden" id="pwdcheck"/>
						<input type="hidden" id="telcheck"/>
						
						<hr>
						<div class="sad1">
						<button class="btn btn-default7"  type="button" onclick="submits();">确定</button>
						<a href="/Back/Memberyjh/getUserList"><button class="btn btn-default8" type="button">取消</button></a>
						<!-- <a href="/Back/Member/upgrade/id/<?php echo ($info["id"]); ?>"><button class="btn btn-default10" type="button">升级为大客户</button></a> -->
						</div>
						</div>
							
							
						</div> <!-- /widget -->
						
					</div> <!-- /span11 -->
					
				</div> <!-- /row -->

		</div>
		</div>

	</body>
	<script src="/Public/JS/jquery.Huploadify.js"></script>
	<script>
		$(function(){
			var up = $('#upload').Huploadify({
				auto:true,
				fileTypeExts:'*.jpg;*.gif;*.png;*.jpeg',
				multi:false,
				fileSizeLimit:1024,
				showUploadedPercent:false,
				showUploadedSize:false,
				removeTimeout:1000,
				abs:1,//隐藏按钮序号
				uploader:'<?php echo U("Base/upload");?>',//上传方法路径
				canshu:'OPINION',//特征值:用于进行上传限制
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
						$("#pic").val(datas.fileurl);
						$("#show").attr('src',datas.fileurl);
					}else{
						$.anewAlert(datas.msg);
					}
				},
			});
			$("#oneclick").click(function(){
				$("#file_upload_1-button").click();
			});
			
		});
</script>
</html>