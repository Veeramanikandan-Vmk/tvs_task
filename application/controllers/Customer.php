<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
	function __construct(){
		parent::__construct();
		isauthorized();
	}
	public function index()
	{
		$this->data['title'] = 'View Customers';
		$this->data['page'] = '/pages/customer/index';
		$this->load->view('layout/master.php',$this->data);
	}
	public function new()
	{
		$this->data['title'] = 'New Customer';
		$this->data['page'] = '/pages/customer/new_customer';
		$this->load->view('layout/master.php',$this->data);
	}
	public function edit($customerid)
	{
		$this->load->model('customer_model');
		$res = $this->customer_model->get_customer_data_by_customerid([$customerid]);
		$this->data['customerid'] = (isset($res->customer_id) ? $res->customer_id : '');
		$this->data['customername'] = (isset($res->name) ? $res->name : '' );
		$this->data['mobile'] = (isset($res->mobile) ? $res->mobile : '' );
		$this->data['email'] =  (isset($res->email) ? $res->email : '' );
		$this->data['item'] =  (isset($res->item) ? $res->item : '' );
		$this->data['value'] =  (isset($res->value) ? $res->value : '' );
		$this->data['date_time'] =  (isset($res->date_time) ? $res->date_time : '' );
		$this->data['profileimg'] = ((isset($res->profile_img) && $res->profile_img !="null")   ? base_url($res->profile_img) : 'null' );
		
		$this->data['title'] = 'Edit customer';
		$this->data['page'] = '/pages/customer/edit_customer';
		$this->load->view('layout/master.php',$this->data);
	}
	public function addcustomer()
	{
		if($this->input->method() == 'post'){
			$this->form_validation->set_rules('customername', 'Customer name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('mobile', 'Mobile Number', 'required');	
			$this->form_validation->set_rules('date_time', 'Date/Time', 'required');
			if ($this->form_validation->run() != FALSE){
				$this->load->model('customer_model');


				$profilepath = 'null';
				$this->load->library('upload');
				if(file_exists($_FILES['profileimg']['tmp_name']) && is_uploaded_file($_FILES['profileimg']['tmp_name'])){
					$config['upload_path'] = './uploads/profileimg/';
					$config['max_size']     = '100000';
					$config['allowed_types']        = 'jpg|png|jpeg';
					$this->upload->initialize($config);
					if ($this->upload->do_upload('profileimg')) {
						$res = $this->upload->data();
						$profilepath = ltrim($config['upload_path'].$res['file_name'],'.');
					} else {
						echo $this->upload->display_errors();
						return false;
					}
				}
				$data = [
					"customer_name"=>$this->input->post('customername'),
					"mobile"=>$this->input->post('mobile'),
					"email"=>$this->input->post('email'),
					"item"=>$this->input->post('item'),
					"value"=>$this->input->post('value'),
					"date_time"=>$this->input->post('date_time'),
					"profile_path"=> $profilepath,
				];

				$res = $this->customer_model->add_customer($data);
				// print_r($res);
				redirect('/customer');
			} else {
				$this->output->set_status_header(400);
				// $this->output->set_status_header(400);
				echo validation_errors(); 
				// redirect('/customer/new');
			}
		}
	}
	public function customerdeleted($id){
		$this->data['title'] = 'Customer Deleted';
		$this->data['page'] = '/pages/customer/deleted';
		$this->data['id'] = $id;
		$this->load->view('layout/master.php',$this->data);
	}
	public function updatecustomer()
	{
		if($this->input->method() == 'post'){
			$this->form_validation->set_rules('customerid', 'customerid', 'required');
			$this->form_validation->set_rules('customername', 'customer name', 'required');
			$this->form_validation->set_rules('date_time', 'Date/Time', 'required');
			$this->form_validation->set_rules('mobile', 'Mobile Number', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');

			if ($this->form_validation->run() != FALSE){
				$this->load->model('customer_model');
				
				$this->load->library('upload');

				$profilepath = 'null';
				
				if(file_exists($_FILES['profileimg']['tmp_name']) && is_uploaded_file($_FILES['profileimg']['tmp_name'])){
					$config['upload_path'] = './uploads/profileimg/';
					$config['max_size']     = '100000';
					$config['allowed_types']        = 'jpg|png|jpeg';
					$this->upload->initialize($config);
					if ($this->upload->do_upload('profileimg')) {
						$res = $this->upload->data();
						$profilepath = ltrim($config['upload_path'].$res['file_name'],'.');
					} else {
						echo $this->upload->display_errors();
						return false;
					}
				}
				
				$data = [
					"customer_id"=>$this->input->post('customerid'),
					"customer_id"=>$this->input->post('customerid'),
					"customer_name"=>$this->input->post('customername'),
					"mobile"=>$this->input->post('mobile'),
					"email"=>$this->input->post('email'),
					"item"=>$this->input->post('item'),
					"value"=>$this->input->post('value'),
					"date_time"=>$this->input->post('date_time'),
					"imagepath"=>$profilepath
				];

				$res = $this->customer_model->update_customer($data);
				print_r($res);
				redirect('/customer');
			} else {
				$this->output->set_status_header(400);
				echo validation_errors(); 
			}
		}
	}
	public function deletecustomer($customerid)
	{
		if(isset($customerid) && $customerid){
			$this->load->model('customer_model');
			
			$data = [
				"customer_id"=>$customerid,
			];

			$res = $this->customer_model->delete_customer($data);
			// print_r($res);
			redirect("/customer/customerdeleted/{$customerid}");
		}
	}
	public function undodeletecustomer($customerid)
	{
		if(isset($customerid) && $customerid){
			$this->load->model('customer_model');
			
			$data = [
				"customer_id"=>$customerid,
			];

			$res = $this->customer_model->undo_delete_customer($data);
			// print_r($res);
			redirect('/customer');
		}
	}
	public function deleteprofileimg($customerid)
	{
		if(isset($customerid) && $customerid){
			$this->load->model('customer_model');
			$res = $this->customer_model->get_customer_data_by_customerid([$customerid]);
			// $res = reset($res);
			$imgpath = FCPATH.ltrim($res->profile_img,"/");
			echo $imgpath;
			if($res->profile_img && file_exists($imgpath)){
				unlink($imgpath);
				$this->customer_model->deleteprofileimg([$customerid]);	
				echo "deleted";
			}

			// print_r($res);
			redirect('/customer/edit/'.$customerid);
		}
	}

	public function getcustomers(){
		$this->load->model('customer_model');
		$data = [
			"search"=>$this->input->get('search')['value'],
			"start"=>$this->input->get('start'),
			"end"=>$this->input->get('length'),
		];
		$draw = $this->input->get('draw');
		$total = $this->customer_model->get_total_no_customers();
		$total = $total->total;
		$recordsfiltered = $this->customer_model->get_count_filtered_customers(["search"=>$this->input->get('search')['value'],]);
		$recordsfiltered =$recordsfiltered->filteredcount;
		$res = $this->customer_model->get_customer_data($data);
		$records = [];
		foreach($res as $item){
			$img = base_url($item->profile_img);
			$editurl = base_url("/customer/edit/{$item->customer_id}");
			$deleteurl = base_url("/customer/deletecustomer/{$item->customer_id}");
			$profileimg = $item->profile_img != 'null' ? "<img style='max-width:100px;max: height 100px'src='{$img}' />": '<span>No Profile image</span>';
			$records[] = [
				$item->name,
				$profileimg,
				$item->mobile,
				$item->email,
				$item->item,
				$item->value,
				$item->date_time,
				"<a class='btn btn-warning m-1' href='{$editurl}'> Edit</a><a class='btn btn-danger m-1' href='{$deleteurl}'> Delete </a>",
			];
		}
		echo json_encode(["draw"=> $draw,
		"recordsTotal"=> $total,
		"recordsFiltered"=> $recordsfiltered,
		"data"=> $records
		]);
	}
	
}
