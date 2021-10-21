<div class="control-group {{ $errors->has('title') ? 'has-error' : '' }}">
    <label for="title" class="col-md-2 control-label">Title of Book</label>

    <div class="controls">
        <input class="form-control" name="title" type="text" id="title"
               value="{{ old('title', optional($book)->title) }}" minlength="1" maxlength="255"
               placeholder="Enter title here...">
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="control-group {{ $errors->has('author') ? 'has-error' : '' }}">
    <label for="author" class="col-md-2 control-label">Author</label>
    <div class="controls">
        <input class="form-control" name="author" type="text" id="author"
               value="{{ old('author', optional($book)->author) }}" minlength="1" placeholder="Enter author here...">
        {!! $errors->first('author', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="control-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="col-md-2 control-label">Description</label>
    <div class="controls">
        <textarea class="form-control" name="description" cols="50" rows="3" id="description" minlength="1"
                  maxlength="1000">{{ old('description', optional($book)->description) }}</textarea>
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="control-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
    <label for="category_id" class="col-md-2 control-label">Category</label>
    <div class="controls">
        <select class="form-control" id="category_id" name="category_id">
            <option value="" style="display: none;"
                    {{ old('category_id', optional($book)->category_id ?: '') == '' ? 'selected' : '' }} disabled
                    selected>Select category
            </option>
            @foreach ($categories as $key => $category)
                <option
                    value="{{ $key }}" {{ old('category_id', optional($book)->category_id) == $key ? 'selected' : '' }}>
                    {{ $category }}
                </option>
            @endforeach
        </select>

        {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="control-group {{ $errors->has('stock') ? 'has-error' : '' }}">
    <label for="stock" class="col-md-2 control-label">How Many Copies Do You Have?</label>
    <div class="controls">
        <input class="form-control" name="stock" type="number" id="stock"
               value="{{ old('stock', optional($book)->stock) }}" minlength="1" placeholder="Total Available Copy">
        {!! $errors->first('stock', '<p class="help-block">:message</p>') !!}
    </div>
</div>

