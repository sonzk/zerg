$(function(){

    var id = window.base.getParam('id'), bannerType,keyWord;
    getDetail(id);


    //获取商品详情
    function getDetail(id) {
        var params={
            url:'banner_item/' + id,
            tokenFlag:true,
            sCallback:function(res) {
                $('.main_img').attr('src' ,res.img.url);
                keyWord = res.key_word;
                bannerType = res.type;
            }
        };
        window.base.getData(params);
    }


    function getTypeDetail(type){
        if (type == 1){
            var params={
                url:'product/all_name_id',
                tokenFlag:true,
                sCallback:function(res) {
                    console.log(res);
                    var str = getTypeHtmlStr(res);
                    $('#type-value').append(str);
                }
            };
            window.base.getData(params);
        }else {
            $('#type-value').html('');
        }
    }


    //商品详情HTML拼接
    function getTypeHtmlStr(detail) {

        var len = detail.length,
            str = '';
        for (var i = 0; i<len; i++){
            str += '<option value="'+ detail[i].id +'">'+ detail[i].name +'</option>'
        }
        return str;
    }





    $(document).on('click','#type-update',function () {
        var type = $('#type-change').val(),
            typeValue= $('#type-value').val();
        if (type == 0){
            layer.msg('请选择类型');
            return;
        }else if (typeValue == 0){
            layer.msg('请选择类型');
            return;
        }

        var params = {
            url: 'banner/item_update',
            type: 'post',
            tokenFlag:true,
            data: {
                id:id,
                type: type,
                key_word: typeValue,
            },
            sCallback:function (res) {
                if (res.code == 201){
                    layer.msg('修改成功',{time:500},function () {
                        window.location.reload();
                    })
                } else {
                    layer.msg('修改失败');
                }
            },
            eCallback:function (res) {
                layer.msg('修改失败');
            }
        };
        window.base.getData(params);

    });


    $(document).on('click','#jump-detail',function () {
        if (bannerType ==1){
            window.location.href = 'product-detail.html?id=' + keyWord;
        }
    });


    $(document).on('change','#type-change',function () {
        var value = $(this).val();
        getTypeDetail(value);

    });


    //修改主图
    $(document).on('click','#main_img',function () {
        $('#upload_file').click();
    });

    $(document).on('change','#upload_file',function () {
        var url = window.base.g_restUrl;
        var id = window.base.getParam('id');
        var file_obj = $('#upload_file')[0].files[0];
        var formFile = new FormData();
        formFile.append("id", id);
        formFile.append("file", file_obj);

        $.ajax({
            url: url + "banner/update_img",
            data: formFile,
            type: "post",
            dataType: "json",
            cache: false,//上传文件无需缓存
            processData: false,//用于对data参数进行序列化处理 这里必须false
            contentType: false, //必须
            success: function (res) {

                if (res.code == 201){
                    layer.msg('修改成功',{time:500},function () {
                        window.location.reload();
                    })
                }else {
                    layer.msg('修改失败',{time:1000},function () {
                        window.location.reload();
                    });
                }
            },
        })
    });








});