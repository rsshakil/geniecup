
<script>
var Globals = <?php
/*
if(Auth::User()->id){
    $user_id = Auth::User()->id;
}else{
    $user_id = 0;
}
*/

echo json_encode(array(
    'local' =>\App::getLocale(),
    'base_url' =>\Config::get('app.url'),
    'user_info_id' =>@\Auth::user()->id,
    'user_info_client_id' =>@\Auth::user()->id,
    'welcome_text' =>__('messages.welcome'),
    'role_management' =>__('messages.role_management'),
    'permission_management' =>__('messages.permission_management'),
    'role_permission_menu' =>__('messages.role_permission_menu'),
    'assign_role' =>__('messages.assign_role'),
    'user_role' =>__('messages.user_role'),
    'heading' =>__('messages.heading'),
    'dashboard_text' =>__('messages.dashboard_text'),
    'manage_role' =>__('messages.manage_role'),
    'manage_permission' =>__('messages.manage_permission'),
    'assign_permission_to_role' =>__('messages.assign_permission_to_role'),
    'assign_role_to_user' =>__('messages.assign_role_to_user'),
    'assign_permission_to_user' =>__('messages.assign_permission_to_user'),
    'permission_assigned' =>__('messages.permission_assigned'),
    'manage_users' =>__('messages.manage_users'),
    'user_update' =>__('messages.user_update'),
    'email_text' =>__('messages.email_text'),
    'password_text' =>__('messages.password_text'),
    'login_text' =>__('messages.login_text'),
    'login_title' =>__('messages.login_title'),
    'remember_text' =>__('messages.remember_text'),
    'forgot_pass_text' =>__('messages.forgot_pass_text'),
    'profile_text' =>__('messages.profile_text'),
    'password_change_text' =>__('messages.password_change_text'),
    'logout_text' =>__('messages.logout_text'),
    'role_name' =>__('messages.role_name'),
    'please_role_name' =>__('messages.please_role_name'),
    'desc' =>__('messages.desc'),
    'add' =>__('messages.add'),
    'update' =>__('messages.update'),
    'are_you_sure' =>__('messages.are_you_sure'),
    'role_desc' =>__('messages.role_desc'),
    'role_list' =>__('messages.role_list'),
    'role_permission' =>__('messages.role_permission'),
    'role_action' =>__('messages.role_action'),
    'role_id' =>__('messages.role_id'),
    'user_id' =>__('messages.user_id'),
    'check_internet_connection' =>__('messages.check_internet_connection'),
    'all_fields_required' =>__('messages.all_fields_required'),
    'want_delete' =>__('messages.want_delete'),
    'role_delete' =>__('messages.role_delete'),
    'permission_name' =>__('messages.permission_name'),
    'please_permission_name' =>__('messages.please_permission_name'),
    'permission_desc' =>__('messages.permission_desc'),
    'permission_list' =>__('messages.permission_list'),
    'permission_action' =>__('messages.permission_action'),
    'permission_id' =>__('messages.permission_id'),
    'permission_view' =>__('messages.permission_view'),
    'previous_permission' =>__('messages.previous_permission'),
    'permission_setup_completed' =>__('messages.permission_setup_completed'),
    'permission_deleted' =>__('messages.permission_deleted'),
    'permission_updated' =>__('messages.permission_updated'),
    'permission_not_updated' =>__('messages.permission_not_updated'),
    'no_selected_user' =>__('messages.no_selected_user'),
    'no_pemission_left' =>__('messages.no_pemission_left'),
    'select_permission' =>__('messages.select_permission'),
    'user_no_select' =>__('messages.user_no_select'),
    'select_role' =>__('messages.select_role'),
    'permission_name_blank' =>__('messages.permission_name_blank'),
    'permission_name_duplicate' =>__('messages.permission_name_duplicate'),
    'permission_already_exists' =>__('messages.permission_already_exists'),
    'permission_not_deleted' =>__('messages.permission_not_deleted'),
    'user_name' =>__('messages.user_name'),
    'select_user' =>__('messages.select_user'),
    'role_no_select' =>__('messages.role_no_select'),
    'role_setup_completed' =>__('messages.role_setup_completed'),
    'role_duplicated' =>__('messages.role_duplicated'),
    'role_name_required' =>__('messages.role_name_required'),
    'role_deleted' =>__('messages.role_deleted'),
    'role_not_deleted' =>__('messages.role_not_deleted'),
    'role_updated' =>__('messages.role_updated'),
    'name' =>__('messages.name'),
    'email' =>__('messages.email'),
    'create_new' =>__('messages.create_new'),
    'view' =>__('messages.view'),
    'change_password' =>__('messages.change_password'),
    'delete' =>__('messages.delete'),
    'overview' =>__('messages.overview'),
    'user_profile' =>__('messages.user_profile'),
    'profile_details' =>__('messages.profile_details'),
    'first_name' =>__('messages.first_name'),
    'last_name' =>__('messages.last_name'),
    'full_name' =>__('messages.full_name'),
    'phone_number' =>__('messages.phone_number'),
    'date_birth' =>__('messages.date_birth'),
    'profile_picture' =>__('messages.profile_picture'),
    'gender' =>__('messages.gender'),
    'male' =>__('messages.male'),
    'female' =>__('messages.female'),
    'zip' =>__('messages.zip'),
    'postal_code' =>__('messages.postal_code'),
    'add_user' =>__('messages.add_user'),
    'email_address' =>__('messages.email_address'),
    'password' =>__('messages.password'),
    'new_password' =>__('messages.new_password'),
    'confirm_password' =>__('messages.confirm_password'),
    'user_list_confirm_password' =>__('messages.user_list_confirm_password'),
    'close' =>__('messages.close'),
    'save' =>__('messages.save'),
    'image_set' =>__('messages.image_set'),
    'reset_password' =>__('messages.reset_password'),
    'send_pass_reset' =>__('messages.send_pass_reset'),
    'password_sent' =>__('messages.password_sent'),
    'choose' =>__('messages.choose'),
    'user_select' =>__('messages.user_select'),
    'password_changed' =>__('messages.password_changed'),
    'password_not_match' =>__('messages.password_not_match'),
    'password_length' =>__('messages.password_length'),
    'message' =>__('messages.message'),
    'email_exist' =>__('messages.email_exist'),
    'email_required' =>__('messages.email_required'),
    'no_permission_change_email' =>__('messages.no_permission_change_email'),
    'user_deleted' =>__('messages.user_deleted'),
    'user_created' =>__('messages.user_created'),
    'email_already_database' =>__('messages.email_already_database'),
    'fname_required' =>__('messages.fname_required'),
    'lname_required' =>__('messages.lname_required'),
    'full_name_required' =>__('messages.full_name_required'),
    'phone_required' =>__('messages.phone_required'),
    'dob_required' =>__('messages.dob_required'),
    'postal_required' =>__('messages.postal_required'),
    'select_image' =>__('messages.select_image'),
    'image_size' =>__('messages.image_size'),
    'name_length' =>__('messages.name_length'),
    'email_length' =>__('messages.email_length'),
    'user_delete' =>__('messages.user_delete'),
    'permission_delete' =>__('messages.permission_delete'),
    'role_delete_confirm' =>__('messages.role_delete_confirm'),
    'permission_delete_confirm' =>__('messages.permission_delete_confirm'),
    'user_delete_confirm' =>__('messages.user_delete_confirm'),
    'set_up' =>__('messages.set_up'),
    //product trans
    'merchant_name' =>__('products.merchant_name'),
    'product_code' =>__('products.product_code'),
    'add_new' => __('products.add_new'),
    'add_goods' => __('products.add_goods'),
    'add_service' => __('products.add_service'),
    'add_asset' => __('products.add_asset'),
    'add_stationary' => __('products.add_stationary'),
    'add_raw_metarial' => __('products.add_raw_metarial'),
    'imports' => __('products.imports'),
    
)); ?>;
</script>