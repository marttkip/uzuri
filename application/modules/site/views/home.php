<?php echo $this->load->view('home/slider', '', TRUE);?>
    <div id="content-container">
        <div id="content" class="clearfix">
           <!--  <div id="banner-homepage">
                <a href="#"><img src="http://placehold.it/1125x150" alt="" /></a>
            </div> -->
            <div id="main-content">
                <article id="intro">
                    <h1>Welcome to Uzuri Institute</h1>
                    <figure><img src="<?php echo site_url();?>assets/images/home.jpg" alt="Welcome to Uzuri Institute" /></figure>
                    <p>Welcome to Uzuri Institute (UZURI) and we wish you a happy stay with us.
Uzuri institute has kept a sharp focus on providing industry with well trained, all-rounded quality graduands. Uzuri has a strong orientation on practical oriented courses and IT related programmes, both academic and professional courses, with humanities ensuring development of the human heart and mind.</p>
<p>At UZURI We believe that anyone can achieve whatever they put their mind to, thus our slogan, “it is possible” This handbook details our various courses and the prerequisite requirements needed for the student to be modeled into an all round graduate, ready to face the challenges that the job market offers whether employed or self employed. Each student is encouraged to feel part and parcel of UZURI and its vision and to participate in the various activities in academic and those geared towards talent and personal development.</p>
<!-- <p>Uzuri institute has kept a sharp focus on providing industry with well trained, all-rounded quality graduands. Uzuri has a strong orientation on practical oriented courses and IT related programmes, both academic and professional courses, with humanities ensuring development of the human heart and mind.</p>
 -->                   
                </article>
                <!-- blog -->
                	<?php //echo $this->load->view('home/blog', '', TRUE);?>
                <!-- end of blog -->
                	<?php //echo $this->load->view('home/events', '', TRUE);?>
              
            </div>
            <div id="sidebar-homepage-right" class="sidebar-homepage">
                  <aside class="widget-container">
                    <div class="widget-wrapper clearfix">
                        <h3 class="widget-title">Faculties / Academic Courses</h3>
                        <ul>
                            <?php
                            if($academic_courses->num_rows() > 0)
                            {
                                foreach($academic_courses->result() as $academic_res)
                                {
                                    $service_name = $academic_res->service_name;
                                    $web_name = $this->site_model->create_web_name($service_name);
                                    ?>
                                        <li><a href="<?php echo site_url();?>accademic-courses/<?php echo $web_name;?>"><?php echo $service_name?></a></li>
                                    <?php
                                }
                            }
                            ?>
                           
                        </ul>
                    </div>
                </aside>
                <ul id="nav-sidebar" class="clearfix">
                    <li><a href="#" class="clearfix">
                        <figure><img src="<?php echo site_url();?>assets/themes/braink/images/icon-sidebar-1.png" alt="Contact Us" /></figure>
                        <strong class="title-nav-sidebar">Contact Us Now</strong>
                         <strong>Email:</strong> admissions@uzuriinstitute.ac.ke<br/> 
                        <strong>Phone:</strong> +254723 560 867/+254700 455 435 
                        </a></li>
                    <li><a href="#" class="clearfix">
                        <figure><img src="<?php echo site_url();?>assets/themes/braink/images/icon-sidebar-2.png" alt="Location" /></figure>
                        <strong class="title-nav-sidebar">Location</strong>
                        P.O Box 2201 - 01000 Thika <br> 
                        Haile selasse Road , Opp Thika School for the blind,
                        </a></li>
                    
                     <!-- <li><a href="#" class="clearfix">
                        <figure><img src="<?php echo site_url();?>assets/themes/braink/images/icon-sidebar-5.png" alt="Library and Research" /></figure>
                        <strong class="title-nav-sidebar">Faculty Department</strong>
                        From Politic, Nuclear and Graphic Design, we have everything.
                        </a></li> -->
                </ul>
                
             
            </div>
           <!--  <article id="intro-principal" class="static-page">
                <h3 id="title-principal"><strong>Dr. Mercy Githinji. -</strong> Director Uzuri Institute</h3>
                <figure>
                    <img src="http://placehold.it/322x433" data-retina="http://placehold.it/644x866" alt="Prof. Jane Applegate Phd." />
                </figure>
                <div id="content-principal">
                    <p>Thank you for your interest in Uzuri.</p>
                    <p>The pathway to success begins with the right decisions. hosing a college that will partner with you to shape and grow you towards the successful life you desire is one such decision.</p>
                    <p>We welcome you to choose Uzuri to speak and walk with us the language of possibilities.
                    We have opportunities for our graduate across Africa and beyond (see some of the testimonies)
                    We assist in attachments and job links; we have companies calling us to provide them with employees! </p>
                 
                      <p><a href="#" class="more-intro">- Learn More</a></p>
                </div>
            </article> -->
        </div>
    </div>

    