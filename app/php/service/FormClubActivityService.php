<?php
/**
 * Created by PhpStorm.
 * User: Yxm
 * Date: 2017/4/27
 * Time: 10:10
 */

namespace app\php\service;


class FormClubActivityService{
    static $formClubActivityDao = null;
    function __construct(){
        self::$formClubActivityDao = new \app\php\dao\FormClubActivityDao();
    }
    public function commitForm($club, $user, $activityName,$activityPlace, $activityTime,
                               $activityPeople, $isApplyFine, $activityInfo, $applySelfMoney, $applyCommonMoney){
        return self::$formClubActivityDao->insert($club, $user, $activityName, $activityPlace, $activityTime,
            $activityPeople, $isApplyFine, $activityInfo, $applySelfMoney, $applyCommonMoney);
    }
    public function getById($id){
        return self::$formClubActivityDao->selectById($id);
    }
    public function getLastId(){
        return self::$formClubActivityDao->getLastId();
    }
    public function deleteById($id){
        return self::$formClubActivityDao->deleteById($id);
    }

}