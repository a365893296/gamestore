<template>
    <div>
        <el-row id="background">
            <el-col :span="8">&nbsp</el-col>

            <el-col :span="7">
                <div class="form">
                    <el-form :model="registerForm" ref="registerForm" :rules="rules" label-width="90px">
                        <el-form-item>
                            <el-col :span="20">
                                <h1>用户注册</h1>
                            </el-col>
                        </el-form-item>

                        <el-form-item label="邮箱" prop="邮箱">
                            <el-input v-model="registerForm.email"></el-input>
                        </el-form-item>
                        <el-form-item label="用户名" prop="用户名">
                            <el-input v-model="registerForm.name"></el-input>
                        </el-form-item>

                        <el-form-item label="密码" prop="password">
                            <el-input v-model="registerForm.password" type="password"></el-input>
                        </el-form-item>

                        <el-form-item label="确认密码" prop="checkPassword">
                            <el-input v-model="registerForm.checkPassword" type="password"></el-input>
                        </el-form-item>

                        <el-form-item label="验证码" prop="verifyCode">
                            <el-input v-model="registerForm.verifyCode"></el-input>
                        </el-form-item>

                        <el-form-item>
                            <el-col :span="12">
                                <el-button type="primary" @click="register(registerForm)">注册</el-button>
                            </el-col>
                            <el-col :span="4">
                                <el-button @click="resetForm('registerForm')">重置</el-button>
                            </el-col>
                        </el-form-item>
                    </el-form>
                </div>
            </el-col>

            <el-col :span="8"></el-col>
        </el-row>
    </div>
</template>

<script>
    //    import mockdata from '@/util/mockdata.js'

    export default {
        data() {

            var validatePassword = (rule, value, callback) => {
                if (this.registerForm.password !== this.registerForm.checkPassword) {
                    callback(new Error('两次输入的密码不同!'));
                } else {
                    callback();
                }
            };

            return {

                registerForm: {
                    email: '',
                    name: '',
                    password: '',
                    checkPassword: '',
                    verifyCode: '',
                },

                rules: {
                    email: [
                        {
                            required: true, message: '请输入邮箱', trigger: 'blur',
                        }, {
                            min: 4, max: 20, message: '长度在 4 - 20 之间', trigger: 'blur',
                        }
                    ],
                    name: [
                        {
                            required: true, message: '请输入用户名', trigger: 'blur',
                        }, {
                            min: 4, max: 20, message: '长度在 4 - 20 之间', trigger: 'blur',
                        }
                    ],
                    password: [
                        {
                            required: true, message: '请输入密码', trigger: 'blur',
                        },
//                        {
//                            validator: validatePassword, trigger: 'blur',
//                        }
                    ],
                    checkPassword: [
                        {
                            required: true, message: '重新确认密码', trigger: 'blur',
                        }, {
                            validator: validatePassword, trigger: 'blur',
                        }
                    ],
                    verifyCode: [
                        {
                            required: true, message: '请输入验证码', trigger: 'blur',
                        }
                    ],

                }
            }
        },

        methods: {
            register(formName) {
                let _this = this;

                this.$refs['registerForm'].validate((valid) => {
                        if (valid) {

                            axios.post('/register', {
                                'email': formName.email,
                                'password': formName.password,
                                'name': formName.name
                            }).then(function (response) {
                                var data = response.data;
                                if (data.isRegister) {
                                    _this.$message({
                                        message: '注册成功~',
                                        type: "success"
                                    });

                                    setTimeout(() => {
                                        _this.$router.push({path: '/login'})
                                    }, 3000);

                                } else {
                                    _this.$message({
                                        showClose: true,
                                        message: data.message,
                                        type: 'error'
                                    })
                                }

                            }).catch(function (error) {
                                console.log(error);
                                _this.$message({
                                    showClose: true,
                                    message: error.message,
                                    type: 'error'
                                })
                            })

                        }
                        else {
                            _this.$message({
                                showClose: true,
                                message: '请正确填写表单',
                                type: 'error'
                            })
                            return false;
                        }
                    }
                );

            },

            resetForm(formName) {
                this.$refs[formName].resetFields();
            }

        },

    }

</script>

<style scoped>
    .form {
        margin-top: 1%;
        border: 1px solid;
        padding: 20px 20px 20px 0px;
        background: #fff;
        border-radius: 5px;
    }

    #background {
        display: table;
        width: 100%;
    @height: 100 %;
        padding: 0px 0;
        text-align: center;
        /*color: #fff ;*/
        background: url('../../image/background2.jpg') center;
        background-color: #000;
        background-size: cover;
        background-attachment: fixed;
        background-repeat: repeat;
        /*position: fixed;*/
    }


</style>
