@extends ('templates.admin.master')

@section ('content')
    @include ('common.errors')
    <div class="panel top-admin-panel">
        <div class="panel-body">
            <div class="col-md-12 padding-0" style="padding-bottom:20px;">
                <div class="col-md-3" style="padding-left:10px;">
                    <input type="checkbox" id="checkAllCourse" class="icheck pull-left checkbox-input" name="checkbox1"/>
                    <a href="" id="btnDelCourse" onclick="return confirm('{{ trans('lang.msgDel') }}')" class="btn btn-danger">@lang('lang.deleteBtn')</a>
                </div>
                <div class="header-content row col-md-3">
                    {{ Form::open(['route' => 'admin.courses.create', 'method' => 'GET', 'class' => 'col-xs-7']) }}
                        {{ Form::button('<i class="fa fa-plus"></i> ' . trans('lang.addBtn'), array('type' => 'submit', 'class' => 'btn btn-default')) }}
                    {{ Form::close() }}
                </div>
                <div class="search col-md-4 search-user">
                    <div>
                        {{ Form::text('search-user-input', '', ['id' => 'search-course-input', 'class' => 'form-text', 'required' => 'required', 'placeholder' => trans('lang.type_to_search')]) }}
                        {{ Form::button('<i class="fa fa-search icon-search"></i>', [ 'class' => 'btn btn-default', 'id' => 'search-course-btn']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-course">
        <div class="responsive-table">
            <table class="table table-striped table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">@lang('lang.choose')</th>
                        <th width="5%">@lang('lang.stt')</th>
                        <th width="20%">@lang('lang.courseName')</th>
                        <th width="20%">@lang('lang.category')</th>
                        <th width="10%">@lang('lang.totalLesson')</th>
                        <th width="10%">@lang('lang.picture')</th>
                        <th width="10%">@lang('lang.usersLearn')</th>
                        <th width="20%">@lang('lang.function')</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($courses))
                        @foreach ($courses as $course)
                            <tr>
                                <td>
                                    <input type="checkbox" class="icheck checkbox-input course-check" name="checkbox1" courseId="{{ $course->id }}"/>
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->category->name }}</td>
                                <td>{{ $course->number_of_lesson }}</td>
                                <td><img src="{{ $course->picture_path }}" class="img-lesson"></td>
                                <td>{{ count($course->studies) }}</td>
                                <td >
                                    {{ Form::open(['route' => ['admin.courses.edit', $course->id], 'method' => 'GET', 'class' => 'button-form']) }}
                                        {{ Form::button('<i class="fa fa-pencil"></i> ' . trans('lang.editBtn'), ['type' => 'submit', 'class' => 'btn btn-info']) }}
                                    {{ Form::close() }}

                                    {{ Form::open(['route' => ['admin.courses.destroy', $course->id], 'class' => 'button-form']) }}
                                        {{ method_field('DELETE') }}
                                        {{ Form::button('<i class="fa fa-trash"></i> ' . trans('lang.deleteBtn'), ['type' => 'submit', 'onclick' => 'return confirm("' . trans('lang.msgDel') . '")', 'class' => 'btn btn-danger']) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            {{ $courses->links() }}
        </div>
    </div>

@endsection
