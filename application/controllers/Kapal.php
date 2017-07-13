<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kapal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('kapal_model','kapal');
	}

	public function index()
	{	
		$data['content']='daftar_kapal';
		$this->load->view('template',$data);
	}

	public function ajax_list()
	{
		$list = $this->kapal->get_datatables();
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $kapal_param) {
			$no++;
			$row = array();
			$row[] = $kapal_param->kode_kapal;
			$row[] = $kapal_param->nama_kapal;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$kapal_param->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$kapal_param->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => @$_POST['draw'],
						"recordsTotal" => $this->kapal->count_all(),
						"recordsFiltered" => $this->kapal->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->kapal->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'kode_kapal' => $this->input->post('kode_kapal'),
				'nama_kapal' => $this->input->post('nama_kapal')
			);
		$insert = $this->kapal->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'kode_kapal' => $this->input->post('kode_kapal'),
				'nama_kapal' => $this->input->post('nama_kapal')
			);
		$this->kapal->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->kapal->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('kode_kapal') == '')
		{
			$data['inputerror'][] = 'kode_kapal';
			$data['error_string'][] = 'Kode kapal harus diisi';
			$data['status'] = FALSE;
		}

		if($this->input->post('nama_kapal') == '')
		{
			$data['inputerror'][] = 'nama_kapal';
			$data['error_string'][] = 'Nama kapal harus diisi';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}
