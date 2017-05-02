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
    public function selectByNowUserId($NowUserId){
        return $this->select_all_by_one_condition('b_status_club_activity', 'now_user_id', $NowUserId);
    }
    public function insert($form, $nowUserId, $user){
        try {
            if(is_array($user)&&is_array($form)) {
                $sql = \DataBase::getConn()->prepare('insert into b_status_club_activity (form_id, form_user_id, status, now_user_id)
                values (:form_id, :form_user_id, :status, :now_user_id)');
                return $sql->execute(array(
                    ':form_id' => $form['id'],
                    ':form_user_id' => $user['id'],
                    ':status' => 0,
                    ':now_user_id' => $nowUserId
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
}