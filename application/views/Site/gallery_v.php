

    <!--Gallery Section-->
    <section class="gallery-section">
        <div class="auto-container">
            <div class="sec-title text-center pink-devider">
                <h2>Our <span>Gallery</span></h2>
            </div>

            <!--Galery-->
            <div class="sortable-masonry">
                
                <div class="items-container row clearfix">
                
                     <?php
                        if($site_gallery):
//                            echo '<pre>';print_r($site_gallery);die;
                            foreach($site_gallery as $g_row):
                                echo '<div class="project-block masonry-item game book education drawing all col-lg-4 col-md-6 col-sm-12">
                                        <div class="inner-box">
                                            <div class="image">
                                                <img src="SiteAssets/images/gallery/'.$g_row->image.'" alt="'.$g_row->title.'" />
                                                <div class="overlay-box"><a href="SiteAssets/images/gallery/'.$g_row->image.'" style="background-image: url(SiteAssets/images/gallery/'.$g_row->image_thumb.')
                                                    " class="lightbox-image" data-fancybox="gallery"><span class="icon icon-plus"></span></a></div>
                                            </div>
                                        </div>
                                    </div>';
                            endforeach;
                              
                        endif;
                     
                     ?>   
                    

                </div>
                <?php
                  echo '<br/><div class="styled-pagination text-center">';
                                echo $pages;
                                echo '</div>';
                
                ?>
            </div>
        </div>
    </section>
    <!--End Gallery Section-->
 