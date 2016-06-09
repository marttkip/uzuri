<?php

	$result = '';
	
	//if users exist display them

	if ($latest_posts->num_rows() > 0)
	{	
		//get all administrators
		$administrators = $this->users_model->get_all_administrators();
		if ($administrators->num_rows() > 0)
		{
			$admins = $administrators->result();
		}
		
		else
		{
			$admins = NULL;
		}
		
		foreach ($latest_posts->result() as $row)
		{
			$post_id = $row->post_id;
			$blog_category_name = $row->blog_category_name;
			$blog_category_web_name = $this->site_model->create_web_name($blog_category_name);
			$blog_category_id = $row->blog_category_id;
			$post_title = $row->post_title;
			$web_name = $this->site_model->create_web_name($post_title);
			$post_status = $row->post_status;
			$post_views = $row->post_views;
			$image = base_url().'assets/images/posts/'.$row->post_image;
			$created_by = $row->created_by;
			$modified_by = $row->modified_by;
			$comments = $this->users_model->count_items('post_comment', 'post_id = '.$post_id);
			$categories_query = $this->blog_model->get_all_post_categories($blog_category_id);
			$description = $row->post_content;
			$mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 30));
			$created = $row->created;
			$day = date('j',strtotime($created));
			$month = date('M Y',strtotime($created));
			$created_on = date('jS M Y',strtotime($row->created));
			
			$categories = '';
			$count = 0;
			
				foreach($categories_query->result() as $res)
				{
					$count++;
					$category_name = $res->blog_category_name;
					$category_id = $res->blog_category_id;
					
					if($count == $categories_query->num_rows())
					{
						$categories .= '<a href="'.site_url().'blog/category/'.$category_id.'" title="View all posts in '.$category_name.'" rel="category tag">'.$category_name.'</a>';
					}
					
					else
					{
						$categories .= '<a href="'.site_url().'blog/category/'.$category_id.'" title="View all posts in '.$category_name.'" rel="category tag">'.$category_name.'</a>, ';
					}
				}
				$comments_query = $this->blog_model->get_post_comments($post_id);
				//comments
				$comments = 'No Comments';
				$total_comments = $comments_query->num_rows();
				if($total_comments == 1)
				{
					$title = 'comment';
				}
				else
				{
					$title = 'comments';
				}
				
				if($comments_query->num_rows() > 0)
				{
					$comments = '';
					foreach ($comments_query->result() as $row)
					{
						$post_comment_user = $row->post_comment_user;
						$post_comment_description = $row->post_comment_description;
						$date = date('jS M Y H:i a',strtotime($row->comment_created));
						
						$comments .= 
						'
							<div class="user_comment">
								<h5>'.$post_comment_user.' - '.$date.'</h5>
								<p>'.$post_comment_description.'</p>
							</div>
						';
					}
				}
			$result .= '
			  <li class="clearfix">
			        <img src="'.$image.'" data-retina="'.$image.'" alt="'.$post_title.'" class="imgframe alignleft" />
	                <h4><a href="'.site_url().'blog/category/'.$blog_category_web_name.'">'.$post_title.'</a></h4>
			        <span class="date-news">'.$created_on.' by admin</span>
			    </li>
				';
			}
		}
		else
		{
			$result = "There are no posts :-(";
		}
	   
	  ?>
        <div id="sidebar-homepage-left" class="sidebar-homepage">
                    <aside class="widget-container">
				        <div class="widget-wrapper clearfix">
				            <h3 class="widget-title">Latest Blog</h3>
				                <ul class="menu news-sidebar">			
								  	<?php echo $result;?>
								</ul>
								<a href="newslist.html" class="button-more">Read More Blog Post</a>
				        </div>
				    </aside>
                </div>