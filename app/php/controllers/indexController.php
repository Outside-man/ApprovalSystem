<?php
/**
 * Created by PhpStorm.
 * User: TuanZ
 * Date: 2017/4/19
 * Time: 12:12
 */

class indexController extends \core\lib\BaseController {
    public function index(){
        if(isset($_SESSION['is_login'])&&$_SESSION['is_login']==0){
            Header("Location: /user/login");
            return ;
        }
        $this->display('index/login.html');
    }
    public function mail(){
        $mail = new \core\lib\mail();
        $mail = $mail->setMail($_POST['tomail'], $_POST['title'],$_POST['content'],null);
        if($mail->send()){
            $this->ajaxReturn('success', '发送成功', 0);
            return ;
        }
    }
}