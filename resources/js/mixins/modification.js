export default{
    data(){
        return {editing:false}
    },
    methods: {
        edit(){
            this.setEditCache();
            this.editing = true;
        },
        cancel(){
            this.restoreFromCache();
            this.body = this.beforeEditCache.body;
            this.title= this.beforeEditCache.title;
            this.editing = false;
        },
        setEditCache(){},
        restoreFromCache(){},
        update(){
            axios.put(this.endpoint,this.payload()).catch(({response})=>{
                this.$toast.error(response.data.message,"Error",{
                    timeout:3000
                })
            }).then(({data})=>{
                this.bodyHtml = data.body_html;
                this.title = data.title;
                this.$toast.success(data.message,"Success",{timeout:3000});
                this.editing=false;
            });
        },
        payload(){

        },
        destroy(){
            if(confirm('Are you sure?')){
                this.delete();
            }
        },
        delete(){
            
        }
    }
}