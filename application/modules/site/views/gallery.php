<div id="content-container">
    <div id="content" class="clearfix">
        <div id="full-width">
            <div id="breadcrumbs" class="clearfix">
                <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                    <a href="<?php echo site_url()?>home" itemprop="url" class="icon-home">
                        <span itemprop="title">Home</span>
                    </a> <span class="arrow">&gt;</span>
                </div>  
                <span class="last-breadcrumbs">
                    Gallery Update
                </span>
            </div>
            <?php
            if($gallery_departments->num_rows() > 0)
            {
                foreach($gallery_departments->result() as $department)
                {
                    $department_id = $department->department_id;
                    $department_name = $department->department_name;
                    $department_description = $department->department_description;

                    ?>
                     <div class="gallery-group clearfix">
                        <a href="gallerydetail.html" class="link-category-gallery">
                            <strong><?php echo $department_name;?></strong><br />
                            <span>Department Description.</span>
                        </a>
                        <ul class="list-gallery-category">
                            <?php
                            $gallery = $this->site_model->get_gallery_items($department_id);
                            // get gallery items 
                            if($gallery->num_rows() > 0)
                            {
                                foreach($gallery->result() as $res)
                                {
                                    $gallery_name = $res->gallery_name;
                                    $gallery_image_name = $res->gallery_image_name;
                                    $service_name = '';
                                    ?>
                                   <li><a href="<?php echo $gallery_location.$gallery_image_name;?>" data-rel="prettyPhoto[cat-1]"><img src="<?php echo $gallery_location.$gallery_image_name;?>" data-retina="<?php echo $gallery_location.$gallery_image_name;?>" alt="<?php echo $gallery_name;?>" /><span><?php echo $gallery_name?></span></a></li>

                                    <?php
                                }
                            }
                            ?>
                            
                        </ul>
                    </div>
                    <?php
                    // 
                }
            }
            ?>
        </div>
        <?php //echo $this->load->view('site/includes/content_tabs', '', TRUE);?>
    </div>
</div>