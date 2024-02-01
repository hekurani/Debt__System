<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_transaksioni extends CI_Migration {

    public function up() {
        $fields = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'senderId' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => FALSE 
            ),
            'receiverId' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => FALSE 
            ),
            'Shuma' => array(
                'type' => 'DOUBLE',
                'null' => FALSE 
            )
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('transaksioni');

        $this->db->query('ALTER TABLE transaksioni ADD CONSTRAINT fk_sender FOREIGN KEY (senderId) REFERENCES users(id)');
        $this->db->query('ALTER TABLE transaksioni ADD CONSTRAINT fk_receiver FOREIGN KEY (receiverId) REFERENCES users(id)');
    }

    public function down() {
        $this->dbforge->drop_table('transaksioni');
    }
}
