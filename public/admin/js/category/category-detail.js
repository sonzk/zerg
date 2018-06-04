$(function(){

    var id = window.base.getParam('id'), before_order , productId;
    getDetail(id);
    getProductByCategory(id);

    //获取分类详情
    function getDetail(id) {
        var params={
            url:'category/' + id,
            tokenFlag:true,
            sCallback:function(res) {
                $('.main_img').attr('src',res.img.url);
                console.log(res);
            }
        };
        window.base.getData(params);
    }

    function getProductByCategory(id) {
        var params={
            url:'product/by_category?id=' + id,
            tokenFlag:true,
            sCallback:function(res) {
                var str = getProductHtmlStr(res);
                $('#category-product').append(str);
                console.log(res);
            }
        };
        window.base.getData(params);
    }


    //商品详情图HTML拼接
    function getProductHtmlStr(product) {
        var len = product.length,
            str = '';
        for (var i = 0; i<len; i++){
            var item = product[i];
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

    function getCatHtmlStr(res) {
        var len = res.length,
            str = '';
        for (var i = 0; i<len; i++){
            var item = res[i];
            str += '<option value="'+ item.id +'" >'+ item.name+'</option>'
        }
        return str;
    }


    $(document).on('click','.move-product',function () {
        productId = $(this).data('id');
        var params = {
            url: 'category/all',
            tokenFlag:true,
            sCallback:function (res) {
                var str = getCatHtmlStr(res);
                $('#category-all').html('<option value="0" >请选择</option>');
                $('#category-all').append(str);
            }
        };
        window.base.getData(params);

    });




    $(document).on('click','#category-change',function () {
        var categoryId = $('#category-all').val(),
            pId = productId;
        if (categoryId == 0){
            layer.msg('请选择分类');
            return;
        }

        var params = {
            url: 'product/update',
            type: 'post',
            tokenFlag:true,
            data : {
                id:pId,
                category_id: categoryId,
            },
            sCallback:function (res) {
               if (res.code == 201){
                   layer.msg('修改成功',{time:500},function () {
                       window.location.reload()
                   })
               } else {
                   layer.msg('修改失败',{time:1000},function () {
                       window.location.reload()
                   })
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
        formFile.append("id", id);
        formFile.append("file", file_obj);

        $.ajax({
            url: url + "category/img_update",
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