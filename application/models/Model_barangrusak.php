<?php

class Model_barangrusak extends CI_Model{

	function tampil_data()
	{
		return $this->db
        ->join('barang', 'barang.id_barang = barang_rusak.id_barang', 'left')
        ->join('kategori', 'kategori.id_kategori = barang.id_kategori', 'left')
        ->get('barang_rusak')
        ->result();
	}
	function tampil_datarusak()
	{
		return $this->db->select('barang.nama_barang, barang.harga, barang_rusak.jumlah_rusak')
		->from('barang_rusak')
		->join('barang','barang.id_barang = barang_rusak.id_barang', 'left')
		->get()
		->result();
	}


	// function tampil_data_offline()
	// {
    //     return $this->db
    //     ->select('barang.id_barang, barang.nama_barang, kategori.nama_kategori, ukuran.nama_ukuran, barang.harga, barang.jumlah_barang, barang.foto, barang.catatan, barang.progres, barang.tanggal_barang, stok.stok_barang, stok.tanggal_stok')
    //     ->from('barang')
    //     ->join('kategori', 'kategori.id_kategori = barang.id_kategori', 'left')
    //     ->join('ukuran', 'ukuran.id_ukuran = barang.ukuran', 'left')
    //     ->join('operator', 'operator.id_operator = barang.id_operator', 'left')
	// 	->join('stok', 'stok.id_barang = barang.id_barang', 'left')
    //     ->where('operator.id_akses', 1)
    //     ->distinct()
    //     ->get();
	// }

	function tampil_data2(){
		return $this->db->get('stok')->result();
	}

	function post($data)
	{
		$this->db->insert('barang_rusak', $data);
	}

	function get_one($id)
	{
		$param = array ('id_rusak'=>$id);
		return $this->db->get_where('barang_rusak', $param);
	}

	function edit($id,$data)
	{
		$this->db->where('id_rusak', $id);
		$this->db->update('barang_rusak', $data);
	}

	function tambah_stok($id,$data)
	{
		$this->db->where('id_barang', $id);
		$this->db->update('stok', $data);
	}

	function hapus($id)
	{
		$this->db->where('id_rusak', $id);
		$this->db->delete('barang_rusak');
	}
	
	function get_stok($id){
		$param = array('id_barang' => $id);
		return $this->db->get_where('barang_rusak',$param)->row();
	}
}
