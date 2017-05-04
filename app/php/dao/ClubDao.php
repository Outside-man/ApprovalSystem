<?php
/**
 * Created by PhpStorm.
 * User: tuanzi
 * Date: 2017/5/3
 * Time: 上午10:56
 */

namespace app\php\dao;



class ClubDao extends \core\lib\BaseDao {
    public function selectClubByUserId($userId){
        return $this->select_one_by_one_condition('b_club', 'user_id', $userId);
    }
    public function updateMoneyById($money, $id){
        return $this->update_one_column_by_one_condition('b_club', 'money', $money, 'id', $id);
    }
}