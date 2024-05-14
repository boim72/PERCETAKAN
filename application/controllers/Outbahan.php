<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Outbahan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        chek_role();
        $this->load->model('Model_outbahan');
        $this->load->model('Model_bahan');
    }

    public function index()
    {
        $data['outbahan'] = $this->Model_outbahan->get_all_outbahan();
        $data['bahan'] = $this->Model_bahan->get_all_bahan();

        $this->template->load('template/template', 'Outbahan/lihat_data', $data);
        $this->load->view('template/datatables');
    }

    public function get_jumlah_bahan()
    {
        $id_bahan = $this->input->post('id_bahan');
        $jumlah_bahan = $this->Model_bahan->get_one($id_bahan)->row_array()['jumlah'];

        // Kembalikan nilai dalam format JSON
        echo json_encode(array('jumlah' => $jumlah_bahan));
    }

    function post()
    {
    
        if (isset($_POST["submit"])) {
                $id = $this->input->post('id_outbahan');
                $id_bahan = $this->input->post('id_bahan');
                $out_jumlah = $this->input->post('out_jumlah');
                $data = array(
                'out_tanggal' => $this->input->post('out_tanggal'),
                'id_bahan' => $id_bahan,
                'out_jumlah' => $out_jumlah,
                );
                $this->Model_outbahan->post($data, $id);

                // Ambil jumlah bahan yang sudah ada
                    $bahan = $this->Model_bahan->get_one($id_bahan)->row_array();
                    $jumlah_awal= $bahan['jumlah'];
                    // Hitung jumlah baru
                    $jumlah_baru = $jumlah_awal - $out_jumlah;
                // update stok bahan 
                $this->db->where('id_bahan', $id_bahan)
                ->update('bahan', array('jumlah'=> $jumlah_baru));
                $this->session->set_flashdata('message', 'Data Barang berhasil ditambahkan!');
                redirect('outbahan');
            }
         else {
            $id = $this->uri->segment(3);
            $data['error'] = $this->upload->display_errors();
            $data['bahan'] = $this->Model_bahan->get_all_bahan();
            $this->load->model("Model_outbahan");
            $this->template->load("template/template", "outbahan/form_input", $data);
        }
    }


    function edit()
    {
        if (isset($_POST['submit'])) {
                $id = $this->input->post('id_outbahan');
                $id_bahan = $this->input->post('id_bahan');
                $out_jumlah = $this->input->post('out_jumlah');
                $data = array(
                  'out_tanggal' => $this->input->post('out_tanggal'),
                'id_bahan' => $id_bahan,
                'out_jumlah' => $out_jumlah,
                );
                
                

                // perubahan jumlah bahan masuk
                $outbahan = $this->Model_outbahan->get_one($id)->row_array();
                $outjumlah_awal = $outbahan['out_jumlah'];
                $hasil =  $outjumlah_awal - $out_jumlah;
                // update stok bahan 
                $bahan = $this->Model_bahan->get_one($id_bahan)->row_array();
                $jumlah_awal = $bahan['jumlah'];
                $jumlah_baru = $jumlah_awal + $hasil;
                // query update jumlah bahan 
                $this->db->where('id_bahan', $id_bahan);
                $this->db->update('bahan',array('jumlah' => $jumlah_baru));

                // update data outbahan 
                $this->db->where('id_outbahan', $id);
                $this->db->update('outbahan', $data);
                

                $this->session->set_flashdata('message', 'Data Bahan berhasil dirubah!');
                redirect('outbahan');
            }
         else {
            $id = $this->uri->segment(3);
            $this->load->model('Model_outbahan');
            $data['record'] = $this->Model_outbahan->get_one($id)->row_array();
            $data['bahan'] = $this->Model_bahan->get_all_bahan();
            $this->template->load('template/template', 'outbahan/form_edit', $data);
        }
    }



    public function hapus($id)
    {
        $id = $this->uri->segment(3);
        
        // Mengambil data jumlah masuk dari outbahan yang dihapus
         $outbahan = $this->Model_outbahan->get_one($id)->row_array();
         $jumlah_keluar = $outbahan['out_jumlah'];
         $id_bahan = $outbahan['id_bahan'];

         // Mengambil data jumlah pada tabel bahan
         $bahan = $this->Model_bahan->get_one($id_bahan)->row_array();
         $jumlah = $bahan['jumlah'];
         // hitung 
         $hasil = $jumlah + $jumlah_keluar;
         // update data bahan 
         $this->db->where('id_bahan', $id_bahan)
          ->update('bahan', array('jumlah' => $hasil));


        $this->Model_outbahan->delete($id);
 
        $this->session->set_flashdata('message', 'Data Bahan berhasil dihapus!');

        // Redirect kembali ke halaman utama
        redirect('outbahan');
    }
}
