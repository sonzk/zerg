$(function () {

    var $ = jQuery,
        $list = $('#thelist'),
        $btn = $('#ctlBtn'),
        url = window.base.g_restUrl,
        pId = window.base.getParam('id');

    var uploader = new WebUploader.Uploader({

        // 选完文件后，是否自动上传。
        auto: false,

        // swf文件路径
        swf: '../js/webuploader/Uploader.swf',

        // 文件接收服务端。
        server: url + 'image/product_images',

        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: '#picker',

        // 只允许选择图片文件。
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/*'
        }
    });


    uploader.on( 'fileQueued', function( file ) {

        file.name = pId + '.' +file.ext;
        $('#picker').hide();
        $('#ctlBtn').show();
        $list.append( '<div id="' + file.id + '" class="item">' +
            '<h4 class="info">' + file.name + '</h4>' +
            '<p>等待上传...</p>' +
            '</div>' );
    });

    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    uploader.on( 'uploadSuccess', function( file ,response ) {
        console.log(response);
        if (response.code == 201){
            layer.msg('上传成功',{time: 500},function () {
                window.location.reload()
            });

        }else {
            layer.msg('上传失败');
        }
    });

    // 文件上传失败，显示上传出错。
    uploader.on( 'uploadError', function( file ) {
        layer.msg('上传失败');
    });


    $btn.on( 'click', function() {
        uploader.upload();
    });

});