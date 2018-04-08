<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
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
<script src="/Public/JS/jquery.Huploadify.js"></script>
<script src="/Public/JS/jquerytool_1.0v.js"></script>
<script src="/Public/laydate/laydate.js"></script>
<script language="javascript" src="/Public/JS/LodopFuncs.js"></script>
<script src="/Public/JS/clipboard.min.js"></script>

<style>
.tan11 h2{margin-bottom:10px;}
.hk1 input{line-height:30px;height:30px;}
.hk1{margin-bottom:5px;}
</style>
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
<script type="text/javascript">
		var id = "";
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
                            <li>
                                <a href="">订单管理</a>
                            </li>
							<li>
                                <a href="">NO：<?php echo ($code); ?></a>
                            </li>
                        </ul>
                        <div class="tab-content1">
                        	<div>
                        	<?php if($data['order_status'] == 'DIE'): ?><button data-toggle="modal" data-target="#myModa100" id="add100" class="btn btn-default10" type="button" >已作废</button>
                        	<?php else: ?>
                        	    <button data-toggle="modal" data-target="#myModa1000" id="add1000" class="btn btn-default10" type="button" >订单作废</button><?php endif; ?>
                        	 	
                        	</div>
							<div class="onteyta1">
								<h2><strong>下单人：</strong><?php echo ($data['User']['user_name']); ?>  <?php echo ($data['User']['tel']); ?>     &nbsp;&nbsp;&nbsp;&nbsp;<?php if($data['busin_type'] == 'A'): ?>散车<?php else: echo ($data['company']); endif; ?></h2>
								<div class="onteyta46">
									<span>备注:</span>
									<?php echo ($data['sh_bei']); ?>
									<!-- <textarea type="text" class="text25" style="width:500px;display:inline-block" value="" id="order_info_remark"><?php echo ($data['']); ?></textarea><a onclick="setdiv('textarea',1,'O','order_info_remark','<?php echo ($data['order_info_remark']); ?>',this)" class="edit0">&nbsp;<img src="/Public/Back/images/ww4.png"></a> -->
                                </div>                                                                                                                                                           
							</div>
							<div class="onteyta1">
							<div class="onteyta2">
									<span><strong>车辆:</strong></span>
									<span class="cv2 hh2" id="order_info_brand"><?php echo ($data['order_info_brand']); ?></span>			
			   &nbsp;<a class="edit0"  onclick="setdiv('CAR_XING','input',1,'O','order_info_brand','<?php echo ($data['order_info_brand']); ?>',this)" ><img src="/Public/Back/images/ww4.png"></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                </div> 
                     <div class="onteyta2">
									<span><strong>车系:</strong></span>
									<span class="cv2 hh2" id="order_info_type"><?php echo ($data['order_info_type']); ?></span>			
			   &nbsp;<a class="edit0"  onclick="setdiv('CAR_XING','input',1,'O','order_info_type','<?php echo ($data['order_info_type']); ?>',this)" ><img src="/Public/Back/images/ww4.png"></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                </div> 
                                
				<div class="onteyta2"><span><strong>车牌号:</strong></span><span class="cv2 hh2" id="order_info_carmark"><?php echo ($data['order_info_carmark']); ?></span><a class="edit0"  onclick="setdiv('CAR_XING','input',1,'O','order_info_carmark',
						
						'<?php echo ($data['order_info_carmark']); ?>',this)" >&nbsp;<img src="/Public/Back/images/ww4.png"></a></div>
								
			   
							</div>
							
							
<div class="onteytb">
	<div class="onteytb1">
		<div class="dg1">
			<input type="hidden" value="" id="log_mark" />
			<input type="hidden" value="" id="cont_qian" />
			<span><strong>出发地</strong></span>
		    <span id="order_info_star"><?php echo ($data['order_info_stars'][0]); ?>-<?php echo ($data['order_info_stars'][1]); ?>-<?php echo ($data['order_info_stars'][2]); ?></span>
           <a class="edit0"  onclick="setdiv('START','select',3,'O','order_info_star','<?php echo ($data['order_info_star']); ?>')">&nbsp;<img src="/Public/Back/images/ww4.png"></a>
			
		</div>	
		<div class="onteyta4">
			<span><strong>姓名：</strong></span><b id="order_info_tclxr0"><?php echo ($data['order_info_tclxr'][0]); ?></b><a class="edit0"  onclick="setdiv('START_MAN','input',1,'O','order_info_tclxr0','<?php echo ($data['order_info_tclxr'][0]); ?>')">&nbsp;<img src="/Public/Back/images/ww4.png"></a>&nbsp;&nbsp;&nbsp;&nbsp;
			<b id="order_info_tclxr1"><?php echo ($data['order_info_tclxr'][1]); ?></b><a onclick="setdiv('START_MAN','input',1,'O','order_info_tclxr1','<?php echo ($data['order_info_tclxr'][1]); ?>')" class="edit0">&nbsp;<img src="/Public/Back/images/ww4.png"></a>
		</div>
		<div class="onteyta4">
			<span><strong>身份证:</strong></span>
			<b id="order_info_tclxr2"><?php echo ($data['order_info_tclxr'][2]); ?></b><a onclick="setdiv('','input',1,'O','order_info_tclxr2','<?php echo ($data['order_info_tclxr'][2]); ?>')" class="edit0">&nbsp;<img src="/Public/Back/images/ww4.png"></a>
		</div>
		<div class="onteyta4">
			<span><strong>具体地址:</strong></span>
			<b id="order_info_star_address"><?php echo ($data['order_info_star_address']); ?></b><a onclick="setdiv('START_ADRES','input',1,'O','order_info_star_address','<?php echo ($data['order_info_star_address']); ?>')" class="edit0">&nbsp;<img src="/Public/Back/images/ww4.png"></a>
			
		</div>
	</div>	
	<div class="onteytb1">
		<div class="dg1">
			<span><strong>目的地</strong></span>
		  <span id="order_info_end"><?php echo ($data['order_info_ends'][0]); ?>-<?php echo ($data['order_info_ends'][1]); ?></span>
 <a class="edit0"  onclick="setdiv('END','select',2,this,'order_info_end','<?php echo ($data['order_info_end']); ?>')">&nbsp;<img src="/Public/Back/images/ww4.png"></a>			
		</div>	
			<div class="onteyta4">
			<span><strong>姓名：</strong></span><b id="order_info_sclxr0"><?php echo ($data['order_info_sclxr'][0]); ?></b><a onclick="setdiv('END_MAN','input',1,'O','order_info_sclxr0','<?php echo ($data['order_info_sclxr'][0]); ?>')" class="edit0">&nbsp;<img src="/Public/Back/images/ww4.png"></a>&nbsp;&nbsp;&nbsp;&nbsp;
			<b id="order_info_sclxr1"><?php echo ($data['order_info_sclxr'][1]); ?></b><a onclick="setdiv('END_MAN','input',1,'O','order_info_sclxr1','<?php echo ($data['order_info_sclxr'][1]); ?>')" class="edit0">&nbsp;<img src="/Public/Back/images/ww4.png"></a>
		</div>
		<div class="onteyta4">
			<span><strong>身份证:</strong></span>
			<b id="order_info_sclxr2"><?php echo ($data['order_info_sclxr'][2]); ?></b><a onclick="setdiv('','input',1,'O','order_info_sclxr2','<?php echo ($data['order_info_sclxr'][2]); ?>')" class="edit0">&nbsp;<img src="/Public/Back/images/ww4.png"></a>
		</div>
		<div class="onteyta4">
		<span><strong>具体地址:</strong></span>
			<b id="order_info_end_address"><?php echo ($data['order_info_end_address']); ?></b><a onclick="setdiv('END_ADRES','input',1,'O','order_info_end_address','<?php echo ($data['order_info_end_address']); ?>')" class="edit0">&nbsp;<img src="/Public/Back/images/ww4.png"></a>
		</div>
	</div>
	<div class="onteytb1">
		<div class="onteyta4">
			<span><strong>发运备注:</strong></span>
			<?php if($data['order_info_smsc'] == 'Y'): ?>送车
			<?php else: ?>
			自提<?php endif; ?>
			<!-- <input type="text" class="text25" value="自提/送车"><a onclick="setdiv('input',1,this)" class="edit0">&nbsp;<img src="/Public/Back/images/ww4.png"></a> -->
		</div>
		<div class="onteyta2">
			<?php if($data["receipt"] == 'Y'): ?><span><strong>需追回单:</strong></span>
				<span class="cv2 hh2" id="hui_man"><?php echo ($data['hui_man']); ?></span>
				<a onclick="setdiv('UPSHOU','input',1,'O','hui_man','<?php echo ($data['hui_man']); ?>')" class="edit0">&nbsp;<img src="/Public/Back/images/ww4.png"></a><?php endif; ?>
		</div>
		<div class="onteyta4">
			<span> <strong>下单备注:</strong></span>
            <textarea id="order_info_remark"><?php echo ($data['order_info_remark']); ?></textarea><a onclick="setdiv('','textarea',1,'O','order_info_remark','<?php echo ($data['order_info_remark']); ?>')" class="edit0">&nbsp;<img src="/Public/Back/images/ww4.png"></a>
		</div>
	</div>	
</div>	
							
<div class="onteytb">
	<div class="onteytb1">
		<div class="onteyta4">
			<span><strong>运费:</strong></span><span class="cv2 hh2" ><?php echo ($data['yc']); ?>元</span>  <button data-toggle="modal" onclick="fuPrice();" type="button"  class="btn dbtn1"> [价格组成]</button>
		</div>
		<div class="onteyta4">
			<span><strong>共计:</strong></span><span class="cv2 hh2" ><?php echo ($data['order_info_zj']/100); ?>元</span><button  data-toggle="modal" onclick="fuUpPrice();" class="btn dbtn1" id="order_info_zj_html"> [修改价格]</button>
		</div>
		<div class="onteyta4 onteytb2">
			<span><strong>优惠情况：</strong><?php if($data['fav_code'] != ''): ?>使用编号<?php echo ($data['fav_code']); ?>优惠码减免<?php echo ($data['fav_price']/100); ?>元。<?php else: ?>无<?php endif; ?></span>
		</div>
		<div class="onteyta4 onteytb2">
			<span><strong><?php if($data['pay_way'] == 'Z'): ?>支付宝<?php elseif($data['pay_way'] == 'W'): ?>微信<?php elseif($data['pay_way'] == 'H'): ?>货到付款 <?php else: ?>未支付<?php endif; ?></strong></span>
		</div>
	</div>	
	<div class="onteytb1">
		<div class="onteyta4 onteytb2">
			<span><strong>车价格:</strong><?php echo ($data['order_info_price']/100); ?>万元<a onclick="setdiv('','input',1,'O','order_info_price','<?php echo ($data['order_info_price']/100); ?>')" class="edit0">&nbsp;<img src="/Public/Back/images/ww4.png"></a></span>
			<span><strong>保险费用:</strong><?php echo ($data['order_info_bxd']/100); ?>元</span>
		</div>
		<?php if(($data['order_status'] != 'S') AND ($data['pay_status'] == 'W')): ?><div class="onteyta4 onteytb2">
			<span><?php if($data['is_yuej'] == 'N'): ?>现金<?php else: ?>月结<?php endif; ?></span>
		</div><?php endif; ?>
		
		<div class="onteyta4 onteytb2">
			<span>
				<strong>支付状态：</strong>
				<?php if($data['pay_status'] == 'W'): ?>未支付
				<?php else: ?>
					已支付<?php if($data['pay_name'] != ''): ?>&nbsp;&nbsp;&nbsp;&nbsp;操作人:<?php echo ($data["pay_name"]); endif; endif; ?>
				<a id="change"><img src="/Public/Back/images/ww4.png"></a>
			</span>
		</div>
		
	</div>
	<div class="onteytb1">
	    <?php if($data['order_status'] != 'S'): ?><div class="onteyta4">
			<span><strong>开票费:</strong></span>
			<input type="text" class="text25" value="<?php echo ($data['bill_price']/100); ?> " id="bill_price"><a onclick="setdiv('','input',1,'O','bill_price','<?php echo ($data['bill_price']/100); ?>')" class="edit0">&nbsp;<img src="/Public/Back/images/ww4.png"></a>
		</div><?php endif; ?>
		<div class="onteyta4">
			<span><strong>代收方:</strong></span>
			<input type="text" class="text25" value="<?php echo ($data['income']); ?>" id="income"><a onclick="setdiv('','input',1,'O','income','<?php echo ($data['income']); ?>')" class="edit0">&nbsp;<img src="/Public/Back/images/ww4.png"></a>
		</div>
	</div>
