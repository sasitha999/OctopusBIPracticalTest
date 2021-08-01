<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudentModel;

class StudentController extends BaseController
{

	public function subject()
	{
		$student_obj = new StudentModel();

		$subejcts = $student_obj->select('subject')->distinct()->findAll();

		$subjectNames = [];
		$subjectTotals = [];
		$subjectAvarages = [];
		foreach($subejcts as $subejct){
			
			$subjectNames [] = $subejct['subject'];
			$totalMarksForSubejct = $student_obj->selectSum('marks')->where(['subject' => $subejct['subject']])->findAll();
			$subjectTotals [] =  floatval($totalMarksForSubejct[0]['marks']);
			$averageMarksForSubejct = $student_obj->selectAvg('marks')->where(['subject' => $subejct['subject']])->findAll();
			$subjectAvarages[] = floatval($averageMarksForSubejct[0]['marks']);
		}
		return view("subject-graph", [
			"subejcts" => json_encode($subjectNames),
			"totals" => json_encode($subjectTotals),
			"avarages" => json_encode($subjectAvarages),
		]);
	}

	public function boxchart()
	{
		$student_obj = new StudentModel();

		$subejcts = $student_obj->select('subject')->distinct()->findAll();

		$subjectNames = [];
		$boxPlotData = [];
		$sctterData = [];
		$subjectAvarages = [];
		foreach($subejcts as $key  => $subejct){
			
			$subjectNames [] = $subejct['subject'];
			$marksForSubejct = $student_obj->select('marks')->where(['subject' => $subejct['subject']])->orderBy('marks', 'ASE')->findAll();
			$marksArray = array_column($marksForSubejct,'marks');
			$marksArray = []; 
			$scttperPointArray = [];
			foreach($marksForSubejct as $marks){
				$marksArray[] = $marks['marks'];
				array_push($sctterData,[$key, intval($marks['marks'])]);
			}
			$boxPlotData[] = $this->box_plot_values($marksArray);
		
		}
		return view("box-chart", [
			"subejcts" => json_encode($subjectNames),
			"boxPlot" => json_encode($boxPlotData),
			"scatterData" => json_encode($sctterData),
		]);
	}


	function box_plot_values($array)
	{
		
		$arraySize = count($array);
		$return = [
			'low' => intval($array[0]),
            'q1'=> intval($array[ceil($arraySize * 0.25)]),
            'median'=> intval($array[ceil($arraySize * 0.5)]),
            'q3'=> intval($array[ceil($arraySize * 0.75)]),
            'high'=> intval($array[$arraySize - 1])
		];


		return $return;
	}


	public function student()
	{
		$student_obj = new StudentModel();

		$subejcts = $student_obj->select('subject')->distinct()->findAll();
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
			foreach($years as  $year){
				
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

		foreach($subejcts as $subejct){
			
			$subjectNames [] = $subejct['subject'];
			$totalMarksForSubejct = $student_obj->selectSum('marks')->where(['subject' => $subejct['subject']])->findAll();
			$subjectTotals [] =  floatval($totalMarksForSubejct[0]['marks']);
			$averageMarksForSubejct = $student_obj->selectAvg('marks')->where(['subject' => $subejct['subject']])->findAll();
			$subjectAvarages[] = floatval($averageMarksForSubejct[0]['marks']);
		}
		return view("student-graph", [
			"years" => json_encode($yearsWithSemester),
			"subjectData" => json_encode($subjectDataArray),
			"avarages" => json_encode($subjectAvarages),
		]);
	}
}