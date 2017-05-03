<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/2 0002
 * Time: 上午 10:07
 */

namespace Home\Model;


use Think\Model;

class ApproveModel extends Model
{
    protected $_validate = [
        ['name','require','姓名不能为空'],
        ['sn','require','房号不能为空'],
        ['tel','require','电话不能为空'],
        ['tel','/^((13[0-9])|(14[5|7])|(15([0-3]|[5-9]))|(18[0,5-9]))\\d{8}$/','电话格式不正确','','regex'],
        ['num','/^[1-9]{1}[0-9]{14}$|^[1-9]{1}[0-9]{16}([0-9]|[xX])$/','身份证号格式不正确','','regex'],
    ];

}