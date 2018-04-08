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
<script src="/Public/JS/jquery.Huploadify.js"></script>
<script src="/Public/JS/jquerytool_1.0v.js"></script>
<script src="/Public/laydate/laydate.js"></script>
<script language="javascript" src="/Public/JS/LodopFuncs.js"></script>

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
    <div id="content">
        <div class="row">
            <div class="tsan113">
                <div class="widget">
                    <div class="tabbable">
                        <ul class="nav nav-tabs" id="tabnav">
                            <li>
                                <a href="">订单管理</a>
                            </li>
                        </ul>
                        <div class="tab-content1">
                            <h2 class="dw88">用户信息</h2>
                            <div class="du1">
                                <div class="dua">
                                    <div class="duaa">
                                        <span>姓名:</span>
                                        <input type="text" readonly="readonly" class="i_n text2" value="<?php echo ($data['User']['user_name']); ?>"></div>
                                </div>
                                <div class="dua">
                                    <div class="duaa">
                                        <span>身份证号码:</span>
                                        <input type="text" readonly="readonly" class="i_n text2" value="<?php echo ($data['User']['identity']); ?>"></div>
                                </div>
                                <div class="dua">
                                    <div class="duaa">
                                        <span>手机号:</span>
                                        <input type="text" readonly="readonly" class="i_n text2" value="<?php echo ($data['User']['tel']); ?>"></div>
                                </div>
                                <div class="dua">
                                    <div class="duaa">
                                        <span>备用手机号:</span>
                                        <input type="text" readonly="readonly" class="i_n text2" value="<?php echo ($data['User']['by_tel']); ?>"></div>
                                </div>
                            </div>
                            <h2 class="dw88">订单基本信息</h2>
                            <div class="du1">
                                <div class="dua">
                                    <div class="duaa">
                                        <span>订单状态:</span>
                                        <?php switch($data["order_status"]): case "S": ?><input type="text" readonly="readonly" id="zt" class="i_n text2" value="待审核"><?php break;?>
                                            <?php case "A": ?><input type="text" readonly="readonly" id="zt" class="i_n text2" value="待安排"><?php break;?>
                                            <?php case "T": ?><input type="text" readonly="readonly" id="zt" class="i_n text2" value="待提车"><?php break;?>
                                            <?php case "Z": ?><input type="text" readonly="readonly" id="zt" class="i_n text2" value="待装板"><?php break;?>
                                            <?php case "Y": ?><input type="text" readonly="readonly" id="zt" class="i_n text2" value="运输中"><?php break;?>
                                            <?php case "D": ?><input type="text" readonly="readonly" id="zt" class="i_n text2" value="已到达"><?php break;?>
                                            <?php case "W": ?><input type="text" readonly="readonly" id="zt" class="i_n text2" value="已完成"><?php break;?>
                                                <?php case "N": ?><input type="text" readonly="readonly" id="zt" class="i_n text2" value="未通过"><?php break;?>
                                            <?php default: ?>
                                            <input type="text" readonly="readonly" class="i_n text2" value="状态错误"><?php endswitch;?>
                                    </div>
                                </div>
                                <div class="dua">
                                    <div class="duaa">
                                        <span>价格:</span>
                                        <input type="text" readonly="readonly" class="i_n text2" value="<?php echo ($data["price"]); ?>元"></div>
                                </div>
                                <div class="dua">
                                    <div class="duaa">
                                        <span>车辆信息:</span>
                                        <input type="text" readonly="readonly" class="i_n text2" value="<?php echo ($data["OrderInfo"]["order_info_brand"]); ?>-<?php echo ($data["OrderInfo"]["order_info_type"]); ?>"></div>
                                </div>
                                <div class="dua">
                                    <div class="duaa">
                                        <span>保价:</span>
                                        <input type="text" readonly="readonly" class="i_n text2" value="<?php echo ($data["cj"]); ?>元"></div>
                                </div>
                                <div class="dua">
                                    <div class="duaa">
                                        <span>接车费:</span>
                                        <input type="text" readonly="readonly" class="i_n text2" value="<?php echo ($data["jc"]); ?>元"></div>
                                </div>
                                <div class="dua">
                                    <div class="duaa">
                                        <span>运车费:</span>
                                        <input type="text" readonly="readonly" class="i_n text2" value="<?php echo ($data["yc"]); ?>元"></div>
                                </div>
                                <div class="dua">
                                    <div class="duaa">
                                        <span>送车费:</span>
                                        <input type="text" readonly="readonly" class="i_n text2" value="<?php echo ($data["sc"]); ?>元"></div>
                                </div>
                                <!-- <div class="dua">
                                <div class="duaa">
                                    <span>毛利:</span>
                                    <input type="text" readonly="readonly" class="i_n text2" value="<?php echo ($data["ml"]); ?>元"></div>
                            </div>
                            -->
                            <div class="dua">
                                <div class="duaa">
                                    <span>车型加价:</span>
                                    <input type="text" readonly="readonly" class="i_n text2" value="<?php echo ($data["cxjj"]); ?>元"></div>
                            </div>
                            <div class="dua">
                                <div class="duaa">
                                    <span>保险费用:</span>
                                    <input type="text" readonly="readonly" class="i_n text2" value="<?php echo ($data["bx"]); ?>元"></div>
                            </div>
                            <div class="dua">
                                <div class="duaa">
                                    <span>支付状态:</span>
                                    <?php if($data["pay_status"] == Y): ?><input type="text" readonly="readonly" class="i_n text2" value="已支付"></div>
                                    <?php else: ?>
                                    <input type="text" readonly="readonly" class="i_n text2" value="未支付"></div><?php endif; ?>
                        </div>
                        <div class="dua">
                            <div class="duaa">
                                <span>支付方式:</span>
                                <?php if($data["pay_way"] == H): ?><input type="text" readonly="readonly" class="i_n text2" value="货到付款"></div>
                                <?php elseif($data["pay_way"] == 'W'): ?>
                                	<input type="text" readonly="readonly" class="i_n text2" value="微信支付"></div>
                                <?php else: ?>
                                	<input type="text" readonly="readonly" class="i_n text2" value="支付宝支付"></div><?php endif; ?>
                    </div>
                    <div class="dua">
                        <div class="duaa">
                            <span>是否上门送车:</span>
                            <?php if($data.OrderInfo.order_info_smsc == Y): ?><input type="text" readonly="readonly" style="width:60%;" class="i_n text2" value="是">
                            <?php else: ?>
                            <input type="text" readonly="readonly"  style="width:60%;" class="i_n text2" value="否"><?php endif; ?>
                        </div>
                    </div>
                    <div class="dua">
                        <div class="duaa">
                            <span>提车类型:</span>
                            <?php if($data["order_way"] == S): ?><input type="text" readonly="readonly" class="i_n text2" value="司机提车">
                            <?php else: ?>
                            <input type="text" readonly="readonly" class="i_n text2" value="小板提车"><?php endif; ?>
                        </div>
                    </div>
                </div>
                <h2 class="dw88">起点</h2>
                <div class="du1">
                    <div class="dua">
                        <div class="duaa">
                            <span>省:</span>
                            <input type="text" id="sgijsd" readonly="readonly" class="i_n text2" value="<?php echo ($data["p"]); ?>"></div>
                    </div>
                    <div class="dua">
                        <div class="duaa">
                            <span>市:</span>
                            <input type="text" readonly="readonly" class="i_n text2" value="<?php echo ($data["c"]); ?>"></div>
                    </div>
                    <div class="dua">
                        <div class="duaa">
                            <span>区:</span>
                            <input type="text" readonly="readonly" class="i_n text2" value="<?php echo ($data["b"]); ?>"></div>
                    </div>
                    <div class="dua">
                        <div class="duaa">
                            <span>客户姓名:</span>
                            <input type="text" readonly="readonly" class="i_n text2" value="<?php echo ($data["stinfo"]["0"]); ?>"></div>
                    </div>
                    <div class="dua">
                        <div class="duaa">
                            <span>身份证号:</span>
                            <input type="text" readonly="readonly" class="i_n text2" value="<?php echo ($data["stinfo"]["1"]); ?>"></div>
                    </div>
                    <div class="dua">
                        <div class="duaa">
                            <span>手机号:</span>
                            <input type="text" readonly="readonly" class="i_n text2" value="<?php echo ($data["stinfo"]["2"]); ?>"></div>
                    </div>
                </div>
                <h2 class="dw88">终点</h2>
                <div class="du1">
                    <div class="dua">
                        <div class="duaa">
                            <span>省:</span>
                            <input type="text" id="gojir" readonly="readonly" class="i_n text2" value="<?php echo ($data["pe"]); ?>"></div>
                    </div>
                    <div class="dua">
                        <div class="duaa">
                            <span>市:</span>
                            <input type="text" readonly="readonly" class="i_n text2" value="<?php echo ($data["ce"]); ?>"></div>
                    </div>
                    <div class="dua">
                        <div class="duaa">
                            <span>地址:</span>
                            <input type="text" readonly="readonly" class="i_n text2" value="<?php echo ($data["OrderInfo"]["order_info_end_address"]); ?>"></div>
                    </div>
                    <div class="dua">
                        <div class="duaa">
                            <span>客户姓名:</span>
                            <input type="text" readonly="readonly" class="i_n text2" value="<?php echo ($data["eninfo"]["0"]); ?>"></div>
                    </div>
                    <div class="dua">
                        <div class="duaa">
                            <span>身份证号:</span>
                            <input type="text" readonly="readonly" class="i_n text2" value="<?php echo ($data["eninfo"]["1"]); ?>"></div>
                    </div>
                    <div class="dua">
                        <div class="duaa">
                            <span>手机号:</span>
                            <input type="text" readonly="readonly" class="i_n text2" value="<?php echo ($data["eninfo"]["2"]); ?>"></div>
                    </div>
                </div>
                <h2 class="dw88">提车信息</h2>
                <div class="du1">
                    <div class="dua">
                        <div class="duaa">
                            <span>提车人姓名:</span>
                            <input type="text" readonly="readonly" class="i_n text2" value="<?php echo ($data["tcr"]["car_name"]); ?>"></div>
                    </div>
                    <div class="dua">
                        <div class="duaa">
                            <span>身份证号码:</span>
                            <input type="text" readonly="readonly" class="i_n text2" value="<?php echo ($data["tcr"]["car_identity"]); ?>"></div>
                    </div>
                    <div class="dua">
                        <div class="duaa">
                            <span>手机号:</span>
                            <input type="text" readonly="readonly" class="i_n text2" value="<?php echo ($data["tcr"]["car_tel"]); ?>"></div>
                    </div>
                    <div class="dua">
                        <div class="duaa">
                            <span>车品牌:</span>
                            <input type="text" readonly="readonly" class="i_n text2" value="<?php echo ($data["OrderInfo"]["order_info_brand"]); ?>-<?php echo ($data["OrderInfo"]["order_info_type"]); ?>"></div>
                    </div>
                    <div class="dua">
                        <div class="duaa">
                            <span>车牌号:</span>
                            <input type="text" readonly="readonly" class="i_n text2" value="<?php echo ($data["OrderInfo"]["order_info_carmark"]); ?>"></div>
                    </div>
                    <div class="dua">
                        <div class="duaa">
                            <span>车辆状态:</span>
                            <span>
								<?php if($stut == 'Y'): ?>已提车
								<?php elseif($stut == 'Z'): ?>
									已提车
								<?php elseif($stut == 'D'): ?>
									已提车
								<?php elseif($stut == 'W'): ?>
									已提车
								<?php elseif($stut == 'S'): ?>	
									未提车
								<?php elseif($stut == 'A'): ?>	
									未提车
								<?php elseif($stut == 'T'): ?>	
									未提车
								<?php else: ?>	
									未提车<?php endif; ?>
							</span>
                        </div>
                    </div>
                </div>
                <div class="du2">
                    <ul>
                        <?php if(is_array($img)): $i = 0; $__LIST__ = $img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                                <?php if(!empty($vo)): ?><img src="<?php echo ($vo); ?>"><?php endif; ?>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
                <h2 class="dw88">运输状态</h2>
                <div class="du3">
                    <ul id="wlinfoa">
                        <?php if(is_array($data["Wuliu"])): $i = 0; $__LIST__ = $data["Wuliu"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$wuliu): $mod = ($i % 2 );++$i;?><li>
                                <?php echo ($wuliu["wl_time"]); ?> 物流信息：<?php echo ($wuliu["wl_info"]); ?>
                                <?php if($wuliu["wl_status"] == 'Y' ): ?><a>重发短信</a>
                                    <?php else: ?>
                                    <a class="on" href="javascript:" onclick="send(this)" code="<?php echo ($wuliu["wl_code"]); ?>">发送短信</a><?php endif; ?>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
                <h2 class="dw88">运单状态</h2>
                <form id="edit-profile" class="form-horizontal" />
                <fieldset>
                    <div class="l_uit">
                        <script>
                                            $(function() {
                                                $('table tr.tr2:odd').css('background', '#F0F0F0');
                                            });
                                        </script>
                        <div class="l_table" style="margin-top:0px;">
                            <table id="ydinfo">
                                <tr class="tr1">
                                    <td>运单编号</td>
                                    <td>承运人</td>
                                    <td>联系电话</td>
                                    <td>路线</td>
                                    <td>费用</td>
                                    <td>状态</td>
                                    <td>备注</td>
                                    <td>操作</td>
                                </tr>
                                <?php if(is_array($yundan)): foreach($yundan as $k=>$yd): ?><tr class="tr2">
                                        <td><?php echo ($yd["yd_code"]); ?></td>
                                        <td>
                                            <?php echo ($yd["yd_name"]); ?><br>
                                            <?php echo ($yd["yd_indetity"]); ?>
                                        </td>
                                        <td class="td_d2"><?php echo ($yd["yd_tel"]); ?></td>
                                        <td class="td_d2">
                                            <?php echo ($yd["yd_star"]); ?><br>
                                            <?php echo ($yd["yd_end"]); ?>
                                        </td>
                                        <td class="td_d2"><?php echo ($yd['yd_price']/100); ?></td>
                                        <td class="td_d2 ydzt">
                                            <?php if($yd["yd_status"] == 'Y'): ?>已支付
                                                <?php else: ?>
                                                	未支付<?php endif; ?>
                                        </td>
                                        <td class="td_d2"><?php echo ($yd["yd_mark"]); ?></td>
                                        <td>
                                        	<a href="javascript:void(0)" onclick="printKept('<?php echo ($data["OrderInfo"]["order_code"]); ?>','<?php echo ($yd["yd_code"]); ?>')">打印</a>
                                            <a href="javascript:;" class="see1" dd="<?php echo ($yd["yd_code"]); ?>">更改</a>
                                        </td>
                                    </tr><?php endforeach; endif; ?>
                            </table>
                        </div>
                    </div>
                </fieldset>
            </form>
            <h2 class="dw88">订单备注</h2>
            <div class="du4">
                <textarea readonly="readonly"><?php echo ($data["OrderInfo"]["order_info_remark"]); ?></textarea>
            </div>
            <hr>
            <div class="sad2" style="background:#fff;position:fixed;bottom:0px;width:100%">
            	<?php if(($data['check_res'] == 'Y')or($data['order_status'] == 'W')): ?><button   class="btn btn-default8" type="button">已通过审核</button>
                <?php elseif($data['check_res'] == 'N'): ?>
                <button   class="btn btn-default8" type="button">未通过审核</button>
                <?php else: ?>
                <button data-toggle="modal" data-target="#myModa1" id="add1" class="btn btn-default10" type="button">审核</button><?php endif; ?>
                <?php if($data['order_status'] == 'A'): ?><button data-toggle="modal" data-target="#myModa2" id="add2" class="btn btn-default10" type="button">安排提车员</button>
                <?php elseif($data['order_status'] == 'T'): ?>
                <button  data-toggle="modal" data-target="#myModa2" id="add2" class="btn btn-default10" type="button">重新安排提车员</button>
                <?php else: ?>
				<button   class="btn btn-default8" type="button">已安排提车员</button><?php endif; ?>
                <?php if(($data['order_status'] == 'A')or($data['order_status'] == 'S')or($data['order_status'] == 'T')): ?><button   class="btn btn-default8" type="button">司机未提车</button>
                <?php elseif(($data['order_status'] == 'Z')or($data['order_status'] == 'Y')or($data['order_status'] == 'D')or($data['order_status'] == 'W')): ?>
                <button   class="btn btn-default8" type="button">司机已提车</button><?php endif; ?>
                <!-- <?php if(($data['order_status'] == 'A')or($data['order_status'] == 'S')or($data['order_status'] == 'T')): ?><button data-toggle="modal" class="btn btn-default8" type="button">不可装板</button>
                <?php elseif($data['order_status'] == 'Z'): ?>
                <button data-toggle="modal"  id="add11" class="btn btn-default10" type="button">装板</button>
                <?php else: ?>
                <button  class="btn btn-default8" type="button">已装板</button><?php endif; ?> -->
                <!-- <button data-toggle="modal" data-target="#myModa3" id="add3" class="btn btn-default10" type="button">确认提车</button> -->
                <?php if(($data['order_status'] != 'W')and($data['order_status'] != 'D')): ?><button data-toggle="modal" data-target="#myModa4" id="add4" class="btn btn-default10" type="button">上传保险单</button>
                <button data-toggle="modal" data-target="#myModa5" id="add5" class="btn btn-default10" type="button">打印合同</button>
                <button data-toggle="modal" data-target="#myModa6" id="add6" class="btn btn-default10" type="button">修改价格</button>
                <button data-toggle="modal" data-target="#myModa7" id="add7" class="btn btn-default10" type="button">添加物流信息</button>
                <button data-toggle="modal" data-target="#myModa8" id="add8" class="btn btn-default10" type="button">添加运单信息</button>
                <?php else: ?>
                <button  class="btn btn-default8" type="button">上传保险单</button>
                <button  class="btn btn-default8" type="button">打印合同</button>
                <button  class="btn btn-default8" type="button">修改价格</button>
                <button  class="btn btn-default8" type="button">添加物流信息</button>
                <button  class="btn btn-default8" type="button">添加运单信息</button><?php endif; ?>
                <?php if($data['order_status'] == 'Y'): ?><button data-toggle="modal" id="add12" class="btn btn-default10" type="button">确认到达</button>
                <?php elseif(($data['order_status'] == 'D')or($data['order_status'] == 'W')): ?>
                <button data-toggle="modal" class="btn btn-default8" type="button">已到达</button>
                <?php else: ?>
                <button  class="btn btn-default8" type="button">未到达</button><?php endif; ?>
                <?php if($data['order_status'] == 'D'): ?><button data-toggle="modal"  id="add10" class="btn btn-default10" type="button">确认用户提车</button>
            	<?php elseif(($data['order_status'] != 'D')AND($data['order_status'] != 'W')): ?>
            	<button  class="btn btn-default8" type="button">确认用户提车(未到达)</button>
            	<?php else: ?>
            	<button  class="btn btn-default8" type="button">用户已提车</button><?php endif; ?>
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
<!--审核-->
<div id="myModa1" style="display:none; z-index:9999" class="tan1">
<div class="tan11">
<a class="closed" >X</a>
<h2>订单审核</h2>
<div  class="di1">
<textarea id="textaa" placeholder="请输入备注信息"></textarea>
</div>
<div  class="di2" id="di2">
<label>
    <input type="radio" value="1" checked name="dss">通过</label>
