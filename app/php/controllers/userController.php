<?php

/**
 * Created by PhpStorm.
 * User: TuanZ
 * Date: 2017/4/25
 * Time: 13:26
 */
class userController extends \core\lib\BaseController {
    public function index(){
        if(isset($_SESSION['is_login'])&&$_SESSION['is_login']==0){
            Header("Location: /user/login");
            return ;
        }
        $this->display('user/index.html');
    }
    public function register(){
        $userService = new \app\php\service\UserService();
        $userInfoServer = new \app\php\service\UserInfoService();
        $userbase = $userService->register($_POST['username'], $_POST['password']);
        $user = $userService->getUserByUsername($_POST['username']);
        if ($userbase) {
            if($user != null) {
                $usermore = $userInfoServer->addUserDetail($user['id'], $_POST['realName'], $_POST['schoolId'], $_POST['E_mail'], $_POST['Tel']);
                $this->ajaxReturn($usermore, '注册成功', 0);
                return;
            }
        } else {
            $userService->deleteById($user['id']);
            $this->ajaxReturn('Fail', '已存在用户名', 1);
            return;
        }
    }
    public function login(){
        if(!isset($_SESSION['is_login'])||$_SESSION['is_login']!=0) {
            $userService = new \app\php\service\UserService();
            $userInfoService = new \app\php\service\UserInfoService();
            $u = $userService->loginCheck($_POST['username'], $_POST['password']);
            if ($u != null) {
                $_SESSION['is_login'] = 0;
                $user = $userInfoService->getUserInfoById($u['id']);
                $_SESSION['SESSION_CURRENT_USER'] = $user;
                $this->ajaxReturn($user, '登陆成功', 0);
                return;
            } else {
                Header("Location: /index/index");
                return;
            }
        }
        $clubService = new \app\php\service\ClubService();
        $user = $this->getCurrentUser();
        $clubInfo = $clubService->getClubByUserId($this->getCurrentUser()['id']);
        $this->assign('user', $this->getCurrentUser());
        $this->assign('clubInfo', $clubInfo);
        if($user['lv']>1){
            $this->display('user/index.html');
            return ;
        }
        $this->display('user/index.html');
        return ;
    }
    public function logout(){
        $this->clearCurrentUser();
        Header("Location: /index/index");
    }
    public function getLv(){
        $user = $this->getCurrentUser();
        $this->ajaxReturn($user['lv'], '用户等级', 0);
    }
}