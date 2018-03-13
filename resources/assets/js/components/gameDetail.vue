<template>
    <el-row  :style="background">
        <el-col :span="6" :offset="15">
            <div class="messageBox">
                <h2>怪物猎人:世界</h2>
                <p>游戏类型:动作游戏</p>
                <p>游戏售价:100</p>
                <p>发售日期:2018-01-02</p>
                <el-button type="text">立即购买</el-button>
                <el-button type="success">加入购物车</el-button>
            </div>
        </el-col>
        <el-col :span="12" :offset="3">
                <el-carousel indicator-position="outside">
                    <el-carousel-item v-for="(item,index) in carouselGames" :key="index" >
                        <img :src="item.image" class="image">

                    </el-carousel-item>
                </el-carousel>
        </el-col>


    </el-row>
</template>

<script>
    export default{
        data(){
            return {
                carouselGames:'',
                background: {
                    backgroundImage: "url(" +('http://www.gamestore.com/uploads/images/Celeste.jpg') + ")",
                    backgroundRepeat: "no-repeat",
                    backgroundSize: "100% auto",
                },
            }
        },
        mounted: function () {
            this.getGameDetail();
            this.getCarouselGames();
        },
        methods: {
            getGameDetail: function () {

            },
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
        }

    }
</script>


<style scoped>

    .messageBox {
        border-radius:1px;
        background-color: #e4e4e4;
        text-align: left;
        margin:8% 1px 6% 4px ;
        font-weight: 200 ;
        line-height:20px;
        text-align: left;
        padding: 8px 5px 5px 8px;
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