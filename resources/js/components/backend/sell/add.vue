<template>
   
<div class="main-content-container container-fluid" style="padding-left:30px;">
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <!-- <span class="text-uppercase page-subtitle">Overview</span> -->
            <h3 class="page-title">Add Sales</h3>
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Default Light Table -->
    
        <div class="row" v-can="['Admin_view']">
           
                    <div class="col-md-4 col-lg-4">
                        <multiselect v-model="inputData.contact_id" :options="customerList"
                            label="full_name" track-by="contact_id" :searchable="true" :multiple="false"
                            :close-on-select="true" :clear-on-select="false" :preserve-search="true"
                            open-direction="bottom" placeholder="Pick a Customer/Party">
                        </multiselect>
                    </div>
                    <div class="col-md-1 col-lg-1">
                      <button class="btn btn-info" @click="addSupplier()"><b-icon icon="person-plus-fill" font-scale="2.2"></b-icon></button>
                    </div>
                    <div class="col-md-3 col-lg-3">
                    <datetime format="YYYY-MM-DD" width="100%" v-model="inputData.manual_at"></datetime>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <multiselect v-model="inputData.product_id" :options="product_list_arr_select"
                            label="product_name" @select="getProductByid($event)" track-by="product_id" :searchable="true" :multiple="false"
                            :close-on-select="true" :clear-on-select="false" :preserve-search="true"
                            open-direction="bottom" placeholder="Pick a product">
                        </multiselect>
                    </div>
               <div class="clear-both"></div>
               <div class="col-md-12">
           <table class="table table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th style="width:200px;">Image</th>
                    <th>Name</th>
                    <th>Caegory</th>
                    <th>Selling price</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                 <tr v-for="(product, i) in product_list_arr" :key="i">
                    <td>{{(i+1)}}</td>
                    <td>
                      <img v-if="product.image!=null" class="product_image_list" :src="BASE_URL+'/public/images/products/'+product.image"/>
                      <img v-else class="product_image_list" :src="BASE_URL+'/public/images/products/no-product-image.png'"/>
                      </td>
                    <td>{{product.product_name}}</td>
                    <td>{{product.category_name}}</td>
                    <td><input type="number" class="form-controll" @input="updatePaidAmount" v-model="product.selling_price"></td>
                    <td><input type="number" class="form-controll" @input="updatePaidAmount" v-model="product.item_quantity"></td>
                    
                    <td>{{product.selling_price*product.item_quantity}}</td>
                    <td><b-form-button name="removeProductAttr" @click="removeproductattr(i)" variant="danger"
                                class="custom_remove_product_attr">-</b-form-button></td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                    <td>{{totalQuantity}}</td>
                    <td>{{totalPrice}}</td>
                    <td></td>
                </tr>
                 <tr>
                    <td colspan="6" style="text-align: right;">Total Discount Amount</td>
                    <td><input type="number" @input="updatePaidAmount" class="form-controll" v-model="inputData.total_discount_amount" placeholder="DisCount Amount"></td>
                    
                    <td></td>
                </tr>
                 <tr>
                    <td colspan="6" style="text-align: right;">Total Paid Amount</td>
                    <td><input type="number" @input="updatePaidAmount" class="form-controll" v-model="inputData.total_paid_amount" placeholder="Paid Amount"></td>
                    
                    <td></td>
                </tr>
                 <tr>
                                        <td colspan="6" style="text-align: right;">Total Due Amount</td>
                    <td>{{totalPrice-inputData.total_paid_amount-inputData.total_discount_amount}}</td>
                    <td></td>
                </tr>
                </tbody>
           </table>
           </div>
        </div>
        <div class="col-md-12">
          <router-link to="/purchase" class="btn btn-primary" style="width:49%;float:left;margin-right:1%;">Back</router-link>
          <button class="btn btn-primary" @click="addStock" style="width:50%;float:left">Add Sales</button>
        </div>
 <div class="clearboth"></div>
        <br>
        <br>
        <div class="col-md-12">
          
          <div class="row">
            <div class="col-2" v-for="(item, index) in product_list_arr_select" :key="index">
                <div class="image_area">
                  <img v-if="item.prodcut_image!=null" class="img-responsive" @click="addProductByid(item)" :src="BASE_URL+'/public/images/products/'+item.prodcut_image"/>
                  <img v-else class="img-responsive" @click="addProductByid(item)" :src="BASE_URL+'/public/images/products/no-product-image.png'"/>

                </div>
                <div class="product_info_area">
                  <h6>{{item.product_name | truncate(50)}}<span style="color:red">({{item.stock_quantity}})</span></h6>
                </div>
            </div>
          </div>
        </div>


        <b-modal id="modal-lg" size="lg" :hide-backdrop="true" title="Create Customer" ok-title="Save" @ok.prevent="save_user()" v-model="userModalShow">
        <form method="POST" id="user_create">
          <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="hidden" name="client_id" v-model="customerData.client_id"/>
                                        <input type="text" name="full_name" class="form-control" v-model="customerData.full_name" placeholder="Name">
                                    </div>
                                </div><!--col-6 end-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Phone Number</label>
                                        <input type="text" name="phone" class="form-control" v-model="customerData.phone" placeholder="Phone number">
                                        <input type="hidden" name="mobile" class="form-control" v-model="customerData.phone" placeholder="Phone number">
                                    </div>
                                </div><!--col-6 end-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="text" name="email" class="form-control" v-model="customerData.email" placeholder="Email">
                                    </div>
                                </div><!--col-6 end-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Address</label>
                                        <input type="text" name="address1" class="form-control" v-model="customerData.address1" placeholder="Addresss">
                                    </div>
                                </div><!--col-6 end-->

                            </div>
                </form>
    </b-modal>

    </div>
