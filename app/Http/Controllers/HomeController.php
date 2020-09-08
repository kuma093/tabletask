<?php

namespace App\Http\Controllers;
use App\Home;
use App\Marks;
use Illuminate\Http\Request;

class HomeController extends Controller {
	//

	public function index() {
		$res = new Home;
		$result = $res->join('tb_student_marks', 'tb_student_details.id', '=', 'tb_student_marks.student_id')->get();
		return view('welcome', compact('result'));
	}

	public function reg(Request $request) {
		if ($request->isMethod('post')) {
			$name = $request->name;
			$m1 = $request->m1;
			$m2 = $request->m2;
			$m3 = $request->m3;
			$total = $m1 + $m2 + $m3;
			$rl = "Pass";
			if ($m1 < 40 || $m2 < 40 || $m3 < 40) {
				$rl = "Fail";
			}
			$stu = new Home;
			$stu->student_name = $name;
			if ($stu->save()) {
				$stu_id = $stu->id;
				$ins = new Marks();
				$ins->student_id = $stu_id;
				$ins->mark_1 = $m1;
				$ins->mark_2 = $m2;
				$ins->mark_3 = $m3;
				$ins->total = $total;
				$ins->result = $rl;
				$ins->rank = 0;
				$ins->save();

			}

			$rankupdate = Marks::orderBy('total', 'desc')->get();
			if ($rankupdate) {
				foreach ($rankupdate as $key => $val) {
					$rank = $key + 1;
					Marks::where('mark_id', $val->mark_id)->update(['rank' => $rank]);
				}
			}

			return response()->json(['status' => true]);

		}
	}
}
