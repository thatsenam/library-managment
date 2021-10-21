@extends('layout.index')

@section('content')

    <div class="panel panel-default">

        <div class="panel-heading clearfix">

            <span class="pull-left">
                <h4 class="mt-5 mb-5">Create New Books</h4>
            </span>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('books.books.index') }}" class="btn btn-primary" title="Show All Books">
                    Show All Books
                </a>
            </div>

        </div>

        <div class="panel-body">

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('books.books.store') }}" accept-charset="UTF-8" id="create_books_form" name="create_books_form" class="form-horizontal">
            {{ csrf_field() }}
            @include ('books.form', [
                                        'book' => null,
                                      ])

                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-inverse" >Save Book</button>
                    </div>
                </div>


            </form>

        </div>
    </div>

@endsection


