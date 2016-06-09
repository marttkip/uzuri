<?php
$recent_query = $this->blog_model->get_recent_posts();
$recent_posts ='';
if($recent_query->num_rows() > 0)
{
	$row = $recent_query->row();
	
	$post_id = $row->post_id;
	$post_title = $row->post_title;
	$web_name = $this->site_model->create_web_name($post_title);
	$image = base_url().'assets/images/posts/thumbnail_'.$row->post_image;
	$comments = $this->users_model->count_items('post_comment', 'post_id = '.$post_id);
	$description = $row->post_content;
	$mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 50));
	
	$recent_posts = '
		<h6>Medical Alert - Jan 5, 2014</h6>
            
		<div class="pm-sidebar-padding">
		
			<p><strong>'.$post_title.'</strong></p>
		
			<p>'.$mini_desc.'</p>
			<a href="'.site_url().'blog/view-single/'.$web_name.'" class="pm-sidebar-link">Read More <i class="fa fa-plus"></i></a>
		
		</div>
	';

}

else
{
	$recent_posts = 'No posts yet';
}

$categories_query = $this->blog_model->get_all_active_category_parents();
if($categories_query->num_rows() > 0)
{
	$categories = '';
	foreach($categories_query->result() as $res)
	{
		$category_id = $res->blog_category_id;
		$category_name = $res->blog_category_name;
		$web_name = $this->site_model->create_web_name($category_name);
		
		$children_query = $this->blog_model->get_all_active_category_children($category_id);
		
		//if there are children
		$categories .= '<li><a href="'.site_url().'blog/category/'.$web_name.'" title="View all posts filed under '.$category_name.'">'.$category_name.'</a></li>';
	}
}

else
{
	$categories = 'No Categories';
}
$popular_query = $this->blog_model->get_popular_posts();

if($popular_query->num_rows() > 0)
{
	$popular_posts = '';
	
	foreach ($popular_query->result() as $row)
	{
		$post_id = $row->post_id;
		$post_title = $row->post_title;
		$web_name = $this->site_model->create_web_name($post_title);
		$image = base_url().'assets/images/posts/thumbnail_'.$row->post_image;
		$comments = $this->users_model->count_items('post_comment', 'post_id = '.$post_id);
		$description = $row->post_content;
		$mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 10));
		$created = date('jS M Y',strtotime($row->created));
		
		$popular_posts .= '
			<li>
				<div class="pm-recent-blog-post-thumb" style="background-image:url('.$image.');"></div>
				<div class="pm-recent-blog-post-details">
					<a href="'.site_url().'blog/view-single/'.$web_name.'">'.$mini_desc.'</a>
					<p class="pm-date">'.$created.'</p>
				</div>
			</li>
		';
	}
}

else
{
	$popular_posts = 'No posts views yet';
}
?>


<div id="sidebar">
                <!-- <aside class="widget-container">
                    <div class="widget-wrapper clearfix">
                        <h3 class="widget-title">News Category</h3>
                        <ul>
                            <?php echo $categories;?>
                        </ul>
                    </div>
                </aside> -->
                <aside class="widget-container">
                    <div class="widget-wrapper clearfix">
                        <h3 class="widget-title">About School Fun</h3>
                            <article class="text-widget ">
                                <img src="<?php echo site_url();?>assets/images/home.jpg" alt="About Us" class="imgframe" />
                                <p>Welcome to Uzuri Institute (UZURI) and we wish you a happy stay with us.
Uzuri institute has kept a sharp focus on providing industry with well trained, all-rounded quality graduands. Uzuri has a strong orientation on practical oriented courses and IT related programmes, both academic and professional courses, with humanities ensuring development of the human heart and mind.</p>
                     
                                <ul>
                             
                                    <li><strong>Address:</strong>Haile selasse Road , Opp Thika School for the blind, P.O Box 2201 Thika 01000</li>
                                    <li><strong>Email:</strong> info@uzuriinstitute.ac.ke</li>
                                    <li><strong>Phone:</strong> 0723 560 867/0700 455 435</li>
                                </ul>   
                     <iframe class="map-area" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.827930758751!2d36.81798031432537!3d-1.2766536359747769!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f172bf2fc9c5b%3A0x9c1b2815f7c0853a!2sUzuri+Institute+of+Technology+and+Development!5e0!3m2!1sen!2ske!4v1455261085905"  frameborder="0" style="border:0" allowfullscreen></iframe>
                            </article>
                            <a href="<?php echo site_url();?>contact-us" class="button-more">More About Us</a>

                    </div>
                </aside>
               <!--  <aside class="widget-container">
                    <div class="widget-wrapper clearfix">
                        <h3 class="widget-title">Testimonial</h3>
                        <article class="text-widget">
                            <img src="http://placehold.it/96x96" data-retina="http://placehold.it/192x192" alt="Jane Cross" class="imgframe alignleft testimonial" />               
                            <div class="testimonial-header">
                                <h4>Jane Cross</h4>
                                <h5>Management Economy Student</h5>
                            </div>
                            <blockquote><p>Cras pharetra hendrerit mollis. Suspendisse aliquet in metus nec sollicitudin. Interdum et malesuada fames ac ante ipsum primis in faucibus. Integer tellus elit, cursus quis ante eget, molestie euismod tellus. Vestibulum ultricies neque urna, in adipiscing enim aliquet sit amet. Vivamus ullamcorper, diam id pharetra venenatis, erat risus euismod dui, sit amet ullamcorper libero est consequat libero. Ut augue nisl, varius et cursus in, faucibus at neque.</p>
                            </blockquote>
                        </article>
                        <a href="#" class="button-more">Testimonial</a>
                    </div>
                </aside> -->
            </div>