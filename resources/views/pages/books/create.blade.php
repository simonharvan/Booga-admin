@extends('layout.authenticated')

@section('breadcrumbs')
    <h1>
        <a href="{{ route('admin.books.index') }}"><i class="fa fa-arrow-circle-left"></i></a> Create book
    </h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.books.index') }}">Books</a></li>
        <li class="active">Add</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-body">
            <form action="{{ route('admin.books.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-xs-8 ">
                    <label><i class="fa fa-search"></i> Search</label>
                    <input class="form-control" type="text"
                           value=""
                           placeholder="Search" name="search">
                </div>
                <div class="col-xs-4">
                    <label>Library</label>
                    <select class="form-control" id="libraries">
                        @foreach($libraries as $library)
                            <option value="{{ $library->id  }}">{{ $library->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-6">
                    <div class="col-xs-12 no-padding @include('layout.components.validation_color', ['name' => 'name'])">
                        <label>Name</label>
                        <input class="form-control" type="text"
                               value="{{ old('name') }}"
                               placeholder="Enter name" name="name">
                        @include('layout.components.validation_error', ['name' => 'name'])
                    </div>
                    <div class="col-xs-12  no-padding @include('layout.components.validation_color', ['name' => 'isbn'])">
                        <label>ISBN</label>
                        <input class="form-control" type="text" placeholder="Enter ISBN" name="isbn"
                               value="{{ old('isbn') }}">
                        @include('layout.components.validation_error', ['name' => 'isbn'])
                    </div>
                    <div class="col-xs-12  no-padding @include('layout.components.validation_color', ['name' => 'isbn'])">
                        <label>Author</label>
                        <input class="form-control" type="text" placeholder="Enter author" name="author"
                               value="{{ old('author') }}">
                        @include('layout.components.validation_error', ['name' => 'author'])
                    </div>
                    <div class="col-xs-12  no-padding @include('layout.components.validation_color', ['name' => 'genre'])">
                        <label>Genre</label>
                        <select class="form-control" id="sel1">
                            @foreach($genre as $gen)
                                <option value="{{ $gen->id  }}">{{ $gen->name }}</option>
                            @endforeach
                        </select>
                        @include('layout.components.validation_error', ['name' => 'genre'])
                    </div>
                    <div class="col-xs-12  no-padding @include('layout.components.validation_color', ['name' => 'focus_level'])">
                        <span href="#" data-toggle="tooltip"
                              title="Number which sets how far from center will be book generated. Number from 1 to 5">
                            <label>Generation focus level <i class="fa fa-question-circle"></i></label>
                        </span>
                        <input class="form-control" type="number" placeholder="Enter level" name="focus_level"
                               value="{{ old('focus_level') }}" max="5" min="1">
                        @include('layout.components.validation_error', ['name' => 'focus_level'])

                    </div>

                </div>
                <div class="col-xs-6">
                    <div class="col-xs-5 no-padding ">
                        <div class="col-xs-12 no-padding">
                            <label for="book_cover">Book cover</label>
                            <input class="form-control col-xs-3" type="file" id="profile_photo" name="book_cover">
                        </div>
                        <div class="col-xs-12 no-padding @include('layout.components.validation_color', ['name' => 'year_published'])">
                            <label>Year published</label>
                            <input class="form-control" type="number" max="2020" placeholder="Enter level"
                                   name="year_published"
                                   value="{{ old('year_published') }}">
                            @include('layout.components.validation_error', ['name' => 'year_published'])
                        </div>
                        <div class="col-xs-12 no-padding @include('layout.components.validation_color', ['name' => 'energy'])">
                        <span href="#" data-toggle="tooltip"
                              title="Energy needed to add book to library.">
                            <label>Energy for clearing <i class="fa fa-question-circle"></i></label>
                        </span>
                            <input class="form-control" type="number" placeholder="Enter amount of energy" name="energy"
                                   value="{{ old('energy') }}" max="200" min="1">
                            @include('layout.components.validation_error', ['name' => 'energy'])

                        </div>
                        <div class="col-xs-12 no-padding @include('layout.components.validation_color', ['name' => 'time_clearing'])">
                        <span href="#" data-toggle="tooltip"
                              title="Time that will be needed for picking up book and start clearing it. (Helpers time)">
                            <label>Time for clearing <i class="fa fa-question-circle"></i></label>
                        </span>
                            <input class="form-control" type="number" placeholder="Enter time in sec" name="time_clearing"
                                   value="{{ old('time_clearing') }}" max="3600" min="1">
                            @include('layout.components.validation_error', ['name' => 'time_clearing'])

                        </div>
                    </div>
                    <div class="margin-top col-xs-6 no-padding col-xs-offset-1">
                        <a id="load-cover" class="margin-bottom btn btn-default">Load book cover</a>
                        <input type="hidden" name="cover_photo_url">
                        <img class="cover-image" src="">
                    </div>

                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-success btn-quirk pull-right"><i class="fa fa-save"></i>
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection