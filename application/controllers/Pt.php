<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pt extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pt_model','pt');
	}

	public function index()
	{	
		$data['content']='daftar_pt';
		$this->load->view('template',$data);
	}

	public function ajax_list()
	{
		$list = $this->pt->get_datatables();
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $pt_param) {
			$no++;
			$row = array();
			$row[] = $pt_param->nama_pt;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$pt_param->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$pt_param->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => @$_POST['draw'],
						"recordsTotal" => $this->pt->count_all(),
						"recordsFiltered" => $this->pt->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->pt->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'nama_pt' => $this->input->post('nama_pt')
			);
		$insert = $this->pt->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'nama_pt' => $this->input->post('nama_pt')
			);
		$this->pt->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->pt->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('nama_pt') == '')
		{
			$data['inputerror'][] = 'nama_pt';
			$data['error_string'][] = 'Nama PT harus diisi';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}
