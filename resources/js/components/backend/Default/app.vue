
<template>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 p-0">
            <navbar :app="this"></navbar>
        </div>
        <div class="col-md-2 px-0">
            <sidebar :app="this"></sidebar>
        </div>
        <div class="col-md-10">
            <router-view/>
        </div>
        <!-- <spinner v-if="loading"></spinner>
        <div v-else-if="initiated"></div> -->
        <div class="col-md-12" style="margin-top:70px; padding:0px;">
            <projectfooter :app="this"></projectfooter>
        </div>
        
        
    </div>
</div>
</template>

<script>
import navbar from './navbar'
import sidebar from './side_bar'
import projectfooter from './project_footer'
export default {
name:'app',
components:{
navbar,
sidebar,
projectfooter,
},
data(){
    return{
        user:null,
        loading:false,
        initiated:false,
        BASE_URL:Globals.base_url,
        req: axios.create({
            baseUrl:Globals.base_url
        })
    }
},
methods:{
    changePasswordModal(user_id,user_name){
        this.init_user();
        // this.fieldsEmpty();
        // this.password_modal_title='Change the password for '+user_name;
        this.passwordModalShow=true;
        this.user_update_id=user_id;
    },
    init_user(){
        this.loading=true;
       axios.post(this.BASE_URL+'user').then(response=>{
            console.log(response.data);
          
            this.user=response.data;
            this.loading=false;
            this.initiated=true;
           
        }).catch(function (error) {
           
             window.location.href=Globals.base_url+'login';
    console.log(error);
  })
    },
},
created(){
    this.init_user();
    console.log(Globals.user_info_id);
    console.log(Globals.user_info_client_id);
    console.log("app.vue loaded");
    console.log("admin");
}
}
</script>