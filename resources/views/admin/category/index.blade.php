@extends ('templates.admin.master')

@section ('content')
    @include ('common.errors')
    <div class="panel top-admin-panel">
        <div class="panel-body">
            <div class="col-md-12 padding-0" style="padding-bottom:20px;">
                <div class="col-md-3" style="padding-left:10px;">
                    <input type="checkbox" id="checkAll" class="icheck pull-left checkbox-input" name="checkbox1"/>
                    <a href="" id="btnDelCategory" onclick="return confirm('{{ trans('lang.msgDel') }}')" class="btn btn-danger">@lang('lang.deleteBtn')</a>
                </div>
                <div class="header-content row col-md-3">
                    {{ Form::open(['route' => 'admin.category.create', 'method' => 'GET', 'class' => 'col-xs-7']) }}
                        {{ Form::button('<i class="fa fa-plus"></i> ' . trans('lang.addBtn'), array('type' => 'submit', 'class' => 'btn btn-default')) }}
                    {{ Form::close() }}
                </div>
                <div class="col-md-6">
                    <div class="col-lg-12">
                        <div class="input-group">
                            <input type="text" class="form-control search-category" aria-label="...">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('lang.search')</button>
                            </div><!-- /btn-group -->
                        </div><!-- /input-group -->
                    </div>
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
        </div>
    </div>
    <div class="responsive-table">
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
                @if (count($objCategories))
                    @foreach ($objCategories as $objCategory)
                        @if ($objCategory->parent_id == 0)
                            <tr class="bg-gray">
                                <td><input type="checkbox" name="checkboxCategory" id="{{ $objCategory->id }}" class="sub-checkall checkboxCategory icheck checkbox-input" name="checkbox1" /></td>
                                <td><strong>{{ $loop->iteration }}</strong></td>
                                <td><strong>{{ str_limit($objCategory->name, 25, '...') }}</strong></td>
                                <td></td>
                                <td >
                                    {{ Form::open(['route' => ['admin.category.edit', $objCategory->id], 'method' => 'GET', 'class' => 'button-form col-md-6']) }}
                                        {{ Form::button('<i class="fa fa-pencil"></i> ' . trans('lang.editBtn'), ['type' => 'submit', 'class' => 'btn btn-info']) }}
                                    {{ Form::close() }}

                                    {{ Form::open(['route' => ['admin.category.destroy', $objCategory->id], 'class' => 'button-form col-md-6']) }}
                                        {{ method_field('DELETE') }}
                                        {{ Form::button('<i class="fa fa-trash"></i> ' . trans('lang.deleteBtn'), ['type' => 'submit', 'onclick' => 'return confirm("' . trans('lang.msgDel') . '")', 'class' => 'btn btn-danger']) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endif
                        @if (count($objCategory->categories))
                            @foreach ($objCategory->categories as $objSubCategory)
                                <tr>
                                    <td><input type="checkbox" name="checkboxCategory" id="{{ $objSubCategory->id }}" class="checkboxCategory icheck checkbox-input {{ 'checkboxCategory' . $objCategory->id }}" name="checkbox1" parent="{{ $objCategory->id }}"/></td>
                                    <td></td>
                                    <td><i>{{ str_limit($objSubCategory->name, 25, '...') }}</i></td>
                                    <td><i>{{ str_limit($objSubCategory->category->name, 25) }}</i></td>
                                    <td >
                                        {{ Form::open(['route' => ['admin.category.edit', $objSubCategory->id], 'method' => 'GET', 'class' => 'button-form col-md-6']) }}
                                        {{ Form::button('<i class="fa fa-pencil"></i> ' . trans('lang.editBtn'), ['type' => 'submit', 'class' => 'btn btn-info']) }}
                                    {{ Form::close() }}

                                    {{ Form::open(['route' => ['admin.category.destroy', $objSubCategory->id], 'class' => 'button-form col-md-6']) }}
                                        {{ method_field('DELETE') }}
                                        {{ Form::button('<i class="fa fa-trash"></i> ' . trans('lang.deleteBtn'), ['type' => 'submit', 'onclick' => 'return confirm("' . trans('lang.msgDel') . '")', 'class' => 'btn btn-danger']) }}
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                @endif
            </tbody>
        </table>
        <div class="col-md-6">
            {{ $objCategories->links() }}
        </div>
    </div>
@endsection
