<?php

class Site_model extends CI_Model 
{
	public function get_slides()
	{
  		$table = "slideshow";
		$where = "slideshow_status = 1";
		
		$this->db->where($where);
		$query = $this->db->get($table);
		
		return $query;
	}

	
	public function get_services($table, $where, $limit = NULL)
	{
		$this->db->where($where);
		$this->db->select('service.*, department.department_name');
		if($limit != NULL)
		{
			$this->db->order_by('last_modified', 'RANDOM');
			$query = $this->db->get($table, $limit);
		}
		
		else
		{
			$this->db->order_by('service_name', 'ASC');
			$query = $this->db->get($table);
		}
		
		return $query;
	}
	
	public function get_departments()
	{
  		$table = "department";
		$where = "department_status = 1";
		
		$this->db->where($where);
		$this->db->order_by('department_name');
		$query = $this->db->get($table);
		
		return $query;
	}
	public function get_gallery_departments()
	{
		$name = 'Gallery';
  		$table = "department";
		$where = 'department_name LIKE \'%'.$name.'%\'';
		
		$this->db->where($where);
		$this->db->order_by('department_name');
		$query = $this->db->get($table);
		
		return $query;
	}
	public function get_gallery_items($department_id)
	{
		$table = "gallery";
		$where = "department_id =".$department_id;
		
		$this->db->where($where);
		$this->db->order_by('gallery_id');
		$query = $this->db->get($table);
		
		return $query;
	}
	public function get_gallery($limit=10)
	{
		$table = "gallery";
		$this->db->limit($limit);	
		$this->db->order_by('gallery_id','DESC');
		$query = $this->db->get($table);
		
		return $query;
	}
	
	public function get_gallery_departments_old()
	{
  		$table = "department, gallery";
		$where = "department.department_status = 1 AND gallery.department_id = department.department_id";
		
		$this->db->where($where);
		$this->db->group_by('department_name');
		$this->db->order_by('department_name');
		$query = $this->db->get($table);
		
		return $query;
	}
	
	public function get_all_gallerys($table, $where)
	{
		//retrieve all gallerys
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('department.department_name');
		$query = $this->db->get();
		
		return $query;
	}
	
	public function get_gallery_services()
	{
  		$table = "service, gallery";
		$where = "gallery.gallery_status = 1 AND service.service_status = 1 AND gallery.service_id = service.service_id";
		
		$this->db->select('DISTINCT(service.service_name), service.service_id');
		$this->db->where($where);
		$query = $this->db->get($table);
		
		return $query;
	}
	
	public function get_service($service_name)
	{
  		$table = "service";
		$where = array('service_name' => $service_name);
		
		$this->db->where($where);
		$query = $this->db->get($table);
		
		return $query;
	}
	
	public function get_jobs()
	{
  		$table = "jobs";
		$where = "job_status = 1";
		
		$this->db->where($where);
		$query = $this->db->get($table);
		
		return $query;
	}
	
	public function get_loans()
	{
  		$table = "loans";
		
		$query = $this->db->get($table);
		
		return $query;
	}
	
