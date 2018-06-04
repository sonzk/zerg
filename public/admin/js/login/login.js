$(function(){

    if(window.base.getLocalStorage('token')){
        window.location.href = 'index.html';
    }

    $(document).on('click','#login',function(){
        var $userName=$('#user-name'),
            $pwd=$('#user-pwd');
        if(!$userName.val()) {
            layer.msg('请输入用户名');
            return;
        }
        if(!$pwd.val()) {
            layer.msg('请输入密码');
            return;
        }
        var params={
            url:'token/app',
            type:'post',
            data:{ac:$userName.val(),se:$pwd.val()},
            sCallback:function(res){
                if(res){
                    window.base.setLocalStorage('token',res.token);
                    window.location.href = 'index.html';
                }
            },
            eCallback:function(e){
                if(e.status==401){
                    layer.msg('帐号或密码错误');
                }
            }
        };
        window.base.getData(params);
    });



});