<?php

namespace App\Http\Controllers;

use App\Models\BookCategories;
use App\Models\Books;
use Illuminate\Http\Request;
use Exception;

class BooksController extends Controller
{


    public function index()
    {
        $booksObjects = Books::with( 'category')->paginate(25);
        // test
        return view('books.index', compact('booksObjects'));
    }


    public function create()
    {
        $books = Books::pluck('title', 'book_id')->all();
        $categories = BookCategories::pluck('category', 'id')->all();
        $addedBies = [];
//        dd($books,$categories,$addedBies);
        return view('books.create', compact('books', 'categories', 'addedBies'));
    }


    public function store(Request $request)
    {


        $data = $this->getData($request);

        Books::create($data);

        return redirect()->route('books.books.index')
            ->with('success_message', 'Books was successfully added.');

    }

    public function show($id)
    {
        $books = Books::with('book', 'category', 'addedby')->findOrFail($id);

        return view('books.show', compact('books'));
    }


    public function edit($id)
    {
        $books = Books::firstWhere('book_id', $id);
        $categories = BookCategories::pluck('id', 'id')->all();
        $addedBies = [];

        return view('books.edit', compact('books', 'categories', 'addedBies'));
    }

    public function update($id, Request $request)
    {


        $data = $this->getData($request);

        $books = Books::findOrFail($id);
        $books->update($data);

        return redirect()->route('books.books.index')
            ->with('success_message', 'Books was successfully updated.');

    }

    public function destroy($id)
    {

        $books = Books::findOrFail($id);
        $books->delete();

        return redirect()->route('books.books.index')
            ->with('success_message', 'Books was successfully deleted.');

    }


    protected function getData(Request $request)
    {
        $rules = [
            'title' => 'string|min:1|max:255|nullable',
            'author' => 'string|min:1|nullable',
            'description' => 'string|min:1|max:1000|nullable',
            'category_id' => 'nullable',
            'added_by' => 'nullable',
            'stock' => 'string|min:1|nullable',
        ];


        $data = $request->validate($rules);
        $data['added_by'] = 1;
        $data['id'] = count(Books::query()->get()) + 1;
        if ($data['description'] == null) {
            $data['description'] = '';
        }


        return $data;
    }


    public function BookCategoryStore(Request $request)
    {
        $bookcategory = BookCategories::create($request->all());

        if (!$bookcategory) {

            return 'Book Category fail to save!';
        } else {

            return "Book Category Added successfully to Database";
        }
    }

    public function renderAddBookCategory(Type $var = null)
    {
        return view('panel.addbookcategory');
    }


    public function renderAddBooks()
    {
        $db_control = new HomeController();

        return view('panel.addbook')
            ->with('categories_list', $db_control->categories_list);
    }

    public function renderAllBooks()
    {
        $db_control = new HomeController();

        return view('panel.allbook')
            ->with('categories_list', $db_control->categories_list);
    }


}
