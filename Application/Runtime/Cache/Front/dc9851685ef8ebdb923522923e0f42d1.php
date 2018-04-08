<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=0.7">

<?php if($news['key_words'] != ''): ?><meta name="keywords" content="<?php echo ($news['key_words']); ?>">
<?php else: ?>
 <meta name="keywords" content="轿车托运，轿车运输，异地运车，二手车托运，私家车托运，自驾游托运，越野车托运，全国轿车托运，北京轿车托运，上海轿车托运，深圳轿车托运"><?php endif; ?>

<?php if($news['article_desc'] != ''): ?><meta name="description" content="<?php echo ($news['article_desc']); ?>">
<?php else: ?>
 <meta name="description" content="妥妥运车  汽车托运  轿车托运   汽车托运公司"><?php endif; ?>

<?php if($news['title'] != ''): ?><title><?php echo ($news['title']); ?></title>
<?php else: ?>
 <title>妥妥运车---私家车托运专家</title><?php endif; ?>

<!-- Bootstrap core CSS -->
<link href="/Public/Front/style/bootstrap.css" rel="stylesheet" type="text/css">
<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<link href="/Public/Front/style/style.css" rel="stylesheet" type="text/css">
<link href="/Public/Front/style/style1200.css" rel="stylesheet" type="text/css">
<link href="/Public/Front/style/style960.css" rel="stylesheet" type="text/css">
<link href="/Public/Front/style/style768.css" rel="stylesheet" type="text/css">
<link href="/Public/Front/style/style480.css" rel="stylesheet" type="text/css">
<link href="/Public/Front/style/style320.css" rel="stylesheet" type="text/css">

<script src="/Public/Front/js/jquery-1.js"></script>
<script src="/Public/JS/jquerytool_1.0v.js"></script>
<script src="/Public/JS/layer/layer.js"></script>
<script src="/Public/Front/js/bootstrap.js"></script>
<script src="/Public/Front/js/jquery.SuperSlide.js"></script>
<!--百度统计-->
<script>
/* var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?fadb8c3f2b777cb42752d48990106a58";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})(); */
</script>




<body>

<div class="header_top">
  <div class="header_top0 container">
  <div class="header_top1">
  <div class="fss">
	<?php if($user["id"] == ''): ?><span>Hi 欢迎来到妥妥运车 </span>
		<a  class="deng1" href="/Front/Login/pclogin/">请登录</a>
		<a  class="deng2" href="/Front/Register/index/">请注册</a>
	<?php else: ?>
		<span>Hi&nbsp;<?php echo ($user['user_name']==null?$user['tel']:$user['user_name']); ?>&nbsp;</span>
		<h3>
		<a  class="deng3" href="/Front/Personal/personalInfo">个人中心</a>
		<dl>
			<dt><a href="/Front/Personal/personalInfo">个人资料</a></dt>
			<dt><a href="/Front/MyOrder/index">我的订单</a></dt>
			<dt><a href="/Front/MyCoupon/index">我的优惠券</a></dt>
		</dl>
		</h3>
		<a class="deng4" href="#" onclick="loginout();">退出</a>
		<script>
			function loginout(){
				$.post('/Front/Login/logout/',function(data){
						window.location.reload();
				})
			}
		</script><?php endif; ?>
	</div>
  </div>
  <div class="header_top2">
	<p>
		<a  class="te11" href="">&nbsp;<img src="/Public/Front/images/timg.png"></a>
		<a  class="te12" href="">&nbsp;<img src="/Public/Front/images/timg1.png"></a>
		<!-- <a  class="te13" href="">&nbsp;</a> -->
		<span>400-877-1107</span>
	</p>

  </div>
  </div>
