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
<script>
	$(document).ready(function(){
		var type=$("#ftype").val();
		var status = $("#fstatus").val();
		if(type!=''){
			$("#"+type).attr('selected',true);
		}
		$("#li"+status).siblings().removeClass('active');
		$("#li"+status).addClass('active');
	});
	function add(){
		//$.anewAlert(1);
		$("#tan").show();
		$("#bg").show();
	}
	function closeFun(){
		$("#tan").hide();
		$("#bg").hide();
	}
	function delFun(obj){
		var type=$("#ftype").val();
		var id = $(obj).attr('name');
		if(confirm("是否作废")){
			$.post('/Back/Couponyjh/del',{'id':id},function(data){
				if(data.sign=='Y'){
					$.anewAlert(data.cont);
					window.location.reload();
				}else{
					$.anewAlert(data.cont);
				}
			})
		}else{
			return false;
		}
	}
	function selectAll(obj){
		if($(obj).attr("checked")){
			$(".td3").children().attr('checked',true);
		}else{
			$(".td3").children().removeAttr('checked');
		}
	}
	function delAll(){
		var obj = $("input[name='code[]']:checked");
		var arr = new Array();
		obj.each(function(key,val){
			arr[key]=$(val).val();
		}
		);
		if(confirm("是否删除")){
			$.post('/Back/Couponyjh/delAll',{'arr':arr},function(data){
				 if(data=='Y'){
					 alert("删除成功");
					window.location.reload();
				}else{
					alert("删除失败");
				} 
			});
		}else{
			return false;
		}

	}
	function send(obj){
		var id = $(obj).attr("name");
		$("#asCodeId").val(id);
		$("#bg").show();
		$("#assign").show();
	}
	function closeAssign(){
		$("#bg").hide();
		$("#assign").hide();
	}
	function assigns(obj){
		var phoneNum = $(obj).parent().prev().children("input").val();
		var codeId = $(obj).parent().prev().prev().val();
		$.post('/Back/Coupon/assigns',{'phoneNum':phoneNum,'codeId':codeId},function(data){
			if(data['sign']=='Y'){
				$.anewAlert(data['con']);
				window.location.reload();
			}else{
				$.anewAlert(data['con']);
			} 
		})
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
							
						</ul>

						<div class="tab-content1">
							<div class="tab-content">
								<div class="tab-pane active">
									<form id="edit-profile" class="form-horizontal" />
									<fieldset>
										<div class="l_uit">
											<div class="control-group">

												<div style="float:left;" class="controls clec_t">
												<input type="hidden" id="ftype" value="<?php echo ($type); ?>"/>
												<form method="get" action="__MODUlE__/Coupon/couponList">
												
												<div class="v_pb">
													<input type="text" placeholder="请输入优惠券编码" class="i_n text2 width360" name="code" value="<?php echo ($code); ?>"/>
													<button class="btn btn-default5" type="submit">搜索</button>
												</div>
												</form>
												</div>
												<!-- /controls -->
												<a href="/Back/Couponyjh/addFav"><button class="red btn btn-default5 fr" type="button" >添加优惠券</button></a>

											</div>
											<script>
												$(function(){
													$('table tr.tr2:odd').css('background','#F0F0F0');
												});
												
											</script>
											<div class="l_table">
												<table>
													<tr class="tr1">
														<td><input type="checkbox" id="" onclick="selectAll(this);"/>全选</td>
														<td>优惠券编码</td>
														<td>优惠卷可用开始时间</td>
														<td>优惠卷可用结束时间</td>
														<td>面值</td>
														<td>状态</td>
														<td>操作</td>
													</tr>
													<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr class="tr2">
														<td class="td3"><input name="code[]" type="checkbox" name="id" value="<?php echo ($vo["fav_code"]); ?>" class="box"></td>
														<td><?php echo ($vo["fav_code"]); ?></td>
														<td><?php echo ($vo["fav_startime"]); ?></td>
														<td><?php echo ($vo["fav_endtime"]); ?></td>
														<td class="td_d2"><?php echo ($vo['fav_price']/100); ?>元</td>
														<td>
															<?php if($vo['fav_status'] == 'Y'): ?>已用
															<?php else: ?>
															未用<?php endif; ?>
														</td>
														<td>
															<!--<a class="see4" href="javascript:;">导出</a>-->
															<a class="see1" href="/Back/Couponyjh/couponEdit/id/<?php echo ($vo["fav_id"]); ?>">修改</a>
															<a class="see2" href="javascript:;" name="<?php echo ($vo["fav_id"]); ?>" onclick="delFun(this);">作废</a>
														</td>
													</tr><?php endforeach; endif; ?>
												</table>
											</div>
											<div class="l_fenye">
												<div class="sad">
													<button type="button" class="btn btn-default5" onClick="daochu()" >导出</button>

													<button type="button" class="btn btn-default6" onclick="delAll();">删除</button>
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
	</div>
	<div class="bg" id="bg" style="display:none"></div>
<div class="tan1" id="tan" style="display:none">
	<form method="get" action="/Back/Coupon/couponAdd">
   <div class="tan11">
    <h2>请选择优惠卷类型</h2>
     <ul class="tanul">
	  <li>
	  <label>
	  <div class="tana">
	  <img src="/Public/Back/images/dq6.png">
	  <h2>起始地使用优惠劵</h2>
	  </div>
	  <input checked name="rr1" value="1" type="radio">
	  </label>
	  </li>
	   <li>
	  <label>
	   <div class="tana">
	  <img src="/Public/Back/images/dq6.png">
	  <h2>目的地使用优惠劵</h2>
	  </div>
	  <input name="rr1" value="2" type="radio">
	  </label>
	  </li>
	    <li>
	  <label>
	   <div class="tana">
	  <img src="/Public/Back/images/dq6.png">
	  <h2>集散地使用优惠劵</h2>
	  </div>
	  <input name="rr1" value="3" type="radio">
	  </label>
	  </li>
	    <li>
	  <label>
	   <div class="tana">
	  <img src="/Public/Back/images/dq6.png">
	  <h2>通用类型优惠劵</h2>
	  </div>
	  <input name="rr1" value="4" type="radio">
	  </label>
	  </li>
	 </ul>
      <!-- <p><input type="submit" class="put1" value="确认"></p>
      <p><input type="button" class="put1" value="取消" onclick="closeFun();"></p> -->
      <p>
	 <input type="submit" class="put2" value="确认">
	 <input type="reset" class="put3" value="取消" onclick="closeFun();">
	 </p>
   </div>
   </form>
</div>
<div class="tan1" id="assign" style="display:none">
   <div class="tan11">
    <h2>请输入用户手机号</h2>
    <input type="hidden" name="codeId" id="asCodeId" />
    <dl><input type="text" placeholder="请输入手机号" class="put1" name="phoneNum"></dl>
     <p>
	 <input type="submit" class="put2" value="确认" onclick="assigns(this);">
	 <input type="reset" class="put3" value="取消" onclick="closeAssign();">
	 </p>
	 <!-- <p><input type="submit" class="put1" value="取消" onclick="closeAssign();"></p> -->
   </div>

</div>
<script>
function daochu(){	
	var selid = '';
		  $(".box:checked").each(function(){
			   if(selid==''){
				   selid=$(this).val();
			   }else{
				   selid = selid+','+$(this).val();
			   }
			         
		  })
		  if(selid == ""){
			$.anewAlert('请勾选想导出的订单！');
			return false;
		  }else{
			window.location.href="/Back/Couponyjh/daochu/code/"+selid;
		  }
		   
}
</script>
</body>
</html>