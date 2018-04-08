<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- <meta http-equiv="refresh" content="<?php echo ($times); ?>;url=<?php echo ($url); ?>"> -->
<title>错误信息提示</title>
<script type="text/javascript" src="/Public/JS/jquery-1.7.2.min.js"></script>
<style type="text/css">
*{margin:0;padding:0;}
ul,li{list-style:none;}
a{text-decoration:none;}
body{background:url(/Public/Back/images/background_gray.png) repeat;}
.errowBox{width:830px;height:490px;position:absolute;left:50%;margin-left:-415px;top:50%;margin-top:-245px;background:#fff;border:solid 1px #ddd;border-radius:10px;z-index:1;}
.rightPic{position:absolute;left:-6px;top:-6px;z-index:2px;}
.errowImg{float:left;padding:120px 65px;}
.errowCon{padding:50px 0;font-size:14px;color:#999;}
.errowCon span{display:block;font-size:25px;color:#333;margin-bottom:10px;}
.errowCon a:hover{text-decoration:underline;}

</style>

</head>

<body>
	<div class="errowBox">
    	<img src="/Public/Back/images/404_label.png" class="rightPic">
        <img src="/Public/Back/images/smiley.png" class="errowImg">
        <div class="errowCon">
        <input type="hidden" id="timeId" value="<?php echo ($times); ?>"/>
        <input type="hidden" id="urlId" value="<?php echo ($url); ?>"/>
        <span style="font-weight: bold;color:#999;letter-spacing: 5px;font-family:Arial;font-size: 40px;">OOOPS...</span>
       		<div style="height:50px;">
       			<span id="timess" style="font-size: 20px;font-weight: bold;float:left;color:#999;"><?php echo ($times); ?></span>
				<span style="font-size: 20px;font-weight: bold;float:left;color:#999;letter-spacing: 2px;">秒后系统将自动跳转</span>
       			<a id="tzPageId" href="<?php if(($url == null)): ?>javascript:history.back(-1);<?php else: echo ($url); endif; ?>" style="float:left;font-size: 20px;font-weight:bold;color:#666;padding-left:5px;">首页</a>
       		</div>
       		<span style="padding-right: 50px;font-size: 20px;line-height: 1.5;letter-spacing: 2px">
        		<?php echo ($msg); ?>
        	</span>
        </div>
    </div>
    <script type="text/javascript">
    var url = $("#urlId").val();
	var waits= parseInt($('#timess').html());
	function time() {
		var obj = $("#timess");
		if (waits == 0) {
			obj.html("(0)"); 
			//alert(url);
			if(url==""){
				//alert(url);
				window.history.back(-1);
			}else{
				window.location.href = url;
			}
		} else { 
			obj.html("(" + waits + ")");
			waits--;
			setTimeout(function() {
				time(obj);
			},
			1000);
		}
	}
	time();
	</script>
</body>
</html>