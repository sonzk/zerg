$(function(){

    var id = window.base.getParam('id');
    getThemeDetail(id);
    //getProductByCategory(id);

    //获取分类详情
    function getThemeDetail(id) {
        var params={
            url:'theme/' + id,
            tokenFlag:true,
            sCallback:function(res) {
                $('.main_img').attr('src',res.head_img.url);
                var str = getProductHtmlStr(res.products);
                $('#theme-product').append(str);
                console.log(res);
            }
        };
        window.base.getData(params);
    }



    // //商品详情图HTML拼接
    function getProductHtmlStr(products) {
        var len = products.length,
            str = '';
        for (var i = 0; i<len; i++){
            var item = products[i];
            str += '<tr>'+
                '<td>' + item.id + '</td>'+
                '<td>' + item.name + '</td>'+
                '<td>' + item.price + '</td>'+
                '<td>' + item.stock + '</td>'+
                '<td><a href="product-detail.html?id='+ item.id +'">'+
                '<div class="photos">'+
                '<img alt="image" class="feed-photo" src="' + item.main_img_url + '">'+
                '</div>'+
                '</a></td>'+
                '<td>'+
                '<button type="button" data-id="' + item.id + '" data-toggle="modal" data-target="#modal-2" class="btn btn-danger move-product">转移分类</button>'+
                '</td>'+
                '</tr>';
        }
        return str;
    }

    function getTypeHtmlStr(detail) {
        var len = detail.length,
            str = '';
        for (var i = 0; i<len; i++){
            str += '<option value="'+ detail[i].id +'">'+ detail[i].name +'</option>'
        }
        return str;
    }


    function getProductAll(){
        var params={
            url:'product/all_name_id',
            tokenFlag:true,
            sCallback:function(res) {
                console.log(res);
                var str = getTypeHtmlStr(res);
                $('#product-item').append(str);
            }
        };
        window.base.getData(params);
    }

    $(document).on('click','#add-product',function () {
        $('#product-item').html('<option value="0" >请选择</option>');
        getProductAll();
    });


    $(document).on('click','#product-save',function () {
        var pId = $('#product-item').val();
        var params = {
            url: 'theme/add_product',
            type: 'post',
            data: {
                theme_id:id,
                product_id: pId,
            },
            sCallback:function (res) {
                if (res.code == 201){
                    layer.msg('添加成功',{time:500},function () {
                        window.location.reload();
                    })
                }else {
                    layer.msg(res.msg,{time:1000})
                }
            }
        };
        window.base.getData(params);
    });

    $(document).on('click','.move-product',function () {
        var pId = $(this).data('id');
        var params = {
            url: 'theme/move_product',
            type: 'post',
            data: {
              theme_id: id,
              product_id : pId,
            },
            tokenFlag:true,
            sCallback:function (res) {
                if (res.code == 201){
                    layer.msg('移除成功',{time:500},function () {
                        window.location.reload();
                    })
                } else {
                    layer.msg('移除失败');
                }
            }
        };
        window.base.getData(params);

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
        formFile.append('type','head_img');
        formFile.append("id", id);
        formFile.append("file", file_obj);

        $.ajax({
            url: url + "theme/img_update",
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