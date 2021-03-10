<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-success" role="alert" v-if="message">
                    {{ message }}
                </div>
                <div class="card">
                    <div class="card-header">New Post</div>
                    <form action="#" method="POST" @submit.prevent="store">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" id="title" v-model="post.title" class="form-control" placeholder="Title" aria-describedby="helpId">
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <select class="form-control" id="subject" v-model="post.subject">
                                    <option value="" selected>Choose Subject</option>
                                    <option v-for="subject in subjects" :key="subject.id" :value="subject.id">{{ subject.name }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea class="form-control" v-model="post.body" :key="post.id" id="body" rows="5" placeholder="Wtite your stpry here . . . "></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        data() {
            return {
                post: {
                    title: '',
                    body: '',
                    subject: ''
                },

                subjects: [],
                message: ''
            }
        },

        mounted() {
            this.fetchSubjects()
        },

        methods: {
            async store() {
                let response = await axios.post('api/posts/create', this.post)
                this.message = response.data.success
                console.log(this.message);
            },

            async fetchSubjects() {
                let response = await axios.get('api/posts/subjects')
                this.subjects = response.data
            }
        },
    }
</script>

<style>

</style>