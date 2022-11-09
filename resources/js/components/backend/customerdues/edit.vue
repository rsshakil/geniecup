<template>
   
    <div class="main-content-container container-fluid" style="padding-left:30px;">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <!-- <span class="text-uppercase page-subtitle">Overview</span> -->
                <!-- <h3 class="page-title">Product Purchase</h3> -->
            </div>
        </div>
        <!-- End Page Header -->
        <!-- Default Light Table -->
        
            <div class="row" id="printArea" v-can="['Admin_view']">
           
                         <div class="col-md-12">
                          <p style="text-align:center;margin-bottom: 0;">Name:{{clientInfo.full_name}}</p>
                          <Address style="text-align:center;margin-bottom: 0;">Address:{{clientInfo.address1}}</Address>
                          <Address style="text-align:center;margin-bottom: 0;">Phone:{{clientInfo.phone}}</Address>
                        </div>
                        
                   <div class="clear-both"></div>
                   <div class="col-md-7">
               <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Invoice</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Paid Amount</th>
                        <th>Due Amount</th>
                        <th>Discount Amount</th>
                        <!-- <th>Action</th> -->
                    </tr>
                    </thead>
                    <tbody>
                     <tr v-for="(product, i) in product_list_arr" :key="i">
                        <td style="vertical-align:middle">{{(i+1)}}</td>
                        <td style="vertical-align:middle"><a :href="BASE_URL+'admin/sell/'+product.sell_id">{{product.invoice_no}}</a></td>
                        <td style="vertical-align:middle;text-align: right;">{{product.total_quantity}}</td>
                        <td style="vertical-align:middle;text-align: right;">৳{{product.total_amount}}</td>
                        <td style="vertical-align:middle;text-align: right;">৳{{product.total_paid_amount}}</td>
                        <td style="vertical-align:middle;text-align: right;">৳{{product.total_due_amount}}</td>
                        <td style="vertical-align:middle;text-align: right;">৳{{product.total_discount_amount}}</td>
                        
                    </tr>
                    <tr>
                        <td colspan="6"></td>
                        <td style="text-align: right;">৳{{totalDueAmount}}</td>
                    </tr>
                    </tbody>
               </table>
               </div>
               <div class="col-md-5">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Receive Date</th>
                        <th>Anount</th>
                    </tr>
                    </thead>
                    <tbody>
                     <tr v-for="(product, i) in receive_list_arr" :key="i">
                        <td style="vertical-align:middle">{{(i+1)}}</td>
                        <td style="vertical-align:middle">{{new Date(product.created_at).toLocaleDateString()}}</td>
                        <td style="vertical-align:middle;text-align: right;">৳{{product.amount}}</td>
                    </tr>
                    <tr><td colspan="3" style="vertical-align:middle;text-align: right;">৳{{totalReceiveAmount}}</td></tr>
                    </tbody>
               </table>
               </div>
            </div>
            <div class="col-md-12">
              <router-link to="/customerdues" class="btn btn-primary">Back</router-link>
            </div>
    
    
    
        </div>
    </template>
    <style>
      tbody tr td{vertical-align: middle;}
    </style>
    <script>
    import mixin from '../Mixin/mixin';
    import { Printd } from 'printd';
    
    
    export default {
         mixins:[mixin],
      data() {
        return {
          clientInfo:{},
          inputData:{
            user_id:'',
            client_id:'',
            contact_id: '',
            product_id:'',
          },
          contact_list:[],
          
        
           product_list_arr:[],
           receive_list_arr:[],
           product_list_arr_select:[],
           search_by:{
             adm_user_id:this.global_user_id,
           },
        };
      },
      methods: {
       
    printDiv(){
      this.$htmlToPaper('printArea');
    },
        
        getDetails(id){
          var post_data = {
            client_id: Globals.user_info_client_id,
            customer_id:id
          };
          axios.post(this.BASE_URL+"api/customerhistory",post_data)
            .then(({ data }) => {
                this.product_list_arr = data.invoice_list;
                this.receive_list_arr = data.receive_list;
                this.clientInfo = data.clientInfo;
            })
            .catch(() => {
              console.log("Error...");
            });
        },
        
      },
    
      created() {
         this.generalApi = 'customerdues'
        this.backUrl = '/customerdues'
        console.log(this.$route.params.id);
        this.getDetails(this.$route.params.id);
    
      },
      computed: {
    
        
        totalDueAmount: function () {
           return this.product_list_arr.reduce((acc, val) => {
               return acc + parseInt(val.total_due_amount);
             }, 0);
        },
        totalReceiveAmount: function () {
           return this.receive_list_arr.reduce((acc, val) => {
               return acc + parseInt(val.amount);
             }, 0);
        },
    
      },
      mounted() {
        console.log("product page loaded");
      }
    };
    </script>