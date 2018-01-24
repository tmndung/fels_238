@extends ('templates.admin.master')

@section ('content')
    @include ('common.errors')
    <div class="panel top-admin-panel">
        <div class="panel-body">
            <div class="col-md-12 padding-0" style="padding-bottom:20px;">
                <div class="col-md-3" style="padding-left:10px;">
                    <input type="checkbox" id="checkAllUser" class="icheck pull-left checkbox-input" name="checkbox1"/>
                    <a href="" id="btnDelUser" onclick="return confirm('{{ trans('lang.msgDel') }}')" class="btn btn-danger">@lang('lang.deleteBtn')</a>
                </div>
                <div class="header-content row col-md-3">
                    {{ Form::open(['route' => 'admin.users.create', 'method' => 'GET', 'class' => 'col-xs-7']) }}
                        {{ Form::button('<i class="fa fa-plus"></i> ' . trans('lang.addBtn'), array('type' => 'submit', 'class' => 'btn btn-default')) }}
                    {{ Form::close() }}
                </div>
                <div class="search col-md-4 search-user">
                    <div>
                        {{ Form::text('search-user-input', '', ['id' => 'search-user-input', 'class' => 'form-text', 'required' => 'required', 'placeholder' => trans('lang.type_to_search')]) }}
                        {{ Form::button('<i class="fa fa-search icon-search"></i>', [ 'class' => 'btn btn-default', 'id' => 'search-user-btn']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-users">
        <div class="responsive-table">
            <table class="table table-striped table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="4%">@lang('lang.choose')</th>
                        <th width="4%">@lang('lang.stt')</th>
                        <th width="20%">@lang('lang.username')</th>
                        <th width="25%">@lang('lang.email')</th>
                        <th width="9%">@lang('lang.avatar')</th>
                        <th width="9%">@lang('lang.coursesLearn')</th>
                        @if (Auth::user()->id == config('setting.idBossAdmin'))
                            <th width="8%">@lang('lang.admin-low')</th>
                        @endif
                        <th width="20%">@lang('lang.function')</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($users))
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    @if (Auth::user()->id != $user->id && $user->id != config('setting.idBossAdmin'))
                                        <input type="checkbox" class="icheck checkbox-input user-check" name="checkbox1" userId="{{ $user->id }}"/>
                                    @endif
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td><img src="{{ $user->avatar_path }}" class="picture"></td>
                                <td>{{ count($user->studies()) }}</td>
                                @if (Auth::user()->id == config('setting.idBossAdmin'))   
                                    <td>
                                        @if ($user->id == config('setting.idBossAdmin'))
                                            <img src="/templates/admin/images/tick.png" class="check-icon">
                                        @else
                                            <input type="checkbox" class="icheck checkbox-input admin-active" name="active" user="{{ $user->id }}" {{ ($user->is_admin) ? 'checked' : '' }}/>
                                        @endif
                                    </td>
                                @endif
                                <td>
                                    @if ($user->id != config('setting.idBossAdmin') || Auth::user()->id == config('setting.idBossAdmin'))
                                        {{ Form::open(['route' => ['admin.users.edit', $user->id], 'method' => 'GET', 'class' => 'button-form']) }}
                                            {{ Form::button('<i class="fa fa-pencil"></i> ' . trans('lang.editBtn'), ['type' => 'submit', 'class' => 'btn btn-info']) }}
                                        {{ Form::close() }}
                                        @if (Auth::user()->id != $user->id)
                                            {{ Form::open(['route' => ['admin.users.destroy', $user->id], 'class' => 'button-form']) }}
                                                {{ method_field('DELETE') }}
                                                {{ Form::button('<i class="fa fa-trash"></i> ' . trans('lang.deleteBtn'), ['type' => 'submit', 'onclick' => 'return confirm("' . trans('lang.msgDel') . '")', 'class' => 'btn btn-danger']) }}
                                            {{ Form::close() }}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            {{ $users->links() }}
        </div>
    </div>
@endsection
