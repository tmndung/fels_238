<div class="responsive-table animated fadeInUp">
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
