import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

const state = {
    user: {id: null, name: null, email: null},
    // user: {id: null, name: null, email: null},
}

const mutations = {

    SETUSER(state, user) {
        state.user = user;
        // console.log('user id = ' + state.user.id + 'user name = ' + state.user.name + 'user.email = ' + state.user.email);
        console.log('user' + state.user.id)

    },

    DELETEUSER(state) {
        state.user = {id: null, name: null, email: null}
        console.log('user id = ' + state.user.id + 'user name = ' + state.user.name + 'user.email = ' + state.user.email);

    },

}

const actions = {

    login({commit}) {
        axios.post('/login', {data})
            .then(function (response) {
                user = response.data.user;
                console.log('user id = ' + user.id + 'user name = ' + user.name + 'user.email = ' + user.email);
                commit('SETUSER', response.data.user);
            }).catch(function (error) {
            console.log(error);
        });
    },

    logout({commit}) {
        state.user = {id: null, email: null, name: null};
        console.log('user id = ' + user.id + 'user name = ' + user.name + 'user.email = ' + user.email);

    },

    getUserInfo({commit}) {
        axios.post('/getUserInfo')
            .then(function (response) {
                var user = response.data.user;
                if (!user) {
                    commit('SETUSER', user);
                }
            }).catch(function (error) {
            console.log(error);
        });
    }

}

const getters = {
    user: state => state.user
    // user.id : state=>state.user.id
    // user: state => {
    //         return {
    //             id: state.user.id,
    //             name: state.user.name,
    //             email:state.user.email ,
    //         }
    // },

}


const store = new Vuex.Store({
    strict: process.env.NODE_ENV !== 'production', //在非生产环境下，使用严格模式
    state,
    mutations,
    actions,
    getters,

})
export default store;
