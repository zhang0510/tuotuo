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
<script src="/Public/JS/jquerytool_1.0v.js"></script>
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

                        <div class="tab-content1">
                            <div class="tab-content">
                                <div class="tab-pane active">
                                    <form id="edit-profile" class="form-horizontal" />
                                    <fieldset>
                                        <div class="l_uit">
                                            <div class="control-group">

                                                <div style="float:left;" class="controls clec_t">
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
                                                    <div class="dropdown">
                                                    
                                                    <div class="pay1">
															<dd>
																<input type="text" placeholder="请选择省份" id="provincea" value="<?php echo ($pval["area_name"]); ?>"/>
																<div class="pay2" id="pay1">
																	<ul id ="s1">
																		<?php if(is_array($provincea)): $i = 0; $__LIST__ = $provincea;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><li data1="<?php echo ($vv["area_name"]); ?>" data2="<?php echo ($vv["area_id"]); ?>" onclick='changeShi(this)'><h2><?php echo ($vv["area_name"]); ?></h2></li><?php endforeach; endif; else: echo "" ;endif; ?>
																	
																	</ul>
																</div>
															</dd>
															<dd>
																<input type="text" placeholder="请选择市" id="city" value="<?php echo ($cval["area_name"]); ?>"/>
																<div class="pay2" id="pay2">
																	<ul id ="s2">
																		
																		
																	</ul>
																</div>
															</dd>
															<dd>
																<input type="text" placeholder="请选择区" id="county" value="<?php echo ($coval["area_name"]); ?>"/>
																<div class="pay2"  id="pay3">
																	<ul id ="s3">
																		
																	</ul>
																</div>
															</dd>
														</div>
														<input type="hidden" value="<?php echo ($pval["pid"]); ?>" id="pro"/>
														<input type="hidden" value="<?php echo ($cval["cid"]); ?>" id="cit"/>
														<input type="hidden" value="<?php echo ($coval["cid"]); ?>" id="cou"/>
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
                                                      <!--   <select class="height46" id="provincea" name="">
                                                            <option value="">请选择省份</option>
                                                            <?php if(empty($pval["pid"])): ?><option selected="selected" value="">请选择省份</option>
                                                                <?php else: ?>
                                                                <option selected="selected" value="<?php echo ($pval["pid"]); ?>"><?php echo ($pval["area_name"]); ?></option><?php endif; ?>
                                                            <?php if(is_array($provincea)): $i = 0; $__LIST__ = $provincea;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vv["area_id"]); ?>"><?php echo ($vv["area_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                        </select>
                                                        <select class="height46" name="" id="city">
                                                            <option value="">请选择市</option>
                                                            <?php if(empty($cval["cid"])): ?><option selected="selected" value="">请选择市</option>
                                                                <?php else: ?>
                                                                <option selected="selected" value="<?php echo ($cval["cid"]); ?>"><?php echo ($cval["area_name"]); ?></option><?php endif; ?>
                                                        </select>
                                                        <select class="height46" name="" id="county">
                                                            <option value="">请选择区</option>
                                                            <?php if(empty($coval["cid"])): ?><option selected="selected" value="">请选择区</option>
                                                                <?php else: ?>
                                                                <option selected="selected" value="<?php echo ($coval["cid"]); ?>"><?php echo ($coval["area_name"]); ?></option><?php endif; ?>
                                                        </select>
 -->                                                    </div>

                                                    <div class="v_pb">
                                                        <button id="btn" class="btn btn-default5" type="button">搜索</button>
                                                    </div>

                                                </div>
                                                <!-- /controls -->
                                                <button data-toggle="modal" data-target="#myModa1" class="btn btn-default5 fr" id="addco" style="margin-right:10px;" type="button">添加区</button>
                                                <button data-toggle="modal" data-target="#myModa2" class="btn btn-default5 fr" id="addc" style="margin-right:10px;" type="button">添加市</button>
                                                <button data-toggle="modal" data-target="#myModa3" class="btn btn-default5 fr" id="addp" style="margin-right:10px;" type="button">添加省</button>

                                            </div>
                                            <script>

                                            /* $('#btn').click(function(event) {
                                                var provincea = $('#provincea').val();
                                                var city = $('#city').val();
                                                var county = $('#county').val();
                                                alert(provincea);
                                                alert(city);
                                                alert(county);
                                               // return false;
                                                window.location.href="/Back/Product/area/provincea/"+provincea+"/city/"+city+"/county/"+county;
                                            }); */
                                            $('#provincea').change(function(event) {
                                                // alert($(this).val());
                                                var provinceid = $(this).val();
                                                $(".delc").remove();
                                                $.post('/Back/Product/area_act', {provinceid: provinceid}, function(data) {
                                                    var _html = "";
                                                    for (var i = 0; i < data.length; i++) {
                                                        _html += "<option value="+data[i]['area_id']+" class='delc'>"+data[i]['area_name']+"</option>"
                                                    }
                                                    $('#city').append(_html);
                                                },'json');
                                            });
                                            //获取区县
                                            $('#city').change(function(event) {
                                                var city = $(this).val();
                                                $(".delb").remove();
                                                $.post('/Back/Product/area_act', {provinceid: city}, function(data) {
                                                    var _html = "";
                                                    for (var i = 0; i < data.length; i++) {
                                                        _html += "<option value="+data[i]['area_id']+" class='delb'>"+data[i]['area_name']+"</option>"
                                                    }
                                                    $('#county').append(_html);
                                                },'json');
                                            });
                                            //搜索
                                            $('#btn').click(function(event) {
                                                var provincea = $('#pro').val();
                                                var city = $('#cit').val();
                                                var county = $('#cou').val();
                                                if((provincea!=''&&city=='')||(provincea==''&&city!='')){
                                                	$.anewAlert('省市不能为空');
                                                	return false;
                                                }
                                                window.location.href="/Back/Product/area/provincea/"+provincea+"/city/"+city+"/county/"+county;
                                            });

                                                $(function(){
                                                    $('table tr.tr2:odd').css('background','#F0F0F0');
                                                });

                                            </script>
                                            <div class="l_table">
                                                <table>
                                                    <tr class="tr1">
                                                        <td>省份</td>
                                                        <td>地市</td>
                                                        <td>可到达</td>
                                                        <td>区县</td>
                                                        <td>可提车</td>
                                                        <td>操作</td>

                                                    </tr>
                                                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="tr2">
                                                            <td class="td3"><?php echo ($vo["province"]); ?></td>
                                                            <td><?php echo ($vo["city"]); ?></td>
                                                            <td><input type="checkbox" <?php if($vo['area_set'] == 'Y'): ?>checked="checked"<?php endif; ?> onclick="changeStatus(this,<?php echo ($vo['area_pid']); ?>,1)"/></td>
                                                            <td><?php echo ($vo["area_name"]); ?></td>
                                                            <td><input type="checkbox" <?php if($vo['area_get'] == 'Y'): ?>checked="checked"<?php endif; ?> onclick="changeStatus(this,<?php echo ($vo['area_id']); ?>,2)"/></td>
                                                            <td>
                                                                <a class="see4" data-id="<?php echo ($vo["area_id"]); ?>">删除</a>
                                                                <a class="see1" data-toggle="modal" data-target="#myModa1" data-p="<?php echo ($vo["province"]); ?>" data-c="<?php echo ($vo["city"]); ?>" data-a="<?php echo ($vo["area_name"]); ?>" data-pid="<?php echo ($vo["area_pid"]); ?>" data-aid="<?php echo ($vo["area_id"]); ?>" area-type="<?php echo ($vo["area_type"]); ?>" >修改</a>
                                                            </td>
                                                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                                </table>

                                            </div>
                                            <div class="l_fenye">
                                                <div class="sad">
                                                    <button type="button" data-toggle="modal" data-target="#hfvei" class="btn btn-default5">导入</button>
                                                    <?php if($coval['cid'] != ''): ?><a href="/Back/Worklwt/daochu/pro/<?php echo ($pval['pid']); ?>/cval/<?php echo ($cval['cid']); ?>/country/<?php echo ($coval['cid']); ?>"><button type="button" class="btn btn-default6">导出</button></a>
                                                    <?php elseif($cval['cid'] != ''): ?>
                                                        <a href="/Back/Worklwt/daochu/pro/<?php echo ($pval['pid']); ?>/cval/<?php echo ($cval['cid']); ?>"><button type="button" class="btn btn-default6">导出</button></a>
                                                    <?php else: ?>
                                                         <a href="/Back/Worklwt/daochu"><button type="button" class="btn btn-default6">导出</button></a><?php endif; ?>
                                                </div>
                                                <ul><?php echo ($page); ?></ul>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
            <!-- /widget --> </div>
        <!-- /span11 --> </div>
    <!-- /row -->

