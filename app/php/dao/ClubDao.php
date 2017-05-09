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
    public function updateMoneyById($self_money, $reserve_money, $id){
        $sql = \DataBase::getConn()->prepare('update b_club set self_money = :self_money, reserve_money = :reserve_money where id =:id ');
        return $sql->execute(array(
            ':self_money' => $self_money,
            ':reserve_money' => $reserve_money,
            ':id' => $id
        ));
    }
    public function selectById($id){
        return $this->select_one_by_one_condition('b_club', 'id', $id);
    }
}