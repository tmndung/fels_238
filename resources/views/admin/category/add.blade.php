@extends('templates.admin.master')

@section('content')
    <h2 class="tit"><i class="fa fa-list"></i>  @lang('lang.add_category')</h2>
    
    @include ('common.errors')

    {{ Form::open(['route' => 'admin.category.store']) }}
        {{ Form::label('left', trans('lang.name') . ': (*)', ['class' => 'left-login']) }}
        <div class="right-login">
            {{ Form::text('name', '', ['class' => 'input-right']) }}
            <br/><br/>
        </div>
        <div class="clr"></div>
        {{ Form::label('left', trans('lang.parent_id'), ['class' => 'left-login']) }}
        <div class="right-login">
            {{ Form::select('parent_id', $categories, '0', ['class' => 'input-right']) }}
            <br/><br/>
        </div>
        <div class="clr"></div> 
        {{ Form::submit(trans('lang.addBtn'), ['class' => 'button']) }}
    {{ Form::close() }}
@endsection
