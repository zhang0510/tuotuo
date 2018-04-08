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
	<?php if($UserInfo["login"] == 0): ?><span>Hi 欢迎来到妥妥运车 </span>
		<a  class="deng1" href="/Front/Login/pclogin/">请登录</a>
		<a  class="deng2" href="/Front/Register/index/">请注册</a>
	<?php else: ?>
		<span>Hi&nbsp;<?php echo ($UserInfo['userInfo']['user_name']==""?$UserInfo['userInfo']['tel']:$UserInfo['userInfo']['user_name']); ?>&nbsp;</span>
		<h3>
		<a  class="deng3" href="javascript:;">个人中心</a>
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
	<div class="phone head5">400-877-1107</div>
	</div>
  </div>
  <div class="header_top2">
	<p>
		<a  class="te11" ><em>&nbsp;</em><img src="/Public/Front/images/timg.png"></a>
		<a  class="te12" ><em>&nbsp;</em><img src="/Public/Front/images/wskk1.png"></a>
		<!-- <a  class="te13" href="">&nbsp;</a> -->
		<span>400-877-1107</span>
	</p>

  </div>
  </div>
</div>
<script>
	$('.header_top2 a em').click(function(){
		$(this).siblings().show();
	});
	
	$('.header_top2 a img').click(function(){
		$(this).hide();
	});
</script>
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

<script type="text/javascript">

