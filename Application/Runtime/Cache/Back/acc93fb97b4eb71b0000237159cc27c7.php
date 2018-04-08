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
<script src="/Public/JS/jquerytool_1.0v.js"></script>
<script src="/Public/laydate/laydate.js"></script>
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
<script language="javascript" src="/Public/JS/LodopFuncs.js"></script>
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
						<li class="active">
							<a href="/Back/Orderyjh/orderList">全部订单</a>
							<?php if($num["num"] > 99): ?><em>99+</em>
								<?php else: ?> <em><?php echo ($num["num"]); ?></em><?php endif; ?>
						</li>
						<li name="S">
							<a href="/Back/Orderyjh/orderList/order_status/S">待审核订单</a>
							<?php if($num["s"] > 99): ?><em>99+</em>
								<?php else: ?>
								<em><?php echo ($num["s"]); ?></em><?php endif; ?>
						</li>
						<li name="A">
							<a href="/Back/Orderyjh/orderList/order_status/A">待安排订单</a>
							<?php if($num["a"] > 99): ?><em>99+</em>
								<?php else: ?>
								<em><?php echo ($num["a"]); ?></em><?php endif; ?>
						</li>
						<li name="T">
							<a href="/Back/Orderyjh/orderList/order_status/T">待提车订单</a>
							<?php if($num["t"] > 99): ?><em>99+</em>
								<?php else: ?>
								<em><?php echo ($num["t"]); ?></em><?php endif; ?>
						</li>
						<li name="Z">
							<a href="/Back/Orderyjh/orderList/order_status/Z">待核实订单</a>
							<?php if($num["z"] > 99): ?><em>99+</em>
								<?php else: ?>
								<em><?php echo ($num["z"]); ?></em><?php endif; ?>
						</li>
						<!-- <li name="Y">
							<a href="/Back/Orderyjh/orderList/order_status/Y">运输中订单</a>
							<?php if($num["y"] > 99): ?><em>99+</em>
								<?php else: ?>
								<em><?php echo ($num["y"]); ?></em><?php endif; ?>
						</li> -->
					   <li name="C">
					         <a id="cctv" href="/Back/Orderyjh/orderList/order_status/C">运输中订单</a>
							<?php if($num["y"] > 99): ?><em>99+</em>
								<?php else: ?>
								<em><?php echo ($num["y"]); ?></em><?php endif; ?>
				       </li>
						<li name="V">
							<a href="/Back/Orderyjh/orderList/order_status/V">待回访订单</a>
							<?php if($num["v"] > 99): ?><em>99+</em>
								<?php else: ?>
								<em><?php echo ($num["v"]); ?></em><?php endif; ?>
						</li>
						<li name="R">
							<a href="/Back/Orderyjh/orderList/order_status/R">需回单订单</a>
							<?php if($num["r"] > 99): ?><em>99+</em>
								<?php else: ?>
								<em><?php echo ($num["r"]); ?></em><?php endif; ?>
						</li>
						<li name="W">
							<a href="/Back/Orderyjh/orderList/order_status/W">已完成订单</a>
							<?php if($num["w"] > 99): ?><em>99+</em>
								<?php else: ?>
								<em><?php echo ($num["w"]); ?></em><?php endif; ?>
						</li>
                        <li name="DIE">
							<a href="/Back/Orderyjh/orderList/order_status/DIE">审核不通过订单</a>
							<?php if($num["die"] > 99): ?><em class ='dieNum'>99+</em>
								<?php else: ?>
								<em class ='dieNum'><?php echo ($num["die"]); ?></em><?php endif; ?>
						</li>
						 <li name="NUN">
							<a href="/Back/Orderyjh/orderList/order_status/NUN">作废订单</a>
							<?php if($num["nun"] > 99): ?><em>99+</em>
								<?php else: ?>
								<em><?php echo ($num["nun"]); ?></em><?php endif; ?>
						</li>
					</ul>
					<ul class="nav nav-tabs cctv1" id="tabnav1" style="display:none;">
						<li name="C">
							<a href="/Back/Orderyjh/orderList/order_status/C">全部</a>
						</li>
						<li name="Y">
							<a href="/Back/Orderyjh/orderList/order_status/Y">待装板</a>
						</li>
						<li name="M">
							<a href="/Back/Orderyjh/orderList/order_status/M">待中转</a>
						</li>
						<li name="N">
							<a href="/Back/Orderyjh/orderList/order_status/N">待到达</a>
						</li>
						<li name="B">
							<a href="/Back/Orderyjh/orderList/order_status/B">待送车</a>
						</li>
						<li name="G">
							<a href="/Back/Orderyjh/orderList/order_status/G">待交车</a>
						</li>
						<li name="D">
							<a href="/Back/Orderyjh/orderList/order_status/D">已到达</a>
						</li>
                    </ul>
                <script>
					$("#cctv").click(function(){
						if($(".cctv1").css("display")=="none"){
							$(".cctv1").show();
						}else{
							$(".cctv1").hide();
						}
					});
					$(function(){
						var order_status="<?php echo ($order_status); ?>";
						if(order_status=='C'||order_status=='Y'||order_status=='M'||order_status=='N'||order_status=='B'||order_status=='G'||order_status=='D'){
							$(".cctv1").show();
						}
					})
				</script>

					<div class="tab-content1">
						<div class="tab-content">
							<div class="tab-pane active">
								<form id="edit-profile" class="form-horizontal" />
								<fieldset>
									<div class="l_uit">
										<div class="control-group">

											<div style="float:left;" class="controls clec_t">
												<!-- <div class="dropdown">
													<select class="height46" name="" id="pay_status">
														<option value="0">请选择支付方式</option>
														<option value="W">网上支付</option>
														<option value="H">货到付款</option>
													</select>
												</div> -->
												<input type="text" style="float:left; margin-left:10px" class="i_n text2" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" id="startime" placeholder="起始时间" value="" readonly="readonly">					<input type="text" style="float:left;margin-left:10px;" class="i_n text2" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" id="endtime" value="" placeholder="结束时间" readonly="readonly">
												 <div class="pay1" style ="margin-left:10px;">
															<dd>
																<input type="text" placeholder="(出发/目的)地省份" id="provincea" value="<?php echo ($arry["pname"]); ?>"/>
																<div class="pay2" id="pay1" >
																	<ul id ="s1">
																		<?php if(is_array($provincea)): $i = 0; $__LIST__ = $provincea;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><li data1="<?php echo ($vv["area_name"]); ?>" data2="<?php echo ($vv["area_id"]); ?>" onclick='changeShi(this)'><h2><?php echo ($vv["area_name"]); ?></h2></li><?php endforeach; endif; else: echo "" ;endif; ?>
																	
																	</ul>
																</div>
															</dd>
															
														</div>
												<div class="v_pb">	
												<!-- <select class="height46" name="" id="provincea">
														<option value="f">(出发/目的)地省份</option>
                                                        <?php if(empty($arry["pid"])): ?><option selected="selected" value="">请选择省份</option>
                                                            <?php else: ?>
                                                            <option selected="selected" value="<?php echo ($arry["pid"]); ?>"><?php echo ($arry["pname"]); ?></option><?php endif; ?>
														<?php if(is_array($provincea)): $i = 0; $__LIST__ = $provincea;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vv["area_id"]); ?>"><?php echo ($vv["area_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
												</select> -->
												 <input type="hidden" value="<?php echo ($arry["pid"]); ?>" id="pro"/>
													<input type="text" id="order" value="<?php echo ($order); ?>" name="order" placeholder="请输入订单/车牌/手机号"  class="i_n text2">
													<button class="btn btn-default5" id="btn" type="button">搜索</button>
												</div>

											</div>
											<!-- /controls -->

										</div>
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
														</script>
										<script>
												$(function(){
													$('table tr.tr2:odd').css('background','#F0F0F0');
												});
												
											</script>
										<div class="l_table">
											<table>
												<tr class="tr1">
													<?php if(($order_status == 'S') OR ($order_status == '')): ?><td>下单时间</td>
													<?php else: ?>
													<td>提车时间</td><?php endif; ?>
													<td>订单编号</td>
													<td>咨询客服</td>
													<td>客户</td>
													<td>车辆信息</td>
													<td>车牌号</td>
													<td>出发地</td>
													<td>目的地</td>
													<td>价格</td>
													<?php if($order_status == 'R'): ?><td>回单人</td>
													<?php else: ?>
													<td>当前位置</td><?php endif; ?>
                                                                                                                       <td>发运商</td>
													<td>发运负责人</td>
													<?php if($order_status == 'DIE' or $order_status == 'NUN'): ?><td>操作</td><?php endif; ?>
													
													
												</tr>
												<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="tr2">
														<?php if(($order_status == 'S') OR ($order_status == '')): ?><td><?php echo ($vo["order_time"]); ?></td>
														<?php else: ?>
														<td><?php echo ($vo["ti_car_time"]); ?></td><?php endif; ?>
														<td class="td3"><a href="/Back/Orderyjh/orderinfo/order_code/<?php echo ($vo["order_code"]); ?>"><?php echo ($vo["order_code"]); ?></a></td>
														<td><?php echo ($vo["admin_name"]); ?></td>
														<td><a href="/Back/Orderyjh/orderinfo/order_code/<?php echo ($vo["order_code"]); ?>">
															<?php echo ($vo["username"]); ?>
															<br><?php echo ($vo["user_code"]); ?></a></td>
															
														<td class="td_d2"><a href="/Back/Orderyjh/orderinfo/order_code/<?php echo ($vo["order_code"]); ?>">
															<?php echo ($vo["order_info_brand"]); ?>－<?php echo ($vo["order_info_type"]); ?>
															<br><?php echo ($vo["carmark"]); ?></a></td>
													    <td ><?php echo ($vo["order_info_carmark"]); ?></td>
														<td><a href="/Back/Orderyjh/orderinfo/order_code/<?php echo ($vo["order_code"]); ?>"><?php echo ($vo['order_info_stars'][1]); ?></td>
														<td><a href="/Back/Orderyjh/orderinfo/order_code/<?php echo ($vo["order_code"]); ?>"><?php echo ($vo['order_info_ends'][1]); ?></td>
														<td><a href="/Back/Orderyjh/orderinfo/order_code/<?php echo ($vo["order_code"]); ?>"><?php echo ($vo['order_info_zj']/100); ?></a></td>
														<?php if($order_status == 'R'): ?><td><a href="/Back/Orderyjh/orderinfo/order_code/<?php echo ($vo["order_code"]); ?>"><?php echo ($vo['hui_man']); ?></a></td>
														<?php else: ?>
														<td><a href="/Back/Orderyjh/orderinfo/order_code/<?php echo ($vo["order_code"]); ?>"><?php echo ($vo['area']); ?></a></td><?php endif; ?>
														
														<!-- <td>
															
															<?php if($vo["order_status"] == 'T'): ?><a href="javascript:void(0)" onclick="printAskToGet('<?php echo ($vo["order_code"]); ?>')">打印</a><?php endif; ?>
															<?php if($vo["mark_c"] == 'C'): ?><a href="/Back/Worklwt/orderinfo/order_code/<?php echo ($vo["order_code"]); ?>" class="see4">修改</a><?php endif; ?>
															<a href="javascript:" code="<?php echo ($vo["order_code"]); ?>" class="see2">删除</a>
														</td> -->
                                                                                                                                <td><?php echo ($vo["sper"]); ?></td>
														<td><?php echo ($vo["shipper"]); ?></td>
														<?php if($order_status == 'DIE' or $order_status == 'NUN'): ?><td><a href="javascript:" code="<?php echo ($vo["order_code"]); ?>" class="see2">删除</a></td><?php endif; ?>
													</tr><?php endforeach; endif; else: echo "" ;endif; ?>
											</table>

										</div>
										<div class="l_fenye"><?php if($page != ''): echo ($page); endif; ?></div>
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
<style>
	.l_table table tr td a{
		color: #000;
	}
