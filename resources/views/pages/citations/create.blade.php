@extends('layout.authenticated')

@section('breadcrumbs')
    <h1>
        <a href="{{ route('admin.citations.index') }}"><i class="fa fa-arrow-circle-left"></i></a> Create citation
    </h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.citations.index') }}">Citations</a></li>
        <li class="active">Add</li>
    </ol>
@endsection

@section('content')

    @if(isset($success))
        <div class="alert alert-success" role="alert"><strong>Success!</strong> Citation saved.</div>
    @endif

    @if($errors->has('text'))
        <div class="alert alert-error" role="alert"><strong>Error!</strong> Citation not saved. Enter text</div>
    @endif
    <div class="box">
        <div class="box-body">
            <form action="{{ route('admin.citations.store') }}" method="post">
                {{ csrf_field() }}
                <div class="col-xs-12">
                    <div class="col-xs-12">
                        <label>Text of citation</label>
                        <input class="form-control" type="text"
                               value="{{ old('text') }}"
                               placeholder="Enter text" name="text">
                    </div>
                    <div class="col-xs-12">
                        <label>Author</label>
                        <input class="form-control" type="text" placeholder="Enter author" name="author"
                               value="{{ old('author') }}">
                    </div>
                    <div class="col-xs-3">
                        <label>From</label>
                        <input class="form-control" type="number" placeholder="Enter from" name="from"
                               value="" min="0" max="100">
                    </div>
                    <div class="col-xs-3">
                        <label>To</label>
                        <input class="form-control" type="number" placeholder="Enter to" name="to"
                               value="" min="0" max="100">
                    </div>
                    <div class="col-xs-3 ">
                        <label>Genre</label>
                        <select class="form-control" id="sel1">
                            @foreach($genres as $gen)
                                <option>{{ $gen->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-3 ">
                        <label>&nbsp;</label>
                        <div class="checkbox">
                            <label>
                                <input class="checkbox" type="checkbox" name="without_genre"
                                       value="true"> Without genre
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-12 margin-top">
                        <button type="submit" class="btn btn-success btn-quirk pull-right"><i
                                    class="fa fa-save"></i>
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection