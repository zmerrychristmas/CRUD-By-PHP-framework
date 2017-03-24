<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_Add_user extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'user_id' => array(
                                'type' => 'INT',
                                'constraint' => 10,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'user_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '255',
                        ),
                        'user_email' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '255',
                        ),
                        'updated_at' => array('type' => 'DATETIME', 'null' => FALSE),
                ));
                $this->dbforge->add_field("created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
                $this->dbforge->add_key('user_id', TRUE);
                $this->dbforge->create_table('users');
        }

        public function down()
        {
                $this->dbforge->drop_table('users');
        }
}