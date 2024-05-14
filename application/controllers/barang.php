<?php

class Barang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        chek_role();
        $this->load->model('Model_barang');
        $this->load->model('Model_kategori');
    }
    function index()
    {
        $id_user = $this->session->userdata('id');
        $records = $this->Model_barang->tampil_data_online()->result();
        $data['record'] = array_filter($records, function($record) {
            return $record->progres == 'verivikasi'|| $record->progres == 'Gagal';
        });
        $data['user'] = $this->Model_barang->get_oneuser($id_user)->result();
        $id = $this->session->userdata['akses'];
        $data['nota'] = $this->Model_barang->get_last_id();
        // var_dump($id_nota);
        $this->template->load('template/template', 'barang/lihat_data', $data);
        $this->load->view('template/datatables');

    }
    function index_pembayaran()
    {
         $records = $this->Model_barang->tampil_data_online()->result();
        $data['record'] = array_filter($records, function($record) {
            return $record->progres == 'Pembayaran';
        });
        $this->template->load('template/template', 'barang/lihat_data', $data);
        $this->load->view('template/datatables');

    }
    function index_offline()
    {
         $records = $this->Model_barang->tampil_data_online()->result();
        $data['record'] = array_filter($records, function($record) {
            return $record->progres == 'Berhasil';
        });
        $this->template->load('template/template', 'barang/lihat_data', $data);
        $this->load->view('template/datatables');

    }
    function index_produksi()
    {
         $records = $this->Model_barang->tampil_data_online()->result();
        $data['record'] = array_filter($records, function($record) {
            return $record->progres == 'Produksi';
        });
        $this->template->load('template/template', 'barang/lihat_data', $data);
        $this->load->view('template/datatables');

    }
    function pembayaran() 
        {
          // Ambil data dari form
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 1024;
            $config['max_width'] = 6000;
            $config['max_height'] = 6000;
            $config['overwrite'] = TRUE;
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name'] = TRUE;
            $this->upload->initialize($config);

        if (!$this->upload->do_upload('foto_payment')) {
            // Jika tidak ada foto yang diupload, gunakan foto lama
            $foto = $this->Model_barang->get_one($id)->row_array()['foto_payment'];
        } else {
            // Jika ada foto yang diupload, gunakan foto baru dan hapus foto lama
            $foto_lama = $this->Model_barang->get_one($id)->row_array()['foto_payment'];
            $path = $this->upload->data('file_path');
            $uploads = $path . $foto_lama;
            if (unlink($uploads)) {
                echo 'deleted successfully';
            } else {
                echo 'errors occured';
            }

            // Gunakan foto baru
            $foto = $this->upload->data('file_name');
        }

            $id_barang = $this->input->post('id_barang');
            $data = array(
                'foto_payment' => $foto,
             );
           
             $id_barang = $this->input->post('id_barang');

            // Ambil ID terakhir dari tabel DETAIL_PENJUALAN
            $last_id = $this->Model_barang->get_last_id();

            // Generate NO_TRANSFER
            $date = date('Ymd');
            $nomor_urut = $id_barang; // Increment dari ID barang
            $nomor_urut_format = str_pad($nomor_urut, 3, '0', STR_PAD_LEFT);
            $no_transfer = 'T' . $date . $nomor_urut_format;

            $id_nota = $this->input->post('id');
            // Tambah data nota pembayaran
            $data_nota = array(
              'no_trf' => $no_transfer,
              'nama_pelanggan' => $this->session->userdata('username'),
              'totalpure' => $this->input->post('harga'),
              'grand_total' => $this->input->post('harga'),
              'diskon' => '0',
              'bayar' => $this->input->post('harga'),
              'kembalian' => '0',
              'catatan' => 'Lunas',
              'tgl_trf' => date('Y-m-d') ,
              'jam_trf' => date('H:i:s') ,
              'id_pembayaran' => '2',
              'operator' => 'user' ,
              'id_barang' => $id_barang,
             );

            $this->Model_barang->edit($data, $id_barang);
            $pembayaran =  $this->Model_barang->get_onebarang($id_barang);
            if (!$pembayaran ) {
                $this->Model_barang->post_nota($data_nota, $id_nota);
            }

            $this->session->set_flashdata('message', ' Berhasil mengirim bukti pembayaran tunggu konfirmasi!');
            redirect('barang');
        
        } 
        function Struck($id)
         {
              $data['record'] = $this->Model_barang->get_struck($id)->row_array();

               $this->template->load('template/template', 'barang/lihat_struck', $data);
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
                // proses barang
                $id = $this->input->post('id');
                $nama = $this->input->post('nama_barang');
                $kategori = $this->input->post('kategori');
                $id_operator = $this->session->userdata('id');
                $harga = $this->input->post('harga');
                $jumlah_barang = $this->input->post('jumlah_barang');
                $ukuran = $this->input->post('ukuran');
                $foto = $this->upload->data('file_name');
                $catatan = $this->input->post('catatan');
                $progres = $this->input->post('progres');
                $data = array(
                    'nama_barang' => $nama,
                    'id_kategori' => $kategori,
                    'id_operator' => $id_operator,
                    'ukuran' => $ukuran,
                    'harga' => $harga,
                    'jumlah_barang' => $jumlah_barang,
                    'foto' => $foto,
                    'catatan' => $catatan,
                    'progres' => $progres,
                );
                $this->Model_barang->post($data, $id);
                $this->session->set_flashdata('message', 'Data Barang berhasil ditambahkan!');
                redirect('barang');
            }
        } else {
            $id = $this->uri->segment(3);
            $data['error'] = $this->upload->display_errors();
            $this->load->model("Model_kategori");
            $data['kategori'] =  $this->Model_kategori->tampilkan_data();
            $data['record'] = $this->Model_barang->get_one($id)->row_array();
            $data['ukuran'] = $this->Model_barang->tampilkan_ukuran()->result();
            $this->template->load("template/template", "barang/form_input", $data);
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
    //         if (!$this->upload->do_upload('foto')) {
    //             $this->session->set_flashdata('message', $this->upload->display_errors());
    //             redirect($_SERVER['HTTP_REFERER']);
    //             return false;
    //         }  else  {
    //             $id         =   $this->input->post('id');
    //             $foto = $this->Model_barang->get_one($id)->row_array()['foto'];
    //             $path = $this->upload->data('file_path');
    //             $uploads = $path . $foto;
    //             if (unlink($uploads)) {
    //                 echo 'deleted successfully';
    //             } else {
    //                 echo 'errors occured';
    //             }
    //             $nama       =   $this->input->post('nama_barang');
    //             $kategori   =   $this->input->post('kategori');
    //             $harga      =   $this->input->post('harga');
    //             $ukuran     =   $this->input->post('ukuran');
    //             $foto = $this->upload->data('file_name');
    //             $data       = array(
    //                 'nama_barang' => $nama,
    //                 'id_kategori' => $kategori,
    //                 'ukuran' => $ukuran,
    //                 'harga' => $harga,
    //                 'foto' => $foto,
    //             );
    //             $this->Model_barang->edit($data, $id);
    //             $this->session->set_flashdata('message', 'Data Barang berhasil dirubah!');
    //             redirect('barang');
    //         }
    //     } else {
    //         $id =  $this->uri->segment(3);
    //         $this->load->model('Model_kategori');
    //         $data['kategori']   =  $this->Model_kategori->tampilkan_data();
    //         $data['record']     =  $this->Model_barang->get_one($id)->row_array();
    //         $data['ukuran'] = $this->Model_barang->tampilkan_ukuran()->result();
    //         $this->template->load('template/template', 'barang/form_edit', $data);
    //     }
    // }

function edit()
{
    if (isset($_POST['submit'])) {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 1024;
        $config['max_width'] = 6000;
        $config['max_height'] = 6000;
        $config['overwrite'] = TRUE;
        $config['remove_spaces'] = TRUE;
        $config['encrypt_name'] = TRUE;
        $this->upload->initialize($config);

        $id = $this->input->post('id');
        $nama = $this->input->post('nama_barang');
        $kategori = $this->input->post('kategori');
        $harga = $this->input->post('harga');
        $jumlah_barang = $this->input->post('jumlah_barang');
        $ukuran = $this->input->post('ukuran');
        $progres = $this->input->post('progres');
        $catatan = $this->input->post('catatan');

        if (!$this->upload->do_upload('foto')) {
            // Jika tidak ada foto yang diupload, gunakan foto lama
            $foto = $this->Model_barang->get_one($id)->row_array()['foto'];
        } else {
            // Jika ada foto yang diupload, gunakan foto baru dan hapus foto lama
            $foto_lama = $this->Model_barang->get_one($id)->row_array()['foto'];
            $path = $this->upload->data('file_path');
            $uploads = $path . $foto_lama;
            if (unlink($uploads)) {
                echo 'deleted successfully';
            } else {
                echo 'errors occured';
            }

            // Gunakan foto baru
            $foto = $this->upload->data('file_name');
        }

        $data = array(
            'nama_barang' => $nama,
            'id_kategori' => $kategori,
            'ukuran' => $ukuran,
            'harga' => $harga,
            'jumlah_barang' => $jumlah_barang,
            'foto' => $foto,
            'progres' => $progres,
            'catatan' => $catatan,
        );
        $this->Model_barang->edit($data, $id);
        $this->session->set_flashdata('message', 'Data Barang berhasil dirubah!');
        redirect('barang');
    } else {
        $id =  $this->uri->segment(3);
        $this->load->model('Model_kategori');
        $data['kategori'] =  $this->Model_kategori->tampilkan_data();
        $data['record'] =  $this->Model_barang->get_one($id)->row_array();
        $data['ukuran'] = $this->Model_barang->tampilkan_ukuran()->result();
        $this->template->load('template/template', 'barang/form_edit', $data);
    }
}

    function hapus()
    {
        $id = $this->uri->segment(3);
        $this->Model_barang->hapus($id);
        $this->session->set_flashdata('message', 'Data Barang berhasil dihapus!');
        redirect('barang');
    }

    function detail_modal($id)
    {
        $id = $this->input->get('id');
        $data['detail'] = $this->Model_barang->get_detail_modal($id);
        $this->load->view('barang/modal_detail', $data);
    }
}
