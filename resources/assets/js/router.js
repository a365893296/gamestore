/**
 * Created by nikejin on 2018/2/4.
 */
import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

// import home from './components/home'
import Home from './components/Home.vue'
import Login from './components/login.vue'
import Register from './components/register.vue'
import GameDetail from './components/gameDetail.vue'
import UserCenter from './components/userCenter.vue'

import store from './store'

export const auth = (to, from, next) => {

    if (store.getters.user.id) {
        next();
    } else {
        router.push({
            path: '/login',
            query: {
                forward: to.path,
            }
        })
    }
}

const router = new Router({
    routes: [
        {
            path: '/',
            redirect: '/home'
        }, {
            path: '/home',
            name: 'home',
            component: Home,
        }, {
            path: '/shopping_cart',
            // name:shopping_cart ,
        }, {
            path: '/login',
            name: 'login',
            component: Login,
        }, {
            path: '/register',
            name: 'register',
            component: Register,
        }, {
            path: '/game/:id',
            name: 'gameDetail',
            component: GameDetail,
        }, {
            path: '/user_center',
            name: 'userCenter',
            component: UserCenter,
            beforeEnter: auth ,
        }, {
            path: '/logout',
            name: 'logout',
        },
    ]
})

export default router
