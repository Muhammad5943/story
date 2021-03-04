<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form action="#" method="post" @submit.prevent="store">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" v-model="form.email" id="email" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" v-model="form.password" id="password" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapActions } from 'vuex'
    
    export default {
        data() {
            return {
                form : {
                    email: '',
                    password: ''
                }
            }
        },

        methods: {
            ...mapActions({
                login: 'auth/login'
            }),

            async store () {
                await this.login(this.form)
                this.$router.replace({ name: 'Home' })
                /* "http://localhost:8000/" defined in main.js */
                // await axios.get(/* http://localhost:8000/ */'sanctum/csrf-cookie')
                // await axios.post(/* http://localhost:8000/ */'login', this.form)

                // let user = await axios.get(/* http://localhost:8000/ */'api/user')
                // console.log(user.data);
            }
        },

        mounted() {
            document.title = "Login"
        }
    }
</script>

<style scoped>

</style>