<?php

$contacts = $this->site_model->get_contacts();

if(count($contacts) > 0)
{
    $email = $contacts['email'];
    $email2 = $contacts['email'];
    $facebook = $contacts['facebook'];
    $twitter = $contacts['twitter'];
    $linkedin = $contacts['linkedin'];
    $phone = $contacts['phone'];
    $logo = $contacts['logo'];
}

$popular_query = $this->blog_model->get_popular_posts();

if($popular_query->num_rows() > 0)
{
	$popular_posts = '';
	$count = 0;
	foreach ($popular_query->result() as $row)
	{
		$count++;
		
		if($count < 3)
		{
			$post_id = $row->post_id;
			$post_title = $row->post_title;
			$image = base_url().'assets/images/posts/thumbnail_'.$row->post_image;
			$comments = $this->users_model->count_items('post_comment', 'post_id = '.$post_id);
			$description = $row->post_content;
			$mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 10));
			$created = date('jS M Y',strtotime($row->created));
			
			$popular_posts .= '
				<li>
					<div style="background-image:url('.$image.');" class="pm-recent-blog-post-thumb"></div>
					<div class="pm-recent-blog-post-details">
						<a href="'.site_url().'blog/view-single/'.$post_id.'">'.$mini_desc.'</a>
						<p class="pm-date">'.$created.'</p>
						<div class="pm-recent-blog-post-divider"></div>
					</div>
				</li>
			';
		}
	}
}

else
{
	$popular_posts = 'There are no posts yet';
}
?>
 <footer id="main-footer" >
        <div id="blur-top">
            <a href="#" id="link-back-top">Back to Top</a>
        </div>
       <!--  <div id="slogan-footer">
            <h4>Leading Together <span>for</span> Brighter Future</h4>
        </div> -->
        <div id="footer-content" class="clearfix">
            <div id="footer-container">
                <div id="sidebar-footer-left" class="sidebar-footer">
                    <aside class="widget-container">
                        <div class="widget-wrapper clearfix">
                            <h3 class="widget-title">Contact Us</h3>
                            <h2><strong>UZURI INSTITUTE</strong></h2>
                            <p><strong>Email : </strong><?php echo $email;?></p>
                            <p><strong>You can contact us via </strong> <?php echo $phone;?></p>
                            <p>Visit our campus at Haile selasse Road , Opp Thika School for the blind.</p>
                        </div>
                    </aside>
                </div>
                <div id="sidebar-footer-middle" class="sidebar-footer">
                    <aside class="widget-container">
                        <div class="widget-wrapper clearfix">
                            <h3 class="widget-title">Campus Location</h3>   
                            <article class="text-widget ">
                     <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.827930758751!2d36.81798031432537!3d-1.2766536359747769!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f172bf2fc9c5b%3A0x9c1b2815f7c0853a!2sUzuri+Institute+of+Technology+and+Development!5e0!3m2!1sen!2ske!4v1455261085905"  frameborder="0" style="border:0" allowfullscreen></iframe>
                     <br />                                   </article>
                        </div>
                    </aside>
                </div>
                <div id="sidebar-footer-right" class="sidebar-footer">
                    <article id="footer-address" class="clearfix">
                        <h3 id="title-footer-address"><span>Find us</span></h3>
                         <p>Visit us on social media on.</p>
                        <ul id="list-social" class="clearfix">
                            <li id="icon-facebook"><a href="<?php echo $facebook;?>">Facebook</a></li>
                            <li id="icon-twitter"><a href="<?php echo $twitter;?>">Twitter</a></li>
                        </ul>
                    </article>
                </div>
            </div>
        </div>
        <div id="footer-copyright">
            <div id="footer-copyright-content" class="clearfix">
               
                <!-- <p id="text-address">Haile selasse Road , Opp Thika School for the blind, P.O Box 2201 Thika </p> -->
                <ul id="nav-footer" class="clearfix">
                    <?php echo $this->site_model->get_navigation_footer();?>
                </ul>
                <p id="text-copyright">Copyright &copy; 2013. All rights reserved</p>
            </div>
        </div>
    </footer>
  <script src="<?php echo site_url();?>assets/themes/braink/script/jquery-ui.js" type="text/javascript"></script>
  <script src="<?php echo site_url();?>assets/themes/braink/script/jquery.flexslider.js" type="text/javascript"></script>
  <script src="<?php echo site_url();?>assets/themes/braink/script/jquery.prettyPhoto.js" type="text/javascript"></script>
  <script src="<?php echo site_url();?>assets/themes/braink/script/jquery.retina.js" type="text/javascript"></script>
  <script src="<?php echo site_url();?>assets/themes/braink/script/scripts.js" type="text/javascript"></script>
     