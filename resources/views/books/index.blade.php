@extends('layout.index')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

    <div class="panel panel-default">

        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">Books</h4>
            </div>

            <div class="btn-group pull-right" role="group">
                <a href="{{ route('books.books.create') }}" class="btn btn-success" title="Create New Books">
                    + Add New Book
                </a>
            </div>

        </div>

        @if(count($booksObjects) == 0)
            <div class="panel-body text-center">
                <h4>No Books Available.</h4>
            </div>
        @else
            <div class="panel-body panel-body-with-table">
                <div class="table-responsive">

                    <table class="table table-striped table-bordered table-condensed ">
                        <thead>
                        <tr>
                            <th>Book</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Total</th>
                            <th>Available</th>

                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($booksObjects as $books)
                            <tr>
                                <td>{{ $books->book_id}}</td>
                                <td style="max-width: 100px">{{ $books->title }}</td>
                                <td>{{ $books->author }}</td>
                                <td>{{ optional($books->category)->category }}</td>
                                <td>{{ $books->stock }}</td>
                                <td>{{ $books->available }}</td>

                                <td>

                                    <form method="POST" action="{!! route('books.books.destroy', $books->book_id) !!}"
                                          accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}

                                        <div class="btn-grouppull-right" role="group">

                                            <a href="{{ route('books.books.edit', $books->book_id ) }}"
                                               class="btn btn-primary mx-2" title="Edit Books">
                                                Edit
                                            </a>

                                            <button type="submit" class="btn btn-danger" title="Delete Books"
                                                    onclick="return confirm(&quot;Click Ok to delete Books.&quot;)">
                                                Delete
                                            </button>
                                        </div>

                                    </form>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="panel-footer">
                {!! $booksObjects->render() !!}
            </div>

        @endif

    </div>
@endsection
