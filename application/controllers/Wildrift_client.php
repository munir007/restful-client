<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wildrift_client extends CI_Controller {

	function index()
	{
		$this->load->view('api_view');
	}

	function action()
	{
		if($this->input->post('data_action'))
		{
			$data_action = $this->input->post('data_action');

			if($data_action == "Delete")
			{
				$api_url = "http://localhost/wildrift-rest-client/api/delete";

				$form_data = array(
					'id'		=>	$this->input->post('id_champion')
				);

				$client = curl_init($api_url);

				curl_setopt($client, CURLOPT_POST, true);

				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

				$response = curl_exec($client);

				curl_close($client);

				echo $response;




			}

			if($data_action == "Edit")
			{
				$api_url = "http://localhost/wildrift-rest-client/api/update";

				$form_data = array(
					'id'	=>	$this->input->post('id_champion'),
					'nama'	=>	$this->input->post('nama'),
					'role'		=>	$this->input->post('role'),
					'lane'		=>	$this->input->post('lane'),
					'region'		=>	$this->input->post('region'),
					'gender'		=>	$this->input->post('gender'),
					'difficulty'		=>	$this->input->post('difficulty')
				);

				$client = curl_init($api_url);

				curl_setopt($client, CURLOPT_POST, true);

				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

				$response = curl_exec($client);

				curl_close($client);

				echo $response;







			}

			if($data_action == "fetch_single")
			{
				$api_url = "http://localhost/wildrift-rest-client/api/fetch_single";

				$form_data = array(
					'id'		=>	$this->input->post('id_champion')
				);

				$client = curl_init($api_url);

				curl_setopt($client, CURLOPT_POST, true);

				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

				$response = curl_exec($client);

				curl_close($client);

				echo $response;






			}

			if($data_action == "Insert")
			{
				$api_url = "http://localhost/wildrift-rest-client/api/insert";
			

				$form_data = array(
					'id'	=>	$this->input->post('id_champion'),
					'nama'	=>	$this->input->post('nama'),
					'role'		=>	$this->input->post('role'),
					'lane'		=>	$this->input->post('lane'),
					'region'		=>	$this->input->post('region'),
					'gender'		=>	$this->input->post('gender'),
					'difficulty'		=>	$this->input->post('difficulty')
				);

				$client = curl_init($api_url);

				curl_setopt($client, CURLOPT_POST, true);

				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

				$response = curl_exec($client);

				curl_close($client);

				echo $response;


			}





			if($data_action == "fetch_all")
			{
				$api_url = "http://localhost/wildrift-rest-client/api";

				$client = curl_init($api_url);

				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

				$response = curl_exec($client);

				curl_close($client);

				$result = json_decode($response);

				$output = '';

				if(count($result) > 0)
				{
					foreach($result as $row)
					{
						$output .= '
						<tr>
							<td>'.$row->id_champion.'</td>
							<td>'.$row->nama.'</td>
							<td>'.$row->role.'</td>
							<td>'.$row->lane.'</td>
							<td>'.$row->region.'</td>
							<td>'.$row->gender.'</td>
							<td>'.$row->difficulty.'</td>
							<td><butto type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->id_champion.'">Edit</button></td>
							<td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->id_champion.'">Delete</button></td>
						</tr>

						';
					}
				}
				else
				{
					$output .= '
					<tr>
						<td colspan="4" align="center">No Data Found</td>
					</tr>
					';
				}

				echo $output;
			}
		}
	}
	
}

?>