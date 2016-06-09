<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Testimonials extends admin {
	var $testimonial_path;
	var $testimonial_location;

	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('users_model');
		$this->load->model('testimonial_model');
		$this->load->model('testimonial_model');
		$this->load->model('department_model');
		$this->load->model('file_model');
		
		$this->load->library('image_lib');
		
		//path to image directory
		$this->testimonial_path = realpath(APPPATH . '../assets/testimonial');
		$this->testimonial_location = base_url().'assets/testimonial/';
	}
    
	/*
	*
	*	Default action is to show all the registered testimonial
	*
	*/
	public function index() 
	{
		$where = 'testimonial.testimonial_status > 0';
		$table = 'testimonial';
		$segment = 3;
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'administration/all-testimonials';
		$config['total_rows'] = $this->users_model->count_items($table, $where);
		$config['uri_segment'] = $segment;
		$config['per_page'] = 20;
		$config['num_links'] = 5;
		
		$config['full_tag_open'] = '<ul class="pagination pull-right">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_tag_open'] = '<li>';
		$config['next_link'] = 'Next';
		$config['next_tag_close'] = '</span>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = 'Prev';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->testimonial_model->get_all_testimonials($table, $where, $config["per_page"], $page);
		
		if ($query->num_rows() > 0)
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$v_data['testimonial_location'] = $this->testimonial_location;
			$v_data['active_services'] = $this->testimonial_model->get_active_services(2);
			$data['content'] = $this->load->view('testimonial/all_testimonials', $v_data, true);
		}
		
		else
		{
			$data['content'] = '<a href="'.site_url().'administration/add-testimonial" class="btn btn-success pull-right">Add testimonial</a>There are no testimonials';
		}
		$data['title'] = 'All testimonials';
		
		$this->load->view('templates/general_page', $data);
	}
	
	function add_testimonial()
	{
		$v_data['testimonial_location'] = 'http://placehold.it/500x500';
		
		$this->session->unset_userdata('testimonial_error_message');
		
		//upload image if it has been selected
		$response = $this->testimonial_model->upload_testimonial_image($this->testimonial_path);
		if($response)
		{
			$v_data['testimonial_location'] = $this->testimonial_location.$this->session->userdata('testimonial_file_name');
		}
		
		//case of upload error
		else
		{
			$v_data['testimonial_error'] = $this->session->userdata('testimonial_error_message');
		}
		
		$testimonial_error = $this->session->userdata('testimonial_error_message');
		
		$this->form_validation->set_rules('testimonial_name', 'testimonial name', 'trim|xss_clean');
		// $this->form_validation->set_rules('testimonial_description', 'Description', 'xss_clean');

		if ($this->form_validation->run())
		{	
			if(empty($testimonial_error))
			{
				$data2 = array(
					'testimonial_name'=>$this->input->post("testimonial_name"),
					'testimonial_description'=>$this->input->post("testimonial_description"),
					'testimonial_status'=>1,
					'testimonial_image_name'=>$this->session->userdata('testimonial_file_name'),
					'service_id'=>$this->input->post("service_id")
				);
				
				$table = "testimonial";
				$this->db->insert($table, $data2);
				$testimonial_id = $this->db->insert_id();
				$this->session->unset_userdata('testimonial_file_name');
				$this->session->unset_userdata('testimonial_thumb_name');
				$this->session->unset_userdata('testimonial_error_message');
				$this->session->set_userdata('success_message', 'testimonial has been added');

				redirect('administration/all-testimonials');
			}
		}
		
		$testimonial = $this->session->userdata('testimonial_file_name');
		
		if(!empty($testimonial))
		{
			$v_data['testimonial_location'] = $this->testimonial_location.$this->session->userdata('testimonial_file_name');
		}
		$v_data['error'] = $testimonial_error;
		$v_data['active_services'] = $this->testimonial_model->get_active_services(2);
		
		$data['content'] = $this->load->view("testimonial/add_testimonial", $v_data, TRUE);
		$data['title'] = 'Add testimonial';
		
		$this->load->view('templates/general_page', $data);
	}
	
	function edit_testimonial($testimonial_id, $page)
	{
		//get testimonial data
		$table = "testimonial";
		$where = "testimonial_id = ".$testimonial_id;
		
		$this->db->where($where);
		$testimonials_query = $this->db->get($table);
		$testimonial_row = $testimonials_query->row();
		$v_data['testimonial_row'] = $testimonial_row;
		$v_data['testimonial_location'] = $this->testimonial_location.$testimonial_row->testimonial_image_name;
		
		$this->session->unset_userdata('testimonial_error_message');
		
		//upload image if it has been selected
		$response = $this->testimonial_model->upload_testimonial_image($this->testimonial_path, $edit = $testimonial_row->testimonial_image_name);
		if($response)
		{
			$v_data['testimonial_location'] = $this->testimonial_location.$this->session->userdata('testimonial_file_name');
		}
		
		//case of upload error
		else
		{
			$v_data['testimonial_error'] = $this->session->userdata('testimonial_error_message');
		}
		
		$testimonial_error = $this->session->userdata('testimonial_error_message');
		
		$this->form_validation->set_rules('testified_by', 'testimonial name', 'trim|xss_clean');
		// $this->form_validation->set_rules('testimonial_description', 'Description', 'trim|xss_clean');
		$this->form_validation->set_rules('service_id', 'Department', 'numeric|xss_clean');

		if ($this->form_validation->run())
		{	
			// var_dump($_POST); die();
			if(empty($testimonial_error))
			{
		
				$testimonial = $this->session->userdata('testimonial_file_name');
				
				if($testimonial == FALSE)
				{
					$testimonial = $testimonial_row->testimonial_image_name;
				}
				$data2 = array(
					'testified_by'=>$this->input->post("testified_by"),
					'testimonial_description'=>$this->input->post("testimonial_description"),
					'service_id'=> $this->input->post("service_id"),
					'testimonial_image_name'=>$testimonial
				);
				
				$table = "testimonial";
				$this->db->where('testimonial_id', $testimonial_id);
				$this->db->update($table, $data2);
				$this->session->unset_userdata('testimonial_file_name');
				$this->session->unset_userdata('testimonial_thumb_name');
				$this->session->unset_userdata('testimonial_error_message');
				$this->session->set_userdata('success_message', 'testimonial has been edited');

				redirect('administration/all-testimonials');
			}
		}
		
		$testimonial = $this->session->userdata('testimonial_file_name');
		
		if(!empty($testimonial))
		{
			$v_data['testimonial_location'] = $this->testimonial_location.$this->session->userdata('testimonial_file_name');
		}
		$v_data['error'] = $testimonial_error;
		$v_data['active_services'] = $this->testimonial_model->get_active_services();
		
		$data['content'] = $this->load->view("testimonial/edit_testimonial", $v_data, TRUE);
		$data['title'] = 'Edit testimonial';
		
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Delete an existing testimonial
	*	@param int $testimonial_id
	*
	*/
	function delete_testimonial($testimonial_id, $page)
	{
		//get testimonial data
		$table = "testimonial";
		$where = "testimonial_id = ".$testimonial_id;
		
		$this->db->where($where);
		$testimonials_query = $this->db->get($table);
		$testimonial_row = $testimonials_query->row();
		$testimonial_path = $this->testimonial_path;
		
		$image_name = $testimonial_row->testimonial_image_name;
		
		//delete any other uploaded image
		$this->file_model->delete_file($testimonial_path."\\".$image_name);
		
		//delete any other uploaded thumbnail
		$this->file_model->delete_file($testimonial_path."\\thumbnail_".$image_name);
		
		if($this->testimonial_model->delete_testimonial($testimonial_id))
		{
			$this->session->set_userdata('success_message', 'testimonial has been deleted');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'testimonial could not be deleted');
		}
		redirect('administration/all-testimonials/'.$page);
	}
    
	/*
	*
	*	Activate an existing testimonial
	*	@param int $testimonial_id
	*
	*/
	public function activate_testimonial($testimonial_id, $page)
	{
		if($this->testimonial_model->activate_testimonial($testimonial_id))
		{
			$this->session->set_userdata('success_message', 'testimonial has been activated');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'testimonial could not be activated');
		}
		redirect('administration/all-testimonials/'.$page);
	}
    
	/*
	*
	*	Deactivate an existing testimonial
	*	@param int $testimonial_id
	*
	*/
	public function deactivate_testimonial($testimonial_id, $page)
	{
		if($this->testimonial_model->deactivate_testimonial($testimonial_id))
		{
			$this->session->set_userdata('success_message', 'testimonial has been disabled');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'testimonial could not be disabled');
		}
		redirect('administration/all-testimonials/'.$page);
	}
}
?>