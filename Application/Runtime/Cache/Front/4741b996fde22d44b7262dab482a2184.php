<?php if (!defined('THINK_PATH')) exit();?>


<script>
	/* $(document).ready(function(){
		var zong = '<?php echo ($jump["total"]); ?>';
		var bao = '<?php echo ($jump["sprice"]); ?>';
		var yun = '<?php echo ($jump["tprice"]); ?>';
		var ewai = '<?php echo ($jump["eprice"]); ?>';
		if(zong!=''){
			$("#zong").html(zong);
			$("#quickshop").show();
		}
		if(bao!=''){
			$("#secu").html(bao);
		}
		if(yun!=''&&ewai!=''){
			$("#trans").html(parseInt(ewai)/100 + parseInt(yun));
		}
		var zongz = '<?php echo ($jumpz["order"]["total"]); ?>';
		if(zongz!=''){
			$("#zongz").html(zongz);
		}
	}) */

	function ceshi(obj){
		var qsrcz = $("#qsrcz").val();
		if(qsrcz.trim()==""){
			layer.msg("请先选择出发地!");
			//$("#qepz").hide();
			//$("#q5").hide();
			//$("#qecz").hide();
			//$(".selected0").hide();
			return false;
		}else{
			$(obj).siblings(".selected0").show();
		}
	}
</script>
<script src="/Public/JS/indexTuo.js"></script>
<!--banner-->
	<div class="banner">
		<img src="/Public/Front/images/BANNER.png" style="width: 100%">
	</div>
<!--content-->
<div class="part1" style="width: 100%">
	<img class="pc" src="/Public/Front/images/HEARTONFIRE2.png"  style="width: 100%">
	<img class="phone" src="/Public/Front/images/qiche.png"  style="width: 100%">
	<div class="fwfont fwfontx">
		<font><strong>流程展示</strong></font>
		<h3>Process display</h3>
		<img src="/Public/Front/images/Rectangle.png">
	</div>
	<div style="text-align: center;">
		<img class="pc" src="/Public/Front/images/HEARTONFIRE1.png" style="width: 90%;margin-left: 5%;">
		<img class="phone" src="/Public/Front/images/liucheng.png" style="width: 100%">
	</div>