</div>
<!--logo and nav-->
	<nav class="navbar navbar-default">
      <div id="sasa" class="container">
	  <div class="head1"><a class="navbar-brand0" href="/"><img src="/Public/Front/images/logo.png"></a></div>
	  
   <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        <div id="navbar" class="collapse navbar-collapse">

		 <div class="baotio">

        <ul class="nav navbar-nav">
            <li  <?php if(CONTROLLER_NAME == ''): ?>class="active"<?php endif; ?>>
			<h2><a href="/">首页</a></h2>

			</li>

		    <li <?php if(CONTROLLER_NAME == 'ProfessionalServices'): ?>class="active"<?php endif; ?>><h2><a  href="javascript:;">妥妥服务</a></h2>
					         <dl>
				  <div class="fgrr"></div>
				  <?php if(is_array($ttfw)): foreach($ttfw as $key=>$vo): ?><dd><a href="/Front/ProfessionalServices/sos/code/<?php echo ($vo["article_code"]); ?>"><?php echo ($vo["title"]); ?></a></dd><?php endforeach; endif; ?>
				  <!-- <dd><a href="/Front/Worklwt/lineDis">长途托运</a></dd> -->
				 </dl>
			</li>
			</li>
		    <!-- <li id="tt1"><h2><a href="javascript:;">托车优惠</a></h2>
		         <dl>
				  <div class="fgrr"></div>

				  <dd><a href="/Front/Worklwt/lineDisList">优惠线路</a></dd>
				  <dd><a href="/Front/GroupBuy/gotoGroupBuy">团购线路</a></dd>

				 </dl>
			</li> -->
			</li>
		    <li <?php if(CONTROLLER_NAME == 'SecurityGuarantee'): ?>class="active"<?php endif; ?>><h2><a  href="javascript:;">安全保障</a></h2>
				<dl>
				<div class="fgrr"></div>
				  <?php if(is_array($aq)): foreach($aq as $key=>$vo): ?><dd><a href="/Front/SecurityGuarantee/index/code/<?php echo ($vo["article_code"]); ?>"><?php echo ($vo["title"]); ?></a></dd><?php endforeach; endif; ?>

				 </dl>
			</li>
			</li>
		    <li  <?php if(CONTROLLER_NAME == 'AboutUs'): ?>class="active"<?php endif; ?>><h2><a  href="javascript:;">关于妥妥</a></h2>
				 <dl>
					<div class="fgrr"></div>
					<?php if(is_array($dh)): foreach($dh as $key=>$vo): ?><dd><a href="/Front/AboutUs/index/code/<?php echo ($vo["article_code"]); ?>"><?php echo ($vo["title"]); ?></a></dd><?php endforeach; endif; ?>
				    
				    <dd><a href="/Front/News/newsList">妥妥新闻</a></dd>
				 </dl>
			</li>
			<li><h2><a href="/Front/Ordersel/orderselView">运单查询</a></h2>

			</li>

	    </ul>

		 </div>
        </div>

      </div>
    </nav>
<!--logo and nav-->

