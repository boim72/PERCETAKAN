<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Outbahan extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_all_outbahan()
	{
		return $this->db->get('outbahan')->result();
	}

	public function get_one($id_outbahan)
	{
		return $this->db->get_where('outbahan', array('id_outbahan' => $id_outbahan));
	}

	function post($data)
	{
		$this->db->insert('outbahan', $data);
	}

	public function edit($id, $data)
	{
		$this->db->where('id_outbahan', $id);
		return $this->db->update('outbahan', $data);
	}

	public function delete($id)
	{
		return $this->db->delete('outbahan', array('id_outbahan' => $id));
	}
}
