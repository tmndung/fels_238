@extends ('templates.admin.master')

@section ('content')
    @include ('common.errors')
    <div class="panel">
        <div class="panel-body">
            <div class="col-md-12 padding-0" style="padding-bottom:20px;">
                <div class="col-md-3" style="padding-left:10px;">
                    <input type="checkbox" id="checkAll" class="icheck pull-left checkbox-input" name="checkbox1"/>
                    <a href="" id="btnDelWordList" onclick="return confirm('{{ trans('lang.msgDel') }}')" class="btn btn-danger">@lang('lang.deleteBtn')</a>
                </div>
                <div class="header-content row col-md-3">
                    {{ Form::open(['route' => 'admin.wordlist.create', 'method' => 'GET', 'class' => 'col-xs-7']) }}
                        {{ Form::button('<i class="fa fa-plus"></i> ' . trans('lang.addBtn'), array('type' => 'submit', 'class' => 'btn btn-default')) }}
                    {{ Form::close() }}
                </div>
                <div class="col-md-6">
                    <div class="col-sm-12 padding-0">
                        {{ Form::open() }}
                            {{ Form::select('lessons', $lessons, config('setting.all_wordlist'), ['class' => 'form-control', 'id' => 'selectLesson']) }}
                        {{ Form::close() }}
                    </div>
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
        </div>
    </div>
    <div class="content-wordlist">
        <div class="responsive-table">
            <table class="table table-striped table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th width="5%">@lang('lang.choose')</th>
                    <th width="5%">@lang('lang.stt')</th>
                    <th width="10%">@lang('lang.word')</th>
                    <th width="20%">@lang('lang.pronunciation')</th>
                    <th width="22%">@lang('lang.explain')</th>
                    <th width="14%">@lang('lang.lesson')</th>
                    <th width="24%">@lang('lang.function')</th>
                  </tr>
                </thead>
                <tbody>
                    @if (count($objWordLists))
                        @foreach ($objWordLists as $objWordList)
                            <tr>
                                <td><input type="checkbox" name="checkboxWordlist" id="{{ $objWordList->id }}" class="checkwordlist icheck checkbox-input" name="checkbox1" /></td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ str_limit($objWordList->name, 20, '...') }}</td>
                                <td>{{ str_limit($objWordList->pronunciation, 20, '...') }}</td>
                                <td>{{ str_limit($objWordList->explain, 20, '...') }}</td>
                                <td>{{ str_limit($objWordList->lesson->name, 15, '...') }}</td>
                                <td >
                                    {{ Form::open(['route' => ['admin.wordlist.edit', $objWordList->id], 'method' => 'GET', 'class' => 'button-form col-md-6'])}}
                                        {{ Form::button('<i class="fa fa-pencil"></i> ' . trans('lang.editBtn'), ['type' => 'submit', 'class' => 'btn btn-info']) }}
                                    {{ Form::close() }}

                                    {{ Form::open(['route' => ['admin.wordlist.destroy', $objWordList->id], 'class' => 'button-form col-md-6']) }}
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
            {{ $objWordLists->links() }}
        </div>
    </div>
@endsection