<script src="/Public/JS/indexTuo.js"></script>
<!--content-->
<div class="dengm2">
 <div class="deng0 container">
   <div class="deng1">
    <h2>附加服务</h2>
   </div>
        <div class="deng5"><div class="kuai2"></div></div>
        <input type="hidden" id="end_names" value="<?php echo ($name2); ?>">
   <form method="post" action="/Front/Order/normalOrderTh" id="quickz">
   <div class="deng2e">
      <div class="ee1"><h2><?php echo ($name1); ?><img src="/Public/Front/images/ee1.png"><?php echo ($name2); ?></h2></div>
	   <div class="ee3">
	     <div class="ee31 rr31">附加服务</div>
	     <div class="ee32">
		   <div class="ee32a">
		    <ul><li onclick="smsFun(this);">送车上门</li><li id="sefwrg" onclick="xiFun(this);"><span class="hhfg1">洗车50元</span> <span  class="hhfg2">*选择送车上门后才能选此项</span></li></ul>
		   </div>
		 </div>
			<div class="rr41 frake1" id="awgfw" style="display: none;">
			<h2 class="rra2">目的地</h2>
			<div class="deng2b1">
				<dl class="frake2">
					<dt>地址：</dt>
					<dd><input type="text" placeholder="区域" id="citys" class="txt1a inko">&nbsp;&nbsp;&nbsp;<b>费用：<ca id="wegwe">0</ca>元</b>
		   			<span class="xxsj"></span>
		  			<div class="selected" style="display: none;">
						<div class="province star_province">
							<?php if(is_array($block)): foreach($block as $key=>$vo): ?><li data-id="1" onclick="getBlock('<?php echo ($vo["area_id"]); ?>','<?php echo ($vo["area_name"]); ?>');"><?php echo ($vo["area_name"]); ?></li><?php endforeach; endif; ?>
							</div>
						<div class="city star_city" data-id=""></div>
						<div class="county star_county" data-id=""></div>
					</div> </dd>
				</dl>
				<dl>
				<dt>详细地址：</dt>
				<dd>
					<!-- <input type="text" id="order_info_end_address" name="order_info_end_address" class="txt1" value="<?php echo ($saddress); ?>"> -->
				<div class="cscs1">
					<span id="sgrgw"></span><input type="text" class="rry1" placeholder="请输入详细地址" id="order_info_end_address" value="<?php echo ($saddress); ?>" name="order_info_end_address">
				</div>
				</dd>
				</dl>
			</div>
			</div>
	   </div>
	  	<input type="hidden" id="order_info_smsc" name="order_info_smsc" value="N">
	  	<input type="hidden" id="car_washing" name="car_washing" value="0">
	  	<input type="hidden" id="city_qus" name="city_qus" value="">
	  	<input type="hidden" id="order_smsc_car" name="order_smsc_car" value="">
	  	<input type="hidden" id="totalz" name="totalz" value="<?php echo ($order["totalz"]); ?>">
	  	<input type="hidden" id="qerez" value="<?php echo ($order["qerez"]); ?>">
		<div class="vmbb1"><h3>费用合计：<b id="rthrtwe"><?php echo ($order["totalz"]); ?></b>元</h3></div>
	    <div class="ee6 ee67">
		     <div class="ee61"> 
			 <dl>
			  <dd>
			   <p>运费<b id="yuns"><?php echo ($yun); ?></b>元 &nbsp; 保险费<b id="bao"><?php echo ($order["order_info_bxd"]); ?></b>元 &nbsp; 上门费<b id="smsprice">0</b>元 &nbsp; 洗车费<b id="xiprice">0</b>元</p>
			   <p><span >输入优惠码：</span><input type="text" onblur="favFun(this);" id="fav_code" name="fav_code" placeholder="优惠码编号" value=""><span class="ccaca">优惠金额:<b id="youhui">0</b>元</span></p>
			   
			  </dd>
			  </dl></div>
			  <div class="ee62">
			   <p><span class="fg1">本次服务需支付总金额：</span><span class="fg2">￥<b id="heji"><?php echo ($order["totalz"]); ?></b>元</span></p>
	     </div>
	   	</div>
 	<div class="ee8"><button type="button" onclick="queFun();">确定发车</button></div>
   </div>
   </form>
 </div>
</div>

<script>
function queFun(){
	var order_info_smsc = $("#order_info_smsc").val();
	var city_qus = $("#city_qus").val();
	var order_info_end_address = $("#order_info_end_address").val();
	if(order_info_smsc == "Y"){
		if(city_qus == ''){
			layer.msg("请选择送车区域");
			return false;
		}
		if(order_info_end_address == ''){
			layer.msg("请输入详细地址");
			return false;
		}
	}
	$("#quickz").submit();
}
function favFun(obj){
	var code = $(obj).val();
	if(code!=""){
		$.post("/Front/Order/getFavPrice",{code:code},function(data){
			if(data.flag){
				$("#youhui").html(data.price);
				totelFun();
			}else{
				$("#youhui").html(0);
				totelFun();
			}
		},'json');
	}else{
		$("#youhui").html(0);
		totelFun();
	}
	
}
function smsFun(obj){
	if($(obj).attr("class")=="on"){
		$(obj).removeClass("on");
		$("#order_info_smsc").val('N');
		$("#awgfw").hide();
		$("#sefwrg").removeClass("on");
		$("#car_washing").val(0);
		$("#xiprice").html(0);
	}else{
		$(obj).addClass("on");
		$("#order_info_smsc").val('Y');
		$("#awgfw").show();
	}
	block();
}
function xiFun(obj){
	if($("#order_info_smsc").val() == 'Y'){
		if($(obj).attr("class")=="on"){
			$(obj).removeClass("on");
			$("#car_washing").val(0);
			$("#xiprice").html(0);
		}else{
			$(obj).addClass("on");
			$("#car_washing").val(50);
			$("#xiprice").html(50);
		}
		totelFun();
	}else{
		layer.msg("请选择上门送车");
		return false;
	}
	
}
function block(){
	var id = $("#city_qus").val();
	var city_jie_sheng = $("#qerez").val();
	var mark = $('#order_info_smsc').val();
	$.post("/Front/Order/smscFun",{id:id,type:mark,str:city_jie_sheng},function(data){
		if(data.flag){
			$("#smsprice").html(data.prices);
			$("#order_smsc_car").val(data.prices);
			$('#wegwe').html(data.prices);
			totelFun();
		}else{
			$("#smsprice").html(0);
			$("#order_smsc_car").val(0);
			$('#wegwe').html(0);
			totelFun();
		}
	},'json');
}
function getBlock(id,name){
	var ss = $("#end_names").val();
	$("#city_qus").val(id);
	$("#sgrgw").html(ss+name);
	$('#citys').val(name);
	$('.selected0,.selected').hide();
	block();
}
</script>

