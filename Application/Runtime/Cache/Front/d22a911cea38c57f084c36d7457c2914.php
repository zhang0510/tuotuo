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

<div class="pc header_top">
  <div class="header_top0 container">

  <div class="fss">
	<?php if($UserInfo["login"] == 0): ?><div class="header_top2">
		<span style="color: #000000;">Hi 欢迎来到妥妥运车 </span>
		<span class="login">
			<a  class="deng1" href="/Front/Login/pclogin/">请登录</a>&nbsp;&nbsp;|&nbsp;
			<a  class="deng2" href="/Front/Register/index/">请注册</a>
		</span>
		</div>
	<?php else: ?>
		<div class="header_top1">
			<span>Hi&nbsp;123123<!--<?php echo ($UserInfo['userInfo']['user_name']==""?$UserInfo['userInfo']['tel']:$UserInfo['userInfo']['user_name']); ?>-->&nbsp;</span>
			<h3>
			<a  class="deng3" href="javascript:;">个人中心</a>
			<dl>
				<dt><a href="/Front/Personal/personalInfo">个人资料</a></dt>
				<dt><a href="/Front/MyOrder/index">我的订单</a></dt>
				<dt><a href="/Front/MyCoupon/index">我的优惠券</a></dt>
			</dl>
			</h3>
			<a class="deng4" href="#" onclick="loginout();">退出</a>
		</div>
		<script>
			function loginout(){
				$.post('/Front/Login/logout/',function(data){
						window.location.reload();
				})
			}
		</script><?php endif; ?>
	</div>
  </div>
  <!--<div class="header_top2">
	<p>
		<a  class="te11" ><em>&nbsp;</em><img src="/Public/Front/images/timg.png"></a>
		<a  class="te12" ><em>&nbsp;</em><img src="/Public/Front/images/wskk1.png"></a>
		&lt;!&ndash; <a  class="te13" href="">&nbsp;</a> &ndash;&gt;
		<span>400-877-1107</span>
	</p>

  </div>-->
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
		<div class="head1">
			<a class="navbar-brand0" href="/"><img class="logoimg" src="/Public/Front/images/logo.png"></a>
		</div>
		<a href="/Front/Personal/personalInfo">
		<img class="phone renimg" src="/Public/Front/images/ren.png">
		</a>
		<a href="javascript:volid(0);" data-toggle="collapse" data-target="#sousuok" aria-expanded="false" aria-controls="sousuok">
		<img class="phone sousuoimg" src="/Public/Front/images/sousuo.png">
		</a>
		<a href="javascript:volid(0);" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			<img class="phone dhimg" src="/Public/Front/images/sjdh.png" style="width: 6%">
		</a>
		<div id="sousuok" class="phone du3d">
			<input type="text" placeholder="请在此输入订单号" class="cx1" id="keyword" ><!-- onkeyup="sel(this);" --><button onclick="tiaoFun();" type="button"></button>
			<div id="searchBoxs"></div>
		</div>
		<div id="navbar" class="collapse navbar-collapse">
			<div class="baotio">
				<ul class="nav navbar-nav">
					<li  <?php if(CONTROLLER_NAME == 'Index'): ?>class="active"<?php endif; ?>>
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


<!--banner-->
<div class="banner">
	<img src="/Public/Front/images/fbanner.png" style="width: 100%">
