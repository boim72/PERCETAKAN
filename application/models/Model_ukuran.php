<?php
class Model_ukuran extends CI_Model {

	function tampilkan_data() {

		return 
		$this->db->get('ukuran')->result(); 
	}
		function post()
		{
			$data = array
			(
				'nama_ukuran'=> $this->input->post('nama_ukuran'),
				'harga_ukuran'=> $this->input->post('harga_ukuran')
			);
			$this->db->insert('ukuran', $data);
		}

		public function edit($id) {
			$data = array(
				'nama_ukuran' => $this->input->post('nama_ukuran'),
				'harga_ukuran' => $this->input->post('harga_ukuran')
			);

			$this->db->where('id_ukuran', $id);
			$this->db->update('ukuran', $data);
		}

		function get_one($id)
		{
			$param = array('id_ukuran'=>$id);
			return $this->db->get_where('ukuran',$param);
		}

		function hapus($id)
		{
			$this->db->where('id_ukuran', $id);
			$this->db->delete('ukuran');
		}

}