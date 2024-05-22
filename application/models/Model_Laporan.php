<?php

class Model_Laporan extends CI_Model
{

    function get_data()
    {
        return
            $this->db
            ->join('penjualan', 'penjualan.id_dtlpen = detail_penjualan.id', 'left')
            ->join('barang', 'barang.id_barang = penjualan.id_barang', 'left')
            ->join('pembayaran', ' detail_penjualan.id_pembayaran = pembayaran.id_byr ', 'inner')
            ->group_by('detail_penjualan.no_trf')
            ->distinct()
            ->order_by('detail_penjualan.id', 'ASC')
            ->get('detail_penjualan');
            if ($result) {
            return $result->result_array();
            } else {
                return array(); // Atau sesuaikan dengan tindakan yang sesuai jika query tidak berhasil
            }
    }
    function lihat_data () {
        return $this->db->select('barang.nama_barang, barang.harga, barang.jumlah_barang, 
        pembayaran.id_byr,  pembayaran.metode, 
        detail_penjualan.grand_total', 'detail_penjualan.tgl_trf', 'detail_penjualan.jam_trf', 'detail_penjualan.nama_pelanggan', 'detail_penjualan.no_trf', 'detail_penjualan.id')
        ->from('detail_penjualan')
        ->join('barang', 'barang.id_barang = detail_penjualan.id_barang', 'left')
        ->join('pembayaran', 'pembayaran.id_byr = detail_penjualan.id_pembayaran', 'left')
        ->join('penjualan', 'penjualan.id_dtlpen = detail_penjualan.id', 'left')
        ->order_by('detail_penjualan.id', 'ASC')
        ->get();
    }

    function get_metode()
    {
        return $this->db->get('pembayaran')->result();
    }


    public function get_range($start, $end, $metode) {
        $this->db->select('barang.nama_barang, barang.harga, barang.jumlah_barang, 
                           pembayaran.id_byr, pembayaran.metode, 
                           detail_penjualan.grand_total, detail_penjualan.tgl_trf, 
                           detail_penjualan.jam_trf, detail_penjualan.nama_pelanggan, 
                           detail_penjualan.no_trf, detail_penjualan.id')
                 ->from('detail_penjualan')
                 ->join('barang', 'barang.id_barang = detail_penjualan.id_barang', 'left')
                 ->join('pembayaran', 'pembayaran.id_byr = detail_penjualan.id_pembayaran', 'left')
                 ->join('penjualan', 'penjualan.id_dtlpen = detail_penjualan.id', 'left')
                 ->where('detail_penjualan.tgl_trf >=', $start)
                 ->where('detail_penjualan.tgl_trf <=', $end);

        if (!empty($metode)) {
            $this->db->where('pembayaran.id_byr', $metode);
        }

        $this->db->order_by('detail_penjualan.id', 'ASC');
        
        return $this->db->get()->result();
    }

    function hapus_trf($id)
    {
        $this->db->where('id', $id)->delete('detail_penjualan');
    }
    function hapus_id($id)
    {
        $this->db->where('id_dtlpen', $id)->delete('penjualan');
    }
}
