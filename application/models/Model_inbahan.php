<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_inbahan extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_all_inbahan()
	{
		return $this->db->get('inbahan')->result();
	}
	public function get_all_inbahanedit()
	{
		return $this->db->join('inbahan', 'inbahan.id_bahan = bahan.id_bahan','inner')->result();
	}

	public function get_one($id_inbahan)
	{
		return $this->db->get_where('inbahan', array('id_inbahan' => $id_inbahan));
	}

	function post($data)
	{
		$this->db->insert('inbahan', $data);
	}

	public function edit($id, $data)
	{
		$this->db->where('id_inbahan', $id);
		return $this->db->update('inbahan', $data);
	}

	public function delete($id)
	{
		return $this->db->delete('inbahan', array('id_inbahan' => $id));
	}
}
