<table class="table table-striped table-bordered" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th width="5%">@lang('lang.choose')</th>
        <th width="5%">@lang('lang.stt')</th>
        <th width="10%">@lang('lang.word')</th>
        <th width="20%">@lang('lang.pronunciation')</th>
        <th width="25%">@lang('lang.explain')</th>
        <th width="15%">@lang('lang.lesson')</th>
        <th width="20%">@lang('lang.function')</th>
      </tr>
    </thead>
    <tbody>
        @if (count($wordlists))
            @foreach ($wordlists as $wordlist)
                <tr>
                    <td><input type="checkbox" class="checkwordlist icheck checkbox-input" name="checkbox1" id="{{ $wordlist->id }}"/></td>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ str_limit($wordlist->name, 25, '...') }}</td>
                    <td>{{ str_limit($wordlist->pronunciation, 20, '...') }}</td>
                    <td>{{ str_limit($wordlist->explain, 25, '...') }}</td>
                    <td>{{ str_limit($wordlist->lesson->name, 15, '...') }}</td>
                    <td >
                        {{ Form::open(['route' => ['admin.wordlist.edit', $wordlist->id], 'method' => 'GET', 'class' => 'button-form col-md-6'])}}
                            {{ Form::button('<i class="fa fa-pencil"></i> ' . trans('lang.editBtn'), ['type' => 'submit', 'class' => 'btn btn-info']) }}
                        {{ Form::close() }}

                        {{ Form::open(['route' => ['admin.wordlist.destroy', $wordlist->id], 'class' => 'button-form col-md-6']) }}
                            {{ method_field('DELETE') }}
                            {{ Form::button('<i class="fa fa-trash"></i> ' . trans('lang.deleteBtn'), ['type' => 'submit', 'onclick' => 'return confirm("' . trans('lang.msgDel') . '")', 'class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
