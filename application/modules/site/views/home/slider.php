<div style="width: 1124px; height: 100%; margin: 0 auto; margin-top: 10px;">
<!-- end of slider -->
<div id="slider-news" class="flexslider">
                    
    <div class="flex-viewport" style="overflow: hidden; position: relative;">
    <ul class="slides" style="width: 1000%; transition-duration: 0.6s; transform: translate3d(-792px, 0px, 0px);">
             <?php
                if($slides->num_rows() > 0)
                {
                    foreach($slides->result() as $slide)
                    {
                        $slide_name = $slide->slideshow_name;
                        $description = $slide->slideshow_description;
                        $slide_image = $slide->slideshow_image_name;
                        $slideshow_link = $slide->slideshow_link;
                        $slideshow_button_text = $slide->slideshow_button_text;
                        $description = $this->site_model->limit_text($description, 8);
                        
                        ?>
                          <li class="flex-active-slide" style="width: 396px; float: left; display: block;">
                            <div class="slider-news-content">
                                <img src="<?php echo base_url();?>assets/slideshow/<?php echo $slide_image;?>" alt="<?php echo $slide_name;?>">
                               
                            </div>
                        </li>
                    <?php
                    }
                }
                ?>
          
           </ul></div><ol class="flex-control-nav flex-control-paging"><li><a class="">1</a></li><li><a class="flex-active">2</a></li><li><a class="">3</a></li></ol><ul class="flex-direction-nav"><li><a class="flex-prev" href="#">Previous</a></li><li><a class="flex-next" href="#">Next</a></li></ul></div>
</div>
