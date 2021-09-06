<?php

namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class Users extends ResourceController
{
	public function __construct()
    {
        $this->user = new UserModel();
        $this->validation = \Config\Services::validation();
    }

	protected $modelName = 'App\Models\UserModel';
    protected $format    = 'json';

	public function index()
	{
		$user = $this->user->get_user();

        foreach ($user as $u) {
            $output[] = [
                'id'            => intval($u['id_user']),
                'email'         => $u['email'],
                'first_name'    => $u['first_name'],
                'last_name'     => $u['last_name'],
                'foto_profil'   => $u['foto_profil'],
                'date_added'    => $u['date_added'],
                'last_modified' => $u['last_modified'],
                'is_active'     => $u['is_active']
            ];
        }

        return $this->respond($output, 200);
	}

	
	public function show($id = null)
	{
		$users = $this->user->get_user($id);

       if (!empty($users)) {
           $output = [
			   'status'         => 'Berhasil',
				'id-user'       => intval($users['id_user']),
				'email'         => $users['email'],
				'first_name'    => $users['first_name'],
				'last_name'     => $users['last_name'],
				'foto_profil'   => $users['foto_profil'],
				'date_added'    => $users['date_added'],
				'last_modified' => $users['last_modified'],
				'is_active'     => $users['is_active']
           ];

           return $this->respond($output, 200);

       }else{
			$output = [
			   'status' => '400',
			   'data'   => null
			    ];

			return $this->respond($output, 400);
		}
	}


	public function create()
	{
        $foto = $this->request->getFile('foto_profil');
        
        $name_foto = $foto->getRandomName();
        
		$data = [
            'email'        => $this->request->getPost('email'), 
            'first_name'   => $this->request->getPost('first_name'),
            'last_name'    => $this->request->getPost('last_name'),
            'foto_profil'  => $name_foto,
            'is_active'    => $this->request->getPost('is_active')
        ];

        $this->validation->run($data, 'v_user');
        $error = $this->validation->getErrors();

        if ($error) {
            return $this->fail($error, 400);
        }

        $query = $this->user->save($data);
        $foto->move('img', $name_foto);
        if ($query) {
            $output = [
                'status'  => 200,
                'message' => 'Data added successfully',
                'data'    => $data
            ];

            return $this->respond($output, 200);

        }else {
            $output = [
                'status'  => 400,
                'message' => 'Data failed to add',
                'data'    => null
            ];

            return $this->respond($output, 400);
        }
	}

	
	public function edit($id = null)
	{
		 $user = $this->user->get_user($id);

       if (!empty($user)) {
           $output = [
				'id-user'       => intval($user['id_user']),
				'email'         => $user['email'],
				'first_name'    => $user['first_name'],
				'last_name'     => $user['last_name'],
				'foto_profil'   => $user['foto_profil'],
				'date_added'    => $user['date_added'],
				'last_modified' => $user['last_modified'],
				'is_active'     => $user['is_active']
           ];

           return $this->respond($output, 200);

       }else {
           $output = [
                'status'  => 400,
                'message' => 'Data not found',
                'data'    => null
           ];

            return $this->respond($output, 400);
       }
	}


	public function update($id = null)
	{
        $user = $this->user->find($id);

        if ($user) {

            $foto = $this->request->getFile('foto_profil');
            $name_foto = $foto->getRandomName();
    
            $data = [
            'id_user' => $id,
            'email'        => $this->request->getPost('email'), 
            'first_name'   => $this->request->getPost('first_name'),
            'last_name'    => $this->request->getPost('last_name'),
            'foto_profil'  => $name_foto,
            'is_active'    => $this->request->getPost('is_active')
            ];

            $this->validation->run($data, 'v_user_update');
            $error = $this->validation->getErrors();

            if ($error) {
                return $this->fail($error, 400);
            }

            if ($foto) {
                
                $foto->move('img', $name_foto);
                unlink('img/' . $user['foto_profil']);
                $this->user->update($id, $data);
    
                $output = [
                    'status'  => true,
                    'message' => 'Data edited successfully'
               ];
               
               return $this->respond($output, 200);
                
            }else {
                $data = [
                'id_user' => $id,
                'email'        => $this->request->getPost('email'), 
                'first_name'   => $this->request->getPost('first_name'),
                'last_name'    => $this->request->getPost('last_name'),
                'is_active'    => $this->request->getPost('is_active')
                ];
    
                $this->user->update($id, $data);
    
                $output = [
                    'status'  => true,
                    'message' => 'Data edited successfully'
               ];
               
               return $this->respond($output, 200);
            }

        }else {
            $output = [
                'status'  => false,
                'message' => 'Data not found',
                'data'    => null
           ];

           return $this->respond($output, 400);
        }
	}


	public function delete($id = null)
	{
		$user = $this->user->get_user($id);

        if ($user) {
            unlink('img/' . $user['foto_profil']);
            $this->user->delete_user($id);

            $output = [
                'status'  => true,
                'message' => 'Data deleted successfully',
                'data'    => $user
           ];

           return $this->respond($output, 200);

        }else {
            $output = [
                'status'  => false,
                'message' => 'Data not found',
                'data'    => $user
           ];

           return $this->respond($output, 400);
        }
	}
}
