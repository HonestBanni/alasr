<script type="text/javascript">
    function date_time(id){
        date = new Date;
        year = date.getFullYear();
        month = date.getMonth();
        months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        d = date.getDate();
        day = date.getDay();
        days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        h = date.getHours();
        if(h<10)
        {
                h = "0"+h;
        }
        m = date.getMinutes();
        if(m<10)
        {
                m = "0"+m;
        }
        s = date.getSeconds();
        if(s<10)
        {
                s = "0"+s;
        }
        result = ''+days[day]+' '+months[month]+' '+d+' / '+year+' , '+h+':'+m+':'+s;
        document.getElementById(id).innerHTML = result;
        setTimeout('date_time("'+id+'");','1000');
        return true;
}
</script>
    <header class="header">  
        <div class="header-main container">
            <h1 class="logo col-md-5 col-sm-6">
                <a href="Dashboard"><img id="logo" class="img-responsive" width="200" src="assets/App/<?php echo $userInfo->logo?>" alt="<?php echo $userInfo->title?>"></a>
<!--               <a href="Home"> <?php
                 
                echo $app_setting->title;
                ?></a>-->
            
            </h1><!--//logo-->  
            <?php
                $whereUPl1      = array('upl1_urId'=>$userRole->ur_id);
                $UPL1           = $this->AppModel->UPL1($whereUPl1);
                $picture        = $employee_info->picture;
                                ?>
            <div class="info col-md-5 col-sm-4"> 
              <strong style="font-size:14px;color:#208e4c">Designation: <?php   echo $employee_info->designation;?> 
                <br>
                Contact #: <?php  echo $employee_info->contact1;?>
              </strong><br/>              
               <span id="date_time"></span>
                <script type="text/javascript">window.onload = date_time('date_time');</script>
            </div>
            <div class="col-md-2 col-sm-2">
                 
                <?php
                if($picture == ''){
                ?>
                <img src="assets/App/user.png" width="100" height="80" style="border-radius:10%">
                <br><a href="#"><?php   echo $employee_info->emp_name;?></a>
                <?php
                }else{
                ?>
                <img src="assets/App/employee/<?php echo $picture;?>" width="80" height="80" style="border-radius:10%">
                <br><a href="#"><?php   echo $employee_info->emp_name;?></a>
            </div>
            <?php } 
//                }
            ?>
        </div><!--//header-main-->
    </header><!--//header-->
 
    <!-- ******NAV****** -->
    <nav class="main-nav" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button><!--//nav-toggle-->
                </div><!--//navbar-header-->            
                <div class="navbar-collapse collapse" id="navbar-collapse">
                    <ul class=" nav navbar-nav">
                        
         <?php
                        if($UPL1):
                             
                            foreach($UPL1 as $l1Row):
                                echo '<li class="nav-item">';
                                echo '<a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">'.$l1Row->m1_name.' &nbsp;<i class="fa fa-angle-down"></i></a>';
                                    
                                    $whereUPl2 = array(
                                        'upl2_urId'     => $userRole->ur_id,
                                        'up2_m1Id'      => $l1Row->m1_id,
                                        'm2_status'     => 1,
                                        'm2_flag'       => 1,
                                        );
                                    
                                    $UPL2 = $this->AppModel->UPL2($whereUPl2);
                                        echo '<ul class="dropdown-menu">';
                                      if($UPL2):
                                         foreach($UPL2 as $l2Row):
                                              $whereUPl3 = array(
                                                        'upl3_urId' =>$userRole->ur_id,
                                                        'upl3_m1Id' =>$l1Row->m1_id,
                                                        'upl3_m2Id' =>$l2Row->m2_id,
                                                         );
                                                     $UPL3 = $this->AppModel->UPL3($whereUPl3);
                                                    //echo '<pre>';print_r($UPL3);
                                                     if($UPL3):
                                                        echo '<li class="dropdown-submenu">
                                                              <a tabindex="-1" href="'.$l2Row->m2_function.'">'.$l2Row->m2_name.'<i class="fa fa-angle-right"></i></a>
                                                              <ul class="dropdown-menu" style="display: none;"> ';
                                                     foreach($UPL3 as $l3Row):
                                                         
                                                         echo '<li class="dropdown-submenu"><a href="'.$l3Row->m3_function.'">'.$l3Row->m3_name.'</a></li>';
                                                        
                                                    endforeach; 
                                                        echo '</ul></li>';
                                                    else:
                                                        
                                                             echo '<li><a href="'.$l2Row->m2_function.'">'.$l2Row->m2_name.'</a></li>';
                                                         
                                                    endif;
                                             endforeach;
                                         endif;    
                                        echo ' </ul>';
                                
                                echo '</li>';
                          
                            endforeach;
                        endif;
                        
                        ?>
                      
                        
                        
                        
                    </ul><!--//nav-->
                </div><!--//navabr-collapse-->
            </div><!--//container-->
        </nav><!--//main-nav-->
        