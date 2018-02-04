/**
 * Created by nikejin on 2018/2/4.
 */
import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

// import home from './components/home'
import home from './components/GamestoreComponent.vue'
const router = new Router({
    routes: [
        {
            path: '/',
            redirect: '/home'
        },{
            path:'/home' ,
            name: home ,
            component:home,
        }
    ]
})

export default router
