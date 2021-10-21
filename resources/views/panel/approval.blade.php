@extends('layout.index')

@section('custom_top_script')
@stop

@section('content')
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Students waiting for their approval to access Library</h3>
            </div>
            <div class="module-body">
                @if(session()->has('success'))
                    <div class="alert alert-success"> {{ session('success') }}</div>
                @endif
                <table class="table table-striped table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Roll Number</th>
                        <th>Branch</th>
                        <th>Approve</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($awaitingStudents as $student)
                        <tr>
                            <td>{{ $student->student_id }}</td>
                            <td>{{ $student->first_name }}</td>
                            <td>{{ $student->last_name }}</td>
                            <td>{{ $student->roll_num }}</td>
                            <td>{{ optional(\App\Models\Branch::find($student->branch))->branch }}</td>
                            <td>
                                <a href="{{ route('students.approve',$student->student_id) }}"
                                   class="btn btn-success "
                                  >Approve</a>
                                <a onclick="return confirm('Are you sure?')" href="{{ route('students.reject',$student->student_id) }}"
                                   class="btn btn-danger "
                                  >Reject</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <input type="hidden" name="" id="branches_list" value="{{ json_encode($branch_list) }}">
        <input type="hidden" name="" id="student_categories_list" value="{{ json_encode($student_categories_list) }}">
        <input type="hidden" id="_token" data-form-field="token" value="{{ csrf_token() }}">

    </div>

@stop

@section('custom_bottom_script')
    <script type="text/javascript">
        var branches_list = $('#branches_list').val(),
            categories_list = $('#student_categories_list').val(),
            _token = $('#_token').val();
    </script>
    <script type="text/javascript" src="{{asset('static/custom/js/script.student-approval.js') }}"></script>
    <script type="text/template" id="approvalstudents_show">
    @include('underscore.approvalstudents_show')
    </script>
@stop
