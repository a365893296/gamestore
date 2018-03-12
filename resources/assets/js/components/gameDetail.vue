<template>
    <el-row  :style="background">
        <el-col :span="7" :offset="15">
            <div class="messageBox">
                <h3>怪物猎人世界</h3>
                <span>游戏类型:动作游戏</span>
                <span>游戏售价:100</span>
                <span>发售日期:2018-01-02</span>

            </div>
        </el-col>


    </el-row>
</template>

<script>
    export default{
        data(){
            return {
                background: {
                    backgroundImage: "url(" +('http://www.gamestore.com/uploads/images/Celeste.jpg') + ")",
                    backgroundRepeat: "no-repeat",
                    backgroundSize: "100% auto",
                },
            }
        },
        mounted: function () {
            this.getGameDetail();
        },
        methods: {
            getGameDetail: function () {

            }
        }

    }
</script>


<style scoped>

    .messageBox {
        border-radius:1px;
        background-color: #e4e4e4;
        text-align: left;
        margin:2px 2px 2px 2px ;
        font-weight: 400 ;
    }

</style>