@extends ('templates.admin.master')

@section ('content')
    <div class="header-content row">
        {{ Form::open(['route' => 'admin.wordlist.create', 'method' => 'GET', 'class' => 'col-xs-7']) }}
            {{ Form::button('<i class="fa fa-plus"></i> ' . trans('lang.addBtn'), array('type' => 'submit', 'class' => 'add')) }}
        {{ Form::close() }}
    </div>
    <br>
    
    @include ('common.errors')

    <table class="tb-admin" width="100%">
        <tr>
            <th width="5%">@lang('lang.stt')</th>
            <th width="10%">@lang('lang.word')</th>
            <th width="20%">@lang('lang.pronunciation')</th>
            <th width="30%">@lang('lang.explain')</th>
            <th width="15%">@lang('lang.lesson')</th>
            <th width="20%">@lang('lang.function')</th>
        </tr>
        @if (count($objWordLists))
            @foreach ($objWordLists as $objWordList)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ str_limit($objWordList->name, 25, '...') }}</td>
                    <td>{{ str_limit($objWordList->pronunciation, 20, '...') }}</td>
                    <td>{{ str_limit($objWordList->explain, 25, '...') }}</td>
                    <td>{{ str_limit($objWordList->lesson->name, 15, '...') }}</td>
                    <td >
                        {{ Form::open(['route' => ['admin.wordlist.edit', $objWordList->id], 'method' => 'GET', 'class' => 'button-form'])}}
                            {{ Form::button('<i class="fa fa-pencil"></i> ' . trans('lang.editBtn'), ['type' => 'submit', 'class' => 'edit']) }}
                        {{ Form::close() }}

                        {{ Form::open(['route' => ['admin.wordlist.destroy', $objWordList->id], 'class' => 'button-form']) }}
                            {{ method_field('DELETE') }}
                            {{ Form::button('<i class="fa fa-trash"></i> ' . trans('lang.deleteBtn'), ['type' => 'submit', 'onclick' => 'return confirm("' . trans('lang.msgDel') . '")', 'class' => 'delete']) }}
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
        @endif
    </table>
    {{ $objWordLists->links() }}
@endsection
