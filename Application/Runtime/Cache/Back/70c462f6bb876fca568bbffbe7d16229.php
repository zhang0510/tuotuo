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
                                    <li>
                                        <a href="<?php echo U('Database/exportPage');?>">
                                            	数据库备份
                                        </a>
                                    </li>
                                    <li class="active">
                                        <a href="<?php echo U('Database/importPage');?>">
                                            	数据库还原
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content1">
                                    <div class="tab-content">
                                        <div class="control-group">
                                            &nbsp;&nbsp;&nbsp;
                                            <input type="text" value="数据库还原请慎用" class="fgru" style="margin-left:0px;margin-right:5px;color: red;" disabled="disabled">
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
                                                                	备份名称
                                                                </td>
                                                                <td>
                                                                	卷数
                                                                </td>
                                                                <td>
                                                                	数据大小
                                                                </td>
                                                                <td>
                                                                	备份时间
                                                                </td>
                                                                <td>
                                                                	操作
                                                                </td>
                                                            </tr>
                                                            <?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($k % 2 );++$k;?><tr>
										                        <td><?php echo (date('Ymd-His',$data["time"])); ?></td>
										                        <td><?php echo ($data["part"]); ?></td>
										                        <td><?php echo (format_bytes($data["size"])); ?></td>
										                        <td><?php echo (date('Y-m-d H:i:s',$data["time"])); ?></td>
										                        <td class="action">
											                        <a class="see1" href="<?php echo U('import?time='.$data['time']);?>">还原</a>&nbsp;
                  													<a class="see2" href="<?php echo U('del?time='.$data['time']);?>" onclick="if(confirm('确定删除?')==false)return false;">删除</a>
										                        </td>
										                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="l_fenye">
													<?php echo ($list["show"]); ?>
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
</body>
</html>