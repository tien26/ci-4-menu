<?php

namespace App\Controllers;
use App\Models\CategoryModel;

use CodeIgniter\RESTful\ResourceController;

class Category extends ResourceController
{
	public function __construct()
    {
        $this->category = new CategoryModel();
        $this->validation = \Config\Services::validation();
    }

	protected $modelName = 'App\Models\CategoryModel';
    protected $format    = 'json';
	
    
	public function index()
	{
		$category = $this->category->get_category();

        foreach ($category as $c) {
            $output[] = [
                'id'            => intval($c['id_category']),
                'email'         => $c['email'],
                'first_name'    => $c['first_name'],
                'last_name'     => $c['last_name'],
                'date_added'    => $c['date_added'],
                'last_modified' => $c['last_modified'],
                'is_active'     => $c['is_active']
            ];
        }

        return $this->respond($output, 200);
	}

	
	public function show($id = null)
	{
		$category = $this->category->get_category($id);

       if ($category > 0) {
           $output = [
			    'status'        => 'Berhasil',
				'id_category'   => intval($category['id_category']),
				'email'         => $category['email'],
				'first_name'    => $category['first_name'],
				'last_name'     => $category['last_name'],
				'date_added'    => $category['date_added'],
				'last_modified' => $category['last_modified'],
				'is_active'     => $category['is_active']
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
		$data = $this->request->getPost();
        $this->validation->run($data, 'v_category');
        $error = $this->validation->getErrors();

        if ($error) {
            return $this->fail($error, 400);
        }else {
            $this->category->save($data);
            $output = [
                'status'  => 200,
                'message' => 'Data added successfully'
            ];

            return $this->respond($output, 200);
        }

	}

	
	public function update($id = null)
	{
        
        $data = $this->request->getRawInput();
        $this->validation->run($data, 'v_category_update');
        $error = $this->validation->getErrors();

		if ($error) {
			return $this->fail($error, 400);
		}

        if ($this->category->find($id)) {

            $this->category->update($id, $data);

            $output = [
                'status'  => true,
                'message' => 'Data edited successfully'
           ];
           
           return $this->respond($output, 200);

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
		$category = $this->category->get_category($id);

        if ($category) {
            $this->category->delete_category($id);

            $output = [
                'status'  => true,
                'message' => 'Data deleted successfully',
                'data'    => $category
           ];

           return $this->respond($output, 200);

        }else {
            $output = [
                'status'  => false,
                'message' => 'Data not found',
                'data'    => $category
           ];

           return $this->respond($output, 400);
        }
	}
}