</div>
<div class="onteytb">
    <?php if($data['order_status'] != 'S'): ?><div class="onteytb4">								
		<h2><strong>短信接收人：</strong></h2>
		<h2>[<?php echo ($data['mess_rec_man']); ?>]</h2>
	</div><?php endif; ?>
	<div class="onteytb5">	
		<table> 
			<thead>
				<tr>
					<th>时间</th>
					<th>到达地</th>
					<th>短信状态</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($position)): foreach($position as $key=>$va): ?><tr>
					<td><?php echo ($va['time']); ?> </td>
					<td><?php echo ($va['content']); ?></td>
					<td>
					<?php if($va['is_send'] == 'Y'): ?><b>已发送</b>
					<?php else: ?>
					     <a data-code="<?php echo ($va['order_code']); ?>" data-targe="<?php echo ($data['mess_rec_man']); ?>" data-content="<?php echo ($va['text']); ?>" data-id="<?php echo ($va['id']); ?>" class="sendMessage" style="cursor:pointer;"><span>发送信息</span></a><?php endif; ?>
					| <a data-code="<?php echo ($va['order_code']); ?>" data-targe="<?php echo ($data['mess_rec_man']); ?>" data-content="<?php echo ($va['text']); ?>" data-id="<?php echo ($va['id']); ?>" class="sendMessage" style="cursor:pointer;"><span>重发</span></a>
					</td>
				</tr><?php endforeach; endif; ?>
			</tbody>
		</table>
	</div>							
</div>
<div class="l_table onteytb">
	<table>
		<tr class="tr1 onteytb6">
			<th>运单号</th>
			<th>发运+</th>
			<th>承运方</th>
			<th>承运路线</th>
			<th>费用<button onclick="fuCheckYunPrice();">查看</button></th>
			<th>接车公里数</th>
			<th>使用公里数</th>
			<th>跟踪电话</th>
			<th>身份证</th>
			<th>备注</th>
			<th>操作</th>
		</tr>
		<?php if(is_array($yundan)): foreach($yundan as $key=>$va): ?><tr class="tr2 onteytb8">
			<td class="td3 yd_code"><?php echo ($va['yd_code']); ?></td>
			<td><?php echo ($va['yd_type']); ?></td>
			<td class="td3"><input type="text" data-val="<?php echo ($va['yd_name']); ?>" disabled value="<?php echo ($va['yd_name']); ?>" class="yd1"/></td>
			<td><input type="text" disabled value="<?php echo ($va['yd_line']); ?>" class="yd2"/></td>
			<td><input type="text" disabled data-val="<?php echo ($va['yd_price']/100); ?>" value="*" class="yd3"/></td>
			<td><input type="text" disabled value="<?php echo ($va['yd_j_gong']); ?>" class="yd4"/></td>
			<td><input type="text" disabled value="<?php echo ($va['yd_s_gong']); ?>" class="yd5"/></td>
			<td><input type="text" disabled value="<?php echo ($va['yd_tel']); ?>" class="yd6"/></td>
			<td><input type="text" disabled title="<?php echo ($va['yd_indetity']); ?>" value="<?php echo ($va['yd_indetity']); ?>" class="yd6"/></td>
			<td><input type="text" disabled value="<?php echo ($va['yd_mark']); ?>" class="yd7"/></td>
			<td>
				<?php if($va["is_del"] == 'N'): ?><a class="see1 sa1">修改</a>
				<a class="see3 sa2">保存</a>
				<a class="see4" data-code="<?php echo ($va['yd_code']); ?>">作废</a>
				<a class="onteytb7 print"  data-code="<?php echo ($va['yd_code']); ?>" >打印</a><?php endif; ?>
				
			</td>
		</tr><?php endforeach; endif; ?>
		
	</table>
</div>
<div class="onteytc">
	<div class="onteytc1">
		<h2>验车</h2>
		<div>
			<?php if($data["flag"] == 'Y'): ?><b onclick="checkCarFun();" id="car_check" class="btn" data-clipboard-action="copy" data-clipboard-target="#car_check_val">复制验车信息</b>
				<span id="car_check_val"></span>
			<?php elseif($data["flag"] == 'N'): ?>
				<b class="btn" onclick="querenFun('<?php echo ($data["yd_id"]); ?>');">确认提车</b><?php endif; ?>
		</div>
	</div>
	<div class="onteytc2">
		<h2>车钥匙：<input type="text" value="<?php echo ($verify['verify_car_keys']); ?>" id="verify_car_keys"/>把<a onclick="setdiv('','input',1,'V','verify_car_keys','<?php echo ($verify['verify_car_keys']); ?>')" class="edit0">&nbsp;<img src="/Public/Back/images/ww4.png"></a></h2>
		<h2>车辆当前公里数<input type="text" value="<?php echo ($verify['verify_km']); ?>" id="verify_km"/>(必填)<a onclick="setdiv('','input',1,'V','verify_km','<?php echo ($verify['verify_km']); ?>')" class="edit0">&nbsp;<img src="/Public/Back/images/ww4.png"></a></h2>
		<h2>提车预计行驶公里数<input type="text" value="<?php echo ($verify['verify_predict_km']); ?>" id="verify_predict_km"/>(必填)<a onclick="setdiv('','input',1,'V','verify_predict_km','<?php echo ($verify['verify_predict_km']); ?>')" class="edit0">&nbsp;<img src="/Public/Back/images/ww4.png"></a></h2>
		<div class="onteytc3">
			<h2>行李工具备注</h2>
			<textarea id="verify_xingli"><?php echo ($verify['verify_xingli']); ?></textarea><a onclick="setdiv('','textarea',1,'V','verify_xingli','<?php echo ($verify['verify_xingli']); ?>')" class="edit0">&nbsp;<img src="/Public/Back/images/ww4.png"></a>
		</div>
		<div class="onteytc3">
			<h2>车身外观</h2>
			<textarea id="verify_car_wai"><?php echo ($verify['verify_car_wai']); ?></textarea><a onclick="setdiv('','textarea',1,'V','verify_car_wai','<?php echo ($verify['verify_car_wai']); ?>')" class="edit0">&nbsp;<img src="/Public/Back/images/ww4.png"></a>
		</div>
		<div class="onteytc3">
		<div class="chek0">
		<?php if(is_array($verifyImg)): foreach($verifyImg as $key=>$va): ?><div class="chek1">
		 <img src="<?php echo ($va['verify_img_upload']); ?>"/><a class="del" onclick="del(<?php echo ($va['verify_img_id']); ?>,this)"><img src="/Public/Back/images/timg.png"></a>
		 <input type="hidden" name="img[]" value="<?php echo ($va['verify_img_upload']); ?>">
		 </div><?php endforeach; endif; ?>
        

	 </div>	
	  	<div id="upload1" style="display:none;"></div>
		  <div style="margin:20px 20px 20px 0px;float:none;" class="chek2" id="addImg">
		  <input type="hidden" id="hidimg"/>
		  <input type="hidden" id="imgid" />
		  <img src="/Public/Back/images/we1.png"/>
		 
		  <h2>添加更多照片</h2>
		  </div>
		</div>


		<div class="onteytc3">
			<h2>备注</h2>
			<textarea id="verify_bei"><?php echo ($verify['verify_bei']); ?></textarea><a onclick="setdiv('','textarea',1,'V','verify_bei','<?php echo ($verify['verify_bei']); ?>')" class="edit0">&nbsp;<img src="/Public/Back/images/ww4.png"></a>
		</div>
	</div>
</div>
<div class="sad2" style="background:#fff;position:fixed;bottom:0px;width:100%">


<?php if($data['sh_status'] == ''): ?><button data-toggle="modal" data-target="#myModa1" id="add1" class="btn btn-default10" type="button">审核</button>
<?php elseif($data['sh_status'] == 'Y'): ?>
<button class="btn btn-default8" type="button">通过审核</button>
<?php elseif($data['sh_status'] == 'N'): ?>
<button class="btn btn-default8" type="button">未通过审核</button><?php endif; ?>
<?php if(($data['order_status'] == 'A') OR ($data['order_status'] == 'T')): ?><button data-toggle="modal" data-target="#myModa3" id="add4"  class="btn btn-default10" type="button">提车中</button> 
<?php elseif(($data['order_status'] == 'W')or($data['order_status'] == 'S')): ?>
    <button   class="btn btn-default8" type="button">安排发运</button>
<?php else: ?>
    <button data-toggle="modal" data-target="#myModa3" id="add4"  class="btn btn-default10" type="button">安排发运</button><?php endif; ?>
<!-- <?php if(($data['order_status'] == 'W')or($data['order_status'] == 'S')): ?><button  class="btn btn-default8" type="button">打印合同</button>
<?php else: ?>
<button data-toggle="modal" data-target="#myModa4" id="add4" class="btn btn-default10" type="button">打印合同</button><?php endif; ?> -->
<button data-toggle="modal" data-target="#myModa4" id="add4" class="btn btn-default10" type="button">打印合同</button>
<?php if(($data['order_status'] == 'W')or($data['order_status'] == 'S')): ?><button  class="btn btn-default8" type="button">上传保险单</button>
<?php else: ?>
	<?php if($data['verify'] == 'Y'): ?><button data-toggle="modal" data-target="#myModa5" id="add5" class="btn btn-default10" type="button">已上传</button>
	<?php else: ?>
		<button data-toggle="modal" data-target="#myModa5" id="add5" class="btn btn-default10" type="button">上传保险单</button><?php endif; endif; ?>
<?php if(($data['order_status'] == 'W')or($data['order_status'] == 'S')): ?><button class="btn btn-default8" type="button">位置跟踪</button>
<?php else: ?>
<button data-toggle="modal" data-target="#myModa9" id="add5" class="btn btn-default10" type="button">位置跟踪</button><?php endif; ?>
<?php if(($data['order_status'] == 'D')): ?><button data-toggle="modal" data-target="#myModa7" id="add7" class="btn btn-default10" type="button">已交车</button>
<?php elseif($data['order_status'] == 'S'): ?>
<button  class="btn btn-default8" type="button">已交车</button>
<?php elseif($data['order_status'] == 'W'): ?>
<button  class="btn btn-default8" type="button">已到达</button>
<?php else: ?>
<button data-toggle="modal" data-target="#myModa6" id="add6" class="btn btn-default10" type="button">已到达</button><?php endif; ?>
<?php if(($data['is_visit'] != 'Y') AND ($data['visit'] == 'Y') AND ($data['order_status'] != 'S')): ?><button data-toggle="modal" data-target="#myModa8" id="add8" class="btn btn-default10" type="button">待回访</button>
<?php else: ?>
<button class="btn btn-default8" type="button">已回访</button><?php endif; ?>
<?php if(($data['receipt'] == 'Y') AND ($data['is_hui'] != 'Y')): ?><button data-toggle="modal" data-target="#myModa10" id="add6" class="btn btn-default10" type="button">回单已回</button>
<?php elseif(($data['receipt'] == 'Y') AND ($data['is_hui'] == 'Y')): ?>
 <button class="btn btn-default8" type="button">回单已回</button><?php endif; ?>
