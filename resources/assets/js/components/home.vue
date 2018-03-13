<template>
    <el-row style="margin-top: 1%;">
        <el-col :span="18" :offset="3">
            <el-carousel indicator-position="outside">
                <el-carousel-item v-for="(item,index) in carouselGames" :key="index" >
                    <img :src="item.image" class="image">

                </el-carousel-item>
            </el-carousel>
        </el-col>

        <el-row style="margin-top: 2%;">
            <el-col :span="6" v-for="(o, index) in cardsGames" :key="index" :offset="index/3 > 0 ? 1 : 2">
                <el-card :body-style="{ padding: '0px' }">
                    <img :src="o.image" class="image">
                    <div style="padding: 14px;">
                        <span>{{o.name}}</span>
                        <div class="bottom clearfix">
                            <span>价格:{{o.price}}</span>
                            <el-button type="text" class="button">购买</el-button>
                            <el-button type="text" class="button" @click="handleClick(o.id)">详情</el-button>
                        </div>
                    </div>
                </el-card>
            </el-col>
        </el-row>

        <hr>
        <!--<img src="../../image/game.png" style="width: 15%">-->
        <!--<el-row type="flex" justify="center" :gutter="30">-->
            <!--<el-col :span="3">-->
                <!--<img v-for="image in images2" v-bind:src="image.url" alt="">-->
            <!--</el-col>-->
        <!--</el-row>-->

    </el-row>
</template>

<script>
    export default{
        data(){
            return {
                carouselGames: [],
                cardsGames: [],
            }
        },
        mounted: function () {
            console.log('mounted')
            this.getCarouselGames();
            this.getCardsGames();
        },
        methods: {
            //获取走马灯的图片
            getCarouselGames: function () {
                let _this = this;
                axios.get('/getCarouselGames').then((response) => {
//                    console.log(response);
                    let data = response.data ;
                    _this.carouselGames = data.games ;
                }).catch((error) => {
                    console.log(error);
                });
            },
            //获取游戏列表图片
            getCardsGames: function () {
                let _this = this;
                axios.get('/getCardsGames').then((response) => {
//                    console.log(response);
                    let data = response.data ;
                    _this.cardsGames = data.games ;
                }).catch((error) => {
                    console.log(error);
                });
            },
            handleClick:function(id){
                this.$router.push({path:'/game/${id}', params:{id}});
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

    .time {
        font-size: 13px;
        color: #999;
    }

    .bottom {
        margin-top: 13px;
        line-height: 12px;
    }

    .button {
        padding: 0;
        float: right;
    }

    .image {
        width: 100%;
        display: block;
    }

    .clearfix:before,
    .clearfix:after {
        display: table;
        content: "";
    }

    .clearfix:after {
        clear: both
    }
</style>