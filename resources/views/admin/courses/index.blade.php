@extends ('templates.admin.master')

@section ('content')
    {{ Form::open(['route' => 'admin.courses.create', 'method' => 'GET']) }}
        {{ Form::button('<i class="fa fa-plus"></i> ' . trans('lang.addBtn'), ['type' => 'submit', 'class' => 'add']) }}
    {{ Form::close() }}
    <br/>

    @include ('common.errors')
    
    <table class="tb-admin" width="100%">
        <tr>
            <th width="2%">@lang('lang.stt')</th>
            <th width="19.5%">@lang('lang.courseName')</th>
            <th width="11%">@lang('lang.category')</th>
            <th width="10.5%">@lang('lang.totalLesson')</th>
            <th width="15%">@lang('lang.information')</th>
            <th width="10%">@lang('lang.picture')</th>
            <th width="5%">@lang('lang.lessons')</th>
            <th width="11%">@lang('lang.usersLearn')</th>
            <th width="16%">@lang('lang.function')</th>
        </tr>
        @if (count($courses))
            @foreach ($courses as $course)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->category->name }}</td>
                    <td>{{ $course->number_of_lesson }}</td>
                    <td>{{ str_limit($course->information, 25, ' ...') }}</td>
                    <td><img src="{{ $course->picture_path }}" class="picture"></td>
                    <td>
                        <a href=""><i class="fa fa-eye" class="icon-see"></i></a>
                    </td>
                    <td>{{ count($course->studies) }}</td>
                    <td >
                        {{ Form::open(['route' => ['admin.courses.edit', $course->id], 'method' => 'GET', 'class' => 'button-form']) }}
                            {{ Form::button('<i class="fa fa-pencil"></i> ' . trans('lang.editBtn'), ['type' => 'submit', 'class' => 'edit']) }}
                        {{ Form::close() }}

                        {{ Form::open(['route' => ['admin.courses.destroy', $course->id], 'class' => 'button-form']) }}
                            {{ method_field('DELETE') }}
                            {{ Form::button('<i class="fa fa-trash"></i> ' . trans('lang.deleteBtn'), ['type' => 'submit', 'onclick' => 'return confirm("' . trans('lang.msgDel') . '")', 'class' => 'delete']) }}
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
        @endif
    </table>

    {{ $courses->links() }}

@endsection
