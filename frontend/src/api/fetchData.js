import fetch from '@/utils/fetch'
import qs from 'qs'
/*
    菜单列表
 */
export function shopMenu(){
    return  fetch({
        url: '/v1/categories',
        method: 'get',
        data: {}
    })
}

/*
    首页摇购
 */
export function homeGoods(currentPage,params){
    return  fetch({
        url: '/v1/goods/getShakingByToday?page=' + currentPage + '&' + qs.stringify(params),
        method: 'GET',
        data: {
        }
    })
}

export function goodsList(id,currentPage){
    return  fetch({
        url: '/v1/goods?id='+id+'&page=' + currentPage,
        method: 'GET',
        data: {
        }
    })
}

//商品详情
export function goodsDetail(id){
    return  fetch({
        url: '/v1/goods/' + id,
        method: 'GET',
        data: {}
    })
}


//充值记录 1余额，2摇金，3积分
export function accountLog(type,currentPage,params){
    return  fetch({
        url: '/v1/accountLog?account_type=' + type+'&page=' + currentPage + '&' +  qs.stringify(params),
        method: 'GET',
        data: {}
    })
}

//排行榜
export function ranking(params){
    let paramstr = params == {} ? '' : ('?'+ qs.stringify(params))
    return  fetch({
        url: '/v1/ranking' +  paramstr,
        method: 'GET',
        data: {}
    })
}