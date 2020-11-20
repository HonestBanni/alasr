 

    <!-- Event Section -->
    <section class="event-section" style="background-image: url(SiteAssets/images/background/pattern-1.png);">
        <div class="auto-container">
            <div class="sec-title text-center">
                <h2>Al-ASR Education Systems<span>Events </span></h2>
            </div>

            <div class="event-table">
                <div class="title-box"><span class="icon fa fa-calendar"></span> Event </div>
                <!-- Event Block -->
                <?php
                
                if($site_event):
                    foreach($site_event as $evnt_row):
                   
                    echo '<div class="event-block wow fadeInUp">
                    <div class="inner-box clearfix">
                        
                        <div class="image-column">
                            <div class="image"><a href="Event/'.$evnt_row->event_slug.'"><img src="SiteAssets/images/events/'.$evnt_row->image.'" alt="'.$evnt_row->title.'"></a></div>
                        </div>

                        <div class="day-column">
                            <h3>'.$evnt_row->event_days.'</h3>
                            <span>'.date('d M, Y',strtotime($evnt_row->date_time)).'</span>
                        </div>

                        <div class="info-column">
                            <h4><a href="Event/'.$evnt_row->event_slug.'">'.$evnt_row->title.'</a></h4>
                            <ul class="info">
                                <li><a href="Event/'.$evnt_row->event_slug.'"><i class="fa fa-clock-o"></i>'.date('H:i A',strtotime($evnt_row->date_time)).'</a></li>
                                <li><a href="Event/'.$evnt_row->event_slug.'"><i class="fa fa-user"></i> '.$evnt_row->school_name.'</a></li>
                            </ul>
                        </div>

                        <div class="room-column">
                            <span>'.$evnt_row->place.'</span>
                        </div>

                        <div class="link-column">
                            <a href="Event/'.$evnt_row->event_slug.'" class="theme-btn">Details</a>
                        </div>
                    </div>
                </div>';
                 
                    endforeach;
                    echo '<br/><div class="styled-pagination text-center">';
                       echo $pages;
                    echo '</div>';
                    
             
                endif;
                
                ?>
               
            </div>
 
        </div>
    </section>
    <!--End Event Section -->
 
