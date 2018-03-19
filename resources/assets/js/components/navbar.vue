<template>
    <el-row>
        <el-col :span='24'>
            <el-menu :default-active="activeIndex"
                     class="el-menu--horizontal"
                     mode="horizontal"
                     @select="handleSelect"
                     background-color="#545c64"
                     text-color="#fff"
                     active-text-color="#ffd04b"
                     router
            >
                <el-col :span="6" style="margin-top: 1%;">
                    <span style="color:white;">GameStore</span>
                    <!--<h3><img src="../../image/game.png" style="width: 15%"> GameStore</h3>-->
                </el-col>
                <el-col :span="4" style="margin-top: 1%;">
                    <el-input v-model="input" placeholder="sss" size="small" suffix-icon="el-icon-search"></el-input>
                </el-col>
                <el-col :span="3" :offset="4">
                    <el-menu-item index="home" >首页</el-menu-item>
                </el-col>
            <!--todo 先这样吧 后面再改-->
                <!--<el-submenu index="userCenter">-->
                    <!--<template slot="title">个人中心</template>-->
                    <!--<el-menu-item index="2-1">选项1</el-menu-item>-->
                    <!--<el-menu-item index="2-2">选项2</el-menu-item>-->
                    <!--<el-menu-item index="2-3">选项3</el-menu-item>-->
                <!--</el-submenu>-->
                    <el-menu-item index="user_center">个人中心</el-menu-item>
                    <el-menu-item index="login">登录</el-menu-item>
                    <!--<el-menu-item index="4">注册</el-menu-item>-->

            </el-menu>
        </el-col>
        <!--</el-header>-->
    </el-row>
</template>

<script>
    import store from '.././store.js'
    export default {
        data() {
            return {
                select: '',
                input: '',
                activeIndex: '1',
                user:store.getters.user.name,
            }
        },
        mounted:function(){
                this.consss(1);
        },
        methods: {
            handleSelect(key){
                if(key == 'login'){
                    this.$router.push({name:'login'});
                }else if(key=='home'){
                    this.$router.push({name:'home'});
                }else if(key == 'userCenter'){
                    this.$router.push({name:'userCenter'});
                }
            },
            consss(i){
                console.log(this.user);
            }
        }

    }
</script>

<style scoped>
    .el-menu--horizontal {
        border-bottom: hidden;
    }
</style>

