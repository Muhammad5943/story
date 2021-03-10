<template>
    <div class="row">
        <div class="col-md-6">
            <!-- <div class="card mb-3" v-for="post in posts" :key="post.id"> -->
            <!-- hasMorePagesFunction -->
            <div class="card mb-3" v-for="post in posts.data" :key="post.id">
                <div class="card-header d-flex align-item-center justify-content-between">
                    {{ post.title }}
                    <template v-if="authCheck && post.user_id == user.id">
                        <router-link :to="`/posts/${post.subject.slug}/${post.slug}/edit`">Edit</router-link>
                    </template>
                </div>
                <div class="card-body">
                    {{ post.body }}

                    <div class="my-3">
                        <router-link :to="`/posts/${post.subject.slug}/${post.slug}`">Read more!</router-link>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="media align-items-center">
                            <img class="rounded-circle mr-3" :src="post.gravatar" width="40">
                            <div class="media">
                                {{post.author.name}}
                            </div>
                        </div>

                        <div class="text-secondary">
                            {{post.publish}}
                        </div>
                    </div>
                </div>
            </div>
            <button v-if="posts.hasMorePages" class="btn btn-primary" @click.prevent="loadMore">
                <template v-if="loading">
                    Please Wait ...
                </template>
                <template v-else>
                    Load More
                </template>
            </button>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import { mapGetters } from 'vuex'
    
    export default {
        props: ['endpoint'],

        data () {
            return {
                posts: [],
                perPage: 30,
                loading: false
            }
        },

        computed: {
            ...mapGetters({
                authCheck: 'auth/check',
                user: 'auth/user'
            })
        },

        mounted() {
            this.fetchPosts();
        },

        methods: {
            async fetchPosts() {
                let response = await axios.get(this.endpoint, {
                    params: { perPage: this.perPage }
                })
                this.loading = false

                // this.posts = response.data.data

                /* hasMorePages stop */
                this.posts = response.data
            },

            loadMore() {
                this.perPage += 10
                setTimeout(() => {
                    this.fetchPosts()
                }, 1000);
                this.loading = true
            }
        }
    }
</script>

<style scoped>

</style>