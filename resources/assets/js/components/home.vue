<template>
    <el-row style="margin-top: 1%;">
        <el-col :span="18" :offset="3">
            <el-carousel indicator-position="outside">
                <el-carousel-item v-for="(item,index) in carouselGames" :key="index">
                    <img :src="item.image" class="image">

                </el-carousel-item>
            </el-carousel>
        </el-col>

        <el-col :span="6" v-for="(o, index) in cardsGames" :key="index" :offset="index%3 > 0 ? 1 : 2"
                style="margin-top: 1%;">
            <el-card :body-style="{ padding: '0px' }">
                <img :src="o.image" class="image">
                <div style="padding: 14px;">
                    <div style="height:30px ;">{{o.name}}</div>
                    <div class="bottom clearfix">
                        <!--<el-rate-->
                                <!--v-model="o.rate"-->
                                <!--show-score-->
                                <!--text-color="#ff9900"-->
                                <!--score-template="{value}"-->
                                <!--disabled>-->
                        <!--</el-rate>-->
                        <el-row>
                            <el-col :span="6" :offset="6">
                                <div style="text-align: left; font-size: 15px;margin-left: 12%;">
                                    价格:<span style="color: #ff9900;">{{o.price}}</span>
                                </div>
                            </el-col>
                            <el-col :span="8" style="font-size: 15px;">评分：<span style="color: #ff9900;">{{o.rate}}</span></el-col>
                            <el-col :span="24" style="margin-top: 1%;">
                                <el-button type="text" class="button" @click="purchase(o)">购买</el-button>
                                <el-button type="text" class="button" @click="showGameDetail(o.id)">详情</el-button>
                            </el-col>
                        </el-row>


                    </div>
                </div>
            </el-card>
        </el-col>

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
            this.getCarouselGames();
            this.getCardsGames();
        },
        methods: {
            //获取走马灯的图片
            getCarouselGames: function () {
                let _this = this;
                axios.get('/getCarouselGames').then((response) => {
                    let data = response.data;
                    _this.carouselGames = data.games;
                }).catch((error) => {
                    console.log(error);
                });
            },
            //获取游戏列表图片
            getCardsGames: function () {
                let _this = this;
                axios.get('/getCardsGames').then((response) => {
                    let data = response.data;
                    console.log(data)
                    _this.cardsGames = data.games;
                }).catch((error) => {
                    console.log(error);
                });
            },
            showGameDetail: function (Id) {
                const id = Id;
                this.$router.push({path: `/game/${id}`});
            },

            purchase: function (game) {
                let user = this.$store.getters.user;
                let _this = this;
                console.log(user.id == null);

//                if (user.id == null) {
//                    this.$alert('请先登录，以继续购买', '提示', {
//                        confirmButtonText: '确定',
//                        cancelButtonText: '取消',
//                        type: 'warning'
//                    }).then(() => {
//                        _this.$router.push('/login');
//                    }).catch(() => {
//                    })
//                }
//                if (user.id == null) {
//                    this.$confirm('请先登录，以继续购买', '提示', {
//                        confirmButtonText: '确定',
//                        cancelButtonText: '取消',
//                        type: 'warning'
//                    }).then(() => {
//                        _this.$router.push('/login');
//                    }).catch(() => {
//                    })
//                }

                this.$confirm('确认购买此游戏吗？', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'info'
                }).then(() => {

                    axios.post('/purchase', {
                        'game': game,
                        'user': user
                    }).then((response) => {
                        let data = response.data;
                        var type = 'success';
                        if (data.status != 'success') {
                            var type = 'error';
                        }
                        this.$message({
                            type: type,
                            message: data.message
                        })
                        console.log('data : ' + data);
                    }).catch((error) => {
                        console.log(error)
                    });

                })

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