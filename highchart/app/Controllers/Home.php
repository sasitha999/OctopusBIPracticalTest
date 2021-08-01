<?php

namespace App\Controllers;
use App\Models\StudentModel;

class Home extends BaseController
{
	public function index()
	{
		$student_obj = new StudentModel();

		$subjectNames = array_column($student_obj->select('subject')->distinct()->findAll() ,'subject');
		$studentNames = array_column($student_obj->select('studentId')->distinct()->orderBy('studentId', 'ASE')->findAll(), 'studentId');

		echo view('templates/header');
		echo view("student-graph", [
			"subjectNames" => $subjectNames,
			'studentNames' =>$studentNames,
		]);
        echo view('templates/footer');
	}
}
