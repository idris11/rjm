<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('coa_model','coa');
	}

	public function index()
	{	
		$data['content']='daftar_coa';
		$this->load->view('template',$data);
	}

	public function ajax_list()
	{
		$list = $this->coa->get_datatables();
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $coa_param) {
			$no++;
			$row = array();
			$row[] = $coa_param->coa;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$coa_param->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$coa_param->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => @$_POST['draw'],
						"recordsTotal" => $this->coa->count_all(),
						"recordsFiltered" => $this->coa->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->coa->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'coa' => $this->input->post('coa')
			);
		$insert = $this->coa->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'coa' => $this->input->post('coa'),
			);
		$this->coa->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->coa->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('coa') == '')
		{
			$data['inputerror'][] = 'coa';
			$data['error_string'][] = 'COA harus diisi';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}
