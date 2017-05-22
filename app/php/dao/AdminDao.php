<?php
/**
 * Created by PhpStorm.
 * User: Yxm
 * Date: 2017/5/16
 * Time: 16:24
 */

namespace app\php\dao;


class AdminDao extends \core\lib\BaseDao{
    public function selectByUsername($username){
        return $this->select_one_by_one_condition('b_admin', 'username', $username);
    }
}