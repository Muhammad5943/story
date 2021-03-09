<template>
    <div class="container">
        <h4>{{ subject.name }}</h4>
        <hr>
        <post-block :endpoint="`api/posts/subjects/${$route.params.subjectSlug}`" />
    </div>
</template>

<script>    
    import PostBlock from '@/components/posts/Block.vue'
    import axios from 'axios'
    
    export default {
        components: {
            PostBlock
        },

        data() {
            return {
                subject: []
            }
        },

        mounted() {
            this.fetchSubject();
        },

        methods: {
            async fetchSubject() {
                let response = await axios.get(`api/posts/subjects/${this.$route.params.subjectSlug}`)
                this.subject = response.data.subject
                // console.log(this.subject);
            }
        },
    };
</script>