</div>
<div class="part8">
  <div class="part80 container">
	  <div class="fwfont">
	   <font><strong>快速服务</strong></font>
	   <h3>Fast service</h3>
	   <img src="/Public/Front/images/Rectangle.png">
	  </div>
	  <form method="post" action="/Front/Order/normal" id="quickz">
		<div class="korder1b00">
			  <!-- 开始地 -->
			  <input type="hidden" name="qsrez" id="qsrez" value="" />
			  <!-- 目的地 -->
			  <input type="hidden" name="qerez" id="qerez" value="" />
			  <!-- 开始地中文名称 -->
			  <input type="hidden" name="qsrezname" id="qsrezname" value="" />
			  <!-- 目的地中文名称 -->
			  <input type="hidden" name="qerezname" id="qerezname" value="" />
			  <!-- 车品牌 -->
			  <input type="hidden" name="qsctez" id="qsctez" value="" />
			  <!-- 车型号 -->
			  <input type="hidden" name="qsctcz" id="qsctcz" value="" />
			  <!-- 车id -->
			  <input type="hidden" name="carids" id="carids" value="" />
			  <!-- 运费 -->
			  <input type="hidden" name="lineprice" id="lineprice" value="0" />
			  <!-- 类型 -->
			  <input type="hidden" name="product_type" id="product_type" value="0" />
			  <!-- 总费 -->
			  <input type="hidden" name="totalz" id="totalz" value="0" />
			  <!-- 提车费 -->
			  <input type="hidden" name="tiz" id="tiz" value="0" />
			  <!-- 送车费 -->
			  <input type="hidden" name="songz" id="songz" value="0" />
			  <!-- 集散地起点 -->
			  <input type="hidden" name="sansz" id="sansz" value="" />
			  <!-- 集散地重点 -->
			  <input type="hidden" name="sanez" id="sanez" value="" />
			  <!-- 提车地id -->
			  <input type="hidden" name="tidz" id="tidz" value="" />
			  <!-- 送车地id -->
			  <input type="hidden" name="sidz" id="sidz" value="" />
			  <!-- 毛利 -->
			  <input type="hidden" name="maoliz" id="maoliz" value="0" />
			  <!-- 普通下单钱数第一部分 -->
			  <input type="hidden" name="ptxd1" id="ptxd1" value=0 />
			  <!-- 普通下单钱数第二部分 -->
			  <input type="hidden" name="ptxd2" id="ptxd2" value=0 />
			  <!-- 集散地B地名（汉字） -->
			  <input type="hidden" name="ptjsd" id="ptjsd" value='' />
			  <!-- 数据是否可用 -->
			  <input type="hidden" name="flag" id="flag" value='N' />
			  <input type="hidden" name="msg" id="msg" value='N' />
		  </div>
		<div class="part82">
		 <!--<ul>
			<li>
			 <a >
			<div class="paa0">
			  <div class="paa01">
			  <img src="/Public/Front/images/bgg3.jpg">
			  </div>
			  <div class="paa02">
			   <h2>专门保险</h2>
				<span></span>
			   <p>运输高效：全国128个办事处，运输线路辐射全国，多数城市之间专线直达</p>
			  </div>
			  </div>
			  </a>
			</li>
			<li>
			 <a >
			<div class="paa0">
			  <div class="paa01">
			  <img src="/Public/Front/images/bgg4.jpg">
			  </div>
			  <div class="paa02">
			   <h2>专人监管</h2>
				<span></span>
			   <p>价格透明：核算部门严格定价，妥妥运车官网透明可查  拒绝盲目要价 </p>
			  </div>
			  </div>
			  </a>
			</li>
			<li>
			 <a >
			<div class="paa0">
			  <div class="paa01">
			  <img src="/Public/Front/images/bgg5.jpg">
			  </div>
			  <div class="paa02">
			   <h2>专业托运</h2>
				<span></span>
			   <p>利益保障：专车专险，妥妥运车携手天平洋联合承保，全程保障客户利益  </p>
			  </div>
			  </div>
			  </a>
			</li>
			<li>
			 <a >
			<div class="paa0">
			  <div class="paa01">
			  <img src="/Public/Front/images/bgg6.jpg">
			  </div>
			  <div class="paa02">
			   <h2>专享服务</h2>
				<span></span>
			   <p>下单便捷 ：国内首家实现在线下单的运车公司，公众号、官网均可操作</p>
			  </div>
			  </div>
			  </a>
			</li>
		   </ul>-->
			<table id="searchtable" class="pc fwtable1">
				<tr>
					<td style="width:5%"><img class="bfb" onclick="last()" src="/Public/Front/images/dj2.png"></td>
					<td style="width:25%"></td>
					<td style="width:40%;">
						<div class="csczz">
							<p>请输入订单号查询当前订单状况，如果当前订单不存在，请联系客服人员。</p>
						</div>
						<div class="du3d" id="tiao1">
							<input type="text" placeholder="请在此输入订单号" class="cx1" id="keyword" ><!-- onkeyup="sel(this);" --><button onclick="tiaoFun();" type="button"></button>
							<div id="searchBoxs"></div>
						</div>
					</td>
					<td style="width:25%"></td>
					<td style="width:5%"><img class="bfb" onclick="next()" src="/Public/Front/images/dj1.png"></td>
				</tr>
				<tr class="searchtd">
					<td colspan="2"></td>
					<td>
						<div class="serchimg">
							<div class="tiaofun"  onclick="tiaoFun();">
								<center><strong><font class="xddfont"><a style="color:#FFFFFF">订单查询</a></font></strong></center>
							</div>
						</div>

					</td>
				</tr>
			</table>
			<table id="inserttable">
				<tr>
					<td style="width:5%"><img class="pc bfb" onclick="last()" src="/Public/Front/images/dj2.png"></td>
					<td class="imgtd">
						<div class="descrimg1">
							<img src="/Public/Front/images/description.png"/>
						</div>
						<img class="descrimg2" src="/Public/Front/images/hd3.jpg">
					</td>
					<td class="fwtd">
						<table>
							<tr>
								<td colspan="3">
									<font class="ycfont1">妥妥运车</font>&nbsp;&nbsp;&nbsp;<font class="ycfont2">爱车与您同在</font>
								</td>
							</tr>
							<tr>
								<td colspan="3"><font class="ycfont3">Happy every day</font></td>
							</tr>
							<tr class="jiange"></tr>
							<tr>
								<td class="blacktd"><div class="buttonblack1"><center><font>出发地</font></center></div></td>
								<td style="width:45%"><!-- 开始地 -->
									<div class="tab-pay1 top_search2">
										<dl class="dlbottom">
											<dd>
												<input type="text" placeholder="" class="txt1a inko" readonly="readonly" name="qsrcz" id="qsrcz" value="<?php echo ($jumpz['order']['start']); ?>" onclick="ceshi3(this);">
												<span class="xxsj"></span>
												<div class="selected0" id="q4">
													<div class="province star_province" id="qspz">
														<!-- <li data-id="14">请选择</li> -->
														<?php if(is_array($pro)): foreach($pro as $key=>$vo): ?><li data-id="1"  onclick="getCityz('<?php echo ($vo["area_id"]); ?>','S','<?php echo ($vo["area_name"]); ?>')"><?php echo ($vo["area_name"]); ?></li><?php endforeach; endif; ?>
													</div>
													<div class="city star_city" data-id="" style="display:none" id="qscz"></div>
													<div class="county star_county" data-id="" style="display:none" id="qsbz"></div>
												</div>
											</dd>
										</dl>
									</div>
								</td>
								<td rowspan="5">
									<div class="moneydiv">
										<div class="moneydiv2">
											<center><strong>
												<font class="moneyfont"><bold id="zongz1">0</bold><sup>￥</sup></font>
											</strong></center>
										</div>
									</div>
								</td>
							</tr>
							<tr class="jiange"></tr>
							<tr>
								<td><div class="buttonblack1"><center><font>目的地</font></center></div></td>
								<td><!-- 目的地 -->
									<div class="tab-pay1 top_search2">
										<dl class="dlbottom"><dd><input type="text" placeholder="" class="txt1a inko" readonly="readonly" name="qercz" id="qercz" value="<?php echo ($jumpz['order']['end']); ?>" onclick="ceshi(this);">
											<span class="xxsj"></span>
											<div class="selected0" id="q5">
												<div class="province star_province" id="qepz">
													<?php if(is_array($pro)): foreach($pro as $key=>$vo): ?><li data-id="1"  onclick="getCityz('<?php echo ($vo["area_id"]); ?>','E','<?php echo ($vo["area_name"]); ?>')"><?php echo ($vo["area_name"]); ?></li><?php endforeach; endif; ?>
												</div>
												<div class="city star_city" data-id="" id="qecz" style="display:none"></div>
												<!-- <div class="county star_county" data-id=""></div> -->
											</div> </dd></dl>
									</div>
								<td></td>
							</tr>
							<tr class="jiange"></tr>
							<tr>
								<td><div class="buttonblack2"><center><font>品牌车系</font></center></div></td>
								<td><!-- 车品牌 -->
									<div class="tab-pay1 top_search2">
										<dl class="dlbottom"><dd><input type="text" placeholder="" class="txt1a inko" id="qbtz" name="carInfoz" value="<?php echo ($jumpz['order']['carInfo']); ?>" onkeyup="serchCar(this);" onclick="ceshi3(this);">
											<span class="xxsj"></span>
											<div class="selected0" id="q6">
												<div class="province star_province" id="qbrz">
													<?php if(is_array($brand)): foreach($brand as $key=>$vo): ?><li data-id="1"  onclick="getTypez('<?php echo ($vo["cxjj_id"]); ?>','<?php echo ($vo["cxjj_brand"]); ?>')"><?php echo ($vo["cxjj_name"]); ?>--<?php echo ($vo["cxjj_brand"]); ?></li><?php endforeach; endif; ?>
												</div>
												<div class="city star_city" data-id="" style="display:none" id="qtz"></div>
												<!-- <div class="county star_county" data-id=""></div> -->
											</div> </dd></dl>
									</div>
								</td>
								<td></td>
							</tr>
							<tr>
								<td colspan="3" class="heighttd"></td>
							</tr>
							<tr>
								<td colspan="3" class="xdtd">
									<font class="pc xdfont">如果你不知道如何下单，打电话告诉我们，我们帮助您下单。电话：400-877-1107</font>
									<font class="phone xdfont">如果你不知道如何下单，打电话告诉我们，我们帮助您下单。电话：</font><font class="phone" style="color:#ea5512;text-align: center;font-size:18px;">400-877-1107</font>
								</td>
							</tr>
						</table>
					</td>
					<td style="width:5%"><img class="pc bfb" onclick="next()" src="/Public/Front/images/dj1.png"></td>
				</tr>
				<tr style="height:119px;">
					<td colspan="2"></td>
					<td>
						<div class="xddiv">
							<div class="xdchild"  onclick="goOrder();">
								<center><strong><font class="xddfont"><a>立即下单</a></font></strong></center>
							</div>
						</div>

					</td>
				</tr>
			</table>
	  </div>
	  </form>
  </div>
