
<?php

class Model_aset extends CI_Model
{

	function tampil_data()
	{
		return
        $this->db->select('id_aset, nama_aset, nama_kategori, harga,foto')
        ->from('aset')
        ->get();
	}

	

	function tampil_dropdown()
	{
		return
			$this->db->select('id_aset, nama_aset')
			->from('aset')
			->get();
	}

	function post($data)
	{
		$this->db->insert('aset', $data);
	}

	function get_one($id)
	{
		$param = array('id_aset' => $id);
		return $this->db->get_where('aset', $param);
	}

	function edit($data, $id)
	{
		$this->db->where('id_aset', $id);
		$this->db->update('aset', $data);
	}

	function hapus($id)
	{
		$this->db->where('id_aset', $id);
		$this->db->delete('aset');
	}

	function get_detail_modal($id)
	{
		return $this->db->where('id_aset', $id)
			->get('aset')
			->row();
	}
}