<label>
    <input  value="2" type="radio" name="dss">不通过</label>
</div>
<p>
<input type="submit" id="sh" class="put2" value="确认"></p>
</div>
</div>

<!--安排提车员-->
<div id="myModa2" style="display:none; z-index:9999"  class="tan1">
<div class="tan11" style="position:relative;">
<button style="" class="btn btn-default5  sdad" id="aptcy" type="button">添加提车员</button>
<h2>安排提车员</h2>
<a class="closed">X</a>
<div class="hk2" style="height:auto;">
<input type="text" id="tcysfz"   placeholder="请输入提车员姓名" value="" class="put1">
<div id="dfsuh" style="display: none;line-height:30px;text-align:left;">提车人手机号:<span id="sfjio"></span></div>
<input type="hidden" id="tcyaa"  value="" class="put1">
<div class="dlisrt" style="display:none;z-index:100000;">
    <ul></ul>
</div>
</div>

<div class="hk1">
<input type="text" placeholder="请输入出发地" id="car_cfd" name="car_cfd" names="<?php echo ($data['OrderInfo']['order_info_star']); ?>" value="<?php echo ($data["p"]); ?>-<?php echo ($data["c"]); ?>-<?php echo ($data["b"]); ?>" readonly="readonly" class="put9"/>
<input type="text" placeholder="请输入目的地" id="car_mdd" name="car_mdd"  names="<?php echo ($data['OrderInfo']['order_info_end']); ?>" value="<?php echo ($data["pe"]); ?>-<?php echo ($data["ce"]); ?>" readonly="readonly" class="put10"/></div>
<div class="hk1">
<input type="text" placeholder="请输入接车时间" readonly="readonly" onclick="laydate({istime: true, format: 'YYYY-MM-DD'})" id="car_jc_time" name="car_jc_time" value="<?php echo ($times); ?>" class="put9">
<input type="text" placeholder="请输入费用" id="car_order_price" name="car_order_price" value="" class="put1"></div></div>
<!-- <div class="hk2">
<input type="text" placeholder="请输入费用" id="cwgl_t_price" name="cwgl_t_price" value="" onfocus="if(this.value==defaultValue){this.value=''}" onblur="if(this.value==''){this.value=defaultValue}" class="put1"></div> -->
<div  class="di2" id="di3">
<label>
    <input type="radio" value="X" checked name="dss">现付</label>