<!--content-->
<!--footer-->
   	<div class="footer-box">
	<div class="footer-box1">
	<div class="container">
       <div class="dnn0">
			 <div class="col-sm-6 col-md-2 jkl1">
            	 	<div class="dnn1">
					<h2><a href="javascript:;">妥妥运车</a></h2>
                    <dl>
				<?php if(is_array($tuoList)): foreach($tuoList as $k=>$vo): if($vo["title"] == '我要运车'): ?><dd><a href="/Front/Order/normal"><?php echo ($vo["title"]); ?></a></dd>
					<?php else: ?>
						<dd><a href="/Front/Footer/detail/code/<?php echo ($vo["article_code"]); ?>"><?php echo ($vo["title"]); ?></a></dd><?php endif; endforeach; endif; ?>
					 <!--<dd><a href="">企业运车</a></dd>
					 <dd><a href="">时效查询</a></dd>
					 <dd><a href="">服务网点</a></dd>-->

					</dl>
                    </div>
            </div>
			<!-- <div class="col-sm-6 col-md-2 jkl1">
            	 	<div class="dnn1">
					<h2><a href="javascript:;">服务产品</a></h2>
                    <dl>
				<?php if(is_array($serviceList)): foreach($serviceList as $k=>$vo): ?><dd><a href="/Front/Footer/detail/code/<?php echo ($vo["article_code"]); ?>"><?php echo ($vo["title"]); ?></a></dd><?php endforeach; endif; ?>

					</dl>
                    </div>
            </div>-->
			 <div class="col-sm-6 col-md-2 jkl1">
            	 	<div class="dnn1">
					<h2><a href="javascript:;">帮助中心</a></h2>
                    <dl>
				<?php if(is_array($helpList)): foreach($helpList as $k=>$vo): ?><dd><a href="/Front/Footer/detail/code/<?php echo ($vo["article_code"]); ?>"><?php echo ($vo["title"]); ?></a></dd><?php endforeach; endif; ?>
					</dl>
                    </div>
            </div>

			 <div class="col-sm-6 col-md-2 jkl1">
            	 	<div class="dnn1">
					<h2><a href="javascript:;">支付方式</a></h2>
                    <dl>
				<?php if(is_array($payList)): foreach($payList as $k=>$vo): ?><dd><a href="/Front/Footer/detail/code/<?php echo ($vo["article_code"]); ?>"><?php echo ($vo["title"]); ?></a></dd><?php endforeach; endif; ?>
					</dl>
                    </div>
            </div>
			 <div class="col-sm-6 col-md-2 jkl1">
            	 	<div class="dnn1">
					<h2><a href="javascript:;">关于妥妥</a></h2>
                    <dl>
					<?php if(is_array($aboutList)): foreach($aboutList as $k=>$vo): ?><dd><a href="/Front/Footer/detail/code/<?php echo ($vo["article_code"]); ?>"><?php echo ($vo["title"]); ?></a></dd><?php endforeach; endif; ?>

					</dl>
                    </div>
            </div>
	 <div class="col-sm-6 col-md-2 jkl1 jkl1a">
            	 	<div class="dnn1  ffdsf">
		           <img src="/Public/Front/images/wskk1.png">
		           <div class="hoof2">
 <div class="bdsharebuttonbox"><a title="分享到新浪微博" href="#" class="bds_tsina te11" data-cmd="tsina"></a>
  <a title="分享到QQ好友" href="#" class="bds_sqq te12" data-cmd="sqq"></a>
  <a title="分享到微信" href="#" class="bds_weixin te13" data-cmd="weixin"></a>
  </div>


  </div>

                    </div>
            </div>
         </div>

            </div>
			<div class="fooh1">
			  <div class="fooh2 container">
			  <div class="fooh21">
			   <p><span>©2016 安达承运物流 京ICP备16022345号-1 地址：北京市顺义区山子坟北京安达承运物流有限公司</span></p>
			   </div>

			   </div>
			</div>
		
		
		
		
		
		
		
		
		
        </div>


    </div>
	
