<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_bahan extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_all_bahan()
	{
		return $this->db->get('Bahan')->result();
	}

	public function get_one($id_bahan)
	{
		return $this->db->get_where('bahan', array('id_bahan' => $id_bahan));
	}

	function post($data)
	{
		$this->db->insert('bahan', $data);
	}

	public function edit($id, $data)
	{
		$this->db->where('id_bahan', $id);
		return $this->db->update('bahan', $data);
	}

	public function delete($id)
	{
		return $this->db->delete('bahan', array('id_bahan' => $id));
	}
}
