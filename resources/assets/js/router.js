/**
 * Created by nikejin on 2018/2/4.
 */
import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

// import home from './components/home'
import home from './components/home.vue'
import Login from './components/login.vue'
import Register from './components/register.vue'
import GameDetail from './components/gameDetail.vue'

const router = new Router({
    routes: [
        {
            path: '/',
            redirect: '/home'
        },{
            path:'/home' ,
            name: home ,
            component:home,
        },{
            path:'/shopping_cart',
            // name:shopping_cart ,
        },{
            path: '/login',
            name: 'login',
            component: Login,
        }, {
            path: '/register',
            name: 'register',
            component: Register,
        },{
            path:'/game/:id' ,
            name: 'gameDetail' ,
            component:GameDetail,
        }
    ]
})

export default router
