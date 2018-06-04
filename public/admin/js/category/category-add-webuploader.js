$(function () {

    var $ = jQuery,
        $list = $('#fileList'),
        ratio = window.devicePixelRatio || 1,
        thumbnailWidth = 50 * ratio,
        thumbnailHeight = 50 * ratio,
        url = window.base.g_restUrl;

    var uploader = new WebUploader.Uploader({

        // 选完文件后，是否自动上传。
        auto: true,

        // swf文件路径
        swf: '../js/webuploader/Uploader.swf',

        // 文件接收服务端。
        server: url + 'image/upload',

        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: '#filePicker',

        // 只允许选择图片文件。
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/*'
        }
    });


    uploader.on( 'fileQueued', function( file ) {


        var $li = $(
            '<label class="col-sm-2 control-label"></label>'+
            '<div id="' + file.id + '" >' +
            '<img >' +
            '<div class="info"></div>' +
            '</div>'
            ),
            $img = $li.find('img');


        // $list为容器jQuery实例
        $list.append( $li );

        // 创建缩略图
        // 如果为非图片文件，可以不用调用此方法。
        // thumbnailWidth x thumbnailHeight 为 100 x 100
        uploader.makeThumb( file, function( error, src ) {
            if ( error ) {
                $img.replaceWith('<span>不能预览</span>');
                return;
            }

            $img.attr( 'src', src );
        }, thumbnailWidth, thumbnailHeight );
    });

    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    uploader.on( 'uploadSuccess', function( file ,response ) {
        console.log(response);
        if (response.code){
            layer.msg('上传成功');
            $('input[name=topic_img_url]').val(response.main_img_url);
        }else {
            layer.msg('上传失败');
        }
    });

    // 文件上传失败，显示上传出错。
    uploader.on( 'uploadError', function( file ) {
        layer.msg('上传失败');
    });

});