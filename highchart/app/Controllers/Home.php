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

		foreach($years as  $year){
			$yearsWithSemester [] = $year['year']." - 1";
			$yearsWithSemester [] = $year['year']." - 2";
		}
		foreach($subejcts as $subejct){
			$subjectNames [] = $subejct['subject'];
			$marksData = [];
			foreach($years as $year){
				
				$averageMarksForSubejctInSemesterOne = $student_obj->selectAvg('marks')
					->where([
						'subject' => $subejct['subject'] ,
						'studentId' => 'student1',
						'year' => $year['year'],
						'semester' => '1',
					])
					->findAll()[0]['marks'];
				$averageMarksForSubejctInSemesterTwo = $student_obj->selectAvg('marks')
					->where([
						'subject' => $subejct['subject'] ,
						'studentId' => 'student1',
						'year' => $year['year'],
						'semester' => '2',
					])
					->findAll()[0]['marks'];
				array_push($marksData ,floatval($averageMarksForSubejctInSemesterOne));
				array_push($marksData ,floatval($averageMarksForSubejctInSemesterTwo));

			}	
			$subjectDataArray [] =  ['name' => $subejct['subject'] , 'data' => $marksData];
			
		}

		echo view('templates/header');
		echo view("student-graph", [
			"years" => json_encode($yearsWithSemester),
			"subjectData" => json_encode($subjectDataArray),
			"avarages" => json_encode($subjectAvarages),
			"allSubject" => json_encode($subjectNames),
			'$studentNames' =>json_encode($studentNames),
		]);
        echo view('templates/footer');
	}
}
