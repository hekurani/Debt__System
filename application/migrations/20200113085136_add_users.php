<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_users extends CI_Migration {

    public function up() {
        $fields = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'Full_Name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE 
            ),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => TRUE,
                'null' => FALSE 
            ),
            'image' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
                'default' => 'default.png' 
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'unique' => TRUE,
                'null' => FALSE 
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE 
            ),
            'role' => array(
                'type' => 'ENUM("user", "superadmin", "admin")',
                'default' => 'user',
                'null' => FALSE 
            ),
            'phone_number' => array(
                'type' => 'Varchar',
                'constraint'=>'30',
                'null' => FALSE 
            ),
            'inActive' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0 // Assuming inActive default value is 0
            ),
            'limiti_borxhit' => array(
                'type' => 'DOUBLE',
                'default' => 0 
            ),
            'bilanci' => array(
                'type' => 'DOUBLE',
                'default' => 0 
            ),
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users');
    }

    public function down() {
        $this->dbforge->drop_table('users');
    }
}

?>
