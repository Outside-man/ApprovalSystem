<?php
/**
 * Created by PhpStorm.
 * User: Yxm
 * Date: 2017/4/27
 * Time: 0:27
 */

namespace app\php\dao;
class FormClubActivityDao extends \core\lib\BaseDao {
    public function selectAll(){
        return $this->select_all('b_form_club_activity');
    }
    public function selectById($id){
        return $this->select_one_by_one_condition('b_form_club_activity', 'id', $id);
    }
    public function insert($club, $user, $activityName,
                           $activityPlace, $activityTime, $activityPeople, $isApplyFine, $activityInfo, $applySelfMoney, $applyReserveMoney, $clubId){
        try {
            if(is_array($user)) {
                $sql = \DataBase::getConn()->prepare('insert into b_form_club_activity 
            (apply_date, club, chief_name, chief_id, chief_tel, activity_name, activity_place, activity_time, activity_people, is_apply_fine, activity_info, apply_self_money, apply_reserve_money, club_id) 
            values (:apply_date, :club, :chief_name, :chief_id, :chief_tel, :activity_name, :activity_place, :activity_time, :activity_people, :is_apply_fine, :activity_info, :apply_self_money, :apply_reserve_money, :club_id)');
                return $sql->execute(array(
                    ':apply_date' => date("Y年m月d日"),
                    ':club' => $club,
                    ':chief_name' => $user['real_name'],
                    ':chief_id' => $user['school_id'],
                    ':chief_tel' => $user['tel'],
                    ':activity_name' => $activityName,
                    ':activity_place' => $activityPlace,
                    ':activity_time' => $activityTime,
                    ':activity_people' => $activityPeople,
                    ':is_apply_fine' => $isApplyFine,
                    ':activity_info' => $activityInfo,
                    ':apply_self_money' => $applySelfMoney,
                    ':apply_reserve_money' => $applyReserveMoney,
                    ':club_id' => $clubId
                ));
            }else{
                throw  new \Exception('用户未登录');
            }
        }catch (\Exception $e){
            out($e->getMessage());
            return false;
        }
    }
    public function getLastId(){
        $arr = self::get_last_insert_id('b_form_club_activity');
        return $arr[0];
    }
    public function deleteById($id){
        self::delete_one_by_one_condition('b_form_club_activity','id',$id);
    }
    public function updateMoneyFormById($self_money, $reserve_money,$id){
        $sql = \DataBase::getConn()->prepare('update b_form_club_activity set self_money = :self_money, reserve_money = :reserve_money where id =:id ');
        return $sql->execute(array(
            ':self_money' => $self_money,
            ':reserve_money' => $reserve_money,
            ':id' => $id
        ));
    }
}