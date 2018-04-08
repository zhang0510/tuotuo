<?php 
namespace Front\Model;
class RegisterModel extends BaseModel{
    //添加用户
	function register($data){
        $Add = M("user");
		$RegisterAdd = $Add->add($data);
		return $RegisterAdd;
    }
    
    function selectTel($tel=""){
        $Sel = M("user");
		$RegisterSel=0;
        if($tel !=''){
            $map['tel'] = array('eq',$tel);
			$RegisterSel = $Sel->where($map)->count();
        }
        return $RegisterSel;
    }
}