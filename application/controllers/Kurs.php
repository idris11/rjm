<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurs extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('kurs_model','kurs');
	}

	public function index()
	{	
		$data['content']='daftar_kurs';
		$this->load->view('template',$data);
	}

	public function ajax_list()
	{
		$list = $this->kurs->get_datatables();
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $kurs_param) {
			$no++;
			$row = array();
			$row[] = $kurs_param->kode_mata_uang;
			$row[] = $kurs_param->nama_mata_uang;
			$row[] = $kurs_param->nilai_mata_uang;
			$row[] = $kurs_param->nilai_tukar;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$kurs_param->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$kurs_param->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => @$_POST['draw'],
						"recordsTotal" => $this->kurs->count_all(),
						"recordsFiltered" => $this->kurs->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->kurs->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'kode_mata_uang' => $this->input->post('kode_mata_uang'),
				'nama_mata_uang' => $this->input->post('nama_mata_uang'),
				'nilai_mata_uang' => $this->input->post('nilai_mata_uang'),
				'nilai_tukar' => $this->input->post('nilai_tukar')
			);
		$insert = $this->kurs->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'kode_mata_uang' => $this->input->post('kode_mata_uang'),
				'nama_mata_uang' => $this->input->post('nama_mata_uang'),
				'nilai_mata_uang' => $this->input->post('nilai_mata_uang'),
				'nilai_tukar' => $this->input->post('nilai_tukar')
			);
		$this->kurs->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->kurs->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('nama_mata_uang') == '')
		{
			$data['inputerror'][] = 'nama_mata_uang';
			$data['error_string'][] = 'Nama mata uang harus diisi';
			$data['status'] = FALSE;
		}

		if($this->input->post('kode_mata_uang') == '')
		{
			$data['inputerror'][] = 'kode_mata_uang';
			$data['error_string'][] = 'Kode mata uang harus diisi';
			$data['status'] = FALSE;
		}

		if($this->input->post('nilai_mata_uang') == '')
		{
			$data['inputerror'][] = 'nilai_mata_uang';
			$data['error_string'][] = 'Nilai mata uang harus diisi';
			$data['status'] = FALSE;
		}

		if($this->input->post('nilai_tukar') == '')
		{
			$data['inputerror'][] = 'nilai_tukar';
			$data['error_string'][] = 'Nilai tukar harus diisi';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}
