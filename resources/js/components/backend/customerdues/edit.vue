<template>            <!-- /.card-header -->
    <TableContent class="py-5" v-if="typeof(dataList) == 'object'" :searchForm="searchForm" :sortingForm="sortingForm" :isAddItem="isAddItem" :isEditBtn="isEditBtn" :isDelBtn="isDelBtn" :isActionBtn="isActionBtn" :cardTitle="cardTitle" :columnsHead="columnsHead" :columnsBody="columnsBody" :dataList="dataList" :showEditForm="showEditForm" :deleteItem="deleteItem" :getDataList="getDataList" :excelFields="excelFields" :excelTitle="excelTitle" :isDownload="isDownload" :isSearchBox="isSearchBox" route="admin"></TableContent>
</template>
<script>
import mixin from '../Mixin/mixin';

export default {
    mixins:[mixin],

    created(){
        this.generalApi = "customerhistory";
        this.cardTitle ="Customer history"
    
        this.isAddItem = true;
this.isEditBtn = false;
this.isDelBtn = false;
        this.columnsHead.push('Sn','Name','Phone','Invoice Date','Paid amount', 'Due Amount','Receive amount','Receive date','Action')
        this.columnsBody.push('full_name','phone','invoice_date','paid_amount','due_amount','receive_amount','receive_date')  
    }
}
</script>