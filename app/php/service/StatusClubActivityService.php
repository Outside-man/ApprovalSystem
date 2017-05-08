<?php
/**
 * Created by PhpStorm.
 * User: Yxm
 * Date: 2017/4/27
 * Time: 11:18
 */

namespace app\php\service;


class StatusClubActivityService{
    static $statusClubActivityDao = null;
    function __construct(){
        self::$statusClubActivityDao = new \app\php\dao\StatusClubActivityDao();
    }
    public function getAll(){
        return self::$statusClubActivityDao->selectAll();
    }
    public function getById($id){
        return self::$statusClubActivityDao->selectById($id);
    }
    public function savestatus($form, $user){
        return self::$statusClubActivityDao->insert($form, $user);
    }
    public function getListByUserId($formUserId){
        $statusList = self::$statusClubActivityDao->selectByFormUserId($formUserId);
        $formClubActivityDao = new \app\php\dao\FormClubActivityDao();
        if(is_array($statusList)) {
            forEach($statusList as &$key){
                $form = $formClubActivityDao->selectById($key['form_id']);
                $key['activity_name'] = $form['activity_name'];
            }
        }
        return $statusList;
    }
    public function changeApproveLvByFormId($user, $formId){
        if($user['lv']<=4) {
            return self::$statusClubActivityDao->updateLvByFormId($user['lv'] + 1, $formId);
        }else{
            return false;
        }
    }
    public function getListFormByLv($user){
        $statusList = self::$statusClubActivityDao->selectListFormByLv($user['lv']);
        $formClubActivityDao = new \app\php\dao\FormClubActivityDao();
        if(is_array($statusList)) {
            forEach($statusList as &$key){
                $form = $formClubActivityDao->selectById($key['form_id']);
                $key['activity_name'] = $form['activity_name'];
            }
        }
        return $statusList;
    }
}