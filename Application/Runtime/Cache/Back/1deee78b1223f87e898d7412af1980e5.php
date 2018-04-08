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
<script src="/Public/Back/laydate/laydate.js"></script>
<script src="/Public/JS/jquerytool_1.0v.js"></script>
<script language="javascript" src="/Public/JS/LodopFuncs.js"></script>
<script>
	function sum(obj){
		var hhk=$(".td3 input[type='checkbox']:checked");
		var sum=0;
		hhk.each(function(k,v){
			sum=sum+parseFloat($(v).attr('names'));
		});
		//alert(sum);
		$("#total").html(sum);
	}
	function checktime(){
		var start = $("#startDate").val();
		var end = $("#endDate").val();
		var start = Date.parse(start);
		var end = Date.parse(end);
		if(start>=end&&start!=''&&end!=''){
			$.anewAlert('搜索日期范围有误');
			return false;
		}else if((start||end)&&(!end&&start)){
			$.anewAlert('请完善起始日期和终止日期');
			return false;
		}
		//return false;
	}
</script>
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
			<!-- 		<div class="ico-pt span12">
			<h4>店铺管理</h4>
		</div>
		-->
		<div class="row">

			<div class="tsan113">

				<div class="widget">

					<div class="tabbable">
						<ul class="nav nav-tabs" id="tabnav">
							<li>
								<a href="/Back/Financeyjh/getOrderList">订单收入</a>
							</li>
						
							<li>
								<a href="/Back/Financeyjh/getYunList">运单支出</a>
							</li>
						
							<li class="active">
								<a href="">保费支出</a>
							</li>
						
							<li>
								<a href="/Back/Financeyjh/getFaList">发票费用</a>
							</li>
						
							<li>
								<a href="/Back/Financeyjh/getTotalList">总揽</a>
							</li>
						</ul>
						<div class="tab-content1">
							<div class="tab-content">
								<div class="tab-pane active">
									<form id="edit-profile" class="form-horizontal" />
									<fieldset>
										<div class="l_uit">
											<div class="control-group">
											<form method="get" action="/Back/Financeyjh/getBaoList">
												<div style="float:left;" class="controls clec_t">

												<div class="dropdown">

												<input type="text" placeholder="搜索开始时间" id="startDate" name="startDate" value="<?php echo ($startDate); ?>" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" class="i_n text2" readonly="readonly">
												<input type="text" placeholder="搜索结束时间" id="endDate" name="endDate" value="<?php echo ($endDate); ?>" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" class="i_n text2" readonly="readonly">
												</div>
												<div class="v_pb">
													<input type="text" style="width:300px;" placeholder="请输入订单号，下单者手机号，订单车型，下单者姓名进行搜索" class="i_n text2 width360" name="search" value="<?php echo ($search); ?>">
													<button class="btn btn-default5" type="submit" onclick="return checktime();">搜索</button>

												</div>
											</form>
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
														<td><input type="checkbox" name="" id="checkall" onClick="selectAll(this)"/>全选</td>
														
														<td style="width: 100px;">日期</td>
														<td>订单号</td>
														<td>车型</td>
														<td>车牌号</td>
														<td>路线</td>
														<td>保费</td>
														<td>已支付</td>
														<td>流水号</td>
													</tr>
													<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr class="tr2">
															<td class="td3"><input type="checkbox" class="box" names="<?php echo ($vo['orderInfo']['order_info_zj']/100); ?>" value="<?php echo ($vo["order_code"]); ?>" onclick="sum(this)"></td>
															<td><?php echo ($vo["order_time"]); ?></td>
															<td><?php echo ($vo["order_code"]); ?></td>
															<td><?php echo ($vo["order_info_type"]); ?></td>
															<td><?php echo ($vo["order_info_carmark"]); ?></td>
															<td><?php echo ($vo['order_info_stars'][1]); ?>-<?php echo ($vo['order_info_ends'][0]); ?></td>
															<td><?php echo ($vo['order_info_bxd']/100); ?></td>
															<td class="td_d2">
															<?php if($vo['fin_is_bao'] == 'Y'): ?><input type="checkbox" class="check" checked="checked" data-class="n<?php echo ($vo['order_id']); ?>" data-id="<?php echo ($vo['order_id']); ?>"/>
															<?php else: ?>
															       <input type="checkbox" class="check" data-class="n<?php echo ($vo['order_id']); ?>" data-id="<?php echo ($vo['order_id']); ?>"/><?php endif; ?>
															</td>
															<td class="n<?php echo ($vo['order_id']); ?>"><?php echo ($vo['fin_bao']); ?></td>
														</tr><?php endforeach; endif; ?>
													</foreach>


												</table>
												
											</div>
											<div class="l_fenye">
												<div class="sad">
													<button type="button" class="btn btn-default5" onClick="daochu()">导出</button>
												</div>
												<?php if($num != 0): echo ($page); endif; ?>
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
	
