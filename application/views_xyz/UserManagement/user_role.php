
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">User Role
      </h1>
      <div class="breadcrumbs pull-right">
        <ul class="breadcrumbs-list">
          <li class="breadcrumbs-label">You are here:
          </li>
          <li> 
            <?php echo anchor('Dashboard', 'Home');?> 
            <i class="fa fa-angle-right">
            </i>
          </li>
          <li class="current">User Role
          </li>
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">                            
          <?php echo form_open('userRoleCreate',array('class'=>'form-inline')); ?>
            <div class="row">
            <div class="col-md-12">
              
              <div class="form-group ">
                <?php
                
//                $value = '';
//                $ur_Id = '';
//                if(@$userRole):
//                    $value = $userRole->ur_name;
//                    $ur_Id = $userRole->ur_id;
//                    else:
//                    $value = '';
//                    $usrId = '';
//                        
//                endif;
                    
                    echo form_input(array(
                    'name'	=> 'groupName',
                    'value'     =>$groupName,
                    'class'     =>'form-control',
                    'placeholder'=>'Group Name',
                    'required'=>'required'
                    ));
                    ?>
              </div>
              <!--//form-group-->
              <input type="hidden" name="ur_id" value="<?php echo $user_role_id;?>">
              <div class="form-group">
                <button type="submit" name="addGroup" value="addGroup" class="btn btn-theme">
                    <i class="fa fa-plus">
                  </i> Create Group
                </button>
              </div>
               
             
              <!--//form-group-->
               
            </div>
          </div>

         <?php echo form_close(); ?>     
            <?php
            if($userRoleResult):
            ?>
            <h3 class="has-divider text-highlight">Result :<?php echo count($userRoleResult)?></h3>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                  <th >S.no</th>
               
                  <th>Group Name</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Manage</th>
                  <th>Policy Layer 2</th>
                  <th>Policy Layer 3</th>
                  
                </tr>
              </thead>
              <tbody>
                  <?php
                  $sn = 1;
                   foreach($userRoleResult as $urRow):
                       if($urRow->ur_status){$status="<a href='javascript:void(0)' class='groupId' id='".$urRow->ur_status.",".$urRow->ur_status."'><span class='fa fa-unlock text-navy'></span></a>";}else{$status="<a href='javascript:void(0)' class='productstatus' id='".$urRow->ur_status.",".$urRow->ur_status."'><span class='fa fa-unlock-alt danger'></span></a>";}
                      echo '<tr>
                                <td>'.$sn.'</td>
                                <td>'.$urRow->ur_name.'</td>
                                <td>'.$urRow->ur_date.'</td>
                                 <td>'.$status.'</td>
                                <td><a href="userRole/'.$urRow->ur_id.'" class="productstatus" ><span class="fa fa-book text-navy"></span></a></td>
                                <td><a href="groupPolicy/'.$urRow->ur_id.'" class="productstatus" ><span class="fa fa-stack-exchange"></span></a></td>
                                <td><a href="GPSetting/'.$urRow->ur_id.'" class="productstatus" ><span class="fa fa-stack-exchange"></span></a></td>
                              </tr>';
                   $sn++;
                  endforeach;
                ?>
                
              </tbody>
            </table>
            <?php
            else:
                echo '<h3 class="has-divider text-highlight">No query found..</h3>';
            endif;
            ?>
            </article>
          <!--//contact-form-->
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
 
 