</div>
</div>
<!--tanceng-->
<!--省-->
<div id="myModa3" style="display:none; z-index:9999"   class="tan1">
<div class="tan11">
<a class="closed">X</a>
    <h2>添加省</h2>
    <!-- <form action="/Back/Product/areaadd" method="post">
    -->
    <div class="dw4">
        <dl>
            <dt>
                <input type="text" class="put1" id="pro" name="province" placeholder="请输入省" value=""></dt>
        </dl>

    </div>
    <p>
        <input type="submit" id="sheng" class="put1" value="确认"></p>
    <!-- </form>--></div>

</div>

<!--市-->
<div id="myModa2" style="display:none; z-index:9999"   class="tan1">
<div class="tan11">
<a class="closed">X</a>
    <h2>添加市</h2>
    <!-- <form action="/Back/Product/areaaddcity" method="post">
    -->
    <div class="dw4">
        <dl>
            <dt>
                <select name="province" class="dh3" name="" id="ppro">
                    <option value="0">请选择省</option>
                    <?php if(is_array($provincea)): $i = 0; $__LIST__ = $provincea;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vv["area_id"]); ?>"><?php echo ($vv["area_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </dt>
        </dl>
        <dl>
            <dt>
                <input type="text" class="put1" id="citshi" name="city" placeholder="请输入市" value=""></dt>
        </dl>
    </div>

    <!-- <dl>
    <input type="text" value="请输入手机号" onfocus="if(this.value==defaultValue){this.value=''}" onblur="if(this.value==''){this.value=defaultValue}" class="put1"></dl>
