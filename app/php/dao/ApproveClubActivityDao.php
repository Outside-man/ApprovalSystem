<?php
/**
 * Created by PhpStorm.
 * User: tuanzi
 * Date: 2017/5/5
 * Time: 下午10:37
 */

namespace app\php\dao;

class ApproveClubActivityDao extends \core\lib\BaseDao {
    public function insert($user, $isApprove, $formId, $comment){
        $sql = \DataBase::getConn()->prepare('insert into b_approve_club_activity (approve_user_id, is_approve, form_id, comment, lv)
                values (:approve_user_id, :is_approve, :form_id, :comment, :lv)');
        return $sql->execute(array(
            ':approve_user_id' => $user['id'],
            ':is_approve' => $isApprove,
            ':form_id' => $formId,
            ':comment' => $comment,
            ':lv' => $user['lv']
        ));
    }
    public function selectByLv($lv){
        return $this->select_all_by_one_condition('b_approve_club_activity', 'lv', $lv);
    }
    //TODO 似乎没用
    public function selectByLvByFormId($lv, $formId){
        try {
            $sql = \DataBase::getConn()->prepare('select * from b_approve_club_activity where lv = :lv and form_id = :form_id');
            $sql->execute(array(
                ':lv' => $lv,
                ':form_id' => $formId
            ));
            $result = $sql->fetch();
        }catch (\Exception $e){
            out($e->getMessage());
            return null;
        }
        return $result;
    }
    public function selectByFormId($formId){
        return $this->select_all_by_one_condition('b_approve_club_activity', 'form_id', $formId);
    }
    public function deleteByFormId($formId){
        return $this->delete_one_by_one_condition('b_approve_club_activity', 'form_id', $formId);
    }
}