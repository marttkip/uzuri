<section class="panel">
    <header class="panel-heading">
        <h2 class="panel-title">Add testimonial</h2>
         <a href="<?php echo site_url().'administration/all-testimonials';?>" class="btn btn-success btn-sm pull-right" style="margin-top:-25px;">Back to testimonial</a>
    </header>
	<div class="panel-body">
        <!-- Jasny -->
        <link href="<?php echo base_url();?>assets/jasny/jasny-bootstrap.css" rel="stylesheet">		
        <script type="text/javascript" src="<?php echo base_url();?>assets/jasny/jasny-bootstrap.js"></script> 
          <div class="padd">
            <?php
				$error2 = validation_errors(); 
				if(!empty($error2)){?>
					<div class="row">
						<div class="col-md-6 col-md-offset-2">
							<div class="alert alert-danger">
								<strong>Error!</strong> <?php echo validation_errors(); ?>
							</div>
						</div>
					</div>
				<?php }
			
				if(isset($_SESSION['error'])){?>
					<div class="row">
						<div class="col-md-6 col-md-offset-2">
							<div class="alert alert-danger">
								<strong>Error!</strong> <?php echo $_SESSION['error']; $_SESSION['error'] = NULL;?>
							</div>
						</div>
					</div>
				<?php }?>
			
				<?php
				$attributes = array('role' => 'form');
		
				echo form_open_multipart($this->uri->uri_string(), $attributes);
				
				if(!empty($error))
				{
					?>
					<div class="alert alert-danger">
						<?php echo $error;?>
					</div>
					<?php
				}
				?>
                <div class="row">
                	<div class="col-md-6">
                      
                        <div class="form-group">
                            <label for="testimonial_name">Testified By.</label>
                            <input type="text" class="form-control" name="testimonial_name" placeholder="testimonial Name" value="<?php echo set_value("testimonial_name");?>">
                        </div>
                        <div class="form-group">
                            <label for="testimonial_name">Department Name</label>
                            <select class="form-control" name="service_id">
                            	<?php
                            		foreach ($active_services->result() as $key) {
                            			# code...
                            			$service_id = $key->service_id;
                            			$service_name = $key->service_name;
                            			?>
                            			<option value="<?php echo $service_id;?>" ><?php echo $service_name;?></option>
                            			<?php
                            		}
                            	?>
                            	
                            </select>
                        </div>
					</div>
                	<div class="col-md-6">
                        <label class="control-label" for="image">Testimonial image</label>
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                <img src="<?php echo $testimonial_location;?>" class="img-responsive"/>
                            </div>
                            <div>
                                <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="testimonial_image"></span>
                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>
                	</div>
                </div>
                <div class="row">
                	<div class="col-md-12">
                	</div>
                </div>
                <div class="row">
                	<div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="testimonial_description">Testimonial description</label>
                            <div class="col-md-10" style=" margin-bottom:20px;">
                            	<textarea class="cleditor" name="testimonial_description"><?php echo set_value("testimonial_description");?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
				
				<div class="form-group center-align">
					<input type="submit" value="Add testimonial" class="login_btn btn btn-success btn-sm">
				</div>
				<?php
					echo form_close();
				?>
		</div>
	</div>
</section>