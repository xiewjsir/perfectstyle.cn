import fetch from '@/utils/fetch'

export function getColumns(parent_id = 0){
    return fetch({
        url: '/column',
        method: 'get',
        data: {
            parent_id:parent_id
        }
    })
}