-->
<p>
    <input type="submit" id="shi" class="put1" value="确认"></p>
<!-- </form>--></div>

</div>

<!--区-->
<div id="myModa1" style="display:none; z-index:9999"   class="tan1">
<div class="tan11">
<a class="closed">X</a>
<h2>添加区/县</h2>
<!-- <form action="/Back/Product/areaaddcounty" method="post">
-->
<div class="dw4">
    <dl>
        <dt>
            <select class="dh3" name="province" id="provinceab">
                <option value="0">请选择省</option>
                <?php if(is_array($provincea)): $i = 0; $__LIST__ = $provincea;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vv["area_id"]); ?>"><?php echo ($vv["area_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </dt>
    </dl>
    <dl>
        <dt>
            <select class="dh3" name="city" id="cityb">
                <option value="0">请选择市</option>
            </select>
            <input type="hidden" name="area_id" id="hid"></dt>
    </dl>
    <dl>
        <dt>
            <input type="text" class="put1" name="county" id="dh5" placeholder="请输入区/县" value=""></dt>
    </dl>

</div>
<p>
    <input type="submit" class="put1" id="xian" value="确认"></p>
<!-- </form>--></div>

</div>

<!--区-->
<div id="hfvei" style="display:none; z-index:9999" class="tan1">
<div class="tan11">
<a class="closed">X</a>
<h2>导入数据</h2>
<form action="/Back/Product/daoRuArea" method="post" enctype="multipart/form-data">
<div class="dw4">
	<input type="file" name="csvFile">
	<input type="hidden" name="ceshi" value="1234567">
</div>
<span>注：导入操作会删除原有数据</span>
<p>
    <input type="submit" class="put1" value="确认"></p>
</form></div>
</div>

