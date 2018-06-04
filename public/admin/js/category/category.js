$(function(){

    getCategory();

    /*
    * 获取数据 分页
    * params:
    * pageIndex - {int} 分页下表  1开始
    */
    function getCategory(){
        var params={
            url:'category/all',
            tokenFlag:true,
            sCallback:function(res) {
                console.log(res);
                var str = getCategoryHtmlStr(res);
                $('#category-table').append(str);
            }
        };
        window.base.getData(params);
    }

    /*拼接html字符串*/
    function getCategoryHtmlStr(res){
        var data = res;
        if (data){
            var len = data.length,
                str = '', item;
            if(len>0) {
                for (var i = 0; i < len; i++) {
                    item = data[i];
                    str += '<tr>' +
                        '<td>' + item.id + '</td>' +
                        '<td><a class="category-name" data-id="' + item.id + '">' + item.name + '</a></td>' +
                        '<td><img style="width: 200px; height: 80px" src=" ' + item.img.url + ' "></td>' +
                        '<td><a class="category-list-order" data-id="' + item.id + '">' + item.list_order + '</a></td>'+
                        '<td><a href="category-detail.html?id=' + item.id + '"><span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span></a>' +
                        '   <a class="delete-category" data-id="' + item.id + '"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>' +
                        '</tr>';
                }
            }
            return str;
        }
        return '';
    }



    $(document).on('click','.category-list-order',function () {
        var id = $(this).data('id');
        var text = $(this).text();
        layer.prompt({
            formType: 2,
            value: text,
            title: '修改排序',
            area: ['200px', '50px'] //自定义文本域宽高
        }, function(value, index, elem){
            if (value == text){
                layer.close(index);
            }
            var params = {
                url: 'category/update',
                type: 'post',
                tokenFlag:true,
                data: {
                    id: id,
                    list_order: value,
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
            };
            window.base.getData(params);

        });
    });


    $(document).on('click','.category-name',function () {
        var id = $(this).data('id');
        var text = $(this).text();
        layer.prompt({
            formType: 2,
            value: text,
            title: '修改分类名',
            area: ['200px', '50px'] //自定义文本域宽高
        }, function(value, index, elem){
            if (value == text){
                layer.close(index);
            }
            var params = {
                url: 'category/update',
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
            };
            window.base.getData(params);

        });
    });

    $(document).on('click','.delete-category',function () {
        var id = $(this).data('id');
        layer.confirm('确定要删除吗',function () {
            var params = {
                url: 'category/del/' + id,
                type: 'delete',
                tokenFlag:true,
                sCallback:function (res) {
                    if (res.code == 201){
                        window.location.reload()
                    }else {
                        layer.msg(res.msg);
                    }
                },
                eCallback:function (res) {
                    layer.msg('修改失败');
                }
            };
            window.base.getData(params);
        });
    })


});











