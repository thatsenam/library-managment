@extends('layout.index')

@section('custom_top_script')
@stop

@section('content')
    <div class="content">


        @if(Session::has('success_message'))
            <div class="alert alert-success">
                <span class="glyphicon glyphicon-ok"></span>
                {!! session('success_message') !!}

                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
        @endif
        <div class="module">
            <div class="module-head">
                <h3>Return a Book</h3>
            </div>
            <div class="module-body">
                <form class="form-horizontal row-fluid" method="post"
                      action="{{ route('issue_books.issue_book.return_book') }}">
                    @csrf
                    <div class="control-group">
                        <label class="control-label">Student</label>
                        <div class="controls">
                            <select class="searchable" id="student_id" name="student_id" required>
                                <option value="" style="display: none;" disabled selected>Select student</option>
                                @foreach ($students as $key => $student)
                                    <option value="{{ $student->student_id }}">
                                        {{ $student->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="control-group">
                        <label class="control-label">Books</label>
                        <div class="controls">
                            <select class="" id="book_id" name="book_id" required>
                                <option value="" style="display: none;" disabled selected>Select Book</option>

                            </select>
                        </div>

                    </div>
                    <div class="control-group">
                        <label class="control-label">Late Fee</label>
                        <div class="controls">
                            <input type="number" step="any" id="fee" name="fee" class="">

                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn btn-inverse">Return Book</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <input type="hidden" id="_token" data-form-field="token" value="{{ csrf_token() }}">
    </div>
@stop

@section('custom_bottom_script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#student_id').on('change', function () {
                let student_id = $(this).val();
                $.ajax({
                    url: "return/" + student_id, success: function (result) {
                        $("#book_id").html(result);
                        console.log(result)
                    }
                });
            })
        })
    </script>
@stop
