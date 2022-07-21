<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Items_model extends CI_Model {

	public function insertItems($data) 
	{
		$this->db->insert('barang', $data);
	}

	public function uploadImage() {
		$config = [
			'upload_path'     => './images/barang',
			'encrypt_name'    => TRUE,
			'allowed_types'   => 'jpg|jpeg|png|JPG|PNG|JPEG',
			'max_size'        => 3000,
			'max_width'       => 0,
			'max_height'      => 0,
			'overwrite'       => TRUE,
			'file_ext_tolower'=> TRUE
		];
	
		 $this->load->library('upload', $config);
		 
		if($this->upload->do_upload('image')){
			return $this->upload->data('file_name');
		}else{
			$this->session->set_flashdata('image_error', 'Uploaded file types are not permitted or the file is too large.');
			return false;
		}
	}
}

/* End of file Product_model.php */
