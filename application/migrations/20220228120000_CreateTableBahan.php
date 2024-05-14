<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_CreateTableBahan extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'id_bahan' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'nama_bahan' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
            ),
            'jumlah' => array(
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ),
            'deskripsi' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'images' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'harga' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => '0.00',
            ),
        ));
        $this->dbforge->add_key('id_bahan', TRUE);
        $this->dbforge->create_table('bahan');
    }

    public function down()
    {
        $this->dbforge->drop_table('bahan');
    }
}