<?php if(($data["order_status"] == 'A') OR ($data["order_status"] == 'T') OR ($data["order_status"] == 'Y') OR ($data["order_status"] == 'M') OR ($data["order_status"] == 'N') OR ($data["order_status"] == 'B') OR ($data["order_status"] == 'G') OR ($data["order_status"] == 'D') OR ($data["order_status"] == 'W')): ?><button data-toggle="modal" onclick="window.location.href='/Back/Worktwo/pdf_fwhtd/order_code/<?php echo ($code); ?>'" class="btn btn-default10" type="button">运输协议(合同)</button>
<?php else: ?>
  	<button class="btn btn-default8" type="button">运输协议(合同)</button><?php endif; ?>

</div>
<div class="onteytb">
	<div class="onteytb5">	
		<table> 
			<thead>
				<tr>
					<th>操作时间</th>
					<th>操作内容前</th>
					<th>操作内容后</th>
					<th>操作人</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($log)): foreach($log as $key=>$va): ?><tr>
					<td><?php echo ($va['log_time']); ?> </td>
					<td><?php echo ($va['log_back_cont']); ?></td>
					<td><?php echo ($va['log_content']); ?></td>
					<td>
						<?php echo ($va['admin_code']); ?>
					</td>
				</tr><?php endforeach; endif; ?>
			</tbody>
		</table>
	</div>							
</div>
<!-- 审核订单 -->
<div id="myModa1" style="display:none; z-index:9999" class="tan1">
	<div class="tan11 tan66">
	<a class="closed">X</a>
		<h2>审核订单</h2>
		<div class="dw2">
		  <div class="zz1">
			<div class="onteytc4">
				<span><?php echo ($data['User']['user_name']); ?>  <?php echo ($data['User']['tel']); ?>  </span>
				<span><?php if($data['busin_type'] == 'A'): ?>散车<?php else: echo ($data['company']); endif; ?></span>
			</div>
			<div class="onteytc4">
				<span><b>车辆</b>：<?php echo ($data['order_info_brand']); ?> </span>
				<span><b>识别号</b>：<?php echo ($data['order_info_carmark']); ?></span>
			</div>
			<div class="onteytc5">
				<span><b>线路</b>：<?php echo ($data['order_info_stars'][0]); ?>-<?php echo ($data['order_info_stars'][1]); ?>-<?php echo ($data['order_info_stars'][2]); ?></span>
				<span><img src="/Public/Back/images/ee1.png"/></span>
				<span><?php echo ($data['order_info_ends'][0]); ?>-<?php echo ($data['order_info_ends'][1]); ?></span>
				<span><?php if($data['order_info_smsc'] == 'Y'): ?>送车<?php else: ?>自提<?php endif; ?></span>
			</div>
			<div class="onteytc5">
				<span><b>运费</b>：<?php echo ($data['yc']); ?>元   </span>
				<span><label><input name="Fruit[]" type="checkbox" value="Y" id="jie" <?php if($data['is_yuej'] == 'Y'): ?>checked="checked"<?php endif; ?> />月结 </label></span> 
				<span><label><input name="Fruit[]" type="checkbox" value="Y" id="hui" <?php if($data['receipt'] == 'Y'): ?>checked="checked"<?php endif; ?> />回单 </label></span>
			</div>
			<div class="onteytc5">
				<span><b>开票类型</b>：</span>
				<span class="pp1"><label><input name="Fruit1" type="radio" value="A" class="fav" <?php if($data['bill_type'] == 'A'): ?>checked="checked"<?php endif; ?>/>普票 </label></span> 
				<span class="pp1"><label><input name="Fruit1" type="radio" value="B" class="fav" <?php if($data['bill_type'] == 'B'): ?>checked="checked"<?php endif; ?>/>增票 </label></span>
				<span class="pp2"><label><input name="Fruit1" type="radio" value="C" class="fav" <?php if($data['bill_type'] == 'C'): ?>checked="checked"<?php endif; ?> />其他</label></span>
				<span class="pp3"><input class="input2" placeholder="输入费用" id="cost"  <?php if($data['bill_type'] == 'C'): ?>value="<?php echo ($data['bill_price']/100); ?>"<?php endif; ?> > </span>
			</div>
			<div class="onteytc5" style="overflow:none;">
				<span><b>业务类型</b>：</span>
				<span class="pp1"><label><input name="Fruit2" type="radio" value="A" class="type" <?php if($data['busin_type'] == 'A'): ?>checked="checked"<?php endif; ?> />散车 </label></span> 
				<span class="pp2"><label><input name="Fruit2" type="radio" value="B" class="fav" <?php if($data['busin_type'] == 'B'): ?>checked="checked"<?php endif; ?> />公司 </label></span>
				<span class="pp3" style="position: relative;"><input class="input2" placeholder="输入公司名称" id="company" value="<?php echo ($data['company']); ?>"  oninput="myFunction('jiu8','company',this)"> 
				<div id="jiu8" style="border: 1px solid #cccccc;background:#FFF;left: 0px;position: absolute;top: 28px;width: 200px;z-index: 10000;" class="jiu8">
				  
				</div> 
				</span>
			</div>
			<div class="onteytc5">
				<span><b>提车时间</b>：<label><input id="ti_car_time" type="text" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" readonly="readonly" class="fav" /></label></span>
			</div>
			<div class="onteytc5">
				<span><b>短信接收人</b>：</span>
				<span><label><input name="Fruit3" type="checkbox" value="<?php echo ($data['User']['tel']); ?>" class="phone" <?php if($data['mess_rec_mans'][0] == $data['User']['tel']): ?>checked="checked"<?php endif; ?> /><?php echo ($data['User']['tel']); ?></label> </span>
				<span><label><input name="Fruit3" type="checkbox" value="<?php echo ($data['order_info_tclxr'][1]); ?>" class="phone" <?php if($data['mess_rec_mans'][1] == $data['order_info_tclxr'][1]): ?>checked="checked"<?php endif; ?> /><?php echo ($data['order_info_tclxr'][1]); ?></label> </span> 
				<span><label><input name="Fruit3" type="checkbox" value="<?php echo ($data['order_info_sclxr'][1]); ?>" class="phone" <?php if($data['mess_rec_mans'][2] == $data['order_info_sclxr'][1]): ?>checked="checked"<?php endif; ?> /><?php echo ($data['order_info_sclxr'][1]); ?></label> </span>
				
			</div>
			<div  class="onteytc5">
			<textarea id="textaa" placeholder="请输入备注信息"></textarea>
			</div>
			</div>
			<input type="hidden" value="<?php echo ($data['order_info_zj']/100); ?>" id="order_info_zj" />
		</div>
		<div class="sad1">
			<button style="margin-left:8px;" class="btn btn-default9" type="button" onclick="sh('Y')">审核通过</button>
			<button class="btn btn-default8" type="button" onclick="sh('N')">审核不通过</button>
		</div>
	</div>
</div>
<div id="myModa3" style="display:none; z-index:9999" class="tan1">
	<div class="tan11 tan66">
	<a class="closed">X</a>
		
		<div class="dw2 onteytc6">
			<div class="tab-content"> 
				<div class="onteytc5 " id="dsdsd">
					<span class="tab-pane1"><label><input name="Fruit7" type="radio" value="A" checked class="yd_type"/>提车</label></span> 
					<span class="tab-pane1"><label><input name="Fruit7" type="radio" value="B" class="yd_type"/>提短</label></span>
					<span class="tab-pane1"><label><input name="Fruit7" type="radio" value="C" class="yd_type"/>公司发运</label></span>
					<span class="tab-pane1"><label><input name="Fruit7" type="radio" value="D" class="yd_type"/>个人发运</label></span>
					<span class="tab-pane1"><label><input name="Fruit7" type="radio" value="E" class="yd_type"/>送车</label></span>
				</div>
			</div>
			<div class="prodta4">
				<ul>
				<!-- 提车 -->
					<li class="on">
				
						<div class="dfd dss1">
						<span>地点选择：</span>	
						<select class="select1" name="sprovince" id="provinceT">
										<option value="" selected="selected">请选择省</option>
										<?php if(is_array($provincea)): foreach($provincea as $key=>$vo): ?><option value="<?php echo ($vo['area_id']); ?>"><?php echo ($vo['area_name']); ?></option><?php endforeach; endif; ?>
									</select>
									<select class="select1" name="scity" id="cityT"><option value="0">请选择市</option></select>
							
						</div>
						<div class="dss11">
							<span>操作员：</span>
							<input type="text" oninput="myFunction('jiu1','ty1',this)"  id="ty1" style="width:200px;" class="input2" value="">
							<div id="jiu1" class="jiu1"></div>
							
						</div>
						<div class="dss1">
							<span>身份证：</span>
							<input type="text" class="input2 ty1" size="25" style="width:200px;" value="" id="ty11">
						</div>
						<div class="dss1">
							<h2><span>承运线路：</span><input type="text" class="input2" value="" id="yd_lineA"/></h2>
							<h2><span>费用：</span><input type="text" class="input2" value="" id="yd_priceA"/></h2>
						</div>
						<!-- <div class="dss1">
							<h2><span>接车公里数：</span><input type="text" class="input2" value="" id="yd_j_gongA"/></h2>
							<h2><span> 使用公里数：</span><input type="text" class="input2" value="" id="yd_s_gongA"/></h2>
						</div> -->
						<div class="dss1">
							<span>备  注：</span>
							<textarea class="textarea1" style="height:100px;" id="yd_markA"></textarea>
						</div>
					</li>
					
					<!-- 提短 -->
					<li>
					
							<div class="dfd dss1">
							<span>地点选择：</span>
						<select class="select1" name="sprovince" id="provinceD">
										<option value="" selected="selected">请选择省</option>
										<?php if(is_array($provincea)): foreach($provincea as $key=>$va): ?><option value="<?php echo ($va['area_id']); ?>"><?php echo ($va['area_name']); ?></option><?php endforeach; endif; ?>
									</select>
									<select class="select1" name="scity" id="cityD"><option value="0">请选择市</option></select>
							
						</div>
							<div class="dss11">
							<span>操作员：</span>
							<input type="text" oninput="myFunction('jiu2','ty2',this)"  id="ty2" style="width:200px;" class="input2" value="">
							<div id="jiu2" class="jiu1"></div>
							
						</div>
						<div class="dss1">
							<span>身份证：</span>
							<input type="text" class="input2 ty2" style="width:200px;" value="" id="ty22">
						</div>
						<div class="dss1">
							<span>提车联系人：</span>
							<input type="text" class="input2" placeholder="姓名+电话" id="yd_otherB"/>
						</div>
						<div class="dss1">
							<h2><span>承运线路：</span><input type="text" class="input2" value="" id="yd_lineB"/></h2>
							<h2><span>费用：</span><input type="text" class="input2" value="" id="yd_priceB"/></h2>
						</div>
						<div class="dss1">
							<h2><span>接车公里数：</span><input type="text" class="input2" value="" id="yd_j_gongB"/></h2>
							<h2><span> 使用公里数：</span><input type="text" class="input2" value="" id="yd_s_gongB"/></h2>
						</div>
						<div class="dss1">
								<span>代 支 付</span>
								<?php if(is_array($unPaidList)): foreach($unPaidList as $key=>$vo): ?><span><input name="FruitB" type="checkbox" value="<?php echo ($vo['yd_code']); ?>" class="yd_cover_codeB"/><?php echo ($vo['yd_name']); ?>: <?php echo ($vo['yd_price']/100); ?>元 </span><?php endforeach; endif; ?>
							</div>
						<div class="dss1">
							<span>备  注：</span>
							<textarea  class="textarea1" style="height:100px;" id="yd_markB"></textarea>
						</div>
					</li>
					<!-- 公司发运 -->
					<li>
					
						<div class="prodta4">
						
							
								<div class="dss11">
							<span>公    司：</span>
							<input type="text" oninput="myFunction('jiu4','ty4',this)"  id="ty4" style="width:200px;" class="input2" value="">
							<div id="jiu4" class="jiu1"></div>
							
						</div>
							
							<div class="dss1">
							
								<h2><span>跟踪电话：</span><input type="text" class="input2 ty4" value="" id="ty44"/></h2>
							</div>
							
							<div class="dss1">
								<span>线    路：</span>
								<input type="text" class="input2" value="" id="yd_lineC"/>
							</div>
							<div class="dss1">
								<span>费    用：</span>
								<input type="text" class="input2" value="" id="yd_priceC"/>
							</div>
							<div class="dss1">
								<span>代 支 付</span>
								<?php if(is_array($unPaidList)): foreach($unPaidList as $key=>$vo): ?><span><input name="FruitC" type="checkbox" value="<?php echo ($vo['yd_code']); ?>" class="yd_cover_codeC"/><?php echo ($vo['yd_name']); echo ($vo['yd_price']/100); ?>元 </span><?php endforeach; endif; ?>
							</div>
							<div class="dss1">
								<span>发运状态</span>
								<span><input name="radioC" type="radio" value="A" class="yd_fy_statusC"/>待中转 </span> 
								<span><input name="radioC" type="radio" value="B" class="yd_fy_statusC"/>待到达 </span>
							</div>
							<div class="dss1">
								<span>备  注：</span>
								<textarea id="yd_markC" class="textarea1" style="height:80px;"></textarea>
							</div>
						</div>
					</li>
					
					<!-- 个人发运 -->
					<li>
				
						<div class="prodta4">
						
							<div class="dss11">
							<span>名称：</span>
							<input type="text"  id="ty6" style="width:200px;" class="input2" value="">
							<div id="jiu6" class="jiu1"></div>
						    </div>
							<div class="dss1">
								<h2><span>跟踪电话：</span><input type="text" class="input2 ty6" value="" id="ty66"/></h2>
							</div>
							<div class="dss1">
								<span>线    路：</span>
								<input type="text" class="input2" value="" id="yd_lineD"/>
							</div>
							<div class="dss1">
								<span>费    用：</span>
								<input type="text" class="input2" value="" id="yd_priceD" />
							</div>
							<div class="dss1">
								<span>代 支 付</span>
								<?php if(is_array($unPaidList)): foreach($unPaidList as $key=>$vo): ?><span><input name="FruitD" type="checkbox" value="<?php echo ($vo['yd_code']); ?>" class="yd_cover_codeD"/><?php echo ($vo['yd_name']); echo ($vo['yd_price']/100); ?>元 </span><?php endforeach; endif; ?>
							</div>
							<div class="dss1">
								<span>发运状态</span>
								<span><input name="radioD" type="radio" value="A" class="yd_fy_statusD"/>待中转 </span> 
								<span><input name="radioD" type="radio" value="B" class="yd_fy_statusD"/>待到达 </span>
							</div>
							<div class="dss1">
								<span>备  注：</span>
								<textarea id="yd_markD" class="textarea1" style="height:80px;"></textarea>
							</div>
						</div>
					</li>
					<!-- 送车 -->
						<li>
					
							<div class="dfd dss1">
							<span>地点选择：</span>
						<select class="select1" name="sprovince" id="provinceS">
										<option value="" selected="selected">请选择省</option>
										<?php if(is_array($provincea)): foreach($provincea as $key=>$vo): ?><option value="<?php echo ($vo['area_id']); ?>"><?php echo ($vo['area_name']); ?></option><?php endforeach; endif; ?>
									</select>
									<select class="select1" name="scity" id="cityS"><option value="0">请选择市</option></select>
							
						</div>
						<div class="dss11">
							<span>操作员：</span>
							<input type="text" oninput="myFunction('jiu3','ty3',this)"  id="ty3" style="width:200px;" class="input2" value="">
							<div id="jiu3" class="jiu1"></div>
							
						</div>
						<div class="dss1">
							<span>身份证：</span>
							<input type="text" class="input2 ty3" style="width:200px;" value="" id="ty33">
						</div>
						<div class="dss1">
							<span>送车联系人：</span>
							<input type="text" class="input2" value="" >
						</div>
						<div class="dss1">
							<h2><span>承运线路：</span><input type="text" class="input2" value="" id="yd_lineE"/></h2>
							<h2><span>费用：</span><input type="text" class="input2" value="" id="yd_priceE"/></h2>
						</div>
						<div class="dss1">
							<h2><span>接车公里数：</span><input type="text" class="input2" value="" id="yd_j_gongE"/></h2>
							<h2><span> 使用公里数：</span><input type="text" class="input2" value="" id="yd_s_gongE"/></h2>
						</div>
						<div class="dss1">
								<span>代 支 付</span>
								<?php if(is_array($unPaidList)): foreach($unPaidList as $key=>$vo): ?><span><input name="FruitE" type="checkbox" value="<?php echo ($vo['yd_code']); ?>" class="yd_cover_codeE"/><?php echo ($vo['yd_name']); echo ($vo['yd_price']/100); ?>元 </span><?php endforeach; endif; ?>
							</div>
						<div class="dss1">
							<span>备  注：</span>
							<textarea  class="textarea1" style="height:100px;" id="yd_markE"></textarea>
						</div>
					</li>
				</ul>
			</div>
			<script>
				$('.tab-content .tab-pane1').click(function(){
					$(this).addClass('on').siblings().removeClass('on');
					$('.prodta4 ul li').eq($(this).index()).fadeIn(300).siblings().hide();
				});
			</script>
		</div>
		<div class="saddd">
			<button  class="btn btn-default22" type="button" id="confirm">确认提车员</button> <a href="/Back/Logistics/driverShow">司机列表</a>
		</div>
	</div>
