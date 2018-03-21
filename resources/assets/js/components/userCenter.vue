<template>

    <el-row :style="background">
        <el-col :span="11" :offset="2">
            <el-card class="box-card">
                怎么没人叫这么名
            </el-card>

        </el-col>
        <el-col :span="6" :offset="1">
            <el-card class="box-card">
                账户余额
                <br>
                $111
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
                <el-tab-pane label="点赞过的游戏" name="second">配置管理</el-tab-pane>
                <el-tab-pane label="修改资料" name="third">角色管理</el-tab-pane>
                <el-tab-pane label="查看我的推荐" name="fourth">查看我的推荐</el-tab-pane>
            </el-tabs>
        </el-col>
    </el-row>


</template>
<script>
    export default{
        data(){
            return {
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
            }
        },
        mounted: function () {
//            this.getGameList();
        },
        methods: {
            //获取已购买的游戏
            getGameList: function () {
                let _this = this;
                axios.get('/getGameList').then((response) => {
                    let data = response.data;
                    _this.games = data.games;
                    console.log('kkkkk');

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
            }

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

</style>