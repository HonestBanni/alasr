  
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
                              
                              
                              if($result):
                                  
                               
                            ?>
            <div class="col-md-12">
                                <div id="product_show_js"><h3 class="has-divider text-highlight">Result <?php echo count($result);?></h3> <div class="table-responsive">
                        <table class="table table-hover" id="table">
                        <thead>
                            <tr>
                                <th>Sn</th>
                                <th>Stock Invoice</th>
                                <th>Stock Date</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                              </tr>
                            </thead>
                          <tbody>
                              <?php
                               $sn='';
                                $grand_total = '';
                                  foreach($result as $row):
                                    $sn++;
                                    echo '<tr >';
                                    echo '<td class="success" >'.$sn.'</td>';
                                    echo '<td class="danger"><a href="UpdateStockInvoice/'.$row->stockInvoice.'">'.$row->stockInvoice.'</a></td>';
                                    echo '<td class="success">'.date('d-M-Y',  strtotime($row->stock_date)).'</td>';
                                    echo '<th class="success">'.$row->comp_name.'</th>
                                        <th class="success" ></th>
                                        <th class="success"></th>
                                        <th class="success"></th>
                                        <th class="success"></th></tr>';
                                            echo '<tr >';
                                        echo '<td class="success"></td>';
                                        echo '<td class="success"></td>';
                                        echo '<td class="success"></td>';
                                        echo '<th class="success">Product Company</th>
                                            <th class="success" >Product</th>
                                            <th class="success" >Quantity</th>
                                            <th class="success">Price</th>
                                            <th class="success">Total</th>';
                                        $tquantity='';
                                        
                                    foreach($row->invoice_details as $details):
                                        
                                           $total = $details->pur_price*$details->quantity;
                                            echo '<tr>'; 
                                            echo '<td class="success"> </td>';
                                            echo '<td class="success"> </td>';
                                            echo '<td class="success"> </td>';
                                            echo '<td  class="success">'.$details->comp_name.'</td>';
                                            echo '<td  class="success">'.$details->pro_name.'</td>';
                                            echo '<td  class="success">'.$details->quantity.'</td>';
                                            echo '<td  class="success">'.$details->pur_price.'</td>';
                                            echo '<td  class="success">'.$total.'</td></tr>';
                                              $tquantity += $total;
                                    endforeach; 
                                    $grand_total +=$tquantity;
                                         echo '<tr>';                              
                                           echo '<td class="danger"> </td>';
                                           echo '<td class="danger"> </td>';
                                           echo '<td class="danger"> </td>';
                                           echo '<td class="danger"> </td>';
                                           echo '<td class="danger"> </td>';
                                           echo '<td class="danger"></td>';
                                           echo '<td  class="danger"><strong>Invoice Total</strong></td>';
                                           echo '<td  class="danger"><strong>'.$tquantity.'</strong></td></tr>';
                                     endforeach; 
                                      echo '<tr>';                              
                                           echo '<td class="danger"> </td>';
                                           echo '<td class="danger"> </td>';
                                           echo '<td class="danger"> </td>';
                                           echo '<td class="danger"> </td>';
                                           echo '<td class="danger"> </td>';
                                           echo '<td class="danger"></td>';
                                           echo '<td  class="danger"><strong>Grand Total</strong></td>';
                                           echo '<td  class="danger"><strong>'.$grand_total.'</strong></td></tr>';
                                     
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
 
  

 