<script>
	/* function shduiFun(){
		$("#hfvei").show();
	} */
    //获取市
    $('#provinceab').change(function(event) {
        var provinceid = $(this).val();
        $.post('/Back/Product/area_act', {provinceid: provinceid}, function(data) {
            var _html = "";
            for (var i = 0; i < data.length; i++) {
                _html += "<option value="+data[i]['area_id']+">"+data[i]['area_name']+"</option>"
            }
            $('#cityb').html(_html);
        },'json');
    });
    //修改
    $('.see1').click(function(event) {
        var p = $(this).attr('data-p');
        var c = $(this).attr('data-c');
        var a = $(this).attr('data-a');
        var pid = $(this).attr('data-pid');
        var aid = $(this).attr('data-aid');
        var at = $(this).attr('area-type');
        $('#dh5').val(a);
        $('#hid').val(aid);
        $('#provinceab option').each(function(index, el) {
            if (at == $(this).val()) {
                $(this).attr('selected',true);
            }
        });
        var _htmlt = "<option selected value='"+pid+"'>"+c+"</option>"
        $('#cityb').html(_htmlt);
    });
    function changeStatus(obj,id,lev){
    	if($(obj).attr('checked')){
    		var status='Y';
    	}else{
    		var status='N';
    	}
    	 $.post('/Back/Product/changeStatus', {id:id,status:status,lev:lev}, function(data) {
             alert(data);
         },'json');
    }
</script>
<script>
    //添加省
    $('#addp').click(function(event) {
        $('#pro').val('');
    });
    //添加市
    $('#addc').click(function(event) {
        $('#ppro option').each(function(index, el) {
            console.log($(this).val());
            if (0 == $(this).val()) {
                $(this).attr('selected',true);
            }
        });
        $('#cit').val('');
    });
    //添加区
    $('#addco').click(function(event) {
        $('#provinceab option').each(function(index, el) {
            console.log($(this).val());
            if (0 == $(this).val()) {
                $(this).attr('selected',true);
            }
        });
        var city = "<option value='0'>请选择市</option>";
        $('#cityb').html(city);
        $('#dh5').val('');
    });

    //删除
    $('.see4').click(function(event) {
        var did = $(this).attr('data-id');
        if (confirm('确定删除此信息吗？')) {
            $.post('/Back/Product/areadel', {did: did}, function(data) {
                alert(data);
                window.location.reload();
            },'json');
        }
    })
    //添加省
    $('#sheng').click(function(event) {
        var sheng = $('#pro').val();
        if (sheng == "") {
            $.anewAlert('省不能为空！');
            return false;
        }
        $.post('/Back/Product/areaadd', {sheng: sheng}, function(data) {
            if(data['status'] == 'Y'){
                $.anewAlert(data['info']);
                window.location.reload();
            } else {
                $.anewAlert(data['info']);
            }
        },'json');
    });
    //添加市
    $('#shi').click(function(event) {
        var sheng = $('#ppro').val();
        var shi = $('#citshi').val();

        if (sheng == 0) {
            $.anewAlert('省不能为空！');
            return false;
        } else if (shi == "") {
            $.anewAlert('市不能为空！');
            return false;
        }
        $.post('/Back/Product/areaaddcity', {sheng: sheng,shi:shi}, function(data) {
            if(data['status'] == 'Y'){
                $.anewAlert(data['info']);
                window.location.reload();
            } else {
                $.anewAlert(data['info']);
            }
        });
    });
    //添加省
    $('#xian').click(function(event) {
        var sheng = $('#provinceab').val
        var shi = $('#cityb').val();
        var xian = $('#dh5').val();
        var hid = $('#hid').val();
        if (sheng == "0") {
            $.anewAlert('省不能为空！');
            return false;
        } else if (shi == "0") {
            $.anewAlert('市不能为空！');
            return false;
        } else if (xian == "") {
            $.anewAlert('区县不能为空！');
            return false;
        }
        $.post('/Back/Product/areaaddcounty', {shi:shi,xian:xian,area_id:hid}, function(data) {
            if(data['status'] == 'Y'){
                $.anewAlert(data['info']);
                window.location.reload();
            } else {
                $.anewAlert(data['info']);
            }
        });
    });
    $('.closed').click(function(){

    	$('.modal-backdrop').click();

    });
</script>
</body>
</html>