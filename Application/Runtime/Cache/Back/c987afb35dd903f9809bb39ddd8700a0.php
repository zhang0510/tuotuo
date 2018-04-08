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
		$("#provincea").find('option[value="<?php echo ($province); ?>"]').attr('selected',true);
		$("#provinceb").find('option[value="<?php echo ($provinceb); ?>"]').attr('selected',true);
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
						<li id="maoli" class="active">
							<a href="/Back/Product/maoli/provincea/f/provinceb/f">毛利管理</a>
						</li>
						<li id="arctic">
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
															<dd>
																<input type="text" placeholder="请选择省份" id="provincea" value="<?php echo ($p); ?>"/>
																<div class="pay2" id="pay1">
																	<ul id ="s1">
																		<?php if(is_array($provincea)): $i = 0; $__LIST__ = $provincea;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><li data1="<?php echo ($vv["area_name"]); ?>" data2="<?php echo ($vv["area_id"]); ?>" onclick='changeShi(this)'><h2><?php echo ($vv["area_name"]); ?></h2></li><?php endforeach; endif; else: echo "" ;endif; ?>
																	
																	</ul>
																</div>
															</dd>
															<div style="float:left;line-height:45px;padding:0 5px 0 0;">~</div>
															
															<dd>
																<input type="text" placeholder="请选择省份" id="city" value="<?php echo ($pb); ?>"/>
																<div class="pay2" id="pay2">
																	<ul id ="s2">
																		<?php if(is_array($provincea)): $i = 0; $__LIST__ = $provincea;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><li data1="<?php echo ($vv["area_name"]); ?>" data2="<?php echo ($vv["area_id"]); ?>" onclick='changeCity(this)'><h2><?php echo ($vv["area_name"]); ?></h2></li><?php endforeach; endif; else: echo "" ;endif; ?>
																		
																	</ul>
																</div>
															</dd>
															
														</div>
														<input type="hidden" value="<?php echo ($province); ?>" id="pro"/>
														<input type="hidden" value="<?php echo ($provinceb); ?>" id="cit"/>
														<script>
															$('.pay1 dd').click(function(){
																$(this).find('.pay2').slideToggle(1000).parent().siblings().find('.pay2').hide();
															});
															
															function changeShi(obj){
																
																var provinceid = $(obj).attr('data2');
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
															     
																 $.post('/Back/Product/get_area_bycon', {name:name,pid:1}, function(data) {
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
													<!-- <select class="height46" name="" id="provincea">
														<?php if(empty($province)): ?><option selected="selected" value="">请选择省</option>
															<?php else: ?>
															<option value="<?php echo ($province); ?>" selected ><?php echo ($p); ?></option><?php endif; ?>
														<option value="f">请选择省</option>
														<?php if(is_array($provincea)): $i = 0; $__LIST__ = $provincea;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pvo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($pvo["area_id"]); ?>"><?php echo ($pvo["area_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
													</select>
													~
													<select class="height46" name="" id="provinceb">
														<?php if(empty($provinceb)): ?><option selected="selected" value="">请选择省</option>
															<?php else: ?>
															<option value="<?php echo ($provinceb); ?>" selected ><?php echo ($pb); ?></option><?php endif; ?>
														<option value="f">请选择省</option>
														<?php if(is_array($provincea)): $i = 0; $__LIST__ = $provincea;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pvpo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($pvpo["area_id"]); ?>"><?php echo ($pvpo["area_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
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
													<td>省份</td>
													<td>省份</td>
													<td>1类车毛利</td>
													<td>2类车毛利</td>
													<td>3类车毛利</td>
													<td>4类车毛利</td>
													<td>5类车毛利</td>
													<td>操作</td>

												</tr>
												<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="tr2">
														<td class="td3"><?php echo ($vo["starp"]); ?></td>
														<td><?php echo ($vo["endp"]); ?></td>
														<td><?php echo ($vo['ml_price_one']/100); ?></td>
														<td><?php echo ($vo['ml_price_two']/100); ?></td>
														<td><?php echo ($vo['ml_price_three']/100); ?></td>
														<td><?php echo ($vo['ml_price_four']/100); ?></td>
														<td><?php echo ($vo['ml_price_five']/100); ?></td>
														<td>
															<a class="see4" data-code="<?php echo ($vo["ml_code"]); ?>">删除</a>
															<a data-code="<?php echo ($vo["ml_code"]); ?>" starid="<?php echo ($vo["ml_star"]); ?>" star="<?php echo ($vo["starp"]); ?>" endid="<?php echo ($vo["ml_end"]); ?>" end="<?php echo ($vo["endp"]); ?>" price1="<?php echo ($vo['ml_price_one']/100); ?>" price2="<?php echo ($vo['ml_price_two']/100); ?>" price3="<?php echo ($vo['ml_price_three']/100); ?>" price4="<?php echo ($vo['ml_price_four']/100); ?>" price5="<?php echo ($vo['ml_price_five']/100); ?>" data-toggle="modal" data-target="#myModa2"  class="see1">修改</a>
														</td>
													</tr><?php endforeach; endif; else: echo "" ;endif; ?>

											</table>

										</div>
										<div class="l_fenye">
											<div class="sad">
												<button type="button" data-toggle="modal" data-target="#hfvei" class="btn btn-default5">导入</button>
												<a href="/Back/Product/daochu_maoli/pro/<?php echo ($province); ?>/city/<?php echo ($provinceb); ?>"><button type="button" class="btn btn-default6">导出</button></a>
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
<!--弹层-->
<div id="myModa2" style="display:none; z-index:9999" class="tan1">
<div class="tan11">
<h2>添加毛利</h2>
<!-- <form action="/Back/Product/maoliadd" method="post"> -->
	<div class="dw4">
		<dl>
			<dt>
				<select class="dh3" name="mi_star" id="dh3">
					<option value="">请选择省</option>
					<?php if(is_array($provincea)): $i = 0; $__LIST__ = $provincea;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pv): $mod = ($i % 2 );++$i;?><option value="<?php echo ($pv["area_id"]); ?>"><?php echo ($pv["area_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</dt>
		</dl>
		<input type="hidden" name="code" value="" id="hid">
		<dl>
			<img src="/Public/Back/images/dw1.png"></dl>
		<dl>
			<dt>
				<select class="dh3" name="mi_end" id="dh4">
					<option value="">请选择省</option>
					<?php if(is_array($provincea)): $i = 0; $__LIST__ = $provincea;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pvp): $mod = ($i % 2 );++$i;?><option value="<?php echo ($pvp["area_id"]); ?>"><?php echo ($pvp["area_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</dt>
		</dl>
		<dl>
			<input id="srjg1" name="mi_price" placeholder="类别1费用" type="text" value="" onfocus="if(this.value==defaultValue){this.value=''}" onblur="if(this.value==''){this.value=defaultValue}" class="put1"></dl>
	    <dl>
			<input id="srjg2" name="mi_price" placeholder="类别2费用" type="text" value="" onfocus="if(this.value==defaultValue){this.value=''}" onblur="if(this.value==''){this.value=defaultValue}" class="put2"></dl>
	    <dl>
			<input id="srjg3" name="mi_price" placeholder="类别3费用" type="text" value="" onfocus="if(this.value==defaultValue){this.value=''}" onblur="if(this.value==''){this.value=defaultValue}" class="put3"></dl>
	    <dl>
			<input id="srjg4" name="mi_price" placeholder="类别4费用" type="text" value="" onfocus="if(this.value==defaultValue){this.value=''}" onblur="if(this.value==''){this.value=defaultValue}" class="put4"></dl>
	    <dl>
			<input id="srjg5" name="mi_price" placeholder="类别5费用" type="text" value="" onfocus="if(this.value==defaultValue){this.value=''}" onblur="if(this.value==''){this.value=defaultValue}" class="put5"></dl>
	
	</div>
	<p>
		<input type="submit" id="sub" class="put1" value="确认"></p>
<!-- </form> -->
</div>
</div>
<div id="hfvei" style="display:none; z-index:9999" class="tan1">
<div class="tan11">
<h2>导入数据</h2>
<form action="/Back/Product/daoru_maoli" method="post" enctype="multipart/form-data">
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
		$('#dh3 option').each(function(index, el) {
            if (0 == $(this).val()) {
                $(this).attr('selected',true);
            }
        });
        $('#dh4 option').each(function(index, el) {
            console.log($(this).val());
            if (0 == $(this).val()) {
                $(this).attr('selected',true);
            }
        });
        $('#srjg').val('');
        $('#hid').val('');
    });
	//提交
	$('#sub').click(function(event) {
		var mi_star = $('#dh3').val();
		var mi_end = $('#dh4').val();
		var code = $('#hid').val();
		var mi_price1 = $('#srjg1').val();
		var mi_price2 = $('#srjg2').val();
		var mi_price3 = $('#srjg3').val();
		var mi_price4 = $('#srjg4').val();
		var mi_price5 = $('#srjg5').val();
		
		if (mi_star == '') {
			$.anewAlert('起始省不能为空！');
            return false;
		} else if (mi_end == "") {
            $.anewAlert('结束省不能为空！');
            return false;
        }/*  else if (mi_price == "") {
            $.anewAlert('价格不能为空！');
            return false;
        } else if (!$.isPositiveNum(mi_price)) {
            $.anewAlert('价格填写错误');
            return false;
        } */
		$.post('/Back/Product/maoliadd', {mi_star:mi_star,mi_end:mi_end,code:code,mi_price1:mi_price1,mi_price2:mi_price2,mi_price3:mi_price3,mi_price4:mi_price4,mi_price5:mi_price5}, function(data) {
			console.log(data);
			if(data['status'] == 'Y'){
                $.anewAlert(data['info']);
                window.location.reload();
            } else {
                $.anewAlert(data['info']);
            }
		});
	});
    //搜索
    $('#btn').click(function(event) {
        var provincea = $('#pro').val();
        var provinceb = $('#cit').val();
        if(provincea ==''){
        	provincea ='f';
        }
        if(provinceb ==''){
        	provinceb ='f';
        }
        window.location.href="/Back/Product/maoli/provincea/"+provincea+"/provinceb/"+provinceb;
    });
    //删除
    $('.see4').click(function(event) {
        var code = $(this).attr('data-code');
        if (confirm('确定删除此信息吗？')) {
            $.post('/Back/Product/maolidel', {code: code}, function(data) {
                alert(data);
                window.location.reload();
            },'json');
        }
    })
    //修改
    $('.see1').click(function(event) {
    	var starid =$(this).attr('starid');
    	var star =$(this).attr('star');
    	var endid =$(this).attr('endid');
    	var end =$(this).attr('end');
    	var price1 =$(this).attr('price1');
    	var price2 =$(this).attr('price2');
    	var price3 =$(this).attr('price3');
    	var price4 =$(this).attr('price4');
    	var price5 =$(this).attr('price5');
    	var code =$(this).attr('data-code');
    	$('#dh3 option').each(function(index, el) {
    		if (starid == $(this).val()) {
    			$(this).attr('selected',true);
    		}
    	});
 		$('#dh4 option').each(function(index, el) {
    		if (endid == $(this).val()) {
    			$(this).attr('selected',true);
    		}
    	});
    	$('#srjg1').val(price1);
    	$('#srjg2').val(price2);
    	$('#srjg3').val(price3);
    	$('#srjg4').val(price4);
    	$('#srjg5').val(price5);
    	$('#hid').val(code);
    });
</script>
</body>
</html>