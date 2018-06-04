$(function(){

    getBanner();

    /*
    * 获取数据 分页
    * params:
    * pageIndex - {int} 分页下表  1开始
    */
    function getBanner(){
        var params={
            url:'banner/1',
            tokenFlag:true,
            sCallback:function(res) {
                console.log(res);
                $('.banner-title').find('h5').text(res.description);
                var str = getBannerHtmlStr(res);
                $('#banner-table').append(str);
            }
        };
        window.base.getData(params);
    }

    /*拼接html字符串*/
    function getBannerHtmlStr(res){
        var data = res.items;
        if (data){
            var len = data.length,
                str = '', item;
            if(len>0) {
                for (var i = 0; i < len; i++) {
                    item = data[i];
                    str += '<tr>' +
                        '<td>' + item.id + '</td>' +
                        '<td>' + getType(item.type) + '</td>' +
                        '<td><img style="width: 100px; height: 50px" src=" ' + item.img.url + ' "></td>' +
                        '<td><a class="banner-list-order" data-id="' + item.id + '">' + item.list_order + '</a></td>'+
                        '<td><a href="banner-detail.html?id=' + item.id + '"><span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span></a>' +
                        '</td>' +
                        '</tr>';
                }
            }
            return str;
        }
        return '';
    }

    function getType(type){
        var arr=[{
            txt:'商品'
        },{
            txt:'主题'
        }];
        return arr[type-1].txt;
    }


    $(document).on('click','.banner-list-order',function () {
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
                url: 'banner/item_update',
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

});