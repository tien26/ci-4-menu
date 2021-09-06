<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
	
	public $v_user = [
		'email' => [
			'rules' => 'required|is_unique[users.email,id_user,{id_user}]|valid_email'
		],
		'first_name' => [
			'rules' => 'required'
		],
		'last_name' => [
			'rules' => 'required'
		],
		'foto_profil' => [
			'rules' => 'required|max_size[foto_profil,1024]|is_image[foto_profil]|mime_in[foto_profil,image/jpg,image/jpeg,image/png]'
		],
		'is_active' => [
			'rules' => 'required'
		],
	];

	public $v_user_update = [
		'email' => [
			'rules' => 'required|valid_email'
		],
		'first_name' => [
			'rules' => 'required'
		],
		'last_name' => [
			'rules' => 'required'
		],
		'foto_profil' => [
			'rules' => 'max_size[foto_profil,1024]|is_image[foto_profil]|mime_in[foto_profil,image/jpg,image/jpeg,image/png]'
		],
		'is_active' => [
			'rules' => 'required'
		],
	];

	public $v_category = [
		'email' => [
			'rules' => 'required|is_unique[category.email,id_category,{id_category}]|valid_email'
		],
		'first_name' => [
			'rules' => 'required'
		],
		'last_name' => [
			'rules' => 'required'
		],
		'is_active' => [
			'rules' => 'required'
		],
	];

	public $v_category_update = [
		'email' => [
			'rules' => 'required|valid_email'
		],
		'first_name' => [
			'rules' => 'required'
		],
		'last_name' => [
			'rules' => 'required'
		],
		'is_active' => [
			'rules' => 'required'
		],
	];

	public $v_courses = [
		'title' => [
			'rules' => 'required'
		],
		'id_user' => [
			'rules' => 'required|is_natural_no_zero'
		],
		'id_category' => [
			'rules' => 'required|is_natural_no_zero'
		],
		'description' => [
			'rules' => 'required'
		],
		'status' => [
			'rules' => 'required'
		],
	];
}
