<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'users';
	protected $primaryKey           = 'id_user';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['email','first_name','last_name','foto_profil','is_active'];

	public function get_user($id = null)
    {
        if ($id == null) {
            return $this->findAll();

        }else {
            return $this->where('id_user', $id)->first();
        }
    }

	// public function update_user($data, $id)
    // {
    //     return $this->db->table($this->table)->update($data, ['id_user' => $id]);
    // }

	public function delete_user($id)
    {
        return $this->db->table($this->table)->delete(['id_user' => $id]);
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
