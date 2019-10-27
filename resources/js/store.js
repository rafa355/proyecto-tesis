import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        isLoggedIn: !!localStorage.getItem('token')
    },
    mutations: {
        loginUser(state) {
            state.isLoggedIn = true
        },
        logoutUser(state) {
            state.isLoggedIn = false
        },
    }
})

export default store