</div>
<!--banner-->
<!--content-->
<div class="part1" style="width: 100%">
	<img class="pc" src="/Public/Front/images/HEARTONFIRE2.png"  style="width: 100%">
	<img class="phone" src="/Public/Front/images/qiche.png"  style="width: 100%">
	<div class="fwfont fwfontx">
		<font><strong>欢迎注册</strong></font>
		<h3>Welcome register</h3>
		<img src="/Public/Front/images/Rectangle.png">
	</div>
	<div class="deng0">
		<input type="hidden" id="From_Token" name="From_Token" value="<?php echo ($Session_From_Token); ?>">
		<!-- <input type="hidden" id="SMS_VCode" name="SMS_VCode" value=""> -->
		<div class="deng2" style="padding:0px;">
			<div class="deng2b">
				<div class="deng2b1">
					<dl>
						<dt>手机号码：</dt>
						<dd>
							<input type="text" id="tel" name="tel" onblur="selTel()" class="txt1" placeholder="请输入手机号">
						</dd>
					</dl>
					<dl><dt>输入密码：</dt><dd><input type="password" id="upwd" name="upwd" class="txt1" placeholder="请输入密码"></dd></dl>
					<dl><dt>确认密码：</dt><dd><input type="password" id="upwd_two" name="upwd_two" class="txt1" placeholder="请再次确认密码" onblur="checkPass(this);"></dd></dl>
					<dl><dt>输入验证码：</dt>
						<dd>
							<input type="text" id="VCode" name="VCode" class="txt2" placeholder="请输入验证码">
							<span class="txt3">
		    		<a  id="captcha-container" >
		    			<img style="height:46px" src="<?php echo U('Register/verify_c',array());?>" title="点击刷新" onclick="verify_img();">
		    		</a>
		    	</span>
						</dd>
					</dl>
					<dl><dt>短信验证码：</dt>
						<dd>
							<input type="text" id="SM_VCode" name="SM_VCode" class="txt2" placeholder="请输入短信验证码">

							<input id="SMbtn" name="SMbtn" type="button" value="获取验证码" class="txt6" onclick="SM_Check()" />
						</dd>
					</dl>
					<div class="txt8"><label><input type="checkbox" id="UAgreement" name="UAgreement" value="1" checked="checked"> 同意《妥妥运车用户协议》</label>  <a href="javascript:void(0)">点击查看</a></div>
					<div class="txt4"><input type="button" value="注册" onclick="Login_Check()"></div>
					<div class="txt7"><a href="/Front/Login/pclogin/">已有账号，去登录</a></div>

				</div>
				<div class="deng2b2">

				</div>


			</div>

		</div>
	</div>
</div>




<div  id="bg" class="bg" style="display:none;"></div>
<div class="den0" style="display: none;">
   <div class="den1">
    <h2>用户服务协议</h2>
   </div>
   <div style="padding:0px;" class="deng2">
		<div class="noty1" id="noty1_a">
		<P align=center><FONT size=5><STRONG>妥妥运车用户服务协议</STRONG></FONT></P>
		<p>&nbsp;</p>
