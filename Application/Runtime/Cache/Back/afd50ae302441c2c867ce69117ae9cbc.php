<?php if (!defined('THINK_PATH')) exit();?>	    <!DOCTYPE html>
	<html>
	<head>
		<title>数据库备份</title>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, ,initial-scale=0.5,minimum-scale=0.5,maximum-scale=0.5, user-scalable=no" />
		<link rel="stylesheet" href="/Public/Back/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/Public/Back/css/bootstrap-responsive.min.css" />
		<link rel="stylesheet" href="/Public/Back/css/unicorn.main.css" />
		<link rel="stylesheet" href="/Public/Back/css/unicorn.grey.css" class="skin-color" />
		<link rel="stylesheet" href="/Public/Back/css/li.css" class="skin-color" />
		<link href="/Public/Back/css/adminia.css" rel="stylesheet" />
		<link href="/Public/Back/css/yao.css" rel="stylesheet" class="skin-color" />
	
		<script src="/Public/JS/jquery-1.7.2.min.js"></script>
		<script src="/Public/Back/js/bootstrap.js"></script>
		<!--[if lt IE 9]>
		<script src="js/html5.js"></script>
		<![endif]-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<style>.l_table table tr td.td_d{width:200px;}</style>
	</head>
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
        </div>
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
                <!-- <div class="ico-pt span12">
                <h4>店铺管理</h4>
                </div>
                -->
                <div class="row">
                    <div class="tsan113">
                        <div class="widget">
                            <div class="tabbable">
                                <ul class="nav nav-tabs" id="tabnav">
                                    <li class="active">
                                        <a href="<?php echo U('Database/exportPage');?>">
                                            	数据库备份
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo U('Database/importPage');?>">
                                            	数据库还原
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content1">
                                    <div class="tab-content">
                                        <div class="control-group">
                                            &nbsp;&nbsp;&nbsp;
                                            <button onclick="dbExportFun('A');" class="btn btn-default5" type="button">
                                                	立即备份
                                            </button>
                                            &nbsp;&nbsp;&nbsp;
                                            <button class="btn btn-default6" onclick="dbExportFun('B');" type="button">
                                                	优化表
                                            </button>
                                            &nbsp;&nbsp;&nbsp;
                                            <button onclick="dbExportFun('C');" class="btn btn-default7" type="button">
                                                	修复表
                                            </button>
                                            &nbsp;&nbsp;&nbsp;
                                            <button class="btn btn-default8" type="button">
                                                	共<?php echo ($count); ?>张表
                                            </button>
                                        </div>
                                        <div class="tab-pane active">
                                            <form id="edit-profile" class="form-horizontal" />
                                            <fieldset>
                                                <div class="l_uit">
                                                    <script>
                                                        $(function() {
                                                            $('table tr.tr2:odd').css('background', '#F0F0F0');
                                                        });
                                                    </script>
                                                    <div class="l_table">
                                                        <table>
                                                            <tr class="tr1">
                                                                <td>
                                                                	<input class="check-all" checked="checked"  type="checkbox" onclick="checkboxALLFun(this);" id="checkboxAllid">
                                                                </td>
                                                                <td>
                                                                	表名
                                                                </td>
                                                                <td>
                                                                	数据量
                                                                </td>
                                                                <td>
                                                                	数据大小
                                                                </td>
                                                                <td>
                                                                	创建时间
                                                                </td>
                                                                <td>
                                                                	备份时间
                                                                </td>
                                                                <td>
                                                                	备份状态
                                                                </td>
                                                                <td>
                                                                	操作
                                                                </td>
                                                            </tr>
                                                            <?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$table): $mod = ($k % 2 );++$k;?><tr class="tr2">
	                                                                <td class="td3 num">
	                                                                    <input class="ids"  type="checkbox" name="tables_<?php echo ($k); ?>" value="<?php echo ($table["name"]); ?>" onclick="checkboxOnlyFun(this);">
	                                                                </td>
                                                                	<td><?php echo ($table["name"]); ?></td>
                                                                	<td><?php echo ($table["rows"]); ?></td>
                    												<td><?php echo (format_bytes($table["data_length"])); ?></td>
                    												<td class="td_d2"><?php echo ($table["create_time"]); ?></td>
                    												<td class="td_d2"><?php echo ($table["backups_date"]); ?></td>
                                                                	<td class="td_d2">
												                    	<?php if($table["status"] == 'Y'): ?>已备份
																		    <?php else: ?>
																		        未备份<?php endif; ?>
																	</td>
                                                                <td>
                                                                    <a class="see1" href="<?php echo U('Database/optimize?tables='.$table['name']);?>">优化表</a>&nbsp;
                        											<a class="see2" href="<?php echo U('Database/repair?tables='.$table['name']);?>">修复表</a>
                                                                </td>
                                                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                                        </table>
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

 <script type="text/javascript">
  	function checkboxALLFun(obj){
  		if($(obj).is(':checked')){
  			 $("input[name^='tables_']").attr("checked", true);
  		}else{
  			$("input[name^='tables_']").attr("checked", false);
  		}
  	}
  	function checkboxOnlyFun(obj){
  		if($(obj).is(':checked')){
  			var flag = true;
 			 $("input[name^='tables_']").each(function () {
 				 if(!$(this).is(':checked')){
 					 $("#checkboxAllid").attr("checked", false);
 					 flag = false;
 					 return false;
 				 }
 			 });
 			 if(flag){
	 			$("#checkboxAllid").attr("checked", true);
 			 }else{
 				$("#checkboxAllid").attr("checked", false);
 			 }
 		}else{
 			$("#checkboxAllid").attr("checked", false);
 		}
  	}
  	
  	//数据备份
    function dbExportFun(mark){
  		$("#loading").show();
  		var tablename = "";
    	$("input[name^='tables_']").each(function () {
			 if($(this).is(':checked')){
				 tablename += $(this).val()+";";
			 }
		 });
    	tablename = tablename.substring(0,(tablename.length-1));
    	if(tablename==""){
    		alert("请选择需要备份的表");
    		return false;
    	}
    	var url="/Back/Database/export";
    	if(mark=="B"){
    		/*
    		if(tablename.indexOf(';')>0){
    			tablename = tablename.split(";");
    		}
    		*/
    		url='/Back/Database/optimize';
    	}else if(mark=="C"){
    		/*
    		if(tablename.indexOf(';')>0){
    			tablename = tablename.split(";");
    		}
    		*/
    		url='/Back/Database/repair';
    	}
    	$.post(url,{tables:tablename,mark:mark},function(data){
    		if(data.flag){
    			alert(data.msg);
    			$("#loading").hide();
    			window.location.href = "/Back/Database/exportPage.html";
    		}else{
    			alert(data.msg);
    			$("#loading").hide();
    		}
    	})
    }
    </script>
<!-- 弹出层 -->
<div id="loading" style="position:fixed;left:0;top:0;width:100%;height:100%;background:rgba(0,0,0,0.8);text-align:center;z-index:10000;display: none;">
<img src="/Public/Back/images/loading.gif" style="padding-top:18%;" />
</div>
<!-- 弹出层 -->
</body>
</html>