<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>{{ post.title }}</h2>
                <div class="text-secondary">
                    <router-link to="abc">{{ post.subject.name }}</router-link> &middot;
                    
                    {{ post.published }} by {{ post.author }}
                </div>
                <hr>
                <div class="mt-3">{{ post.body }}</div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        data() {
            return {
                post: {
                    subject: []
                }
            }
        },
        mounted() {
            this.fetchPost();
        },

        methods: {
            request(key) {
                return this.$route.params[key];
            },
        
            async fetchPost() {
                let response = await axios.get(`api/posts/${this.request('subjectSlug')}/${this.request('postSlug')}`)
                this.post = response.data.data
            }
        }
}
</script>

<style scoped>

</style>