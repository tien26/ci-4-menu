<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Courses extends Migration
{
	public function up()
	{
		$this->forge->addField([
                        'id_course'          => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                'unsigned'       => true,
                                'auto_increment' => true,
                        ],
                        'title'       => [
                                'type'       => 'VARCHAR',
                                'constraint' => '100',
                        ],
						'id_user'       => [
                                'type'       => 'INT',
                                'constraint' => '11',
                        ],
						'id_category'       => [
                                'type'       => 'INT',
                                'constraint' => '11',
                        ],
						'description'       => [
                                'type'       => 'TEXT'
                        ],
						'date_added'       => [
                                'type'       => 'DATETIME',
								'null' => true,
                        ],
						'last_modified'       => [
                                'type'       => 'DATETIME',
								'null' => true,
                        ],
						'status'       => [
                                'type'       => 'ENUM',
                                'constraint' => ['draft','pending','active','prepublish'],
                        ],
                        
                ]);
                $this->forge->addKey('id_course', true);
                $this->forge->createTable('courses');
	}

	public function down()
	{
		$this->forge->dropTable('courses');
	}
}
