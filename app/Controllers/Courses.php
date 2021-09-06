<?php

namespace App\Controllers;

use App\Models\CoursesModel;
use CodeIgniter\RESTful\ResourceController;

class Courses extends ResourceController
{
	public function __construct()
	{
		$this->course = new CoursesModel();
		$this->validation = \Config\Services::validation();
	}

	protected $modelName = 'App\Models\CoursesModel';
    protected $format    = 'json';

	
	public function index()
	{
		$course = $this->course->get_course();

		foreach($course as $c){
			$output[] = [
                'id'            => intval($c['id_course']),
                'title'         => $c['title'],
                'Instructor'	=> $c['name_user'] ." ". $c['last_name_users'],
                'category'     	=> $c['name_category'],
                'description'   => $c['description'],
                'date_added' 	=> $c['date_added'],
                'last_modified' => $c['last_modified'],
                'status'     	=> $c['status']
            ];
		}

		return $this->respond($output, 200);
	}

	
	public function show($id = null)
	{
		$data = $this->course->get_course($id);
		if ($data) {
			$output = [
                'id'            => intval($data->id_course),
                'title'         => $data->title,
                'Instructor'	=> $data->name_user,
                'category'     	=> $data->name_category,
                'description'   => $data->description,
                'date_added' 	=> $data->date_added,
                'last_modified' => $data->last_modified,
                'status'     	=> $data->status
            ];

			return $this->respond($output, 200);

		}else{
			$data = $this->course->get_data($id);

			$output = [
				'status' 	=> 'Data users or category not found',
				'data' 		=> $data
			];

			return $this->respond($output, 400);
		}
	}

	
	public function create()
	{
		$data = $this->request->getPost();
        $this->validation->run($data, 'v_courses');
        $error = $this->validation->getErrors();

        if ($error) {
            return $this->fail($error, 400);
        }else {
            $this->course->save($data);
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
		$this->validation->run($data, 'v_courses');
        $error = $this->validation->getErrors();

		if ($error) {
			return $this->fail($error, 400);
		}

        if ($this->course->find($id)) {

            $this->course->update($id, $data);

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
		$course = $this->course->get_data($id);

        if ($course) {
            $this->course->delete_course($id);

            $output = [
                'status'  => true,
                'message' => 'Data deleted successfully',
                'data'    => $course
           ];

           return $this->respond($output, 200);

        }else {
            $output = [
                'status'  => false,
                'message' => 'Data not found',
                'data'    => $course
           ];

           return $this->respond($output, 400);
        }
	}
}
