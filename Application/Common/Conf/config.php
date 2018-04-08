<?php
return array(
	//'配置项'=>'配置值'
	'URL_MODULE_MAP' => array (
			'ttyc' => 'Front',//前台
			'ttback' => 'Back'//后台
	),
	//加载App下Common配置
	'LOAD_EXT_FILE'=>'functions',
	//配置加载APP下自定义配置
	"LOAD_EXT_CONFIG" => array('STATIC_PROPERTY'=>'staticproperty'),
	//配置上传图片相关数据
	'UPLOAD_CONFIG' => array(
			'mimes'         =>  array(), //允许上传的文件MiMe类型
			'maxSize'       =>  0, //上传的文件大小限制 (0-不做限制)
			'exts'          =>  array('jpg','png','gif','jpeg','mp4'), //允许上传的文件后缀
			'autoSub'       =>  true, //自动子目录保存文件
			'subName'       =>  array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
			'rootPath'      =>  './Upload/', //保存根路径
			'savePath'      =>  '', //保存路径
			'saveName'      =>  date("Ymd",time()).mt_rand(10000,99999),//array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
			'saveExt'       =>  '', //文件保存后缀，空则使用原后缀
			'replace'       =>  true, //存在同名是否覆盖
			'hash'          =>  true, //是否生成hash编码
			'callback'      =>  false, //检测文件是否存在回调，如果存在返回文件信息数组
			'driver'        =>  'Local', // 文件上传驱动
			'driverConfig'  =>  array(), // 上传驱动配置
	),
	//配置上传文件相关数据
    'UPLOADFILE_CONFIG' => array(
        'mimes'         =>  array(), //允许上传的文件MiMe类型
        'maxSize'       =>  0, //上传的文件大小限制 (0-不做限制)
        'exts'          =>  array('pdf'), //允许上传的文件后缀
        'autoSub'       =>  true, //自动子目录保存文件
        'subName'       =>  array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
        'rootPath'      =>  './Upload/', //保存根路径
        'savePath'      =>  '', //保存路径
        'saveName'      =>  array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
        'saveExt'       =>  '', //文件保存后缀，空则使用原后缀
        'replace'       =>  true, //存在同名是否覆盖
        'hash'          =>  true, //是否生成hash编码
        'callback'      =>  false, //检测文件是否存在回调，如果存在返回文件信息数组
        'driver'        =>  'Local', // 文件上传驱动
        'driverConfig'  =>  array(), // 上传驱动配置
    ),
	//图片根路径
	'IMGPATH' => '/Upload/',
	
	'TMPL_PARSE_STRING' => array (
			'__HTTP__' => 'http://',
			'__JS__' => '/Public/JS', // 增加新的JS类库路径替换规则
			'__BACK__' => '/Public/Back', // 增加新的后台路径替换规则
			'__FRONT__' => '/Public/Front', // 增加新的前端路径替换规则
			'__UPIMG__' => '/Upload', // 上传图片跟路径替换规则
			'__MDP__'=>'/Public/My97DatePicker',//日期插件
			'__UE__'=>'/Public/ueditor',//日期插件
			'__UET__'=>'/Public/ueditor1',//日期插件
			'__UPLOADIFY__' => '/Public/uploadify', // 加新的JS类库路径替换规则
	),
	/* 数据库设置 */
	'DB_TYPE' =>  'mysql',     // 数据库类型
	'DB_HOST' =>  '120.27.96.249', // 服务器地址
	'DB_NAME' =>  'ttyc1',          // 数据库名
	'DB_USER' =>  'root',      // 用户名
	'DB_PWD'  =>  'tuotuo123sql&',          // 密码
	'DB_PORT' =>  '3306',        // 端口
	'DB_PREFIX' =>  'tuo_',    // 数据库表前缀
	
	'DB_PATH_NAME'=> 'DBbackups',        //备份目录名称,主要是为了创建备份目录
	'DB_PATH'     => './DBbackups/',     //数据库备份路径必须以 / 结尾；
	'DB_PATH_DP'  => 'DBbackups/',    //数据库备份路径
    //设置SESSION超时时间
    'STATIC_PROPERTY' => array('BACK_LOGIN_TIME'=>'600'),
    
    //短信接口账户密码
    //'DUAN_ADMIN'=>'98a900',
    //'DUAN_PASWORD'=>'p9vyrblgwh',
    'DUAN_ADMIN'=>'98a9b7',
    'DUAN_PASWORD'=>'g3ae8wu0rz',
    
    //短信模板
    'DUANXIN_MOBAN' => array(
        'ZIXUN' => '%s您好，您咨询的%s——%s的托运费用：%s元(免费上门提车费)，保险费率是您车辆价值的万分之五（10万的车就是50元保险费用）,我司所有承运车辆均由太平洋保险联合妥妥运车全额承保，将以专业得操作及优质的服务为您的爱车保价护航，期待为您服务！可关注微信“妥妥运车”下单,妥妥运车官网:www.tuotuoyunche.com，热线400-877-1107【妥妥运车】', //咨询
        'XIACHENG' => '您已下单成功！订单号%s，审核人员将在工作时间内与您联系，感谢您的信任：4008771107。', //下单成功
        'SHENHE' => '%s您好，您的订单%s到%s，%s订单号：%s；审核已通过；服务费：%s（含%s万车辆保险费，%s），目的地%s；
特别提示：为了您的财产安全，随车行李需打包封好，请勿留存贵重物品，若有贵重物品及零散小件行李（如挂饰、数据线、太阳镜、加油卡等）丢失概不负责，敬请留意！
感谢您的信任，服务热线400-877-1107（审核员%s）', //审核通过
        'NOSHENHE' => '抱歉！订单%s审核未通过，原因%s，期待下次为您服务；妥妥运车随时在您身边，服务热线400-877-1107（审核员%s）', //审核不通过
        'ANPAI' => '%s您好，您的订单%s到%s，%s（车型）接车顾问：%s—%s证件号：%s
温馨提示：为避免您的损失，交车时务必核对顾问身份信息，并可以要求顾问手持证件与您的爱车合照，如车辆有注意事项请与客服人员沟通400-877-1107。
        ', //安排提车员
        'YOUHUI' => '您好，妥妥运车送您%s张%s元优惠券：%s；支付运费时直接抵扣现金，不提现可转赠（每个订单仅限使用1张），服务热线400-877-1107！',//发放优惠劵
        'POSITION' => '%s您好，您的订单%s，已到达%s，在保证安全的情况下，我们正以最快的速度将爱车送达目的地，感谢您的信任，妥妥真诚为您服务！',//位置短信
        'BXD' => '%s您好，您的订单%s，保险已生效，保单号%s，可拨打“中国太平洋保险公司”电话95500查询有效性。',//上传保险单
        '' => '您本次修改密码验证码为@15分钟内有效【妥妥运车】',//修改密码
        '' => '您的验证码是@15分钟内有效【妥妥运车】',//注册验证码
        
    ),
	//支付宝
	'ZFB_ZH'=>'zfb@tuotuoyunche.com',//账号
	'ZFB_PWD'=>'3tuotuo',//密码
	//微信
	'SH_HAO'=>'1335996401',//微信商户号  1335996401@1335996401   002274
    'DOMAINNAME' => 'http://www.tuotuoyunche.com', //域名
    'appid' => 'wxf320aba12db4a196',
    'SOGO' => '1335996401',
    'SECRETS'=>'XcjxDRxTVwx1Ulmdu5NHqZS6YjEmq18T',
    /* *
     * 配置文件
     * 版本：3.3
     * 日期：2012-07-19
     * 说明：
     * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
     * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。
    
     * 提示：如何获取安全校验码和合作身份者id
     * 1.用您的签约支付宝账号登录支付宝网站(www.alipay.com)
     * 2.点击“商家服务”(https://b.alipay.com/order/myorder.htm)
     * 3.点击“查询合作者身份(pid)”、“查询安全校验码(key)”
    
     * 安全校验码查看时，输入支付密码后，页面呈灰色的现象，怎么办？
     * 解决方法：
     * 1、检查浏览器配置，不让浏览器做弹框屏蔽设置
     * 2、更换浏览器或电脑，重新登录查询。
     */
    'alipay_config'=>array(
        //↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
        //合作身份者id，以2088开头的16位纯数字//
        'partner'		=> '2088221720792422',
    
        //安全检验码，以数字和字母组成的32位字符//
        'key'			=> 'ie3c2a97mw6lu8e9sbfqhvq0ngwouyne',
    
        //↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
    
        //签名方式 不需修改
        'sign_type'    => strtoupper('MD5'),
    
        //字符编码格式 目前支持 gbk 或 utf-8
        'input_charset'=> strtolower('utf-8'),
    
        //ca证书路径地址，用于curl中ssl校验
        //请保证cacert.pem文件在当前文件夹目录中
        'cacert'    => getcwd().'\\cacert.pem',
    
        //访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
        'transport'    => 'http'
    ),
    /**************************请求参数配置**************************/
    'alipay'=>array(
        //支付类型
        'payment_type' => 1,
        //必填，不能修改
        //服务器异步通知页面路径
        'notify_url' => C("DOMAINNAME").'/Front/Payment/notifyurl',
        //需http://格式的完整路径，不能加?id=123这类自定义参数
    
        //页面跳转同步通知页面路径
        //'return_url' => 'http://www.XXX.net/Model/Pay/returnurl',
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
    
        //卖家支付宝帐户
        'seller_email' => 'zfb@tuotuoyunche.com'
        //必填
        /************************************************************/
    )
    
    
);
