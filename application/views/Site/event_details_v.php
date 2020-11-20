
    <!--Page Title-->
    <section class="page-title">
        <div class="auto-container">
            <h1><?=$event_details->title?></h1>
            <ul class="page-breadcrumb">
                <li><a href="Home">Home</a></li>
                <li><a href="Events">Events</a></li>
                <li><strong><?=$event_details->title?></strong></li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->

    <!-- Sidebar Page Container -->
    <div class="sidebar-page-container">
        <div class="auto-container">
            <div class="row clearfix">
                
                <!--Content Side-->
                <div class="content-side col-lg-10 offset-1 col-md-12 col-sm-12">
                    <div class="event-detail">
                        <div class="upper-box">
                            <h3><?=$event_details->title?></h3>
                            
                            <div class="image-box wow fadeIn">
                                 <div class="image"><a href="SiteAssets/images/resource/event-single.jpg" class="lightbox-image" data-fancybox="gallery"><img src="images/resource/event-single.jpg" alt=""></a></div>
                                <div class="info-box">
                                    <ul class="course-info clearfix">
                                        <li>
                                           <h4><i class="icon fa fa-clock-o"></i> Number Of Days</h4>
                                           <p><?=$event_details->event_days?></p>
                                        </li>

                                        <li>
                                           <h4><i class="icon fa fa-calendar"></i> Date</h4>
                                           <p><?=date('d M, Y',strtotime($event_details->date_time))?></p>
                                        </li>

                                        <li>
                                           <h4><i class="icon fa fa-map"></i> Place</h4>
                                           <p><?=$event_details->place?></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        <p><?=$event_details->description?></p> </div>
                         <div class="membar-block">
                                    <div class="inner-box">
                                        <div class=""><img src="SiteAssets/images/events//<?=$event_details->image?>" alt="<?=$event_details->title?>"></div>
                                        
                                    </div>
                         </div>
<!--                        <div class="event-paticipant">
                            <h4>Event Paticipant</h4>
                            <div class="membar-carousel owl-carousel owl-theme">
                                <div class="membar-block">
                                    <div class="inner-box">
                                        <div class="thumb"><a href="about.html"><img src="SiteAssets/images/resource/membar-1.jpg" alt=""></a></div>
                                        <div class="membar-info">
                                            <h5 class="name">Christina</h5>
                                            <span class="course">Art Courses</span>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="membar-block">
                                    <div class="inner-box">
                                        <div class="thumb"><a href="about.html"><img src="SiteAssets/images/resource/membar-2.jpg" alt=""></a></div>
                                        <div class="membar-info">
                                            <h5 class="name">Marina Parven</h5>
                                            <span class="course">Art Courses</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="membar-block">
                                    <div class="inner-box">
                                        <div class="thumb"><a href="about.html"><img src="SiteAssets/images/resource/membar-3.jpg" alt=""></a></div>
                                        <div class="membar-info">
                                            <h5 class="name">Loosiya</h5>
                                            <span class="course">Art Courses</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="membar-block">
                                    <div class="inner-box">
                                        <div class="thumb"><a href="about.html"><img src="SiteAssets/images/resource/membar-1.jpg" alt=""></a></div>
                                        <div class="membar-info">
                                            <h5 class="name">Christina</h5>
                                            <span class="course">Art Courses</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>

                <!--  -->
                 
            </div>
        </div>
    </div>
 
