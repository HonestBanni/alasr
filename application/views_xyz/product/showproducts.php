
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Product</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard">Dashboard</a>
                        </li>
                        <li>
                            <a>Product</a>
                        </li>
                        <li class="active">
                            <strong>All Product</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
 
            <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Product list</h5>
 
            </div>
            <div class="ibox-content">
            
            <table class="table table-striped table-bordered table-hover " id="editable" >
                    <thead>
                    <tr>
                        <th>Sn</th>
                        <th>Name</th>
                        <th>Label Price</th>
                        <th>Sale Price</th>
                        <th>Company Name </th>
                         <th>Discount</th>
                        <th>Registration Date</th>
                        <th>Status</th>
                        <th>Manage</th>
                    </tr>
                    </thead>
                    <tbody>
                
                <?php
            // echo '<pre>';print_r($showProduct);
                if(!empty($showProduct)){
                    $sn = 1;
                    foreach($showProduct as $Row){
                        if($Row->pro_status){$status="<a href='javascript:void(0)' class='productstatus' id='".$Row->pro_id.",".$Row->pro_status."'><span class='fa fa-unlock text-navy'></span></a>";}else{$status="<a href='javascript:void(0)' class='productstatus' id='".$Row->pro_id.",".$Row->pro_status."'><span class='fa fa-unlock-alt danger'></span></a>";}
                        
                        echo '  <tr class="gradeX">
                                    <td>'.$sn.'</td>
                                    <td>'.$Row->pro_name.'</td>
                                    <td>'.$Row->pro_lbl_price.'</td>
                                    <td>'.$Row->pro_sal_price.'</td>
                                    <td>'.$Row->comp_name.'</td>
                                    <td>'.$Row->pro_pur_disc.'</td>
                                    <td>'.$Row->pro_date.'</td>
                                    <td>'.$status.'</td>
                                    <td>
                                        <a href="product/'.$Row->pro_id.'"><span class="fa fa-book text-navy"></span></a>
                                    </td>
                                </tr>';
                        $sn++;
                    }
                    
                }
                
                ?>
        
             
        
            
            </table>
        <div class="row">
          
           <div class="col-sm-4 pull-right">
               
               <?php  echo $links ;  ?>
   </div>
        </div>

                

            </div>
            </div>
            </div>
            </div>
        </div>
<script>
    jQuery(document).ready(function(){
        jQuery('.productstatus').on('click',function(){
            var proId = jQuery(this.id);
           
            console.log(proId);
        });
    });
</script>     