</style>
</div>
</div>
<script>
	var LODOP; //声明为全局变量   
	$(document).ready(function(){
		var sign = '<?php echo ($order_status); ?>';
		if(sign!=''){
			$("#tabnav").find('li[name="'+sign+'"]').addClass('active').siblings().removeClass('active');
			$("#tabnav1").find('li[name="'+sign+'"]').addClass('active').siblings().removeClass('active');
			if(sign=='Y'||sign=='M'||sign=='N'||sign=='B'||sign=='G'){
				$("#tabnav").find('li').removeClass('active');
			}
		}
	})
	//加载运行
	$('#pay_status option').each(function(index, el) {
		var pay = "<?php echo ($pay); ?>";
		if ($(this).val() == pay) {
			$(this).attr('selected',true);
		}
	});
    //搜索
    $('#btn').click(function(event) {
    	var getos = "<?php echo ($order_status); ?>";
        var order = $('#order').val();
        var startime = $('#startime').val();
        var endtime = $('#endtime').val();
        var provincea=$('#pro').val();
        if(provincea ==''){
        	provincea ='f';
        }
       	if (startime == '') {
       		startime = 0;
       	}
       	if (endtime == '') {
       		endtime = 0;
       	}
        if (getos&&order) {
        	window.location.href="/Back/Orderyjh/orderList/order_status/"+getos+"/star/"+startime+"/end/"+endtime+"/order/"+order+"/provincea/"+provincea;
        } else if(order){
        	window.location.href="/Back/Orderyjh/orderList/star/"+startime+"/end/"+endtime+"/order/"+order+"/provincea/"+provincea;
        }else if(getos){
        	window.location.href="/Back/Orderyjh/orderList/order_status/"+getos+"/star/"+startime+"/end/"+endtime+"/provincea/"+provincea;
        }else{
        	window.location.href="/Back/Orderyjh/orderList/star/"+startime+"/end/"+endtime+"/provincea/"+provincea;
        }        
    });
    //删除
    $('.see2').click(function(event) {
    	var num =<?php echo ($num["die"]); ?>;
    	var now_num =parseFloat(num) -1;
    	var numObj =$('.dieNum');
    	var code = $(this).attr('code');
    	var fh = $(this);
    	if (confirm('确定删除此信息吗？')) {
	    	$.post('/Back/Order/orderdel', {code: code}, function(data) {
	    		if(data =='Y'){
	    			$.anewAlert('删除成功');
	    			fh.parents(".tr2").remove();
	    			if(now_num > 99){
	    				numObj.html('99+');
	    			}else{
	    				numObj.html(now_num);
	    			}
	    		}else{
	    			
	    			$.anewAlert('删除失败');
	    		}
	    		//window.location.reload();
	    	},'json');
	    }
    });
    
	function printpact(order_code){
		$.post('/Back/Print/printpact/',{'order_code':order_code},function(data){
			//调用打印预览
			CreateFullBill2(data);
		  	LODOP.PREVIEW();
		})
	}
	
	function printAskToGet(order_code){
		$.post('/Back/Print/printAskToGet/',{'order_code':order_code},function(data){
			//调用打印预览
			CreateFullBill3(data);
			//LODOP.PRINT_SETUP();
		  	LODOP.PREVIEW();
		})
	}
	
	//运车服务合同
	function CreateFullBill2(data) {
		LODOP.PRINT_INITA(10,10,831,1177,data.print_Title);
		LODOP.ADD_PRINT_SETUP_BKIMG("C:\\Users\\Administrator\\Desktop\\打印模板\\9-1.jpg");
		LODOP.SET_SHOW_MODE("BKIMG_LEFT",0);
		LODOP.SET_SHOW_MODE("BKIMG_TOP",0);
		LODOP.ADD_PRINT_TEXT(87,98,50,22,data.orderInfo.order_info_star);
		LODOP.ADD_PRINT_TEXT(86,196,50,22,data.orderInfo.order_info_end);
		LODOP.ADD_PRINT_TEXT(115,153,80,22,data.orderInfo.order_info_sclxr[0]);
		LODOP.ADD_PRINT_TEXT(150,167,80,22,data.orderInfo.order_info_tclxr[0]);
		LODOP.ADD_PRINT_TEXT(85,323,36,20,data.yundan.yd_j_time[0]);
		LODOP.ADD_PRINT_TEXT(83,386,22,20,data.yundan.yd_j_time[1]);
		LODOP.ADD_PRINT_TEXT(83,422,21,20,data.yundan.yd_j_time[2]);
		LODOP.ADD_PRINT_TEXT(877,647,34,20,"");
		LODOP.ADD_PRINT_TEXT(877,709,24,20,"");
		LODOP.ADD_PRINT_TEXT(875,686,24,20,"");
		LODOP.ADD_PRINT_TEXT(940,645,34,20,"");
		LODOP.ADD_PRINT_TEXT(942,714,24,20,"");
		LODOP.ADD_PRINT_TEXT(942,688,24,20,"");
		LODOP.ADD_PRINT_TEXT(1026,646,34,20,"");
		LODOP.ADD_PRINT_TEXT(1025,719,24,20,"");
		LODOP.ADD_PRINT_TEXT(1027,687,24,20,"");
		LODOP.ADD_PRINT_TEXT(113,312,135,22,data.orderInfo.order_info_sclxr[2]);
		LODOP.ADD_PRINT_TEXT(116,499,208,22,data.orderInfo.order_info_sclxr[1]);
		LODOP.ADD_PRINT_TEXT(147,312,135,22,data.orderInfo.order_info_tclxr[2]);
		LODOP.ADD_PRINT_TEXT(150,497,208,22,data.orderInfo.order_info_tclxr[1]);
		LODOP.ADD_PRINT_TEXT(186,363,416,22,data.orderInfo.order_info_end);
		LODOP.ADD_PRINT_TEXT(286,52,120,22,data.orderInfo.order_info_brand);
		LODOP.ADD_PRINT_TEXT(317,50,120,22,"");
		LODOP.ADD_PRINT_TEXT(288,214,122,22,data.orderInfo.order_info_carmark);
		LODOP.ADD_PRINT_TEXT(318,211,122,22,"");
		LODOP.ADD_PRINT_TEXT(285,366,62,22,data.orderInfo.order_info_price);
		LODOP.ADD_PRINT_TEXT(318,365,64,22,"");
		LODOP.ADD_PRINT_TEXT(286,444,60,22,data.orderInfo.order_info_bxd);
		LODOP.ADD_PRINT_TEXT(317,441,64,22,"");
		LODOP.ADD_PRINT_TEXT(286,513,67,22,data.orderInfo.order_info_c_car);
		LODOP.ADD_PRINT_TEXT(319,511,68,22,"");
		LODOP.ADD_PRINT_TEXT(349,177,30,17,data.carInfo.verify_car_keys);
		LODOP.ADD_PRINT_TEXT(370,176,30,17,data.carInfo.verify_km);
		LODOP.ADD_PRINT_TEXT(349,313,30,17,data.carInfo.verify_spare_tire);
		LODOP.ADD_PRINT_TEXT(368,314,30,17,data.carInfo.verify_instructions);
		LODOP.ADD_PRINT_TEXT(352,443,30,17,data.carInfo.verify_tool_kit);
		LODOP.ADD_PRINT_TEXT(372,443,30,17,data.carInfo.verify_warning_sign);
		LODOP.ADD_PRINT_TEXT(348,574,30,17,data.carInfo.verify_lifting_jack);
		LODOP.ADD_PRINT_TEXT(369,575,30,17,data.carInfo.verify_lighter);
		LODOP.ADD_PRINT_TEXT(350,712,30,17,data.carInfo.verify_door_mat);
		LODOP.ADD_PRINT_TEXT(370,708,30,17,data.carInfo.verify_fire_extinguisher);
		LODOP.ADD_PRINT_TEXT(403,223,383,22,data.carImg[0].verify_img_describe);
		LODOP.ADD_PRINT_TEXT(404,622,160,22,data.carImg[0].verify_img_id);
		LODOP.ADD_PRINT_TEXT(437,222,383,22,data.carImg[1].verify_img_describe);
		LODOP.ADD_PRINT_TEXT(437,622,161,22,data.carImg[1].verify_img_id);
		LODOP.ADD_PRINT_TEXT(469,622,162,22,data.carImg[2].verify_img_id);
		LODOP.ADD_PRINT_TEXT(468,221,382,22,data.carImg[2].verify_img_describe);
		LODOP.ADD_PRINT_TEXT(501,222,383,22,data.carImg[3].verify_img_describe);
		LODOP.ADD_PRINT_TEXT(502,622,160,22,data.carImg[3].verify_img_id);
		LODOP.ADD_PRINT_TEXT(533,222,383,22,data.carImg[4].verify_img_describe);
		LODOP.ADD_PRINT_TEXT(533,622,160,22,data.carImg[4].verify_img_id);
		LODOP.ADD_PRINT_TEXT(562,222,383,22,data.carImg[5].verify_img_describe);
		LODOP.ADD_PRINT_TEXT(562,622,160,22,data.carImg[5].verify_img_id);
		LODOP.ADD_PRINT_TEXT(593,222,383,22,data.carImg[6].verify_img_describe);
		LODOP.ADD_PRINT_TEXT(593,622,160,22,data.carImg[6].verify_img_id);
		LODOP.ADD_PRINT_TEXT(624,222,383,22,"");
		LODOP.ADD_PRINT_TEXT(625,622,160,22,"");
		LODOP.ADD_PRINT_TEXT(654,222,383,22,"");
		LODOP.ADD_PRINT_TEXT(654,622,160,22,"");
		LODOP.ADD_PRINT_TEXT(776,191,30,17,data.orderInfo.number[5]);
		LODOP.ADD_PRINT_TEXT(776,253,30,17,data.orderInfo.number[4]);
		LODOP.ADD_PRINT_TEXT(778,300,30,17,data.orderInfo.number[3]);
		LODOP.ADD_PRINT_TEXT(779,346,30,17,data.orderInfo.number[2]);
		LODOP.ADD_PRINT_TEXT(778,396,30,17,data.orderInfo.number[1]);
		LODOP.ADD_PRINT_TEXT(780,442,30,17,data.orderInfo.number[0]);
		LODOP.ADD_PRINT_TEXT(1024,182,60,20,"");
		LODOP.ADD_PRINT_TEXT(1025,289,80,20,"");
		LODOP.ADD_PRINT_TEXT(1024,418,163,20,"");

	};
	
	//车妥妥提车单
	function CreateFullBill3(data) {
		LODOP.PRINT_INITA(10,10,831,1177,'11');
		LODOP.ADD_PRINT_SETUP_BKIMG("C:\\Users\\Administrator\\Desktop\\打印模板\\9-3.jpg");
		LODOP.SET_SHOW_MODE("BKIMG_LEFT",0);
		LODOP.SET_SHOW_MODE("BKIMG_TOP",0);
		LODOP.ADD_PRINT_TEXT(137,158,80,22,data.tclxr[0]);
		LODOP.ADD_PRINT_TEXT(200,183,72,22,data.name);
		LODOP.ADD_PRINT_TEXT(115,291,36,20,data.yd_j_time[0]);
		LODOP.ADD_PRINT_TEXT(114,354,22,20,data.yd_j_time[1]);
		LODOP.ADD_PRINT_TEXT(114,390,21,20,data.yd_j_time[2]);
		LODOP.ADD_PRINT_TEXT(583,463,34,20,"");
		LODOP.ADD_PRINT_TEXT(582,537,24,20,"");
		LODOP.ADD_PRINT_TEXT(581,508,24,20,"");
		LODOP.ADD_PRINT_TEXT(582,635,34,20,"");
		LODOP.ADD_PRINT_TEXT(581,701,24,20,"");
		LODOP.ADD_PRINT_TEXT(580,671,24,20,"");
		LODOP.ADD_PRINT_TEXT(138,410,111,22,data.tclxr[2]);
		LODOP.ADD_PRINT_TEXT(200,314,104,22,data.tel);
		LODOP.ADD_PRINT_TEXT(199,469,208,22,data.identity);
		LODOP.ADD_PRINT_TEXT(167,158,416,22,data.address);
		LODOP.ADD_PRINT_TEXT(242,202,30,17,data.number[4]);
		LODOP.ADD_PRINT_TEXT(242,271,30,17,data.number[3]);
		LODOP.ADD_PRINT_TEXT(242,334,30,17,data.number[2]);
		LODOP.ADD_PRINT_TEXT(242,394,30,17,data.number[1]);
		LODOP.ADD_PRINT_TEXT(242,466,30,17,data.number[0]);
		LODOP.ADD_PRINT_TEXT(295,155,177,22,data.brand);
		LODOP.ADD_PRINT_TEXT(300,517,159,22,data.carmark);
		
		LODOP.ADD_PRINT_TEXT(113,636,131,22,data.carcode);
		LODOP.ADD_PRINT_TEXT(213,636,131,22,data.tebie);
		
		
	};
</script>
</body>
</html>