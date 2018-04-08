<?php
/**
 * 静态属性文件配置
 */
return array(
   //设置后台登陆时间
   'BACK_LOGIN_TIME' =>7200,
   'ADV_CONFIG' => array(
           'A' =>'首页(1000*1000)',
           //'C' =>'优惠列表(1200*450)',//优惠路线banner
   ),
    'OTHER_INFO' => array(
        'GY' =>'妥妥运车',
        'XW' =>'新闻中心',
        'LX' =>'服务产品',
        'JR' =>'帮助中心',
        'QQ' =>'配送中心',
        'FK' =>'支付方式',
        'BZ' =>'底部关于妥妥',
        'FW' =>'妥妥服务',
        'AQ' =>'安全保障',
        'DH' =>'导航关于妥妥',
        'CJ' =>'常见问题',
        'TTFW'=>'首页妥妥服务',
    ),
    'INFO_TITLE' =>array(
        'MEMBERTITLE' => '您已通过实名认证',
        'UNMEMBERTITLE' => '您未通过实名认证'
    ),
    //(图片)
    'POSITION_CONFIG' => array( 
        'OPINION' => array('W'=>100000,'H'=>100000),//观点、课堂、专栏缩略图
        'A' => array('W'=>1000,'H'=>1000),//测试
        'NUMIMG' => array('W'=>1200,'H'=>1200),//系统管理数量输入
        'XWZX' => array('W'=>3000,'H'=>3000),//新闻中心
        'LINKIMG' => array('W'=>1000,'H'=>1000),//友情链接
        'C' => array('W'=>1200,'H'=>451),//优惠路路线banner
        'SLT' => array('W'=>386,'H'=>234),//优惠路线图片
    	'TCYWX' => array('W'=>340,'H'=>190),//微信提车员自动回复
	    'FILE' => 99999999999,//上传保险单大小限制
    ),
    //前台会员登陆时间设定,单位：秒
    'FRONT_LOGIN_TIME'=>3600,
    //默认头像
    'DEFAULT_IMAGE'=>'/Public/Front/images/privates/head99.jpg',
    //短信验证码有效期单位秒
    'NOTE_CODE_TIME' => 1200,
    //检测登陆状态
    'LOGIN_DETECTION_METHOD'=>array(
        'ownTel',
        'ownOwn',
        'ownShimi',
        'ownRzadd',
        'ownEdit',
        'ownzYaoqm',
        'bindingTelPage',
        'bindingTel',
        'bindingMailPage',
        'sendMailVerify',
        'bindingMail',
        'myDynamic',
        'privateMessage',
        'privateMessageInfo',
        'continueToCarry',
        'privateMessageReply',
        'privateMessageReplyFun',
        'sendPrivateMessagePage',
        'sendPrivateMassage',
        'conversionRimFun',
        'userScoreShow',
        'myCollection',
        'userscoreshow',
        'mycollection',
        'masterWorkList',
        'myFans',
        'myFocus',
        'submitMes',
        'setWork',
        'masterWorkList',
        'masterWorkYDetail',
        'masterWorkXDetail',
        'masterWorkHDetail',
        'workHedit',
        'workXedit',
        'workYedit',
        'setWorknext',
        'workInsert',
        'setWorkThree',
        'logout',
        'submitNovelMes',
        'submitMes',
        'submitNovelRe',
        'delNovelMe',
        'delNovelMeRe',
        'submitArticleMes',
        'submitArticleRe',
        'delArticleMe',
        'delArticleMeRe',
        'submitMusicMes',
        'submitMusicRe',
        'delMusicMe',
        'delMusicMeRe',
    ),
    'OPEN_ACC_BANK' =>array(
        'CYF' =>'民生银行',
        'CYG' =>'工商银行',
        'CYJ' =>'交通银行',
        'JSY' =>'建设银行',
        'NYY' =>'农业银行',
        'ZSY' =>'招商银行',
        'YZH' =>'邮政银行',
    ),
    //动态里的链接
    'URL_PATH' => array(
        'Y'=>'Moudelfuns/workYDetail',
        'X'=>'Moudelfuns/workXDetail',
        'H'=>'Moudelfuns/workHDetail'
    ),
    //写入日志内容
    'LOGS'=>array(
        'CAR_XING' => array('订单%s车辆：%s','修改车辆信息'),
        'START'=>array('订单%s发出：%s','修改发出信息'),
        'END' => array('订单%s到达：%s','修改到达信息'),
        'START_MAN' => array('订单%s发出：%s','修改发出信息'),
        'END_MAN' => array('订单%s到达：%s','修改到达信息'),
        'START_ADRES' => array('订单%s发出：%s','修改发出信息'),
        'END_ADRES' => array('订单%s到达：%s','修改到达信息'),
        'UPPRICE' => array("订单%s费用：%s",'修改价格'),
        'DAISHOU' => array("订单%s回单人：%s",'录入回单人'),
        'UPSHOU' => array("订单%s回单人：%s",'修改回单人'),
        'SHTG' => array("订单%s：审核通过，运费-%s，开票类型-%s，业务类型-%s","审核通过"),
        'NSHTG' => array("订单%s：审核不通过，%s","审核不通过"),
        'YUNADD' => array('添加运单%s',"添加发运"),
        'YUNEDIT' => array('运单%s承运人：%s',"修改发运"),
        //'CHENGYUN' => array('修改运单承运方：%s改为%s'),
        'HFANG' => array('订单%s：%s','添加回访'),
        'HUIDAN' => array('订单%s：收到回单','确认回单'),
        'DELORDER' => array('订单%s：作废：%s','作废订单'),
        'JIAOCHE' => array('订单%s：用户收车，%s，%s，%s','确认交车'),
        //'CHENGYIN'=>array('运单打印：运单号%s'),
        //'CHENGDEL'=>array('运单作废：运单号%s'),
        //'DELORDER'=>array('作废订单:订单号%s'),
        
        
    ),
    
)
?>