<?php

namespace App\Models;

use CodeIgniter\Model;

class CoursesModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'courses';
	protected $primaryKey           = 'id_course';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['title','id_user','id_category','description','status'];

	public function get_course($id = null)
	{
		if ($id == null) {
			return $this->db->table('courses')
			->join('users','users.id_user = courses.id_user')
			->join('category','category.id_category = courses.id_category')
			->select('*')
			->select('users.first_name as name_user,users.last_name as last_name_users,category.first_name as name_category')
			->orderBy('courses.id_course')
			->get()->getResultArray();
		}else {
			return $this->db->table('courses')
			->join('users','users.id_user = courses.id_user')
			->join('category','category.id_category = courses.id_category')
			->select('*')
			->select('users.first_name as name_user,category.first_name as name_category')
			->where('courses.id_course', $id)
			->get()->getRow();
			
		}
	}

	public function get_data($id = null)
    {
            return $this->where('id_course', $id)->first();
    }

	public function delete_course($id)
    {
        return $this->db->table($this->table)->delete(['id_course' => $id]);
    }

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'date_added';
	protected $updatedField         = 'last_modified';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];
}
