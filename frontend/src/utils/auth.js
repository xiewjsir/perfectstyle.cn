import cookies from 'js-cookie'
const tokenKey = 'token'
const userInfoKey = 'userInfo'

export function getToken() {
    return cookies.get(tokenKey)
}

export function setToken(token) {
    return cookies.set(tokenKey, token)
}

export function removeToken() {
    return cookies.remove(tokenKey)
}

export function getUser() {
    return cookies.get(userInfoKey)
}

export function setUser(userInfo) {
    return cookies.set(userInfoKey, userInfo)
}

export function removeUser() {
    return cookies.remove(userInfoKey)
}