<P>　　欢迎来到妥妥运车网站www.tuotuoyunche.com，为明确会员的权利和义务，制定本协议</P>
<P>　　请您仔细阅读该用户协议，通过访问、浏览或使用该网站，您确认您已经阅读过并完全理解该协议，也同意受这些协议的约束，而且您同意遵守所有可适用的法律法规。如有意见或问题，请及时与我们取得联系。</P>
<P><FONT size=2>　<STRONG>　一.会员要求</STRONG></FONT></P>
<P>　　成为会员，您须符合下列条件:</P>
<P>　　您必须是年满18周岁，有签订合同的民事行为能力和相应的民事权利能力;您在注册所有栏目中填写的信息必须是真实、有效的;您同意此协议和网站中所有条款的约束。</P>
<P>　　妥妥运车有权接受或拒绝任何人的注册申请并无须提供理由。</P>
<P><STRONG><FONT size=2>　　二.权利与义务</FONT></STRONG></P>
<P>　　1. 您有权根据本协议和妥妥运车网站上发布的相关规则在妥妥运车网站上查询服务信息、订购服务产品、参加妥妥运车的有关活动，以及使用妥妥运车网站提供的其他服务。</P>
<P>　　2. 您保证在妥妥运车网站购买产品过程中遵守法律法规、不违背社会公德及遵守诚实信用原则，不扰乱妥妥运车平台交易的正常秩序，因此您将不会实施以下任一行为：</P>
<P>　　通过机器人插件、蜘蛛程序、推土机程序或其他自动化的手段访问或登录妥妥运车网站;通过发送病毒、木马等行为攻击其它用户的账号或终端设备;通过留言、评价等手段发送违规或垃圾信息;妥妥运车网站其他规则规定的不当行为。</P>
<P>　　3. 您享有言论自由权利，并拥有修改、删除自己发表的文章、评价的权利。</P>
<P>　　4. 您理解并保证不在妥妥运车网站传输或发表包含以下内容的言论：</P>
<P>　　违反宪法或法律法规规定的;损害国家荣誉和利益，损害公共利益的;散布谣言，扰乱社会秩序，破坏社会稳定的;散布淫秽、色情、赌博、暴力、凶杀、恐怖或者教唆犯罪的;s含有法律、行政法规禁止的其他内容的。</P>
<P><STRONG><FONT size=2>　　三.内容的生效与变更</FONT></STRONG></P>
<P>　　1. 本协议内容包括协议正文及所有妥妥运车已经发布的或将来可能发布的各类规则。 如本协议中的任何条款无论因何种原因被视为完全或部分无效或不具有执行力，该条应视为可分的，且不影响本协议的任何其余条款的有效性、约束力及可执行性。本协议中的标题仅为方便而设，不具法律或契约效果。任何妥妥运车及其关联公司提供的服务均受本协议约束。</P>
<P>　　2. 注册成功后，即表示您同意接受妥妥运车网站上所有协议条款，也表示所有协议和条款即时生效，您已成为会员，即可参加销售活动并享受各种优惠，同时视为允许妥妥运车通过电子邮件或其他方式向用户发送相关的优惠服务信息。同时您可以通过妥妥运车网站公布的规则，选择取消或拒绝部分/ 全部信息的提供。</P>
<P>　　3. 首先，妥妥运车只允许每位用户使用一个妥妥运车网站账户。您可以根据本站规定修改您的密码。如有证据证明或妥妥运车有理由相信您存在注册或使用多个妥妥运车网站账户的情形，妥妥运车有权采取冻结或关闭账户、取消订单、拒绝提供服务等措施，如给妥妥运车网站及相关方造成损失的，您还应承担赔偿责任。其次，鉴于网络服务的特殊性，妥妥运车无义务审核是否是您本人使用该组用户名及密码，仅审核用户名及密码是否与数据库中保存的一致，任何人只要输入的用户名及密码与数据库中保存的一致，即可凭借该组用户名及密码登陆并获得妥妥运车所提供的各类服务。妥妥运车提醒您妥善合理的保存您的会员名和密码，并对通过您的会员名和密码实施的行为负责。如果发现任何非法使用等可能危及您的账户安全的情形时，您应当立即以有效方式通知妥妥运车，要求妥妥运车暂停相关服务，并向公安机关报案。且妥妥运车对在采取行动前已经产生的后果(包括但不限于您的任何损失)不承担任何责任。再者，用户不得将在本站注册获得的账户借给他人使用，否则用户应承担由此产生的全部责任，并与实际使用人承担连带责任。最后，除非有法律规定或司法裁定，且征得妥妥运车的同意，否则，会员名和密码不得以任何方式转让、赠予或继承。</P>
<P>　　4. 为方便您使用妥妥运车平台服务及妥妥运车关联公司或其他组织的服务(以下称其他服务)，您同意并授权妥妥运车将您在注册、使用妥妥运车平台服务过程中提供、形成的信息传递给向您提供其他服务的妥妥运车关联公司或其他组织，或从提供其他服务的妥妥运车关联公司或其他组织获取您在注册、使用其他服务期间提供、形成的信息。</P>
<P>　　5. 妥妥运车有权根据需要不定期地制订、修改本协议及/或各类规则，并在妥妥运车网站公示，不再另行单独通知用户。变更后的协议和规则一经网站公布，立即生效。如您不同意相关变更，应当立即停止使用妥妥运车网站服务;若继续使用，即表明您接受修订后的协议和规则。</P>
<P>　　6. 妥妥运车保留在中华人民共和国大陆地区施行之法律允许的范围内独自决定拒绝服务、关闭用户账户、清除或编辑内容或取消订单的权利，妥妥运车可以在无须通知的情况下随时终止、变更、暂停或停止本网站，包括本网站的任何栏目的使用。</P>
<P>　　7. 妥妥运车在接到您投诉、主管机关通知或按照法律法规规定，有合理的理由认为特定会员及具体交易事项可能存在重大违法或违约情形时,妥妥运车可依约定或依法采取相应措施。</P>
<P>　　8. 妥妥运车不担保网络服务一定能满足用户的要求。由于法律规定的不可抗力，信息网络正常的设备维护，信息网络连接故障，电脑、通讯或其他系统的故障，电力故障等等，以及司法行政机关的命令或第三方的不作为及其他本平台无法控制的原因造成的本网站网络服务中断或延迟服务、丢失数据信息、记录，而导致的网络服务及时性、安全性、准确性无法保障，妥妥运车不承担任何责任，但妥妥运车将协助处理相关事宜，尽力减少因此而给用户造成的损失和影响。任何时候如果您认为www.tuotuoyunche.com没有遵守这些原则时，请利用电子邮件或者是服务电话通知我们，我们会尽一切努力，在合理适当的范围内立即改善这个问题。</P>
<P>　　9. 关于 Cookies</P>
<P>　　运用Cookies技术，本网站能够为您提供更加周到的个性化服务。Cookies是指一种技术，当使用者访问设有Cookies装置的本网站时，本网站的服务器会自动发送Cookies至阁下浏览器内，并储存到您的电脑硬盘内，此Cookies便负责记录日后您访问本网站的各种活动、个人资料、浏览习惯、消费习惯甚至信用记录。妥妥运车有时会使用cookies，使您在访问我们的网站时得到更好的服务。因此，Cookie的主要用途之一是提供一种节约时间的实用功能。您可以接受或拒绝Cookie。大多数Web浏览器会自动接受Cookie，但您通常可根据自己的需要来修改浏览器的设置以拒绝 Cookie。</P>
<P><STRONG>　<FONT size=2>　四.免责事项</FONT></STRONG></P>
<P>　　1. 声明</P>
<P>　　对于所有的在本网站上获得的或通过本网站所能获得的产品、服务和信息内容，本网站不提供任何形式明确的或隐含的担保或保证，包括但不限于以上所述所有产品、服务和信息的可销性及对于特定目的、资格及不侵权范畴的遵守性。妥妥运车不保证本网站内的所有信息是准确、有效、可靠或可利用的，也不保证上述所有信息没有侵犯任何第三方的合法权益。妥妥运车也不保证本网站的网址、服务器或本网站发送的电子邮件内没有病毒或破坏性插件。</P>
<P>　　2. 关于和其他网站的链接</P>
<P>　　妥妥运车不保证为向用户提供便利而设置的外部链接的准确性和完整性，同时，对于该等外部链接指向的不由妥妥运车实际控制的任何网页上的内容，妥妥运车不承担任何责任。妥妥运车网站内所包含的链接和妥妥运车无关。 妥妥运车也不认可和推荐对上述链接网站的使用，同时妥妥运车对上述链接网站上的内容及销售的产品与服务，也不提供任何形式的担保和保证。且不对这些网站对会员的隐私和个人信息的管理承担责任。 当您通过妥妥运车的链接连接到这些网站时，请您务必提高警惕，并且仔细阅读他们的网站使用规则及隐私条款 。</P>
<P><STRONG>　　<FONT size=2>五.隐私条款</FONT></STRONG></P>
<P>　　1. 妥妥运车承诺尊重您的隐私和您的个人信息安全。您已知悉在使用妥妥运车网站提供的服务时，涉及您真实姓名/名称、通信地址、联系电话、电子邮箱等隐私信息的，妥妥运车网站将予以严格保密，除非得到您的授权或法律另有规定，妥妥运车网站不会向外界披露您隐私信息。</P>
<P>　　2. 妥妥运车将会非常认真地保护您的个人信息。</P>
<P>　　妥妥运车不向任何其他人出售或出租您的个人信息，也不会提供信息给推销和商业目的公司或代理机构(除政府机构请求、法院调查令等情况外)。但如果是为经营目的需要的，妥妥运车可以将信息交付给一些服务提供商旨在为妥妥运车的经营来使用。例如，他们负责处理妥妥运车的装运业务、数据管理业务、电子邮件发送业务、市场调查业务、信息分析业务和促销管理业务。妥妥运车提供给其服务提供商的个人信息的前提是他们需要这些信息来完成其服务并同时承诺尽可能保护您的个人信息。在互联网使用中经常会有第三方通过非法手段在中途截取发送的信息，导致妥妥运车无法完全保证您传送的信息的安全。因此发送任何信息的风险您都必须承担。妥妥运车将采取所有合理的预防措施来尽可能的确保您的订单和付款详细信息的安全，除非妥妥运车存在疏忽，否则妥妥运车将不承担因您提供的信息被非法侵入而造成您和第三方的相应损失。 如有疑问或发现异常情况，请及时拨打客服电话或发送邮件给我们，以便我们核查。</P>
<P><STRONG><FONT size=2>　　六.知识产权</FONT></STRONG></P>
<P>　　1. 版权(著作权)</P>
<P>　　所有出现在本网站上的内容包括但不限于：编码、商标、服务标志、商号、图形、美术品、照片、肖像、文字内容、音频片断、按钮图标以及计算机软件、标识、数码下载、数据汇编都是妥妥运车或其内容提供者的财产，受到中华人民共和国版权相关法律法规的保护。您仅在符合本网站使用目的的前提下被许可浏览和使用本网站，即以个人名义购买产品供个人使用的目的。其他方式的使用都是被严格禁止的，包括但不限于以下方式：复制、修改、销售、传送、再版、删除、添加、展览、记入或演示本网站的内容或以其他方式部分地或整体地非法使用本网站的内容。在没有经过妥妥运车明确的书面许可情况下，是不允许在标签及其他“隐藏文字内容”中使用妥妥运车的名称及商标的。妥妥运车有权利授权或禁止任何复制本网站的内容(或者其他手段、其他形式、整体地或部分地)。否则，将承担一切法律责任。</P>
<P>　　2. 商标</P>
<P>　　妥妥运车是不会通过授权或其他的形式允许任何个人和单位使用妥妥运车网站的商标、服务标志、商号和标识，以及在网站上显示的其他相关内容。妥妥运车禁止将妥妥运车标识作为其他网站的链接使用，除非这样的链接事先得到了妥妥运车的书面许可。 任何非法和未经授权的使用上述商标的行为，都是被禁止的，而且还要承担相应的严重法律后果。注册的和未注册的私人信息是归妥妥运车和其指定人所有和控制的，因此，任何个人和单位以任何形式不正确使用都会承担侵权、盗用及其他法律规定的相应责任。绝对禁止为获取不正当利益而使用上述的商标和其他在妥妥运车标识的行为，以至损害商标和商标所有人利益。</P>
<P>　<STRONG>　<FONT size=2>七.协议终止</FONT></STRONG></P>
<P>　　1. 您允许妥妥运车有权不经事先通知、自行决定以任何理由的中止、终止向您提供部分或全部妥妥运车服务，暂时或永久冻结(注销)您的账户，且无须为此向您或任何第三方承担任何责任。</P>
<P>　　2. 出现以下情况时，妥妥运车有权直接以注销账户的方式终止本协议:</P>
<P>　　您提供的电子邮箱不存在或无法接收电子邮件，且没有其他方式可以与您进行联系，或妥妥运车以其它联系方式通知您更改电子邮件信息，而您在妥妥运车通知后三个工作日内仍未更改为有效的电子邮箱的;您注册信息中的主要内容不真实或不准确;本协议(含规则)变更时，您通知妥妥运车不愿接受新的服务协议的;包括但不限于以上情条款中的其它妥妥运车认为应终止服务的情况。</P>
<P>　　本协议的订立、执行和解释及争议的解决均应适用在中华人民共和国大陆地区适用之有效法律(但不包括其冲突法规则)。如其中任何条款与中华人 民共和国法律相抵触，则这些条款将完全按法律规定重新解释，而其它条款依旧具有法律效力。我们保留随时更改上述免责及其他条款的权利。</P>
<P>　　本协议履行过程中，因您使用妥妥运车网络服务产生争议应由妥妥运车与您沟通并协商处理。协商不成时，双方均同意以妥妥运车项目部所在地人民法院为管辖法院(北京市顺义区)。</P>
<P>　　本声明的解释权及对本网站使用的解释权归妥妥运车所有。</P>
<P>　<STRONG><FONT size=2>　八.协议终止后的处理</FONT></STRONG></P>
<P>　　1. 本协议终止后，除法律有明确规定外，妥妥运车无义务向您或您指定的第三方披露您账户中的任何信息。</P>
<P>　　2. 本协议终止后，妥妥运车仍享有下列权利：</P>
<P>　　继续保存您留存于妥妥运车平台的各类信息;对于您过往的违约行为，妥妥运车仍可依据本协议向您追究违约责任。</P><p>&nbsp;</p>
		</div>
		<div class="noty2">
			<div class="eek71">
			  <p>
				<span class="on"><label><input type="checkbox" id="agree" name="dfd" value="1"></label></span><a>同意《<b id="kkk">用户服务协议</b>》</a>
				<button type="button">确定</button>
			  </p>

			</div>
		</div>
   </div>
 </div>

