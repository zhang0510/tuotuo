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
					

					<div class="tab-content1">
						<div class="tab-content">
							<div class="tab-pane active">
								<form id="edit-profile" class="form-horizontal" action="/Back/Log/logList" id="sub" method="post">
								<fieldset>
									<div class="l_uit">
										<div class="control-group">
											<div style="float:left;" class="controls clec_t">
												<input type="text" style="float:left; margin-left:10px" class="i_n text2" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" name="start" id="startime" placeholder="起始时间" value="<?php echo ($start); ?>" readonly="readonly">					<input type="text" style="float:left;margin-left:10px;" class="i_n text2" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  name="end" id="endtime" value="<?php echo ($end); ?>" placeholder="结束时间" readonly="readonly">
												<div class="v_pb">	
													<input type="text" name="search" id="order" value="<?php echo ($search); ?>"  placeholder="请输入搜索内容" class="i_n text2">
													<button class="btn btn-default5" >搜索</button>
												</div>

											</div>
											<!-- /controls -->

										</div>
										<script>
												$(function(){
													$('table tr.tr2:odd').css('background','#F0F0F0');
												});
												
											</script>
										<div class="l_table">
											<table>
												<tr class="tr1">
													<td>时间</td>
													<td>管理员</td>
													<td>操作</td>
													<td>操作前</td>
													<td>操作后</td>
												</tr>
												<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="tr2">
														<td><?php echo ($vo["log_time"]); ?></td>
														<td><?php echo ($vo["admin_code"]); ?></td>
														<td><?php echo ($vo["log_operation"]); ?></td>
														<td><?php echo ($vo["log_content"]); ?></td>
														<td><?php echo ($vo["log_back_cont"]); ?></td>
													</tr><?php endforeach; endif; else: echo "" ;endif; ?>
											</table>

										</div>
										<div class="l_fenye"><?php if($num != 0): echo ($show); endif; ?></div>
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
    	alert(123);
    	$('#sub').submit();  
    });
    //删除
    $('.see2').click(function(event) {
    	var code = $(this).attr('code');
    	if (confirm('确定删除此信息吗？')) {
	    	$.post('/Back/Order/orderdel', {code: code}, function(data) {
	    		$.anewAlert(data);
	    		window.location.reload();
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
//			LODOP.PRINT_SETUP();
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
		LODOP.PRINT_INITA(10,10,831,1177,data.print_Title);
		LODOP.ADD_PRINT_SETUP_BKIMG("C:\\Users\\Administrator\\Desktop\\打印模板\\9-3.jpg");
		LODOP.SET_SHOW_MODE("BKIMG_LEFT",0);
		LODOP.SET_SHOW_MODE("BKIMG_TOP",0);
		LODOP.ADD_PRINT_TEXT(168,211,80,22,data.tclxr[0]);
		LODOP.ADD_PRINT_TEXT(200,183,160,22,data.name);
		LODOP.ADD_PRINT_TEXT(138,303,36,20,data.yd_j_time[0]);
		LODOP.ADD_PRINT_TEXT(135,364,22,20,data.yd_j_time[1]);
		LODOP.ADD_PRINT_TEXT(137,400,21,20,data.yd_j_time[2]);
		LODOP.ADD_PRINT_TEXT(583,463,34,20,"");
		LODOP.ADD_PRINT_TEXT(582,537,24,20,"");
		LODOP.ADD_PRINT_TEXT(581,508,24,20,"");
		LODOP.ADD_PRINT_TEXT(582,635,34,20,"");
		LODOP.ADD_PRINT_TEXT(581,701,24,20,"");
		LODOP.ADD_PRINT_TEXT(580,671,24,20,"");
		LODOP.ADD_PRINT_TEXT(168,410,111,22,data.tclxr[2]);
		LODOP.ADD_PRINT_TEXT(235,314,104,22,data.tel);
		LODOP.ADD_PRINT_TEXT(235,469,208,22,data.identity);
		LODOP.ADD_PRINT_TEXT(200,158,416,22,data.address);
		LODOP.ADD_PRINT_TEXT(265,202,30,17,data.number[4]);
		LODOP.ADD_PRINT_TEXT(266,271,30,17,data.number[3]);
		LODOP.ADD_PRINT_TEXT(269,334,30,17,data.number[2]);
		LODOP.ADD_PRINT_TEXT(268,394,30,17,data.number[1]);
		LODOP.ADD_PRINT_TEXT(267,466,30,17,data.number[0]);
		LODOP.ADD_PRINT_TEXT(338,158,177,22,data.brand);
		LODOP.ADD_PRINT_TEXT(337,511,177,22,data.carmark);
	};
</script>
</body>
</html>