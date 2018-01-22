<table class="table table-striped table-bordered" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th width="10%">@lang('lang.choose')</th>
        <th width="10%">@lang('lang.stt')</th>
        <th width="30%">@lang('lang.name')</th>
        <th width="30%">@lang('lang.parent')</th>
        <th width="30%">@lang('lang.function')</th>
      </tr>
    </thead>
    <tbody>
        @if (count($categories))
            @foreach ($categories as $category)
                <tr class="bg-gray">
                    <td><input type="checkbox" name="checkboxCategory" id="{{ $category->id }}" class="sub-checkall checkboxCategory icheck checkbox-input" name="checkbox1" /></td>
                    <td><strong>{{ $loop->iteration }}</strong></td>
                    <td><strong>{{ str_limit($category->name, 25, '...') }}</strong></td>
                    <td>{{ $category->parent_id == 0 ? '' : $category->category->name }}</td>
                    <td >
                        {{ Form::open(['route' => ['admin.category.edit', $category->id], 'method' => 'GET', 'class' => 'button-form col-md-6']) }}
                            {{ Form::button('<i class="fa fa-pencil"></i> ' . trans('lang.editBtn'), ['type' => 'submit', 'class' => 'btn btn-info']) }}
                        {{ Form::close() }}

                        {{ Form::open(['route' => ['admin.category.destroy', $category->id], 'class' => 'button-form col-md-6']) }}
                            {{ method_field('DELETE') }}
                            {{ Form::button('<i class="fa fa-trash"></i> ' . trans('lang.deleteBtn'), ['type' => 'submit', 'onclick' => 'return confirm("' . trans('lang.msgDel') . '")', 'class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
