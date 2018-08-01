<?php

class Pages extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pages_model');
	}

	public function index()
	{
		
		$pages = $this->pages_model->get();

		$this->load->view('template/header');
		$this->load->view('pages/index', ['pages' => $pages]);
		$this->load->view('template/footer');
	}

	public function view($id)
	{
		echo "Page::view ".$id;
	}

	public function add()
	{

		$this->load->library('form_validation');

		$this->form_validation->set_rules('title', 'Título', 'required');
		$this->form_validation->set_rules('body',  'Corpo',  'required');

		if($this->form_validation->run() === FALSE){

			$this->load->view('template/header');
			$this->load->view('pages/add'      );
			$this->load->view('template/footer');

		}else{
			$data['back'] = '/pages';
			$pages = $this->pages_model->create();
			$this->load->view('template/success', $data);
			
		}

	}

}