<label>
    <input  value="Q" type="radio" name="dss">欠付</label>
    <!--
<label>
    <button style="position:absolute;right:60px;" class="btn btn-default5">打印</button></label>
</div>
 -->
</div>
<p class="qqw">
<input type="submit" id="aptcyqr" class="put2 btn-default6 " value="确认" style="height:46px;" class="btn btn-default5"></p>

</div>

<!--queren提车-->
<div id="myModa3" style="display:none; z-index:9999" class="tan1">
<div class="tan11">
<a class="closed">X</a>
<h2>确认提车</h2>
<dl>
<p class="vq1">请确认已经安全提到车</p>
</dl>
<p>
<input type="submit" id="qrtc" class="put2" value="确认"></p>
</div>
</div>
<!--上传保险单-->
<div id="myModa4" style="display:none; z-index:9999" class="tan1">
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

<!--打印合同-->
<div id="myModa5" style="display:none; z-index:9999" class="tan1">
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

<!--修改价格-->
<div id="myModa6" style="display:none; z-index:9999" class="tan1">
<div class="tan11">
<a class="closed">X</a>
<h2>修改价格</h2>
<dl>
<input type="text" id="xprice" placeholder="输入您修改后的订单总金额" value="" onfocus="if(this.value==defaultValue){this.value=''}" onblur="if(this.value==''){this.value=defaultValue}" class="put1"></dl>
<p>
<input type="submit" id="xgjg" class="put2" value="确认"></p>
</div>
</div>