</div>

<div class="ttxw">
	<!--<div class="container">
		<div class="part51">
			<img src="/Public/Front/images/pa51.png"/>
			<h2>妥妥新闻</h2>
			<img src="/Public/Front/images/pa52.png"/>
		</div>
		<div class="iske1">
			<div class="iske2">
				<div class="iske3">
					<div class="iske4">
						<a href="/Front/News/detail/code/<?php echo ($artList[0]['article_code']); ?>"><img src="<?php echo ($artList[0]['article_img']); ?>"></a>

								<div class="iske6">
					<ul>
						<?php if(is_array($artList2)): foreach($artList2 as $key=>$vo): ?><li>
								<a href="/Front/News/detail/code/<?php echo ($vo["article_code"]); ?>">
									<h2><?php echo ($vo["title"]); ?></h2>


							</li><?php endforeach; endif; ?>
					</ul>
				</div>







					</div>
					<div class="iske5">
						<h3><?php echo (date('m',$artList[0]['time'])); ?> / <?php echo (date('d',$artList[0]['time'])); ?> /<?php echo (date('Y',$artList[0]['time'])); ?> </h3>
						<h2><?php echo ($artList[0]['title']); ?> <a href="/Front/News/newsList"><span>More+</span></a></h2>
						<p><?php echo ($artList[0]['article_desc']); ?></p>

					</div>
				</div>

			</div>
			<div class="iske7">
				<h2><span>FAQ </span> 常见问题</h2>
				<ul>
					<?php if(is_array($cj)): foreach($cj as $k=>$vo): if($k < 9): ?><li><a href="/Front/Footer/detail/code/<?php echo ($vo["article_code"]); ?>"><p><?php echo ($k+1); ?>、<?php echo ($vo["title"]); ?></p></a></li><?php endif; endforeach; endif; ?>
				</ul>
			</div>
		</div>
	</div>-->
	<div class="pc ttxwpng1">
		<img style="width:100%;" src="/Public/Front/images/ttxw.png" >
	</div>
	<div class="ttxww">
		<div class="ttfont">
			<font><strong>妥妥新闻</strong></font>
			<h3>Proper news</h3>
		</div>
		<div class="ttxwp">
			<p readonly="readonly"><?php echo ($artList[0][content]); ?>...</p>
		</div>
		<div class="ttxwbutton">
			<div class="ttbutton1">
				<div class="xwdiv">
					<center><strong><a href="/Front/News/detail/code/<?php echo ($artList[0]['article_code']); ?>" class="xwfont">查看全文</a></strong></center>
				</div>
			</div>
			<div class="ttbutton2">
				<div class="xwdiv">
					<center><strong><a href="/Front/News/newsList" class="xwfont">更多</a></strong></center>
				</div>
			</div>
		</div>
	</div>
	<div style="width:100px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="pc"><br></span><br>&nbsp;&nbsp;</div>
