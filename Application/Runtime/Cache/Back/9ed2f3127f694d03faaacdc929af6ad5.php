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
	        <div class="row">
	            <div class="tsan113">
	                <div class="widget">
	                    <div class="tabbable">
	                        <ul class="nav nav-tabs" id="tabnav">
	                            <li class="active">
	                                <a>咨询下单</a>
	                            </li>
								<li >
                                	<a href="/Back/Worktwo/referList">咨询列表</a>
	                            </li>
	                            <li>
	                                <a href="/Back/Worktwo/referMarkList">待回电</a>
	                            </li>
								<li>
	                                <a href="/Back/Worktwo/huiList">待回访</a>
	                            </li>
								<li>
	                                <a href="/Back/Worktwo/qHuiList">全部回访</a>
	                            </li>
	                        </ul>
	                        <div class="tab-content1">
								<div class="onteyta1">
									<h2><strong>来电号码：</strong></h2>
									<div class="onteyta46">
										<input type="text" name="mobile" id='mobile' onblur="mobFun();" placeholder="请输入手机号" class="text25" value=""/>
										<button type="button" onclick="serchFuns();" class="btn dbtn1"> [查询]</button>
	                                </div>
								</div>
								<div class="onteytb">								
									<div class="onteytb4">								
										<h2><strong>历史备注：</strong></h2>
										<h2>称呼：<input type="text" id="chenghu" onblur="mobFun();" class="text25" value=""/></h2>
										<h2>电话：<span id="wefgwe"></span></h2>
									</div>	
									<div class="onteytb5 kfty">	
										<table> 
											<tbody id="egerer">
												
											</tbody>
										</table>
									</div>							
								</div>
								
								<div class="dw2 kfty1">
									<dl>
										<dt style="height:40px;">
											<h2>出发地：</h2>
											 <div class="pay1">
												<div class="pay3">
													<input type="text" placeholder="请选择省份" id="provincea" value="<?php echo ($pval["area_name"]); ?>"/>
													<div class="pay2" id="pay1">
														<ul id ="s1">
															<?php if(is_array($city)): $i = 0; $__LIST__ = $city;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><li data1="<?php echo ($vv["area_name"]); ?>" data2="<?php echo ($vv["area_id"]); ?>" onclick='changeShi(this)'><h2><?php echo ($vv["area_name"]); ?></h2></li><?php endforeach; endif; else: echo "" ;endif; ?>
														</ul>
													</div>
												</div>
												<div class="pay3">
													<input type="text" placeholder="请选择市" id="city" value="<?php echo ($cval["area_name"]); ?>"/>
													<div class="pay2" id="pay2">
														<ul id ="s2">
															
															
														</ul>
													</div>
												</div>
												<div class="pay3">
													<input type="text" placeholder="请选择区" id="county" value="<?php echo ($coval["area_name"]); ?>"/>
													<div class="pay2"  id="pay3">
														<ul id ="s3">
															
														</ul>
													</div>
												</div>
											</div>
											<input type="hidden" value="" id="pro"/>
											<input type="hidden" value="" id="cit"/>
											<input type="hidden" value="" id="cou"/>
											<!-- <select class="select1" id="city_sheng" name="city_sheng" onchange="cityFun(this);">
												<option value="" selected="selected">请选择省</option>
												<?php if(is_array($city)): foreach($city as $key=>$vo): ?><option value="<?php echo ($vo["area_id"]); ?>"><?php echo ($vo["area_name"]); ?></option><?php endforeach; endif; ?>
											</select>
											<select class="select1" id="city_shi" name="city_shi" onchange="city_quFun(this);">
												<option value="">请选择市</option>
											</select>
											<select class="select1" id="city_qu" name="city_qu">
												<option value="">请选择区</option>
											</select> -->
											
											<h2>目的地：</h2>
											<!-- <select class="select1" id="city_jie_sheng" name="city_jie_sheng" onchange="cityJieFun(this);">
												<option value="" selected="selected">请选择省</option>
												<?php if(is_array($city)): foreach($city as $key=>$vo): ?><option value="<?php echo ($vo["area_id"]); ?>"><?php echo ($vo["area_name"]); ?></option><?php endforeach; endif; ?>
											</select>
											<select class="select1" id="city_jie_shi" name="city_jie_shi" onchange="city_quFuns(this);">
												<option value="">请选择市</option>
											</select> -->
											 <div class="pay1">
												<div class="pay3">
													<input type="text" placeholder="请选择省份" id="provincea1" value="<?php echo ($pval["area_name"]); ?>"/>
													<div class="pay2" id="pay1">
														<ul id ="s11">
															<?php if(is_array($city)): $i = 0; $__LIST__ = $city;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><li data1="<?php echo ($vv["area_name"]); ?>" data2="<?php echo ($vv["area_id"]); ?>" onclick='changeShi1(this)'><h2><?php echo ($vv["area_name"]); ?></h2></li><?php endforeach; endif; else: echo "" ;endif; ?>
														</ul>
													</div>
												</div>
												<div class="pay3">
													<input type="text" placeholder="请选择市" id="city1" value="<?php echo ($cval["area_name"]); ?>"/>
													<div class="pay2" id="pay2">
														<ul id ="s21">
															
															
														</ul>
													</div>
												</div>
												
											</div>
											<input type="hidden" value="" id="pro1"/>
											<input type="hidden" value="" id="cit1"/>
										</dt>
										<dt>
											<h2>车型：</h2>
											<!-- <select class="select1" name="car_pin" id="car_pin" onchange="carpFuns(this);">
												<option value="" selected="selected">请选择车型</option>
												<?php if(is_array($cart)): foreach($cart as $key=>$vo): ?><option data='<?php echo ($vo["cxjj_id"]); ?>' value="<?php echo ($vo["cxjj_brand"]); ?>"><?php echo ($vo["cxjj_brand"]); ?></option><?php endforeach; endif; ?>
											</select>
											<select class="select1" name="car_xing" id="car_xing">
												<option data="" value="">请选择车型</option>
											</select> -->
											 <div class="pay1">
												<div class="pay3" >
													<input type="text" placeholder="请选择车型" id="provincea2" value="" style ="width:150px;"/>
													<div class="pay2" id="pay1">
														<ul id ="s12">
															<?php if(is_array($cart)): $i = 0; $__LIST__ = $cart;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><li data1="<?php echo ($vv["cxjj_brand"]); ?>" data2="<?php echo ($vv["cxjj_id"]); ?>" onclick='changeShi2(this)'><h2><?php echo ($vv["cxjj_brand"]); ?></h2></li><?php endforeach; endif; else: echo "" ;endif; ?>
														</ul>
													</div>
												</div>
												<div class="pay3">
													<input type="text" placeholder="请选择车系" id="city2" value="" style ="width:100px;"/>
													<div class="pay2" id="pay2">
														<ul id ="s22">
															
															
														</ul>
													</div>
												</div>
												
											</div>
											<input type="hidden" value="" id="pro2"/>
											<input type="hidden" value="" id="cit2"/>
											<input type="hidden" value="" id="pro2_name"/>
											<input type="hidden" value="" id="cit2_name"/>
											<a href="javascript:;" onclick="querenFuns();"><button>运费查询:</button></b><span id="yunPirce">0</span>元</a>
										</dt>
									</dl>
								</div>
								<div class="onteytb4">								
									<h2>保额：<input type="text" onkeyup="if(event.keyCode !=37 && event.keyCode != 39){if (!/^[\d]+$/ig.test(this.value)){this.value='';}}" class="text25" id="car_baojia" value=""/>(单位:万)</h2>
									<h2 onclick="baojia();"><button>保费查询:</button><span id="baoPirce">0</span>元</h2>
									<h2> 合计：<span id="totels">0</span>元</h2>
								</div>	
								<div class="onteytb4">	
									<button class="btn btn-default10" onclick="sendMobile(this);" type="button">短信回复</button>
									<button id="kkkt" class="btn btn-default10" type="button">去下单</button>
								</div>
								<input type="hidden" id="flag" value="N">
								<input type="hidden" id="msgs" value="">
								<input type='hidden' id="product_type" name="product_type">
								<input type='hidden' id="order_info_star" name="order_info_star">
								<input type='hidden' id="order_info_end" name="order_info_end">
								<input type='hidden' id="order_info_c_car" name="order_info_c_car">
								<input type='hidden' id="order_info_t_car" name="order_info_t_car">
								<input type='hidden' id="order_info_s_car" name="order_info_s_car">
								<input type='hidden' id="order_smsc_car" name="order_smsc_car">
								<input type='hidden' id="order_info_margin" name="order_info_margin">
								<input type='hidden' id="refer_id" name="refer_id">
								<script>
											$('.pay1 .pay3').click(function(){
												$(this).find('.pay2').slideToggle(1000).parent().siblings().find('.pay2').hide();
											});
															
															function changeShi(obj){
																
																var provinceid = $(obj).attr('data2');
				                                                $("#s2").children().remove();
				                                                $.post('/Back/Product/area_act', {provinceid: provinceid}, function(data) {
				                                                    var _html = "";
				                                                    for (var i = 0; i < data.length; i++) {
				                                                        _html += "<li data1="+data[i]['area_name']+" data2="+data[i]['area_id']+" onclick='changeCity(this)'><h2>"+data[i]['area_name']+"</h2></li>";
				                                                    }
				                                                    $('#s2').append(_html);
				                                                },'json');
				                                                
																$('#provincea').append().val(''+$(obj).attr('data1')+'');
																$('#pro').val($(obj).attr('data2'));
																$('#city').val('');
																$('#cit').val('');
															};
														
															function changeCity(obj){
                                                                var city = $(obj).attr('data2');
				                                                var city_name =$(obj).attr('data1');
				                                                $("#s3").children().remove();
				                                                $.post('/Back/Product/area_act', {provinceid: city}, function(data) {
				                                                    var _html = "";
				                                                    for (var i = 0; i < data.length; i++) {
				                                                        _html += "<li data1="+data[i]['area_name']+" data2="+data[i]['area_id']+" onclick='changeQu(this)'><h2>"+data[i]['area_name']+"</h2></li>";
				                                                    }
				                                                    $('#s3').append(_html);
				                                                },'json');
				                                                
																$('#city').append().val(city_name);
																$('#cit').val($(obj).attr('data2'));
																$('#county').val('');
																$('#cou').val('');
															}
														
															function changeQu(obj){
																$('#county').append().val(''+$(obj).attr('data1')+'');
																$('#cou').val($(obj).attr('data2'));
															}
															$('#provincea').bind('input propertychange', function() { 
															    //搜索省份
															     var name =$('#provincea').val();
															     $('#s1').children().remove();
																 $.post('/Back/Product/get_area_bycon', {name:name,pid:1}, function(data) {
					                                                    var _html = "";
					                                                    for (var i = 0; i < data.length; i++) {
					                                                        _html += "<li data1="+data[i]['area_name']+" data2="+data[i]['area_id']+" onclick='changeShi(this)'><h2>"+data[i]['area_name']+"</h2></li>";
					                                                    }
					                                                    $('#s1').append(_html);
					                                                },'json');
															
														     })
														     $('#city').bind('input propertychange', function() { 
															    //搜索省份
															     var name =$('#city').val();
															     var pid =$('#pro').val();
															     $('#s2').children().remove();
																 $.post('/Back/Product/get_area_bycon', {name:name,pid:pid}, function(data) {
					                                                    var _html = "";
					                                                    for (var i = 0; i < data.length; i++) {
					                                                        _html += "<li data1="+data[i]['area_name']+" data2="+data[i]['area_id']+" onclick='changeCity(this)'><h2>"+data[i]['area_name']+"</h2></li>";
					                                                    }
					                                                    $('#s2').append(_html);
					                                                },'json');
															
														     })
														     $('#county').bind('input propertychange', function() { 
															    //搜索省份
															     var name =$('#county').val();
															     var pid =$('#cit').val(); 
															     $('#s3').children().remove();
																 $.post('/Back/Product/get_area_bycon', {name:name,pid:pid}, function(data) {
					                                                    var _html = "";
					                                                    for (var i = 0; i < data.length; i++) {
					                                                        _html += "<li data1="+data[i]['area_name']+" data2="+data[i]['area_id']+" onclick='changeQu(this)'><h2>"+data[i]['area_name']+"</h2></li>";
					                                                    }
					                                                    $('#s3').append(_html);
					                                                },'json');
															
														     })
														     
														     function changeShi1(obj){
																
																var provinceid = $(obj).attr('data2');
				                                                $("#s21").children().remove();
				                                                $.post('/Back/Product/area_act', {provinceid: provinceid}, function(data) {
				                                                    var _html = "";
				                                                    for (var i = 0; i < data.length; i++) {
				                                                        _html += "<li data1="+data[i]['area_name']+" data2="+data[i]['area_id']+" onclick='changeCity1(this)'><h2>"+data[i]['area_name']+"</h2></li>";
				                                                    }
				                                                    $('#s21').append(_html);
				                                                },'json');
				                                                
																$('#provincea1').append().val(''+$(obj).attr('data1')+'');
																$('#pro1').val($(obj).attr('data2'));
																$('#city1').val('');
																$('#cit1').val('');
															};
														
															function changeCity1(obj){
                                                                var city = $(obj).attr('data2');
				                                                var city_name =$(obj).attr('data1');
				                                                $("#s31").children().remove();
				                                                $.post('/Back/Product/area_act', {provinceid: city}, function(data) {
				                                                    var _html = "";
				                                                    for (var i = 0; i < data.length; i++) {
				                                                        _html += "<li data1="+data[i]['area_name']+" data2="+data[i]['area_id']+" onclick='changeQu1(this)'><h2>"+data[i]['area_name']+"</h2></li>";
				                                                    }
				                                                    $('#s31').append(_html);
				                                                },'json');
				                                                
																$('#city1').append().val(city_name);
																$('#cit1').val($(obj).attr('data2'));
																$('#county1').val('');
																$('#cou1').val('');
																
																//下单 隐藏区
																 $.post('/Back/Product/area_act', {provinceid: city}, function(data) {
																	 var sum = data.length;
																		var str = '<option value="">请选择区</option>';
																		$("#city_qus").html('');
																		for(var i=0;i<sum;i++){
																			str += '<option value="'+data[i]['area_id']+'">'+data[i]['area_name']+'</option>';
																		}
																		$("#city_qus").append(str);
				                                                },'json');
																
															}
														
															$('#provincea1').bind('input propertychange', function() { 
															    //搜索省份
															     var name =$('#provincea1').val();
															     $('#s11').children().remove();
																 $.post('/Back/Product/get_area_bycon', {name:name,pid:1}, function(data) {
					                                                    var _html = "";
					                                                    for (var i = 0; i < data.length; i++) {
					                                                        _html += "<li data1="+data[i]['area_name']+" data2="+data[i]['area_id']+" onclick='changeShi1(this)'><h2>"+data[i]['area_name']+"</h2></li>";
					                                                    }
					                                                    $('#s11').append(_html);
					                                                },'json');
															
														     })
														     $('#city1').bind('input propertychange', function() { 
															    //搜索省份
															     var name =$('#city1').val();
															     var pid =$('#pro1').val();
															     $('#s21').children().remove();
																 $.post('/Back/Product/get_area_bycon', {name:name,pid:pid}, function(data) {
					                                                    var _html = "";
					                                                    for (var i = 0; i < data.length; i++) {
					                                                        _html += "<li data1="+data[i]['area_name']+" data2="+data[i]['area_id']+" onclick='changeCity1(this)'><h2>"+data[i]['area_name']+"</h2></li>";
					                                                    }
					                                                    $('#s21').append(_html);
					                                                },'json');
															
														     })
														     
														       function changeShi2(obj){
																
																var provinceid = $(obj).attr('data2');
				                                                $("#s22").children().remove();
				                                                $.post('/Back/Product/car_act', {brand: provinceid}, function(data) {
				                                                    var _html = "";
				                                                    for (var i = 0; i < data.length; i++) {
				                                                        _html += "<li data1='"+data[i]['cxjj_brand']+"' data2="+data[i]['cxjj_id']+" onclick='changeCity2(this)'><h2>"+data[i]['cxjj_brand']+"</h2></li>";
				                                                    }
				                                                    $('#s22').append(_html);
				                                                },'json');
				                                                
																$('#provincea2').append().val(''+$(obj).attr('data1')+'');
																$('#pro2').val($(obj).attr('data2'));
																$('#pro2_name').val($(obj).attr('data1'));
																
																$('#city2').val('');
																$('#cit2').val('');
																$('#cit2_name').val('');
															};
														
															function changeCity2(obj){
                                                                var city = $(obj).attr('data2');
				                                                var city_name =$(obj).attr('data1');
				                                                $("#s32").children().remove();
				                                                $.post('/Back/Product/car_act', {brand: city}, function(data) {
				                                                    var _html = "";
				                                                    for (var i = 0; i < data.length; i++) {
				                                                        _html += "<li data1='"+data[i]['cxjj_brand']+"' data2="+data[i]['cxjj_id']+" onclick='changeQu2(this)'><h2>"+data[i]['cxjj_brand']+"</h2></li>";
				                                                    }
				                                                    $('#s32').append(_html);
				                                                },'json');
				                                                
																$('#city2').append().val(city_name);
																$('#cit2').val($(obj).attr('data2'));
																$('#cit2_name').val(city_name);
																
																$('#county2').val('');
																$('#cou2').val('');
															}
														
															$('#provincea2').bind('input propertychange', function() { 
															    //搜索省份
															     var name =$('#provincea2').val();
															     $('#s12').children().remove();
																 $.post('/Back/Product/by_getCarx', {name:name,pid:0}, function(data) {
					                                                    var _html = "";
					                                                    for (var i = 0; i < data.length; i++) {
					                                                        _html += "<li data1='"+data[i]['cxjj_brand']+"' data2="+data[i]['cxjj_id']+" onclick='changeShi2(this)'><h2>"+data[i]['cxjj_brand']+"</h2></li>";
					                                                    }
					                                                    $('#s12').append(_html);
					                                                },'json');
															
														     })
														     $('#city2').bind('input propertychange', function() { 
															    //搜索省份
															     var name =$('#city2').val();
															     var pid =$('#pro2').val();
															     $('#s22').children().remove();
																 $.post('/Back/Product/by_getCarx', {name:name,pid:pid}, function(data) {
					                                                    var _html = "";
					                                                    for (var i = 0; i < data.length; i++) {
					                                                        _html += "<li data1='"+data[i]['cxjj_brand']+"' data2="+data[i]['cxjj_id']+" onclick='changeCity2(this)'><h2>"+data[i]['cxjj_brand']+"</h2></li>";
					                                                    }
					                                                    $('#s22').append(_html);
					                                                },'json');
															
														     })
														</script>
								<script>
									function mobFun(obj){
										var tr_name = $("#chenghu").val();
										var tr_tel = $("#mobile").val();//手机号
										$('#x_name').val(tr_name);
										$('#user_code').val(tr_tel);
										if(tr_name!="" && tr_tel!=""){
											$('#xias').html(tr_tel);
											$("#A1_s").val(tr_tel);
										}
									}
									$(".onteytb4 #kkkt").click(function(){
										if($(".kfty9").css("display")=="none"){
											var tr_name = $("#chenghu").val();
											var tr_tel = $("#mobile").val();//手机号
											var flag = $('#flag').val();
											var baoPirce = $('#baoPirce').html();
											var car_baojia = $("#car_baojia").val();
											if(!$.check_Mobile(tr_tel)){
												layer.msg("请输入正确的手机号!");
												return false;
											}
											if(tr_name==""){
												layer.msg("请先输入称呼");
												return false;
											}
											if(!$.isPositiveNum(car_baojia))car_baojia=0;
											/* if(car_baojia == "" || car_baojia == 0){
												$("#baoPirce").html(0);
												$("#order_info_price").html(0);
												$("#order_info_bxd").html(0);
												totelFun();
												$(".kfty9").hide();
												layer.msg("请输入保额");
												return false;
											} */
											/* if(flag == 'N'){
												layer.msg("请先查询运价");
												return false;
											} */
											/* if(baoPirce == 0){
												layer.msg("请先查询保费");
												return false;
											}
											 */
											$(".kfty9").show();
										}else{
											$(".kfty9").hide();
										}
									});
								</script>
								<div class="kfty9">
									<div class="onteytb">
										<div class="onteytb4">								
											<h2><strong>下单</strong></h2>
										</div>	
										<div class="kfty2">
											<div class="onteytb1">
												<div class="kfty3">
													<h2><span>下单人：</span><input type="text" disabled="disabled" id="x_name" class="text25" value=""/></h2>
													<h2><span>电话：</span><input type="text" disabled="disabled" id="user_code" class="text25" value=""/></h2>
												</div>
												<div class="kfty3">
													<h2><span>出发地联系人：</span><input onblur="chuFun();" type="text" id="fa_name" class="text25" value=""/></h2>
													<h2><span>电话：</span><input type="text" onblur="chuFun();" id="fa_tel" class="text25" value=""/></h2>
												</div>
												<div class="kfty3 kfty6">
													<h2><span>身份证：</span><input type="text" id="fa_sf" class="text25" value=""/></h2>
												</div>
												<div class="kfty3 kfty4 kfty5">
													<h2><span>车型：</span></h2>
													<span id="car_type_brand"></span>
													<h2><span>车牌/驾号：</span><input name="carmark" placeholder="请输入车牌号" id="carmark"  type="text" class="input2" value=""/></h2>
												</div>
												<div class="kfty3 kfty4 kfty5">
													<h2><span>地址：</span></h2>
													<span id="str_add"></span>
													<h2><input placeholder="提车地详细地址" id="order_info_star_address" type="text" class="input2" value=""/></h2>
												</div>
											</div>	
											<div class="onteytb1">
												<div class="onteytc5">
													<span><input name="busin_type" checked="checked" type="radio" value="A">散车 </span> 
													<span><input name="busin_type" type="radio" value="B">公司业务  </span>
												</div>
												<div class="kfty3">
													<h2><span>目的地联系人：</span><input type="text" onblur="muFun();" id="sh_name" class="text25" value=""/></h2>
													<h2><span>电话：</span><input type="text" onblur="muFun();" id="sh_tel" class="text25" value=""/></h2>
												</div>
												<div class="kfty3 kfty6">
													<h2><span>身份证：</span><input type="text" id="sh_sf" class="text25" value=""/></h2>
												</div>
												<div class="kfty3 kfty4 kfty5">
													<h2><span>地址：</span></h2>
													<span id="end_add"></span>
													<h2><input placeholder="目的地详细地址" id="order_info_end_address" type="text" class="input2" value=""/></h2>
												</div>	
											</div>
											<div class="onteytb1">
												<div class="onteytc5">
													<span><input name="receipt" type="checkbox" value="Y">需回单 </span> 
												</div>
												<div class="onteytc5">
													<span><input class="vv1" name="smsc" checked="checked" type="radio" value="N">自提 </span> 
													<span><input class="vv1" name="smsc" type="radio" value="Y">送车  </span>
													<span id="awdf" style="display:none;">
														<select id="city_qus" name="city_qus" onchange="getBlock();" class="select1">
															<option value="">请选择区</option>
														</select>
													</span>
												</div>
												
											</div>
										</div>
	
				                  	<div class="onteytb4">	
										<h2> <b>需要确认</b>：</h2><h2>保额<span id="order_info_price">0</span>万元</h2><h2>保费<span id="order_info_bxd">0</span>元 </h2><h2>运费<span id="totel_yun">0</span>元 </h2><h2>        共计：<span id="totel_z">0</span>元</h2>
									</div>	
									<div class="onteytc5">
										<span> <b>开票类型</b>：</span>
										<span><input name="bill_type" class="vv2" checked="checked" type="radio" value="">无 </span> 
										<span><input name="bill_type" class="vv2" type="radio" value="A">增票  </span>
										<span><input name="bill_type" class="vv2" type="radio" value="B">普票  </span>
										<span><input name="bill_type" class="vv2" type="radio" value="C">其他<b style="display:none;" id="qita"><input id="shPrice" onblur="shuiFun(this);" onkeyup="if(event.keyCode !=37 && event.keyCode != 39){if (!/^[\d]+$/ig.test(this.value)){this.value='';}}" class="kfty7" value=""/>元</b></span>
										<span>税费：<b id="shuiPrice">0</b>元</span>
										<span> 合计：<b id="heji">0</b>元 </span>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<span><input name="is_yuej" type="checkbox" value="Y">月结客户  </span> 
									</div>	
									<div class="onteytc5">
										<span><b>位置短信：</b></span>
										<span><input name="mess_rec_man" id="A1_s" type="checkbox" value=""><b id="xias"></b></span> 
										<span><input name="mess_rec_man" id="A2_s" type="checkbox" value=""><b id="fache"></b></span> 
										<span><input name="mess_rec_man" id="A3_s" type="checkbox" value=""><b id="soche"></b></span> 
									</div>
									<div class="onteytc2  onteytc3">
										<h2>下单备注</h2>
										<textarea id="order_info_remark" ></textarea>
									</div>	
									<div class="sad25">
										<button data-toggle="modal" onclick="upOrderFun();" data-target="#myModa7" class="btn btn-default10" type="button">确认下单</button>
									</div>									
									</div>
								</div>
									<div class="onteytb4 kfty8">
										<h2><strong>需要回电：</strong></h2>
										<h2><span>日期：</span><li class="laydate-icon" id="tr_hui_time" style="width:200px; margin-right:10px;"></li></h2>
									</div>
									<script>
										var start = {
										  elem: '#tr_hui_time',
										  format: 'YYYY/MM/DD hh:mm',
										  min: laydate.now(), //设定最小日期为当前日期
										  max: '2099-06-16 23:59', //最大日期
										  istime: true,
										  istoday: false,
										  choose: function(datas){
											 end.min = datas; //开始日选好后，重置结束日的最小日期
											 end.start = datas //将结束日的初始值设定为开始日
										  }
										};
										laydate(start);
									</script>
									<div class="onteytc2  onteytc3">
										<h2>添加备注</h2>
										<textarea id="tr_bei"></textarea>
									</div>
							</div>	
						</div>				  
					</div>
	        </div>
	    </div>
	    <!-- /widget -->
		</div>
		</div>
		<script>
		//出发地联系人
		function chuFun(){
			var tr_name = $("#fa_name").val();
			var tr_tel = $("#fa_tel").val();//手机号
			if(tr_name!="" && tr_tel!=""){
				$("#A2_s").val(tr_tel);
				$('#fache').html(tr_tel);
			}
			
		}
		//目的地联系人
		function muFun(){
			var tr_name = $("#sh_name").val();
			var tr_tel = $("#sh_tel").val();//手机号
			if(tr_name!="" && tr_tel!=""){
				$("#A3_s").val(tr_tel);
				$('#soche').html(tr_tel);
			}
		}
		//开票其他费用
		function shuiFun(obj){
			var val = $(obj).val();
			if(val=="" || !$.isPositiveNum(val))val=0;
			$("#shuiPrice").html(val);
			totelFun();
		}
		//开票费用
		$(".vv2").click(function(){
			var mark = $('input[name="bill_type"]:checked').val();
			var heji = $('#heji').html();
			if(mark == "A"){
				$("#qita").hide();
				$.post("/Back/Worktwo/getRatePrice",{heji:heji,type:'vat_rate'},function(data){
					$("#shuiPrice").html(data);
					totelFun();
				},'json');
			}else if(mark=='B'){
				$("#qita").hide();
				$.post("/Back/Worktwo/getRatePrice",{heji:heji,type:'tar_rate'},function(data){
					$("#shuiPrice").html(data);
					totelFun();
				},'json');
			}else if(mark == "C"){
				$("#qita").show();
				$("#shPrice").val(0);
				$("#shuiPrice").html(0);
				totelFun();
			}else{
				$("#shuiPrice").html(0);
				$("#qita").hide();
				totelFun();
			}
		});
		//是否送车上门
		$(".vv1").click(function(){
			var mark = $('input[name="smsc"]:checked').val();
			var id = $("#city_qus").val();
			if(mark == 'N'){
				$("#awdf").hide();
			}else{
				$("#awdf").show();
			}
			getBlock();
		});
		//判断是否上门送车
		function getBlock(){
			var id = $("#city_qus").val();
			var order_info_star = $('#order_info_star').val();//起始地
			var city_jie_sheng = $("#pro1").val()//目的地省
			var city_jie_shi = $("#cit1").val()//目的地市
			var car_id = $('#cit2').val();
			var cit_jie_str = city_jie_sheng+','+city_jie_shi; 
			var mark = $('input[name="smsc"]:checked').val();
			//alert(id);return false;
			$.post("/Back/Worktwo/smscFun",{car_id:car_id,id:id,type:mark,cit_jie_str:cit_jie_str,str:order_info_star},function(data){
				if(data.flag){
					$("#totel_yun").html(data.price);
					$('#yunPirce').html(data.price);
					$('#order_smsc_car').val(data.prices);
					totelFun();
				}else{
					$("#totel_yun").html(data.price);
					$('#yunPirce').html(data.price);
					$('#order_smsc_car').val(0);
					totelFun();
				}
			},'json');
		}
		//保费查询
		function baojia(){
			var car_baojia = $("#car_baojia").val();
			if(!$.isPositiveNum(car_baojia))car_baojia=0;
			if(car_baojia == "" || car_baojia == 0){
				$("#baoPirce").html(0);
				$("#order_info_price").html(0);
				$("#order_info_bxd").html(0);
				totelFun();
				$(".kfty9").hide();
				layer.msg("请输入保额");
				return false;
			}
			var flag = $("#flag").val();
		    if(flag == 'N'){
				layer.msg("请先查询运价");
				return false;
			}
			$.post("/Back/Worktwo/getAcale",{car_baojia:car_baojia},function(data){
				$("#baoPirce").html(data);
				$("#order_info_price").html(car_baojia);
				$("#order_info_bxd").html(data);
				totelFun();
			},'json');
		}
		//发送短信
		function sendMobile(obj){
			var car_pin = $('#pro2_name').val(); //车辆品牌
			var car_xing = $('#cit2_name').val();//车型
			var tr_name = $("#chenghu").val();//称呼
			var tr_bao = $("#car_baojia").val();//保价
			var tr_tel = $("#mobile").val();//手机号
			var tr_start = $("#order_info_star").val();//起始点
			var tr_end = $("#order_info_end").val();//结束点
			var tr_carxing = car_pin+'-'+car_xing;
			var tr_yun = $("#totels").html();//总价
			var tr_bei = $("#tr_bei").val();//备注
			var tr_hui_time = $("#tr_hui_time").html();
			var flag = $('#flag').val();
			if(!$.check_Mobile(tr_tel)){
				layer.msg("请输入正确的手机号!");
				return false;
			}
			/*if(tr_name==""){
				layer.msg("请先输入称呼");
				return false;
			}
		          if(flag == 'N'){
				layer.msg("请先查询运价");
				return false;
			} */
			var car_baojia = $("#car_baojia").val();
			if(!$.isPositiveNum(car_baojia))car_baojia=0;
			/* if(car_baojia == "" || car_baojia == 0){
				$("#baoPirce").html(0);
				$("#order_info_price").html(0);
				$("#order_info_bxd").html(0);
				totelFun();
				$(".kfty9").hide();
				layer.msg("请输入保额");
				return false;
			} */
			/* if(tr_yun == 0){
				layer.msg("请先查询保费");
				return false;
			} */
			/*if(tr_bei == ''){
				layer.msg("请输入备注");
				return false;
			} */
			if(window.confirm('确定发送短信？')){
				$.post("/Back/Worktwo/sendMobile",{
					tr_tel:tr_tel,
					tr_name:tr_name,
					tr_start:tr_start,
					tr_end:tr_end,
					tr_carxing:tr_carxing,
					tr_bao:tr_bao,
					tr_yun:tr_yun,
					tr_bei:tr_bei,
					tr_hui_time:tr_hui_time
					},function(data){
						$('#refer_id').val(data.id);
						//$(obj).attr("disabled","disabled");
						layer.msg(data.msg);
				},'json');
             }else{
                return false;
            }
		}
		//下单
		function upOrderFun(){
			var mobile = $("#mobile").val();
			var cheng = $("#chenghu").val();
			var receipt = $('input[name="receipt"]:checked').val();
			if(receipt == undefined)receipt='N';
			var busin_type = $('input[name="busin_type"]:checked').val();
			var is_yuej = $('input[name="is_yuej"]:checked').val();
			if(is_yuej == undefined)is_yuej='N';
			var bill_type = $('input[name="bill_type"]:checked').val();
			if(bill_type != ""){
				if(bill_type == "C"){
					var bill_price = $('#shPrice').val()
				}else{
					var bill_price = $("#shuiPrice").html();
				}
			}else{
				var bill_price = "";
			}
			var refer_id = $("#refer_id").val();
			var mess_rec_mans = $('input[name="mess_rec_man"]');
			var mess_rec_man = '';
			for(var i=0;i<mess_rec_mans.length;i++){
				if(mess_rec_mans.eq(i).prop("checked") == true){
					mess_rec_man += mess_rec_mans.eq(i).val()+';';
				}else{
					mess_rec_man += ';';
				}
			}
			var product_type = $("#product_type").val();
			var car_pin = $('#pro2_name').val(); //车辆品牌
			var car_xing = $('#cit2_name').val();//车型
			var carmark = $('#carmark').val();//车牌
			var order_info_zj = $('#heji').html();
			var order_info_price = $("#car_baojia").val();
			var order_info_c_car = $("#order_info_c_car").val();
			var order_info_t_car = $("#order_info_t_car").val();
			var order_info_s_car = $("#order_info_s_car").val();
			var order_smsc_car = $("#order_smsc_car").val();
			var order_info_margin = $("#order_info_margin").val();
			var order_info_bxd = $("#baoPirce").html();
			var order_info_smsc = $('input[name="smsc"]:checked').val();
			var order_info_star = $("#order_info_star").val();
			var order_info_tclxr = $("#fa_name").val()+","+$("#fa_tel").val()+","+$("#fa_sf").val();
			var order_info_star_address = $("#order_info_star_address").val();
			var order_info_end = $("#order_info_end").val();
			var city_qus = $("#city_qus").val();
			var order_info_sclxr = $("#sh_name").val()+","+$("#sh_tel").val()+","+$("#sh_sf").val();
			var order_info_end_address = $("#order_info_end_address").val();
			if(order_info_smsc == "Y"){
				var order_info_smscd = order_info_end+','+city_qus;
			}else{
				var order_info_smscd = '';
			}
			var order_info_remark = $("#order_info_remark").val();
			var flag = $('#flag').val();
			if(!$.check_Mobile(mobile)){
				layer.msg("请输入正确的手机号!");
				return false;
			}
			if(cheng==""){
				layer.msg("请先输入称呼");
				return false;
			}
			/* if(flag == 'N'){
				layer.msg("请先查询运价");
				return false;
			} */
			var car_baojia = $("#car_baojia").val();
			if(!$.isPositiveNum(car_baojia))car_baojia=0;
			/* if(car_baojia == "" || car_baojia == 0){
				$("#baoPirce").html(0);
				$("#order_info_price").html(0);
				$("#order_info_bxd").html(0);
				totelFun();
				layer.msg("请输入保额");
				return false;
			} */
			/* if(order_info_bxd == 0){
				layer.msg("请先查询保费");
				return false;
			} */
			if(carmark ==""){
				layer.msg('请输入车牌号');
				return false;
			}
			if($("#fa_name").val()=="" || $("#fa_tel").val()=="" || $("#fa_sf").val()==""){
				layer.msg('请填写全出发联系人');
				return false;
			}
			if($("#sh_name").val()=="" || $("#sh_tel").val()=="" || $("#sh_sf").val()==""){
				layer.msg('请填写全收车联系人');
				return false;
			}
			$.post("/Back/Worktwo/setOrder",{
				mobile:mobile,
				receipt:receipt,
				busin_type:busin_type,
				is_yuej:is_yuej,
				bill_type:bill_type,
				bill_price:bill_price,
				mess_rec_man:mess_rec_man,
				product_type:product_type,
				car_pin:car_pin,
				car_xing:car_xing,
				carmark:carmark,
				order_info_zj:order_info_zj,
				order_info_price:order_info_price,
				order_info_c_car:order_info_c_car,
				order_info_t_car:order_info_t_car,
				order_info_s_car:order_info_s_car,
				order_smsc_car:order_smsc_car,
				order_info_bxd:order_info_bxd,
				order_info_smsc:order_info_smsc,
				order_info_star:order_info_star,
				order_info_star_address:order_info_star_address,
				order_info_end:order_info_end,
				order_info_smscd:order_info_smscd,
				order_info_end_address:order_info_end_address,
				order_info_remark:order_info_remark,
				order_info_margin:order_info_margin,
				carmark:carmark,
				order_info_tclxr:order_info_tclxr,
				order_info_sclxr:order_info_sclxr,
				refer_id:refer_id
				},function(data){
					if(data.flag){
						layer.msg("下单成功");
						//跳转详情页
						setTimeout(function(){
   							window.location.href="/Back/Orderyjh/orderList";
   						},2000);
					}else{
						layer.msg(data.msg);
						return false;
					}
			},'json');
		}
		//确认
		function querenFuns(){
			var car_pin = $('#pro2_name').val(); //车辆品牌
			var car_xing = $('#cit2_name').val();//车型
			var car_id = $('#cit2').val();
			
			var city_sheng = $("#pro").val()//出发省
			var city_shi = $("#cit").val()//出发市
			var city_qu = $("#cou").val()//出发区
			var cit_str = city_sheng+','+city_shi+','+city_qu;
			
			var city_jie_sheng = $("#pro1").val()//目的地省
			var city_jie_shi = $("#cit1").val()//目的地市
			var cit_jie_str = city_jie_sheng+','+city_jie_shi;
			
			$("#order_info_star").val(cit_str);
			$("#order_info_end").val(cit_jie_str);
			
			if(car_pin ==""){
				layer.msg('请选择车品牌');
				return false;
			}
			if(car_xing ==""){
				layer.msg('请选择车型');
				return false;
			}
			if(city_qu ==""){
				layer.msg('请选择出发城市');
				return false;
			}
			if(city_jie_shi ==""){
				layer.msg('请选择目的城市');
				return false;
			}
			$.post("/Back/Worktwo/getPrice",{
				car_id:car_id,
				city_shi:cit_str,
				city_jie_shi:cit_jie_str
				},function(data){
					if(data.flag){
						$('#flag').val("Y");
						$('#str_add').html(data.str_add);
						$('#end_add').html(data.end_add);
						$('#product_type').val(data.product_type);
						$("#totel_yun").html(data.totel);
						$('#yunPirce').html(data.totel);
						$("#car_type_brand").html(car_pin+'-'+car_xing);
						$('#order_info_t_car').val(data.ti);
						$('#order_info_s_car').val(data.song);
						$('#order_info_margin').val(data.mao);
						$('#order_info_c_car').val(data.line);
						totelFun();
					}else{
						$('#flag').val("N");
						$('#msgs').val(data.msg);
						layer.msg(data.msg);
						return false;
					}
			},'json');
			
		}
		//查询用户是否下单
		function serchFuns(){
			var mob = $("#mobile").val();
			if(mob !=""){
				if(!$.check_Mobile(mob)){
					layer.msg("请输入正确的手机号!");
					return false;
				}
				$("#wefgwe").html(mob);
				$.post('/Back/Worktwo/getReferOrder',{val:mob},function(data){
					$("#egerer").html(data);
				},'json');
			}else{
				layer.msg('请输入手机号');
				return false;
			}
		}
		function carpFuns(obj){
			var id = $(obj).find("option:selected").attr("data");
			if(id != ''){
				$.post("/Back/Worktwo/getCarXing",{id:id},function(data){
					var sum = data.length;
					var str = '<option data="" value="">请选择车型</option>';
					$("#car_xing").html('');
					for(var i=0;i<sum;i++){
						str += '<option data="'+data[i]['cxjj_id']+'" value="'+data[i]['cxjj_brand']+'">'+data[i]['cxjj_brand']+'</option>';
					}
					$("#car_xing").append(str);
				},'json');
			}else{
				var str = '<option data="" value="">请选择品牌</option>';
				$("#car_xing").html(str);
			}
			
		}
		function cityFun(obj){
			var id = $(obj).val();
			if(id != ''){
				$.post("/Back/Worktwo/getCitys",{id:id},function(data){
					var sum = data.length;
					var str = '<option value="">请选择市</option>';
					$("#city_shi").html('');
					var strqu = '<option value="">请选择区</option>';
					$("#city_qu").html(strqu);
					for(var i=0;i<sum;i++){
						str += '<option value="'+data[i]['area_id']+'">'+data[i]['area_name']+'</option>';
					}
					$("#city_shi").append(str);
				},'json');
			}else{
				var str = '<option value="">请选择省</option>';
				$("#city_shi").html(str);
				var str = '<option value="">请选择市</option>';
				$("#city_qu").html(str);
			}
		}
		function city_quFun(obj){
			var id = $(obj).val();
			if(id != ''){
				$.post("/Back/Worktwo/getCitys",{id:id},function(data){
					var sum = data.length;
					var str = '<option value="">请选择区</option>';
					$("#city_qu").html('');
					for(var i=0;i<sum;i++){
						str += '<option value="'+data[i]['area_id']+'">'+data[i]['area_name']+'</option>';
					}
					$("#city_qu").append(str);
				},'json');
			}else{
				var str = '<option value="">请选择市</option>';
				$("#city_qu").html(str);
			}
		}
		function cityJieFun(obj){
			var id = $(obj).val();
			if(id != ''){
				$.post("/Back/Worktwo/getCitys",{id:id},function(data){
					var sum = data.length;
					var str = '<option value="">请选择市</option>';
					$("#city_jie_shi").html('');
					for(var i=0;i<sum;i++){
						str += '<option value="'+data[i]['area_id']+'">'+data[i]['area_name']+'</option>';
					}
					$("#city_jie_shi").append(str);
				},'json');
			}else{
				var str = '<option value="">请选择省</option>';
				$("#city_jie_shi").html(str);
			}
		}
		
		function city_quFuns(obj){
			var id = $(obj).val();
			if(id != ''){
				$.post("/Back/Worktwo/getCitys",{id:id},function(data){
					var sum = data.length;
					var str = '<option value="">请选择区</option>';
					$("#city_qus").html('');
					for(var i=0;i<sum;i++){
						str += '<option value="'+data[i]['area_id']+'">'+data[i]['area_name']+'</option>';
					}
					$("#city_qus").append(str);
				},'json');
			}else{
				var str = '<option value="">请选择市</option>';
				$("#city_qus").html(str);
			}
		}
		//费用计算公共方法
		function totelFun(){
			var yunPirce = parseInt($("#yunPirce").html());
			var baoPirce = parseInt($("#baoPirce").html());
			var shuiPrice = parseInt($("#shuiPrice").html());
			var totel = yunPirce+baoPirce+shuiPrice;
			$("#totels").html(totel);
			$("#totel_z").html(totel);
			$("#heji").html(totel);
		}
		</script>
	</body>
</html>