<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bahan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        chek_role();
        $this->load->model('Model_bahan');
    }

    public function index()
    {
        $data['bahan'] = $this->Model_bahan->get_all_bahan();
        $this->template->load('template/template', 'bahan/lihat_data', $data);
        $this->load->view('template/datatables');
    }

    function post()
    {
        if (isset($_POST["submit"])) {
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 1024;
            $config['max_width']            = 6000;
            $config['max_height']           = 6000;
            $config['overwrite'] = TRUE;
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name'] = TRUE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('images')) {
                $this->session->set_flashdata('message', $this->upload->display_errors());
                redirect($_SERVER['HTTP_REFERER']);
                return false;
            } else {
                // proses barang
                $id = $this->input->post('id_bahan');
                $nama = $this->input->post('nama_bahan');
                $jumlah = $this->input->post('jumlah');
                $deskripsi = $this->input->post('deskripsi');
                $harga = $this->input->post('harga');
                $images = $this->upload->data('file_name');
                $data = array(
                    'nama_bahan' => $nama,
                    'jumlah' => $jumlah,
                    'harga' => $harga,
                    'deskripsi' => $deskripsi,
                    'images' => $images,
                );
                $this->Model_bahan->post($data, $id);
                $this->session->set_flashdata('message', 'Data Barang berhasil ditambahkan!');
                redirect('bahan');
            }
        } else {
            $id = $this->uri->segment(3);
            $data['error'] = $this->upload->display_errors();
            $this->load->model("Model_bahan");
            $this->template->load("template/template", "bahan/form_input", $data);
        }
    }

    // function edit()
    // {
    //     if (isset($_POST['submit'])) {
    //         $config['upload_path']          = './uploads/';
    //         $config['allowed_types']        = 'gif|jpg|png|jpeg';
    //         $config['max_size']             = 1024;
    //         $config['max_width']            = 6000;
    //         $config['max_height']           = 6000;
    //         $config['overwrite'] = TRUE;
    //         $config['remove_spaces'] = TRUE;
    //         $config['encrypt_name'] = TRUE;
    //         $this->upload->initialize($config);
    //         if (!$this->upload->do_upload('images')) {
    //             $this->session->set_flashdata('message', $this->upload->display_errors());
    //             redirect($_SERVER['HTTP_REFERER']);
    //             return false;
    //         } else {
    //             $id         =   $this->input->post('id_bahan');
    //             $images = $this->Model_bahan->get_one($id)->row_array()['images'];
    //             $path = $this->upload->data('file_path');
    //             $uploads = $path . $images;
    //             if (unlink($uploads)) {
    //                 echo 'deleted successfully';
    //             } else {
    //                 echo 'errors occured';
    //             }
    //             $nama       =   $this->input->post('nama_bahan');
    //             $jumlah   =   $this->input->post('jumlah');
    //             $harga      =   $this->input->post('harga');
    //             $deskripsi     =   $this->input->post('deskripsi');
    //             $images = $this->upload->data('file_name');
    //             $data       = array(
    //                 'nama_bahan' => $nama,
    //                 'id_jumlah' => $jumlah,
    //                 'deskripsi' => $deskripsi,
    //                 'harga' => $harga,
    //                 'images' => $images,
    //             );
    //             $this->Model_bahan->edit($data, $id);
    //             $this->session->set_flashdata('message', 'Data Bahan berhasil dirubah!');
    //             redirect('bahan');
    //         }
    //     } else {
    //         $id =  $this->uri->segment(3);
    //         $this->load->model('Model_bahan');
    //         $data['record']     =  $this->Model_bahan->get_one($id)->row_array();
    //         // $data['deskripsi'] = $this->Model_bahan->tampilkan_ukuran()->result();
    //         $this->template->load('template/template', 'bahan/form_edit', $data);
    //     }
    // }

function edit()
{
    if (isset($_POST['submit'])) {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 1024;
        $config['max_width']            = 6000;
        $config['max_height']           = 6000;
        $config['overwrite'] = TRUE;
        $config['remove_spaces'] = TRUE;
        $config['encrypt_name'] = TRUE;
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('images')) {
            $this->session->set_flashdata('message', $this->upload->display_errors());
            redirect($_SERVER['HTTP_REFERER']);
            return false;
        } else {
            $id = $this->input->post('id_bahan');
            $images = $this->Model_bahan->get_one($id)->row_array()['images'];
            $path = $this->upload->data('file_path');
            $uploads = $path . $images;
            if (file_exists($uploads) && unlink($uploads)) {
                echo 'deleted successfully';
            } else {
                echo 'errors occured';
            }
            $nama = $this->input->post('nama_bahan');
            $jumlah = $this->input->post('jumlah');
            $harga = $this->input->post('harga');
            $deskripsi = $this->input->post('deskripsi');
            $images = $this->upload->data('file_name');
            $data = array(
                'nama_bahan' => $nama,
                'jumlah' => $jumlah,
                'deskripsi' => $deskripsi,
                'harga' => $harga,
                'images' => $images,
            );
            $this->db->where('id_bahan', $id);
            $this->db->update('bahan', $data);
            $this->session->set_flashdata('message', 'Data Bahan berhasil dirubah!');
            redirect('bahan');
        }
    } else {
        $id = $this->uri->segment(3);
        $this->load->model('Model_bahan');
        $data['record'] = $this->Model_bahan->get_one($id)->row_array();
        $this->template->load('template/template', 'bahan/form_edit', $data);
    }
}



    public function hapus($id)
    {
         $id = $this->uri->segment(3);
        $this->Model_bahan->delete($id);
        $this->session->set_flashdata('message', 'Data Bahan berhasil dihapus!');

        // Redirect kembali ke halaman utama
        redirect('bahan');
    }
}