	public function get_contacts()
	{
  		$table = "contacts";
		
		$query = $this->db->get($table);
		$contacts = array();
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$contacts['email'] = $row->email;
			$contacts['phone'] = $row->phone;
			$contacts['facebook'] = $row->facebook;
			$contacts['twitter'] = $row->twitter;
			$contacts['linkedin'] = $row->pintrest;
			$contacts['company_name'] = $row->company_name;
			$contacts['logo'] = $row->logo;
			$contacts['address'] = $row->address;
			$contacts['city'] = $row->city;
			$contacts['post_code'] = $row->post_code;
			$contacts['building'] = $row->building;
			$contacts['floor'] = $row->floor;
			$contacts['location'] = $row->location;
			$contacts['working_weekend'] = $row->working_weekend;
			$contacts['working_weekday'] = $row->working_weekday;
			$contacts['mission'] = $row->mission;
			$contacts['vision'] = $row->vision;
			$contacts['motto'] = $row->motto;
			$contacts['about'] = $row->about;
			$contacts['objectives'] = $row->objectives;
			$contacts['core_values'] = $row->core_values;
		}
		return $contacts;
	}
	
	public function limit_text($text, $limit) 
	{
		$pieces = explode(" ", $text);
		$total_words = count($pieces);
		
		if ($total_words > $limit) 
		{
			$return = "<i>";
			$count = 0;
			for($r = 0; $r < $total_words; $r++)
			{
				$count++;
				if(($count%$limit) == 0)
				{
					$return .= $pieces[$r]."</i><br/><i>";
				}
				else{
					$return .= $pieces[$r]." ";
				}
			}
		}
		
		else{
			$return = "<i>".$text;
		}
		return $return.'</i><br/>';
    }
	
	public function get_navigation()
	{
		$page = explode("/",uri_string());
		$total = count($page);
		
		$name = strtolower($page[0]);
		
		$home = '';
		$about = '';
		$services = '';
		$academic = '';
		$alumni = '';
		$student = '';
		$blog = '';
		$contact = '';
		$gallery = '';
		
		if($name == 'home')
		{
			$home = 'current-menu-item';
		}
		
		if($name == 'about')
		{
			$about = 'current-menu-item';
		}
		
		if($name == 'services')
		{
			$services = 'current-menu-item';
		}
		
		if($academic == 'academic')
		{
			$academic = 'current-menu-item';
		}
		if($student == 'student_affairs')
		{
			$student = 'current-menu-item';
		}
		if($alumni == 'alumni')
		{
			$alumni = 'current-menu-item';
		}
		
		if($name == 'blog')
		{
			$blog = 'current-menu-item';
		}
		
		if($name == 'contact-us')
		{
			$contact = 'current-menu-item';
		}
		
		if($name == 'gallery')
		{
			$gallery = 'current-menu-item';
		}
		
		//get departments
		$query = $this->get_active_departments('Academic Courses');
		$academic_sub_menu_services = '';
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $res)
			{
				$service_name = $res->service_name;
				$web_name = $this->create_web_name($service_name);
				$academic_sub_menu_services .= '<li><a href="'.site_url().'academic-courses/'.$web_name.'">'.$service_name.'</a></li>';
			}
		}

		// service number two
		$about_query = $this->get_active_departments('About Us');
		$about_sub_menu_services = '';
		if($about_query->num_rows() > 0)
		{
			foreach($about_query->result() as $res)
			{
				$service_name = $res->service_name;
				$web_name = $this->create_web_name($service_name);
				$about_sub_menu_services .= '<li><a href="'.site_url().'about/'.$web_name.'">'.$service_name.'</a></li>';
			}
		}

		// service number two
		$alumni_query = $this->get_active_departments('Alumni');
		$alumni_sub_menu_services = '';
		if($alumni_query->num_rows() > 0)
		{
			foreach($alumni_query->result() as $res)
			{
				$service_name = $res->service_name;
				$web_name = $this->create_web_name($service_name);
				$alumni_sub_menu_services .= '<li><a href="'.site_url().'alumni/'.$web_name.'">'.$service_name.'</a></li>';
			}
		}
		
		// service number two
		$student_query = $this->get_active_departments('Student Affairs');
		$student_sub_menu_services = '';
		if($student_query->num_rows() > 0)
		{
			foreach($student_query->result() as $res)
			{
				$service_name = $res->service_name;
				$web_name = $this->create_web_name($service_name);
				$student_sub_menu_services .= '<li><a href="'.site_url().'student-affairs/'.$web_name.'">'.$service_name.'</a></li>';
			}
		}
		 // <li class="'.$alumni.'"><a href="'.site_url().'alumni">Alumni</a>
   //          	 <ul>
   //                  '.$alumni_sub_menu_services.'
   //              </ul>
   //          </li>
		$navigation = 
		'

			<li class="'.$home.'"><a href="'.site_url().'home">Home</a></li>
            <li class="'.$about.'"><a href="#">About us</a>
            	 <ul>
                   '.$about_sub_menu_services.'
                </ul>
            </li>
            <li class="'.$academic.'"><a href="#">Academic Courses</a>
            	 <ul>
                   '.$academic_sub_menu_services.'
                </ul>
            </li>
           
            <li class="'.$student.'"><a href="#">Student Affairs</a>
            	 <ul>
                    '.$student_sub_menu_services.'
                </ul>
            </li>
            <li class="'.$gallery.'"><a href="'.site_url().'gallery">Gallery</a></li>
            <li class="'.$blog.'"><a href="'.site_url().'blog">Blog</a></li>            
            <li class="'.$contact.'"><a href="'.site_url().'contact-us">Contact</a></li>

           
			
		';
		
		return $navigation;
	}
	
	public function get_navigation_footer()
	{
		$page = explode("/",uri_string());
		$total = count($page);
		
		$name = strtolower($page[0]);
		
		$home = '';
		$about = '';
		$services = '';
		$departments = '';
		$blog = '';
		$contact = '';
		$gallery = '';
		
		if($name == 'home')
		{
			$home = 'active';
		}
		
		if($name == 'about')
		{
			$about = 'active';
		}
		
		if($name == 'services')
		{
			$services = 'active';
		}
		
		if($name == 'departments')
		{
			$departments = 'active';
		}
		
		if($name == 'blog')
		{
			$blog = 'active';
		}
		
		if($name == 'contact-us')
		{
			$contact = 'active';
		}
		
		if($name == 'gallery')
		{
			$gallery = 'active';
		}
		
		$navigation = 
		'
			<li><a href="'.site_url().'home" class="'.$home.'">Home</a></li>
			<li><a href="'.site_url().'gallery" class="'.$gallery.'">Gallery</a></li>
			<li><a href="'.site_url().'blog" class="'.$blog.'">Blog</a></li>
			<li><a href="'.site_url().'contact-us" class="'.$contact.'">Contact</a></li>
			
		';
		
		return $navigation;
	}
	
	public function create_web_name($field_name)
	{
		$web_name = str_replace(" ", "-", $field_name);
		
		return $web_name;
	}
	
	public function decode_web_name($web_name)
	{
		$field_name = str_replace("-", " ", $web_name);
		
		return $field_name;
	}
	
	public function get_breadcrumbs()
	{
		$page = explode("/",uri_string());
		$total = count($page);
		$last = $total - 1;
		$crumbs = '<li><a href="'.site_url().'home">HOME </a></li>';
		
		for($r = 0; $r < $total; $r++)
		{
			$name = $this->decode_web_name($page[$r]);
			if($r == $last)
			{
				$crumbs .= '<li><i class="fa fa-angle-right"></i></li>
                        <li>'.strtoupper($name).'</li>';
			}
			else
			{
				if($total == 3)
				{
					if($r == 1)
					{
						$crumbs .= '<li><i class="fa fa-angle-right"></i></li>
                        <li><a href="'.site_url().$page[$r-1].'/'.strtolower($name).'">'.strtoupper($name).'</a></li>';
					}
					else
					{
						$crumbs .= '<li><i class="fa fa-angle-right"></i></li>
							<li><a href="'.site_url().strtolower($name).'">'.strtoupper($name).'</a></li>';
					}
				}
				else
				{
					$crumbs .= '<li><i class="fa fa-angle-right"></i></li>
                        <li><a href="'.site_url().strtolower($name).'">'.strtoupper($name).'</a></li>';
				}
			}
		}
		
		return $crumbs;
	}
	
	public function get_active_departments($service_name)
	{
  		$table = "service, department";
		$where = "department.department_status = 1 AND service.department_id = department.department_id AND department.department_name = '".$service_name."'";
		
		$this->db->select('service.*');
		$this->db->where($where);
		$this->db->group_by('service_name');
		$this->db->order_by('service_id', 'ASC');
		$query = $this->db->get($table);
		
		return $query;
	}

	public function get_service_id($service_name)
	{
		//retrieve all users
		$this->db->from('service');
		$this->db->select('service_id');
		$this->db->where('service_name', $service_name);
		$query = $this->db->get();
		$service_id = FALSE;
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$service_id = $row->service_id;
		}
		
		return $service_id;
	}
	public function get_service_details($service_id)
	{
		//retrieve all users
		$this->db->from('service,department');
		$this->db->select('service.*,department.department_name');
		$this->db->where('service_id', $service_id);
		$query = $this->db->get();
		
		
		return $query;
	}
	public function get_service_gallery($service_id = NULL)
	{
		$this->db->from('service_gallery');
		$this->db->select('*');
		if($service_id != NULL)
		{
			$this->db->where('service_id', $service_id);
		}
		
		$query = $this->db->get();
		
		
		return $query;

	}
	public function get_service_testimonial($service_id = NULL)
	{
		$this->db->from('testimonial');
		$this->db->select('*');
		if($service_id != NULL)
		{
			$this->db->where('service_id', $service_id);
		}
		
		$query = $this->db->get();
		
		
		return $query;

	}
}
?>