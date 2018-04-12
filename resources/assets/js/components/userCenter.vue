<template>

    <el-row :style="background">
        <el-col :span="11" :offset="2">
            <el-card class="box-card">
                {{ user.name }}
            </el-card>
        </el-col>
        <el-col :span="6" :offset="1">
            <el-card class="box-card">
                账户余额:
                <br>
                ￥{{ user.balance }}
            </el-card>
        </el-col>

        <el-col :span="20" :offset="2">
            <el-tabs v-model="activeName" @tab-click="handleClick">
                <el-tab-pane label="已购买" name="first">
                    <el-col :span="6" v-for="(o, index) in games" :key="index" :offset="index%3 > 0 ? 1 : 2"
                            style="margin-top: 1%;">
                        <el-card :body-style="{ padding: '0px' }">
                            <img :src="o.image" class="image">
                            <div style="padding: 14px;">
                                <span>{{o.name}}</span>
                                <div class="bottom clearfix">
                                    <el-button type="text" class="button">下载</el-button>
                                    <el-button type="text" class="button" @click="showGameDetail(o.id)">详情</el-button>
                                </div>
                            </div>
                        </el-card>
                    </el-col>
                </el-tab-pane>
                <el-tab-pane label="修改资料" name="third">
                    角色管理
                </el-tab-pane>
                <el-tab-pane label="查看我的推荐" name="fourth">
                    <el-col>
                        <el-button type="primary" round @click="getRecommend()">刷新</el-button>
                    </el-col>
                    <div>
                        <el-col :span="6" v-for="(o, index) in recommendGames" :key="index"
                                :offset="index%3 > 0 ? 1 : 2"
                                style="margin-top: 1%;">
                            <el-card :body-style="{ padding: '0px' }">
                                <img :src="o.image" class="image">
                                <div style="padding: 14px;">
                                    <div style="height:30px ;">{{o.name}}</div>
                                    <div class="bottom clearfix">
                                        <el-row>
                                            <el-col :span="10" :offset="4">
                                                <div style="text-align: left; font-size: 15px;margin-left: 12%;">
                                                    价格:<span style="color: #ff9900;">{{o.price}}</span>
                                                </div>
                                            </el-col>
                                            <el-col :span="10" style="font-size: 15px;">评分：<span
                                                    style="color: #ff9900;">{{o.rate}}</span></el-col>
                                            <el-col :span="24" style="margin-top: 1%;">

                                                <el-button type="text" class="button" @click="showGameDetail(o.id)">详情
                                                </el-button>
                                            </el-col>
                                        </el-row>
                                    </div>
                                </div>
                            </el-card>
                        </el-col>
                    </div>
                </el-tab-pane>

            </el-tabs>

        </el-col>
    </el-row>


</template>
<script>
    import store from '.././store.js'
    export default{
        data(){
            return {
//                user: '',

                activeName: 'first',
                game: {
                    name: '',
                    category: {
                        name: '',
                    },
                    price: 0,
                    issue_date: '',
                },
                carouselImages: [],
                Image: '',
                background: {
                    backgroundImage: '',
                    backgroundRepeat: "no-repeat",
                    backgroundSize: "100% auto",
                    backgroundColor: '#e8e8e8',
                },
                games: [],
                recommendGames: [],
            }
        },
        computed: {
            user: function () {
                return this.$store.getters.user;
            }
        },
        mounted: function () {
//            this.user = this.$store.getters.user
            this.getMyGameList();
            this.getRecommend()
        },
        methods: {
            //获取已购买的游戏
            getMyGameList: function () {
                let _this = this;
                console.log(_this.user.id);
                axios.post('/getMyGameList', {
                    user_id: _this.user.id,
                }).then((response) => {
                    let data = response.data;
                    _this.games = data.games;

                }).catch((error) => {
                    console.log(error);
                });
            },

            getRecommend: function () {
                let _this = this;
                console.log(_this.user.id);
                axios.post('/getRecommend', {
                    user_id: _this.user.id,
                }).then((response) => {
                    let data = response.data;
                    _this.recommendGames = data.games;
                }).catch((error) => {
                    console.log(error);
                });
            },
            //查看游戏详情
            showGameDetail: function (Id) {
                const id = Id;
                this.$router.push({path: `/game/${id}`});
            },
            tabClick: function () {

            },
            handleClick(tab, event) {
                console.log(tab, event);
//                this.getGameList();
            },

        }
    }
</script>

<style scoped>

    .text {
        font-size: 14px;
    }

    .item {
        padding: 18px 0;
    }

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