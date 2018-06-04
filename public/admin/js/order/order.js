$(function(){
    var pageIndex=1,
        moreDataFlag=true,
        statusFlag,
        from = window.base.getParam('from');
    if (!from || from == 'no'){
        getOrders(pageIndex);
    }else {
        statusFlag = getStatusByText(from);
        $('option[value='+statusFlag+']').attr('selected',true);
        getStatusOrder(statusFlag);
    }

    /*
    * 获取数据 分页
    * params:
    * pageIndex - {int} 分页下表  1开始
    */
    function getOrders(pageIndex){
        statusFlag = 0;
        var params={
            url:'order/paginate',
            data:{page:pageIndex,size:10},
            tokenFlag:true,
            sCallback:function(res) {
                var str = getOrderHtmlStr(res);
                $('#order-table').append(str);
            }
        };
        window.base.getData(params);
    }


    /*拼接html字符串*/
    function getOrderHtmlStr(res){
        var data = res.data;
        if (data){
            var len = data.length,
                str = '', item;
            if(len>0) {
                for (var i = 0; i < len; i++) {
                    item = data[i];
                    str += '<tr>' +
                        '<td>' + item.id + '</td>' +
                        '<td><img style="width: 60px; height: 60px" src=" ' + item.snap_img + ' "></td>' +
                        '<td>' + item.order_no + '</td>' +
                        '<td>' + item.snap_name + '</td>' +
                        '<td>' + item.total_price + '</td>' +
                        '<td>' + getOrderStatus(item.status) + '</td>' +
                        '<td>' + item.create_time + '</td>' +
                        '<td><a href="order-detail.html?id=' + item.id + '&from='+ getStatusText(statusFlag) +'"><span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span></a>  ' +
                        '</td>' +
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
            $('.load-more').hide();
        }
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

    function getStatusText(status){
        var arr=[
            {cName:'no'
            },{
                cName:'unpay',
            },{
                cName:'payed',
            },{
                cName:'done',
            },{
                cName:'unstock',
            }];
        return arr[status].cName;
    }


    function getStatusOrder(status) {
        var params={
            url:'order/by_status',
            data:{
                status:status,
                page:pageIndex,
                size:10
            },
            tokenFlag:true,
            sCallback:function(res) {
                var str = getOrderHtmlStr(res);
                $('#order-table').append(str);
                console.log(res);
            }
        };
        window.base.getData(params);
    }


    function getStatusByText(text){
        if (text == 'no'){
            return 0;
        } else if (text == 'unpay') {
            return 1;
        }else if (text == 'payed') {
            return 2;
        }else if (text == 'done') {
            return 3;
        }else if (text == 'unstock') {
            return 4;
        }
    }


    /*加载更多*/
    $(document).on('click','.load-more',function(){
        if(moreDataFlag) {
            if (statusFlag == 0){
                pageIndex++;
                getOrders(pageIndex);
            } else {
                pageIndex++;
                getStatusOrder(statusFlag);
            }

        }
    });


    $(document).on('change','#status-choice',function () {
        var status = $(this).val();
        pageIndex=1;
        moreDataFlag = true;
        $('.load-more').show();
        statusFlag = status;
        if (status == 0){
            $('#order-table').html('');
            getOrders(pageIndex);
            return;
        }
        $('#order-table').html('');
        getStatusOrder(status);
    });



});








