<?php
namespace Front\Controller;

class CeshiPdfPrintController extends BaseController {
    //打印委托书-车妥妥授权委托书
    public function pdf_sqwts($order_code=""){
	    	//引入类库$mpdf = getMpdfObj();
	    	Vendor('mpdf.mpdf');
	    	//设置中文编码
	    	$mpdf=new \mPDF('+aCJK','A4', 0, '宋体', 0, 0);
	    	
    		$order_code = "TO14760025268UA6";//$order_code==""?I('order_code'):$order_code;
    		$status = I('get.status');
            $p_Obj = D('PdfPrint');
            if($status==''){
                $result = $p_Obj -> selOrder($order_code);
            }else{
                $result['time'][0] = 'X';
                $result['time'][1] = 'X';
                $result['time'][2] = 'X';
            }
            
            
            $html=<<<xml
            <!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>
<table width="605" cellpadding="0" cellspacing="0" style="line-height:36px;font-size:16px;"   class="sdsd" align="center">
    <tbody>
        <tr>
            <th><img src="Public/Front/images/dd.jpg"></th>
        </tr>
        <tr>
            <td align="center"><h2 style="">“妥妥运车”授权委托书</h2></td>
        </tr>
        <tr>
            <td align="left">致：{$result['sclxr']}</td>
        </tr>
        <tr>
            <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                         我司委托：赵明 电话：18500061806，身份证号：123123123123123。
                <br>到双方约定地点办理<b>验车、提车</b>事宜，对受托人在办理上述事项过程中所签署的有关文件,我司均予以认可,并承担相应的法律责任。请予以配合，谢谢！
            </td>
        </tr>
        <tr>
            <td align="left">
                <br><br><br>
                <div style="position:relative;"><img style="position: absolute;left:39px;top:-28px;width:150px;height:150px;" src="Public/Front/images/gzss.png">
                                        委托时间：2016年
                06月
                07日
                <br>委托人：北京信义安达物流有限公司</div>
            </td>
        </tr>
    </tbody>
</table>
</body>
</html>
xml;
            
            
            
            $mpdf->WriteHTML($html);
            $mpdf->Output();
            exit;
            
    }
    
    function dayin(){
    	
    	
    }
    
    
    //pdf方法
    public function export_pdf($data=array(),$fileName='Newfile'){
        set_time_limit(120);
        if(empty($data)) $this->error("导出的数据为空！");
        vendor("tcpdf6.tcpdf");
        require_cache(VENDOR_PATH . 'tcpdf/examples/lang/eng.php');
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);//新建pdf文件
        //设置文件信息
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor("Author");
        $pdf->SetTitle("pdf test");
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        //设置页眉页脚
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetHeaderData("", "", 'www.lfmnet.com','',array(66,66,66), array(0,0,0));
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);//设置默认等宽字体
        $pdf->SetMargins(15, 14, PDF_MARGIN_RIGHT);//设置页面边幅
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);//设置自动分页符
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setLanguageArray($l);
        $pdf->SetFont('droidsansfallback', '');
        $pdf->AddPage();
        $pdf->SetFillColor(245, 245, 245);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(66, 66, 66);
        $pdf->SetLineWidth(0.3);
        $pdf->SetFont('droidsansfallback', '',9);
        $pdf->writeHTML($data,true, false, true, false, '');
        $showType= "D";//PDF输出的方式。I，在浏览器中打开；D，以文件形式下载；F，保存到服务器中；S，以字符串形式输出；E：以邮件的附件输出。
        $pdf->Output("{$fileName}.pdf", $showType);
        exit;
    }
}