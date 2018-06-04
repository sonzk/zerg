$(function(){

    var id = window.base.getParam('id'), before_order , productData;
    getDetail(id);


    //获取商品详情
    function getDetail(id) {
        var params={
            url:'product/' + id,
            tokenFlag:true,
            sCallback:function(res) {
                if (res.detail.length > 0){
                    var str = getDetailHtmlStr(res.detail);
                    $('.property').append(str);
                }
                if (res.imgs.length > 0){
                    var imgStr = getImgHtmlStr(res.imgs);
                    $('#product-img').append(imgStr);
                }
                $('#product-name').append(res.name);
                $('.main_img').attr('src' ,res.main_img_url);
                productData = res;
                console.log(productData);
            }
        };
        window.base.getData(params);
    }

    //商品详情HTML拼接
    function getDetailHtmlStr(detail) {

        var len = detail.length,
            str = '';
        for (var i = 0; i<len; i++){
            str +='<tr>'+
                '<td>'+ detail[i].name + '</td>' +
                '<td>' + detail[i].detail + '</td>'+
                '<td><a class="delete-detail" data-id="' + detail[i].id + '"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>'+
                '</tr>'
        }
        return str;
    }

    //商品详情图HTML拼接
    function getImgHtmlStr(imgs) {
        var len = imgs.length,
            str = '';
        for (var i = 0; i<len; i++){
            str += '<tr>'+
                '<td>'+
                '<div class="photos">'+
                '<img alt="image" class="feed-photo" src="' + imgs[i].image_url.url + '">'+
                '</div>'+
                '</td>'+
                '<td>'+
                '<input type="text" data-id="'+ imgs[i].id +'" class="col-sm-4 list_order" value="'+ imgs[i].order +'" />'+
                '</td>'+
                '<td>'+
                '<button type="button" data-id="' + imgs[i].id + '" class="btn btn-danger delete-product">删除</button>'+
                '</td>'+
                '</tr>';
        }
        return str;
    }

    function getModalData(){
        $('#name').val(productData.name);
        $('#price').val(productData.price);
        $('#stock').val(productData.stock);
    }


    //删除图片事件
    $(document).on('click','.delete-product',function () {
        var productImageId = $(this).data('id');
        layer.confirm('确定要删除吗',function () {
            var params = {
                url: 'image/product_images_del/' + productImageId,
                type:'delete',
                tokenFlag:true,
                sCallback:function (res) {
                    if (res.code == 201){
                        layer.msg('删除成功',{time:500},function () {
                            window.location.reload();
                        })
                    }
                }
            };
            window.base.getData(params);
        });
    });

    //修改排序事件
    $(document).on('click','.list_order',function () {
        before_order = $(this).val();
    });

    $(document).on('blur','.list_order',function () {
        var productImageId = $(this).data('id'),
        listOrder = $(this).val();
        if (listOrder == before_order){
            return;
        }
        var params = {
            url:'image/product_images_order?id=' + productImageId + '&order=' + listOrder,
            tokenFlag:true,
            sCallback:function (res) {
                if (res.code == 201){
                    window.location.reload();
                }else {
                    layer.msg('修改失败');
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
            url: url + "image/product_main_img",
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
                   layer.msg('修改失败');
               }
            },
        })
    });

    $(document).on('click','.delete-detail',function () {
        var id = $(this).data('id');
        layer.confirm('确定要删除吗',function () {
            var params = {
                url: 'product_property/property_del/' + id,
                type: 'delete',
                tokenFlag:true,
                sCallback: function (res) {
                    if (res.code == 201){
                        window.location.reload();
                    }else {
                        layer.msg('删除失败');
                    }
                }
            };
            window.base.getData(params);
        })
    });

    $(document).on('click','#property-add',function () {
            var name = $('#name').val(),
                pId = id,
                detail = $('#detail').val();
            if (!name){
                layer.msg('属性名未输入');
                return;
            }
            if (!detail){
                layer.msg('属性值未输入');
                return;
            }

            var params = {
                url: 'product_property/add',
                type: 'post',
                tokenFlag:true,
                data: {
                    product_id:pId,
                    name:name,
                    detail:detail
                },
                sCallback:function (res) {
                    if (res.code == 201){
                        window.location.reload();
                    } else {
                        layer.msg('添加失败');
                    }
                },
                eCallback:function (res) {
                    layer.msg('添加失败');
                }
            };
            window.base.getData(params);
    })





});