<script>
//手机动态验证码等待60秒
var count = 60;
//验证码
function verify_img(){
	var captcha_img = $('#captcha-container').find('img');
	captcha_img.attr("src", '/Front/Register/verify_c?random='+Math.random());
};

//失去焦点查询手机号
function selTel(){
	var tel=$('#tel').val();
	if(tel != ""){
		if(!$.check_Mobile(tel)){
			$.anewAlert("手机号格式不对");
			return false;
		}else{
			$.post('/Front/Register/selTel',{'tel':tel},function(data){
				if(data>0){
					$.anewAlert("手机号已注册");
					$("#tel").val("");
				}
			})
		}
	}else{
		$.anewAlert("手机号不能为空");
		return false;
	}
}
//登录密码检测
function checkPass(obj){
	var pw = $(obj).val();
	var upwd = $("#upwd").val();
	if(pw.trim()!=upwd){
		$.anewAlert("两次输入密码不一致");
		$(obj).val("");
		return false;
	}
}
//发送短信验证
function SM_Check(){
	var tel=$('#tel').val();//手机号
	var VCode=$('#VCode').val();	//验证码
	//验证手机号
	if(tel==""){
		$.anewAlert("请输入手机号");
		return false;
	}else if(!$.check_Mobile(tel)){
		$.anewAlert("请输入正确的手机号");
		return false;
	}
	if(VCode==""){
		$.anewAlert("请输入验证码");
		return false;
	}
	$.post('/Front/Register/tel_SMS',{'tel':tel,"VCode":VCode},function(data){
		if(data.massion=='S'){
			//手机动态验证码等待60秒
			var tmrid= setInterval("setvalue()", 1000);
			event.cancelBubble=true
			//document.getElementById("SMS_VCode").value=data.code;
		}else{
			$.anewAlert(data['info']);
		}
	})
}

