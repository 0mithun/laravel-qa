<template>
    <div class="media post">
                        
            <vote :model="answer" name="answer"></vote>
        
            <div class="media-body">
                <div  id="media-body-form">
                    <form v-if="editing" @submit.prevent="update">
                        <div class="form-gorup">
                            <textarea rows="10" v-model="body" class="form-control" requred></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-outline-primary btn-sm" :disabled="isInvalid">Update</button>
                            <button type="button" @click="cancel" class="btn btn-outline-danger btn-sm">Cancel</button>
                        </div>
                    </form>
                </div> 
                <div v-if="!editing">
                    <div v-html="bodyHtml"></div>
                    <div class="row">
                        <div class="col-4">
                            <div class="ml-auto">
                                  
                                <a v-if="authorize('modify', answer)" @click.prevent="edit" class="btn btn-sm btn-outline-info">Edit</a>
                                <button v-if="authorize('modify', answer)" @click="destroy" class="btn btn-sm btn-outline-danger">Delete</button>

                            </div>
                        </div>
                        <div class="col-4"></div>
                        <div class="col-4">
                            <user-info :model="answer" label="Answered"></user-info>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    export default{
        props: ['answer'],
        data(){
            return {
                editing: false,
                body: this.answer.body,
                bodyHtml: this.answer.body_html,
                id: this.answer.id,
                questionId: this.answer.question_id,
                beforeEditCache: null
                
            }
        },
        methods: {
            edit(){
                this.beforeEditCache = this.body;
                this.editing = true;

            },
            cancel(){
                this.body = this.beforeEditCache;
                this.editing = false
            },
            
            update(){
                axios.patch(this.endpoint,{
                    body: this.body
                }).then(res =>{
                    this.editing=false
                    this.bodyHtml = res.data.body_html
                    this.$toast.success(res.data.message, 'Success', {timeout:3000});
                    // alert(res.data.message)
                }).catch(err =>{
                    this.$toast.success(res.data.message, 'Error', {timeout:3000});
                    // alert(err.response.data.message);
                });
            },
            destroy(){
                if(confirm('Are you sure?')){
                    axios.delete(this.endpoint)
                    .then(res=>{
                        $(this.$el).fadeOut(500, ()=>{
                            this.$toast.success(res.data.message, 'Success', {timeout:3000});
                            // alert(res.data.message);
                        });
                    });
                }
            }
            
        },
        computed:{
            isInvalid(){
                return this.body.length <10;
            },
            endpoint(){
                return `/questions/${this.questionId}/answers/${this.id}`;
            } 
        }
    }
</script>