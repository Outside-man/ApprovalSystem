/**
 * Created by Administrator on 2017/4/27.
 */

/* user */
/****************************************/

/* login */
$(function () {
   $("#login-form").submit(function () {
       var username = $("#username").val();
       var password = $("#password").val();
       if(username!=""&&password!=""){
           var data={
               "username":username,
               "password":password
           };
           $.ajax({
               type: "POST",
               url: "/user/login",
               data: data,
               dataType:"json",
               success: function(data){
                   if(data.status==0){
                       $(location).attr('href',"/user/index");
                       alert(data.info);
                   }
                   else {
                       alert('wrong');
                   }
               },
               error: function(data){
                   alert('Error');
               }
           });
       }
       else{
           alert("用户名密码不能为空");
       }
   }) ;
   $("#login-reset").click(function () {
      $("#login-form")[0].reset();
   });
});


/* tabset  */
/*******************************************/
$(function () {
    
});