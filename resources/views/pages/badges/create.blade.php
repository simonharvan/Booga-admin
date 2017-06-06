@extends('layout.authenticated')

@section('breadcrumbs')
    <h1>
        <a href="{{ route('admin.badges.index') }}"><i class="fa fa-arrow-circle-left"></i></a> Create Avatars
    </h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.badges.index') }}">Avatars</a></li>
        <li class="active">Add</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-body">
            <form id="store-badge" action="{{ route('admin.badges.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="json" id="json">
                <div class="row col-xs-12">
                    <h2>General info</h2>
                    <div class="col-xs-6">
                        <div class="col-xs-12 no-padding @include('layout.components.validation_color', ['name' => 'name'])">
                            <label>Name</label>
                            <input class="form-control" type="text"
                                   value="{{ old('name') }}"
                                   placeholder="Enter name" name="name">
                            @include('layout.components.validation_error', ['name' => 'name'])
                        </div>
                        <div class="col-xs-12  no-padding @include('layout.components.validation_color', ['name' => 'description'])">
                            <label>Description</label>
                            <input class="form-control" type="text" placeholder="Enter description" name="description"
                                   value="{{ old('description') }}">
                            @include('layout.components.validation_error', ['name' => 'description'])
                        </div>

                    </div>
                    <div class="col-xs-6">
                        <div class="col-xs-12 no-padding ">
                            <label for="badge-picture">Picture</label>
                            <input class="form-control col-xs-3" type="file" id="badge-picture" name="badge-picture">
                        </div>
                    </div>
                </div>

                <div class="row col-xs-12 conditions-area">
                    <h2>Conditions</h2>
                    <span class="badge badge-info">
                        <span href="#" data-toggle="tooltip"
                              title="When you have more conditions, they are evaluated with logic operator AND. So all conditions have to be meet to gain badge&nbsp;Script should be regular SQL SELECT. If this SELECT returns 1 or more result it's evaluated as success.">
                            Help <i class="fa phpdebugbar-fa-question-circle"></i>
                        </span>
                    </span>
                    <div class="condition" id="condition-1">
                        <h4 class="condition-name">Condition</h4>
                        <div class="col-xs-12">
                            <div class="col-xs-12 no-padding">
                                <label>
                                    SQL script
                                </label>
                                <textarea class="form-control" type="text"
                                          value="{{ old('script') }}"
                                          placeholder="Enter script" name="script"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <label>Event type</label>
                            <select class="form-control" id="event_type">
                                @foreach($eventTypes as $eventType)
                                    <option value="{{ $eventType->id  }}">{{ $eventType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-4">
                            <div class="col-xs-12 no-padding ">
                                <label>Operator</label>
                                <select class="form-control" id="operator">
                                    <option value=">">&gt;</option>
                                    <option value=">=">&gt;=</option>
                                    <option value="==">=</option>
                                    <option value="<=">&lt;=</option>
                                    <option value="<">&lt;</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="col-xs-12 no-padding ">
                                <label>Number</label>
                                <input class="form-control" value="{{ old('number') }}"
                                       placeholder="Enter number" type="number" name="number">
                            </div>
                        </div>
                        <hr class="col-xs-12">
                    </div>
                </div>
                <div class="col-xs-12">
                    <a class="btn btn-success" id="add-condition"><i class="fa phpdebugbar-fa-plus-circle"></i> Add
                        condition</a>
                    <a class="btn btn-danger" id="remove-condition"><i class="fa phpdebugbar-fa-minus-circle"></i>
                        Remove condition</a>
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