import fetch from '@/utils/fetch'

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