</div>
<!-- 位置跟踪 -->
<div id="myModa9" style="display:none; z-index:9999" class="tan1">
	<div class="tan11 tan66">
		<a class="closed">X</a>
		<h2>位置跟踪</h2>
	</div>
	<div class="onteytc7">
		<span id="position1">您托运的<?php echo ($data['order_info_brand']); ?>车，已到达</span>
		<input type="text" class="text25" value="北京发运中心" id="position2"/>
		<span>，订单信息每天下午更新（周日除外），下单确认妥妥运车唯一官方400电话：400-8771107。</span>
	</div>
	<div class="sad1 onteytc8">
		<button style="margin-left:8px;" class="btn btn-default23" type="button" id="position">确定</button>
	</div>
</div>
<!-- 已交车 -->
<div id="myModa7" style="display:none; z-index:9999" class="tan1">
	<div class="tan11 tan66">
		<a class="closed">X</a>
		<h2>确认收车</h2>
	</div>
	<?php if($unpaidCount != 0): ?><div class="dss1">
		<span>代收方：</span>
		<input type="text" class="text25 income" value="">
	</div><?php endif; ?>
	<?php if($data['receipt'] == 'Y'): ?><div class="dss1">
		<span>回单人：</span>
		<input type="text" class="text25 hui_man" value="">
	</div><?php endif; ?>
	<div class="dss1">
		<span style="width:auto;">需安排回访</span>
		<input name="Fruit" type="checkbox" value="Y" class="visit" checked="checked"/>
	</div>
	<div class="sad1 onteytc8">
		<button style="margin-left:8px;" class="btn btn-default23" type="button" id="shou">确认用户收车</button>
	</div>
</div>
<!-- 待回访 -->
<div id="myModa8" style="display:none; z-index:9999" class="tan1">
	<div class="tan11 tan66">
		<a class="closed">X</a>
		<h2>待回访</h2>
	</div>
	<div class="dss1 onteytc9">
		<span> 回访备注:</span>
		<textarea id="conts"></textarea>
	</div>
	<div class="sad1 onteytc8">
		<button style="margin-left:8px;" class="btn btn-default23" type="button" id="fang">确认回访</button>
	</div>
</div>
<div id="myModa1000" style="display:none; z-index:9999" class="tan1">
	<div class="tan11 tan66">
		<a class="closed">X</a>
		<h2>订单作废</h2>
	</div>
	<div class="dss1 onteytc9">
		<span>备注:</span>
		<textarea id="del_conts"></textarea>
	</div>
	<div class="sad1 onteytc8">
		<button style="margin-left:8px;" class="btn btn-default23" type="button" id="delOrder">确认</button>
	</div>
</div>
</div>
<!-- 价格组成 -->
<div id="tan1" style="display:none; z-index:9999" class="tan1">
	<div class="tan11 tan66">
		<a class="closed">X</a>
		<h2>价格组成</h2>
	</div>
	<div class="base1">
		<span>运输费：</span>
		<span><?php echo ($data['yc']); ?></span>
	</div>
	<div class="base1">
		<span>集 &nbsp; 散：</span>
		<span><?php echo ($data['js']); ?></span>
	</div>
	<div class="base1">
		<span>提&nbsp; 车：</span>
		<span><?php echo ($data['tc']); ?></span>
	</div>
	<div class="base1">
		<span>送 &nbsp; 车：</span>
		<span><?php echo ($data['sc']); ?></span>
	</div>
		<div class="base1">
		<span>上 &nbsp; 门：</span>
		<span><?php echo ($data['sm']); ?></span>
	</div>
		<div class="base1">
		<span>毛 &nbsp; 利：</span>
		<span><?php echo ($data['ml']); ?></span>
	</div>
	<div class="sad1 onteytc8">
		<button style="margin-left:8px;" class="btn btn-default22" type="button" onclick="window.location.reload()">确认</button>
	</div>
</div>
<!--打印合同-->
<div id="myModa4" style="display:none; z-index:9999" class="tan1">
<div class="tan11">
<a class="closed">X</a>
<h2>打印合同</h2>
<dl>&nbsp;</dl>
<p></p>
<p>
<input type="button" class="put2" onclick="printpact('<?php echo ($data["order_code"]); ?>')" value="打印">
</p>
</div>

</div>
<!--上传保险单-->
<div id="myModa5" style="display:none; z-index:9999" class="tan1">
<div class="tan11">
<a class="closed">X</a>
<h2>上传保单</h2>
<dl class="ttt">
<b id="scfile">点击上传保险表单</b>
<input type="hidden" id="pic" name="portrait" value="">
<div id="upload" style="display:none;"></div>
<button  id="oneclick" style="float:right;margin-right:-12px;" class="btn btn-default5" type="button">上传</button>
</dl>
<div class="CDa"></div>
<!-- <dl>
<input type="text" id="bxdtime" placeholder="年/月/日/时/分/秒" value="" readonly="readonly" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" onfocus="if(this.value==defaultValue){this.value=''}" onblur="if(this.value==''){this.value=defaultValue}" class="put1"></dl> -->

<p>
<input type="submit" class="put2" id="scbxd" value="确认"></p>
</div>
</div>
<!--已到达-->
<div id="myModa6" style="display:none; z-index:9999" class="tan1">
<div class="tan11">
<a class="closed">X</a>
<h2>请确认是否已到达</h2>
<dl>&nbsp;</dl>
<p></p>
<p>
<input type="button" class="put2" id="arrive" value="确认">
</p>
</div>

</div>

<!--回单已回-->
<div id="myModa10" style="display:none; z-index:9999" class="tan1">
<div class="tan11">
<a class="closed">X</a>
<h2>请确认是否已回单</h2>
<dl>&nbsp;</dl>
<p></p>
<p>
<input type="button" class="put2" id="conHui" value="确认">
</p>
</div>

</div>
<!-- 修改总价 -->
<div id="tan2" style="display:none; z-index:9999" class="tan1">
	<div class="tan11 tan66">
		<a class="closed">X</a>
		<h2>总价修改</h2>
	</div>
	<div class="base1">
		<span>总价：</span>
		<input name="Fruit" type="text" value="<?php echo ($data['order_info_zj']/100); ?>" id="order_info_zj_edit"/>
	</div>
	
	<div class="sad1 onteytc8">
		<button style="margin-left:8px;" data-mark='UPPRICE' data-pr="<?php echo ($data['order_info_zj']/100); ?>" class="btn btn-default22 zj" type="button">确认</button>
		<button style="margin-left:8px;" class="btn btn-default24" type="button">取消</button>
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
<!--tanchuceng-->





