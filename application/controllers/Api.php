<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model');
		$this->load->library('form_validation');
	}

	function index()
	{
		$data = $this->api_model->fetch_all();
		echo json_encode($data->result_array());
	}

	function insert()
	{
		$this->form_validation->set_rules('id', 'id', 'required');
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('role', 'role', 'required');
		$this->form_validation->set_rules('lane', 'lane', 'required');
		$this->form_validation->set_rules('region', 'region', 'required');
		$this->form_validation->set_rules('gender', 'gender', 'required');
		$this->form_validation->set_rules('difficulty', 'difficulty', 'required');
		if($this->form_validation->run())
		{
			$data = array(
				'id'	=>	$this->input->post('id_champion'),
				'nama'	=>	$this->input->post('nama'),
				'role'		=>	$this->input->post('role'),
				'lane'		=>	$this->input->post('lane'),
				'region'		=>	$this->input->post('region'),
				'gender'		=>	$this->input->post('gender'),
				'difficulty'		=>	$this->input->post('difficulty')
			);

			$this->api_model->insert_api($data);

			$array = array(
				'success'		=>	true
			);
		}
		else
		{
			$array = array(
				'error'					=>	true,
				'id_error'		=>	form_error('id_champion'),
				'nama_error'		=>	form_error('nama'),
				'role_error'		=>	form_error('role'),
				'lane_error'		=>	form_error('lane'),
				'region_error'		=>	form_error('region'),
				'gender_error'		=>	form_error('gender'),
				'difficulty_error'		=>	form_error('difficulty')
			);
		}
		echo json_encode($array);
	}
	
	function fetch_single()
	{
		if($this->input->post('id_champion'))
		{
			$data = $this->api_model->fetch_single_user($this->input->post('id_champion'));

			foreach($data as $row)
			{
				$output['id'] = $row['id_Champion'];
				$output['nama'] = $row['nama'];
				$output['role'] = $row['role'];
				$output['lane'] = $row['lane'];
				$output['region'] = $row['region'];
				$output['gender'] = $row['gender'];
				$output['difficulty'] = $row['difficulty'];
			}
			echo json_encode($output);
		}
	}

	function update()
	{
		$this->form_validation->set_rules('nama', 'First Name', 'required');

		$this->form_validation->set_rules('role', 'Last Name', 'required');
		if($this->form_validation->run())
		{	
			$data = array(
				'id'	=>	$this->input->post('id_champion'),
				'nama'	=>	$this->input->post('nama'),
				'role'		=>	$this->input->post('role'),
				'lane'		=>	$this->input->post('lane'),
				'region'		=>	$this->input->post('region'),
				'gender'		=>	$this->input->post('gender'),
				'difficulty'		=>	$this->input->post('difficulty')
			);

			$this->api_model->update_api($this->input->post('id'), $data);

			$array = array(
				'success'		=>	true
			);
		}
		else
		{
			$array = array(
				'error'					=>	true,
				'id_error'		=>	form_error('id_champion'),
				'nama_error'		=>	form_error('nama'),
				'role_error'		=>	form_error('role'),
				'lane_error'		=>	form_error('lane'),
				'region_error'		=>	form_error('region'),
				'gender_error'		=>	form_error('gender'),
				'difficulty_error'		=>	form_error('difficulty')
			);
		}
		echo json_encode($array);
	}

	function delete()
	{
		if($this->input->post('id_champion'))
		{
			if($this->api_model->delete_single_user($this->input->post('id_champion')))
			{
				$array = array(

					'success'	=>	true
				);
			}
			else
			{
				$array = array(
					'error'		=>	true
				);
			}
			echo json_encode($array);
		}
	}

}


?>