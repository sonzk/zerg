$(function(){
    getCategoryAll();
    getTheme();
    var nameFlag = false, priceFlag = false, stockFlag = false, categoryFlag = false;

    function getCategoryAll() {
        var params = {
            url: 'category/all',
            tokenFlag:true,
            sCallback:function(res) {
                var srt = getCategoryHtmlStr(res);
                $('#category').append(srt);
            }
        };
        window.base.getData(params);
    }


    function getCategoryHtmlStr(res){
        var len = res.length,
            str = '';
        for (var i=0;i<len;i++) {
            str += '<option value="'+res[i].id+'">'+res[i].name+'</option>';
        }
        return str;
    }

    function getTheme() {
        var params = {
            url: 'theme?ids=1,2,3',
            tokenFlag:true,
            sCallback:function(res) {
                var str = getThemeHtmlStr(res);
                $('#theme-box').append(str);
            }
        };
        window.base.getData(params);
    }

    function getThemeHtmlStr(res){
        var len = res.length,
            str = '';
        for (var i=0;i<len;i++) {
            str += '<label class="checkbox-inline">'+
             '<input type="checkbox" name="theme[]" value="'+res[i].id+'">'+res[i].name+'</label>';
        }

        return str;
    }

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

    $(document).on('blur','#price',function () {
        var res = getErrorTip('#price');
        if (res){
            priceFlag = true;
        }
    });

    $(document).on('blur','#stock',function () {
        var res = getErrorTip('#stock');
        if (res){
            stockFlag = true;
        }
    });

    $(document).on('blur','#category',function () {
        var value = $(this).val();
        if (value == 0 ){
            $(this).parent().parent().attr('class','form-group has-error');
        } else {
            $(this).parent().parent().attr('class','form-group');
            categoryFlag = true;
        }
    });

    $(document).on('click','#product-add',function (event) {
        event.preventDefault();
        if (!nameFlag){
            $('#name').parent().parent().attr('class','form-group has-error');
            $('#name').focus();
            return;
        }else if (!priceFlag){
            $('#price').parent().parent().attr('class','form-group has-error');
            $('#price').focus();
            return;
        }else if (!stockFlag){
            $('#stock').parent().parent().attr('class','form-group has-error');
            $('#stock').focus();
            return;
        }else if (!categoryFlag) {
            $('#category').parent().parent().attr('class','form-group has-error');
            $('#category').focus();
        }else if (!$('#main_img_url').val()){
            layer.msg('请上传主图');
            return;
        }

        var postData = $('#form-product').serializeArray();
        console.log(postData);
        var params = {
            url: 'product/add',
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