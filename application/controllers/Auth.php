<?php
class Auth extends CI_controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Model_operator');
	}

	function login()
	{

		if (isset($_POST['submit'])) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$hasil	= $this->Model_operator->login($username, $password);
			$foto	= $this->Model_operator->ambil_foto($username, $password);
			if ($hasil == TRUE) {
				$this->db->where('username', $username);
				$this->db->update('operator', array('last_login' => date('Y-m-d')));
				$this->session->set_userdata(array(
					'id' => $hasil->row()->id_operator,
					'status_login' => 'oke',
					'username' => $hasil->row()->username,
					'akses' => $hasil->row()->id_akses,
					'foto' => $foto->foto,
				));
				redirect('Dashboard');
			} else {
				$this->session->set_flashdata('message_name', 'Username atau Password salah!!');
				redirect('Auth/login');
			}
		} else {
			$this->load->view('form_login');
			// $this->load->view('Landingpage/index');
		}
	}

	function Register() {
		if (isset($_POST["submit"])) {
		// $id = $this->input->post('id_operator');
		$nama_operator = $this->input->post('nama_operator');
		$nomor_telp = $this->input->post('nomor_telp');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$id_akses = $this->input->post('id_akses');
			$data = array(
				'nama_operator' => $nama_operator,
				'nomor_telp ' => $nomor_telp,
				'username' => $username,
				'password' => md5($password),
				'id_akses' => $id_akses,
			);
		 $this->load->model('model_operator');
		$this->model_operator->post($data);
		$this->session->set_flashdata('message','Akun Berhasil di buat Silahkan Login');
		redirect('Auth/login');
		} else {
			$this->load->view('form_register');
			 $id = $this->uri->segment(3);
            $data['error'] = $this->upload->display_errors();
		}
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect('Auth/login');
	}
}
