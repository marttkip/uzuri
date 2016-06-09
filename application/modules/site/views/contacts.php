<?php 
	if(count($contacts) > 0)
	{
		$email = $contacts['email'];
		$phone = $contacts['phone'];
		$facebook = $contacts['facebook'];
		$twitter = $contacts['twitter'];
		$linkedin = $contacts['linkedin'];
		$logo = $contacts['logo'];
		$company_name = $contacts['company_name'];
		$address = $contacts['address'];
		$city = $contacts['city'];
		$post_code = $contacts['post_code'];
		$building = $contacts['building'];
		$floor = $contacts['floor'];
		$location = $contacts['location'];
		$working_weekend = $contacts['working_weekend'];
		$working_weekday = $contacts['working_weekday'];
		
		if(!empty($email))
		{
			$mail = '<div class="top-number"><p><i class="fa fa-envelope-o"></i> '.$email.'</p></div>';
		}
		
		if(!empty($facebook))
		{
			$facebook = '<li><a href="'.$facebook.'" target="_blank"><i class="fa fa-facebook"></i></a></li>';
		}
		
		if(!empty($twitter))
		{
			$twitter = '<li><a href="'.$twitter.'" target="_blank"><i class="fa fa-twitter"></i></a></li>';
		}
		
		if(!empty($linkedin))
		{
			$linkedin = '<li><a href="'.$linkedin.'" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
		}
	}
	else
	{
		$email = '';
		$facebook = '';
		$twitter = '';
		$linkedin = '';
		$logo = '';
		$company_name = '';
	}
?>

<div id="content-container">
        <div id="content" class="clearfix">
            <div id="main-content">
                <div id="breadcrumbs" class="clearfix">
                    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                        <a href="index.html" itemprop="url" class="icon-home">
                            <span itemprop="title">Home</span>
                        </a> <span class="arrow">&gt;</span>
                    </div>  
                    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                        <a href="#" itemprop="url">
                            <span itemprop="title">About Us</span>
                        </a> <span class="arrow">&gt;</span>
                    </div>  
                    <span class="last-breadcrumbs">
                        Contact Uzuri Institute
                    </span>
                </div>
                <article class="static-page">    
                    <form method="post" action="#" id="form-contact" class="clearfix">
                            <label for="text-name">Name <span>*</span></label>
                            <input type="text" name="name" class="input" id="text-name"><br>
                            <label for="text-email">Email</label>
                            <input type="text" name="email" class="input" id="text-email"><br>
                            <label for="text-comment">Message <span>*</span></label>
                            <textarea cols="10" rows="20" class="input textarea" id="text-comment"></textarea><br>
                            <input type="submit" name="submitcontact" class="button" value="Sent Message">
                        
                    </form>
                </article>
                <div class="clear"></div>
                
            </div>
            <div id="sidebar">
               <aside class="widget-container">
                    <div class="widget-wrapper clearfix">
                        <h3 class="widget-title">About Uzuri Institute</h3>
                            <article class="text-widget ">
                                <ul>
                                    <li><strong>Address:</strong>Haile selasse Road , Opp Thika School for the blind, P.O Box 2201 Thika 01000</li>
                                    <li><strong>Email:</strong> info@uzuriinstitute.ac.ke</li>
                                    <li><strong>Phone:</strong> 0723 560 867/0700 455 435</li>
                                </ul>   
                            <a href="<?php echo site_url();?>contact-us" class="button-more">More About Us</a>
                            </article>
                            

                    </div>
                </aside>
             </div> 
             <div class="row">
             <article>
                <iframe class="map-area" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.827930758751!2d36.81798031432537!3d-1.2766536359747769!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f172bf2fc9c5b%3A0x9c1b2815f7c0853a!2sUzuri+Institute+of+Technology+and+Development!5e0!3m2!1sen!2ske!4v1455261085905"  frameborder="0" style="border:0;width: 100%;" allowfullscreen></iframe>
            </article>    
            </div>
    </div>
</div>
    

<script type="text/javascript"   src="http://maps.google.com/maps/api/js?sensor=false"> </script>

<script type="text/javascript">
$(document).ready(function() {
	initialize()
});
  function initialize() {
    var position = new google.maps.LatLng('-1.295977', '36.808225');
	 <!-- var position = new google.maps.LatLng(latitude, longitude);-->
    var myOptions = {
      zoom: 18,
      center: position,
      mapTypeId: google.maps.MapTypeId.ROADMAP
		//mapTypeId: google.maps.MapTypeId.HYBRID
    };
    var map = new google.maps.Map(
        document.getElementById("map_canvas"),
        myOptions);
 
    var marker = new google.maps.Marker({
        position: position,
        map: map,
        title:"<?php echo $company_name;?>"
    });  
 
   var contentString = '<br/><span itemprop="streetAddress"><?php echo $company_name;?></span>, <span itemprop="addressLocality"><?php echo $building.', '.$floor;?></span>';
    //var contentString = '';
    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });
       infowindow.open(map,marker);
    google.maps.event.addListener(marker, 'click', function() {
      infowindow.open(map,marker);
    });
 
  }
 
</script>
