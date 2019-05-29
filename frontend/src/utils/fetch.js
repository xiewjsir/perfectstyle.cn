import axios from 'axios'
import qs from 'qs'
import store from '@/store'
import { getToken, setToken } from '@/utils/auth'
import { loginToken } from "@/api/auth";

const service = axios.create({// 创建axios实例
    baseURL: process.env.VUE_APP_BASE_API,
    timeout: 150000,// 请求超时时间
    withCredentials: true
})

service.interceptors.request.use(config => {// request拦截器
    //if (getToken()) {
        config.headers['Authorization'] = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9vbWMud29ydGhjbG91ZC5uZXRcL3YxXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU1NTU3NTM2MCwiZXhwIjoxNTU1NTc4OTYwLCJuYmYiOjE1NTU1NzUzNjAsImp0aSI6Ik1KWEVVRlVwRHppb0I2WGMiLCJzdWIiOjIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.sDiqZiRctME_8txGPl4UL1bWfumSgSIJdk09Y4le49Q";// + getToken() // 让每个请求携带自定义token 请根据实际情况自行修改
    //}

    if(config.method == "post"){
        config.data = qs.stringify(config.data);
    }   

    let url = config.url  // 当前访问的地址

    let white_list = ['/v1/login','/v1/user', '/v1/logout', '/v1/loginWithThree']// 对指定的白名单API自动放行，一般用于登录和退出
    if (white_list.indexOf(url) !== -1) {
        return config
    }

    let isPermission = true // 权限表示，用户是否有权限

    if (!isPermission) {// 根据判断的结果，来决定是否有访问内容        
        let error = {
            response: {
                data: {
                    message: '前端拦截，当前用户没有权限访问指定的内容',
                    status: 'error',
                    code: 403
                },
                status: 403
            }
        }
        return Promise.reject(error)
    }
    return config
}, error => {
    //Do something with request error
    console.log(error) // for debug
    return Promise.reject(error)
})


service.interceptors.response.use(// respone拦截器
    response => {
        const res = response.data
        return response
    },
    error => {
        console.log(error);
        if (error.response.status == 401) {  // 刷新token
            loginToken().then(response => {
                setToken(response.token)
                let url = location.href
                window.VM.$router.go(0)
            })
        } else {
            // if (error.response.status == 500) { // token过期  退出系统
            //     console.log('frontLogout');
            //     store.dispatch('frontLogout').then(() => {
            //         window.VM.$router.push({ path: '/login' })
            //     })
            // }
            // return Promise.reject(error)
        }
    }
)

export default service
