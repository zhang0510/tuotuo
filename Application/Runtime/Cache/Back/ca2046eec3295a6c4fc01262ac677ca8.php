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
<script src="/Public/Back/laydate/laydate.js"></script>
<script type="text/javascript">
  window.onload = function(){
    showTime();
  }
 
  function showTime(){
    var myDate = new Date();
    var year = myDate.getFullYear();
    var month = myDate.getMonth() + 1;
    var date = myDate.getDate();
    var dateArr = ["日","一",'二','三','四','五','六'];
    var day = myDate.getDay();
    var hours = myDate.getHours();
    var minutes = formatTime(myDate.getMinutes());
    var seconds = formatTime(myDate.getSeconds());
 
    var systemTime = document.getElementById("time");
    systemTime.innerHTML = "北京时间：  " + year + "年" + month +"月" + date + "日" + " 星期" + dateArr[day] + " " + hours + ":" + minutes + ":" + seconds;
    setTimeout("showTime()",500);
  }
 
  //格式化时间：分秒。
  function formatTime (i){
    if(i < 10){
      i = "0" + i;
    }
    return i;
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
		</div>
		-->
		<div class="row">

			<div class="tsan113">

				<div class="widget">

					<div class="tabbable">

						<div class="tab-content1">
							<div class="tab-content">
								<div class="tab-pane active">
									<div class="dq0">
										<div class="dq1">
											<h2>您好，欢迎登陆车妥妥后台管理系统！</h2>
											<div id ='time'></div>

										</div>
										<div class="dq2" style="width:auto;">
											<iframe width="274" scrolling="no" height="54" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=42&icon=1&num=3"></iframe>
										</div>
									</div>
									<div class="dq3">
										<ul>
											<li>
												<div class="dq31">
													<h2>当前会员总数</h2>
													<p><?php echo ($userNum); ?></p>
												</div>
											</li>
											<li>
												<div class="dq31">
													<h2>当前订单总数</h2>
													<p><?php echo ($orderNum); ?></p>
												</div>
											</li>
											<li>
												<div class="dq31">
													<h2>当前提车人数量</h2>
													<p><?php echo ($carHeaderNum); ?></p>
												</div>
											</li>
											<li>
												<div class="dq31">
													<h2>大客户数量</h2>
													<p><?php echo ($companyNum); ?></p>
												</div>
											</li>
											<li>
												<div class="dq31">
													<h2>财务统计收入总计（元）</h2>
													<p><?php echo ($orderFee); ?></p>
												</div>
											</li>
											<li>
												<div class="dq31">
													<h2>财务统计调度费用总计（元）</h2>
													<p><?php echo ($cwglNum); ?></p>
												</div>
											</li>
											<li>
												<div class="dq31">
													<h2>保险费用总计（元）</h2>
													<p><?php echo ($premium); ?></p>
												</div>
											</li>
											<li>
												<div class="dq31">
													<h2>毛利总计（元）</h2>
													<p><?php echo ($maoli); ?></p>
												</div>
											</li>

										</ul>

									</div>
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

</body>
</html>