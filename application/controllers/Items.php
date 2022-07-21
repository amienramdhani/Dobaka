<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();		
		$this->load->model('items_model', 'items');
	}

	public function add()
	{
		$this->form_validation->set_rules('name', 'items', 'required',[
			'required' => 'Items name is required.',
		]);
		$this->form_validation->set_rules('price', 'Price', 'required|numeric',[
			'required' => 'Price is required.',
			'numeric'  => 'Price must number.'
		]);
		$this->form_validation->set_rules('description', 'Description', 'required',[
			'required' => 'Description is required.',
		]);

		if($this->form_validation->run() == false) {
			$data['title']	= 'Add Items';
			$data['page']	= 'pages/items/add';
			$this->load->view('layouts/app', $data);
		}else {
			$data = [
				'name'			=> $this->input->post('name'),
				'price'			=> $this->input->post('price'),	
				'no_hp'			=> $this->input->post('no_hp'),
				'description'	=> $this->input->post('description'),
				'status'		=> 1,		
			];

			if(!empty($_FILES['image']['name'])){
				$upload = $this->items->uploadImage();	
				$data['image'] = $upload;
			}

			$this->items->insertItems($data);
			$this->session->set_flashdata('success', 'Items succesfully added,Please wait....');

			redirect(base_url('home'));
		}
	}

}

/* End of file Product.php */