<div class="phone xin1">
	<ul>
		<li style="width:50%;"><a href="tel:4008771107"><h2>电话咨询</h2></a></li>
		<!--<li><a target="_blank" href="http://p.qiao.baidu.com/cps/chat?siteId=10022073&userId=20439003"><h2>在线咨询</h2></a></li>0-->
		<li class="xin4" style="width:50%;"><h2>在线留言</h2></li>
	</ul>
</div>
<div class="phone xin2"> 
	<div class="xin3">
		<div class="xin6">
			<a><img src="/Public/Front/images/xin6.png"/></a>
		</div>
	
		<h3>在线留言</h3>
		<dl>
			<h2>您的电话：</h2>
			<input type="text" id="phone" name="" value="" placeholder="电话">
		</dl>
		<dl>
			<h2>您的需求：</h2>
			<textarea id="cont" name="" placeholder="需求信息"></textarea>
		</dl>
		
		<button type="submit" id="zixun">确定</button>
		
	</div>
</div>
<!-- 留言框 --> 
<script>
	$(".xin4").click(function(){
		$(".xin2").show();
	});
	/* $(".xin3 button").click(function(){
		layer.msg('感谢您的信任，请保持工作日电话畅通。');
	}); */
	$(".xin6").click(function(){
		$(".xin2").hide();
	});
	$("#zixun").click(function(){
		var phone=$("#phone").val();
		var content=$("#cont").val();
		if(phone == ''){
			layer.msg('手机号不能为空！');
			return false;
		}
		if(content == ''){
			layer.msg('内容不能为空！');
			return false;
		}
		var reg = /^(0|86|17951)?(13[0-9]|15[012356789]|17[6789]|18[0-9]|14[57])[0-9]{8}$/;
		var r = phone.match(reg);
		if(r==null){
			layer.msg('手机号格式不对！');
			return false;
		}
		$.post("/Front/Liu/add",{phone:phone,content:content},function(data){
			if(data.status == 'Y'){
				layer.msg('感谢您的信任，请保持工作日电话畅通。');
				$(".xin2").hide();
			}else{
				layer.msg('咨询失败，我们正在处理！');
			}
		})
		
	})
</script> 
  <script>
  $(".qqr01 ul li").click(function(){
	  $(this).addClass("on").siblings().removeClass('on');
	  var tt=$(this).index();
	  $(".part13  .part3b").eq(tt).show().siblings().hide();


	  });

	    $(".part12 ul li").click(function(){
	  $(this).addClass("on").siblings().removeClass('on');
	  var tt=$(this).index();
	  $(".part13  .part3b").eq(tt).show().siblings().hide();


	  });

	      $(".part12 ul li").hover(function(){
	  $(this).addClass("on").siblings().removeClass('on');
	  var tt=$(this).index();
	  $(".part13  .part3b").eq(tt).show().siblings().hide();


	  });

 	    $(".inko").click(function(){
	  $(this).siblings(".selected").show();
	  $(this).siblings(".selected0").show();

	  }); 
	      $(".xiandan").click(function(){
$(".korder0").animate({width:"100%"});

	  });
	      $(".close2").click(function(){
	    	  $(".korder0").animate({width:"0%"});

	    	  });


	    $(".mess1 p").click(function(){
	  $(this).parent().parent().hide();

	  });
	    $('.xiandan').hide();
	    $(function(){
	    	$(window).scroll(function() {
	    		if($(window).scrollTop() >= 400){
	    			$('.xiandan').fadeIn(300);
	    		}else{
	    			$('.xiandan').fadeOut(300);
	    		}
	    	});

	    });

	/*     function ceshi3(obj){
	    	$(obj).siblings(".selected0").show();
	    } */





  </script>


<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"32"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>

<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?fadb8c3f2b777cb42752d48990106a58";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>











<!--footer-->

</body></html>