//------------------同发车人START----------------
function withStartCar(obj){
	if($(obj).find('span').hasClass('on')){
		$(obj).find('span').removeClass('on');
		$("#gather_name_txt").val("");
		$("#gather_tel_txt").val("");
		$("#gather_code_txt").val("");
	}else{
		$("#gather_name_txt").val($("#send_name_txt").val());
		$("#gather_tel_txt").val($("#send_tel_txt").val());
		$("#gather_code_txt").val($("#send_code_txt").val());
		$(obj).find('span').addClass("on");
	}
}
//------------------同发车人START----------------
/*function withStartCar(obj){
	if($(obj).find('span').hasClass('on')){
		$(obj).find('span').removeClass('on');
		$("#gather_name").val("");
		$("#gather_tel").val("");
		$("#gather_code").val("");
	}else{

		$("#gather_name").val($("#send_name").val());
		$("#gather_tel").val($("#send_tel").val());
		$("#gather_code").val($("#send_code").val());
		$(obj).find('span').addClass("on");
	}
}*/
//------------------同发车人END------------------
//------------------提交信息START---------------
function formSbumitFun(){
	var gcaObj = $("#gather_car_address");
	$("#car_plate_nums").val("");
	var cpnObj = $("input[id^='car_plate_num']");
	var size = cpnObj.size();
	var cpn_val="";
	var n=1;
	if(size>0){
		for(var i=0;i<size;i++){
			var val = $(cpnObj[i]).val().trim();
			var otherinfo = $(cpnObj[i]).attr('otherinfo');
			if(val!=""){
				cpn_val += otherinfo+'-'+val+";";
				n++;
			}
		}
	}
	cpn_val = cpn_val.substr(0,(cpn_val.length-1));
	if(n<size){
		$.anewAlert("请补充完整车牌号码!");
		return false;
	}

	var send_name = $("#send_name_txt").val().trim();//发车人姓名
	var send_tel = $("#send_tel_txt").val().trim();//发车人电话
	var send_code = $("#send_code_txt").val().trim();//发车人证件号
 	var send_car_address = $("#send_car_address").val().trim();//发车详细地址

	var gather_name = $("#gather_name_txt").val().trim();//收车人姓名
	var gather_tel = $("#gather_tel_txt").val().trim();//收车人电话
	var gather_code = $("#gather_code_txt").val().trim();//收车人证件号
	var gather_car_address = $("#gather_car_address").val();//收车详细地址
	var remark = $("#remark").val().trim();//备注

	if(send_name==""){
		$.anewAlert("发车人姓名不能为空!");
		return false;
	}
	if(send_tel==""){
		$.anewAlert("发车人电话不能为空!");
		return false;
	}else{
		if(!$.check_Mobile(send_tel)){
			$.anewAlert('请输入正确的发车人手机号');
			return false;
		}
	}
	if(send_code==""){
		$.anewAlert("发车人证件号不能为空!");
		return false;
	}else{
		if(!$.isIdCardNo(send_code)){
			$.anewAlert("发车人身份证格式不对");
			return false;
		}
	}

	if(gather_name==""){
		$.anewAlert("收车人姓名不能为空!");
		return false;
	}
	if(gather_tel==""){
		$.anewAlert("收车人电话不能为空!");
		return false;
	}else{
		if(!$.check_Mobile(gather_tel)){
			$.anewAlert('请输入正确的收车人手机号');
			return false;
		}
	}

	if(gather_code==""){
		$.anewAlert("收车人证件号不能为空!");
		return false;
	}else{
		if(!$.isIdCardNo(gather_code)){
			$.anewAlert("收车人身份证格式不对");
			return false;
		}
	}
	if(send_car_address==""){
		$.anewAlert("发车详细地址不能为空!");
		return false;
	}

	if(gcaObj.size()>0){
		var gcaval = gcaObj.val().trim();
		if(gcaval==""){
			$.anewAlert("收车详细地址不能为空!");
			return false;
		}
	}

	$("#car_plate_nums").val(cpn_val);
	$("#send_name_id").val(send_name);
	$("#send_tel_id").val(send_tel);
	$("#send_code_id").val(send_code);
	$("#gather_name_id").val(gather_name);
	$("#gather_tel_id").val(gather_tel);
	$("#gather_code_id").val(gather_code);
	$("#send_car_address_id").val(send_car_address);
	$("#gather_car_address_id").val(gather_car_address);
	$("#remark_id").val(remark);
	$("#four_form_id").submit();
}
//------------------提交信息END-----------------
</script>
<div style="display: none;">
	<form action="/Front/GroupBuy/groupFour" method="post" id="four_form_id">
		<input type="hidden" id="car_plate_nums" name="car_plate_nums"><!-- 车牌号码 -->

		<input type="hidden" id="send_name_id" name="send_name"><!-- 发件人姓名 -->
		<input type="hidden" id="send_tel_id" name="send_tel"><!-- 发件人电话-->
		<input type="hidden" id="send_code_id" name="send_code"><!-- 发件人证件号 -->

		<input type="hidden" id="gather_name_id" name="gather_name"><!-- 收件人姓名 -->
		<input type="hidden" id="gather_tel_id" name="gather_tel"><!-- 收件人电话 -->
		<input type="hidden" id="gather_code_id" name="gather_code"><!-- 收件人证件号-->

		<input type="hidden" id="send_car_address_id" name="send_car_address"><!-- 发车人详细地址 -->
		<input type="hidden" id="gather_car_address_id" name="gather_car_address"><!-- 收车人详细地址-->

 		<input type="hidden" id="remark_id" name="remark"><!--备注 -->
	</form>