<!--修改价格-->
<div id="myModa7" style="display:none; z-index:9999" class="tan1">
<div class="tan11">
<a class="closed">X</a>
<h2>添加物流信息</h2>
<dl>
<input type="text" id="wlinfo" placeholder="请输入当前物流信息" value="" onfocus="if(this.value==defaultValue){this.value=''}" onblur="if(this.value==''){this.value=defaultValue}" class="put1"></dl>
<div class="CDa"></div>
<!--<dl>
<input type="text" id="wltime" readonly="readonly" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" value="年/月/日/时/分/秒" onfocus="if(this.value==defaultValue){this.value=''}" onblur="if(this.value==''){this.value=defaultValue}" class="put1"></dl>-->
<div  class="di2" id="di4">
<label>
    <input type="checkbox" value="Z" name="dss">待装板</label>
<label>
</div>
<p>
<input type="submit" class="put2" id="addwl" value="确认"></p>
</div>

</div>

<!--修改价格-->
<div id="myModa8" style="display:none; z-index:9999" class="tan1">
<div class="tan11">
<a class="closed">X</a>
<h2>添加运单信息</h2>
<div class="hk1">
<!-- <select class="height46" style="width:300px" name="" id="csm">
    <option value="C">长途费</option>
    <option value="S">送车费</option>
    <option value="M">上门送车费</option>
</select> -->
<input type="text" placeholder="请输入承运人姓名" id="yd_name" name="yd_name" value="" onfocus="if(this.value==defaultValue){this.value=''}" onblur="if(this.value==''){this.value=defaultValue}" class="put9">
<input type="text" placeholder="请输入手机号码" id="yd_tel" name="yd_tel" value="" onfocus="if(this.value==defaultValue){this.value=''}" onblur="if(this.value==''){this.value=defaultValue}" class="put10"></div>
<div class="hk1">
<input type="text" placeholder="请输入身份证号" id="yd_indetity" name="yd_indetity" value="" onfocus="if(this.value==defaultValue){this.value=''}" onblur="if(this.value==''){this.value=defaultValue}" class="put9">
<input type="text" placeholder="请输入费用" id="yd_price" name="yd_price" value="" onfocus="if(this.value==defaultValue){this.value=''}" onblur="if(this.value==''){this.value=defaultValue}" class="put10"></div>
<div class="hk1">
<input type="text" placeholder="请输入出发地" id="yd_star" name="yd_star" value="" onfocus="if(this.value==defaultValue){this.value=''}" onblur="if(this.value==''){this.value=defaultValue}" class="put9">
<input type="text" placeholder="请输入目的地" id="yd_end" name="yd_end" value="" onfocus="if(this.value==defaultValue){this.value=''}" onblur="if(this.value==''){this.value=defaultValue}" class="put10"></div>
<!-- <div class="hk1">
<input type="text" placeholder="请输入接车时间" id="yd_j_time" name="yd_j_time" value="" readonly="readonly" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" class="put9">
<input type="text" placeholder="请输入送车时间" id="yd_s_time" name="yd_s_time" value="" readonly="readonly" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" class="put10"></div> -->
<div class="hk1">
	<input type="text" placeholder="承运公司名称" id="yd_company" name="yd_company" value="" onfocus="if(this.value==defaultValue){this.value=''}" onblur="if(this.value==''){this.value=defaultValue}" class="put9">
	<input type="text" placeholder="承运车辆车牌号" id="yd_carmark" name="yd_carmark" value="" onfocus="if(this.value==defaultValue){this.value=''}" onblur="if(this.value==''){this.value=defaultValue}" class="put10">
</div>
<div  class="di11">
<textarea id="yd_mark" name="yd_mark"  placeholder="请输入订单备注"></textarea>
</div>

<p>
<input type="submit" class="put2" id="addyd" value="确认"></p>
</div>

</div>

<!--确认已到达-->
<div id="myModa9" style="display:none; z-index:9999" class="tan1">
<div class="tan11">
<a class="closed">X</a>
<h2>确认已到达</h2>
<dl>
<p class="vq1">请确认车辆是否已经到达目的地</p>
</dl>
<p>
<input type="submit" class="put2" id="qrdd" value="确认"></p>
</div>

</div>

<!--确认已提车-->
<div id="myModa10" style="display:none; z-index:9999" class="tan1">
<div class="tan11">
<a class="closed">X</a>
<h2>确认提车</h2>
<dl>
<p class="vq1">请确认已经安全提到车</p>
</dl>
<p>
<input type="submit" class="put2" id="qrwc" value="确认"></p>
</div>

