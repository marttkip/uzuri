<?php

class Testimonial_model extends CI_Model 
{	
	public function upload_testimonial_image($testimonial_path, $edit = NULL)
	{
		//upload product's gallery images
		$resize['width'] = 500;
		$resize['height'] = 500;
		
		if(!empty($_FILES['testimonial_image']['tmp_name']))
		{
			$image = $this->session->userdata('testimonial_file_name');
			
			if((!empty($image)) || ($edit != NULL))
			{
				if($edit != NULL)
				{
					$image = $edit;
				}
				//delete any other uploaded image
				$this->file_model->delete_file($testimonial_path."\\".$image, $testimonial_path);
				
				//delete any other uploaded thumbnail
				$this->file_model->delete_file($testimonial_path."\\thumbnail_".$image, $testimonial_path);
			}
			//Upload image
			$response = $this->file_model->upload_file($testimonial_path, 'testimonial_image', $resize, 'height');
			if($response['check'])
			{
				$file_name = $response['file_name'];
				$thumb_name = $response['thumb_name'];
				
				//crop file to 1920 by 1010
				$response_crop = $this->file_model->crop_file($testimonial_path."\\".$file_name, $resize['width'], $resize['height']);
				
				if(!$response_crop)
				{
					$this->session->set_userdata('testimonial_error_message', $response_crop);
				
					return FALSE;
				}
				
				else
				{
					//Set sessions for the image details
					$this->session->set_userdata('testimonial_file_name', $file_name);
					$this->session->set_userdata('testimonial_thumb_name', $thumb_name);
				
					return TRUE;
				}
			}
		
			else
			{
				$this->session->set_userdata('testimonial_error_message', $response['error']);
				
				return FALSE;
			}
		}
		
		else
		{
			$this->session->set_userdata('testimonial_error_message', '');
			return FALSE;
		}
	}
	
	public function get_all_testimonials($table, $where, $per_page, $page)
	{
		//retrieve all testimonials
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('testimonial.testimonial_name');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Delete an existing testimonial
	*	@param int $testimonial_id
	*
	*/
	public function delete_testimonial($testimonial_id)
	{
		if($this->db->delete('testimonial', array('testimonial_id' => $testimonial_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated testimonial
	*	@param int $testimonial_id
	*
	*/
	public function activate_testimonial($testimonial_id)
	{
		$data = array(
				'testimonial_status' => 1
			);
		$this->db->where('testimonial_id', $testimonial_id);
		
		if($this->db->update('testimonial', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated testimonial
	*	@param int $testimonial_id
	*
	*/
	public function deactivate_testimonial($testimonial_id)
	{
		$data = array(
				'testimonial_status' => 0
			);
		$this->db->where('testimonial_id', $testimonial_id);
		
		if($this->db->update('testimonial', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	public function get_active_testimonials()
	{
  		$table = "testimonial";
		$where = "testimonial_status = 1";
		
		$this->db->where($where);
		$query = $this->db->get($table);
		
		return $query;
	}
	public function save_testimonial_file($testimonial_id,$image, $thumb)
	{
		//save the image data to the database
		$data = array(
			'testimonial_gallery_image_name' => $image,
			'testimonial_gallery_image_thumb' => $thumb,
			'testimonial_id' => $testimonial_id,
			'testimonial_gallery_status' => 1
		);
		
		if($this->db->insert('testimonial_gallery', $data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return FALSE;
		}
	}

	public function get_active_services($department_id = NULL)
	{
  		$table = "service";
  		if($department_id != NULL)
  		{
  			$where = "service_status = 1 AND department_id =".$department_id;
  		}
		else
		{
			$where = "service_status = 1";
		}
		
		$this->db->where($where);
		$query = $this->db->get($table);
		
		return $query;
	}
}