</div>
<!--content-->
<div class="dengm2">
 <div class="deng0">
   <div class="deng1">
    <h2>详细地址</h2>
   </div>
   <div class="deng2e0">
      <div class="ee1"><h2><?php echo ($province["area_name"]); ?> <img src="/Public/Front/images/ee1.png"> <?php echo ($aimPro["area_name"]); ?></h2></div>
      	<?php if(is_array($gbList)): foreach($gbList as $k=>$vo): ?><div class="ee2"><?php echo ($vo["brand_name"]); ?> <?php echo ($vo["cartype_name"]); ?><span><?php echo ($vo["car_num"]); ?>辆</span></div><?php endforeach; endif; ?>
	   <div class="rr3">
	     <div class="rr31">车辆信息</div>
	     <div class="rr32">

		<!-- <input type="text" value=""/> -->

		   <?php if(is_array($carInfoList)): foreach($carInfoList as $k=>$vo): if(is_array($vo)): foreach($vo as $kk=>$voo): ?><div class="rr32ad">
		   			<div class="rr32ad1">
			   			<span class="dre1">车型：<?php echo ($voo["brand_name"]); ?> <?php echo ($voo["cartype_name"]); ?></span>
			   			<span  class="dre2">车牌号：</span><input type="text" id="car_plate_num_<?php echo ($kk); ?>" otherinfo="<?php echo ($voo["brand_name"]); ?>-<?php echo ($voo["cartype_name"]); ?>-<?php echo ($voo["car_guzhi"]); ?>-<?php echo ($voo["car_yuanbaoxian"]); ?>-<?php echo ($voo["car_price"]); ?>"/></div>
		   			<div class="rr32ad2">
		   				<span>估值<strong><?php echo ($voo["car_guzhi"]); ?></strong>万元整</span>
		   			</div>
		   		</div><?php endforeach; endif; endforeach; endif; ?>

		 </div>
		 <div class="rr33">车辆信息是为您爱车购买保险的依据，无牌车填写车架号代替。请准确填写，确保您的合法权益</div>
	   </div>
	  	<div class="rr4">
		<div class="rr41">
		 <h2 class="rra1">发车信息</h2>
		 <h2 class="rra2">发车人	 <?php if($linkListsize > 0 ): ?><span  class="hhhh" onclick='openF("S",this);'>常用联系人</span><?php endif; ?></h2>

		  <div class="rr41a">
			  <dl><dt>*</dt><dd><input type="text" class="rry1" placeholder="联系人姓名" id="send_name_txt">

			  </dd></dl>
			  <dl><dt>*</dt><dd><input type="text" class="rry1" placeholder="联系人电话" id="send_tel_txt"></dd></dl>
			  <dl><dt>*</dt><dd><input type="text" class="rry1" placeholder="联系人身份证号码" id="send_code_txt"></dd></dl>
		  </div>
		  <h2 class="rra2">发车地址</h2>
		  <div class="rr41a">
		  <dl>
		  <dt>*</dt>
		  <dd>
		  <input class="txt1a inko" placeholder="发车区域"  type="text" value="<?php echo ($province["area_name"]); ?>-<?php echo ($city["area_name"]); ?>-<?php echo ($area["area_name"]); ?>">
		 </dd>
		 </dl>
		  <dl><dt>*</dt><dd><input type="text" class="rry1" placeholder="发车详细地址" id="send_car_address"></dd></dl>

		  </div>

		</div>
		<div class="rr41">
			 <h2 class="rra1">收车信息</h2>
			  <h2 class="rra2" onclick="withStartCar(this);">收车人 <span>同发车人</span>  <?php if($linkListsize > 0 ): ?><span  class="hhhh" onclick='openF("R",this);'>常用联系人</span><?php endif; ?></h2>

			  <div class="rr41a">
			  <dl><dt>*</dt><dd><input type="text" class="rry1" placeholder="联系人姓名" id="gather_name_txt">
			  </dd></dl>
			  <dl><dt>*</dt><dd><input type="text" class="rry1" placeholder="联系人电话" id="gather_tel_txt"></dd></dl>
			  <dl><dt>*</dt><dd><input type="text" class="rry1" placeholder="联系人身份证号码" id="gather_code_txt"></dd></dl>
		  </div>
		<h2 class="rra2">收车地址</h2>
		<div class="rr41a">
		<dl>
			<dt>*</dt>
			<dd>
				<?php if($connectCarWay == 'Y' ): ?><input class="txt1a inko" placeholder="收车地区"  type="text" value="<?php echo ($aimPro["area_name"]); ?>-<?php echo ($aimCity["area_name"]); ?>-<?php echo ($ztname); ?>">
				<?php else: ?>
					<input class="txt1a inko" placeholder="收车地区"  type="text" value="<?php echo ($aimPro["area_name"]); ?>-<?php echo ($aimCity["area_name"]); ?>"><?php endif; ?>
			</dd>
		</dl>
		<dl>
			<?php if($connectCarWay == 'Y' ): ?><dt>*</dt>
				<dd>
					<input type="text" class="rry1" placeholder="发车详细地址" id="gather_car_address">
				</dd><?php endif; ?>
		</dl>
		</div>
		</div>
		</div>
		<div style="clear:both;"></div>
	  	<div class="rr5">
		  	<textarea style="width: 86%;" placeholder="备注：" id="remark"></textarea>
		</div>
 		<div class="ee81"><button type="button" onclick="return formSbumitFun();">确定发车</button></div>
   </div>
 </div>
