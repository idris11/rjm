<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kso extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('kso_model','kso');
	}

	public function index()
	{	
		$data['content']='daftar_kso';
		$this->load->view('template',$data);
	}

	public function ajax_list()
	{
		$list = $this->kso->get_datatables();
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $kso_param) {
			$no++;
			$row = array();
			$row[] = $kso_param->jenis_kso;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$kso_param->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$kso_param->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => @$_POST['draw'],
						"recordsTotal" => $this->kso->count_all(),
						"recordsFiltered" => $this->kso->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->kso->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'jenis_kso' => $this->input->post('jenis_kso')
			);
		$insert = $this->kso->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'jenis_kso' => $this->input->post('jenis_kso'),
			);
		$this->kso->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->kso->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('jenis_kso') == '')
		{
			$data['inputerror'][] = 'jenis_kso';
			$data['error_string'][] = 'Jenis KSO harus diisi';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}
