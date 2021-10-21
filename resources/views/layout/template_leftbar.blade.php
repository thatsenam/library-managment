<div class="span3" >
    <div class="sidebar" >
        <ul class="widget widget-menu unstyled">
            <li>
                <a href="{{ URL::route('home') }}">
                    <i class="menu-icon icon-home"></i>Home
                </a>
            </li>
            <li>
                <a href="{{ URL::route('students-for-approval') }}">
                    <i class="menu-icon icon-filter"></i> All Waiting Students
                </a>
            </li>
            <li>
                <a href="{{ URL::route('registered-students') }}">
                    <i class="menu-icon icon-group"></i>All approved Students
                </a>
            </li>
            <li>
                <a href="{{ route('books.books.index') }}">
                    <i class="menu-icon icon-th-list"></i>All Books in Library
                </a>
            </li>
{{--            <li>--}}
{{--                <a href="{{ URL::route('add-book-category') }}">--}}
{{--                    <i class="menu-icon icon-folder-open-alt"></i>Add Book Category--}}
{{--                </a>--}}
{{--            </li>--}}
            <li>
                <a href="{{ route('books.books.create') }}">
                    <i class="menu-icon icon-folder-open-alt"></i>Add Books
                </a>
            </li>
{{--            <li>--}}
{{--                <a href="{{ URL::route('settings') }}">--}}
{{--                    <i class="menu-icon icon-cog"></i>Add Settings--}}
{{--                </a>--}}
{{--            </li>--}}

            <li>
                <a href="{{ route('issue_books.issue_book.renderIssueReturn') }}">
                    <i class="menu-icon icon-signout"></i> Return Books
                </a>
            </li>
            <li>
                <a href="{{ route('issue_books.issue_book.index') }}">
                    <i class="menu-icon icon-list-ul"></i>View all currently issued books
                </a>
            </li>
        </ul>

        <ul class="widget widget-menu unstyled">
            <li><a href="{{ URL::route('account-sign-out') }}"><i class="menu-icon icon-wrench"></i>Logout </a></li>
        </ul>
    </div>
</div>
