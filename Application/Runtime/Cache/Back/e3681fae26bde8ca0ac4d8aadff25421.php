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
			<form action="/Back/Worklwt/systemUpdate" method="post" id='formMaster'>
				<div class="tsan113">
					<div class="widget">
						<div class="tabbable">
						<ul class="nav nav-tabs" id="tabnav">
				 		  	<li class="active">
						    	<a href="/Back/Worklwt/setSystem">系统设置</a>
						  	</li>
						</ul>
						<div class="tab-content1">
						
						<div class="dw6">
						   <div class="dw61">
							<dl><input type="text" id="title" name="title" value="<?php echo ($info["title"]); ?>" placeholder="首页标题" class="i_n text2"></dl>
							<dl><input type="text" id="keywords" name="keywords" value="<?php echo ($info["keywords"]); ?>" placeholder="首页关键字" class="i_n text2"></dl>
							<dl><input type="text" id="description" name="description" value="<?php echo ($info["description"]); ?>" placeholder="首页描述" class="i_n text2"></dl>
							<dl><input type="text" id="icp" name="icp" value="<?php echo ($info["icp"]); ?>" placeholder="备案号" class="i_n text2"></dl>
							<dl><input type="text" id="address" name="address" value="<?php echo ($info["address"]); ?>" placeholder="地址" class="i_n text2"></dl>
							<dl><input type="text" id="tel" name="tel" value="<?php echo ($info["tel"]); ?>" placeholder="联系方式" class="i_n text2"></dl>
							<dl><input type="text" id="acale" name="acale" value="<?php echo ($info["acale"]); ?>" placeholder="财务结算保费费率(%)" class="i_n text2"></dl>
							<dl><input type="text" id="acale_clent" name="acale_clent" value="<?php echo ($info["acale_clent"]); ?>" placeholder="客户下单保费费率(%)" class="i_n text2"></dl>
							<!-- <dl><input type="text" id="pay_time" name="pay_time" value="<?php echo ($info["pay_time"]); ?>" placeholder="后台支付时限时间  单位分钟" class="i_n text2"></dl> -->
							<dl><input type="text" id="vat_rate" name="vat_rate" value="<?php echo ($info["vat_rate"]); ?>" placeholder="增值税率(%)" class="i_n text2"></dl>
							<dl><input type="text" id="tar_rate" name="tar_rate" value="<?php echo ($info["tar_rate"]); ?>" placeholder="普票税率(%)" class="i_n text2"></dl>
							<input type="hidden" name="qrcode" id="qrcode" value="<?php echo ($info["qrcode"]); ?>">
							<div class="dw62">
							   <div class="dw62a">
							    <h2>二维码上传</h2>
							     <div class="dw62c">
								 <?php if($info["qrcode"] == ''): ?><img id="oneclick" src="/Public/Back/images/de1.png">
							     <?php else: ?>
							    	 <img id="oneclick" src="<?php echo ($info["qrcode"]); ?>"><?php endif; ?>
								 </div>
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
  		function bttonFun(){
	  		var title = $("#title").val();
	  		var keywords = $("#keywords").val();
	  		var description = $("#description").val();
	  		var icp = $("#icp").val();
	  		var address = $("#address").val();
	  		var tel = $("#tel").val();
	  		var qrcode = $("#qrcode").val();
	  		var acale = $('#acale').val();
	  		var acale_clent=$("#acale_clent").val();
	  		var pay_time=$("#pay_time").val();
	  		var vat_rate=$("#vat_rate").val();
	  		var tar_rate=$("#tar_rate").val();
	  		if(title==''){
	  			$.anewAlert('请输入标题');
	  			return false;
	  		}
	  		if(keywords==''){
	  			$.anewAlert('请输入关键字');
	  			return false;
	  		}
	  		if(description==''){
	  			$.anewAlert('请输入描述');
	  			return false;
	  		}
	  		if(icp==''){
	  			$.anewAlert('请输入备案号');
	  			return false;
	  		}
	  		if(address==''){
	  			$.anewAlert('请输入地址');
	  			return false;
	  		}
	  		if(tel==''){
	  			$.anewAlert('请输入联系方式');
	  			return false;
	  		}
	  		if(acale==''){
	  			$.anewAlert('请输入财务结算保费费率');
	  			return false;
	  		}
	  		if(acale_clent==''){
	  			$.anewAlert('请输入客户下单保费费率');
	  			return false;
	  		}
	  		if(pay_time==''){
	  			$.anewAlert('请输入支付时限时间');
	  			return false;
	  		}
	  		if(vat_rate==''){
	  			$.anewAlert('请输入增值税率');
	  			return false;
	  		}
	  		if(tar_rate==''){
	  			$.anewAlert('请输入普票税率');
	  			return false;
	  		}
	  		if(qrcode==''){
	  			$.anewAlert('请选择上传图片');
	  			return false;
	  		}
	  		$('#formMaster').submit();
	  	}
  		var up = $('#upload').Huploadify({
			auto:true,
			fileTypeExts:'*.jpg;*.gif;*.png;*.jpeg',
			multi:false,
			fileSizeLimit:1024,
			showUploadedPercent:false,
			showUploadedSize:false,
			removeTimeout:1000,
			abs:1,
			uploader:'<?php echo U("Worklwt/upload");?>',
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
					$("#qrcode").val(datas.fileurl);
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