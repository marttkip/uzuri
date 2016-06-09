<?php

$post_id = $row->post_id;
$blog_category_name = $row->blog_category_name;
$blog_category_id = $row->blog_category_id;
$post_title = $row->post_title;
$post_status = $row->post_status;
$post_views = $row->post_views;
$image = base_url().'assets/images/posts/'.$row->post_image;
$created_by = $row->created_by;
$modified_by = $row->modified_by;
$comments = $this->users_model->count_items('post_comment', 'post_id = '.$post_id);
$categories_query = $this->blog_model->get_all_post_categories($blog_category_id);
$description = $row->post_content;
$mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 50));
$created = $row->created;
$day = date('j',strtotime($created));
$month = date('M Y',strtotime($created));
$created_on = date('jS M Y H:i a',strtotime($row->created));

$categories = '';
$count = 0;
//get all administrators
	$administrators = $this->users_model->get_all_administrators();
	if ($administrators->num_rows() > 0)
	{
		$admins = $administrators->result();
		
		if($admins != NULL)
		{
			foreach($admins as $adm)
			{
				$user_id = $adm->user_id;
				
				if($user_id == $created_by)
				{
					$created_by = $adm->first_name;
				}
			}
		}
	}
	
	else
	{
		$admins = NULL;
	}

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
				 <li class="comment clearfix">
                    <img alt="Dhimas" src="http://placehold.it/160x160" class="avatar avatar-160 photo" height="160" width="160" />	
                    <article class="comment odd alt thread-odd thread-alt depth-1 clearfix">
                        <header class="clearfix">
                            <h3><a href="#">'.$post_comment_user.'</a> -</h3>
                            <time datetime=" '.$date.'"> '.$date.'</time>
                        </header>
                        <div class="comment-wrapper">
                            <p>'.$post_comment_description.'</p>
                        </div>
                    </article>
                </li>
			';
		}
	}
	



?>
 <div id="content-container">
        <div id="content" class="clearfix">
            <div id="main-content">
                <div id="breadcrumbs" class="clearfix">
                    <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                        <a href="<?php echo site_url();?>home" itemprop="url" class="icon-home">
                            <span itemprop="title">Home</span>
                        </a> <span class="arrow">&gt;</span>
                    </div>  
                    <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                        <a href="<?php echo site_url();?>blog" itemprop="url">
                            <span itemprop="title">Blog</span>
                        </a> <span class="arrow">&gt;</span>
                    </div>  
                    <span class="last-breadcrumbs">
                        <?php echo $post_title;?>
                    </span>
                </div>
                <article class="static-page news">
                    <header class="clearfix">
                        <figure>
                            <img src="<?php echo $image;?>" data-retina="<?php echo $image;?>" alt="<?php echo $post_title;?>" />
                        </figure>
                        <aside>
                            <h1 id="news-title"><?php echo $post_title;?></h1>
                            <p id="link-category"><a href="#"><?php echo $blog_category_name;?></a></p>
                            <p id="blog-time" class="clearfix"><time datetime="<?php echo $created_on;?>"><?php echo $created_on;?></time> <a href="#" id="link-comment-header">Comments (<?php echo $total_comments?>)</a></p>
                            <ul id="social-link" class="clearfix">
				                <li><div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="http://cubicthemes.com" send="false" layout="button_count" width="40" show_faces="false" font=""></fb:like></li>
				                <li>
						              <a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
                                </li>
				                <li class="last">
                                    <div class="g-plusone" data-size="medium"></div>
                                    <script type="text/javascript">
                                      (function() {
                                        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                                        po.src = 'https://apis.google.com/js/plusone.js';
                                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                                      })();
                                    </script>
                                </li>
				            </ul>

                        </aside>
                    </header>
                    <p><?php echo $description;?></p>
                   </article>
                <div id="comments">
                    <h2 class="title-comment"><?php echo $total_comments;?> <?php echo $title;?> on <span><?php echo $post_title;?></span></h2>
                    <ul id="list-comments">
                    	<?php echo $comments;?>
                </ul>
                <div id="respond" class="clearfix">
                    <h2 id="reply-title" class="title-comment"><strong>Leave a Reply</strong></h2>
                    <div class="clear"></div>
                    <form action="http://cubicthemes.com/develop/veteranfood/wp-comments-post.php" method="post" id="form-comment" class="clearfix">
                        <div>
                            <p class="comment-notes">Your email address will not be published. Required fields are marked <span class="required">*</span></p>							
                            <label for="author">Name <span>*</span></label>
                            <input id="author" name="author" type="text" class="input required error" value="John Doe" size="30" />
                            <label for="email">Email <span>*</span></label>
                            <input id="email" name="email" type="text" class="input required email" value="" size="30" />
                            <label for="url">Website</label>
                            <input id="url" name="url" type="text" class="input url" value="" size="30" />
                            <label for="comment">Comment <span>*</span></label>
                            <textarea id="comment" name="comment" cols="45" rows="8" class="input textarea required"></textarea><br/>
                            <input name="submit" type="submit" id="submit" value="Post Comment" class="button" />
                        </div>
                        </form>
                    </div><!-- #respond -->
                </div>
            </div>
            <?php echo $this->load->view('blog/includes/sidebar', '', TRUE);?>

            <?php //echo $this->load->view('site/includes/content_tabs', '', TRUE);?>
        </div>
    </div>
