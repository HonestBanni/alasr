
<script language="javascript">
  function printdiv(printpage)
  {
//    var headstr = "<html><head><title></title></head><div><p style='padding-left: 70%;'><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p><p style='text-align: center;'>EDWARDES COLLEGE PESHAWAR <br/> BANK RECONCILIATION STATEMENT</p></div><body>";
    var headstr = "<html><head><title></title></head><body><p ><img  style='text-align: right;' class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p>";
    var footstr = "</body>";
    var newstr = document.all.item(printpage).innerHTML;
    var oldstr = document.body.innerHTML;
    document.body.innerHTML = headstr+newstr+footstr;
    window.print();
    document.body.innerHTML = oldstr;
    location.reload();
    return false;
  }
</script>


 
<!-- ******CONTENT****** --> 
<div class="content container">
    <div class="page-wrapper">
        <header class="page-heading clearfix">
            <h1 class="heading-title pull-left"> <?php echo $page_header?></h1>
                <div class="breadcrumbs pull-right">
                    <ul class="breadcrumbs-list">
                        <li class="breadcrumbs-label">You are here:</li>
                        <li><?php echo anchor('admin/admin_home', 'Home');?> 
                          <i class="fa fa-angle-right">
                          </i>
                        </li>
                        <li class="current"> <?php echo $page_header?></li>
                    </ul>
                </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
        
        
        
        
        
      <div class="row">
          <div class="col-md-12">
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Search</span>
                        </h1>
                        <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder-form'));
                                       
                                     ?>
                                <div class="row">
                                      
                                      
                                     <div class="col-md-3 col-sm-5">
                                          <label for="name">From</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'fromDate',
                                                'id'            => 'fromDate',
                                                'type'          => 'text ',
                                                'value'         => $fromDate,
                                                'class'         => 'form-control datepicker',
                                                'placeholder'   => 'From Date',    
                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                          <label for="name">To</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'toDate',
                                                'id'            => 'toDate',
                                                'type'          => 'text ',
                                                'value'         => $toDate,
                                                'class'         => 'form-control datepicker',
                                                'placeholder'   => 'To Date',    
                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                    <div class="col-md-3">
                                        <label for="name">Product *</label>
                                        <?php
                                            echo form_dropdown('products', $products,$productid,  'class="form-control" id="products"');
                                                
                                            ?>

                                        </div> 
                                    
                                      
                                    
                                      
                                      
                                </div>
                             
                                 
                                 
                              
                            
                             
                            
                            
                                
                            </div>
                            <div style="padding-top:1%;">
                                <div class="col-md-2 pull-right">
                                    
                                    <!--<button type="button" class="btn btn-theme" name="search_brs" id="search_brs"  value="search_brs" ><i class="fa fa-search"></i> Search COA</button>-->
                                    <button type="submit" class="btn btn-theme" name="search" id="search"  value="search" ><i class="fa fa-search"></i> Search</button>
<!--                                    <button type="button" class="btn btn-theme" name="save_checks" id="save_checks"  value="save_checks" ><i class="fa fa-book"></i> Save</button>
                                    <button type="button" name="print" value="print" id="unpresent_print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print</button>-->
                               </div>
                            </div>
                            
                            
                                    <?php
                                    echo form_close();
                                    ?>
                                
                           </section>
                     
                            
                         </div><!--//section-content-->
                        <?php
                              
                              
                              if(@$result):
                                  
                               
                            ?>
            <div class="col-md-12">
                                <div id="product_show_js"><h3 class="has-divider text-highlight">Result <?php echo count($result);?></h3> <div class="table-responsive">
                        <table class="table table-hover" id="table">
                        <thead>
                            <tr>
                                <th>Sn</th>
                                <th>Sale Date</th>
                                <th>Order BY (Contact No#)</th>
                                <th>Product Name</th>
                                <th>Product Company</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                                
 
                            </tr>
                            </thead>
                          <tbody>
                              <?php
                               
                                  $sn='';
                                  $total='';
                                  $gtotal='';
                                  $tquantity='';
                                 foreach($result as $row):
                                  $sn++;
                                 $total += $row->pur_price*$row->quantity;
                                  echo '<tr class="gradeX">';
                                  echo '<td>'.$sn.'</td>';
                                  echo '<td>'.date('d-M-Y',  strtotime($row->sale_date)).'</td>';
                                  echo '<td>'.$row->order_person.' ('.$row->order_number.')</td>';
                                  echo '<td>'.$row->pro_name.'</td>';
                                  echo '<td>'.$row->comp_name.'</td>';
                                  echo '<td>'.$row->quantity.'</td>';
                                  echo '<td>'.$row->pur_price.'</td>';
                                  echo '<td>'.$total.'</td>';
                                  echo ' </tr>';
                                 
                                  $gtotal += $total;
                                  $tquantity += $row->quantity;
                                  endforeach; 
                                echo '<tr class="gradeX">';
                                  echo '<td></td>';
                                  echo '<td></td>';
                                  echo '<td></td>';
                                  echo '<td></td>';
                                  echo '<td>'.$tquantity.'</td>';
                                  echo '<td></td>';
                                  echo '<td>'.$gtotal.'</td>';
                                  
                                  echo ' </tr>';
                              
                              
                              ?>
                                  
 
                           
                        </tbody>
                        </table>                 
                </div></div>
                            </div>            
               
                             <?php
                             
                                  
                              endif;
                                ?>      
              
<!--             Query time: {elapsed_time}-->
          </div>
          
      
      </div>
                 </div>
 
      </div>
  
 
  
 
        
        
     <script>
 $( function() {
    $( ".datepicker" ).datepicker({
         changeMonth: true,
    changeYear: true,
    dateFormat: 'dd-mm-yy'
    });
  } );
  
  
  </script>        
  

 