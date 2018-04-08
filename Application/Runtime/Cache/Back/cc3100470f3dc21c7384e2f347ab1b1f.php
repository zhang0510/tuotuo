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
<body>
 <script>
                                                	$(document).ready(function(){
                                                		$("#tabnav").find('li[id="<?php echo ($sec); ?>"]').addClass('active').siblings().removeClass();
                                                		$("#provincea").find('option[value="<?php echo ($pval["pid"]); ?>"]').attr('selected',true);
                                                		if('<?php echo ($arry["pid"]); ?>'!=''){
                                                			$.post('/Back/Product/area_act', {provinceid:'<?php echo ($arry["pid"]); ?>'}, function(data) {
                                                				 var _html = "";
				                                                    for (var i = 0; i < data.length; i++) {
				                                                        _html += "<li data1="+data[i]['area_name']+" data2="+data[i]['area_id']+" onclick='changeCity(this)'><h2>"+data[i]['area_name']+"</h2></li>";
				                                                    }
				                                                    $('#s2').append(_html);
                                                	        },'json');
                                                		}
                                                		if('<?php echo ($arry1["pid"]); ?>'!=''){
                                                			$.post('/Back/Product/area_act', {provinceid:'<?php echo ($arry1["pid"]); ?>'}, function(data) {
                                                				 var _html = "";
				                                                    for (var i = 0; i < data.length; i++) {
				                                                        _html += "<li data1="+data[i]['area_name']+" data2="+data[i]['area_id']+" onclick='changeCity1(this)'><h2>"+data[i]['area_name']+"</h2></li>";
				                                                    }
				                                                    $('#s4').append(_html);
                                                	        },'json');
                                                		}
                                                	})
                                                	//获取市

                                                </script>
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
<script src="/Public/JS/jquery.Huploadify.js"></script>
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
						<li id="area">
							<a href="/Back/Product/area">区域管理</a>
						</li>
						<li id="bulk">
							<a href="/Back/Product/bulk/provincea/f/city/f/e_provincea/f/e_city/f">集散地管理</a>
						</li>
						<li id="star">
							<a href="/Back/Product/star/provincea/f/city/f/county/f">出发地管理</a>
						</li>
						<li id="end">
							<a href="/Back/Product/end/provincea/f/city/f">送车地管理</a>
						</li>
						<li id="visitend">
							<a href="/Back/Product/visitend/provincea/f/city/f/county/f">上门送车管理</a>
						</li>
						<li id="product_line">
							<a href="/Back/Product/product_line/provincea/f/city/f/e_provincea/f/e_city/f">直发管理</a>
						</li>
						<li id="maoli">
							<a href="/Back/Product/maoli/provincea/f/provinceb/f">毛利管理</a>
						</li>
						<li id="arctic" class="active">
							<a href="/Back/Product/arctic/brand/f/type/f">车型加价</a>
						</li>
					</ul>

					<div class="tab-content1">
						<div class="tab-content">
							<div class="tab-pane active">
								<form id="edit-profile" class="form-horizontal" />
								<fieldset>
									<div class="l_uit">
										<div class="control-group">

											<div style="float:left;" class="controls clec_t">
												<div class="dropdown">
												 <div class="pay1">
												            <div style="float:left;line-height:45px;padding:0 5px 0 0;">出发地：</div>
															<dd> 
																<input type="text" placeholder="请选择省份" id="provincea" value="<?php echo ($arry["pname"]); ?>"/>
																<div class="pay2" id="pay1">
																	<ul id ="s1">
																		<?php if(is_array($provincea)): $i = 0; $__LIST__ = $provincea;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><li data1="<?php echo ($vv["area_name"]); ?>" data2="<?php echo ($vv["area_id"]); ?>" onclick='changeShi(this)'><h2><?php echo ($vv["area_name"]); ?></h2></li><?php endforeach; endif; else: echo "" ;endif; ?>
																	
																	</ul>
																</div>
															</dd>
															<dd>
																<input type="text" placeholder="请选择市" id="city" value="<?php echo ($arry["cname"]); ?>"/>
																<div class="pay2" id="pay2">
																	<ul id ="s2">
																		
																		
																	</ul>
																</div>
															</dd>
															<div style="float:left;line-height:45px;padding:0 5px 0 0;">目的地：</div>
															<dd>
																<input type="text" placeholder="请选择省份" id="provincea1" value="<?php echo ($arry1["pname"]); ?>"/>
																<div class="pay2" id="pay1">
																	<ul id ="s3">
																		<?php if(is_array($provincea)): $i = 0; $__LIST__ = $provincea;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><li data1="<?php echo ($vv["area_name"]); ?>" data2="<?php echo ($vv["area_id"]); ?>" onclick='changeShi1(this)'><h2><?php echo ($vv["area_name"]); ?></h2></li><?php endforeach; endif; else: echo "" ;endif; ?>
																	
																	</ul>
																</div>
															</dd>
															<dd>
																<input type="text" placeholder="请选择市" id="city1" value="<?php echo ($arry1["cname"]); ?>"/>
																<div class="pay2" id="pay2">
																	<ul id ="s4">
																		
																		
																	</ul>
																</div>
															</dd>
														</div>
														<input type="hidden" value="<?php echo ($arry["pid"]); ?>" id="pro"/>
														<input type="hidden" value="<?php echo ($citya); ?>" id="cit"/>
														
														<input type="hidden" value="<?php echo ($arry1["pid"]); ?>" id="pro1"/>
														<input type="hidden" value="<?php echo ($citya1); ?>" id="cit1"/>
														<script>
															$('.pay1 dd').click(function(){
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
				                                              
				                                                
																$('#city').append().val(city_name);
																$('#cit').val($(obj).attr('data2'));
																$('#county').val('');
																$('#cou').val('');
															}
														
														
															$('#provincea').bind('input propertychange', function() { 
															    //搜索省份
															     var name =$('#provincea').val();
															     
																 $.post('/Back/Product/get_area_bycon', {name:name,pid:1}, function(data) {
																	 $('#s1').children().remove();
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
															     $("#cit").val("");
																 $.post('/Back/Product/get_area_bycon', {name:name,pid:pid}, function(data) {
																	    $('#s2').children().remove();
																	    var _html = "";
					                                                    for (var i = 0; i < data.length; i++) {
					                                                        _html += "<li data1="+data[i]['area_name']+" data2="+data[i]['area_id']+" onclick='changeCity(this)'><h2>"+data[i]['area_name']+"</h2></li>";
					                                                    }
					                                                    $('#s2').append(_html);
					                                                },'json');
															
														     })
														   
														     function changeShi1(obj){
																
																var provinceid = $(obj).attr('data2');
				                                                $("#s4").children().remove();
				                                                $.post('/Back/Product/area_act', {provinceid: provinceid}, function(data) {
				                                                    var _html = "";
				                                                    for (var i = 0; i < data.length; i++) {
				                                                        _html += "<li data1="+data[i]['area_name']+" data2="+data[i]['area_id']+" onclick='changeCity1(this)'><h2>"+data[i]['area_name']+"</h2></li>";
				                                                    }
				                                                    $('#s4').append(_html);
				                                                },'json');
				                                                
																$('#provincea1').append().val(''+$(obj).attr('data1')+'');
																$('#pro1').val($(obj).attr('data2'));
																$('#city1').val('');
																$('#cit1').val('');
															};
														
															function changeCity1(obj){
                                                                var city = $(obj).attr('data2');
				                                                var city_name =$(obj).attr('data1');
				                                               
				                                                
																$('#city1').append().val(city_name);
																$('#cit1').val($(obj).attr('data2'));
																$('#county1').val('');
																$('#cou1').val('');
															}
														
															
															$('#provincea1').bind('input propertychange', function() { 
															    //搜索省份
															     var name =$('#provincea1').val();
															     
																 $.post('/Back/Product/get_area_bycon', {name:name,pid:1}, function(data) {
																	 $('#s3').children().remove();
																	    var _html = "";
					                                                    for (var i = 0; i < data.length; i++) {
					                                                        _html += "<li data1="+data[i]['area_name']+" data2="+data[i]['area_id']+" onclick='changeShi1(this)'><h2>"+data[i]['area_name']+"</h2></li>";
					                                                    }
					                                                    $('#s3').append(_html);
					                                                },'json');
															
														     })
														     $('#city1').bind('input propertychange', function() { 
															    //搜索省份
															     var name =$('#city1').val();
															     var pid =$('#pro1').val();
															     $("#cit1").val("");
																 $.post('/Back/Product/get_area_bycon', {name:name,pid:pid}, function(data) {
																	    $('#s4').children().remove();
																	    var _html = "";
					                                                    for (var i = 0; i < data.length; i++) {
					                                                        _html += "<li data1="+data[i]['area_name']+" data2="+data[i]['area_id']+" onclick='changeCity1(this)'><h2>"+data[i]['area_name']+"</h2></li>";
					                                                    }
					                                                    $('#s4').append(_html);
					                                                },'json');
															
														     })
														</script>
												<!-- 
													<select class="height46" name="" id="huodong">
														<option value="">请选择分类</option>
														<option value="P">普通活动</option>
														<option value="Y">优惠活动</option>
														<option value="T">团购活动</option>
													</select>
													<select class="height46" name="" id="provincea">
														<option value="f">请选择省份</option>
                                                        <?php if(empty($arry["pid"])): ?><option selected="selected" value="">请选择省份</option>
                                                            <?php else: ?>
                                                            <option selected="selected" value="<?php echo ($arry["pid"]); ?>"><?php echo ($arry["pname"]); ?></option><?php endif; ?>
														<?php if(is_array($provincea)): $i = 0; $__LIST__ = $provincea;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vv["area_id"]); ?>"><?php echo ($vv["area_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
													</select>
													<select class="height46" name="" id="city">
														<option value="f">请选择市</option>
                                                        <?php if(empty($arry["cid"])): ?><option selected="selected" value="">请选择市</option>
                                                            <?php else: ?>
                                                            <option selected="selected" value="<?php echo ($arry["cid"]); ?>"><?php echo ($arry["cname"]); ?></option><?php endif; ?>
													</select>
													<select class="height46" name="" id="county">
														<option value="f">请选择区</option>
                                                        <?php if(empty($arry["coid"])): ?><option selected="selected" value="">请选择区</option>
                                                            <?php else: ?>
                                                            <option selected="selected" value="<?php echo ($arry["coid"]); ?>"><?php echo ($arry["coname"]); ?></option><?php endif; ?>
													</select> -->
												</div>

												<div class="v_pb">
													<button id="btn" class="btn btn-default5" type="button">搜索</button>
												</div>

											</div>
											<!-- /controls -->
											<button data-toggle="modal" data-target="#myModa2" class="red btn btn-default5 fr" id="add" type="button">添加</button>

										</div>
										<script>
											$(function(){
												$('table tr.tr2:odd').css('background','#F0F0F0');
											});

										</script>
										<div class="l_table">
											<table>
												<tr class="tr1 height23 bgcolor1">
													<td colspan='2'>起始地</td>
													<td colspan='2'>目的地</td>
													<td rowspan='2'>价格</td>
													<td rowspan='2'>操作</td>
												</tr>
												<tr class="tr1 height23 bgcolor2">
													<td>省份</td>
													<td>市</td>
													<td>省份</td>
													<td>市</td>
												</tr>
												<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="tr2">
														<!-- <?php switch($vo["line_status"]): case "T": ?><td class="td3">团购路线</td><?php break;?>
														<?php case "Y": ?><td class="td3">优惠路线</td><?php break;?>
														<?php default: ?><td class="td3">普通路线</td><?php endswitch;?> -->
														<!-- <td class="td3"><?php echo ($vo["line_name"]); ?></td> -->
														<td class="td3"><?php echo ($vo["p_s_name"]); ?></td>
														<td><?php echo ($vo["c_s_name"]); ?></td>
														<!-- <td><?php echo ($vo["co_s_name"]); ?></td> -->
														<td class="td3"><?php echo ($vo["p_e_name"]); ?></td>
														<td><?php echo ($vo["c_e_name"]); ?></td>
														<td><?php echo ($vo['line_price']/100); ?></td>
														<!-- <td><?php echo ($vo['line_price_ban']/100); ?></td> -->
														<td>
															<a data-code="<?php echo ($vo["line_code"]); ?>" class="see4">删除</a>
															<a data-toggle="modal" data-target="#myModa3"
															 code="<?php echo ($vo["line_code"]); ?>"
															 star="<?php echo ($vo["line_star"]); ?>"
															 end="<?php echo ($vo["line_end"]); ?>"
															 price="<?php echo ($vo['line_price']/100); ?>"
															 psname="<?php echo ($vo["p_s_name"]); ?>"
															 csname="<?php echo ($vo["c_s_name"]); ?>"
															 pename="<?php echo ($vo["p_e_name"]); ?>"
															 cename="<?php echo ($vo["c_e_name"]); ?>"
															 class="see1">修改</a>
														</td>
													</tr><?php endforeach; endif; else: echo "" ;endif; ?>

											</table>

										</div>
										<div class="l_fenye">
											<div class="sad">
												<button type="button" data-toggle="modal" data-target="#hfvei" class="btn btn-default5">导入</button>
												<a href="/Back/Product/daochu_line/pro/<?php echo ($province); ?>/city/<?php echo ($citya); ?>/e_pro/<?php echo ($e_province); ?>/e_city/<?php echo ($e_citya); ?>"><button type="button" class="btn btn-default6">导出</button></a>
											</div>
											<?php echo ($page); ?>
										</div>
									</div>
								</fieldset>
							</form>
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
<!--tanceng -->
<!--选择-->
  <div class="bg" id="bg" style="display:none;"></div>
<div style="display:none; z-index:9999" id="tan2" class="tan1">
	<div class="tan11">
	<a class="closed">X</a>
		<h2>请选择线路类型</h2>
		<div class="dw3">
			<!--<dl>
				<dt>
					<label>
						<input type="radio" name="type" value="P">
						<span>普通线路</span>
					</label>
				</dt>
			</dl>-->
			<dl>
				<dt>
					<label>
						<input type="radio" name="type" value="Y">
						<span>优惠线路</span>
					</label>
				</dt>
			</dl>
			<!--<dl>
				<dt>
					<label>
						<input type="radio" name="type" value="T">
						<span>团购线路</span>
					</label>
				</dt>
			</dl>-->

		</div>

		<p>
			<input data-toggle="modal" id="sub" data-target="#myModa3" type="submit" class="put1" value="确认">
			<input type="submit" class="put1 bu" value="取消"></p>
	</div>
</div>
<!--普通-->
<div style="display:none; z-index:9999" id="tan1" class="tan1">
   <div class="tan11">
   <a class="closed">X</a>
		<!-- <form action="/Back/Product/lineadd" method="post"> -->
    <h2>直发线路</h2>

	<div class="dw2">
	<!-- <dl>
		产品名称：<input type="text" placeholder="请输入标题" id="line_name">
	</dl> -->
	<dl><dt><select class="dh5" name="sprovince" id="provinceb">
		<option value="0">请选择省</option>
		<?php if(is_array($provincea)): $i = 0; $__LIST__ = $provincea;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vv["area_id"]); ?>"><?php echo ($vv["area_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		</select>
		<select class="dh5" name="scity" id="cityb">
		<option value="0">请选择市</option>
		</select>
		<!-- <select class="dh6" name="scounty" id="countyb">
		<option value="0">请选择区</option>
		</select> -->

		</dt>
		</dl>
	<dl><img src="/Public/Back/images/dw1.png"></dl>
	<dl><dt><select class="dh5" name="eprovince" id="provincec">
		<option value="0">请选择省</option>
		<?php if(is_array($provincea)): $i = 0; $__LIST__ = $provincea;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vv["area_id"]); ?>"><?php echo ($vv["area_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		</select>
		<select class="dh5" name="ecity" id="cityc">
		<option value="0">请选择市</option>
		</select>
		</dt>
		</dl>
		<input type="hidden" id="type" name="line_status">
		<input type="hidden" id="price" name="price">
		<input type="hidden" id="code" name="code">
		<!-- <dl>
		<b id="scfile">点击上传缩略图</b>
		<input type="hidden" id="qrcode" name="line_img" value="">
		<div id="upload" style="display:none;"></div>
		<button  id="oneclick" style="margin-right:-12px;" class="btn btn-default5" type="button">上传</button>
		</dl> -->
		<dl>
			<input type="text" id="discount" name="line_discount" placeholder="请输入金额（元）" class="kk3">
		</dl>
	</div>
     <p><input type="submit" id="subm" class="put1" value="确认">      <input type="submit" class="put1 bu" value="取消"></p>
     <!-- </form> -->
   </div>

