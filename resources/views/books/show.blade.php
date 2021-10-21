@extends('layout.index')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($books->title) ? $books->title : 'Books' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('books.books.destroy', $books->book_id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('books.books.index') }}" class="btn btn-primary" title="Show All Books">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('books.books.create') }}" class="btn btn-success" title="Create New Books">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('books.books.edit', $books->book_id ) }}" class="btn btn-primary" title="Edit Books">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Books" onclick="return confirm(&quot;Click Ok to delete Books.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Book</dt>
            <dd>{{ optional($books->book)->id }}</dd>
            <dt>Title</dt>
            <dd>{{ $books->title }}</dd>
            <dt>Author</dt>
            <dd>{{ $books->author }}</dd>
            <dt>Description</dt>
            <dd>{{ $books->description }}</dd>
            <dt>Category</dt>
            <dd>{{ optional($books->category)->id }}</dd>
            <dt>Added By</dt>
            <dd>{{ optional($books->addedBy)->id }}</dd>
            <dt>Stock</dt>
            <dd>{{ $books->stock }}</dd>

        </dl>

    </div>
</div>

@endsection
