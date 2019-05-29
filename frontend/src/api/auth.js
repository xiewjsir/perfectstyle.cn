import fetch from '@/utils/fetch'

export function login(username, password) {
    return fetch({
        url: '/login',
        method: 'post',
        data: {
            username,
            password
        }
    })
}

export function logout() {
    return fetch({
      url: '/logout',
      method: 'post'
    })
}

export function loginToken() {
    return fetch({
        url: '/token/refresh',
        method: 'post'
    })
}

//我的个人信息
export function usersInfo() {
    return fetch({
        url: '/auth/user',
        method: 'get'
    })
}

