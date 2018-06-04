$(function(){

    getTheme();
    var themeId;
    /*
    * 获取数据 分页
    * params:
    * pageIndex - {int} 分页下表  1开始
    */
    function getTheme(){
        var params={
            url:'theme?ids=1,2,3',
            tokenFlag:true,
            sCallback:function(res) {
                console.log(res);
                // $('.banner-title').find('h5').text(res.description);
                var str = getThemeHtmlStr(res);
                $('#theme-table').append(str);
            }
        };
        window.base.getData(params);
    }

    /*拼接html字符串*/
    function getThemeHtmlStr(res){
        var data = res;
        if (data){
            var len = data.length,
                str = '', item;
            if(len>0) {
                for (var i = 0; i < len; i++) {
                    item = data[i];
                    str += '<tr>' +
                        '<td>' + item.id + '</td>' +
                        '<td><a class="theme-name" data-id="'+ item.id +'">' + item.name + '</a></td>' +
                        '<td><a class="theme-description" data-id="'+ item.id +'">' + item.description + '</a></td>' +
                        '<td><div class="photos"><a class="topic_img" data-id="'+item.id+'">'+
                        '<img alt="image" class="feed-photo" src="' + item.topic_img.url + '">'+
                        '</a></div></td>'+
                        '<td><a href="theme-detail.html?id=' + item.id + '"><span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span></a>' +
                        '</td>' +
                        '</tr>';
                }
            }
            return str;
        }
        return '';
    }


    $(document).on('click','.theme-name',function () {
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
                url: 'theme/update',
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

    $(document).on('click','.theme-description',function () {
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
                url: 'theme/update',
                type: 'post',
                tokenFlag:true,
                data: {
                    id: id,
                    description: value,
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

    $(document).on('click','.topic_img',function () {
        themeId = $(this).data('id');
        $('#upload_file').click();
    });

    $(document).on('change','#upload_file',function () {
        var url = window.base.g_restUrl;
        var file_obj = $('#upload_file')[0].files[0];
        var formFile = new FormData();
        formFile.append('type','topic_img');
        formFile.append("id", themeId);
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