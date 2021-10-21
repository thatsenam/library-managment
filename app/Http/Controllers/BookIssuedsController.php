<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookIssued;
use App\Models\Student;
use Illuminate\Http\Request;
use Exception;

class BookIssuedsController extends Controller
{

    /**
     * Display a listing of the book issueds.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $bookIssueds = BookIssued::with('student','book')->paginate(25);

        return view('book_issueds.index', compact('bookIssueds'));
    }

    /**
     * Show the form for creating a new book issued.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $students = Student::pluck('first_name','student_id')->all();
$books = Book::pluck('id','id')->all();
        
        return view('book_issueds.create', compact('students','books'));
    }

    /**
     * Store a new book issued in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            BookIssued::create($data);

            return redirect()->route('book_issueds.book_issued.index')
                ->with('success_message', 'Book Issued was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified book issued.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $bookIssued = BookIssued::with('student','book')->findOrFail($id);

        return view('book_issueds.show', compact('bookIssued'));
    }

    /**
     * Show the form for editing the specified book issued.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $bookIssued = BookIssued::findOrFail($id);
        $students = Student::pluck('first_name','student_id')->all();
$books = Book::pluck('id','id')->all();

        return view('book_issueds.edit', compact('bookIssued','students','books'));
    }

    /**
     * Update the specified book issued in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            $bookIssued = BookIssued::findOrFail($id);
            $bookIssued->update($data);

            return redirect()->route('book_issueds.book_issued.index')
                ->with('success_message', 'Book Issued was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified book issued from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $bookIssued = BookIssued::findOrFail($id);
            $bookIssued->delete();

            return redirect()->route('book_issueds.book_issued.index')
                ->with('success_message', 'Book Issued was successfully deleted.');
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
                'student_id' => 'nullable',
            'book_id' => 'nullable',
            'issue_date' => 'nullable|date_format:j/n/Y',
            'return_date' => 'nullable|date_format:j/n/Y',
            'notes' => 'string|min:1|max:1000|nullable', 
        ];

        
        $data = $request->validate($rules);


        $data['is_returned'] = $request->has('is_returned');


        return $data;
    }

}
