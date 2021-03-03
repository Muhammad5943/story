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
    import axios from 'axios'
    
    export default {
        data() {
            return {
                form : {
                    email: 'aji@gmail.com',
                    password: '123456789'
                }
            }
        },

        methods: {
            async store () {
                await axios.get('http://localhost:8000/sanctum/csrf-cookie')
                await axios.post('http://localhost:8000/login', this.form)

                let user = await axios.get('http://localhost:8000/api/user')
                console.log(user.data);
            }
        },
    }
</script>

<style scoped>

</style>