<?php if (!defined('THINK_PATH')) exit();?>    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>跳转提示</title>
    <style type="text/css">
    *{ padding: 0; margin: 0; }
    body{ background: url(/Public/error.jpg) no-repeat center 0px  /cover; font-family: '微软雅黑'; color: #fff; font-size: 16px; }
    .system-message{width:500px;margin:20px auto; }
    .system-message h1{ font-size: 80px; font-weight: normal; line-height: 120px; margin-bottom: 12px }
    .system-message .jump{ padding-top: 10px;margin-bottom:20px;color:#666666;font-size:14px;}
    .system-message .jump a{ color: #333;}
    .system-message .success,.system-message .error{ line-height: 1.8em; font-size: 60px;color:#30AC63 ;padding:0px 30px;}
    .system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
    #wait {
        font-size:14px;color:#30AC63;
    }
    #btn-stop,#href{

        text-decoration:none;
    }

    #btn-stop:hover,#href:hover{
        background-color: #ff0000;
    }
    .fsf{padding-top:20%;}
    </style>
    </head>
    <body>
    <div class="system-message">
    <div  class="fsf"><!-- <img src="/Public/err3.png"> --></div>
    <?php if(isset($message)) {?>
<p class="success"><?php echo($message); ?></p>
<?php }else{?>
<p class="error"><?php echo($error); ?></p>
<?php }?>
    <p class="detail"></p>
    <!--  <p class="jump">
    <b id="wait"><?php echo($waitSecond); ?></b> 秒后页面将自动跳转
    </p>-->
        <p class="jump">
页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
</p>
    <div>



       <!--  <a id="href" id="btn-now" href="<?php echo($jumpUrl); ?>">立即跳转</a>
        <button id="btn-stop" type="button" onclick="stop()">停止跳转</button> -->

    </div>
    </div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
    </body>
    </html>