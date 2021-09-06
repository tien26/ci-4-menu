<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class CategorySeed extends Seeder
{
	public function run()
	{
		$data = [
			'email'    => 'darth@theempire.com',
			'first_name' => 'kategori',
			'last_name' => 'aja',
			'date_added'=> Time::now(),
			'last_modified'=>Time::now(),
			'is_active' => 'active',
                ];

                // Simple Queries
                // $this->db->query("INSERT INTO users (username, email) VALUES(:username:, :email:)", $data);

                // Using Query Builder
                $this->db->table('category')->insert($data);
	}
}