</div>
<script type="text/javascript">
	var LODOP; //声明为全局变量
	//承运底单打印
	function printKept(order_code,yd_code){
		$.post('/Back/Print/printKept/',{'order_code':order_code,yd_code:yd_code},function(data){
			//调用打印预览
			CreateFullBill3(data);
		  	//LODOP.PRINT_SETUP();
		  	LODOP.PREVIEW();
		})
	}

	function printpact(order_code){
	
		$.post('/Back/Print/printpact/',{'order_code':order_code},function(data){
			//调用打印预览
			CreateFullBill2(data);
			//LODOP.PRINT_SETUP();
		  	LODOP.PREVIEW();
		});
	}

	//运车服务合同
	function CreateFullBill2(data) {
		var car_keys = data.carInfo==null?"":data['carInfo']['verify_car_keys'];
		var km = data.carInfo==null?"":data.carInfo.verify_km;
		var spare_tire = data.carInfo==null?"":data.carInfo.verify_spare_tire;
		var instructions = data.carInfo==null?"":data.carInfo.verify_instructions;
		var tool_kit = data.carInfo==null?"":data.carInfo.verify_tool_kit;
		var warning_sign = data.carInfo==null?"":data.carInfo.verify_warning_sign;
		var lifting_jack = data.carInfo==null?"":data.carInfo.verify_lifting_jack;
		var lighter = data.carInfo==null?"":data.carInfo.verify_lighter;
		var door_mat = data.carInfo==null?"":data.carInfo.verify_door_mat;
		var fire_extinguisher = data.carInfo==null?"":data.carInfo.verify_fire_extinguisher;
		var img_describe_1 = data.carImg[0]==null?"":data.carImg[0].verify_img_describe;
		var code_1=data.carImg[0]==null?"":data.carImg[0].verify_code;
		var img_describe_2 = data.carImg[1]==null?"":data.carImg[1].verify_img_describe;
		var code_2 = data.carImg[1]==null?"":data.carImg[1].verify_code;
		var code_3=data.carImg[2]==null?"":data.carImg[2].verify_code;
		var img_describe_3=data.carImg[2]==null?"":data.carImg[2].verify_img_describe;
		var img_describe_4 = data.carImg[3]==null?"":data.carImg[3].verify_img_describe;
		var code_5 = data.carImg[3]==null?"":data.carImg[3].verify_code;
		var img_describe_6 = data.carImg[4]==null?"":data.carImg[4].verify_img_describe;
		var code_7 = data.carImg[4]==null?"":data.carImg[4].verify_code;
		var img_describe_8=data.carImg[5]==null?"":data.carImg[5].verify_img_describe;
		var code_9 = data.carImg[5]==null?"":data.carImg[5].verify_code;
		var img_describe_11 = data.carImg[6]==null?"":data.carImg[6].verify_img_describe;
		var code_12 = data.carImg[6]==null?"":data.carImg[6].verify_code;
		var orderway = data.orderway==null?"":data.orderway;
		var ordersmsc = data.ordersmsc==null?"":data.ordersmsc;
		var tebie = data.tebie==null?"":data.tebie;
		var number_0 = data.orderInfo==null?"":data.orderInfo.number[0];
		var number_1 = data.orderInfo==null?"":data.orderInfo.number[1];
		var number_2 = data.orderInfo==null?"":data.orderInfo.number[2];
		var number_3 = data.orderInfo==null?"":data.orderInfo.number[3];
		var number_4 = data.orderInfo==null?"":data.orderInfo.number[4];
		var number_5 = data.orderInfo==null?"":data.orderInfo.number[5];
		var brand = data.orderInfo==null?"":data.orderInfo.order_info_brand_type;
		LODOP.PRINT_INITA(10,10,831,1177,"");
		LODOP.ADD_PRINT_SETUP_BKIMG("C:\\Users\\Administrator\\Desktop\\打印模板\\9-1.jpg");
		LODOP.SET_SHOW_MODE("BKIMG_LEFT",0);
		LODOP.SET_SHOW_MODE("BKIMG_TOP",0);
		LODOP.ADD_PRINT_TEXT(73,105,50,22,data.orderInfo.order_info_star_city);
		LODOP.ADD_PRINT_TEXT(72,203,50,22,data.orderInfo.order_info_end_city);
		LODOP.ADD_PRINT_TEXT(106,166,80,22,data.orderInfo.order_info_tclxr[0]);
		LODOP.ADD_PRINT_TEXT(138,171,80,22,data.orderInfo.order_info_sclxr[0]);
		LODOP.ADD_PRINT_TEXT(73,334,36,20,data.yundan.yd_j_time[0]);
		LODOP.ADD_PRINT_TEXT(74,386,22,20,data.yundan.yd_j_time[1]);
		LODOP.ADD_PRINT_TEXT(74,421,21,20,data.yundan.yd_j_time[2]);
		LODOP.ADD_PRINT_TEXT(877,647,34,20,"");
		LODOP.ADD_PRINT_TEXT(877,709,24,20,"");
		LODOP.ADD_PRINT_TEXT(875,686,24,20,"");
		LODOP.ADD_PRINT_TEXT(940,645,34,20,"");
		LODOP.ADD_PRINT_TEXT(942,714,24,20,"");
		LODOP.ADD_PRINT_TEXT(942,688,24,20,"");
		LODOP.ADD_PRINT_TEXT(1026,646,34,20,"");
		LODOP.ADD_PRINT_TEXT(1025,719,24,20,"");
		LODOP.ADD_PRINT_TEXT(1027,687,24,20,"");
		LODOP.ADD_PRINT_TEXT(103,311,135,22,data.orderInfo.order_info_tclxr[2]);
		LODOP.ADD_PRINT_TEXT(100,498,208,22,data.orderInfo.order_info_tclxr[1]);
		LODOP.ADD_PRINT_TEXT(137,312,135,22,data.orderInfo.order_info_sclxr[2]);
		LODOP.ADD_PRINT_TEXT(136,498,208,22,data.orderInfo.order_info_sclxr[1]);
		LODOP.ADD_PRINT_TEXT(184,364,416,22,data.orderInfo.order_info_end_city);
		LODOP.ADD_PRINT_TEXT(263,73,120,22,data.orderInfo.car);
		LODOP.ADD_PRINT_TEXT(165,125,22,22,data.s_way);
		LODOP.ADD_PRINT_TEXT(262,216,122,22,data.orderInfo.order_info_carmark);
		LODOP.ADD_PRINT_TEXT(196,124,22,22,data.x_way);
		LODOP.ADD_PRINT_TEXT(263,369,62,22,data.orderInfo.order_info_price);
		LODOP.ADD_PRINT_TEXT(166,276,22,22,data.s_flag);
		LODOP.ADD_PRINT_TEXT(261,447,60,22,data.orderInfo.order_info_bxd);
		LODOP.ADD_PRINT_TEXT(196,278,22,22,data.m_flag);
		LODOP.ADD_PRINT_TEXT(260,515,67,22,data.orderInfo.order_info_c_car);
		LODOP.ADD_PRINT_TEXT(257,588,194,22,"");
		LODOP.ADD_PRINT_TEXT(322,192,30,17,car_keys);
		LODOP.ADD_PRINT_TEXT(341,187,40,17,km);
		LODOP.ADD_PRINT_TEXT(321,317,30,17,spare_tire);
		LODOP.ADD_PRINT_TEXT(341,316,30,17,instructions);
		LODOP.ADD_PRINT_TEXT(318,447,30,17,tool_kit);
		LODOP.ADD_PRINT_TEXT(343,445,30,17,warning_sign);
		LODOP.ADD_PRINT_TEXT(316,576,30,17,lifting_jack);
		LODOP.ADD_PRINT_TEXT(343,577,30,17,lighter);
		LODOP.ADD_PRINT_TEXT(316,706,30,17,door_mat);
		LODOP.ADD_PRINT_TEXT(338,706,30,17,fire_extinguisher);
		LODOP.ADD_PRINT_TEXT(403,223,383,22,img_describe_1);
		LODOP.ADD_PRINT_TEXT(404,622,160,22,code_1);
		LODOP.ADD_PRINT_TEXT(437,222,383,22,img_describe_2);
		LODOP.ADD_PRINT_TEXT(437,622,161,22,code_2);
		LODOP.ADD_PRINT_TEXT(469,622,162,22,code_3);
		LODOP.ADD_PRINT_TEXT(468,221,382,22,img_describe_3);
		LODOP.ADD_PRINT_TEXT(501,222,383,22,img_describe_4);
		LODOP.ADD_PRINT_TEXT(498,621,160,22,code_5);
		LODOP.ADD_PRINT_TEXT(533,222,383,22,img_describe_6);
		LODOP.ADD_PRINT_TEXT(528,622,160,22,code_7);
		LODOP.ADD_PRINT_TEXT(562,222,383,22,img_describe_8);
		LODOP.ADD_PRINT_TEXT(557,621,160,22,code_9);
		LODOP.ADD_PRINT_TEXT(593,222,383,22,img_describe_11);
		LODOP.ADD_PRINT_TEXT(583,622,160,22,code_12);
		LODOP.ADD_PRINT_TEXT(624,222,383,22,"");
		LODOP.ADD_PRINT_TEXT(625,622,160,22,"");
		LODOP.ADD_PRINT_TEXT(654,222,383,22,"");
		LODOP.ADD_PRINT_TEXT(654,622,160,22,"");
		LODOP.ADD_PRINT_TEXT(732,202,30,20,number_5);
		LODOP.ADD_PRINT_TEXT(732,253,30,20,number_4);
		LODOP.ADD_PRINT_TEXT(732,300,30,20,number_0);
		LODOP.ADD_PRINT_TEXT(732,346,30,20,number_1);
		LODOP.ADD_PRINT_TEXT(732,391,30,20,number_2);
		LODOP.ADD_PRINT_TEXT(732,435,30,20,number_3);
		LODOP.ADD_PRINT_TEXT(1024,182,60,20,"");
		LODOP.ADD_PRINT_TEXT(1025,289,80,20,"");
		LODOP.ADD_PRINT_TEXT(1024,418,163,20,"");
		LODOP.ADD_PRINT_TEXT(69,683,111,22,data.order_code);
		LODOP.ADD_PRINT_TEXT(260,38,136,22,brand);
		LODOP.ADD_PRINT_TEXT(182,53,50,22,orderway);
		LODOP.ADD_PRINT_TEXT(182,208,50,22,ordersmsc);
		LODOP.ADD_PRINT_TEXT(696,119,482,22,tebie);
	};

	//承运底单打印
	function CreateFullBill3(data) {
		LODOP.PRINT_INITA(10,10,831,1177,"");
		LODOP.ADD_PRINT_SETUP_BKIMG("C:\\Users\\Administrator\\Desktop\\打印模板\\9-2.jpg");
		LODOP.SET_SHOW_MODE("BKIMG_LEFT",0);
		LODOP.SET_SHOW_MODE("BKIMG_TOP",0);
		LODOP.ADD_PRINT_TEXT(143,165,252,22,data.yd_company);
		LODOP.ADD_PRINT_TEXT(204,198,60,20,data.yd_name);
		LODOP.ADD_PRINT_TEXT(116,329,36,20,data.yd_j_time[0]);
		LODOP.ADD_PRINT_TEXT(117,387,22,20,data.yd_j_time[1]);
		LODOP.ADD_PRINT_TEXT(117,420,21,20,data.yd_j_time[2]);
		LODOP.ADD_PRINT_TEXT(597,467,34,20,"");
		LODOP.ADD_PRINT_TEXT(597,534,22,20,"");
		LODOP.ADD_PRINT_TEXT(597,508,22,20,"");
		LODOP.ADD_PRINT_TEXT(597,631,34,20,"");
		LODOP.ADD_PRINT_TEXT(597,690,22,20,"");
		LODOP.ADD_PRINT_TEXT(597,668,22,20,"");
		LODOP.ADD_PRINT_TEXT(175,603,159,21,data.yd_carmark);
		LODOP.ADD_PRINT_TEXT(204,328,115,20,data.yd_tel);
		LODOP.ADD_PRINT_TEXT(205,506,176,20,data.yd_indetity);
		LODOP.ADD_PRINT_TEXT(175,164,322,23,data.line);
		LODOP.ADD_PRINT_TEXT(271,214,20,21,data.number[0]);
		LODOP.ADD_PRINT_TEXT(271,278,19,19,data.number[1]);
		LODOP.ADD_PRINT_TEXT(271,340,20,20,data.number[2]);
		LODOP.ADD_PRINT_TEXT(270,401,19,20,data.number[3]);
		LODOP.ADD_PRINT_TEXT(270,465,21,20,data.number[4]);
		LODOP.ADD_PRINT_TEXT(297,163,30,20,data.xStatus);
		LODOP.ADD_PRINT_TEXT(298,312,30,20,data.qStatus);
		LODOP.ADD_PRINT_TEXT(266,596,30,20,"");
		LODOP.ADD_PRINT_TEXT(264,670,30,20,"");
		LODOP.ADD_PRINT_TEXT(264,734,30,20,"");
		LODOP.ADD_PRINT_TEXT(339,166,167,24,data.brand);
		LODOP.ADD_PRINT_TEXT(333,507,280,29,data.carmark);
		LODOP.ADD_PRINT_TEXT(366,220,20,20,data.car_key);
		LODOP.ADD_PRINT_TEXT(367,350,19,19,data.car_tire);
		LODOP.ADD_PRINT_TEXT(365,477,22,21,data.car_kit);
		LODOP.ADD_PRINT_TEXT(362,605,19,19,data.car_jack);
		LODOP.ADD_PRINT_TEXT(362,739,21,19,data.car_mat);
		LODOP.ADD_PRINT_TEXT(389,220,26,19,data.car_km);
		LODOP.ADD_PRINT_TEXT(387,350,21,19,data.car_instructions);
		LODOP.ADD_PRINT_TEXT(385,476,21,19,data.car_sign);
		LODOP.ADD_PRINT_TEXT(382,605,21,19,data.car_lighter);
		LODOP.ADD_PRINT_TEXT(381,739,21,19,data.extinguisher);
		LODOP.ADD_PRINT_TEXT(114,120,46,20,data.star);
		LODOP.ADD_PRINT_TEXT(113,207,47,22,data.end);
		LODOP.ADD_PRINT_TEXT(114,661,79,22,data.yd_code);
		
	};
    //审核
    $('#add1').click(function(event) {
        $('#textaa').val('');
        $('#di2 input').each(function(index, el) {
            if ('1' == $(this).val()) {
                $(this).attr('checked',true);
            }
        });
    });
    //安排提车员
    $('#add2').click(function(event) {
        $('#tcysfz').val('');
        $('#car_cfd').val('');
        $('#car_mdd').val("");
        $('#car_cfd').val("<?php echo ($data["p"]); ?>-<?php echo ($data["c"]); ?>-<?php echo ($data["b"]); ?>");
        $('#car_mdd').val('<?php echo ($data["pe"]); ?>-<?php echo ($data["ce"]); ?>');
        $('#car_sc_time').val('');
        $('#car_order_price').val('');
        // $('#cwgl_t_price').val('');
    });
    //上传保险单
    $('#add4').click(function(event) {
        $('#scfile').html('点击上传保险单');
        $('#bxdtime').val('');
    });
    //修改价格
    $('#add6').click(function(event) {
        $('#xprice').val('');
    });
    //添加物流信息
    $('#add7').click(function(event) {
        $('#wlinfo').val('');
        $('#wltime').val('');
    });
    //添加运单信息
    $('#add8').click(function(event) {
        // $('#csm option').each(function(index, el) {
        //     if ('C' == $(this).val()) {
        //         $(this).attr('selected',true);
        //     }
        // });
        $('#yd_name').val('');
        $('#yd_tel').val('');
        $('#yd_indetity').val('');
        $('#yd_price').val('');
        $('#yd_star').val('');
        $('#yd_end').val('');
        $('#yd_j_time').val('');
        $('#yd_s_time').val('');
        $('#yd_mark').val('');
    });
  	//确认用户提车
    $('#add10').click(function(event) {
        var code = '<?php echo ($code); ?>';//订单号
        $.post('/Back/Order/confirmUC',{'code':code},function(data){
        	if(data=='S'){
        		$.anewAlert('修改成功');
        	}else{
        		$.anewAlert('修改失败');
        	}
        	window.location.reload();
        })
    });
  //确认装板
    $('#add11').click(function(event) {
        var code = '<?php echo ($code); ?>';//订单号
        $.post('/Back/Order/confirmZB',{'code':code},function(data){
        	if(data=='S'){
        		$.anewAlert('修改成功');
        	}else{
        		$.anewAlert('修改失败');
        	}
        	window.location.reload();
        })
    });
  //确认到达
    $('#add12').click(function(event) {
        var code = '<?php echo ($code); ?>';//订单号
        $.post('/Back/Order/confirmDD',{'code':code},function(data){
        	if(data=='S'){
        		$.anewAlert('修改成功');
        	}else{
        		$.anewAlert('修改失败');
        	}
        	window.location.reload();
        })
    });
