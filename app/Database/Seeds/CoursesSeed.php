<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class CoursesSeed extends Seeder
{
	public function run()
	{
		$data = [
			'title'    => 'title',
			'id_user' => '1',
			'id_category' => '1',
			'description' => 'courses',
			'date_added'=> Time::now(),
			'last_modified'=> Time::now(),
			'status' => 'pending',
                ];

                // Simple Queries
                // $this->db->query("INSERT INTO users (username, email) VALUES(:username:, :email:)", $data);

                // Using Query Builder
                $this->db->table('courses')->insert($data);
	}
}
