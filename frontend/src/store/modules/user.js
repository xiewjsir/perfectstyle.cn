import {login, logout} from '@/api/auth'
import { getToken, setToken, removeToken } from '@/utils/auth'

const user = {
    state: {
        token: getToken(),
        name: '',
        avatar: ''
    },
    mutations: {
        setToken: (state, token) => {
            state.token = token
        },
        setName: (state, name) => {
            state.name = name
        },
        setAvater: (state, avatar) => {
            state.avatar = avatar
        }
    },
    actions: {
        login({ commit }, userInfo) {
            const username = userInfo.username.trim()
            return new Promise((resolve, reject) => {
                login(username, userInfo.password).then(response => {
                    console.log('login api success')

                    const data = response                    
                    setToken(data.token)
                    commit('setToken', data.token)

                    resolve()
                }).catch(error => {
                    console.log('login api error')
                    reject(error)
                })
            })
        },
        logout({commit}){
            return new Promise((resolve,reject)=>{
                logout().then(()=>{
                    commit('setToken','')
                    removeToken()
                    resolve()
                }).catch(error=>{
                    reject(error)
                })
            })
        },
        frontLogout({ commit }) {//前端登出
            return new Promise(resolve => {
                commit('setToken', '')
                removeToken()
                resolve()
            })
        }
    }
}

export default user