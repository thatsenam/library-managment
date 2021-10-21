
<div class="control-group {{ $errors->has('student_id') ? 'has-error' : '' }}">
    <label for="student_id" class="control-label">Student</label>
    <div class="controls">
        <select class="" id="student_id" name="student_id">
        	    <option value="" style="display: none;" {{ old('student_id', optional($issueBook)->student_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select student</option>
        	@foreach ($students as $key => $student)
			    <option value="{{ $student->student_id }}" {{ old('student_id', optional($issueBook)->student_id) == $student->student_id ? 'selected' : '' }}>
			    	{{ $student->name }}
			    </option>
			@endforeach
        </select>

        {!! $errors->first('student_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="control-group {{ $errors->has('book_id') ? 'has-error' : '' }}">
    <label for="book_id" class="col-md-2 control-label">Book</label>
    <div class="controls">
        <select class="form-control" id="book_id" name="book_id">
        	    <option value="" style="display: none;" {{ old('book_id', optional($issueBook)->book_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select book</option>
        	@foreach ($books as $key => $book)
			    <option value="{{ $key }}" {{ old('book_id', optional($issueBook)->book_id) == $key ? 'selected' : '' }}>
			    	{{ $book }}
			    </option>
			@endforeach
        </select>

        {!! $errors->first('book_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="control-group {{ $errors->has('issue_date') ? 'has-error' : '' }}">
    <label for="issue_date" class="col-md-2 control-label">Issue Date</label>
    <div class="controls">
        <input class="form-control" name="issue_date" type="date" id="issue_date" value="{{ old('issue_date', optional($issueBook)->issue_date) }}" placeholder="Enter issue date here...">
        {!! $errors->first('issue_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="control-group {{ $errors->has('return_date') ? 'has-error' : '' }}">
    <label for="return_date" class="col-md-2 control-label">Return Date</label>
    <div class="controls">
        <input class="form-control" name="return_date" type="date" id="return_date" value="{{ old('return_date', optional($issueBook)->return_date) }}" placeholder="Enter return date here...">
        {!! $errors->first('return_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="control-group {{ $errors->has('notes') ? 'has-error' : '' }}">
    <label for="notes" class="col-md-2 control-label">Notes</label>
    <div class="controls">
        <textarea class="form-control" name="notes" cols="50" rows="10" id="notes" minlength="1" maxlength="1000">{{ old('notes', optional($issueBook)->notes) }}</textarea>
        {!! $errors->first('notes', '<p class="help-block">:message</p>') !!}
    </div>
</div>

