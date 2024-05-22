<?php

class Model_lapbulanan extends Ci_Model
{
    function lihat_data () {
        return $this->db->select('barang.nama_barang, barang.harga, barang.jumlah_barang, 
        pembayaran.id_byr, pembayaran.metode,
        barang_rusak.jumlah_rusak,
        detail_penjualan.grand_total', 'detail_penjualan.tgl_trf', 'detail_penjualan.nama_pelanggan')
        ->from('detail_penjualan')
        ->join('barang', 'barang.id_barang = detail_penjualan.id_barang', 'left')
        ->join('barang_rusak', 'barang_rusak.id_barang = detail_penjualan.id_barang', 'left')
        ->join('pembayaran', 'pembayaran.id_byr = detail_penjualan.id_pembayaran', 'left')
        ->order_by('detail_penjualan.id', 'ASC')
        ->get();
    }
    public function get_filtered_data($start, $end, $metode) {
        $this->db->select('barang.nama_barang, barang.harga, barang.jumlah_barang, pembayaran.id_byr, pembayaran.metode, barang_rusak.jumlah_rusak, detail_penjualan.grand_total, detail_penjualan.tgl_trf, detail_penjualan.nama_pelanggan');
        $this->db->from('detail_penjualan');
        $this->db->join('barang', 'barang.id_barang = detail_penjualan.id_barang', 'left');
        $this->db->join('barang_rusak', 'barang_rusak.id_barang = detail_penjualan.id_barang', 'left');
        $this->db->join('pembayaran', 'pembayaran.id_byr = detail_penjualan.id_pembayaran', 'left');
        // $this->db->join('penjualan', 'penjualan.id_barang = barang.id_barang', 'left');
        $this->db->where('detail_penjualan.tgl_trf >=', $start);
        $this->db->where('detail_penjualan.tgl_trf <=', $end);

        if (!empty($metode)) {
            $this->db->where('detail_penjualan.id_pembayaran', $metode);
        }

        $this->db->order_by('detail_penjualan.id', 'ASC');
        return $this->db->get()->result();
    }
    // function get_range($start, $end, $metode)
    // {
    //     if ($metode != '') {
    //         return $this->db->join('penjualan', 'penjualan.id_dtlpen = detail_penjualan.id', 'left')
    //             ->join('barang', 'barang.id_barang = penjualan.id_barang', 'left')
    //             ->join('pembayaran', ' detail_penjualan.id_pembayaran = pembayaran.id_byr ', 'inner')
    //             ->where("tgl_trf >=", $start)
    //             ->where("tgl_trf <=", $end)
    //             ->where('id_pembayaran', $metode)
    //             ->group_by('detail_penjualan.no_trf')
    //             ->distinct()
    //             ->order_by('detail_penjualan.id', 'ASC')
    //             ->get('detail_penjualan')->result();
    //     } else {
    //         return $this->db->join('penjualan', 'penjualan.id_dtlpen = detail_penjualan.id', 'left')
    //             ->join('barang', 'barang.id_barang = penjualan.id_barang', 'left')
    //             ->join('pembayaran', ' detail_penjualan.id_pembayaran = pembayaran.id_byr ', 'inner')
    //             ->where("tgl_trf >=", $start)
    //             ->where("tgl_trf <=", $end)
    //             ->group_by('detail_penjualan.no_trf')
    //             ->distinct()
    //             ->order_by('detail_penjualan.id', 'ASC')
    //             ->get('detail_penjualan')->result();
    //     }
    // }

   public function bulanan($thn)
    {
        $result = $this->db->select('detail_penjualan.tgl_trf,detail_penjualan.sum(grand_total) as gtotal')
            ->from('detail_penjualan')
            ->where('YEAR(tgl_trf)', $thn)
            ->group_by('MONTH(tgl_trf)')
            ->get();

        if ($result) {
            return $result->result_array();
        } else {
            return array(); // Atau sesuaikan dengan tindakan yang sesuai jika query tidak berhasil
        }
    }

    public function income()
    {
        return $this->db->select('sum(grand_total) as gtotal')
            ->from('detail_penjualan')
            ->where('month(tgl_trf) = month(CURRENT_date())')
            ->get()
            ->row();
    }

    public function total_penjualan()
    {
        return $this->db->select('sum(jumlah_stok) as total')
            ->join('detail_penjualan', 'detail_penjualan.id = penjualan.id_dtlpen', 'left')
            ->where('month(detail_penjualan.tgl_trf) = month(CURRENT_date())')
            ->from('penjualan')->get()->row();
    }

    public function total_transaksi()
    {
        return $this->db->select('count(id) as total')
            ->where('month(tgl_trf) = month(CURRENT_date())')
            ->from('detail_penjualan')->get()->row();
    }

    public function total_barang()
    {
        return $this->db->select('sum(jumlah_stok) as total')
            ->from('penjualan')->get()->row();
    }
    public function barang_laris()
    {
        $query =  $this->db->select('barang.nama_barang,sum(jumlah_stok) as total,barang.foto,detail_penjualan.tgl_trf')
            ->from('penjualan')
            ->join('barang', 'barang.id_barang = penjualan.id_barang', 'left')
            ->join('detail_penjualan', 'detail_penjualan.id = penjualan.id_dtlpen', 'left')
            ->group_by('barang.nama_barang')
            ->order_by('total', 'ASC')
            ->where(    'month(detail_penjualan.tgl_trf) = month(CURRENT_date())')
            ->limit('1')
            ->get();
        // if ($query->num_rows() > 0) {
        //     return $query->row();
        // } else {
        //     return FALSE;
        // }
    }
}
