
    <!--Page Title-->
    <section class="page-title">
        <div class="auto-container">
            <h1>About Us</h1>
            <ul class="page-breadcrumb">
                <li><a href="Home">Home</a></li>
                <li>About Us</li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->

     <!-- About Us -->
    <section class="about-us style-two">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="content-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="sec-title">
                            <h2><span>About</span> Al-Asr</h2>
                        </div>
                        <div class="text">
                            <p><strong><?php echo $p_message->title?></strong></p>
                            <p><?php echo $p_message->description?></p>
                        </div>
                    </div>
                </div>

                <!-- Image-column -->
                <div class="image-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="image-box wow fadeInRight">
                            <figure class="image-1"><img src="SiteAssets/images/resource/image-1.png" alt=""></figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End About Us -->

    <!-- History Section -->
    <section class="history-section">
        <div class="auto-container">
            <div class="row clearfix">
                <!-- History Column -->
                <div class="histroy-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <h2>Our <span>History</span></h2>
                        <div class="text"><?=$our_history->title?></div>
                        <ul class="list-style-two">
                            <?php
                            
                            
                            if($our_history_title1):
                                foreach($our_history_title1 as $row):
                                echo '<li>'.$row->title.'</li>';
                                endforeach;
                            endif;
                             
                            ?>
                            
                        </ul>
                        <div class="image-box wow fadeInLeft">
                            <figure><img src="SiteAssets/images/resource/<?=$our_history->file?>" alt="<?=$company_info->page_header?>"></figure>
                        </div>
                    </div>
                </div>

                <!-- History Column -->
                <div class="accordion-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <h3><?=$our_history->title2?></h3>
                        <!--Accordian Box-->
                        <ul class="accordion-box">
                            
                            <?php
                            
                            
                            if($our_history_title2):
                                $class = '';
                                $class2 = '';
                                $count ='';
                                foreach($our_history_title2 as $row2):
                                        $count++;
                                   if($count == 1):
                                       $class = 'accordion block active-block';
                                       $class2 = 'acc-btn active';
                                       else:
                                       $class = 'accordion block';
                                       $class2 = 'acc-btn';
                                   endif; 
                                   
                                 echo '<li class="'.$class.'">
                                        <div class="'.$class2.'"><span class="icon"></span>'.$row2->title.'</div>
                                        <div class="acc-content">
                                            <div class="content">
                                                <div class="text">'.$row2->title_details.'</div>
                                            </div>
                                        </div>
                                    </li>';
                                
                                endforeach;
                            endif;
                            
                            ?>
                            
                           
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End History Section -->
 