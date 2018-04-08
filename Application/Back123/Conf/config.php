<?php
return array(
	//'配置项'=>'配置值'
	/* 默认设定 */
	'DEFAULT_M_LAYER'       =>  'Model', // 默认的模型层名称
	'DEFAULT_C_LAYER'       =>  'Controller', // 默认的控制器层名称
	'DEFAULT_V_LAYER'       =>  'View', // 默认的视图层名称
	'DEFAULT_LANG'          =>  'zh-cn', // 默认语言
	'DEFAULT_THEME'         =>  '',	// 默认模板主题名称
	'DEFAULT_MODULE'        =>  'Back',  // 默认模块
	'DEFAULT_CONTROLLER'    =>  'Login', // 默认控制器名称
	'DEFAULT_ACTION'        =>  'index', // 默认操作名称
	'DEFAULT_CHARSET'       =>  'utf-8', // 默认输出编码
	'DEFAULT_TIMEZONE'      =>  'PRC',	// 默认时区
	'DEFAULT_AJAX_RETURN'   =>  'JSON',  // 默认AJAX 数据返回格式,可选JSON XML ...
	'DEFAULT_JSONP_HANDLER' =>  'jsonpReturn', // 默认JSONP格式返回的处理方法
	'DEFAULT_FILTER'        =>  'htmlspecialchars', // 默认参数过滤方法 用于I函数...
    /* 错误页面模板 */
    'TMPL_ACTION_ERROR'     =>  MODULE_PATH.'View/public/error.html', // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS'   =>  MODULE_PATH.'View/public/success.html',  // 默认成功跳转对应的模板文件
    'TMPL_EXCEPTION_FILE'   =>  MODULE_PATH.'View/public/exception.html', // 异常页面的模板文件
    'ERROR_PAGE' =>MODULE_PATH.'View/public/exception.html',


);