<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <router-link exact class="nav-link" :to="{ name: 'home' }">
                        Home
                        <span class="sr-only">(curret)</span>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'posts.index' }">
                        Post
                        <span class="sr-only">(curret)</span>
                    </router-link>
                </li>
            </ul>

            <ul class="navbar-nav">
                <template v-if="!check">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'auth.login' }">Login</router-link>
                    </li>
                </template>
                <template v-else>
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="navbarDropdown"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            >{{ user.name }}</a
                        >
                        <div
                            class="dropdown-menu dropdown-menu-right"
                            aria-labelledby="navbarDropdown"
                        >
                            <router-link class="dropdown-item" :to="{ name: 'posts.new' }">New Story</router-link>
                            <router-link class="dropdown-item" :to="{ name: '' }">Another action</router-link>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" @click.prevent="logout">Logout</a>
                        </div>
                    </li>
                </template>
            </ul>
        </div>
    </nav>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'
    
    export default {
        computed: {
            ...mapGetters({
                check: 'auth/check',
                user: 'auth/user'
            })
        },

        mounted() {
            // console.log(this.check);
        },

        methods: {
            ...mapActions({
                signout: 'auth/signout'
            }),

            async logout() {
                await this.signout();

                this.$router.replace({ name: 'auth.login' })
            }
        }
    }
</script>