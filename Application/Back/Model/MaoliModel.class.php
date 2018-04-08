<?php
namespace Back\Model;
use Back\Model\BaseModel;
class MaoliModel extends BaseModel{
	/*
	 * 获取所有毛利数据
	 * @date 2016-8-6
	 * @author yao
	 * @param
	 * return array
	 */
	public function getInfo(){
	
	}
	
	/*
	 * 毛利分页以及搜索
	 * @date 2016-8-6
	 * @author yao
	 * @param $provincea 起始省
	 * @param $provinceb 目的省
	 * return array
	 */
	Public function getPage($provincea,$provinceb){
		/* if (!empty($provincea))
		$where['ml_star'] = $provincea;
		if (!empty($provinceb))
		$where['ml_end'] = $provinceb; */
		if($provincea!='f'&&$provinceb!='f'){
		    $where['ml_star'] = $provincea;
		    $where['ml_end'] = $provinceb;
		}else if($provincea=='f'&&$provinceb!='f'){
		    $where['ml_end'] = $provinceb;
		}else if($provincea!='f'&&$provinceb=='f'){
		    $where['ml_star'] = $provincea;
		}else{
		    $where[] = '1=1';
		}
		$num = $this->where($where)->count();
		$page = set_page($num,10);
		$info['page'] = $page -> Backpage();
		$info['list'] = $this->where($where)->limit($page->limit)->select();
		return $info;
	}
	
	/*
	 * 毛利匹配是否存在
	 * @date 2016-8-6
	 * @author yao
	 * @param
	 * return array
	 */
	public function piPei($star,$end){
		if (empty($star) or empty($end)) return '参数不对！';
		$where['ml_star'] = $star;
		$where['ml_end'] = $end;
		$data = $this->where($where)->find();
		return $data;
	}
	
	
	
}