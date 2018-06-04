$(function(){
    var pageIndex=1,
        moreDataFlag=true;
    getProducts(pageIndex);

    /*
    * 获取数据 分页
    * params:
    * pageIndex - {int} 分页下表  1开始
    */
    function getProducts(pageIndex){
        var params={
            url:'product/paginate',
            data:{page:pageIndex,size:10},
            tokenFlag:true,
            sCallback:function(res) {
                var str = getProductHtmlStr(res);
                $('#product-table').append(str);
            }
        };
        window.base.getData(params);
    }

    /*拼接html字符串*/
    function getProductHtmlStr(res){
        var data = res.data;
        if (data){
            var len = data.length,
                str = '', item;
            if(len>0) {
                for (var i = 0; i < len; i++) {
                    item = data[i];
                    str += '<tr>' +
                        '<td>' + item.id + '</td>' +
                        '<td><a class="edit-name" data-id="' + item.id + '">' + item.name + '</a></td>' +
                        '<td>￥<a class="edit-price" data-id="' + item.id + '">' + item.price + '</a></td>' +
                        '<td><a class="edit-stock" data-id="' + item.id + '">' + item.stock + '</a></td>' +
                        '<td><img style="width: 50px; height: 50px" src=" ' + item.main_img_url + ' "></td>' +
                        '<td><a href="product-detail.html?id=' + item.id + '"><span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span></a>  ' +
                        '   <a class="delete-product" data-id="' + item.id + '"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>' +
                        '</tr>';
                }
            }
            else{
                ctrlLoadMoreBtn();
                moreDataFlag=false;
            }
            return str;
        }
        return '';
    }

    /*控制加载更多按钮的显示*/
    function ctrlLoadMoreBtn(){
        if(moreDataFlag) {
            $('.load-more').hide().next().show();
        }
    }

    /*加载更多*/
    $(document).on('click','.load-more',function(){
        if(moreDataFlag) {
            pageIndex++;
            getProducts(pageIndex);
        }
    });


    $(document).on('click','.delete-product',function () {
        var id = $(this).data('id');
        layer.confirm('确定要删除吗',function () {
            var params = {
                url: 'product/delete/' + id,
                type: 'delete',
                tokenFlag:true,
                sCallback:function (res) {
                    if (res.code == 201){
                        location.replace(location.href);
                    }else {
                        layer.msg('删除失败');
                    }
                },
                eCallback: function (res) {
                    if (res.status == 403){
                        layer.msg('删除失败');
                    }
                }
            };
            window.base.getData(params);
        })

    });


    $(document).on('click','.edit-name',function () {
        var id = $(this).data('id');
        var text = $(this).text();
        layer.prompt({
            formType: 2,
            value: text,
            title: '修改商品名',
            area: ['200px', '50px'] //自定义文本域宽高
        }, function(value, index, elem){
            if (value == text){
                layer.close(index);
            }
            var params = {
                url: 'product/update',
                type: 'post',
                tokenFlag:true,
                data: {
                    id: id,
                    name: value,
                },
                sCallback:function (res) {
                    if (res.code == 201){
                        location.replace(location.href);
                    }else {
                        layer.msg('修改失败');
                    }
                },
                eCallback:function (res) {
                    layer.msg('修改失败');
                }
            }
            window.base.getData(params);

        });
    });

    $(document).on('click','.edit-price',function () {
        var id = $(this).data('id');
        var text = $(this).text();
        layer.prompt({
            formType: 2,
            value: text,
            title: '修改商品价格',
            area: ['200px', '50px'] //自定义文本域宽高
        }, function(value, index, elem){
            if (value == text){
                layer.close(index);
            }
            var params = {
                url: 'product/update',
                type: 'post',
                tokenFlag:true,
                data: {
                    id: id,
                    price: value,
                },
                sCallback:function (res) {
                    if (res.code == 201){
                        location.replace(location.href);
                    }else {
                        layer.msg('修改失败');
                    }
                },
                eCallback:function (res) {
                    layer.msg('修改失败');
                }
            }
            window.base.getData(params);

        });
    });
    $(document).on('click','.edit-stock',function () {
        var id = $(this).data('id');
        var text = $(this).text();
        layer.prompt({
            formType: 2,
            value: text,
            title: '修改库存',
            area: ['200px', '50px'] //自定义文本域宽高
        }, function(value, index, elem){
            if (value == text){
                layer.close(index);
            }
            var params = {
                url: 'product/update',
                type: 'post',
                tokenFlag:true,
                data: {
                    id: id,
                    stock: value,
                },
                sCallback:function (res) {
                    if (res.code == 201){
                        location.replace(location.href);
                    }else {
                        layer.msg('修改失败');
                    }
                },
                eCallback:function (res) {
                    layer.msg('修改失败');
                }
            }
            window.base.getData(params);

        });
    })
});










