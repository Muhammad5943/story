<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-success" role="alert" v-if="message">
                    {{ message }}
                </div>
                <div class="card">
                    <div class="card-header">Edit Post</div>
                    <form action="#" method="POST" @submit.prevent="update">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" id="title" v-model="post.title" class="form-control" placeholder="Title" aria-describedby="helpId">
                                <div class="text-danger mt-2" v-if="errors.title">
                                    {{ errors.title[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <select class="form-control" id="subject" @change="selectedSubject">
                                    <option 
                                        v-for="subject in subjects" 
                                        :key="subject.id" 
                                        :selected="subject.id == post.subject.id"
                                        :value="subject.id"
                                    >
                                    {{ subject.name }}
                                    </option>
                                </select>
                                <div class="text-danger mt-2" v-if="errors.subject">
                                    {{ errors.subject[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea class="form-control" v-model="post.body" :key="post.id" id="body" rows="5" placeholder="Wtite your story here . . . "></textarea>
                                <div class="text-danger mt-2" v-if="errors.body">
                                    {{ errors.body[0] }}
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
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
                    subject: []
                },
                subjects: [],
                message: '',
                errors: [],
                selected: ''
            }
        },

        mounted() {
            this.fetchSubjects(),
            this.fetchPost()
        },

        methods: {
            selectedSubject(e) {
                this.selected = e.target.value;
            },

            request(key) {
                return this.$route.params[key];
            },

            async update() {
                this.post['subject'] = this.selected || this.post.subject.id
                let response = await axios.put(`api/posts/${this.request('postSlug')}/edit`, this.post)
                this.message = response.data.success
            },
        
            async fetchPost() {
                let response = await axios.get(`api/posts/${this.request('subjectSlug')}/${this.request('postSlug')}`)
                this.post = response.data.data
                // console.log(this.post);
            },

            async store() {
                try {
                    let response = await axios.post('api/posts/create', this.post)
                    this.message = response.data.success
                    // console.log(this.message);
                    this.errors = [],
                    this.post.title = '',
                    this.post.body = '',
                    this.post.subject = ''
                } catch (e) {
                    this.errors = e.response.data.errors;
                    // console.log(this.errors);
                }
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