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
<link rel="stylesheet" href="/Public/kindeditor/themes/default/default.css" />
<script charset="utf-8" src="/Public/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/Public/kindeditor/lang/zh_CN.js"></script>
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
				<div class="tsan113">
					<div class="widget">
						<div class="tabbable">
						<ul class="nav nav-tabs" id="tabnav">
					 	    <li class="active">
								<a href="/Back/Worklwt/contList">微信提车员自动回复设置</a>
							</li>
							<!-- 
							<li>
								<a href="/Back/Worklwt/ideaList">意见反馈</a>
							</li>
							 -->
						</ul>
						<div class="tab-content1">
						<form action="/Back/OtherInfo/eventReturnAdd"   method="post" >
						<div class="dw6" style="height: 1250px;">
						   <div class="dw61" style="height: 550px;">
						   <dl>
						   	<input type="text" name="title" id="title" class="i_n text2" placeholder="请输入文章标题" value="<?php echo ($otherInfo["title"]); ?>">
						   </dl>
							<dl><input type="text" name="urlpath" id="urlpath" class="i_n text2" placeholder="请输入链接" value="<?php echo ($otherInfo["urlpath"]); ?>"></dl>
							<dl id="desc">
								<textarea id='des' name='des' placeholder="请输入描述" style="height: 120px;width: 430px;"><?php echo ($otherInfo["des"]); ?></textarea>
							</dl>
							<div class="dw62" style="margin-top: 105px;">
							   <div class="dw62a">
							    <h2>上传图片(340*190)</h2>
							     <div class="dw62c">
							     <?php if($otherInfo["picurl"] == ''): ?><img id="oneclick" src="/Public/Back/images/de1.png">
							     <?php else: ?>
							    	 <img id="oneclick" src="<?php echo ($otherInfo["picurl"]); ?>"><?php endif; ?>
								 </div>
							   </div>
							   <div class="dw62b">
							   </div>
							</div>
		 					<input type="hidden" id='article_id' name='id' value='<?php echo ($otherInfo["id"]); ?>'>
		 					<input type="hidden" id='picurl' name='picurl' value='<?php echo ($otherInfo["picurl"]); ?>'>
		 					<br/>
		 					<dl>
		 					<textarea id='contents' name='content' placeholder="内容" style="width: 1000px;height: 600px;"><?php echo ($otherInfo["content"]); ?></textarea>
						    </dl>
						</div>
						</div>
						
						<hr>
						<div class="sad1">
						<button class="btn btn-default7" type="submit" onclick="bttonFun();">确定</button>
						<!-- <button class="btn btn-default8" type="button">取消</button> -->
						</div>
						</form>
						</div>
						</div> <!-- /widget -->
					</div> <!-- /span11 -->
				</div> <!-- /row -->
			</div>
		</div>
		<div id="upload" style="display:none;"></div>
		<script>
		KindEditor.ready(function(K) {
	        var editor2 = K.create('textarea[name="content"]', {
	            cssPath : '/Public/kindeditor/plugins/code/prettify.css',
	            uploadJson : '/Public/kindeditor/php/upload_json.php',
	            fileManagerJson : '/Public/kindeditor/php/file_manager_json.php',
	            allowFileManager : true,
	            afterCreate : function() {
	                var self = this;
	                K.ctrl(document, 13, function() {
	                    self.sync();
	                    K('form[name=example]')[0].submit();
	                });
	                K.ctrl(self.edit.doc, 13, function() {
	                    self.sync();
	                    K('form[name=example]')[0].submit();
	                });
	            }
	         
	        });
	    });
		//添加或修改微信自动回复内容
		/* function bttonFun(){
			var title = $("#title").val();
			var urlpath = $("#urlpath").val();
			var des = $("#des").val();
			var picurl = $("#picurl").val();
			var id = $("#article_id").val();
			
			var content=$("#contents").html();
			alert(content);
			return false;
			$.post("/Back/OtherInfo/eventReturnAdd",{title:title,urlpath:urlpath,des:des,picurl:picurl,id:id,content:content},function(data){
				if(data){
					$.anewAlert("修改成功!");
				}else{
					$.anewAlert("修改失败!");
					return false;
				};
			});
			
		} */
  		var up = $('#upload').Huploadify({
			auto:true,
			fileTypeExts:'*.jpg;*.gif;*.png;*.jpeg',
			multi:false,
			fileSizeLimit:1024,
			showUploadedPercent:false,
			showUploadedSize:false,
			removeTimeout:1000,
			abs:1,
			canshu:'TCYWX',
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
					$("#picurl").val(datas.fileurl);
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