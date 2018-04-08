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
                    <el-menu-item index="home">首页</el-menu-item>
                </el-col>
                <el-menu-item index="user_center" v-if="user!=null " >个人中心</el-menu-item>

                <el-menu-item index="logout" v-if="user!=null">登出</el-menu-item>
                <el-menu-item index="login" v-else>登录</el-menu-item>


                <!--<el-menu-item index="4">注册</el-menu-item>-->

            </el-menu>
        </el-col>
        <!--</el-header>-->
    </el-row>
</template>

<script>
    import store from '.././store'
    export default {
        data() {
            return {
                select: '',
                input: '',
                activeIndex: '1',
//                user:'',
//                user: {
//                    id: '' ,
//                    name: ''
//                },
            }
        },
        computed:{
            user : function(){
                return store.getters.user.name ;
                console.log('mounted :  ' +this.user.length );
            }
        },
        mounted: function () {
//          this.user = this.$store.getters.user ;
//
//          this.user.id = this.$store.getters.user.id ;
//            console.log('mounted :  ' +this.user.length );
        },
        methods: {
            handleSelect(key){
                if (key == 'login') {
                    this.$router.push({name: 'login'});
                } else if (key == 'home') {
                    this.$router.push({name: 'home'});
                } else if (key == 'user_center') {
                    this.$router.push({name: 'userCenter'});
                }else if(key == 'logout'){
                    let _this = this;
                    this.$confirm('是否退出系统?', '提示', {
                        confirmButtonText: '确定',
                        cancelButtonText: '取消',
                        type: 'warning'
                    }).then(() => {

                        axios.post('/logout', {}).then((response) => {
                            if (response.data.isLogout) {
                                _this.$store.commit('DELETEUSER');
                                _this.$router.push('/login');
                            }
                        }).catch((error) => {
                            console.log(error);
                        });

                    }).catch(() => {
                        this.$message({
                            type: 'info',
                            message: '已取消'
                        });

                    })
                }
            },
        }

    }
</script>

<style scoped>
    .el-menu--horizontal {
        border-bottom: hidden;
    }
</style>

