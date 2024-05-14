<?php
class Model_operator extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    function post($data)
     {
        $this->db->insert('operator',$data);
    }

    function login($username, $password)
    {
        $chek =  $this->db->join('akses','akses.id_akses = operator.id_akses','left')
        ->get_where('operator', array('username' => $username, 'password' =>  md5($password)));
        if ($chek->num_rows() > 0) {
            return $chek;
        } else {
            return false;
        }
    }

    function ambil_foto($username, $password)
    {
        $chek =  $this->db->get_where('operator', array('username' => $username, 'password' =>  md5($password)));
        if ($chek->num_rows() > 0) {
            return $chek->row();
        } else {
            return false;
        }
    }

    function getAkses()
    {
        return $this->db->get('akses')->result();
    }

    function tampilkan_data()
    {
        return $this->db->join('akses', 'akses.id_akses = operator.id_akses', 'left')
            ->get('operator');
    }

    public function get_oneuser($id_operator)
	{
		return $this->db->get_where('operator', array('id_operator' => $id_operator));
	}

    function get_one($id)
    {
        $param  =   array('id_operator' => $id);
        return $this->db->get_where('operator', $param);
    }

    function edit($data)
    {
        $this->db->where('id_operator', $this->input->post('id'));
        $this->db->update('operator', $data);
    }

    function hapus($id)
    {
        $this->db->where('id_opertaor', $id);
        $this->db->delete('operator');
    }

    function get_detail_modal($id)
    {
        return $this->db->where('id_operator', $id)
            ->get('operator')
            ->row();
    }
}
