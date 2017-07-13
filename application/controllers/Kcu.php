<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kcu extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('kcu_model','kcu');
	}

	public function index()
	{	
		$this->load->model('area_model');
		$data['area']=$this->area_model->get_datatables();
		$data['content']='daftar_kcu';
		$this->load->view('template',$data);
	}

	public function ajax_list()
	{
		$list = $this->kcu->get_datatables();
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $kcu_param) {
			$no++;
			$row = array();
			$row[] = $kcu_param->nama_area;
			$row[] = $kcu_param->kode_kcu;
			$row[] = $kcu_param->nama_kcu;
			$row[] = $kcu_param->alamat;
			$row[] = $kcu_param->saldo;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$kcu_param->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$kcu_param->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => @$_POST['draw'],
						"recordsTotal" => $this->kcu->count_all(),
						"recordsFiltered" => $this->kcu->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->kcu->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'id_area' => $this->input->post('id_area'),
				'kode_kcu' => $this->input->post('kode_kcu'),
				'nama_kcu' => $this->input->post('nama_kcu'),
				'alamat' => $this->input->post('alamat'),
				'saldo' => $this->input->post('saldo')
			);
		$insert = $this->kcu->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'id_area' => $this->input->post('id_area'),
				'kode_kcu' => $this->input->post('kode_kcu'),
				'nama_kcu' => $this->input->post('nama_kcu'),
				'alamat' => $this->input->post('alamat'),
				'saldo' => $this->input->post('saldo')
			);
		$this->kcu->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->kcu->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('id_area') == '')
		{
			$data['inputerror'][] = 'id_area';
			$data['error_string'][] = 'Area harus diisi';
			$data['status'] = FALSE;
		}

		if($this->input->post('kode_kcu') == '')
		{
			$data['inputerror'][] = 'kode_kcu';
			$data['error_string'][] = 'Kode KCU harus diisi';
			$data['status'] = FALSE;
		}

		if($this->input->post('nama_kcu') == '')
		{
			$data['inputerror'][] = 'nama_kcu';
			$data['error_string'][] = 'Nama KCU harus diisi';
			$data['status'] = FALSE;
		}

		if($this->input->post('alamat') == '')
		{
			$data['inputerror'][] = 'alamat';
			$data['error_string'][] = 'Alamat KCU harus diisi';
			$data['status'] = FALSE;
		}

		if($this->input->post('saldo') == '')
		{
			$data['inputerror'][] = 'saldo';
			$data['error_string'][] = 'Saldo KCU harus diisi';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}
