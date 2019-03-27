import fetch from '@/utils/fetch'

export function register(userInfo){
    return fetch({
        url:'/v1/register',
        method:'post',
        data:userInfo
    })
}

export function login(username, password) {
    return fetch({
        url: '/v1/login',
        method: 'post',
        data: {
            mobile:username,
            password
        }
    })
}

export function logout() {
    return fetch({
      url: '/v1/logout',
      method: 'post'
    })
}

export function loginToken() {
    return fetch({
        url: '/v1/token/refresh',
        method: 'post'
    })
}

//我的个人信息
export function usersInfo() {
    return fetch({
        url: '/v1/auth/user',
        method: 'post'
    })
}

export function sms(mobile) {
    return fetch({
        url: '/v1/sms',
        method: 'post',
        data:{
            mobile:mobile
        }
    })
}
//添加银行卡信息
export function addCardInfo(cardInfo) {
    return fetch({
        url: '/v1/userBank',
        method: 'post',
        data:cardInfo
    })
}

//删除银行卡信息
export function deleteCardInfo(id) {
    return fetch({
        url: '/v1/userBank/'+id,
        method: 'DELETE'
    })
}

//获取银行卡信息
export function getCardBank() {
    return fetch({
        url: '/v1/userBank',
        method: 'get'
    })
}

//提现
export function withCash(amount,bankInfo) {
    console.log(amount,bankInfo)
    return fetch({
        url: '/v1/cashOrder',
        method: 'post',
        data:{
            amount,
            info:bankInfo
        }
    })
}

//提现
export function getRecord(currentPage) {
    return fetch({
        url: '/v1/cashOrder?page='+currentPage,
        method: 'get'
    })
}