<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pembayaran_model','pembayaran');
	}

	public function index()
	{	
		$data['content']='daftar_pembayaran';
		$this->load->view('template',$data);
	}

	public function ajax_list()
	{
		$list = $this->pembayaran->get_datatables();
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $pembayaran_param) {
			$no++;
			$row = array();
			$row[] = $pembayaran_param->jenis_pembayaran;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$pembayaran_param->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$pembayaran_param->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => @$_POST['draw'],
						"recordsTotal" => $this->pembayaran->count_all(),
						"recordsFiltered" => $this->pembayaran->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->pembayaran->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'jenis_pembayaran' => $this->input->post('jenis_pembayaran')
			);
		$insert = $this->pembayaran->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'jenis_pembayaran' => $this->input->post('jenis_pembayaran'),
			);
		$this->pembayaran->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->pembayaran->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('jenis_pembayaran') == '')
		{
			$data['inputerror'][] = 'jenis_pembayaran';
			$data['error_string'][] = 'Jenis pembayaran harus diisi';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}
