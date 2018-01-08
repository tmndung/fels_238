@extends ('templates.admin.master')

@section ('content')
    <div class="header-content row">
        {{ Form::open(['route' => 'admin.category.create', 'method' => 'GET', 'class' => 'col-xs-7']) }}
            {{ Form::button('<i class="fa fa-plus"></i> ' . trans('lang.addBtn'), ['type' => 'submit', 'class' => 'add']) }}
        {{ Form::close() }}
    </div>
    <br>
    
    @include ('common.errors')

    <table class="tb-admin" width="100%">
        <tr>
            <th width="10%">@lang('lang.stt')</th>
            <th width="40%">@lang('lang.name')</th>
            <th width="30%">@lang('lang.parent')</th>
            <th width="30%">@lang('lang.function')</th>
        </tr>
        @if (count($objCategories))
            @foreach ($objCategories as $objCategory)
                @if ($objCategory->parent_id == 0)
                    <tr class="bg-gray">
                        <td><strong>{{ $loop->iteration }}</strong></td>
                        <td><strong>{{ str_limit($objCategory->name, 25, '...') }}</strong></td>
                        <td></td>
                        <td >
                            {{ Form::open(['route' => ['admin.category.edit', $objCategory->id], 'method' => 'GET', 'class' => 'button-form']) }}
                                {{ Form::button('<i class="fa fa-pencil"></i> ' . trans('lang.editBtn'), ['type' => 'submit', 'class' => 'edit']) }}
                            {{ Form::close() }}

                            {{ Form::open(['route' => ['admin.category.destroy', $objCategory->id], 'class' => 'button-form']) }}
                                {{ method_field('DELETE') }}
                                {{ Form::button('<i class="fa fa-trash"></i> ' . trans('lang.deleteBtn'), ['type' => 'submit', 'onclick' => 'return confirm("' . trans('lang.msgDel') . '")', 'class' => 'delete']) }}
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endif
                @foreach ($objCategories as $objSubCategory)
                    @if ($objSubCategory->parent_id == $objCategory->id)
                        <tr>
                            <td></td>
                            <td><i>{{ str_limit($objSubCategory->name, 25, '...') }}</i></td>
                            <td><i>{{ $objSubCategory->name }}</i></td>
                            <td >
                                {{ Form::open(['route' => ['admin.category.edit', $objSubCategory->id], 'method' => 'GET', 'class' => 'button-form']) }}
                                {{ Form::button('<i class="fa fa-pencil"></i> ' . trans('lang.editBtn'), ['type' => 'submit', 'class' => 'edit']) }}
                            {{ Form::close() }}

                            {{ Form::open(['route' => ['admin.category.destroy', $objSubCategory->id], 'class' => 'button-form']) }}
                                {{ method_field('DELETE') }}
                                {{ Form::button('<i class="fa fa-trash"></i> ' . trans('lang.deleteBtn'), ['type' => 'submit', 'onclick' => 'return confirm("' . trans('lang.msgDel') . '")', 'class' => 'delete']) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
        @endif
    </table>
    {{ $objCategories->links() }}
@endsection