<div id="ggg1" style="display:none; z-index:9999" class="tan1">
	<div class="tan11 tan66">
		<a class="closed">X</a>
		<h2>修改</h2>
	</div>
	<div class="onteyta41">
		<input name="Fruit" type="text" class="input1" value="" />
	</div>
	<div class="sad1 onteytc8">
		<button style="margin-left:8px;" class="btn btn-default22" data-targe="input1" type="button">确认</button>
	</div>
</div>


<div id="ggg2" style="display:none; z-index:9999" class="tan1">
	<div class="tan11 tan66">
		<a class="closed">X</a>
		<h2>修改</h2>
	</div>
	<!-- <div class="onteyta42">
	<select class="select1" name="sprovince" id="province2">
		<?php if(is_array($provincea)): $i = 0; $__LIST__ = $provincea;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$va): $mod = ($i % 2 );++$i;?><option value="<?php echo ($va['area_id']); ?>" class="pro" data-target="<?php echo ($va['area_name']); ?>" <?php if($data['order_info_ends'][0] == $va['area_name']): ?>selected="selected"<?php endif; ?>><?php echo ($va['area_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
	</select>
	<select class="select1" name="scity" id="city2"></select>
	</div> -->
	<div class="pay1" style="text-align:center;width:100%;float:none;margin-bottom:20px;">
															<dd style="float:none;display:inline-block;text-align:left;">
																<input type="text" placeholder="请选择省份" id="provincea1" value="<?php echo ($data['pe']); ?>"/>
																<div class="pay2" id="pay1">
																	<ul id ="s11">
																		<?php if(is_array($provincea)): $i = 0; $__LIST__ = $provincea;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><li data1="<?php echo ($vv["area_name"]); ?>" data2="<?php echo ($vv["area_id"]); ?>" onclick='changeShi1(this)'><h2><?php echo ($vv["area_name"]); ?></h2></li><?php endforeach; endif; else: echo "" ;endif; ?>
																	
																	</ul>
																</div>
															</dd>
															<dd  style="float:none;display:inline-block;text-align:left;">
																<input type="text" placeholder="请选择市" id="city1" value="<?php echo ($data['ce']); ?>"/>
																<div class="pay2" id="pay2">
																	<ul id ="s21">
																		
																		
																	</ul>
																</div>
															</dd>
														
														</div>
														<input type="hidden" value="<?php echo ($data['order_info_end_num'][0]); ?>" id="pro1"/>
														<input type="hidden" value="<?php echo ($data['order_info_end_num'][1]); ?>" id="cit1"/>
														<input type="hidden" value="<?php echo ($data['pe']); ?>" id="pro_name1"/>
														<input type="hidden" value="<?php echo ($data['ce']); ?>" id="cit_name1"/>
	<div class="sad1 onteytc8">
		<button style="margin-left:8px;" class="btn btn-default22" type="button">确认</button>
	</div>
</div>
<script>
															
															
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
																$('#pro_name1').val(''+$(obj).attr('data1')+'');
																
																$('#city1').val('');
																$('#cit1').val('');
																$('#cit_name1').val('');
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
																$('#cit_name1').val(city_name);
																
																$('#county1').val('');
																$('#cou1').val('');
																$('$cou_name1').val('');
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
														     $('#county1').bind('input propertychange', function() { 
															    //搜索省份
															     var name =$('#county1').val();
															     var pid =$('#cit1').val(); 
															     $('#s31').children().remove();
																 $.post('/Back/Product/get_area_bycon', {name:name,pid:pid}, function(data) {
					                                                    var _html = "";
					                                                    for (var i = 0; i < data.length; i++) {
					                                                        _html += "<li data1="+data[i]['area_name']+" data2="+data[i]['area_id']+" onclick='changeQu1(this)'><h2>"+data[i]['area_name']+"</h2></li>";
					                                                    }
					                                                    $('#s31').append(_html);
					                                                },'json');
															
														     })
														</script>
<div id="ggg3" style="display:none; z-index:9999" class="tan1">
	<div class="tan11 tan66">
		<a class="closed">X</a>
		<h2>修改</h2>
	</div>
	<!-- <div class="onteyta43">
	     <select class="select1" name="sprovince" id="province1">
	        <?php if(is_array($provincea)): $i = 0; $__LIST__ = $provincea;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$va): $mod = ($i % 2 );++$i;?><option value="<?php echo ($va['area_id']); ?>" data-target="<?php echo ($va['area_name']); ?>" class="pro" <?php if($data['order_info_stars'][0] == $va['area_name']): ?>selected="selected"<?php endif; ?> ><?php echo ($va['area_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		</select>
		<select class="select1" name="scity" id="city1"></select>
		<select class="select1" name="scity" id="county1"></select>
	</div> -->
												<div class="pay1" style="text-align:center;width:100%;float:none;margin-bottom:20px;">
															<dd style="float:none;display:inline-block;text-align:left;">
																<input type="text" placeholder="请选择省份" id="provincea" value="<?php echo ($data['p']); ?>"/>
																<div class="pay2" id="pay1">
																	<ul id ="s1">
																		<?php if(is_array($provincea)): $i = 0; $__LIST__ = $provincea;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><li data1="<?php echo ($vv["area_name"]); ?>" data2="<?php echo ($vv["area_id"]); ?>" onclick='changeShi(this)'><h2><?php echo ($vv["area_name"]); ?></h2></li><?php endforeach; endif; else: echo "" ;endif; ?>
																	
																	</ul>
																</div>
															</dd>
															<dd  style="float:none;display:inline-block;text-align:left;">
																<input type="text" placeholder="请选择市" id="city" value="<?php echo ($data['c']); ?>"/>
																<div class="pay2" id="pay2">
																	<ul id ="s2">
																		
																		
																	</ul>
																</div>
															</dd>
															<dd style="float:none;display:inline-block;text-align:left;">
																<input type="text" placeholder="请选择区" id="county" value="<?php echo ($data['b']); ?>"/>
																<div class="pay2"  id="pay3">
																	<ul id ="s3">
																		
																	</ul>
																</div>
															</dd>
														</div>
														<input type="hidden" value="<?php echo ($data['order_info_star_num'][0]); ?>" id="pro"/>
														<input type="hidden" value="<?php echo ($data['order_info_star_num'][1]); ?>" id="cit"/>
														<input type="hidden" value="<?php echo ($data['order_info_star_num'][2]); ?>" id="cou"/>
														<input type="hidden" value="<?php echo ($data['p']); ?>" id="pro_name"/>
														<input type="hidden" value="<?php echo ($data['c']); ?>" id="cit_name"/>
														<input type="hidden" value="<?php echo ($data['b']); ?>" id="cou_name"/>
	<div class="sad1 onteytc8">
		<button style="margin-left:8px;" class="btn btn-default22" type="button">确认</button>
	</div>
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
																$('#pro_name').val(''+$(obj).attr('data1')+'');
																
																$('#city').val('');
																$('#cit').val('');
																$('#cit_name').val('');
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
																$('#cit_name').val(city_name);
																
																$('#county').val('');
																$('#cou').val('');
																$('$cou_name').val('');
															}
														
															function changeQu(obj){
																$('#county').append().val(''+$(obj).attr('data1')+'');
																$('#cou').val($(obj).attr('data2'));
																$('#cou_name').val(''+$(obj).attr('data1')+'');
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

<div id="ggg4" style="display:none; z-index:9999" class="tan1">
	<div class="tan11 tan66">
		<a class="closed">X</a>
		<h2>修改</h2>
	</div>
	<div class="onteyta44">
        <textarea class="textarea1 vertext"></textarea>
	</div>
	<div class="sad1 onteytc8">
		<button style="margin-left:8px;" class="btn btn-default22" data-targe="vertext" type="button">确认</button>
	</div>
</div>

<div id="ggg5" style="display:none; z-index:9999" class="tan1">
	<div class="tan11 tan66">
		<a class="closed">X</a>
		<h2>修改</h2>
	</div>
	<div class="onteyta44">
        <input type="radio" value="W" name="pay" class="pay" <?php if($data['pay_status'] == 'W'): ?>checked="checked"<?php endif; ?> >未支付
        <input type="radio" value="Y" name="pay" class="pay" <?php if($data['pay_status'] == 'Y'): ?>checked="checked"<?php endif; ?>>已支付
        	</div>
	<div class="sad1 onteytc8">
		<button style="margin-left:8px;" class="btn btn-default22 " data-targe="vertext" type="button" id="change_pay">确认</button>
	</div>
</div>

<div id="bg" class="bg" style="display:none;"></div>
<input type="hidden" id="key" />
<script>
//运费价格查看
function fuCheckYunPrice(){
	$.post("/Back/Orderyjh/checkYunPrice",{},function(data){
		if(!data.flag){
			layer.msg(data);
		}else{
			var obj = $('.yd3');
			var size = obj.length;
			for(var i=0;i<size;i++){
				obj.eq(i).val(obj.eq(i).attr("data-val"));
			}
			
		}
	},'json');
}
//修改价格
function fuUpPrice(){
	$.post("/Back/Orderyjh/fuUpPrice",{},function(data){
		if(!data.flag){
			layer.msg(data);
		}else{
			$("#tan2").show();
			$('#bg').show();
		}
	},'json');
}
//价格查看
function fuPrice(){
	$.post("/Back/Orderyjh/checkPrice",{},function(data){
		if(!data.flag){
			layer.msg(data);
		}else{
			$("#tan1").show();
			$('#bg').show();
		}
	},'json');
}
//复制验车信息
var clipboard = new Clipboard('#car_check');
function checkCarFun(){
	var url = '<?php echo ($path); ?>/Front/MyOrder/verifyCar/code/<?php echo ($data["order_code"]); ?>';
	$('#car_check_val').html(url);
	clipboard.on('success', function(e) {
		layer.msg("复制成功");
	});
	clipboard.on('error', function(e) {
		layer.msg("复制是失败");
    });
}
$("#change_pay").click(function(){
	var order_code ="<?php echo ($data['order_code']); ?>";
	var pay_status =$("input[name='pay']:checked").val();
	$.post("/Back/Orderyjh/editOrder",{order_code:order_code,pay_status:pay_status},function(data){
		if(data){
			window.location.reload();
  		}else{
  			layer.msg("数据未改变");
  			return false;
  		}
	})
});
$("#change").click(function(){
	$("#ggg5").css("display","block");
})
//确认提车
function querenFun(yd_id){
	$.post("/Back/Orderyjh/completeYunDan",{yd_id:yd_id},function(data){
		if(data){
			window.location.reload();
  		}else{
  			layer.msg("确认失败");
  			return false;
  		}
	})
}
$("#province1").change(function(event) {
    var provinceid = $(this).val();
    $(".delc").remove();
    $.post('/Back/Product/area_act', {provinceid: provinceid}, function(data) {
        var _html = "";
        for (var i = 0; i < data.length; i++) {
            _html += "<option value="+data[i]['area_id']+" class='delc' data-target='"+data[i]['area_name']+"'>"+data[i]['area_name']+"</option>";
        }
        $('#city1').append(_html);
    },'json');
});
//获取区县
$('#city1').click(function(event) {
    var city = $(this).val();
    $(".delb").remove();
    $.post('/Back/Product/area_act', {provinceid: city}, function(data) {
        var _html = "";
        for (var i = 0; i < data.length; i++) {
            _html += "<option value="+data[i]['area_id']+" class='delb' data-target='"+data[i]['area_name']+"'>"+data[i]['area_name']+"</option>";
        }
        $('#county1').append(_html);
    },'json');
});

$("#province2").change(function(event) {
    var provinceid = $(this).val();
    $(".delc").remove();
    $.post('/Back/Product/area_act', {provinceid: provinceid}, function(data) {
        var _html = "";
        for (var i = 0; i < data.length; i++) {
            _html += "<option value="+data[i]['area_id']+" class='delc' data-target='"+data[i]['area_name']+"'>"+data[i]['area_name']+"</option>";
        }
        $('#city2').append(_html);
    },'json');
});
//提车获取市
$("#provinceT").change(function(event) {
    var provinceid = $(this).val();
    $(".delc").remove();
    $.post('/Back/Product/area_act', {provinceid: provinceid}, function(data) {
        var _html = "";
        for (var i = 0; i < data.length; i++) {
            _html += "<option value="+data[i]['area_id']+" class='delc' data-target='"+data[i]['area_name']+"'>"+data[i]['area_name']+"</option>";
        }
        $('#cityT').append(_html);
    },'json');
    $.post("/Back/Orderyjh/getCarList",{proid:provinceid,cityid:'N',text:'N'},function(data){
    	$("#jiu1").html('');
    	var len=data.length;
		var str='<ul>';
		for(var i=0;i<len;i++){
			str="<li onclick='set('ty1','"+data[i]['car_name']+"','"+data[i]['car_tel']+"',this,"+data[i]['car_identity']+")'>"+data[i]['car_name']+','+data[i]['car_tel']+"</li>";
		}
		str+="</ul>";
        $("#jiu1").html(str);
	});
});
$("#cityT").change(function(event){
	pro=$("#provinceT").val();
	city=$(this).val();
	$.post("/Back/Orderyjh/getCarList",{proid:pro,cityid:city,text:'N'},function(data){
		var len=data.length;
		var str='<ul>';
		for(var i=0;i<len;i++){
			str="<li onclick='set('ty1',"+data[i]['car_name']+','+data[i]['car_tel']+",this)'>"+data[i]['car_name']+','+data[i]['car_tel']+"</li>";
		}
		str+="</ul>";
        $("#jiu1").html(str);
	});
})
//提短获取市
$("#provinceD").change(function(event) {
    var provinceid = $(this).val();
    $(".delc").remove();
    $.post('/Back/Product/area_act', {provinceid: provinceid}, function(data) {
        var _html = "";
        for (var i = 0; i < data.length; i++) {
            _html += "<option value="+data[i]['area_id']+" class='delc' data-target='"+data[i]['area_name']+"'>"+data[i]['area_name']+"</option>";
        }
        $('#cityD').append(_html);
    },'json');
    $.post("/Back/Orderyjh/getCarList",{proid:provinceid,cityid:'N',text:'N'},function(data){
		var len=data.length;
		var str='<ul>';
		for(var i=0;i<len;i++){
			str="<li onclick='set('ty2',"+data[i]['car_name']+','+data[i]['car_tel']+",this)'>"+data[i]['car_name']+','+data[i]['car_tel']+"</li>";
		}
		str+="</ul>";
        $("#jiu2").html(str);
	});
});
$("#cityD").change(function(event){
	pro=$("#provinceD").val();
	city=$(this).val();
	$.post("/Back/Orderyjh/getCarList",{proid:pro,cityid:city,text:'N'},function(data){
		var len=data.length;
		var str='<ul>';
		for(var i=0;i<len;i++){
			str="<li onclick='set('ty2',\""+data[i]['car_name']+','+data[i]['car_tel']+"\",this)'>"+data[i]['car_name']+','+data[i]['car_tel']+"</li>";
		}
		str+="</ul>";
        $("#jiu2").html(str);
	});
})
<!-- 送车 -->
//提短获取市
$("#provinceS").change(function(event) {
    var provinceid = $(this).val();
    $(".delc").remove();
    $.post('/Back/Product/area_act', {provinceid: provinceid}, function(data) {
        var _html = "";
        for (var i = 0; i < data.length; i++) {
            _html += "<option value="+data[i]['area_id']+" class='delc' data-target='"+data[i]['area_name']+"'>"+data[i]['area_name']+"</option>";
        }
        $('#cityS').append(_html);
    },'json');
    $.post("/Back/Orderyjh/getCarList",{proid:provinceid,cityid:'N',text:'N'},function(data){
    	
		var len=data.length;
		var str='<ul>';
		for(var i=0;i<len;i++){
			str="<li onclick='set('ty3',"+data[i]['car_name']+','+data[i]['car_tel']+",this)'>"+data[i]['car_name']+','+data[i]['car_tel']+"</li>";
		}
		str+="</ul>";
        $("#jiu3").html(str);
	});
});
$("#cityS").change(function(event){
	pro=$("#provinceS").val();
	city=$(this).val();
	$.post("/Back/Orderyjh/getCarList",{proid:pro,cityid:city,text:'N'},function(data){
		var len=data.length;
		var str='<ul>';
		for(var i=0;i<len;i++){
			str="<li onclick='set('ty3',\""+data[i]['car_name']+','+data[i]['car_tel']+"\",this)'>"+data[i]['car_name']+','+data[i]['car_tel']+"</li>";
		}
		str+="</ul>";
        $("#jiu3").html(str);
	});
})
 //<!-- 联系人搜索 -->
function myFunction(t,m,obj){
	var text=$(obj).val();
	if(text!=''){
		$("#"+t).html('');
		if(t=='jiu4'||t=='jiu8'){
			$.post("/Back/Orderyjh/getCompanyList",{text:text},function(data){
				var len=data.length;
				var str="<ul>";
				for(var i=0;i<len;i++){
					str+="<li onclick='set(\""+m+"\",\""+data[i]['lc_name']+"\",this,"+data[i]['lc_gen_tel']+")'>"+data[i]['lc_name']+"</li>";
				}
				str+="</ul>";
				$("#"+t).html(str);
			})
		}else if(t=='jiu6'){
			$.post("/Back/Orderyjh/getCarList",{proid:'N',cityid:'N',text:text},function(data){
				var len=data.length;
				var str="<ul>";
				for(var i=0;i<len;i++){
					str+="<li onclick='set(\""+m+"\",\""+data[i]['car_name']+"\",this,"+data[i]['car_tel']+")'>"+data[i]['car_name']+"</li>";
				}
				str+="</ul>";
				$("#"+t).html(str);
			})
		}else{
			$.post("/Back/Orderyjh/getCarList",{proid:'N',cityid:'N',text:text},function(data){
				var len=data.length;
				var str="<ul>";
				for(var i=0;i<len;i++){
					str+="<li onclick='set(\""+m+"\",\""+data[i]['car_name']+","+data[i]['car_tel']+"\",this,\""+data[i]['car_identity']+"\")'>"+data[i]['car_name']+","+data[i]['car_tel']+"</li>";
				}
				str+="</ul>";
				$("#"+t).html(str);
			})
		}
		
	}
	
}
function set(m,n,obj,iden){
 $("#"+m).val(n);
 $("."+m).val(iden);
$(obj).parent().remove();
}
<!-- 删除图片 -->
function del(t,obj){
	$.ajax({
		   url:"/Back/Orderyjh/delVerImg",
		   async:false,
		   type:'post',
		   data:'verify_img_id='+t,
		   dataType:'json',
		   success: function(data){
			   if(data.flag){
				   $(obj).parent().remove();
			   }else{
				   layer.msg(data.msg);
				   return false;
			   }
		   }
	   });
  

}

<!-- 插如图片 -->
var up = $('#upload1').Huploadify({
	auto:true,
	fileTypeExts:'*.jpg;*.gif;*.png;*.jpeg',
	multi:false,
	fileSizeLimit:102400,
	showUploadedPercent:false,
	showUploadedSize:false,
	removeTimeout:1000,
	abs:1,
	canshu:'XWZX',
	uploader:'<?php echo U("Base/upload");?>',
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
			var url=datas.fileurl;
			$("#hidimg").val(url);
			var code="<?php echo ($code); ?>";
			var ver_code="<?php echo ($verify['verify_code']); ?>";
			if(ver_code==''||ver_code==null){
				layer.msg('请先添加详细信息');
				return false;
			}
			$.ajax({
				   url:"/Back/Orderyjh/verifyImg",
				   async:false,
				   type:'post',
				   data:'order_code='+code+'&verify_img_upload='+url+'&verify_code='+ver_code,
				   dataType:'json',
				   success: function(data){
					   if(data!=''){
					        var star='<div class="chek1"><img src="'+url+'"><a class="del" onclick="del('+data+',this)"><img src="/Public/Back/images/timg.png"></a><input name="img[]" value="/Public/Back/images/che1.png" type="hidden"></div>';
					        $("#addImg").before(star);
					   }
				   }
			   });
			
		}else{
			layer.msg(datas.msg);
		}
	},
});
$("#addImg").click(function(){
	$("#file_upload_1-button").click();
})
 

//  type  弹出类型   1 input,2 select,3 textarea
//   num   个数       1,2,3
//   obj    本身
//   order_id    订单编号
//   val    原数据值

  function  setdiv(mark,type,num,db,key,val,obj){
	$("#log_mark").val(mark);
	$("#cont_qian").val(val);
	var code="<?php echo ($code); ?>";
	var formToken="<?php echo ($formToken); ?>";
	$("#key").val();
  	if(type=='input'){
		$(".input1").val(val);
    	$("#ggg1").show();
  	}
 
  if(type=='select' && num==2){
	  var arr=val.split(",");
      var sec=arr[0];
      var thr=arr[1];
	    $.post('/Back/Product/area_act', {provinceid: sec}, function(data) {
	        var _html1 = "";
	        for (var i = 0; i < data.length; i++) {
	        	if(data[i]['area_id']==thr){
	        		_html1 += "<option value="+data[i]['area_id']+" selected='selected' class='delc' data-target='"+data[i]['area_name']+"'>"+data[i]['area_name']+"</option>";
	        	}else{
	        		_html1 += "<option value="+data[i]['area_id']+"  class='delc' data-target='"+data[i]['area_name']+"'>"+data[i]['area_name']+"</option>";
	        	}
	        }
	        $('#city2').append(_html1);
	    },'json');
    $("#ggg2").show();
    
  }
  if(type=='select' && num==3){
	        var arr=val.split(",");
	        var sec=arr[0];
	        var thr=arr[1];
	        var fou=arr[2];
		    $.post('/Back/Product/area_act', {provinceid: sec}, function(data) {
		    	$('#s2').children().remove();
		        var _html1 = "";
		        for (var i = 0; i < data.length; i++) {
		        		_html1 += "<li data1="+data[i]['area_name']+" data2="+data[i]['area_id']+" onclick='changeCity(this)'><h2>"+data[i]['area_name']+"</h2></li>";
		        }
		        $('#s2').append(_html1);
		    },'json');
		    $.post('/Back/Product/area_act', {provinceid: thr}, function(data) {
		    	$('#s3').children().remove();
		        var _html2 = "";
		        for (var i = 0; i < data.length; i++) {
		        		_html2 += "<li data1="+data[i]['area_name']+" data2="+data[i]['area_id']+" onclick='changeQu(this)'><h2>"+data[i]['area_name']+"</h2></li>";
		        	
		        }
		        $('#s3').append(_html2);
		    },'json');
    $("#ggg3").show();

  }
   if(type=='textarea'){
	$(".textarea1").val(val);
    $("#ggg4").show();
  }
 
   $('.bg').show();
   $(".btn-default22").click(function(){
	   var cont_qian = $("#cont_qian").val();
	   if(type=='select' && num==2){
		     var pro= $("#pro_name1").val();
	    	 var cit= $("#cit_name1").val();
	    	 var value= pro+'-'+cit;
	    	 var proid= $("#pro1").val();
	    	 var citid= $("#cit1").val();
	    	 var val= proid+','+citid;
	      }else if(type=='select'&& num==3){
	    	 var pro= $("#pro_name").val();
	    	 var cit= $("#cit_name").val();
	    	 var cou= $("#cou_name").val();
	    	 var value= pro+'-'+cit+'-'+cou;
	    	 var proid= $("#pro").val();
	    	 var citid= $("#cit").val();
	    	 var couid= $("#cou").val();
	    	 var val= proid+','+citid+','+couid;
	      }else{
	    	var cval=$(this).attr('data-targe');
	  	    var val=$('.'+cval).val();
	  	    var val=val.replace(/[\r\n]/g, "");
	  	    if(key=='bill_price'){
	  	    	var bill_price=$("#bill_price").val();
		  	    var dif=parseFloat(val)-parseFloat(bill_price);
		  	    var zj=$("#order_info_zj").val();
		  	    var order_info_zj=parseFloat(zj)+parseFloat(dif);
		  	    $.ajax({
				   url:"/Back/Orderyjh/editOrder",
				   async:false,
				   type:'post',
				   data:'order_code='+code+'&bill_price='+val+'&order_info_zj='+order_info_zj,
				   dataType:'json',
				   success: function(data){
					   if(data.flag){
						   $('#'+key).val(val);
						   window.location.reload();
			    		}else{
			    			layer.msg(data.msg);
			    		}
				   }
			     });
		  	     return false;
	  	    }
	      }
	  if(db=="V"){
		   $.ajax({
			   url:"/Back/Orderyjh/verifyInfo",
			   async:false,
			   type:'post',
			   data:'order_code='+code+'&'+key+'='+val+'&formToken='+formToken,
			   dataType:'json',
			   success: function(data){
				   if(data.flag){
		    			if(type=='input'){
		    				$('#'+key).val(val);
		    			}else{
		    				$('#'+key).html(val);
		    			}
		    			window.location.reload();	
		    		}else{
		    			layer.msg(data.msg);
		    		}
			   }
		   });
	    }else{
	    	 $.ajax({
				   url:"/Back/Orderyjh/editOrder",
				   async:false,
				   type:'post',
				   data:'order_code='+code+'&'+key+'='+val+'&log_mark='+mark+'&cont_qian='+cont_qian+'&keys='+key,
				   dataType:'json',
				   success: function(data){
					   if(data.flag){
						   if(type=='select'){
							   $('#'+key).html(value);
						   }else{
							   $('#'+key).html(val);
				    		   $('#'+key).val(val);
						   }
						   window.location.reload();
			    		}else{
			    			layer.msg(data.msg);
			    		}
				   }
			   });
	    } 
	    $(".closed").click();
   })
  }
  $(".closed").click(function(){
	  $("#ggg1").hide();
	  $("#ggg2").hide();
	  $("#ggg3").hide();
	  $("#ggg4").hide();
	  $('.bg').hide(); 
	  /* window.location.reload();*/
  });
  <!-- 发送短信 -->
  $(".sendMessage").click(function(){
	  var phone=$(this).attr("data-targe");
	  var cont=$(this).attr("data-content");
	  var id=$(this).attr("data-id");
	  var code = $(this).attr("data-code");
	  $.post("/Back/Orderyjh/sendMessage",{phone:phone,content:cont,id:id,code:code},function(data){
		  if(data.flag){
			  window.location.reload();
		  }else{
			  layer.msg(data.msg);
		  }
	  });
  });
  <!-- 运单修改 -->
  $(".sa1").click(function(){
  $(this).hide();
  $(this).siblings('.sa2').show();
  var obj = $(this).parent().siblings('td').find('input');
  var size = obj.length;
  for(var i=0;i<size;i++){
	  if(obj.eq(i).val() != "*"){
		  obj.eq(i).attr('disabled',false);
	  }
  }
  
  
  });
  
  $(".sa2").click(function(){
  $(this).hide();
  $(this).siblings('.sa1').show();
  $(this).parent().siblings('td').find('input').attr('disabled','disabled');
  var obj=$(this).parent().parent();
  var yd_code=obj.find('.yd_code').html();
  var yd_name =obj.find('input[class="yd1"]').val();
  var old_yd_name = obj.find('input[class="yd1"]').attr("data-val");
  var yd_line=obj.find('input[class="yd2"]').val();
  var yd_price=obj.find('input[class="yd3"]').val();
  var yd_j_gong=obj.find('input[class="yd4"]').val();
  var yd_s_gong=obj.find('input[class="yd5"]').val();
  var yd_tel=obj.find('input[class="yd6"]').val();
  var yd_mark=obj.find('input[class="yd7"]').val();
  var order_code = '<?php echo ($code); ?>';
  if(yd_price == '*'){
	  yd_price = obj.find('input[class="yd3"]').attr("data-val");
  }
  $.post("/Back/Orderyjh/editYunDan",{order_code:order_code,old_yd_name:old_yd_name,yd_code:yd_code,yd_name:yd_name,yd_line:yd_line,yd_price:yd_price,yd_j_gong:yd_j_gong,yd_s_gong:yd_s_gong,yd_tel:yd_tel,yd_mark:yd_mark},function(data){
	  	if(!data.flag){
	  		layer.msg(data.msg);
	  	}else{
	  		window.location.reload();
	  	}
     });
  });
  //<!-- 作废运单 -->
  $(".see4").click(function(){
	  if(window.confirm('确定作废运单？')){
			  var yd_code=$(this).attr("data-code");
			  $.post("/Back/Orderyjh/delYunDan",{yd_code:yd_code},function(data){
				  if(data.flag){
					  window.location.reload();
				  }else{
					  layer.msg(data.msg);
					  return false;
				  }
			  })
		}else{
			window.location.reload();
		}
	  
  });
  <!-- 审核其他切换按钮 -->
  $(".pp2").click(function(){
  $(this).siblings('.pp3').show();
  
  });
    $(".pp1").click(function(){
  $(this).siblings('.pp3').hide();
  
  });
  
   
 //修改总价
 $(".zj").click(function(){
	 var code="<?php echo ($code); ?>";
	 var zj=$("#order_info_zj_edit").val();
	 var log_mark = $(this).attr("data-mark");
	 var pr = $(this).attr("data-pr");
	 $.ajax({
		   url:"/Back/Orderyjh/editOrder",
		   async:false,
		   type:'post',
		   data:'order_code='+code+'&order_info_zj='+zj+'&log_mark='+log_mark+'&pr='+pr,
		   dataType:'json',
		   success: function(data){
			   	if(data.flag){
		    	  // $('#order_info_zj_html').val(zj);
				   window.location.reload();
	    		}else{
	    			layer.msg(data.msg);
	    		}
		   }
	   });
 });
//取消修改
$(".btn-default24").click(function(){
	//$("#tan2").css('display','none');
	window.location.reload();
});

</script>
<script>
    $(function(){
        var up = $('#upload').Huploadify({
            auto:true,
            fileTypeExts:'*.pdf',
            multi:false,
            fileSizeLimit:102400,
            showUploadedPercent:false,
            showUploadedSize:false,
            removeTimeout:1000,
            abs:2,//隐藏按钮序号
            uploader:'<?php echo U("Base/file");?>',//上传方法路径
            canshu:'FILE',//特征值:用于进行上传限制
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
                	var order_code="<?php echo ($code); ?>";
                	var url =datas.fileurl;
                    $("#pic").val(datas.fileurl);
                    $('#scfile').html('上传成功！');
                    $.post("/Back/Orderyjh/editOrder",{verify:'Y',order_code:order_code,policy_code:url,mark:"A"},function(datab){
                    	if(datab.flag){
          		    	  	// $('#order_info_zj_html').val(zj);
          				  	window.location.reload();
          	    		}else{
          	    			layer.msg(datab.msg);
          	    		}
                    	
                    })
                    //$("#show").attr('src',datas.fileurl);
                }else{
                    //$.anewlayer.msg(datas.msg);
                	layer.msg(datas.msg);
                }
            },
        });
        $("#oneclick").click(function(){
            $("#file_upload_2-button").click();
        });

    });
    $('.closed').click(function(){

    	$('.modal-backdrop').click();

    });
    $("#scbxd").click(function(){
    	window.location.reload();
    })
