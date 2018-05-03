<?php
namespace Back\Model;
class LineModel extends BaseModel{
	/*
	 * 获取所有路线产品
	 */
	public function getPage($wherea){
		$num = $this->where($wherea)->count();
		$page = set_page($num,10);
		$info['page'] = $page -> Backpage();
		$info['list'] = $this->where($wherea)->order('line_id desc')->limit($page->limit)->select();
		return $info;
	}
	
	public function getPages($wherea){
	    $num = $this->where($wherea)->count();
	    $page = set_page($num,10);
	    $info['page'] = $page -> Backpage();
	    $info['list'] = $this->where($wherea)->order('line_star asc,line_end asc')->limit($page->limit)->select();
	    return $info;
	}
	/*
	 * 根据起始数据和结束数据查询路线数据
	 * @date 2016-8-9
	 * @author yao
	 * @param
	 * return array
	 */
	public function verify($star,$end){
		if (empty($star) or empty($end)) return "参数错误！";
		$where['line_star'] = $star;
		$where['line_end'] = $end;
		//$where['line_status'] = $status;
		$data = $this->where($where)->find();
// 		echo $this->getLastSql();die;
		return $data;
	}
}