function Login_Check(){
	var From_Token =$('#From_Token').val();
	var tel=$('#tel').val();
	var upwd=$('#upwd').val();
	var upwd_two=$('#upwd_two').val();
	var VCode=$('#VCode').val();
	var SM_VCode=$('#SM_VCode').val();
	var SMS_VCode=$('#SMS_VCode').val();

	//验证手机号 check_Mobile
	if(tel.trim()==""){
		$.anewAlert("请输入手机号");
		return false;
	}else if(!$.check_Mobile(tel)){
		$.anewAlert("请输入正确的手机号");
		return false;
	}

	//验证密码
	if(upwd.trim()==""){
		$.anewAlert("请输入密码");
		return false;
	}

	//验证再次确认密码
	if(upwd_two.trim()==""){
		$.anewAlert("请再次确认密码");
		return false;
	}

	//验证两个密码是否一致
	if(upwd.trim()!=upwd_two.trim()){
		$.anewAlert("两次密码输入不一致");
		return false;
	}

	//验证验证码
	if(VCode.trim()==""){
		$.anewAlert("请输入验证码");
		return false;
	}

	//验证短信验证码
	if(SM_VCode.trim()==""){
		$.anewAlert("请输入短信验证码");
		return false;
	}

	//验证用户协议
	if(!$("#UAgreement").prop("checked")){
		$.anewAlert("请确认妥妥运车用户协议");
		return false;
	}
	//提交
	$.post('/Front/Register/register',{'From_Token':From_Token,'tel':tel,'upwd':upwd,'upwd_two':upwd_two,'VCode':VCode,'SM_VCode':SM_VCode,'SMS_VCode':SMS_VCode},function(data){
		if(data.type==0){
			$.anewAlert(data.info);
		}else{
			if(data.loginJump!=""){
				window.location.href="/Front/"+data.loginJump;
			}else{
				window.location.href="/Front/Index/homePage/";
			}
		}
	})
}

	//手机动态验证码等待60秒
	function setvalue()
	{
	    var btn = document.getElementById("SMbtn");
	    if (count > 0) {
	        btn.value = "等待" + count + "秒";
	        count--;
	        btn.disabled = true;
	    }
	    else {
	        btn.value = "获取验证码"
	        clearInterval("tmrid");
	        btn.disabled = false;
	    }
	}
	 $(".eek71 button").click(function(){
			$('.den0').hide();
			$('.bg').hide();
	});
	 $(".txt8 a").click(function(){
			$('.den0').show();
			$('.bg').show();
			if($("#agree:checked")){
				$("#UAgreement").prop("checked",true);
			}
	});
	 $(".eek71 span").click(function(){
		   if($(this).hasClass('on')){
				$(this).removeClass('on');
		   }else{
				$(this).addClass("on");
		   }
		});

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
							<?php if(is_array($tuoList)): foreach($tuoList as $k=>$vo): if($vo["title"] == '我要运车'): ?><dd><span><img src="/Public/Front/images/dddd.png">&nbsp;&nbsp;</span><a href="/Front/Order/normal"><?php echo ($vo["title"]); ?></a></dd>
									<?php else: ?>
									<dd><span><img src="/Public/Front/images/dddd.png">&nbsp;&nbsp;</span><a href="/Front/Footer/detail/code/<?php echo ($vo["article_code"]); ?>"><?php echo ($vo["title"]); ?></a></dd><?php endif; endforeach; endif; ?>
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
							<?php if(is_array($helpList)): foreach($helpList as $k=>$vo): ?><dd><span><img src="/Public/Front/images/dddd.png">&nbsp;&nbsp;</span><a href="/Front/Footer/detail/code/<?php echo ($vo["article_code"]); ?>"><?php echo ($vo["title"]); ?></a></dd><?php endforeach; endif; ?>
						</dl>
					</div>
				</div>

				<div class="col-sm-6 col-md-2 jkl1">
					<div class="dnn1">
						<h2><a href="javascript:;">支付方式</a></h2>
						<dl>
							<?php if(is_array($payList)): foreach($payList as $k=>$vo): ?><dd><span><img src="/Public/Front/images/dddd.png">&nbsp;&nbsp;</span><a href="/Front/Footer/detail/code/<?php echo ($vo["article_code"]); ?>"><?php echo ($vo["title"]); ?></a></dd><?php endforeach; endif; ?>
						</dl>
					</div>
				</div>
				<div class="col-sm-6 col-md-2 jkl1 jkl1b">
					<div class="dnn1">
						<h2><a href="javascript:;">关于妥妥</a></h2>
						<dl>
							<dd>妥妥运车，运车妥妥，微笑服务，专注服务。</dd>
							<dd><span><img src="/Public/Front/images/jtphoto.png">&nbsp;&nbsp;</span>机场东路翼之城4号楼</dd>
							<dd><span><img src="/Public/Front/images/xfphoto.png">&nbsp;&nbsp;</span>postmaster@tuotuoyunche.com</dd>
							<dd><span><img src="/Public/Front/images/tell.png">&nbsp;&nbsp;</span>400-877-1107</dd>
						</dl>
					</div>
				</div>
				<div class="col-sm-6 col-md-2 jkl1 jkl1c">
					<img src="/Public/Front/images/shx.png">
				</div>
				<div class="col-sm-6 col-md-2 jkl1 jkl1a">

					<div class="dnn1  ffdsf">
						<span class="pc">关注我们<br><br></span>
						<h2 class="phone">关注我们</h2>
						<div class="hoof2">
							<div class="bdsharebuttonbox">
								<img style="width:158px;height:158px;" src="/Public/Front/images/wskk1.jpg">
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
			</div>

		</div>
		<div class="fooh1">
			<div class="fooh2 container">
				<div class="fooh21">
					<p><span>©2016 安达承运物流 京ICP备16022345号-1</span></p>
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
<!-- <div class="xin5">
	<h2>感谢您的信任，请保持工作日电话畅通。</h2>
</div> -->
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




	$(".inko").click(function(){
		$(this).siblings(".selected").show();
		//$(this).siblings(".selected0").show();

	});
	$(".xiandan").click(function(){
		$(".korder0").animate({width:"100%"});

	});
	$(".close2").click(function(){
		$(".korder0").animate({width:"0%"});

	});




	$(".selected li").click(function(){
		$(this).parent().parent().hide();
		var oop= $(this).html();
		$(this).parent().parent().siblings('.inko').val(oop);

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

	function ceshi3(obj){
		$(obj).siblings(".selected0").show();
	}





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