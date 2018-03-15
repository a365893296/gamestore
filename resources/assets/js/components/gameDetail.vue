<template>
    <el-row  :style="background">
        <el-col :span="6" :offset="15">
            <div class="messageBox">
                <h2>{{game.name}}</h2>
                <p>游戏类型:{{game.category.name}}</p>
                <p>游戏售价:{{game.price}}</p>
                <p>发售日期:{{game.issue_date}}</p>
                <el-button type="text">立即购买</el-button>
                <el-button type="success">加入购物车</el-button>
            </div>
        </el-col>
        <el-col :span="12" :offset="3" style="margin-top: 3%;">
                <el-carousel indicator-position="outside">
                    <el-carousel-item v-for="(item,index) in carouselImages" :key="index" >
                        <img :src="item" class="image">
                    </el-carousel-item>
                </el-carousel>
        </el-col>
        <el-col :span="5" :offset="1">

        </el-col>


    </el-row>
</template>

<script>
    export default{
        data(){
            return {
                game:{
                    name:'',
                    category:{
                        name:'',
                    },
                    price:0 ,
                    issue_date:'',
                },
                carouselImages:[] ,
                Image:'',
                background: {
                    backgroundImage : '',
                    backgroundRepeat: "no-repeat",
                    backgroundSize: "100% auto",
                    backgroundColor: '#e8e8e8',
                },
            }
        },
        mounted: function () {
            this.getGameDetail();
        },
        methods: {
            getGameDetail: function () {
                let _this = this;
                const Id = _this.$route.params.id;
                axios.post('/game/'+Id,{
                    id:Id,
                }).then((response) => {
                    let data = response.data ;
                    _this.game = data.game ;
                    _this.background.backgroundImage ="url('"+ data.game.background_image+"')";
                    _this.carouselImages = data.game.images ;
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