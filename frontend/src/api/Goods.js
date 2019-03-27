import fetch from '@/utils/fetch'

export function getGoods(){
    return  fetch({
        url: '/v1/goods',
        method: 'get',
        data: {
        }
    })    
}