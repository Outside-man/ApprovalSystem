<?php
/**
 * Created by PhpStorm.
 * User: Yxm
 * Date: 2017/4/27
 * Time: 11:12
 */

namespace app\php\dao;


class StatusClubActivityDao extends \core\lib\BaseDao {
    public function selectAll(){
        return $this->select_all('b_status_club_activity');
    }
    public function selectById($id){
        return $this->select_one_by_one_condition('b_status_club_activity', 'id', $id);
    }
    public function selectByFormId($formId){
        return $this->select_one_by_one_condition('b_status_club_activity', 'b_form_id', $formId);
    }
    public function insert($form, $user){
        try {
            if(is_array($user)&&is_array($form)) {
                $sql = \DataBase::getConn()->prepare('insert into b_status_club_activity (form_id, form_user_id, status, approve_lv)
                values (:form_id, :form_user_id, :status, :approve_lv)');
                return $sql->execute(array(
                    ':form_id' => $form['id'],
                    ':form_user_id' => $user['id'],
                    ':status' => 0,
                    ':approve_lv' => $user['lv']+1
                ));
            }else{
                throw  new \Exception('用户未登录');
            }
        }catch (\Exception $e){
            out($e->getMessage());
            return false;
        }
    }
    public function selectByFormUserId($formUserId){
        return $this->select_all_by_one_condition('b_status_club_activity', 'form_user_id', $formUserId);
    }
    public function  selectByNowLv($approveLv){
        return $this->select_all_by_one_condition('b_status_club_activity', 'approve_lv', $approveLv);
    }
    public function updateLvByFormId($lv, $formId){
        return $this->update_one_column_by_one_condition('b_status_club_activity', 'approve_lv', $lv, 'form_id', $formId);
    }
    public function updateStatusByFormId($status, $formId){
        return $this->update_one_column_by_one_condition('b_status_club_activity', 'status', $status, 'form_id', $formId);

    }
}