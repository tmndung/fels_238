<div class="responsive-table animated fadeInUp">
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
                            <input type="checkbox" class="icheck checkbox-input user-check" name="checkbox1" userId="{{ $user->id }}"/>
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

                                {{ Form::open(['route' => ['admin.users.destroy', $user->id], 'class' => 'button-form']) }}
                                    {{ method_field('DELETE') }}
                                    {{ Form::button('<i class="fa fa-trash"></i> ' . trans('lang.deleteBtn'), ['type' => 'submit', 'onclick' => 'return confirm("' . trans('lang.msgDel') . '")', 'class' => 'btn btn-danger']) }}
                                {{ Form::close() }}
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
