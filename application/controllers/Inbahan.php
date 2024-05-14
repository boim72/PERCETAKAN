<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inbahan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        chek_role();
        $this->load->model('Model_inbahan');
        $this->load->model('Model_bahan');
    }

    public function index()
    {
        $data['inbahan'] = $this->Model_inbahan->get_all_inbahan();
        $data['bahan'] = $this->Model_bahan->get_all_bahan();

        $this->template->load('template/template', 'Inbahan/lihat_data', $data);
        $this->load->view('template/datatables');
    }

    function post()
    {
        if (isset($_POST["submit"])) {
                $id = $this->input->post('id_inbahan');
                $id_bahan = $this->input->post('id_bahan');
                $in_jumlah = $this->input->post('in_jumlah');
                $data = array(
                'in_tanggal' => $this->input->post('in_tanggal'),
                'id_bahan' => $id_bahan,
                'in_jumlah' => $in_jumlah,
                'in_harga' => $this->input->post('in_harga'),
                );
                $this->Model_inbahan->post($data, $id);

                // Ambil jumlah bahan yang sudah ada
                    $bahan = $this->Model_bahan->get_one($id_bahan)->row_array();
                    $jumlah_awal= $bahan['jumlah'];
                    // Hitung jumlah baru
                    $jumlah_baru = $jumlah_awal + $in_jumlah;
                // update stok bahan 
                $this->db->where('id_bahan', $id_bahan)
                ->update('bahan', array('jumlah'=> $jumlah_baru));
                $this->session->set_flashdata('message', 'Data Barang berhasil ditambahkan!');
                redirect('inbahan');
            }
         else {
            $id = $this->uri->segment(3);
            $data['error'] = $this->upload->display_errors();
            $data['bahan'] = $this->Model_bahan->get_all_bahan();
            $this->load->model("Model_inbahan");
            $this->template->load("template/template", "inbahan/form_input", $data);
        }
    }

//    function edit()
//     {
//         if (isset($_POST["submit"])) {
//                 $id = $this->input->post('id_inbahan');
//                 $id_bahan = $this->input->post('id_bahan');
//                 $in_jumlah = $this->input->post('in_jumlah');
//                 $data = array(
//                 'in_tanggal' => $this->input->post('in_tanggal'),
//                 'id_bahan' => $id_bahan,
//                 'in_jumlah' => $in_jumlah,
//                 'in_harga' => $this->input->post('in_harga'),
//                 );
//                 $this->Model_inbahan->edit($data, $id);

//                 // Ambil jumlah bahan yang sudah ada
//                     $bahan = $this->Model_bahan->get_one($id_bahan)->row_array();
//                     $jumlah_awal= $bahan['jumlah'];
//                     // Hitung jumlah baru
//                     $jumlah_baru = $jumlah_awal + $in_jumlah;
//                 // update stok bahan 
//                 $this->db->where('id_bahan', $id_bahan)
//                 ->update('bahan', array('jumlah'=> $jumlah_baru));
//                 $this->session->set_flashdata('message', 'Data Barang berhasil ditambahkan!');
//                 redirect('inbahan');
//             }
//          else {
//              $id = $this->uri->segment(3);
//              $this->load->model("Model_inbahan");
//             $data['error'] = $this->upload->display_errors();
//             $data['record'] = $this->Model_inbahan->get_one($id)->row_array();
//             $data['bahan'] = $this->Model_bahan->get_all_bahan();

//             $this->template->load("template/template", "inbahan/form_input", $data);
//         }
//     }

    function edit()
    {
        if (isset($_POST['submit'])) {
                $id = $this->input->post('id_inbahan');
                $id_bahan = $this->input->post('id_bahan');
                $in_jumlah = $this->input->post('in_jumlah');
                $data = array(
                  'in_tanggal' => $this->input->post('in_tanggal'),
                'id_bahan' => $id_bahan,
                'in_jumlah' => $in_jumlah,
                'in_harga' => $this->input->post('in_harga'),
                );
                $this->db->where('id_inbahan', $id);
                $this->db->update('inbahan', $data);

                // perubahan jumlah bahan masuk
                $injumlah_awal = $this->Model_inbahan->get_one($id)->row_array()['in_jumlah'];
                $hasil = $in_jumlah - $injumlah_awal;
                // update stok bahan 
                $jumlah_awal = $this->Model_bahan->get_one($id_bahan)->row_array()['jumlah'];
                $jumlah_baru = $jumlah_awal + $hasil;
                // query update 
                $this->db->where('id_bahan', $id_bahan)
                ->update('bahan',array('jumlah' => $jumlah_baru));
                $this->session->set_flashdata('message', 'Data Bahan berhasil dirubah!');
                redirect('inbahan');
            }
         else {
            $id = $this->uri->segment(3);
            $this->load->model('Model_inbahan');
            $data['record'] = $this->Model_inbahan->get_one($id)->row_array();
             $data['bahan'] = $this->Model_bahan->get_all_bahan();
            $this->template->load('template/template', 'inbahan/form_edit', $data);
        }
    }



    public function hapus($id)
    {
        $id = $this->uri->segment(3);
        
        // Mengambil data jumlah masuk dari inbahan yang dihapus
         $inbahan = $this->Model_inbahan->get_one($id)->row_array();
         $jumlah_masuk = $inbahan['in_jumlah'];
         $id_bahan = $inbahan['id_bahan'];

         // Mengambil data jumlah pada tabel bahan
         $bahan = $this->Model_bahan->get_one($id_bahan)->row_array();
         $jumlah = $bahan['jumlah'];
         // hitung 
         $hasil = $jumlah - $jumlah_masuk;
         // update data bahan 
         $this->db->where('id_bahan', $id_bahan)
          ->update('bahan', array('jumlah' => $hasil));


        $this->Model_inbahan->delete($id);
 
        $this->session->set_flashdata('message', 'Data Bahan berhasil dihapus!');

        // Redirect kembali ke halaman utama
        redirect('inbahan');
    }
}
