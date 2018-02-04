<template>
    <el-container>
        <!--<el-header style="background-color:#00EFEF ;">-->

                <!--logo-->
                <el-col :span="6">
                    <div>
                        <h3><img src="../../image/game.png" style="width: 15%"> GameStore</h3>
                    </div>
                </el-col>
        <el-col :span='18'>
                <!--<el-col :span="8" :offset="2">-->
                    <!--<div>-->
                        <!--<el-input placeholder="请输入内容" v-model="input" size="small" class="input-with-select">-->
                            <!--<el-select v-model="select" slot="prepend" placeholder="请选择">-->
                                <!--<el-option label="餐厅名" value="1"></el-option>-->
                                <!--<el-option label="订单号" value="2"></el-option>-->
                                <!--<el-option label="用户电话" value="3"></el-option>-->
                            <!--</el-select>-->
                            <!--<el-button slot="append" icon="el-icon-search"></el-button>-->
                        <!--</el-input>-->
                    <!--</div>-->
                <!--</el-col>-->
                <!--<el-col :span="4" :offset="4">-->
                    <!--<router-link to="register">登录</router-link>|-->
                    <!--<router-link to="register" >注册</router-link>-->

                <!--</el-col>-->
                <el-menu :default-active="activeIndex" class="el-menu-demo" mode="horizontal" @select="handleSelect">
                    <el-menu-item index="1">处理中心</el-menu-item>
                    <el-submenu index="2">
                        <template slot="title">我的工作台</template>
                        <el-menu-item index="2-1">选项1</el-menu-item>
                        <el-menu-item index="2-2">选项2</el-menu-item>
                        <el-menu-item index="2-3">选项3</el-menu-item>
                    </el-submenu>
                    <el-menu-item index="3"><a href="https://www.ele.me" target="_blank">订单管理</a></el-menu-item>
                </el-menu>
           </el-col>
        <!--</el-header>-->
    </el-container>
</template>

<script>
    export default {
        data() {
            return {
                select: '',
                input: '',
                activeIndex : '1' ,

            }
        },
        methods:{
            handleSelect(){}
        }

    }
</script>

<sytle scoped>
    body{
    text-align:center ;
    margin-top:13% ;
    }
</sytle>