<div id="ggg1" style="display:none; z-index:9999" class="tan1">
	<div class="tan11 tan66">
		<a class="closed">X</a>
		<h2>输入流水号</h2>
	</div>
	<div class="onteyta41">
		<input name="Fruit" type="text" class="input1" value="" />
	</div>
	<div class="sad1 onteytc8">
		<button style="margin-left:8px;" class="btn btn-default22" type="button">确认</button>
	</div>
</div>
<script>
$(".check").click(function(){
	$("#ggg1").css('display','block');
	var changeClass=$(this).attr("data-class");
	var id=$(this).attr("data-id");
	$(".btn-default22").click(function(){
		var number=$(".input1").val();
		if(number==''){
			layer.msg('请输入流水号');
		}else{
			$.post("/Back/Financeyjh/changeStatus",{table:'order_assistant',status:'fin_is_bao',number:number,liuName:'fin_bao',idName:'order_id',id:id},function(data){
				 if(data.flag){
					 $("#ggg1").css('display','none');
					 $("."+changeClass).html(number);
				 }else{
					 layer.msg(data.msg);
				 }
			});
		}
	});
});
$(".closed").click(function(){
	$("#ggg1").css('display','none');
});

</script>
<script>
function selectAll(sel){  //全选  全不选
		$(".box").attr('checked',sel.checked);
			var hhk=$(".td3 input[type='checkbox']:checked");
		var sum=0;
		hhk.each(function(k,v){
			sum=sum+parseFloat($(v).attr('names'));
		});
		$("#total").html(sum);
}
function daochu(){
	var selid = '';
		  $(".box:checked").each(function(){
			   if(selid==''){
				   selid=$(this).val();
			   }else{
				   selid = selid+','+$(this).val();
			   }

		  })
		  //alert(selid);
		  if(selid == ""){
			$.anewAlert('请勾选想导出的订单！');
			return false;
		  }else{
			window.location.href="/Back/Financeyjh/daochu/code/"+selid;
		  }

}
</script>
<script language="javascript" type="text/javascript">
    var LODOP; //声明为全局变量   
    //打印预览
	function Preview1(yd_code,yd_star,yd_end,yd_name,zj,time_A,time_B,time_C) {
		CreateFullBill(yd_code,yd_star,yd_end,yd_name,zj,time_A,time_B,time_C);
	  	LODOP.PREVIEW();	
		//LODOP.PRINT_SETUP();		
	};

//财务支付凭证
function CreateFullBill(yd_code,yd_star,yd_end,yd_name,zj,time_A,time_B,time_C) {
	LODOP.PRINT_INITA(10,10,831,1177,"");
	LODOP.ADD_PRINT_SETUP_BKIMG("C:\\Users\\Administrator\\Desktop\\打印模板\\9-4.jpg");
	LODOP.SET_SHOW_MODE("BKIMG_LEFT",0);
	LODOP.SET_SHOW_MODE("BKIMG_TOP",0);
	LODOP.ADD_PRINT_TEXT(129,172,210,22,yd_name);
	LODOP.ADD_PRINT_TEXT(166,172,209,22,yd_star+"-"+yd_end);
	LODOP.ADD_PRINT_TEXT(203,173,84,22,zj+"元");
	LODOP.ADD_PRINT_TEXT(102,385,36,20,time_A);
	LODOP.ADD_PRINT_TEXT(101,445,22,20,time_B);
	LODOP.ADD_PRINT_TEXT(101,482,21,20,time_C);
	LODOP.ADD_PRINT_TEXT(70,555,74,20,yd_code);
};

</script> 
</body>
</html>