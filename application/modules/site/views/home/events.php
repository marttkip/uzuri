  <div id="sidebar-homepage-middle" class="sidebar-homepage">
                    <aside class="widget-container">
				        <div class="widget-wrapper clearfix">
				            <h3 class="widget-title">Latest Event</h3>
				                <ul class="menu event-sidebar">	
                                    <?php
                                    
                                    if ($events->num_rows() > 0)
                                    {
                                        foreach ($events->result() as $row)
                                        {
                                            $start_date = date('Y-m-d',strtotime($row->event_start_time));
                                            $date = date('d',strtotime($row->event_start_time));
                                            $month = date('M',strtotime($row->event_start_time));

                                            $events_items = $this->event_model->get_events_on_dates($start_date);
                                            // var_dump($events_items);
                                            ?>		
        								    <li class="clearfix">
        								        <div class="event-date-widget">
                                                    <strong><?php echo $date;?></strong>
                                                    <span><?php echo $month;?></span>
                                                </div>
                                                <div class="event-content-widget"> 
                                                    <?php
                                                    $events_items = $this->event_model->get_events_on_dates($start_date);
                                                    if ($events_items->num_rows() > 0)
                                                    {
                                                        foreach ($events_items->result() as $event_row)
                                                        {
                                                            $event_id = $event_row->event_id;
                                                            $event_status = $event_row->event_status;
                                                            $event_name = $event_row->event_name;
                                                            $event_venue = $event_row->event_venue;
                                                            $image = base_url().'assets/event/'.$event_row->event_image_name;
                                                            $web_name = $this->site_model->create_web_name($event_name);
                                                            $description = $event_row->event_description;
                                                            $mini_desc = implode(' ', array_slice(explode(' ', strip_tags($description)), 0, 50));
                                                            $start_date = date('jS M Y',strtotime($event_row->event_start_time));
                                                            $end_date = date('jS M Y',strtotime($event_row->event_end_time));
                                                            $start_time = date('H:i a',strtotime($event_row->event_start_time));
                                                            $end_time = date('H:i a',strtotime($event_row->event_end_time));

                                                            ?>
                                                            <article>
                                                                <h4><a href="#"><?php echo $event_name?></a></h4>
                                                                <p><?php echo $start_date;?> - <?php echo $end_date;?><br />
                                                                    <?php echo $start_time?> - <?php echo $end_time;?>
                                                                </p>
                                                                <em><?php echo $event_venue?></em>
                                                            </article>
                                                            <?php
                                                        }
                                                    }
                                                    ?>                                       
                                                  
                                                
                                                </div>
        								    </li>
                                        <?php
                                        }
                                    }
                                    ?>
                                   
								</ul>
				        </div>
				    </aside>
                </div>