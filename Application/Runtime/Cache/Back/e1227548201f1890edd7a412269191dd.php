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
 <script>
                                                	$(document).ready(function(){
                                                		$("#tabnav").find('li[id="<?php echo ($sec); ?>"]').addClass('active').siblings().removeClass();
                                                		$("#provincea").find('option[value="<?php echo ($pval["pid"]); ?>"]').attr('selected',true);
                                                		if('<?php echo ($pval["pid"]); ?>'!=''){
                                                			$.post('/Back/Product/area_act', {provinceid:'<?php echo ($pval["pid"]); ?>'}, function(data) {
                                                				 var _html = "";
				                                                    for (var i = 0; i < data.length; i++) {
				                                                        _html += "<li data1="+data[i]['area_name']+" data2="+data[i]['area_id']+" onclick='changeCity(this)'><h2>"+data[i]['area_name']+"</h2></li>";
				                                                    }
				                                                    $('#s2').append(_html);
                                                	        },'json');
                                                		}
                                                		if('<?php echo ($cval["cid"]); ?>'!=''){
                                                			$.post('/Back/Product/area_act', {provinceid:'<?php echo ($cval["cid"]); ?>'}, function(data) {
                                                				 var _html = "";
				                                                    for (var i = 0; i < data.length; i++) {
				                                                        _html += "<li data1="+data[i]['area_name']+" data2="+data[i]['area_id']+" onclick='changeQu(this)'><h2>"+data[i]['area_name']+"</h2></li>";
				                                                    }
				                                                    $('#s3').append(_html);
                                                	        },'json');
                                                		}
                                                	})
                                                	//获取市

                                                </script>
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
															<dd>
																<input type="text" placeholder="请选择省份" id="provincea" value="<?php echo ($pval); ?>"/>
																<div class="pay2" id="pay1">
																	<ul id ="s1">
																		<?php if(is_array($provincea)): $i = 0; $__LIST__ = $provincea;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><li data1="<?php echo ($vv["area_name"]); ?>" data2="<?php echo ($vv["area_id"]); ?>" onclick='changeShi(this)'><h2><?php echo ($vv["area_name"]); ?></h2></li><?php endforeach; endif; else: echo "" ;endif; ?>
																	
																	</ul>
																</div>
															</dd>
															<dd>
																<input type="text" placeholder="请选择市" id="city" value="<?php echo ($cval); ?>"/>
																<div class="pay2" id="pay2">
																	<ul id ="s2">
																		
																		
																	</ul>
																</div>
															</dd>
															
														</div>
														<input type="hidden" value="<?php echo ($pro); ?>" id="pro"/>
														<input type="hidden" value="<?php echo ($city); ?>" id="cit"/>
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
															    
																 $.post('/Back/Product/get_area_bycon', {name:name,pid:pid}, function(data) {
																	 $('#s2').children().remove();
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
															    
																 $.post('/Back/Product/get_area_bycon', {name:name,pid:pid}, function(data) {
																	 $('#s3').children().remove();
																	 var _html = "";
					                                                    for (var i = 0; i < data.length; i++) {
					                                                        _html += "<li data1="+data[i]['area_name']+" data2="+data[i]['area_id']+" onclick='changeQu(this)'><h2>"+data[i]['area_name']+"</h2></li>";
					                                                    }
					                                                    $('#s3').append(_html);
					                                                },'json');
															
														     })
														</script>
													<!-- <select class="height46" id="provincea" name="">
													<option value="f">请选择省份</option>
													<?php if(empty($pval)): ?><option selected="selected" value="0">请选择省份</option>
														<?php else: ?>
														<option selected="selected" value=""><?php echo ($pval); ?></option><?php endif; ?>
													<?php if(is_array($provincea)): $i = 0; $__LIST__ = $provincea;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vv["area_id"]); ?>"><?php echo ($vv["area_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
													</select>
													<select class="height46" name="" id="city">
														<option value="f">请选择市</option>
														<?php if(empty($cval)): ?><option selected="selected" value="0">请选择市</option>
															<?php else: ?>
															<option selected="selected" value=""><?php echo ($cval); ?></option><?php endif; ?>
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
													<td colspan='2'>集散地B</td>
													<td colspan='2'>送车地</td>
													<td colspan='2'>送车费</td>
													<td rowspan='2'>操作</td>
												</tr>
												<tr class="tr1 height23 bgcolor2">
													<td>省份</td>
													<td>市</td>
													<td>省份</td>
													<td>市</td>
													<td>小板送车</td>
													<td>司机送车</td>
												</tr>
												<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="tr2">
														<td class="td3"><?php echo ($vo["p_s_name"]); ?></td>
														<td><?php echo ($vo["c_s_name"]); ?></td>
														<td class="td3"><?php echo ($vo["p_e_name"]); ?></td>
														<td><?php echo ($vo["c_e_name"]); ?></td>
														<td><?php echo ($vo["song_driver_price"]); ?></td>
														<td><?php echo ($vo["song_platelets_price"]); ?></td>
														<td>
														<a class="see4" data-code="<?php echo ($vo["song_code"]); ?>">删除</a>
														<a data-toggle="modal" data-target="#myModa2" 
														code="<?php echo ($vo["song_code"]); ?>"
															 star="<?php echo ($vo["song_star"]); ?>"
															 end="<?php echo ($vo["song_end"]); ?>"
															 sd-price="<?php echo ($vo["song_driver_price"]); ?>"
															 sp-price="<?php echo ($vo["song_platelets_price"]); ?>"
															 psname="<?php echo ($vo["p_s_name"]); ?>"
															 csname="<?php echo ($vo["c_s_name"]); ?>"
															 pename="<?php echo ($vo["p_e_name"]); ?>"
															 cename="<?php echo ($vo["c_e_name"]); ?>" class="see1">修改</a>
														</td>
													</tr><?php endforeach; endif; else: echo "" ;endif; ?>

											</table>

										</div>
										<div class="l_fenye">
											<div class="sad">
												<button type="button" data-toggle="modal" data-target="#hfvei" class="btn btn-default5">导入</button>
											<a href="/Back/Product/daochu_end/pro/<?php echo ($pro); ?>/city/<?php echo ($city); ?>"><button type="button" class="btn btn-default6">导出</button></a>
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
<!--tanceng-->
<div id="myModa2" style="display:none; z-index:9999" class="tan1">
	<div class="tan11">
		<h2>送车地管理</h2>

		<div class="dw2">
			<dl>
				<dt>
					<select class="dh4" name="sprovince" id="provinceb">
						<option value="">请选择省</option>
						<?php if(is_array($provincea)): $i = 0; $__LIST__ = $provincea;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vv["area_id"]); ?>"><?php echo ($vv["area_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
					<select class="dh4" name="scity" id="citya">
						<option value="">请选择市</option>
					</select>

				</dt>
			</dl>
			<dl>
				<img src="/Public/Back/images/dw1.png"></dl>
			<dl>
				<dt>
					<select class="dh4" name="eprovince" id="provincec">
						<option value="">请选择省</option>
						<?php if(is_array($provincea)): $i = 0; $__LIST__ = $provincea;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vv["area_id"]); ?>"><?php echo ($vv["area_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
					<select class="dh4" name="ecity" id="cityb">
						<option value="">请选择市</option>
					</select>
				</dt>
			</dl>
			<dl>
				<input type="hidden" name="song_code" id="code">
				<input type="text" name="song_driver_price" id="song_driver_price" placeholder="请输入小板送车价格"  class="put2"></dl>
			<dl>
				<input type="text" name="song_platelets_price" id="song_platelets_price" placeholder="请输入司机送车价格"  class="put2"></dl>
		</div>

		<p>
			<input type="submit" id="sub" class="put1" value="确认"></p>
	</div>

