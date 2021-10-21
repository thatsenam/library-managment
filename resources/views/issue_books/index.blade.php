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
                <h4 class="mt-5 mb-5">Issue Books</h4>
            </div>

            <div class="btn-group  pull-right" role="group">
                <a href="{{ route('issue_books.issue_book.create') }}" class="btn btn-success"
                   title="Create New Issue Book">
                    + Issue Book To Student
                </a>
            </div>

        </div>

        @if(count($issueBooks) == 0)
            <div class="panel-body text-center">
                <h4>No Issue Books Available.</h4>
            </div>
        @else
            <div class="module-body" style="background-color: white">
                <div class="table-responsive">

                    <table class="table table-striped table-bordered table-condensed">
                        <thead>
                        <tr>
                            <th>Student</th>
                            <th>Book</th>
                            <th>Issue Date</th>
                            <th>Return Date</th>
                            <th>Is Returned?</th>
                            <th>Late Fee</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($issueBooks as $issueBook)
                            <tr>
                                <td>{{ optional($issueBook->student)->name }} </td>
                                <td>{{ optional($issueBook->book)->title }}</td>
                                <td>{{ $issueBook->issue_date }}</td>
                                <td>{{ $issueBook->return_date }}</td>
                                <td>{{ $issueBook->is_returned?'YES':'NO' }}</td>
                                <td>{{ $issueBook->fine }}</td>


                                <td>

                                    <form method="POST"
                                          action="{!! route('issue_books.issue_book.destroy', $issueBook->id) !!}"
                                          accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}

                                        <div class="btn-group pull-right" role="group">

                                            <a href="{{ route('issue_books.issue_book.edit', $issueBook->id ) }}"
                                               class="btn btn-primary " style="margin: 0px 10px "
                                               title="Edit Issue Book">
                                                Edit
                                            </a>

                                            <button type="submit" class="btn btn-danger" title="Delete Issue Book"
                                                    onclick="return confirm(&quot;Click Ok to delete Issue Book.&quot;)">
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
                {!! $issueBooks->render() !!}
            </div>

        @endif

    </div>
@endsection
