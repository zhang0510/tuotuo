<?php
namespace Back\Model;
use Think\Model\RelationModel;
class CompanyModel extends RelationModel{
    protected $_link = array(
        'User'=>array(
            'mapping_type' => self::BELONGS_TO,
            'class_name'   => 'User',
            'foreign_key ' => 'user_id',
        ),
    );
    public function ceshi(){
        $map['role'] = array('eq','Q');
        $info = $this ->where($map) -> relation('User') ->select();
        dump($info);
        //return $info;
    }
}