jQuery(document).ready(function(){
   //Hostel Student 
    jQuery("#h_student_name").autocomplete({  
        minLength: 0,
        source: "DropdownController/hostel_students/"+$("#h_student_name").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#h_student_name").val(ui.item.contactPerson);
        jQuery("#h_student_id").val(ui.item.code);
        }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
   
   
    //Change Program
   jQuery('#program-id').on('click',function(){
       
          var program_id = jQuery('#program-id').val();
          //Get Batch 
            jQuery.ajax({
                type   :'post',
                url    :'DropdownController/getBatch',
                data   :{'programId':program_id},
               success :function(result){
                   console.log(result);
                  jQuery('#batch-id').html(result);
               }
            });
   });
   
        
    //Change Batch
   jQuery('#batch-id').on('click',function(){
        var program_id = jQuery('#program-id').val();
          //Get Sub Program 
            jQuery.ajax({
                type   :'post',
                url    :'DropdownController/getSubProgram',
                data   :{'programId':program_id},
               success :function(result){
                  
                  jQuery('#sub-pro-name').html(result);
               }
            });
   });
    //Change Sub Program
   jQuery('#sub-pro-name').on('click',function(){
        var sub_program_id = jQuery('#sub-pro-name').val();
          //Get Sub Program 
            jQuery.ajax({
                type   :'post',
                url    :'DropdownController/getPaymentCategory',
                data   :{'sub_program_id':sub_program_id},
               success :function(result){
                jQuery('#payment-challan').html(result);
               }
            });
   });
    //Change Sections
   jQuery('#sub-pro-name').on('click',function(){
        var sub_pro_id = jQuery('#sub-pro-name').val();
          //Get Sub Program 
            jQuery.ajax({
                type   :'post',
                url    :'DropdownController/getSection',
                data   :{'sub_pro_id':sub_pro_id},
               success :function(result){
                  
                  jQuery('#fetch-section').html(result);
               }
            });
   });
jQuery("#add_new_head_students").autocomplete({  
    minLength: 0,
    source: "DropdownController/autoComplete_student_info/"+$("#add_new_head_students").val(),
    autoFocus: true,
    scroll: true,
    dataType: 'jsonp',
    select: function(event, ui){
    jQuery("#add_new_head_students").val(ui.item.contactPerson);
    jQuery("#student_id").val(ui.item.code);
    jQuery("#stdName").val(ui.item.name);
    jQuery("#stdName").val(ui.item.name);
    jQuery("#fName").val(ui.item.f_name);
    }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });

    
    
});


//Search by Voucher no 
    jQuery("#voch_no").autocomplete({  
        minLength: 0,
        source: "DropdownController/get_voucher_info/"+$("#voch_no").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#voch_no").val(ui.item.contactPerson);
        jQuery("#unrep_date").val(ui.item.date);
        jQuery("#chq_no").val(ui.item.cheque);
        jQuery("#payee_name").val(ui.item.payee);
        jQuery("#un_rep_desc").val(ui.item.desc);
        jQuery("#unpres_amount").val(ui.item.amount);
        }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    
// User Group Search by Emplyoo name

jQuery("#empname").autocomplete({  
        minLength: 0,
        source: "DropdownController/auto_empname/"+$("#empname").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#empname").val(ui.item.contactPerson);
        jQuery("#emp_id").val(ui.item.id);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });