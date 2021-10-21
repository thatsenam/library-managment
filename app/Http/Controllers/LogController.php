<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use App\Models\Books;
use App\Models\Issue;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\StudentCategories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;

class LogController extends Controller
{
    public function index()
	{

		$logs = Logs::select('id','book_issue_id','student_id','issued_at')
			->where('return_time', '=', 0)
			->orderBy('issued_at', 'DESC');

			// dd($logs);

		$logs = $logs->get();

		for($i=0; $i<count($logs); $i++){

	        $issue_id = $logs[$i]['book_issue_id'];
	        $student_id = $logs[$i]['student_id'];

	        // to get the name of the book from book issue id
	        $issue = Issue::find($issue_id);
	        $book_id = $issue->book_id;
	        $book = Books::find($book_id);
			$logs[$i]['book_name'] = $book->title;

			// to get the name of the student from student id
			$student = Student::find($student_id);
			$logs[$i]['student_name'] = $student->first_name . ' ' . $student->last_name;

			// change issue date and return date in human readable format
			$logs[$i]['issued_at'] = date('d-M', strtotime($logs[$i]['issued_at']));
			if ($issue->return_time == 0) {
				$logs[$i]['return_time'] =  '<p class="color:red">Pending</p>';
			}else {
				$logs[$i]['return_time'] = date('d-M', strtotime($logs[$i]['return_time']));
			}

		}

        return $logs;
	}

	public function create()
	{
		//
	}

	public function store(Request $request)
	{
		$data = $request->all()['data'];
		$bookID = $data['bookID'];
		$studentID = $data['studentID'];
		$student = Student::find($studentID);

	}
//php artisan resource-file:create IssueBook --fields=id,student_id,book_id,issue_date,return_date,notes,fine,is_returned
//php artisan create:resources IssueBook --with-migration
	public function show($id)
	{
		//
	}

	public function edit($id)
	{
		$issueID = $id;

		$conditions = array(
			'book_issue_id'	=> $issueID,
			'return_time'	=> 0
		);

		$log = Logs::where($conditions);

		if(!$log->count()){
			return 'Invalid Book ID entered or book already returned';
		} else {

			$log = Logs::where($conditions)
				->firstOrFail();


			$log_id = $log['id'];
			$student_id = $log['student_id'];
			$issue_id = $log['book_issue_id'];


			DB::transaction( function() use($log_id, $student_id, $issue_id) {
				// change log status by changing return time
				$log_change = Logs::find($log_id);
				$log_change->return_time = date('Y-m-d H:i');
				$log_change->save();

				// decrease student book issue counter
				$student = Student::find($student_id);
				$student->books_issued = $student->books_issued - 1;
				$student->save();

				// change issue availability status
				$issue = Issue::find($issue_id);
				$issue->available_status = 1;
				$issue->save();

			});

			return 'Successfully returned';

		}
	}

	public function update($id)
	{
		//
	}

	public function destroy($id)
	{
		//
	}

    public function renderLogs() {
        return view('panel.logs');
    }

    public function renderIssueReturn() {
        return view('panel.issue-return');
    }
}