</template>
<script>
import mixin from '../Mixin/mixin';
import datetime from 'vuejs-datetimepicker';

export default {
     mixins:[mixin],
      components: { datetime },
  data() {
    return {
      userModalShow:false,
      customerData:{
        client_id:Globals.user_info_client_id,
        full_name:'',
        phone:'',
        email:'',
        address1:''
      },
      inputData:{
        user_id:'',
        total_paid_amount:0,
        total_discount_amount:0,
        total_due_amount:0,
        manual_at:'',
        client_id:'',
        contact_id: '',
        product_id:'',
      },
      contact_list:[],
      
    
       product_list_arr:[],
       product_list_arr_select:[],
       search_by:{
         adm_user_id:this.global_user_id,
       },
    };
  },
  methods: {
    addSupplier(){
      console.log('add a new sup');
      this.userModalShow=true;
    },
updatePaidAmount(){
  
  if(this.inputData.total_paid_amount>this.totalPrice){
    this.toastMessage('error', 'You can not enter Over Price');
    this.inputData.total_paid_amount=0;
    this.inputData.total_due_amount=parseInt(this.totalPrice)-parseInt(this.inputData.total_discount_amount);
  }else{
    console.log('amount changes',this.inputData.total_discount_amount);
    this.inputData.total_due_amount=parseInt(this.totalPrice)-parseInt(this.inputData.total_paid_amount)-parseInt(this.inputData.total_discount_amount);
  }
},
changeDateformat(){
  var date = this.inputData.manual_at;
  if(date!=''){
    let d = date.split("/");
    let ddd = d[2]+'-'+d[1]+'-'+d[0];
    this.inputData.manual_at = ddd;
  }
},
getCurDate(){
                var currentDate = new Date();
                console.log(currentDate);
    
                var formatted_date = new Date().toJSON().slice(0,10).replace(/-/g,'-');
                console.log(formatted_date);
                this.inputData.manual_at = formatted_date;
               },
addStock(){
  var post_data = {
        client_id: Globals.user_info_client_id,
        contact_id: this.inputData.contact_id.contact_id,
        total_paid_amount: this.inputData.total_paid_amount,
        total_due_amount: this.inputData.total_due_amount,
        total_discount_amount: this.inputData.total_discount_amount,
        total_amount: this.totalPrice,
        total_quantity: this.totalQuantity,
        product_items: this.product_list_arr,
        manual_at:this.inputData.manual_at
      };
      console.log(post_data);
      
      axios.post(this.BASE_URL+"api/sell",post_data)
        .then(({ data }) => {
          if(data.result==200){
                         Swal.fire({
                icon: 'success',
                title: 'Sales',
                text: data.message
            });
             this.product_list_arr=[];
             this.inputData.total_paid_amount=0;
          }else{
 Swal.fire({
                icon: 'error',
                title: 'Sales',
                text: data.message
            })
          }
           
            console.log(this.product_list_arr);
        })
        .catch((data) => {
          console.log("Error...");
          console.log(data);
          Swal.fire({
                icon: 'error',
                title: 'Purchase',
                text: data.message
            })
        });
},
removeproductattr: function (index) {
    Vue.delete(this.product_list_arr, index);
},
  getProductByid(e){
    console.log(e.product_id);
    var post_data = {
        client_id: Globals.user_info_client_id,
        product_id: e.product_id,
      };
      axios.post(this.BASE_URL+"api/get_product_by_id",post_data)
        .then(({ data }) => {
          var index = this.product_list_arr.findIndex(x => x.product_id==e.product_id); 
            
            if(index === -1){ this.product_list_arr.push(data.products);}
            console.log(this.product_list_arr);
        })
        .catch(() => {
          console.log("Error...");
        });
  },
  addProductByid(e){
    console.log(e.product_id);
    var post_data = {
        client_id: Globals.user_info_client_id,
        product_id: e.product_id,
      };
      axios.post(this.BASE_URL+"api/get_product_by_id",post_data)
        .then(({ data }) => {
          var index = this.product_list_arr.findIndex(x => x.product_id==e.product_id); 
            
            if(index === -1){ this.product_list_arr.push(data.products);}
            console.log(this.product_list_arr);
        })
        .catch(() => {
          console.log("Error...");
        });
  },

  
    //get Table data
    loadProductDataselect_2() {
      var post_data = {
        client_id: Globals.user_info_client_id,
        type: 2,
      };
      axios.post(this.BASE_URL+"api/get_all_products_name_id",post_data)
        .then(({ data }) => {
            this.product_list_arr_select = data.products;
        })
        .catch(() => {
          console.log("Error...");
        });
    },
    

    save_user() {
      
      axios.post(this.BASE_URL+"api/customerdues",this.customerData)
        .then(({ data }) => {
          this.userModalShow=false;
          this.generalSettings();
        })
        .catch(() => {
          console.log("Error...");
        });
    },
    
  },

  created() {
    this.loadProductDataselect_2();
    getCurDate();
    this.inputData.client_id=Globals.user_info_client_id,
    this.customerData.client_id=Globals.user_info_client_id,
    console.log('url');
    console.log(this.$route);
     this.generalApi = 'sell'
            this.backUrl = '/sell'
            this.inputData.client_id = Globals.user_info_client_id
  },
  computed: {

    totalQuantity: function () {
       return this.product_list_arr.reduce((acc, val) => {
           return acc + parseInt(val.item_quantity);
         }, 0);
    },
    totalPrice: function () {
       return this.product_list_arr.reduce((acc, val) => {
           return acc + parseInt(val.selling_price*val.item_quantity);
         }, 0);
    },

  },
  mounted() {
    console.log("product page loaded");
  }
};
</script>