	$.ajaxSetup({
	  async: false
	});
	function checksecu(obj){
		var price = $(obj).val();
		if(price == ''){
			return false;
		}
		var price = parseInt(price)*10000;
		var z = /^[1-9]\d*$/;
		if(z.test(price)){
			$.post('/Front/Index/getSecu',{'price':price},function(data){
				if(data!=''&&data!=null){
					$("#sprice").val(data);
					$("#secu").html(data);
					var eprice = $("#eprice").val();
					var maoli = $("#maoli").val();
					var tprice = $("#tprice").val();
					var total = parseInt(eprice)/100 + parseInt(tprice) + parseInt(data) + parseInt(maoli)/100;
					$("#zong").html(total);
					$("#total").val(total);
				}else{
					$("#sprice").val(0);
					$("#secu").html(0);
					var eprice = $("#eprice").val();
					var maoli = $("#maoli").val();
					var tprice = $("#tprice").val();
					var total = parseInt(eprice)/100 + parseInt(tprice) + parseInt(data) + parseInt(maoli);
					$("#zong").html(total);
					$("#total").val(total);
				}
			})
		}else{
			return false;
		}
	}
	//正常下单
	function getCityz(pid,sign,name){
		$.post('/Front/Index/getCity',{'pid':pid},function(data){
			var num = data.length;
			if(sign=='S'){
				var str = '';
			}else{
				var str = '';
			}
			console.log(data);
			for(var i=0;i<num;i++){
				if(sign=='S'){
					str += '<li onclick="getBlockz(\''+data[i]['area_id']+'\',\'S\',\''+data[i]['area_name']+'\');">'+data[i]['area_name']+'</li>';
				}
				if(sign=='E'){
					str += '<li onclick="closeFz(\''+data[i]['area_id']+'\',\'E\',\''+data[i]['area_name']+'\');">'+data[i]['area_name']+'</li>';
				}
			}
			if(sign=='S'){
				$("#qspz").hide();
				//$("#qsrez").val('');
				//$("#qsrcz").val('');
				$("#sproz").val('');
				$("#maoliz").val(0);
				$("#tpricez").val(0);
				$("#totalz").val(0);
				$("#tiz").val(0);
				$("#sansz").val('');
				$("#feesanz").val(0);
				$("#tidz").val('');
				//$("#epricez").val(0);
				$("#qsrez").val(pid);
				$("#qsrcz").val(name);
				$("#qscz li").empty();
				$("#qscz").append(str);
				$("#qscz").show();
			}
			if(sign=='E'){
				$("#qepz").hide();
				$("#qerez").val('');
				$("#qercz").val('');
				$("#eproz").val('');
				$("#maoliz").val(0);
				$("#tpricez").val(0);
				$("#totalz").val(0);
				$("#songz").val(0);
				$("#sanez").val('');
				$("#feesanz").val(0);
				$("#sidz").val('');
				//$("#epricez").val(0);
				$("#qerez").val(pid);
				$("#qercz").val(name);
				$("#qecz li").empty();
				$("#qecz").append(str);
				$("#qecz").show();
			}
		});
	}
	function getBlockz(pid,sign,name){

		$.post('/Front/Index/getBlock',{'pid':pid},function(data){
			var num = data.length;
			var str = '';
			for(var i=0;i<num;i++){
				if(sign=='S'){
					str += '<li onclick="closeFz(\''+data[i]['area_id']+'\',\'S\',\''+data[i]['area_name']+'\');">'+data[i]['area_name']+'</li>';
				}
			}
			if(sign=='S'){
				$("#qscz").hide();
				var old = $("#qsrez").val();
				var olds = $("#qsrcz").val();
				var ne = old+','+pid;
				$("#tidz").val(ne);
				var nes = olds+'-'+name;
				$("#qsrez").val(ne);
				$("#qsrcz").val(nes);
				$("#qsbz li").empty();
				$("#qsbz").append(str);
				$("#qsbz").show();
			}
			if(sign=='E'){
				$("#qecz").hide();
				var old = $("#qerez").val();
				var olds = $("#qercz").val();
				var ne = old+','+pid;
				var nes = olds+'-'+name;
				$("#qerez").val(ne);
				$("#qercz").val(nes);
				$("#qebz li").empty();
				$("#qebz").append(str);
				$("#qebz").show();
			}
		})
	}
	function closeFz(pid,sign,name){
		$("#dataz").val('Y');
		if(sign=='S'){
			$("#qsbz").hide();
			var old = $("#qsrez").val();
			var olds = $("#qsrcz").val();
			var ne = old+','+pid;
			var nes = olds+'-'+name;
			$("#tidz").val(ne);
			var sidz = $("#sidz").val();
			var carid = $('#carids').val();
			$("#qsrez").val(ne);
			$("#qsrcz").val(nes);
			$("#qspz").show();
			if(ne!="" && sidz!=""){
				getLine(ne,sidz,carid);
			}
		}
		if(sign=='E'){
			$("#qecz").hide();
			var old = $("#qerez").val();
			var olds = $("#qercz").val();
			var ne = old+','+pid;
			$("#sidz").val(ne);
			var tidz = $("#tidz").val();
			var carid = $('#carids').val();
			var nes = olds+'-'+name;
			$("#qerez").val(ne);
			$("#qercz").val(nes);
			$("#qepz").show();
			if(ne!="" && sidz!=""){
				getLine(tidz,ne,carid);
			}
		}
		$('.selected0,.selected').hide();
	}

	function getTypez(pid,name){
		$("#qbtz").html('');
		$("#qsctez").val('');
		$("#epricez").val(0);
		$("#qtz li").empty();
		$.post('/Front/Index/getType',{'pid':pid},function(data){
			var num = data.length;
			var str = '';
			console.log(data);
			for(var i=0;i<num;i++){
				str += '<li onclick="closeFFz(\''+data[i]['cxjj_id']+'\',\''+data[i]['cxjj_brand']+'\');">'+data[i]['cxjj_name']+'--'+data[i]['cxjj_brand']+'</li>';
			}
			$('#qtz').append(str);
			$("#qbrz").hide();
			$("#qtz").show();
			$("#qbtz").val(name);
			$("#qsctez").val(name);
		})
	}
	function closeFFz(pid,name,price){
		$('#carids').val(pid);
		var qsrez = $("#qsrez").val();
		var qerez = $("#qerez").val();
		$("#qsctcz").val('');
		$("#qtz").hide();
		$("#qbrz").show();
		$("#qsctcz").val(name);
		var brand = $("#qsctez").val();
		var brandType = brand +'-'+ name;
		$("#qbtz").val(brandType);
		var trans = $("#tpricez").val();
		var maoli = $("#maoliz").val();
		if(qsrez!="" && qerez!=""){
			getLine(qsrez,qerez,pid);
		}
		//关闭
		$('.selected0,.selected').hide();
	}

	function goOrder(){
		var qstart = $("#qsrez").val();
		var qend = $("#qerez").val();
		var qbrand = $("#qsctez").val();
		var qtype = $("#qsctcz").val();
		var maoli = $("#maoliz").val();
		var lineprice = $("#lineprice").val();
		if(qstart == '' || qend==""){
			layer.msg('请选择出发地与目的地');
			return false;
		}
		/*if($("#flag").val()=='N'){
			layer.msg('线路正在完善中');
			return false;
		}*/
		if(qstart==''||qend==''||qbrand==''||qtype==''||maoli=='' || lineprice==''){
			layer.msg('请完整录入信息');
			return false;
		}
		$("#quickz").submit();
	}
	function clearAll(){
		$("#qsrez").val('');
		$("#qerez").val('');
		$("#qsctez").val('');
		$("#qsctcz").val('');
		$("#totalz").val(0);
		$("#zongz1").html(0);
		$("#tiz").val(0);
		$("#songz").val(0);
		$("#sansz").val('');
		$("#sanez").val('');
		$("#feesanz").val(0);
		$("#tidz").val('');
		$("#sidz").val('');
		$("#maoliz").val(0);
		$("#qsrcz").val('');
		$("#qercz").val('');
		$("#qbtz").val('');
		$("#zongz").html(0);
		$('#carids').val(0);
	}
	/**
	 * 公共请求方法
	 * string str 起始地
	 * string end 目的地
	 * string carid 车型id
	 */
	function getLine(str,end,carid){
			$.post("/Front/Index/getLine",{str:str,end:end,carid:carid},function(data){
			console.log(data);
			if(data.flag){
				$("#putong2").html('<dt>&nbsp;</dt><dd><bold class="ptd1"></bold> 费用：￥<bold id="zongz1">0</bold>元</dd>');
				//$("#putong2").show();
				//$(".ptd1").html(data.ends);
				$("#zongz1").html(data.totel);
				$("#lineprice").val(data.line);
				$("#product_type").val(data.product_type);
				$("#totalz").val(data.totel);
				$("#tiz").val(data.ti);
				$("#songz").val(data.song);
				$("#maoliz").val(data.mao);
				$("#flag").val("Y");
				$("#qsrezname").val(data.str_add);
				$("#qerezname").val(data.end_add);
				//$("#zongz2").html(0);
				$("#totelz").html(data.totel);
				totelFun();
			}else{
				$("#putong2").html(data.msg);
				//$("#msg").val(data.msg);
				$("#flag").val("N");
				$("#heji").html(0);
				$("#totelz").html(0);
				$("#product_type").val(data.product_type);
				$("#qsrezname").val(data.str_add);
				$("#qerezname").val(data.end_add);
				$("#zongz1").html(0);
			}

			},'json');
        $("#xdtable .xddiv").attr('style',"background:#ff8000;");
        $("#xdtable .xddfont").attr('style',"color:#ffffff;");
	}

	//费用计算公共方法
	function totelFun(){
		var yunPirce = parseInt($("#totelz").html());
		var baoPirce = parseInt($("#baoprice").html());
		
		var yuns = parseInt($("#yuns").html());
		var bao = parseInt($("#bao").html());
		var xiprice = parseInt($("#xiprice").html());
		var smsprice = parseInt($("#smsprice").html());
		var youhui = parseInt($('#youhui').html());
		if(!isNaN(yunPirce) && !isNaN(baoPirce)){
			//计算第二步
			var totel = yunPirce+baoPirce;
			$("#totalz").val(totel);
			$("#heji").html(totel);
		}else if(!isNaN(yuns) && !isNaN(bao) && !isNaN(xiprice) && !isNaN(smsprice) && !isNaN(youhui)){
			//计算第三步
			if(youhui!=0){
				var totel = yuns+bao+xiprice+smsprice-youhui;
			}else{
				var totel = yuns+bao+xiprice+smsprice;
			}
			var totels = yuns+bao+xiprice+smsprice;
			$("#heji").html(totel);
			$("#rthrtwe").html(totels);
			$('#totalz').val(totels);
		}
		
	}
	function serchCar(obj){
		var val = $(obj).val();
		$("#qbtz").html('');
		$("#qsctez").val('');
		$("#epricez").val(0);
		$("#qtz li").empty();
		if(val!=""){
			$.post('/Front/Index/getTypeSerch',{'name':val},function(data){
				var num = data.length;
				var str = '';
				//console.log(data);
				for(var i=0;i<num;i++){
					str += '<li onclick="getTypez(\''+data[i]['cxjj_id']+'\',\''+data[i]['cxjj_brand']+'\');">'+data[i]['cxjj_name']+'--'+data[i]['cxjj_brand']+'</li>';
				}
				$('#qtz').append(str);
				$("#qbrz").hide();
				$("#qtz").show();
				$("#qbtz").val(name);
				$("#qsctez").val(name);
			})
		}
		
	}