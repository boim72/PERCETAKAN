<?php

class Ukuran extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		chek_role();
		$this->load->model('Model_ukuran');
	}

	function index()
	{
		$data['record'] = $this->Model_ukuran->tampilkan_data();
		$this->template->load('template/template', 'Ukuran/lihat_data', $data);
		$this->load->view('template/datatables');

	}

	function post()
	{
		if (isset($_POST['submit'])) {
			//proses Ukuran
			$this->Model_ukuran->post();
			redirect('Ukuran');
		} else {
			$this->template->load('template/template', 'Ukuran/form_input');
		}
	}
	function edit()
	{
		if (isset($_POST['submit'])) {
			//proses Ukuran
			$id = $this->input->post('id');
        	$this->Model_ukuran->edit($id);
			redirect('Ukuran');
		} else {
			$id = $this->uri->segment(3);
			$data['record'] = $this->Model_ukuran->get_one($id)->row_array();
			$this->template->load('template/template','Ukuran/form_edit', $data);
		}
	}

	function hapus()
	{
		$td = $this->uri->segment(3);
		$this->Model_ukuran->hapus($td);
		redirect('Ukuran');
	}
}
