<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/26 0026
 * Time: 下午 3:07
 */

namespace Admin\Model;



use Think\Model;

class RepairModel extends Model
{
    private $sn;
    protected $_validate = [
      ['name','require','用户名不能为空'],
      ['address','require','地址不能为空'],
      ['tel','require','电话不能为空'],
      ['problem','require','问题描述不能为空'],
      ['title','require','问题描述不能为空'],
    ];

    /* 自动完成规则 */
    protected $_auto = array(
        array('add_time', NOW_TIME, self::MODEL_INSERT),
        array('sn', 'set_sn', self::MODEL_INSERT,'callback'),
        array('status', 1, self::MODEL_INSERT),
    );
    public function set_sn(){
        $char = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        //打断随机字符串
        $char = str_shuffle($char);
        $sn='IT'.rand(1000,9999).substr($char,0,3).date('Ym').substr($char,0,5);
        return $sn;
    }
}