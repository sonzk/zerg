$(function(){
    var nameFlag = false;

    function getErrorTip(name){
        var value = $(name).val();
        if (!value){
            $(name).parent().parent().attr('class','form-group has-error');
            return false;
        }else {
            $(name).parent().parent().attr('class','form-group');
            return true;
        }
    }

    $(document).on('blur','#name',function () {
        var res = getErrorTip('#name');
        if (res){
            nameFlag = true;
        }
    });


    $(document).on('click','#category-add',function (event) {
        event.preventDefault();
        if (!nameFlag){
            $('#name').parent().parent().attr('class','form-group has-error');
            $('#name').focus();
            return;
        }

        var postData = $('#form-product').serializeArray();
        var params = {
            url: 'category/add',
            type: 'post',
            data: postData,
            sCallback: function (res) {
                if (res.code == 201){
                    layer.msg('添加成功',{time:500},function () {
                        window.location.href = 'product.html';
                    })
                }else {
                    layer.msg(res.msg);
                }
            }
        };
        window.base.getData(params);
    })




});