</script>
<script>
//审核
function sh(obj){
	var order_code="<?php echo ($code); ?>";
	var jie=$("#jie:checked").val();
	var hui=$("#hui:checked").val();
	var fav=$(".fav:checked").val();
	var cost=$("#cost").val();
	var type=$(".type:checked").val();
	var company=$("#company").val();
	var phones = $("input[name='Fruit3']:checked");
	var phone = '';
	for(var i=0;i<phones.length;i++){
		phone += phones.eq(i).val()+';';
	}
	var remark=$("#textaa").val();
	var order_info_zj=$("#order_info_zj").val();
	var ti_car_time = $("#ti_car_time").val();
	if(jie==''||jie==null){
		jie ='N';
	}
	if(hui==''||hui==null){
		hui='N';
	}
	if(fav=='A'||fav=='B'){
		cost=0;
	}
	if(obj=='N'){
		if(remark==''){
			layer.msg('请输入审核备注');
			return false;
		}
	}
	$.post("/Back/Orderyjh/auditing",{ti_car_time:ti_car_time,is_yuej:jie,receipt:hui,bill_type:fav,bill_price:cost,busin_type:type,company:company,mess_rec_man:phone,sh_status:obj,sh_bei:remark,order_code:order_code,order_info_zj:order_info_zj},function(data){
		if(data.flag){
			window.location.reload();
		}else{
			layer.msg(data.msg);
		}
	})
}
//提车
$("#confirm").click(function(){
	var order_code="<?php echo ($code); ?>";
	var yd_type=$(".yd_type:checked").val();
	if(yd_type=='A'){
		var yd1=$("#ty1").val();
		var arr=yd1.split(",");
		var yd_name=arr[0];
		var yd_tel=arr[1];
	    var yd_indetity=$("#ty11").val();
	    var yd_line=$("#yd_lineA").val();
	    var yd_price=$("#yd_priceA").val();
	    var yd_j_gong=$("#yd_j_gongA").val();
	    var yd_s_gong=$("#yd_s_gongA").val();
	    var yd_mark=$("#yd_markA").val();
	    var order_status='T';
	}else if(yd_type=='B'){
		var yd2=$("#ty2").val();
		var arr=yd2.split(",");
		var yd_name=arr[0];
		var yd_tel=arr[1];
	    var yd_indetity=$("#ty22").val();
		var yd_other=$("#yd_otherB").val();
		var yd_line=$("#yd_lineB").val();
		var yd_price=$("#yd_priceB").val();
		var yd_j_gong=$("#yd_j_gongB").val();
		var yd_s_gong=$("#yd_s_gongB").val();
		var yd_cover_code='';
		var yd_cov=$("input[name='FruitB']:checked").each(function(){
			yd_cover_code+=$(this).val()+',';
		});
		var order_status='Y';
		var yd_mark=$("#yd_markB").val();
	}else if(yd_type=='C'){
		var yd_name=$("#ty4").val();
		var yd_tel=$("#ty44").val();
		var yd_line=$("#yd_lineC").val();
		var yd_price=$("#yd_priceC").val();
		var yd_fy_status=$(".yd_fy_statusC:checked").val();
		if(yd_fy_status=='A'){
			var order_status='M';
		}else{
			var order_status='N';
		}
		var yd_cover_code='';
		var yd_cov=$("input[name='FruitC']:checked").each(function(){
			yd_cover_code+=$(this).val()+',';
		});
		var yd_mark=$("#yd_markC").val();
	}else if(yd_type=='D'){
		var yd_name=$("#ty6").val();
		var yd_tel=$("#ty66").val();
		var yd_line=$("#yd_lineD").val();
		var yd_price=$("#yd_priceD").val();
		var yd_fy_status=$(".yd_fy_statusD:checked").val();
		if(yd_fy_status=='A'){
			var order_status='M';
		}else{
			var order_status='N';
		}
		var yd_cover_code='';
		var yd_cov=$("input[name='FruitD']:checked").each(function(){
			yd_cover_code+=$(this).val()+',';
		});
		var yd_mark=$("#yd_markD").val();
	}else{
		var yd3=$("#ty3").val();
		var arr=yd3.split(",");
		var yd_name=arr[0];
		var yd_tel=arr[1];
	    var yd_indetity=$("#ty33").val();
		var yd_other=$("#yd_otherE").val();
		var yd_line=$("#yd_lineE").val();
		var yd_price=$("#yd_priceE").val();
		var yd_j_gong=$("#yd_j_gongE").val();
		var yd_s_gong=$("#yd_s_gongE").val();
		var yd_cover_code='';
		var yd_cov=$("input[name='FruitE']:checked").each(function(){
			yd_cover_code+=$(this).val()+',';
		});
		var yd_mark=$("#yd_markE").val();
		var order_status='G';
	}
	$.post("/Back/Orderyjh/addYunDan",{order_code:order_code,yd_type:yd_type,yd_name:yd_name,yd_tel:yd_tel,yd_indetity:yd_indetity,yd_line:yd_line,yd_price:yd_price,yd_j_gong:yd_j_gong,yd_s_gong:yd_s_gong,yd_fy_status:yd_fy_status,yd_mark:yd_mark,yd_cover_code:yd_cover_code,order_status:order_status,yd_other:yd_other},function(data){
		if(data.flag){
			window.location.reload();
  		}else{
  			layer.msg(data.msg);
  		}
	});
});
//已到达
$("#arrive").click(function(){
	var code="<?php echo ($code); ?>";
	$.post("/Back/Orderyjh/editOrder",{order_code:code,order_status:'D'},function(data){
		if(data.flag){
			window.location.reload();
  		}else{
  			layer.msg(data.msg);
  		}
	});
})
//已交车
$("#shou").click(function(){
	var code="<?php echo ($code); ?>";
	var income=$(".income").val();
	var hui_man=$(".hui_man").val();
	var visit=$(".visit:checked").val();
	if(visit==''||visit==null){
		visit='N';
	}
	$.post("/Back/Orderyjh/editOrder",{log_mark:'DAISHOU',order_code:code,income:income,hui_man:hui_man,visit:visit,order_status:'W'},function(data){
		if(data.flag){
			window.location.reload();
  		}else{
  			layer.msg(data.msg);
  		}
	})
})
//待回访
$("#fang").click(function(){
	var code="<?php echo ($code); ?>";
	var content=$("#conts").val();
	$.post("/Back/Orderyjh/editOrder",{log_mark:'HFANG',order_code:code,is_visit:'Y',visit_bei:content},function(data){
		if(data.flag){
			window.location.reload();
  		}else{
  			layer.msg(data.msg);
  		}
	})
});
//订单作废
$("#delOrder").click(function(){
	if(window.confirm('确定作废订单？')){
		var code="<?php echo ($code); ?>";
		var content=$("#del_conts").val();
		$.post("/Back/Orderyjh/editOrder",{log_mark:'DELORDER',order_code:code,cont:content,order_status:'DIE'},function(data){
			if(data.flag){
				window.location.reload();
	  		}else{
	  			layer.msg(data.msg);
	  		}
		})
	}else{
		window.location.reload();
	}
	
});
//确认回单
$("#conHui").click(function(){
	var code="<?php echo ($code); ?>";
	$.post("/Back/Orderyjh/editOrder",{log_mark:"HUIDAN",order_code:code,is_hui:'Y'},function(data){
		if(data.flag){
			window.location.reload();
  		}else{
  			layer.msg(data.msg);
  		}
	})
})
//位置跟踪 
$("#position").click(function(){
	var phone="<?php echo ($data['mess_rec_man']); ?>";
	if(phone==''){
		layer.msg("没有短信接收人");
		return false;
	}
	var txt1=$("#position1").html();
	var txt2=$("#position2").val();
	var content=txt1+txt2;
	var code="<?php echo ($code); ?>";
	$.post("/Back/Orderyjh/addPosition",{phone:phone,content:content,code:code,text:txt2},function(data){
		if(data.flag){
			window.location.reload();
  		}else{
  			layer.msg(data.msg);
  		}
	});
});
//打印
var LODOP; //声明为全局变量
	//承运底单打印
