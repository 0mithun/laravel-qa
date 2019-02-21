<template>
    <div class="row justify-content-center mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Your Answer</h3>
                        <hr>
                        <form @submit.prevent="create">
                            <div class="form-group">
                                <label for="body" class="control-lebel">Answers</label>
                                <textarea name="body" id="body" cols="30" required rows="10" v-model="body" class="form-control"></textarea>                          
                            </div>
                            <div class="form-group">
                                <button type="submit" :disabled="isInvalid" class="btn btn-outline-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        props: ['questionId'],
        methods:{
            create(){
                axios.post(`/questions/${this.questionId}/answers`,{
                    body:this.body
                }).catch(error=>{
                    this.$toast.error(error.response.data.message,"Error")
                })
                .then(({data})=>{
                    this.$toast.success(data.message,"Success");
                    this.body = '';
                    this.$emit('created', data.answer);
                });
            }
        },
        data(){
            return{
                body: '',
            }
        },
        computed:{
            isInvalid(){
                return !this.signedIn || this.body.length < 10;
            }
        }
    }
</script>