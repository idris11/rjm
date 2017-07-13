<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('area_model','area');
	}

	public function index()
	{	
		$data['content']='daftar_area';
		$this->load->view('template',$data);
	}

	public function ajax_list()
	{
		$list = $this->area->get_datatables();
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $area_param) {
			$no++;
			$row = array();
			$row[] = $area_param->nama_area;
			$row[] = $area_param->kode_area;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$area_param->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$area_param->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => @$_POST['draw'],
						"recordsTotal" => $this->area->count_all(),
						"recordsFiltered" => $this->area->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->area->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'nama_area' => $this->input->post('nama_area'),
				'kode_area' => $this->input->post('kode_area')
			);
		$insert = $this->area->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'nama_area' => $this->input->post('nama_area'),
				'kode_area' => $this->input->post('kode_area')
			);
		$this->area->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->area->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('nama_area') == '')
		{
			$data['inputerror'][] = 'nama_area';
			$data['error_string'][] = 'Nama area harus diisi';
			$data['status'] = FALSE;
		}

		if($this->input->post('kode_area') == '')
		{
			$data['inputerror'][] = 'kode_area';
			$data['error_string'][] = 'Kode area harus diisi';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}