$(".print").click(function(){
	var yd_code=$(this).attr("data-code");
		$.post('/Back/Print/printKept/',{yd_code:yd_code},function(data){
			//调用打印预览
			/*   alert(JSON.stringify(data));
			return false;   */
			CreateFullBill3(data);
		  	//LODOP.PRINT_SETUP();
		  	LODOP.PREVIEW();
		})
});

	function printpact(order_code){
		$.post('/Back/Print/contract/',{'order_code':order_code},function(data){
			//if(data.order.agree=='Y'){
				//调用打印预览
				CreateFullBill2(data);
				LODOP.PRINT_SETUP();
			  	//LODOP.PREVIEW();
			//}else{
			//	layer.msg("订单还未到支付时限");
			//}
		});
	}

	//运车服务合同
	function CreateFullBill2(data) {
		var order=data.order;
		var ver=data.verifyInfo;
		
		//LODOP.PRINT_INITA(10,10,1654,2339,"");
		LODOP.PRINT_INITA(10,10,794,1123,"");
		LODOP.ADD_PRINT_SETUP_BKIMG("D:\\img\\1.jpg");
		LODOP.SET_SHOW_MODE("BKIMG_LEFT",0);
		LODOP.SET_SHOW_MODE("BKIMG_TOP",0);-
		//LODOP.SET_PRINT_STYLE("FontSize",13);
		LODOP.ADD_PRINT_TEXT(92,105,52,30,order.order_info_stars);
		LODOP.ADD_PRINT_TEXT(92,200,58,30,order.order_info_ends);
		LODOP.ADD_PRINT_TEXT(92,324,41,25,order.year);
		LODOP.ADD_PRINT_TEXT(92,385,29,25,order.month);
		LODOP.ADD_PRINT_TEXT(92,420,25,25,order.day);
		LODOP.ADD_PRINT_TEXT(92,625,80,25,order.order_code);
		LODOP.ADD_PRINT_TEXT(129,157,68,25,order.order_info_tclxrs[0]);
		LODOP.ADD_PRINT_TEXT(129,316,109,25,order.order_info_tclxrs[1]);
		LODOP.ADD_PRINT_TEXT(129,493,191,25,order.order_info_tclxrs[2]);
		LODOP.ADD_PRINT_TEXT(161,171,68,25,order.order_info_sclxrs[0]);
		LODOP.ADD_PRINT_TEXT(161,316,106,25,order.order_info_sclxrs[1]);
		LODOP.ADD_PRINT_TEXT(161,493,191,25,order.order_info_sclxrs[2]);
		
		LODOP.ADD_PRINT_TEXT(193,159,144,30,order.order_info_smsc);
		LODOP.ADD_PRINT_TEXT(193,417,224,30,order.order_info_end_address);
		
		LODOP.ADD_PRINT_TEXT(266,60,120,30,order.order_info_brand);
		LODOP.ADD_PRINT_TEXT(266,213,113,30,order.order_info_carmark);
		LODOP.ADD_PRINT_TEXT(266,381,102,30,order.order_info_price);
		LODOP.ADD_PRINT_TEXT(266,490,52,30,order.order_info_bxd);
		LODOP.ADD_PRINT_TEXT(266,564,52,30,order.order_yun_price);
		LODOP.ADD_PRINT_TEXT(266,644,52,30,order.car_washing);
		
		LODOP.ADD_PRINT_TEXT(266,712,62,30,order.allMoney);
		if(ver != null){
			var verify_car_keys = ver.verify_car_keys==null?"":ver.verify_car_keys;
			var verify_km =ver.verify_km==null?"":ver.verify_km;
			var verify_predict_km =ver.verify_predict_km==null?"":ver.verify_predict_km;
			var verify_xingli =ver.verify_xingli==null?"":ver.verify_xingli;
			var verify_car_wai =ver.verify_car_wai==null?"":ver.verify_car_wai;
			var verify_bei =ver.verify_bei==null?"":ver.verify_bei;
			
			LODOP.ADD_PRINT_TEXT(307,205,49,25,verify_car_keys);
			LODOP.ADD_PRINT_TEXT(307,366,54,25,verify_km);
			LODOP.ADD_PRINT_TEXT(307,661,54,25,verify_predict_km);
			
			LODOP.ADD_PRINT_TEXT(659,110,234,106,verify_xingli);
			LODOP.ADD_PRINT_TEXT(659,467,240,106,verify_car_wai);
			LODOP.ADD_PRINT_TEXT(784,99,496,37,verify_bei);
			
		}
		
		LODOP.ADD_PRINT_TEXT(819,149,27,25,order.wan);
		LODOP.ADD_PRINT_TEXT(819,198,27,25,order.qian);
		LODOP.ADD_PRINT_TEXT(819,244,27,25,order.bai);
		LODOP.ADD_PRINT_TEXT(819,295,27,25,order.shi);
		LODOP.ADD_PRINT_TEXT(819,342,27,25,order.ge);
		
		LODOP.ADD_PRINT_TEXT(820,483,78,25,order.pay_way);
		if(order.is==1){
			LODOP.ADD_PRINT_TEXT(950,643,55,25,order.order_info_tclxrs[0]);
			LODOP.ADD_PRINT_TEXT(989,670,40,20,order.nowYear);
			LODOP.ADD_PRINT_TEXT(989,708,30,20,order.nowMonth);
			LODOP.ADD_PRINT_TEXT(989,729,30,20,order.nowDay);
		}
	};

	//承运底单打印
	function CreateFullBill3(data) {
		var data=data.list[0];
		var order_code =data.order_code ==null ? "" :data.order_code;
		var yd_line=data.yd_line ==null ? "" : data.yd_line;
		var yd_price=data.yd_price ==null ? "" : data.yd_price;
		var order_info_type=data.order_info_type == null ? "" : data.order_info_type;
		var order_info_carmark=data.order_info_carmark == null ? "" :data.order_info_carmark;
		var payMoney= data.payMoney ==null ? "" : data.payMoney;
		var imgsCode=data.imgsCode ==0 ? "" : data.imgsCode;
		var order_info_sclxr0 =data.order_info_sclxr0==null ? "" :data.order_info_sclxr0;
		var order_info_sclxr1 =data.order_info_sclxr1==null ? "" :data.order_info_sclxr1;
		var order_info_sclxr2 =data.order_info_sclxr2==null ? "" :data.order_info_sclxr2;
		LODOP.PRINT_INITA(10,10,1654,1166,"");
		LODOP.ADD_PRINT_SETUP_BKIMG("D:\\img\\2.jpg");
		LODOP.SET_SHOW_MODE("BKIMG_LEFT",0);
		LODOP.SET_SHOW_MODE("BKIMG_TOP",0);
		LODOP.SET_PRINT_STYLE("FontSize",13);
		LODOP.ADD_PRINT_TEXT(25,634,212,40,order_code);
		LODOP.ADD_PRINT_TEXT(60,140,190,40,yd_line);
		LODOP.ADD_PRINT_TEXT(60,300,251,40,data.yd_code);
		LODOP.ADD_PRINT_TEXT(60,460,172,40,'');
		LODOP.ADD_PRINT_TEXT(100,140,190,40,order_info_type);
		LODOP.ADD_PRINT_TEXT(100,300,252,40,order_info_carmark);
		LODOP.ADD_PRINT_TEXT(100,538,172,40,payMoney);
		LODOP.ADD_PRINT_TEXT(140,140,172,40,order_info_sclxr0);
		LODOP.ADD_PRINT_TEXT(140,300,220,40,order_info_sclxr1);
		LODOP.ADD_PRINT_TEXT(140,538,394,40,order_info_sclxr2);
		if(data.yanData != null){
			var verify_xingli=data.yanData.verify_xingli == null ? "" : data.yanData.verify_xingli;
			var verify_car_wai =data.yanData.verify_car_wai == null ? "" :data.yanData.verify_car_wai;
			var verify_bei =data.yanData.verify_bei== null ? "" : data.yanData.verify_bei;
			LODOP.ADD_PRINT_TEXT(168,130,626,92,verify_xingli);
			LODOP.ADD_PRINT_TEXT(220,130,626,92,verify_car_wai);
			LODOP.ADD_PRINT_TEXT(268,120,626,92,verify_bei);
		}
		
		LODOP.ADD_PRINT_TEXT(186,510,257,130,imgsCode);
	
		
	};
	 $(function(){
		   var bill_type="<?php echo ($data['bill_type']); ?>";
		   var busin_type="<?php echo ($data['busin_type']); ?>";
		   if(bill_type=='C'){
			   $("#cost").parent('.pp3').show();
		   }
		   if(busin_type=='B' ){
			   $("#company").parent('.pp3').show();
		   }
	   });
</script>
<script src="/Public/Back/js/li.js"></script>
</body>
</html>