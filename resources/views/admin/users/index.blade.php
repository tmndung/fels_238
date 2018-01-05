@extends ('templates.admin.master')

@section ('content')
    {{ Form::open(['url' => route('admin.users.create'), 'method' => 'GET']) }}
        {{ Form::button('<i class="fa fa-plus"></i> ' . trans('lang.addBtn'), ['type' => 'submit', 'class' => 'add']) }}
    {{ Form::close() }}
    <br/>

    @include ('common.errors')
    
    <table class="tb-admin" width="100%">
        <tr>
            <th width="3%">@lang('lang.stt')</th>
            <th width="15%">@lang('lang.username')</th>
            <th width="20%">@lang('lang.email')</th>
            <th width="13%">@lang('lang.facebook')</th>
            <th width="13%">@lang('lang.twitter')</th>
            <th width="10%">@lang('lang.avatar')</th>
            <th width="16%">@lang('lang.function')</th>
        </tr>
        @if (count($users))
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->facebook }}</td>
                    <td>{{ $user->twitter }}</td>
                    <td><img src="{{ $user->avatar_path }}" class="picture"></td>
                    <td >
                        {{ Form::open(['route' => ['admin.users.edit', $user->id], 'method' => 'GET', 'class' => 'button-form']) }}
                            {{ Form::button('<i class="fa fa-pencil"></i> ' . trans('lang.editBtn'), ['type' => 'submit', 'class' => 'edit']) }}
                        {{ Form::close() }}

                        {{ Form::open(['route' => ['admin.users.destroy', $user->id], 'class' => 'button-form']) }}
                            {{ method_field('DELETE') }}
                            {{ Form::button('<i class="fa fa-trash"></i> ' . trans('lang.deleteBtn'), ['type' => 'submit', 'onclick' => 'return confirm("' . trans('lang.msgDel') . '")', 'class' => 'delete']) }}
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
        @endif
    </table>

    {{ $users->links() }}

@endsection
