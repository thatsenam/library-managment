@extends('layout.index')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Issue Book' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('issue_books.issue_book.destroy', $issueBook->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('issue_books.issue_book.index') }}" class="btn btn-primary" title="Show All Issue Book">
                        Show All Issue Book
                    </a>

                    <a href="{{ route('issue_books.issue_book.create') }}" class="btn btn-success" title="Create New Issue Book">
                        Create New Issue Book
                    </a>

                    <a href="{{ route('issue_books.issue_book.edit', $issueBook->id ) }}" class="btn btn-primary" title="Edit Issue Book">
                        Edit Issue Book
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Issue Book" onclick="return confirm(&quot;Click Ok to delete Issue Book.?&quot;)">
                        Delete Issue Book
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Student</dt>
            <dd>{{ optional($issueBook->student)->name }}</dd>
            <dt>Book</dt>
            <dd>{{ optional($issueBook->book)->title }}</dd>
            <dt>Issue Date</dt>
            <dd>{{ $issueBook->issue_date }}</dd>
            <dt>Return Date</dt>
            <dd>{{ $issueBook->return_date }}</dd>
            <dt>Notes</dt>
            <dd>{{ $issueBook->notes }}</dd>

        </dl>

    </div>
</div>

@endsection
