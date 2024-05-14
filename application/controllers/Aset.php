<?php

class Aset extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        chek_role();
        $this->load->model('Model_aset');
        
    }
    function index()
    {
        $data['aset'] = $this->Model_aset->tampil_data()->result();
        $this->template->load('template/template', 'aset/lihat_data', $data);
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
            if (!$this->upload->do_upload('foto')) {
                $this->session->set_flashdata('message', $this->upload->display_errors());
                redirect($_SERVER['HTTP_REFERER']);
                return false;
            } else {
                // proses aset
                $id = $this->input->post('id');
                $nama = $this->input->post('nama_aset');
                $kategori = $this->input->post('nama_kategori');
                $harga = $this->input->post('harga');
                $foto = $this->upload->data('file_name');
                $data = array(
                    'nama_aset' => $nama,
                    'nama_kategori' => $kategori,
                    'harga' => $harga,
                    'foto' => $foto,
                );
                $this->Model_aset->post($data, $id);
                $this->session->set_flashdata('message', 'Data aset berhasil ditambahkan!');
                redirect('aset');
            }
        } else {
            $id = $this->uri->segment(3);
            $data['error'] = $this->upload->display_errors();
            
          
            $data['aset'] = $this->Model_aset->get_one($id)->row_array();
           
            $this->template->load("template/template", "aset/form_input", $data);
        }
    }


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
            if (!$this->upload->do_upload('foto')) {
                $this->session->set_flashdata('message', $this->upload->display_errors());
                redirect($_SERVER['HTTP_REFERER']);
                return false;
            } else {
                $id         =   $this->input->post('id');
                $foto = $this->Model_aset->get_one($id)->row_array()['foto'];
                $path = $this->upload->data('file_path');
                $uploads = $path . $foto;
                if (unlink($uploads)) {
                    echo 'deleted successfully';
                } else {
                    echo 'errors occured';
                }
                $nama       =   $this->input->post('nama_aset');
                $kategori   =   $this->input->post('nama_kategori');
                $harga      =   $this->input->post('harga');
                
                $foto = $this->upload->data('file_name');
                $data       = array(
                    'nama_aset' => $nama,
                    'nama_kategori' => $kategori,
                    
                    'harga' => $harga,
                    'foto' => $foto,
                );
                $this->Model_aset->edit($data, $id);
                $this->session->set_flashdata('message', 'Data aset berhasil dirubah!');
                redirect('aset');
            }
        } else {
            $id =  $this->uri->segment(3);
           
            $data['aset']     =  $this->Model_aset->get_one($id)->row_array();
            
            $this->template->load('template/template', 'aset/form_edit', $data);
        }
    }
    function hapus()
    {
        $id = $this->uri->segment(3);
        $this->Model_aset->hapus($id);
        $this->session->set_flashdata('message', 'Data aset berhasil dihapus!');
        redirect('aset');
    }

    function detail_modal($id)
    {
        $id = $this->input->get('id');
        $data['detail'] = $this->Model_aset->get_detail_modal($id);
        $this->load->view('aset/modal_detail', $data);
    }
}
