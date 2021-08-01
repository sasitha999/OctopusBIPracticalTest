<?php

namespace App\Controllers;
use App\Models\StudentModel;

class Home extends BaseController
{
	public function index1()
	{
		echo view('templates/header');
        echo view('welcome_message');
        echo view('templates/footer');
	}

	public function index()
	{

		
		$student_obj = new StudentModel();

		$subejcts = $student_obj->select('subject')->distinct()->findAll();
		$studentNames = array_column($student_obj->select('studentId')->distinct()->orderBy('studentId', 'ASE')->findAll(), 'studentId');

		$years = $student_obj->select('year')->distinct()->orderBy('year', 'ASE')->findAll();
		
		$yearsWithSemester = [] ;
		$subjectNames = [];
		$subjectTotals = [];
		$subjectAvarages = [];

		$subjectDataArray = [];

		
		foreach($subejcts as $subejct){
			$subjectNames [] = $subejct['subject'];
		}

		echo view('templates/header');
		echo view("student-graph", [
			"subjectNames" => $subjectNames,
			'studentNames' =>$studentNames,
		]);
        echo view('templates/footer');
	}
}
