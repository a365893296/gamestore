<template>
    <el-row style="margin-top: 1%;">
        <el-col :span="18" :offset="3">
            <el-carousel indicator-position="outside">
                <el-carousel-item v-for="item in 4" :key="item">
                    <h3>{{ item }}</h3>
                </el-carousel-item>
            </el-carousel>
        </el-col>
        <!--<img src="../../image/game.png" style="width: 15%">-->
        <el-row type="flex" justify="center" :gutter="30">
            <el-col :span="3">
                <img v-for="image in images2" v-bind:src="image.url" alt="">
            </el-col>
        </el-row>

    </el-row>
</template>

<script>
    export default{
        data(){
            return {
                images1:[

                ],
                images2:[],
            }
        }
    }
</script>

<style>
    .el-carousel__item h3 {
        color: #475669;
        font-size: 18px;
        opacity: 0.75;
        line-height: 300px;
        margin: 0;
    }

    .el-carousel__item:nth-child(2n) {
        background-color: #99a9bf;
    }

    .el-carousel__item:nth-child(2n+1) {
        background-color: #d3dce6;
    }
</style>