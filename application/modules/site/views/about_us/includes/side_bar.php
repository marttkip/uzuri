<?php
$result = '';
if($service_gallery->num_rows() > 0)
{

    foreach ($service_gallery->result() as $key_images) {
        # code...
         $service_gallery_image_name = $service_location.'/'.$key_images->service_gallery_image_name;
        $result .= '  <li>
                        <div class="slides-image">
                            <a href="'.$service_gallery_image_name.'" data-rel="prettyPhoto[pp-gw_gallery-5]"><img src="'.$service_gallery_image_name.'" alt="Beauty in Green"  data-retina="'.$service_gallery_image_name.'" /></a>
                        </div>
                        <h4><a href="'.$service_gallery_image_name.'" data-rel="prettyPhoto[pp-gw_gallery-5-slide]">Things you can bring on Library</a></h4>
                    </li>';
    }
}
else
{
    $result = '<li>
                    <h4>No images</h4>
                       
                 </li>';
}

?>
<div id="sidebar" class="sidebar-homepage">
    <aside id="gw_gallery-5" class="widget-container widget_gw_gallery">
        <div class="widget-wrapper clearfix">
            <h3 class="widget-title">Photo Gallery</h3>  
            <script type="text/javascript">
                jQuery(document).ready(function($){
                    $("#gw_gallery-5-slide").flexslider({
                        animation: "slide",
                        animationLoop: false,
                        pauseOnAction: true
                    });
                });
            </script>
            <div id="gw_gallery-5-slide" class="flexslider">
                <ul class="slides">
                  <?php echo $result;?>
                </ul>
            </div>
        </div>
    </aside> 



    <aside class="widget-container">
        <div class="widget-wrapper clearfix">
            <h3 class="widget-title">Testimonial</h3>
            <?php
            $testi_result = '';
            if($service_testimonial->num_rows() > 0)
            {
                foreach ($service_testimonial->result() as $key_testimonials) {
                    # code...
                    $testimonial_name = $key_testimonials->testimonial_name;
                    $testimonial_description = $key_testimonials->testimonial_description;
                    $testimonial_image_name = $testimonial_location.''.$key_testimonials->testimonial_image_name;

                    $testi_result = '<article class="text-widget">
                                        <img src="'.$testimonial_image_name.'" data-retina="'.$testimonial_image_name.'" alt="'.$testimonial_name.'" class="imgframe alignleft testimonial" />               
                                        <div class="testimonial-header">
                                            <h4>'.$testimonial_name.'</h4>
                                        </div>
                                        <blockquote><p>'.$testimonial_description.'</p>
                                        </blockquote>
                                    </article>';
                }
            }
            echo $testi_result;
            ?>
            
        </div>
    </aside>
    <aside class="widget-container">
        <div class="widget-wrapper clearfix">
            <h3 class="widget-title">GET IN TOUCH</h3>
                <article class="text-widget ">
                  
                    <ul>
                 
                        <li><strong>Address:</strong>Haile selasse Road , Opp Thika School for the blind, P.O Box 2201 Thika 01000</li>
                        <li><strong>Email:</strong> info@uzuriinstitute.ac.ke</li>
                        <li><strong>Phone:</strong> 0723 560 867/0700 455 435</li>
                    </ul>   
       <!--   <iframe class="map-area" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.827930758751!2d36.81798031432537!3d-1.2766536359747769!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f172bf2fc9c5b%3A0x9c1b2815f7c0853a!2sUzuri+Institute+of+Technology+and+Development!5e0!3m2!1sen!2ske!4v1455261085905"  frameborder="0" style="border:0" allowfullscreen></iframe> -->
       <a href="<?php echo site_url();?>contact-us" class="button-more">More About Us</a>
                </article>
                

        </div>
    </aside>
</div>