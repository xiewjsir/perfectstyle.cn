import fetch from '@/utils/fetch'

export function addCart(skuId,goodsId,num){
    return  fetch({
        url: '/v1/cart',
        method: 'post',
        data: {
            sku_id:skuId,
            goods_id:goodsId,
            num,
        }
    })    
}