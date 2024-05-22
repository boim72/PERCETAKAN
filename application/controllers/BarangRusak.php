<?php

class BarangRusak extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_barang');
        $this->load->model('Model_kategori');
        $this->load->model('Model_barangrusak');
    }


    function index()
    {
        $data['rusak'] = $this->Model_barangrusak->tampil_data();
        $this->template->load('template/template', 'BarangRusak/lihat_data', $data);
        $this->load->view('template/datatables');
    }

    function post()
    {
        if (isset($_POST["submit"])) {
                $id = $this->input->post('id_rusak');
                $data = array(
                    'id_barang' => $this->input->post('id_barang'),
                    'jumlah_rusak' => $this->input->post('jumlah_rusak'),
                    'tanggal_rusak' => date('Y-m-d')
                );
                $this->Model_barangrusak->post($data, $id);
                redirect('BarangRusak');
            } else {
            $id = $this->uri->segment(3);
           $this->load->model("Model_barangrusak");
            $data['barang'] =  $this->Model_barang->tampil_dropdown()->result();
            $this->template->load("template/template", "BarangRusak/form_input", $data);
        }
    }

    function edit()
    {
        if (isset($_POST['submit'])) {
            
                $id = $this->input->post('id_rusak');
                $data       =   array(
                    'id_barang' => $this->input->post('id_barang'),
                    'jumlah_rusak' => $this->input->post('jumlah_rusak')
                );
                $this->Model_barangrusak->edit($id, $data);
                redirect('BarangRusak');
            } else {
            $id =  $this->uri->segment(3);
            $data['barang'] =  $this->Model_barang->tampil_dropdown()->result();
            $data['rusak']   =  $this->Model_barangrusak->get_one($id)->row_array();
            $this->template->load('template/template', 'BarangRusak/form_edit', $data);
        }
    }

    function hapus()
    {
        $id = $this->uri->segment(3);
        $this->Model_stok->hapus($id);
        redirect('stok');
    }
}