</div>
<div id="hfvei" style="display:none; z-index:9999" class="tan1">
<div class="tan11">
<h2>导入数据</h2>
<form action="/Back/Product/daoru_end" method="post" enctype="multipart/form-data">
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
		$('#provinceb option').each(function(index, el) {
            if (0 == $(this).val()) {
                $(this).attr('selected',true);
            }
        });
        $('#provincec option').each(function(index, el) {
            console.log($(this).val());
            if (0 == $(this).val()) {
                $(this).attr('selected',true);
            }
        });
        var city = "<option value='0'>请选择市</option>";
        $('#citya').html(city);
        $('#cityb').html(city);
        $('#song_driver_price').val('');
        $('#song_platelets_price').val('');
        $('#code').val('');
    });
	//提交
	$('#sub').click(function(event) {
		var sprovince = $('#provinceb').val();
		var scity = $('#citya').val();
		var eprovince = $('#provincec').val();
		var ecity = $('#cityb').val();
		var song_driver_price = $('#song_driver_price').val();
		var song_platelets_price = $('#song_platelets_price').val();
		var song_code = $('#code').val();
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
        } else if (song_driver_price == "") {
            $.anewAlert('小板送车价格不能为空！');
            return false;
        } else if (song_platelets_price == "") {
            $.anewAlert('司机送车价格不能为空！');
            return false;
        } else if (isNaN(song_driver_price)||isNaN(song_platelets_price)||song_driver_price<0||song_platelets_price<0){
            $.anewAlert('价格填写错误');
            return false;
        }
		$.post('/Back/Product/endadd', {sprovince:sprovince,scity:scity,eprovince:eprovince,ecity:ecity,song_driver_price:song_driver_price,song_platelets_price:song_platelets_price,song_code:song_code}, function(data) {
			console.log(data);
			if(data['status'] == 'Y'){
                $.anewAlert(data['info']);
                window.location.reload();
            } else {
                $.anewAlert(data['info']);
            }
		});
	});
	//获取市
    $('#provincea').change(function(event) {
        var provinceid = $(this).val();
        $(".delc").remove();
        $.post('/Back/Product/area_act', {provinceid: provinceid}, function(data) {
            var _html = "";
            for (var i = 0; i < data.length; i++) {
                _html += "<option value='"+data[i]['area_id']+"'class='delc'>"+data[i]['area_name']+"</option>"
            }
            $('#city').append(_html);
        },'json');
    });
	//获取添加起始市
    $('#provinceb').change(function(event) {
        var provinceid = $(this).val();
        $.post('/Back/Product/area_act', {provinceid: provinceid}, function(data) {
            var _html = "<option>请选择市</option>";
            for (var i = 0; i < data.length; i++) {
                _html += "<option value="+data[i]['area_id']+">"+data[i]['area_name']+"</option>"
            }
            $('#citya').html(_html);
        },'json');
    });
	//获取添加结束市
    $('#provincec').change(function(event) {
        var provinceid = $(this).val();
        $.post('/Back/Product/area_act', {provinceid: provinceid}, function(data) {
            var _html = "<option>请选择市</option>";
            for (var i = 0; i < data.length; i++) {
                _html += "<option value="+data[i]['area_id']+">"+data[i]['area_name']+"</option>"
            }
            $('#cityb').html(_html);
        },'json');
    });
    //搜索
    $('#btn').click(function(event) {
        var provincea = $('#pro').val();
        if(provincea ==''){
        	provincea = 'f';
        }
        
        var city = $('#cit').val();
        if(city ==''){
        	city = 'f';
        }
        window.location.href="/Back/Product/end/provincea/"+provincea+"/city/"+city;
    });
    //删除    
    $('.see4').click(function(event) {
        var code = $(this).attr('data-code');
        if (confirm('确定删除此信息吗？')) {
            $.post('/Back/Product/enddel', {code: code}, function(data) {
                alert(data);
                window.location.reload();
            },'json');
        }
    })
    //修改
    $('.see1').click(function(event) {
    	var code = $(this).attr('code');
    	var star = $(this).attr('star');
    	var end = $(this).attr('end');
    	var song_driver_price = $(this).attr('sd-price');
    	var song_platelets_price = $(this).attr('sp-price');
    	var p_s_name = $(this).attr('psname');
    	var c_s_name = $(this).attr('csname');
    	var p_e_name = $(this).attr('pename');
    	var c_e_name = $(this).attr('cename');
    	var sp = star.split(',')[0];
    	var sc = star.split(',')[1];
    	var oc = star.split(',')[2];
    	var ep = end.split(',')[0];
    	var ec = end.split(',')[1];
    	$('#provinceb option').each(function(index, el) {    		
    		if (sp == $(this).val()) {
    			$(this).attr('selected',true);
    		}
    	});
        var _htmlt = "<option selected value='"+sc+"'>"+c_s_name+"</option>"
        $('#citya').html(_htmlt);
        $('#provincec option').each(function(index, el) {    		
    		if (ep == $(this).val()) {
    			$(this).attr('selected',true);
    		}
    	});
        var _htmlb = "<option selected value='"+ec+"'>"+c_e_name+"</option>"
        $('#cityb').html(_htmlb);
        $('#song_driver_price').val(song_driver_price);
        $('#song_platelets_price').val(song_platelets_price);
        $('#code').val(code);
    });
</script>

</body>
</html>