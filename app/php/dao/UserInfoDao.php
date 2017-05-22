<?php
/**
 * Created by PhpStorm.
 * User: Yxm
 * Date: 2017/4/26
 * Time: 21:32
 */

namespace app\php\dao;


class UserInfoDao extends \core\lib\BaseDao{
    public function selectAll(){
        $sql = \DataBase::getConn()->prepare('select * from b_user_info order by lv');
        $sql->execute();
        $result = $sql->fetchAll();
        return $result;
    }
    public function selectById($id){
        return $this->select_one_by_one_condition('b_user_info', 'id', $id);
    }
    public function insert($id, $realName, $schoolId, $mail, $tel){
        try {
            $userDao = new UserDao();
            if($userDao->selectById($id)!=null) {
                $sql = \DataBase::getConn()->prepare('insert into b_user_info (id, real_name, school_id, e_mail, tel) 
                    values (:id,:realName, :schoolId, :mail, :tel)');
                return $sql->execute(array(':id' => $id, ':realName' => $realName, ':schoolId' => $schoolId, ':mail'=>$mail, ':tel'=>$tel));
            }else{
                throw new \Exception('用户不存在');
            }
        }catch (\Exception $e){
            return false;
        }
    }
    public function updateUserInfo($userInfo, $id){
        try {
            $sql = \DataBase::getConn()->prepare('update b_user_info set real_name =:real_name, school_id =:school_id, lv =:lv, e_mail =:e_mail, tel =:tel  where id =:id');
            return $sql->execute(array(
                ':real_name' => $userInfo['real_name'],
                ':school_id' => $userInfo['school_id'],
                ':lv' => $userInfo['lv'],
                ':e_mail' => $userInfo['e_mail'],
                ':tel' => $userInfo['tel'],
                ':id' => $id
            ));
        }catch(\Exception $e){
            die($e->getMessage());
        }
    }
}