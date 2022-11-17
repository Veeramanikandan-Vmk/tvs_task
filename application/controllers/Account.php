<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	function __construct(){
		parent::__construct();
		// isauthorized();
	}
	public function index()
	{
		$this->login();
	}
	public function login()
	{
		$this->data['title'] = 'Login';
		$this->data['page'] = '/pages/account/login';
		$this->load->view('layout/master.php',$this->data);
	}
	public function logout()
	{
		session_destroy();
		redirect('/account/login');
	}
	public function auth()
	{
		if($this->input->method() == 'post'){
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() != FALSE)
			{
				$this->load->model('accounts_model');
				$res = $this->accounts_model->get_user_account_by_username(["username"=>$this->input->post('username')]);
				if($res && password_verify($this->input->post('password'),$res->password)){
					$this->session->set_userdata(['isloggedin'=>true,'user'=>$res]);
					$user = $this->session->userdata('user');
					// echo 'Welcome '.$user->username;
					redirect('/customer');

				} else {
					$this->output->set_status_header(400);
					redirect('/account/login');
				}
			}
			else
			{
				$this->output->set_status_header(400);
				echo validation_errors(); 
			}

		} else{
			$this->output->set_status_header(400);
			echo "BAD REQUEST";
		}
	}
}
