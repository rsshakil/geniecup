<template>
    <div>
        <form class="form" @submit.prevent="processData()">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ cardTitle }}</h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                       <!-- <multiselect v-model="inputData.contact_id" :options="contact_list"
                            label="full_name" track-by="contact_id" :searchable="true" :multiple="false"
                            :close-on-select="true" :clear-on-select="false" :preserve-search="true"
                            open-direction="bottom" placeholder="Pick a Customer/Party">
                        </multiselect> -->
                        <v-select 
                                            :options="customerList" 
                                            :reduce="eventCategory => eventCategory.contact_id" 
                                            label="full_name" 
                                            v-model="inputData.contact_id" 
                                            placeholder="Select Contact"></v-select> 
                                            <input type="hidden" name="contact_id" v-model="inputData.contact_id">
                                    </div>
                                </div><!--col-6 end-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Payment Type</label>
                                        <select class="form-control" v-model="inputData.type">
                                            <option value="1">Receive</option>
                                            <option value="2">Payments</option>
                                        </select>
                                    </div>
                                </div><!--col-6 end-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Bank Name</label>
                                        <input type="hidden" name="client_id" v-model="inputData.client_id"/>
                                        <input type="text" name="bank_name" class="form-control" v-model="inputData.bank_name" placeholder="Bank Name">
                                    </div>
                                </div><!--col-6 end-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Checque no</label>
                                        <input type="text" name="checque_no" class="form-control" v-model="inputData.checque_no" placeholder="Checque No">
                                    </div>
                                </div><!--col-6 end-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Amount</label>
                                        <input type="number" name="amount" class="form-control" v-model="inputData.amount" placeholder="Amount">
                                    </div>
                                </div><!--col-6 end-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Date</label>
                                        <!-- <input type="date" class="form-controll" @change="changeDateformat" placeholder="Date"> -->
                                        <datetime format="YYYY-MM-DD" width="100%" v-model="inputData.manual_at"></datetime>
                                    </div>
                                </div><!--col-6 end-->

                            </div>
                        </div>
                        <div class="card-footer">
                           <FormButton :isEdit="isEdit" :backUrl="backUrl"></FormButton>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import mixin from '../Mixin/mixin';
    import datetime from 'vuejs-datetimepicker';
    export default {
        mixins: [mixin],
        components: { datetime },
        data(){
            return {
               smList:[],
                contact_list:[],
                smOptions:[
                    {role:'Asst.SM'},
                    {role:'RSM'},
                    {role:'Sr.RSM'},
                ],
                regions:[],
            }
        },
        created() {
           
            this.generalApi = 'payments'
            this.backUrl = '/payments'
            this.inputData.client_id = Globals.user_info_client_id
            
            console.log(this.inputData);
            this.loadContactData();
            this.cardTitle = this.isEdit ? 'Edit Category' : 'Add Category'
           
        },

        methods:{
            changeDateformat(){
                var date = this.inputData.manual_at;
                if(date!=''){
                    let d = date.split("/");
                    let ddd = d[2]+'-'+d[1]+'-'+d[0];
                    console.log('ddd',ddd);
                    this.inputData.manual_at = ddd;
                }
                },
        },


    }

</script>