@extends('layout.index')

@section('custom_top_script')
@stop

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>All Approved Students</h3>
        </div>
        <div class="module-body">

            <table class="table table-striped table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Roll Number</th>
                        <th>Branch</th>
                        <th>Email ID</th>
                        <th>Books Issued</th>
                    </tr>
                </thead>
                <tbody >
                  @foreach($students as $student)
                      <tr>
                          <td>{{ $student->student_id }}</td>
                          <td>{{ $student->first_name }}</td>
                          <td>{{ $student->last_name }}</td>
                          <td>{{ $student->roll_num }}</td>
                          <td>{{ optional(\App\Models\Branch::find($student->branch))->branch }}</td>
                          <td>{{ $student->email_id }}</td>
                          <td><%= obj.books_issued %></td>
                      </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
    </div>
  <input type="hidden" id="_token"  data-form-field="token"  value="{{ csrf_token() }}">

</div>
@stop

@section('custom_bottom_script')
<script type="text/javascript">
     var branches_list = $('#branches_list').val(),
        categories_list = $('#student_categories_list').val(),
        _token = $('#_token').val();
</script>
<script type="text/javascript" src="{{ asset('static/custom/js/script.students.js') }}"></script>
<script type="text/template" id="allstudents_show">

</script>
@stop