</div>

<div style="padding-bottom: 64px;" class="part61 container">
  <div class="fwfont" style="margin-bottom: 56px;">
	  <center><font><strong>合作伙伴</strong></font>
	  <h3>Cooperation</h3></center>
	  <img src="/Public/Front/images/xhx.png" style="margin-top: 10px;width: 100%;">
  </div>
   <ul class="hzul">
   <?php if(is_array($linkList)): foreach($linkList as $k=>$vo): ?><li><a href="<?php echo ($vo["fl_link"]); ?>" target="_blank">
   <img  class="nb1"  src="<?php echo ($vo["fl_img"]); ?>">
   <img  class="nb2"  src="<?php echo ($vo["fl_img1"]); ?>">
   </a></li><?php endforeach; endif; ?>
   <!--<li><a href=""><img src="/Public/Front/images/logo2.png"></a></li>
   <li><a href=""><img src="/Public/Front/images/logo3.png"></a></li>
   <li><a href=""><img src="/Public/Front/images/logo4.png"></a></li>
   <li><a href=""><img src="/Public/Front/images/logo5.png"></a></li>
   <li><a href=""><img src="/Public/Front/images/logo6.png"></a></li>-->
   </ul>
</div>
<script>
	function next(){
		$("#inserttable").hide();
		$("#searchtable").show();
	}
	function last(){
		$("#searchtable").hide();
		$("#inserttable").show();
	}
	function tiaoFun(){
		var keyword = $("#keyword").val();
		if(keyword==""){
			layer.msg("请输入订单号");
			return false;
		}
		window.location.href="/Front/Ordersel/orderselView/status/2/keyword/"+keyword;
	}
	$('.aske1 ul li').click(function(){
		$(this).addClass('on').siblings().removeClass('on');
		$('.tab-cont1 .tab-pay1').eq($(this).index()).fadeIn(300).siblings().hide();
	});
</script>
<!--content-->