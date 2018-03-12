<template>
    <el-row>
        <el-col>
            <img src="http://www.gamestore.com/uploads/images/Celeste.jpg" alt="">

        </el-col>
    </el-row>
</template>

<script>
    export default{
        data(){
            return {}
        },
        mounted:function(){
           this.getGameDetail();
        },
        methods:{
            getGameDetail:function(){

            }
        }

    }
</script>


<style>
    #background{
       /*background: url() center 0px no-repeat #e4e4e4;*/
    }

</style>