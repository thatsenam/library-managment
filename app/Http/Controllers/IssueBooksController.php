<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Books;
use App\Models\IssueBook;
use App\Models\Student;
use Illuminate\Http\Request;
use Exception;

class IssueBooksController extends Controller
{


    public function index()
    {
        $issueBooks = IssueBook::with('student', 'book')->paginate(25);
//        dd($issueBooks);
        return view('issue_books.index', compact('issueBooks'));
    }


    public function create()
    {
        $students = Student::all();
        $books = Books::pluck('title', 'book_id')->all();

        return view('issue_books.create', compact('students', 'books'));
    }


    public function store(Request $request)
    {


        $data = $this->getData($request);

        IssueBook::create($data);

        return redirect()->route('issue_books.issue_book.index')->with('success_message', 'Issue Book was successfully added.');

    }


    public function show($id)
    {
        $issueBook = IssueBook::with('student', 'book')->findOrFail($id);

        return view('issue_books.show', compact('issueBook'));
    }


    public function edit($id)
    {
        $issueBook = IssueBook::findOrFail($id);
        $students = Student::all();
        $books = Books::pluck('title', 'book_id')->all();

        return view('issue_books.edit', compact('issueBook', 'students', 'books'));
    }


    public function update($id, Request $request)
    {


        $data = $this->getData($request);

        $issueBook = IssueBook::findOrFail($id);
        $issueBook->update($data);

        return redirect()->route('issue_books.issue_book.index')
            ->with('success_message', 'Issue Book was successfully updated.');

    }

    /**
     * Remove the specified issue book from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $issueBook = IssueBook::findOrFail($id);
            $issueBook->delete();

            return redirect()->route('issue_books.issue_book.index')
                ->with('success_message', 'Issue Book was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }


    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
            'student_id' => 'required',
            'book_id' => 'required',
            'issue_date' => 'required',
            'return_date' => 'required',
            'notes' => 'string|min:1|max:1000|nullable',
        ];


        $data = $request->validate($rules);


        $data['is_returned'] = $request->has('is_returned');


        return $data;
    }

    public function renderIssueReturn()
    {
        // composer require crestapps/laravel-code-generator^2.4.6 --dev
        $student_ids = IssueBook::query()->where('is_returned', false)->pluck('student_id')->toArray();
        $students = Student::find($student_ids);
        return view('panel.issue-return', compact('students'));
    }

    public function check_books($student_id)
    {
        $result = ['<option value="" style="display: none;" disabled selected>Select Book</option>'];

        $issued_books = IssueBook::query()->where('student_id', $student_id)->where('is_returned', 0)->get();
//        dd($student_id,$issued_books);
        foreach ($issued_books as $issue) {

            $book = $issue->book->title;
            $result[] = '<option value="' . $issue->book_id . '" >' . $book . ' [ ' . $issue->return_date . ' ]' . '</option>';
        }

        return join('', $result);
    }

    public function return_book(Request $request)
    {
        $student_id = $request->student_id;
        $book_id = $request->book_id;
        $fine = $request->fee;

        IssueBook::query()->where('student_id', $student_id)
            ->where('book_id', $book_id)
            ->update(['is_returned' => true, 'fine' => $fine]);

        return back()->with('success_message', 'Book Returned Successfully');
    }
}
