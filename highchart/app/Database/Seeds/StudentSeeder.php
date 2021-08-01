<?php

namespace App\Database\Seeds;

use App\Models\StudentModel;
use CodeIgniter\Database\Seeder;
class StudentSeeder extends Seeder
{
	public function run()
    {
        // 
        // for ($i = 0; $i < 2000; $i++) {

        //     $data[] = $this->generateTestStudent();
        // }

        // $student_obj = new StudentdataModel();
		

        // $student_obj->insertBatch($data);
		$start = microtime(true);
		for($j = 0; $j < 1000; $j++){
			$data = [];

			for($i = 0; $i < 100; $i++){
				$data[] = $this->generateTest();
			}
			error_log(">>>>>>>>>>>>". $j);
			$student_obj = new StudentModel();
         	$student_obj->insertBatch($data);
		}
		$total = microtime(true) - $start;
		error_log(">>>>>>>>>>>>". $total);

		
    }
	public function generateTest()
    {
		$studentNames =[
			"Student1",
			"Student2",
			"Student3",
			"Student4",
			"Student5",
			"Student6",
			"Student7",
			"Student8",
			"Student9",
			"Student10",
			"Student11",
			"Student12",
			"Student13",
			"Student14",
			"Student15",
			"Student16",
			"Student17",
			"Student18",
			"Student19",
			"Student20",
		];
		$subjectNames = [
			"Subject1",
			"Subject2",
			"Subject3",
			"Subject4",
			"Subject5",
			"Subject6",
			"Subject7",
			"Subject8",
			"Subject9",
			"Subject10",
			"Subject11",
			"Subject12",
			"Subject13",
			"Subject14",
			"Subject15",
			"Subject16",
			"Subject17",
			"Subject18",
			"Subject19",
		];

        return [
			"marks" => rand(0, 100),
			"semester" => rand(1, 2),
			"year" => rand(2000, 2009),
			"grade" => rand(1, 12),
            "studentId" => $studentNames[array_rand($studentNames)],
			"subject" => $subjectNames[array_rand($subjectNames)],
        ];
    }
}