</script>
<script>
    var ordercode = "<?php echo ($data["order_code"]); ?>";
    //安排提车员
    $('#aptcy').click(function(event) {
        //跳转提车员添加页面
       window.location.href="/Back/CarTaker/carTakerAdd";
    });
    $('#tcysfz').keyup(function(event) {
        $('.dlisrt').show();
        var people = $('#tcysfz').val();
        $.post('/Back/Order/tcy', {people: people}, function(data) {
            var _html = "";
            for (var i = 0; i < data.length; i++) {
               _html += "<li onclick='fjho(this,\""+data[i]['car_name']+"\",\""+data[i]['car_code']+"\",\""+data[i]['car_tel']+"\")'>"+ data[i]['car_name'] +"</li>";
            }
            $('.dlisrt ul').html(_html);
        },'json');
    });
    //安排提车元
    $('#aptcyqr').click(function(event) {
        var car_cfd = $('#car_cfd').attr("names");
        var car_mdd = $('#car_mdd').attr("names");
        var car_jc_time = $('#car_jc_time').val();
        var car_sc_time = $('#car_sc_time').val();
        var car_order_price = $('#car_order_price').val();
        // var cwgl_t_price = $('#cwgl_t_price').val();
        var car_code = $('#tcyaa').val();//提车员code
        var car_pai = '<?php echo ($data["OrderInfo"]["order_info_carmark"]); ?>';
		var kehu='<?php echo ($data["OrderInfo"]["order_info_brand"]); ?>-<?php echo ($data["OrderInfo"]["order_info_type"]); ?>';
		var qidian='<?php echo ($data["p"]); ?>-<?php echo ($data["c"]); ?>-<?php echo ($data["b"]); ?>';
		var tel='<?php echo ($data["stinfo"]["2"]); ?>';
		//var shenfenzheng='<?php echo ($data["stinfo"]["1"]); ?>';
		var zhongdian='<?php echo ($data["pe"]); ?>-<?php echo ($data["ce"]); ?>';
		
        // $('#di3 input').each(function(index, el) {
        //     if ('1' == $(this).val()) {
        //         $(this).attr('checked',true);
        //     }
        // });
        var status = $('#di3 :checked').val();
        if(car_code == ""){
            $.anewAlert('提车员不能为空！');
            return false;
        }  else if (car_order_price == "") {
            $.anewAlert('费用不能为空！');
            return false;
        } /*else if(car_mdd == ""){
            $.anewAlert('目的地不能为空！');
            return false;
        } */ else if(car_jc_time == ""){
            $.anewAlert('接车时间不能为空！');
            return false;
        } else if(car_sc_time == ""){
            $.anewAlert('送车时间不能为空！');
            return false;
        }
        var tcyr = {
            'car_cfd':car_cfd,
            'car_mdd':car_mdd,
            'car_jc_time':car_jc_time,
            'car_sc_time':car_sc_time,
            'order_code':ordercode,
			'car_order_price':car_order_price,
            'car_code':car_code,
            'car_order_status':status,
            'car_pai':car_pai,
			'kehu':kehu,
			'qidian':qidian,
			'tel':tel,
			'zhongdian':zhongdian,
        };
        var orderid = "<?php echo ($data["order_id"]); ?>";
        var price = {
            'order_code':ordercode,
            'order_id':orderid,
        }
        $.post('/Back/Order/tcy_order', {'tcyr': tcyr,'price':price}, function(data) {
        	if(data.flag){
	            $.anewAlert(data.msg);
	            window.location.href=window.location.href;
        	}else{
        		$.anewAlert(data.msg);
        		return false;
        	}
        });
    });
    function fjho(obj,abj,bbj,tel){
        $(obj).parent().parent().hide();
        $('#tcyaa').val(bbj);
        $('#tcysfz').val(abj);
        $("#sfjio").html(tel);
        $("#dfsuh").show();
    }
