<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form class="card-body" v-if="editing" @submit.prevent="update">
                    <div class="card-title">
                        <input type="text" class="form-control form-control-lg" v-model="title">
                    </div>
                    <div class="media">
                        <div class="media-body">
                            <div class="form-gorup">
                                <textarea rows="10" v-model="body" class="form-control" requred></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-outline-primary btn-sm" :disabled="isInvalid">Update</button>
                                <button type="button" @click="cancel" class="btn btn-outline-danger btn-sm">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card-body" v-else>
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h2>{{ title }}</h2>
                            <div class="ml-auto">
                                <a href="/questions" class="btn btn-outline-secondary">Back to all question</a>
                            </div>
                        </div>
                    </div>
                    <div class="media">
                        <vote :model="question" name="question"></vote>
                        <div class="media-body">
                            <div v-html="bodyHtml"></div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="ml-auto">
                                        <a v-if="authorize('modify', question)" @click.prevent="edit" class="btn btn-sm btn-outline-info">Edit</a>
                                        <button v-if="authorize('deleteQuestion', question)" @click="destroy" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <user-info :model="question" label="Asked"></user-info>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Vote from './Vote.vue';
    import UserInfo from './UserInfo.vue';
    import modification from '../mixins/modification'
    export default{
        props: ['question'],
        mixins: [modification],
        components:{
            Vote,
            UserInfo
        },
        data(){
            return {
                title: this.question.title,
                body: this.question.body,
                bodyHtml: this.question.body_html,
                id: this.question.id,
                beforeEditCache:{}
            }
        },
        computed:{
            isInvalid(){
                return this.body.length < 10 || this.title.length < 10;
            },
            endpoint(){
                return `/questions/${this.id}`;
            }
        },
        methods:{
            setEditCache(){
                this.beforeEditCache = {
                    body:this.body,
                    title: this.title
                };
            },
            restoreFromCache(){
                this.body = this.beforeEditCache.body;
                this.title= this.beforeEditCache.title;
            },
            payload(){
                return {
                    body: this.body,
                    title: this.title
                }
            },
            delete(){
                axios.delete(this.endpoint)
                    .then(({data})=>{
                        this.$toast.success(data.message,"Success",{timeout:2000});
                    });
                    setTimeout(()=>{
                        window.location.href = '/questions';
                    },3000);
            }
        }
    }
</script>