</div>
<div id="hfvei" style="display:none; z-index:9999" class="tan1">
<div class="tan11">
<a class="closed">X</a>
<h2>导入数据</h2>
<form action="/Back/Product/daoru_line" method="post" enctype="multipart/form-data">
<div class="dw4">
	<input type="file" name="csvFile">
</div>
<span>注：导入操作会删除原有数据</span>
<p>
    <input type="submit" class="put1" value="确认"></p>
</form></div>
</div>
<script>
	//添加
	$('#add').click(function(event) {
		$(".dw3").find('input').each(function(index, el) {
    		$(this).attr('checked',false);

    	});
    	$('#provinceb option').each(function(index, el) {
    		console.log($(this).val());
    		if (0 == $(this).val()) {
    			$(this).attr('selected',true);
    		}
    	});
    	var city = "<option value='0'>请选择市</option>";
    	var county = "<option value='0'>请选择区</option>";
    	$('#cityb').html(city);
    	$('#countyb').html(county);
    	$('#provincec option').each(function(index, el) {
    		if (0 == $(this).val()) {
    			$(this).attr('selected',true);
    		}
    	});
    	$('#cityc').html(city);
    	$('#discount').val('');
    	$('#line_name').val('');
    	$('#qrcode').val('');
    	$('#code').val('');
    	$('#scfile').html('点击上传缩略图');
		$('#bg').show();
		$('#tan1').show();
	});
	//取消
	$('.bu').click(function(event) {
		$('#bg').hide();
		$('#tan1').hide();
		$('#tan2').hide();
	});
	//提交
	$('#subm').click(function(event) {
		var sprovince = $('#provinceb').val();
		var scity = $('#cityb').val();
		//var scounty = $('#countyb').val();
		var eprovince = $('#provincec').val();
		var ecity = $('#cityc').val();
		//var line_status = $('#type').val();
		var line_discount = $('#discount').val();
		//var price = $('#price').val();
		var code = $('#code').val();
		//var line_img = $('#qrcode').val();
		//var line_name = $('#line_name').val();
		/* if (line_name == '') {
			$.anewAlert('线路名称不能为空！');
            return false;
		} else  
			else if (scounty == "") {
	            $.anewAlert('起始区不能为空！');
	            return false;
	        } 
			else if (line_img == "") {
	            $.anewAlert('缩略图不能为空！');
	            return false;
	        }
			*/
		if (sprovince == '') {
			$.anewAlert('起始省不能为空！');
            return false;
		} else if (scity == "") {
            $.anewAlert('起始市不能为空！');
            return false;
        } else if (eprovince == "") {
            $.anewAlert('结束省不能为空！');
            return false;
        } else if (ecity == "") {
            $.anewAlert('结束市不能为空！');
            return false;
        } 
		$.post('/Back/Product/lineadd', {sprovince:sprovince,scity:scity,eprovince:eprovince,ecity:ecity,code:code,line_discount:line_discount}, function(data) {
			if(data['status'] == 'Y'){
                $.anewAlert(data['info']);
                window.location.reload();
            } else {
                $.anewAlert(data['info']);
            }
		});
	});
	//运行加载
	var pid = "<?php echo ($arry["pid"]); ?>";
	var pname = "<?php echo ($arry["pname"]); ?>";
	var cid = "<?php echo ($arry["cid"]); ?>";
	var cname = "<?php echo ($arry["cname"]); ?>";
	var coid = "<?php echo ($arry["coid"]); ?>";
	var coname = "<?php echo ($arry["coname"]); ?>";
	var huodong1 = "<?php echo ($arry["huodong"]); ?>";
	$('#huodong option').each(function(index, el) {
		if ($(this).val() == huodong1) {
			$(this).attr('selected',true);
		};
	});
	//获取市
    $('#provincea').change(function(event) {
        // alert($(this).val());
        $(".delc").remove();
        var provinceid = $(this).val();
        $.post('/Back/Product/area_act', {provinceid: provinceid}, function(data) {
            var _html = "";
            for (var i = 0; i < data.length; i++) {
                _html += "<option value='"+data[i]['area_id']+"' class='delc'>"+data[i]['area_name']+"</option>"
            }
            $('#city').append(_html);
        },'json');
    });
    //获取区县
    $('#city').change(function(event) {
    	$(".delb").remove();
        var city = $(this).val();
        //alert(city);
        $.post('/Back/Product/area_act', {provinceid: city}, function(data) {
            var _html = "";
            for (var i = 0; i < data.length; i++) {
                _html += "<option value='"+data[i]['area_id']+"'class='delb'>"+data[i]['area_name']+"</option>"
            }
            $('#county').append(_html);
        },'json');
    });
	//获取开始市
    $('#provinceb').change(function(event) {
        // alert($(this).val());
        var provinceid = $(this).val();
        $.post('/Back/Product/area_act', {provinceid: provinceid}, function(data) {
            var _html = "<option>请选择市</option>";
            for (var i = 0; i < data.length; i++) {
                _html += "<option value="+data[i]['area_id']+">"+data[i]['area_name']+"</option>"
            }
            $('#cityb').html(_html);
        },'json');
    });
    //获取开始区县
    $('#cityb').change(function(event) {
        var city = $(this).val();
        $.post('/Back/Product/area_act', {provinceid: city}, function(data) {
            var _html = "<option>请选择区</option>";
            for (var i = 0; i < data.length; i++) {
                _html += "<option value="+data[i]['area_id']+">"+data[i]['area_name']+"</option>"
            }
            $('#countyb').html(_html);
        },'json');
    });
	//获取结束市
    $('#provincec').change(function(event) {
        // alert($(this).val());
        var provinceid = $(this).val();
        $.post('/Back/Product/area_act', {provinceid: provinceid}, function(data) {
            var _html = "<option>请选择市</option>";
            for (var i = 0; i < data.length; i++) {
                _html += "<option value="+data[i]['area_id']+">"+data[i]['area_name']+"</option>"
            }
            $('#cityc').html(_html);
        },'json');
    });
    //搜索
    $('#btn').click(function(event) {
    	//var huodong = $('#huodong').val();
        var provincea = $('#pro').val();
        var city = $('#cit').val();
        var e_provincea = $('#pro1').val();
        var e_city = $('#cit1').val();
        //var county = $('#county').val();
        if(provincea ==''){
        	provincea ='f';
        }
        if(city ==''){
        	city ='f';
        }
        
        if(e_provincea ==''){
        	e_provincea ='f';
        }
        if(e_city ==''){
        	e_city ='f';
        }
        window.location.href="/Back/Product/product_line/provincea/"+provincea+"/city/"+city+"/e_provincea/"+e_provincea+"/e_city/"+e_city;
    });
    //删除
    $('.see4').click(function(event) {
        var code = $(this).attr('data-code');
        if (confirm('确定删除此信息吗？')) {
            $.post('/Back/Product/linedel', {code: code}, function(data) {
                alert(data);
                window.location.reload();
            },'json');
        }
    })
    //提交取消
    $('#sub').click(function(event) {
    	$('#tan2').hide();
    	$('#tan1').show();
    	var type = "";
    	$(".dw3").find('input').each(function(index, el) {
    		if ($(this).attr('checked') == 'checked' ) {
    			type = $(this).val();
    		}
    	});
    	console.log(type);
        if (type == 'P') {
        	$('#discount').css({
        		display: 'none',
        	});
        } else if(type == 'Y'){
        	$('#discount').css({
        		display: 'block',
        	});
        }else{
        	$('#discount').css({
        		display: 'none',
        	});
        }
    	$('#type').val(type)
    	$('#myModa2').css({
    		display: 'none',
    	});
    });
    //修改
    $('.see1').click(function(event) {
    	$('#bg').show();
		$('#tan1').show();
    	var code = $(this).attr('code');
    	var img = $(this).attr('img');
    	var name = $(this).attr('name');
    	var discount = $(this).attr('discount');
    	var status = $(this).attr('status');
    	var star = $(this).attr('star');
    	var end = $(this).attr('end');
    	var price = $(this).attr('price');
    	 $('#discount').val(price);
    	var p_s_name = $(this).attr('psname');
    	var c_s_name = $(this).attr('csname');
    	var co_s_name = $(this).attr('cosname');
    	var p_e_name = $(this).attr('pename');
    	var c_e_name = $(this).attr('cename');
    	var sp = star.split(',')[0];
    	var sc = star.split(',')[1];
    	var oc = star.split(',')[2];
    	var ep = end.split(',')[0];
    	var ec = end.split(',')[1];
    	$('#line_name').val(name);
    	if (img != '') {
    		$('#qrcode').val(img);
    		$('#scfile').html('缩略图已经存在');
    	}
    	$('#provinceb option').each(function(index, el) {
    		if (sp == $(this).val()) {
    			$(this).attr('selected',true);
    		}
    	});
        var _htmlt = "<option selected value='"+sc+"'>"+c_s_name+"</option>";
        $('#cityb').html(_htmlt);
        var _htmlc = "<option selected value='"+oc+"'>"+co_s_name+"</option>";
        $('#countyb').html(_htmlc);
        $('#provincec option').each(function(index, el) {
    		if (ep == $(this).val()) {
    			$(this).attr('selected',true);
    		}
    	});
        var _htmlb = "<option selected value='"+ec+"'>"+c_e_name+"</option>";
        $('#cityc').html(_htmlb);
        console.log(price);
        $('#price').val(price);
        $('#code').val(code);
        $('#type').val(status);
        if (status == 'P') {
        	$('#discount').css({
        		display: 'none',
        	});
        } else {
        	$('#discount').css({
        		display: 'block',
        	});
        }
    });
    $(function(){
        var up = $('#upload').Huploadify({
			auto:true,
			fileTypeExts:'*.jpg;*.gif;*.png;*.jpeg',
			multi:false,
			fileSizeLimit:1024,
			showUploadedPercent:false,
			showUploadedSize:false,
			removeTimeout:1000,
			abs:1,
			uploader:'<?php echo U("Base/upload");?>',
			canshu:"SLT",
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
					$('#scfile').html('上传成功');
				}else{
					$.anewAlert(datas.msg);
				}
			},
		});
        $("#oneclick").click(function(){
            $("#file_upload_1-button").click();
        });
    });
    $('.closed').click(function(){

    	$('.modal-backdrop').click();
    	$('.tan1,.bg').hide();
    });
</script>
</body>
</html>