</script>
<script>
    var order_code = "<?php echo ($data["order_code"]); ?>";
        var orderid = "<?php echo ($data["order_id"]); ?>";
    //修改运单状态
    $('.see1').click(function(event) {
		if (confirm('确认已支付了吗？')) {
			var dd = $(this).attr('dd');
			$(this).parent().prevAll(".ydzt").html('已支付');
			$.post('/Back/Order/yd_status', {code: dd}, function(data) {
				$.anewAlert(data);
				window.location.href=window.location.href;
			},'json');
		}
    });
    //审核
    $('#sh').click(function(event) {
        var textaa = $('#textaa').val();
        var sign = $("#di2").find('input[name="dss"]:checked').val();
        if(sign==2&&textaa==''){
        	$.anewAlert('未通过必须填写原因');
        	window.location.href=window.location.href;
        	return false;
        }
        // if(textaa == ""){
        //     $.anewAlert('备注不能为空！');
        //     return false;
        // }

        $.post('/Back/Order/audit', {code: order_code,textaa:textaa,'sign':sign}, function(data) {
        	if(data.flag){
	            $.anewAlert(data.msg);
	            window.location.href=window.location.href;
        	}else{
        		 $.anewAlert(data.msg);
        		 return false;
        	}
            //window.location.reload();
            //$('#zt').val('已审核');
        });
    });
    //确认提车
    $('#qrtc').click(function(event) {
        $.post('/Back/Order/ticar', {code: order_code}, function(data) {
             $.anewAlert(data);
            $('#zt').val('待装板');
            window.location.href=window.location.href;
        });
    });
    //添加运单
    $('#addyd').click(function(event) {
        var yd_name = $('#yd_name').val();
        var yd_tel = $('#yd_tel').val();
        var yd_indetity = $('#yd_indetity').val();
        var yd_price = $('#yd_price').val();
        var yd_star = $('#yd_star').val();
        var yd_end = $('#yd_end').val();
        var yd_j_time = $('#yd_j_time').val();
        var yd_s_time = $('#yd_s_time').val();
        var yd_mark = $('#yd_mark').val();
        var yd_company = $('#yd_company').val();
        var yd_carmark = $('#yd_carmark').val();

        /* if(yd_name == ""){
            $.anewAlert('姓名不能为空！');
            return false;
        } else  */if(yd_tel == ""){
            $.anewAlert('手机号不能为空！');
            return false;
        } /* else if(yd_indetity == ""){
            $.anewAlert('身份证不能为空！');
            return false;
        } */ else if(yd_price == ""){
            $.anewAlert('费用不能为空！');
            return false;
        } else if(yd_star == ""){
            $.anewAlert('出发地不能为空！');
            return false;
        } else if(yd_end == ""){
            $.anewAlert('目的地不能为空！');
            return false;
        } /* else if(yd_j_time == ""){
            $.anewAlert('接车时间不能为空！');
            return false;
        } else if(yd_s_time == ""){
            $.anewAlert('送车时间不能为空！');
            return false;
        } */ else if(yd_company == ""){
        	$.anewAlert('承运公司名称不能为空！');
            return false;
        } /* else if(yd_carmark == ""){
        	$.anewAlert('承运车辆车牌号不能为空！');
            return false;
        } */
		
        var data = {
            'order_code':order_code,
            'order_id':orderid,
            // 'yd_flag':csm,
            'yd_name':yd_name,
            'yd_tel':yd_tel,
            'yd_indetity':yd_indetity,
            'price':yd_price,
            'yd_star':yd_star,
            'yd_end':yd_end,
            'yd_j_time':yd_j_time,
            'yd_s_time':yd_s_time,
            'yd_mark':yd_mark,
        };
        $.post('/Back/Order/addyd', {data: data,yd_company:yd_company,yd_carmark:yd_carmark}, function(data) {
            $.anewAlert(data['info']);
            var _html = "<tr class='tr2'>";
                _html += "<td>"+data['yd_code']+"</td>";
                _html += "<td>"+data['yd_name']+"<br>"+data['yd_indetity']+"</td>";
                _html += "<td class='td_d2'>"+data['yd_tel']+"</td>";
                _html += "<td class='td_d2'>"+data['yd_star']+"<br>"+data['yd_end']+"</td>";
                _html += "<td class='td_d2'>"+data['price']+"</td>";
                _html += "<td class='td_d2 ydzt'>未支付</td>";
                _html += "<td class='td_d2'>"+data['yd_mark']+"</td>";
                _html += "<td><a class='see1' href='javascript:;' dd='"+data['yd_code']+"'>更改</a></td>";
                _html += "</tr>";
            $('#ydinfo').append(_html);
            window.location.href=window.location.href;
        });
    });
    //修改价格
    $('#xgjg').click(function(event) {
        var price = $('#xprice').val();
        if (price == '') {
            $.anewAlert('价格不能为空！');
            return false;
        }
        $.post('/Back/Order/xgjg', {code: order_code,price:price}, function(data) {
            $.anewAlert(data);
            window.location.href=window.location.href;
        });
    });
    //添加物流信息
    $('#addwl').click(function(event) {
        var wlinfo = $('#wlinfo').val();
        //var wltime = $('#wltime').val();
        var dzb = $('#di4 :checked').val();
        if (wlinfo == "") {
            $.anewAlert('物流信息不能为空！');
            return false;
        }/*  else if(wltime == ""){
            $.anewAlert('时间不能为空！');
            return false;
        } */
        var aarr = {
            'order_id' : orderid,
            'wl_info' : wlinfo,
            'order_code' : order_code,
        }
        $.post('/Back/Order/addwl', {'aarr': aarr,'dzb':dzb}, function(data) {
            $.anewAlert(data['info']);
            var _html = "<li>";
                _html += data['wl_time']+" 物流信息："+data['wl_info'];
                _html += "<a class='on' href='javascript:;' code='"+data['wl_code']+"' onclick='send(this)'>发送短信</a>";
                _html += "</li>";
            $('#wlinfoa').append(_html);
            window.location.href=window.location.href;
        });
    });
    //确认到达
    $('#qrdd').click(function(event) {
        $.post('/Back/Order/qrdd', {code: order_code}, function(data) {
             $.anewAlert(data);
            $('#zt').val('已到达');
            window.location.href=window.location.href;
        });
    });
    //确认安全提车
    $('#qrwc').click(function(event) {
        $.post('/Back/Order/qrwc', {code: order_code}, function(data) {
             $.anewAlert(data);
            $('#zt').val('已完成');
            window.location.href=window.location.href;
        });
    });
    //发送短信
