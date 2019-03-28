const getters = {
    token: state => state.user.token,
    avatar: state => process.env.MIX_PUSHER_APP_KEY + '/' + state.user.avatar,
    name: state => state.user.name
}

export default getters