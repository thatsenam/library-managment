@extends('layout.index')

@section('content')

    <div class="panel panel-default">

        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : 'Issue Book' }}</h4>
            </div>
            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('issue_books.issue_book.index') }}" class="btn btn-primary" title="Show All Issue Book">
                    Show All Issue Book
                </a>

                <a href="{{ route('issue_books.issue_book.create') }}" class="btn btn-success" style="margin-left: 10px" title="Create New Issue Book">
                    Create New Issue Book
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

            <form method="POST" action="{{ route('issue_books.issue_book.update', $issueBook->id) }}" id="edit_issue_book_form" name="edit_issue_book_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('issue_books.form', [
                                        'issueBook' => $issueBook,
                                      ])

                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-inverse" >Update</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection
