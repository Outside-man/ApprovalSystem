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
        return $this->select_all('b_user_info');
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
}