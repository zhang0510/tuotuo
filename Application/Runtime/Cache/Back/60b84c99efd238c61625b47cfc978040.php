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
		$("#brandb").find('option[value="<?php echo ($brands); ?>"]').attr('selected',true);
		if('<?php echo ($type); ?>'!=''){
			$.post('/Back/Product/car_act', {brand:'<?php echo ($brands); ?>'}, function(data) {
	            var _html = "";
	            for (var i = 0; i < data.length; i++) {
	            	if('<?php echo ($type); ?>'==data[i]['cxjj_id']){
	            		_html += "<option value='"+data[i]['cxjj_id']+"' selected='selected' class='delc'>"+data[i]['cxjj_brand']+"</option>"
	            	}
	            	_html += "<option value='"+data[i]['cxjj_id']+"' class='delc'>"+data[i]['cxjj_brand']+"</option>"
	            }
	            $('#type').append(_html);
	        },'json');
		}
		/* if('<?php echo ($coval["cid"]); ?>'!=''){
			$.post('/Back/Product/area_act', {provinceid:'<?php echo ($cval["cid"]); ?>'}, function(data) {
	            var _html = "";
	            for (var i = 0; i < data.length; i++) {
	            	if('<?php echo ($coval["cid"]); ?>'==data[i]['area_id']){
	            		_html += "<option value="+data[i]['area_id']+" selected='selected' class='delb'>"+data[i]['area_name']+"</option>"
	            	}
	                _html += "<option value="+data[i]['area_id']+">"+data[i]['area_name']+"</option>"
	            }
	            $('#county').append(_html);
	        },'json');
		}*/
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
								<!-- <form id="edit-profile" class="form-horizontal" /> -->
								<fieldset>
									<div class="l_uit">
										<div class="control-group">

											<div style="float:left;" class="controls clec_t">
												<div class="dropdown">
												    <div class="pay1">
															<dd>
																<input type="text" placeholder="请选择品牌" id="provincea" value="<?php echo ($pval["area_name"]); ?>"/>
																<div class="pay2" id="pay1">
																	<ul id ="s1">
																	    <?php if(is_array($brand)): $i = 0; $__LIST__ = $brand;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li data1="<?php echo ($vo["cxjj_brand"]); ?>" data2="<?php echo ($vo["cxjj_id"]); ?>" onclick='changeShi(this)'><h2><?php echo ($vo["cxjj_brand"]); ?></h2></li><?php endforeach; endif; else: echo "" ;endif; ?>
																	</ul>
																</div>
															</dd>
															<dd>
																<input type="text" placeholder="请选择车型" id="city" value="<?php echo ($cval["area_name"]); ?>"/>
																<div class="pay2" id="pay2">
																	<ul id ="s2">
																		
																		
																	</ul>
																</div>
															</dd>
															
														</div>
														<input type="hidden" value="" id="pro"/>
														<input type="hidden" value="" id="cit"/>
														<script>
															$('.pay1 dd').click(function(){
																$(this).find('.pay2').slideToggle(1000).parent().siblings().find('.pay2').hide();
															});
															
															function changeShi(obj){
																
																var provinceid = $(obj).attr('data2');
				                                                $("#s2").children().remove();
				                                                $.post('/Back/Product/car_act', {brand: provinceid}, function(data) {
				                                                    var _html = "";
				                                                    for (var i = 0; i < data.length; i++) {
				                                                        _html += "<li data1='"+data[i]['cxjj_brand']+"' data2="+data[i]['cxjj_id']+" onclick='changeCity(this)'><h2>"+data[i]['cxjj_brand']+"</h2></li>";
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
								
															}
														
															$('#provincea').bind('input propertychange', function() { 
															    //搜索省份
															     var name =$('#provincea').val();
															     $('#s1').children().remove();
																 $.post('/Back/Product/by_getCarx', {name:name,pid:0}, function(data) {
					                                                    var _html = "";
					                                                    for (var i = 0; i < data.length; i++) {
					                                                        _html += "<li data1='"+data[i]['cxjj_brand']+"' data2="+data[i]['cxjj_id']+" onclick='changeShi(this)'><h2>"+data[i]['cxjj_brand']+"</h2></li>";
					                                                    }
					                                                    $('#s1').append(_html);
					                                                },'json');
															
														     })
														     $('#city').bind('input propertychange', function() { 
															    //搜索省份
															     var name =$('#city').val();
															     var pid =$('#pro').val();
															     $('#s2').children().remove();
																 $.post('/Back/Product/by_getCarx', {name:name,pid:pid}, function(data) {
					                                                    var _html = "";
					                                                    for (var i = 0; i < data.length; i++) {
					                                                        _html += "<li data1='"+data[i]['cxjj_brand']+"' data2="+data[i]['cxjj_id']+" onclick='changeCity(this)'><h2>"+data[i]['cxjj_brand']+"</h2></li>";
					                                                    }
					                                                    $('#s2').append(_html);
					                                                },'json');
															
														     })
														  
														</script>
													<!-- <select class="height46" name="" id="brandb">
														<option value="f">请选择品牌</option>
														<?php if(is_array($brand)): $i = 0; $__LIST__ = $brand;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["cxjj_id"]); ?>"><?php echo ($vo["cxjj_brand"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
													</select>
													<select class="height46" name="" id="type">
														<option value="f">请选择车型</option>
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
												<tr class="tr1">
													<td>品牌</td>
													<td>车型</td>
													<td>整备质量</td>
													<td>所属类别</td>
													<td>操作</td>

												</tr>
												<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="tr2">
													<td class="td3"><?php echo ($vo["branda"]); ?></td>
													<td><?php echo ($vo["cxjj_brand"]); ?></td>
													<td><?php echo ($vo["cxjj_quality"]); ?></td>
													<td>
													<?php if($vo['cxjj_category'] == 'ml_price_one'): ?>1类车毛利
													<?php elseif($vo['cxjj_category'] == 'ml_price_two'): ?>
													2类车毛利
													<?php elseif($vo['cxjj_category'] == 'ml_price_three'): ?>
													3类车毛利
													<?php elseif($vo['cxjj_category'] == 'ml_price_four'): ?>
													4类车毛利
													<?php elseif($vo['cxjj_category'] == 'ml_price_five'): ?>
													5类车毛利<?php endif; ?>
													</td>
													<td>
														<a class="see4" data-code="<?php echo ($vo["cxjj_id"]); ?>">删除</a>
															<a data-toggle="modal" data-target="#myModa2"
															code="<?php echo ($vo["cxjj_code"]); ?>"
															 bid="<?php echo ($vo["cxjj_id"]); ?>"
															 branda="<?php echo ($vo["branda"]); ?>"
															 brand="<?php echo ($vo["cxjj_brand"]); ?>"
															 pid="<?php echo ($vo["cxjj_pid"]); ?>"
															 cxjj_types="<?php echo ($vo["cxjj_types"]); ?>"
															 cxjj_quality="<?php echo ($vo["cxjj_quality"]); ?>"
															 cxjj_category="<?php echo ($vo["cxjj_category"]); ?>"
															 class="see1">修改</a>
													</td>
												</tr><?php endforeach; endif; else: echo "" ;endif; ?>

											</table>

										</div>
										<div class="l_fenye">
											<div class="sad">
												<button type="button" data-toggle="modal" data-target="#hfvei" class="btn btn-default5">导入</button>
												<a href="/Back/Product/daochu_carXing/b/<?php echo ($brands); ?>/t/<?php echo ($type); ?>"><button type="button" class="btn btn-default6">导出</button></a>
											</div>
											<?php echo ($page); ?>
										</div>
									</div>
								</fieldset>
							<!-- </form> -->
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
<!--弹层-->
<div id="myModa2" style="display:none; z-index:9999" class="tan1">
	<div class="tan11">
	<!-- <form action="/Back/Product/arcticadd" method="post"> -->
		<h2>车型加价</h2>
		<div class="dw5">
			<dl>
				<dt>
					<select class="dh5" name="branda" id="branda">
						<option value="0">请选择品牌</option>
						<?php if(is_array($brand)): $i = 0; $__LIST__ = $brand;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["cxjj_id"]); ?>"><?php echo ($vo["cxjj_brand"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
					<select class="dh5" name="brand" id="brand">
						<option value="">请选择车型</option>
					</select>

				</dt>
			</dl>
			<dl>
				<img src="/Public/Back/images/dw1.png"></dl>
			<dl>
				<input type="hidden" id="code" value="">
				<input type="text" name="cxjj_types" id="cxjj_types" placeholder="类型" class="kk3"></dl>
			<dl><input type="text" name="cxjj_quality" id="cxjj_quality" placeholder="整备质量" class="kk3"></dl>
			<dl>
			        <select class="dh5" name="cxjj_category" id="cxjj_category">
						<option value="">请选择类别</option>
						<option value="ml_price_one">1类车毛利</option>
						<option value="ml_price_two">2类车毛利</option>
						<option value="ml_price_three">3类车毛利</option>
						<option value="ml_price_four">4类车毛利</option>
						<option value="ml_price_five">5类车毛利</option>
					</select>
			</dl>
			
			
		</div>
		<p>
			<input type="submit" id="sub" class="put1" value="确认"></p>
		<!-- </form> -->
	</div>

</div>
<div id="hfvei" style="display:none; z-index:9999" class="tan1">
<div class="tan11">
<h2>导入数据</h2>
<form action="/Back/Product/daoru_carXing" method="post" enctype="multipart/form-data">
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
		$('#branda option').each(function(index, el) {
            if (0 == $(this).val()) {
                $(this).attr('selected',true);
            }
        });
        var city = "<option value='0'>请选择车型</option>";
        $('#brand').html(city);
        $('#price').val('');
    });
	//提交
	$('#sub').click(function(event) {
		var branda = $('#branda').val();
		var brand = $('#brand').val();
		var cxjj_types = $('#cxjj_types').val();
		var cxjj_quality = $('#cxjj_quality').val();
		var cxjj_category = $('#cxjj_category').val();
		
		if (branda == '') {
			$.anewAlert('品牌不能为空！');
            return false;
		} else if (brand == "") {
            $.anewAlert('车型不能为空！');
            return false;
        } else if (cxjj_category == "") {
            $.anewAlert('类别不能为空！');
            return false;
        } /* else if (!$.isPositiveNum(price)) {
            $.anewAlert('价格填写错误');
            return false;
        } */
		$.post('/Back/Product/arcticadd', {branda:branda,brand:brand,cxjj_types:cxjj_types,cxjj_quality:cxjj_quality,cxjj_category:cxjj_category}, function(data) {
			console.log(data);
			if(data['status'] == 'Y'){
                $.anewAlert(data['info']);
                window.location.reload();
            } else {
                $.anewAlert(data['info']);
            }
		});
	});
	//获取类型
    $('#brandb').change(function(event) {
        // alert($(this).val());
        $(".delc").remove();
        var brand = $(this).val();
        $.post('/Back/Product/car_act', {brand: brand}, function(data) {
            var _html = "";
            for (var i = 0; i < data.length; i++) {
                _html += "<option value='"+data[i]['cxjj_id']+"' class='delc'>"+data[i]['cxjj_brand']+"</option>"
            }
            $('#type').append(_html);
        },'json');
    });
	//获取类型
    $('#branda').change(function(event) {
        // alert($(this).val());
        var brand = $(this).val();
        $.post('/Back/Product/car_act', {brand: brand}, function(data) {
            var _html = "<option>请选择车型</option>";
            for (var i = 0; i < data.length; i++) {
                _html += "<option value="+data[i]['cxjj_id']+">"+data[i]['cxjj_brand']+"</option>"
            }
            $('#brand').html(_html);
        },'json');
    });
    //搜索
    $('#btn').click(function(event) {
        var brandb = $('#pro').val();
        var type = $('#cit').val();
        if(brandb ==''){
        	brandb ='f';
        }
        if(type ==''){
        	type ='f';
        }
        window.location.href="/Back/Product/arctic/brand/"+brandb+"/type/"+type;
    });
    //删除    
    $('.see4').click(function(event) {
        var code = $(this).attr('data-code');
        if (confirm('确定删除此信息吗？')) {
            $.post('/Back/Product/arcticdel', {code: code}, function(data) {
                alert(data);
                window.location.reload();
            },'json');
        }
    })
    //修改
    $('.see1').click(function(event) {
    	var code = $(this).attr('code');
    	var bid = $(this).attr('bid');
    	var branda = $(this).attr('branda');
    	var brand = $(this).attr('brand');
    	//var price = $(this).attr('price');
    	var pid = $(this).attr('pid');
    	var cxjj_types=$(this).attr('cxjj_types');
    	var cxjj_quality=$(this).attr('cxjj_quality');
    	var cxjj_category=$(this).attr('cxjj_category');
    	//console.log(price);
        //$('#price').val(price);
        $('#cxjj_types').val(cxjj_types);
        $('#cxjj_quality').val(cxjj_quality);
    	$('#branda option').each(function(index, el) {    		
    		if (pid == $(this).val()) {
    			$(this).attr('selected',true);
    		}
    	});
        var _htmlt = "<option selected value="+bid+">"+brand+"</option>";
        var str = "<option value=''>请选择类别</option><option value='ml_price_one'";
        if(cxjj_category=='ml_price_one'){
        	str +="selected='selected'>1类车毛利</option><option value='ml_price_two'";
        }else{
        	str +=">1类车毛利</option><option value='ml_price_two'";
        }
        if(cxjj_category=='ml_price_two'){
        	str +="selected='selected'>2类车毛利</option><option value='ml_price_three'";
        }else{
        	str +=">2类车毛利</option><option value='ml_price_three'";
        }
        if(cxjj_category=='ml_price_three'){
        	str +="selected='selected'>3类车毛利</option><option value='ml_price_four'";
        }else{
        	str +=">3类车毛利</option><option value='ml_price_four'";
        }
        if(cxjj_category=='ml_price_four'){
        	str +="selected='selected'>4类车毛利</option><option value='ml_price_five'";
        }else{
        	str +=">4类车毛利</option><option value='ml_price_five'";
        }
        if(cxjj_category=='ml_price_five'){
        	str +="selected='selected'>5类车毛利</option>";
        }else{
        	str +=">5类车毛利</option>";
        }
        $('#brand').html(_htmlt);
        $("#cxjj_category").html(str);
        $('#code').val(code);
    });
</script>
</body>
</html>