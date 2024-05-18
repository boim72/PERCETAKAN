<?php

class Model_stok extends CI_Model{

	function tampil_data()
	{
		return $this->db
        ->join('barang', 'barang.id_barang = stok.id_barang', 'left')
        ->join('kategori', 'kategori.id_kategori = barang.id_kategori', 'left')
        ->where('stok.stok_barang !=', 0)
        ->get('stok')
        ->result();
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

	function tampil_data2(){
		return $this->db->get('stok')->result();
	}

	function post($data)
	{
		$this->db->insert('stok', $data);
	}

	function get_one($id)
	{
		$param = array ('id_stok'=>$id);
		return $this->db->get_where('stok', $param);
	}

	function edit($id,$data)
	{
		$this->db->where('id_stok', $id);
		$this->db->update('stok', $data);
	}

	function tambah_stok($id,$data)
	{
		$this->db->where('id_barang', $id);
		$this->db->update('stok', $data);
	}

	function hapus($id)
	{
		$this->db->where('id_stok', $id);
		$this->db->delete('stok');
	}
	
	function get_stok($id){
		$param = array('id_barang' => $id);
		return $this->db->get_where('stok',$param)->row();
	}
}
