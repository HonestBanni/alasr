        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** --> 
            <div class="row cols-wrapper">
                <div class="col-md-12" style="min-height:450px;">
                   <div class="contact pull-center">
                       <?php
    if($Showmessage):
        foreach($Showmessage as $message): 
    ?>                   
        <div class="alert alert-danger alert-dismissable">
            <strong><?php echo $message->details;?></strong>
        </div>
    <?php  
        endforeach;    
            
    endif;
        ?>  
                       <p style="font-size:27px; margin-top:150px; text-align:center"><strong>Welcome to <br><?php    
                       
//                       echo '<pre>';print_r($userInfo);die;
                       echo $userInfo->title;?></strong></p> <br>
                  
                    </div><!--//contact-->
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           <nav class="main-nav" role="navigation">
            <div class="container">
                           
                <div class="navbar-collapse collapse" id="navbar-collapse" >
                    <ul class=" nav navbar-nav" style="z-index: 10">
                        
                 
                        <li class="nav-item">
                            <a href="http://minotech.systems" target="_new">Minotech Systems</a>
                            
                            
                            
                           
                        </li>
                      
                        
                        
                    </ul><!--//nav-->
                </div><!--//navabr-collapse-->
            </div><!--//container-->
        </nav>
        </div><!--//content-->
   
  