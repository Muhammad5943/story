<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3" v-for="post in posts" :key="post.id">
                    <div class="card-header">
                        {{ post.title }}
                    </div>
                    <div class="card-body">
                        {{ post.body }}

                        <div class="mt-3">
                            <router-link :to="`/posts/${post.subject.slug}/${post.slug}`">Read more!</router-link>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" @click.prevent="loadMore">Load More</button>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    
    export default {
        data () {
            return {
                posts: [],
                perPage: 4
            }
        },

        mounted() {
            this.fetchPosts();
        },

        methods: {
            async fetchPosts() {
                let response = await axios.get('api/posts', {
                    params: { perPage: this.perPage }
                })
                this.posts = response.data.data
            },

            loadMore() {
                this.perPage += 5
                this.fetchPosts()
            }
        }
    }
</script>

<style scoped>

</style>