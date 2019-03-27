import fetch from '@/utils/fetch'
import qs from 'qs'

export function joinShaking(id,shakingType,paymentType){
    paymentType = paymentType == 'beans' ? 2 : 1;
    return  fetch({
        url: '/v1/shaking',
        method: 'post',
        data: {
            shaking_id:id,
            shaking_type:shakingType,
            payment_type:paymentType
        }
    })
}


//摇购详情
export function shakingDetail(id,params){
    return  fetch({
        url: '/v1/shaking/'+ id +'?'+qs.stringify(params),
        method: 'get'
    })
}

//订单 win:1我的未中订单 ，2 我的摇中订单 order_status:1待支付，2已发货，4已收货，9完成
//0全部 1待处理 2待结算 3待审核 4已结算 5已驳回
export function shakingOrder(currentPage,params){
    var str = params ? '&'+ qs.stringify(params) : ''
    return  fetch({
        url: '/v1/order?page='+currentPage+str,
        method: 'get'
    })
}

//订单详情
export function orderDetails(id){
    return  fetch({
        url: '/v1/order/'+id,
        method: 'get'
    })
}