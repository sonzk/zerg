$(function(){

    var id = window.base.getParam('id'), orderStatus,
        from = window.base.getParam('from');
    getDetail(id);

    //获取分类详情
    function getDetail(id) {
        var params={
            url:'order/' + id,
            tokenFlag:true,
            sCallback:function(res) {
                orderStatus = res.status;
                $('.main_img').attr('src',res.snap_img);
                var str = getSnaptHtmlStr(res.snap_items);
                var infoStr = getOrderInfoHtml(res);
                $('#order-product').append(str);
                $('#order-info').append(infoStr);
                getBtn(res.status);
                console.log(res);
            }
        };
        window.base.getData(params);
    }


    //商品详情图HTML拼接
    function getSnaptHtmlStr(snap_items) {
        var len = snap_items.length,
            str = '';
        for (var i = 0; i<len; i++){
            var item = snap_items[i];
            str += '<tr>'+
                '<td>' + item.id + '</td>'+
                '<td>' + item.name + '</td>'+
                '<td>￥' + item.price + '</td>'+
                '<td>' + item.count + '</td>'+
                '<td>￥' + item.totalPrice + '</td>'+
                '<td>'+
                '<div class="photos"><a href="product-detail.html?id='+ item.id +'">'+
                '<img alt="image" class="feed-photo" src="' + item.main_img_url + '">'+
                '</a></div>'+
                '</td>'+
                '</tr>';
        }
        return str;
    }

    function getOrderInfoHtml(res) {
        var str = '';
        str +=
            '<dt>收货人:</dt>' +
            '<dd>'+ res.snap_address.name +'</dd>' +
            '<dt>手机/电话:</dt>' +
            '<dd>'+ res.snap_address.mobile +'</dd>' +
            '<dt>地址:</dt>' +
            '<dd>'+ getTotalAddress(res.snap_address) +'</dd>'+
            '<dt>订单编号:</dt>' +
            '<dd>'+ res.order_no +'</dd>' +
            '<dt>创建时间:</dt>' +
            '<dd>'+ res.create_time +'</dd>' +
            '<dt>订单状态:</dt>' +
            '<dd>'+ getOrderStatus(res.status) +'</dd>';
        if (orderStatus == 3) {
            str += '<dt>物流公司:</dt>' +
                '<dd>'+ res.express_name +'</dd>'+
                '<dt>物流单号:</dt>' +
                '<dd>'+ res.express_no +'</dd>' +
                '<dt>发货时间:</dt>' +
                '<dd>'+ getLocalTime(res.delivery_time) +'</dd>' ;
        }
        return str;
    }


    function getTotalAddress(snap_address) {
       var address = snap_address.city + snap_address.county + snap_address.detail;
       
       if (snap_address.province) {
           address = snap_address.province + address;
       }
       return address;
    }

    function getOrderStatus(status){
        var arr=[{
            cName:'badge badge-warning',
            txt:'未付款'
        },{
            cName:'badge badge-info',
            txt:'已付款'
        },{
            cName:'badge badge-success',
            txt:'已发货'
        },{
            cName:'badge badge-danger',
            txt:'缺货'
        }];
        return '<span class="'+arr[status-1].cName+'">'+arr[status-1].txt+'</span>';
    }

    function getBtn(status) {
        if (status == 2){
            $('#delivery').text('发货').show();
        }else if (status == 4){
            $('#delivery').text('商品缺货状态').show();
        }
    }

    function getLocalTime(nS) {
        return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/,' ');
    }


    $(document).on('click','#delivery-btn',function () {
        var express_name = $('#express_name').val(),
            express_no = $('#express_no').val();
        if (!express_name) {
            layer.msg('请填写物流公司');
            return;
        }
        if (!express_no) {
            layer.msg('请填写物流单号');
            return;
        }

        var params = {
            url: 'order/delivery',
            type: 'post',
            tokenFlag:true,
            data :{
                id:id,
                express_name: express_name,
                express_no: express_no
            },
            sCallback: function (res) {
                console.log(res);
            }
        };
        window.base.getData(params);
    });

    $(document).on('click','#back-order',function () {
        window.location.href = 'order.html?from=' + from;
    })
});













