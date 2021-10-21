@extends('layout.index')
@section('content')

    <div class="panel panel-default">

        <div class="panel-heading clearfix">

            <span class="pull-left">
                <h4 class="mt-5 mb-5">Create New Issue Book</h4>
            </span>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('issue_books.issue_book.index') }}" class="btn btn-primary" title="Show All Issue Book">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
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

            <form method="POST"
                  class="form-horizontal row-fluid"
                  action="{{ route('issue_books.issue_book.store') }}" accept-charset="UTF-8" id="create_issue_book_form" name="create_issue_book_form" class="form-horizontal">
            {{ csrf_field() }}
            @include ('issue_books.form', [
                                        'issueBook' => null,
                                      ])

                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-inverse" >Issue Book Now</button>
                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection


