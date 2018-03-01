<template>
    <div>
    <navbar></navbar>
        <transition appear name="fade" mode="out-in">
            <!--<router-view></router-view>-->
        </transition>
    </div>
</template>

<script>
    import navbar from  './navbar.vue'
    export default {
        name: 'app',
        data() {
            return {}
        },
        methods: {},
        mounted: function () {
//            store.dispatch('getUserInfo');
        },
        components:{
            navbar
        }
    }
</script>

<style>
    #app {
        font-family: 'Avenir', Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: center;
        color: #2c3e50;
        height: 100%;
        /*margin-top: 60px;*/
    }

    img {
        width: 100%;
        height: 100%;
    }

    html, body {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;

    }

    /* 可以设置不同的进入和离开动画 */
    /* 设置持续时间和动画函数 */
    .slide-fade-enter-active {
        transition: all .3s ease;
    }

    .slide-fade-leave-active {
        transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }

    .slide-fade-enter, .slide-fade-leave-active {
        transform: translateX(10px);
        opacity: 0;
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity .3s
    }

    .fade-enter, .fade-leave-active {
        opacity: 0
    }
</style>
