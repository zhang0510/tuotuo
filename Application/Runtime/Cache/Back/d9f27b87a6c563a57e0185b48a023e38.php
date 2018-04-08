<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Dashboard - Bootstrap Admin</title>

	<meta name="viewport" content="width=device-width, ,initial-scale=0.5,minimum-scale=0.5,maximum-scale=0.5, user-scalable=no, user-scalable=no" />
	<meta name="apple-mobile-web-app-capable" content="yes" />

	<link href="/Public/Back/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/Public/Back/css/bootstrap-responsive.min.css" rel="stylesheet" />
	<link href="/Public/Back/css/adminia.css" rel="stylesheet" />

	<link href="/Public/Back/css/login.css" rel="stylesheet" />
	<script src="/Public/Back/js/jquery-1.7.2.min.js"></script>

	<script src="/Public/Back/js/bootstrap.js"></script>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
	<style></style>
<body class="">

	<div class="body_img">
		<div id="login-container1">

			<div id="login-header">

				<h3>
					<a href="/" target="_blank"><img src="/Public/Back/img//c_top.png"/></a>
				</h3>

			</div>
			<!-- /login-header -->

			<div id="login-content" class="clearfix">

			<form action="/Back/Login/doLogin" method="post" />

				<div class="form-groupdd">
					<div class="sd1"></div>
					<input type="text" name="username" class="form-control" id="firstname" 
							placeholder="请输入账号"></div>
				<div class="form-groupdd1">
					<div class="sd2"></div>
					<input type="password"  name="password" class="form-control" id="lastname" 
							placeholder="请输入密码"></div>
				<div class="form-groupdd3">
					<input type="text"  name="verify" placeholder="验证码" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '验证码：';}" class="form-control" id="code" 
							placeholder="请输入验证码"/>
					<a  id="captcha-container" >
            		<img  class="left15" style="height:46px"  alt="验证码" src="<?php echo U('Login/verify_c',array());?>" title="点击刷新"></a>
				</div>
				<div class="form-groupdd2">
					<input type="submit" style="width:100%;height:46px;" value="登&nbsp;&nbsp;录" class="btn btn-default7" name="">
				</div>
			</form>
		</div>
	</div>
</div>
    	<script>  
			var captcha_img = $('#captcha-container').find('img'); 
			var verifyimg = captcha_img.attr("src");  
			captcha_img.attr('title', '点击刷新');  
			captcha_img.click(function(){ 
				if( verifyimg.indexOf('?')>0){  
					$(this).attr("src", verifyimg+'&random='+Math.random());  
				}else{  
					$(this).attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());  
				}  
			});		
			function checklogin(){
				var name=$('#name').val();
				var password=$('#password').val();
				var verify=$('#verify').val();
				if(name==""||name=="用户名"){
				alert("用户名不能为空");	
					return false;
	
				}
				if(password==""||password=="密 码"){
					alert("密码不能为空");	
						return false;
		
					}
				if(verify==""||verify=="验证码"){
					alert("验证码不能为空");	
						return false;
		
					}
				
			}
			
			</script>

</body>
</html>