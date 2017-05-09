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
    $.ajax({
        type: "POST",
        url: "/user/getLv",
        dataType:"json",
        success: function(r){
            if(r.data>2){
                $("#form-view").after("<li class='sub-item' id='form-manage'>管理</li>");
                $("#form-view").hide();
                $("#form-appli").hide();
                $("#form-manage").click(function () {
                   $(".content-body").html("");
                    $.get("/approveForm/listClubActivity",function () {
                        $(".content-body").load("/approveForm/listClubActivity");
                   });
                });
                //re creat js(because new html code has not events)
                $(".sub-nav").find("li").click(function () {
                    $(".sub-nav").find("li").removeClass("on");
                    $(this).addClass("on");
                    $(".content-nav").html($(this).parent().parent().prev().html()+"/ "+$(this).html());
                }) ;
            }
        },
        error: function(data){
            alert('Error');
        }
    });
}) ;



/* club */
/********************************/

/* application */
$(function () {
    $("#form-appli").click(function () {
       $(".content-body").html("").load("/applyClubForm/applyFormClubActivity");
    });
});

/* approval */
$(function () {
    $(".approval-entry").click(function () {
       $(".approval-form").toggle(300);
    });
});
