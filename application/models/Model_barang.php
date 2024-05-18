
<?php

class Model_barang extends CI_Model
{

	function tampil_data()
	{
		return
			$this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori', 'left')
			->join('ukuran', 'ukuran.id_ukuran = barang.ukuran', 'left')
			->distinct()
			->get('barang');
	}
	function tampil_data_online()
	{
        return $this->db
        ->select('barang.id_barang, barang.nama_barang, kategori.nama_kategori, ukuran.nama_ukuran, barang.harga, barang.jumlah_barang, barang.foto, barang.catatan, barang.progres')
        ->from('barang')
        ->join('kategori', 'kategori.id_kategori = barang.id_kategori', 'left')
        ->join('ukuran', 'ukuran.id_ukuran = barang.ukuran', 'left')
        ->join('operator', 'operator.id_operator = barang.id_operator', 'left')
        ->where('operator.id_akses', 2)
        ->distinct()
        ->get();
	}
	
	function tampil_data_offline()
	{
        return $this->db
        ->select('barang.id_barang, barang.nama_barang, kategori.nama_kategori, ukuran.nama_ukuran, barang.harga, barang.jumlah_barang, barang.foto, barang.catatan, barang.progres, barang.tanggal_barang, stok.stok_barang, stok.tanggal_stok')
        ->from('barang')
        ->join('kategori', 'kategori.id_kategori = barang.id_kategori', 'left')
        ->join('ukuran', 'ukuran.id_ukuran = barang.ukuran', 'left')
        ->join('operator', 'operator.id_operator = barang.id_operator', 'left')
		->join('stok', 'stok.id_barang = barang.id_barang', 'left')
        ->where('operator.id_akses', 1)
        ->distinct()
        ->get();
	}

	function tampilkan_ukuran()
	{
		return  $this->db->get('ukuran');
	}

	function tampil_dropdown()
	{
		return
			$this->db->select('barang.id_barang, barang.nama_barang, barang.jumlah_barang', 'left')
			->from('barang')
			->join('operator', 'operator.id_operator = barang.id_operator')
			->where('operator.id_akses', 1)
			->get();
	}

	function post($data)
	{
		$this->db->insert('barang', $data);
	}
	public function get_oneuser($id_operator)
	{
		// return $this->db->get_where('barang', array('id_operator' => $id_operator));
		return
			$this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori', 'left')
			->join('ukuran', 'ukuran.id_ukuran = barang.ukuran', 'left')
			->distinct()
			->get_where('barang', array('id_operator' => $id_operator));
	}

	function get_one($id)
	{
		$param = array('id_barang' => $id);
		return $this->db->get_where('barang', $param);
	}

	function get_struck($id_barang)  {
		$param = array('id_barang' => $id_barang);
		return $this->db->get_where('detail_penjualan', $param);
		
	}

	function get_onebarang($id_barang)
	{
		$param = array('id_barang' => $id_barang);
		return $this->db->get_where('detail_penjualan', $param)->row_array();;
	}
	function edit($data, $id)
	{
		$this->db->where('id_barang', $id);
		$this->db->update('barang', $data);
	}
	function post_nota($data_nota) 
	{
		$this->db->insert('detail_penjualan', $data_nota);
	}

	function hapus($id)
	{
		$this->db->where('id_barang', $id);
		$this->db->delete('barang');
	}

	function get_detail_modal($id)
	{
		return $this->db->where('id_barang', $id)
			->get('barang')
			->row();
	}

	 function get_last_id()
	{
		$this->db->select_max('id');
		$query = $this->db->get('detail_penjualan');
		$row = $query->row_array();
		return $row['id'];
	}
	function get_last_idbarang()
	{
		$this->db->select_max('id_barang');
		$query = $this->db->get('barang');
		$row = $query->row_array();
		return $row['id_barang'];
	}
	function get_last_idout()
	{
		$this->db->select_max('id_outbarang');
		$query = $this->db->get('outbarang');
		$row = $query->row_array();
		return $row['id_outbarang'];
	}

}
