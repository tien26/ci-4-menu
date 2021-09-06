<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Category extends Migration
{
	public function up()
	{
		$this->forge->addField([
                        'id_category'          => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                'unsigned'       => true,
                                'auto_increment' => true,
                        ],
                        'email'       => [
                                'type'       => 'VARCHAR',
                                'constraint' => '100',
                        ],
						'first_name'       => [
                                'type'       => 'VARCHAR',
                                'constraint' => '100',
                        ],
						'last_name'       => [
                                'type'       => 'VARCHAR',
                                'constraint' => '100',
                        ],
						'date_added'       => [
                                'type'       => 'DATETIME',
								'null' => true,
                        ],
						'last_modified'       => [
                                'type'       => 'DATETIME',
								'null' => true,
                        ],
						'is_active'       => [
                                'type'       => 'ENUM',
                                'constraint' => ['active','non_active'],
                        ],
                        
                ]);
                $this->forge->addKey('id_category', true);
                $this->forge->createTable('category');
	}

	public function down()
	{
		$this->forge->dropTable('category');
	}
}