function send(obj){
       var a = $(obj).attr('class');
       if (a == 'on') {
           var code = $(obj).attr('code');
           var q = $("#sgijsd").val();
           var z = $('#gojir').val();
           $.post('/Back/Order/sms', {code: code,q:q,z:z}, function(data) {
        	   if(data.flag){
        		   $.anewAlert(data.msg);
        	   }else{
        		   $.anewAlert(data.msg);
        	   }
           },'json');
           $(obj).removeClass('on')
       }
}
    //上传保险单
    $('#scbxd').click(function(event) {
        //var bxdtime = $('#bxdtime').val();
        var bxdfile = $('#pic').val();
        if (bxdfile == '') {
            $.anewAlert('保险单不能为空！');
            return false;
        }/*  else if (bxdtime == '') {
            $.anewAlert('时间不能为空！');
            return false;
        } */
        var data = {
            'order_id':orderid,
            'bxd_file':bxdfile,
            //'bxd_time':bxdtime,
            'order_code':order_code
        }
        $.post('/Back/Order/bxd', {data: data}, function(data) {
             $.anewAlert(data);
              window.location.href=window.location.href;
        },'json');
    });
</script>
<script>
    $(function(){
        var up = $('#upload').Huploadify({
            auto:true,
            fileTypeExts:'*.pdf',
            multi:false,
            fileSizeLimit:10240,
            showUploadedPercent:false,
            showUploadedSize:false,
            removeTimeout:1000,
            abs:1,//隐藏按钮序号
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
                    $("#pic").val(datas.fileurl);
                    $('#scfile').html('上传成功！');
                    //$("#show").attr('src',datas.fileurl);
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

    });
</script>
</body>

</html>