</div>
 <!-- 常用联系人START -->
 <div  id="bg" class="bg" style="display:none;"></div>
<div  id="tan1" class="tan1"  style="display:none;">
   <div class="tan11">
         <a class="closed" id="closed">X</a>
    <h2>常用联系人</h2>
   <div class="clist" style="overflow:auto;height:300px;">
   <?php if(is_array($linkList)): $i = 0; $__LIST__ = $linkList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="clist1">
	    <b></b><input type="radio" name="bb[]" value="<?php echo ($v["link_code"]); ?>" class="del" ><span class="bm1" name="<?php echo ($v["link_name"]); ?>">姓名：<?php echo ($v["link_name"]); ?></span><span class="bm2" name="<?php echo ($v["link_tel"]); ?>">手机号：<?php echo ($v["link_tel"]); ?></span><span class="bm3" name="<?php echo ($v["link_num"]); ?>">身份证号：<?php echo ($v["link_num_code"]); ?></span>
	  </div><?php endforeach; endif; else: echo "" ;endif; ?>

   </div>

     <p>
	 <button class="put2" type="button" id="sel" name="S" onclick="selectF(this)">选择</button>
	 <!-- <button class="put3" type="button" id="del" onclick="delLink()">删除</button> -->
	 </p>
   </div>

</div>
<!-- 常用联系人END -->
<script>

  $(".inko").click(function(){
	  var connectCarWay = $("#connectCarWay").val();
	if(connectCarWay=="Y"){
		$("#selected_id").show();
	}else{
		$("#selected_id").hide();
	}

  });

   $(".selected li").click(function(){
  $(this).parent().parent().hide();
   var oop= $(this).html();
  $(this).parent().parent().siblings('.inko').val(oop);

  });
  $(".ee32a li").click(function(){

  $(this).addClass("on").siblings().removeClass('on');
  });
  $(".ee71 span").click(function(){
  if($(this).hasClass('on')){
  $(this).removeClass('on');
  }else{
  $(this).addClass("on");
  }

  });

  function openF(sign,obj){
		$(obj).addClass('on');
		$("#bg").show();
		$("#tan1").show();
		$("#sel").attr('name',sign);
	}
  function selectF(obj){
		var sign = $(obj).attr('name');
		var name = $(".clist1.on").find('.bm1').attr('name');
		var phone = $(".clist1.on").find('.bm2').attr('name');
		var iden = $(".clist1.on").find('.bm3').attr('name');
		if(sign=='S'){
			$("#send_name_txt").val(name);
			$("#send_tel_txt").val(phone);
			$("#send_code_txt").val(iden);
		}else{
			$("#gather_name_txt").val(name);
			$("#gather_tel_txt").val(phone);
			$("#gather_code_txt").val(iden);
		}
		$("#bg").hide();
		$("#tan1").hide();
	}

	$(".clist1").click(function(){
		$(this).addClass("on").siblings().removeClass('on');
	});
	$("#closed").click(function(){
		$("#bg").hide();
		$("#tan1").hide();
	})
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
			   <p><span>©2016 信义安达物流 京ICP备16022345号-1 地址：北京市顺义区山子坟北京信义安达物流有限公司</span></p>
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