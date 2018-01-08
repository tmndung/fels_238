@extends('templates.admin.master')

@section('content')
    <h2 class="tit"><i class="fa fa-list"></i>  @lang('lang.edit_category')</h2>
    
    @include ('common.errors')

    @if (count($category))
        {{ Form::open(['route' => ['admin.category.update', $category->id]]) }}
            {{ method_field('PUT') }}
            {{ Form::label('left', trans('lang.name') . ': (*)', ['class' => 'left-login']) }}
            <div class="right-login">
                {{ Form::text('name', $category->name, ['class' => 'input-right']) }}
                <br/><br/>
            </div>
            <div class="clr"></div>
            {{ Form::label('left', trans('lang.parent_id'), ['class' => 'left-login']) }}
            <div class="right-login">
                {{ Form::select('parent_id', $categories, $category->parent_id, ['class' => 'input-right']) }}
                <br/><br/>
            </div>
            <div class="clr"></div> 
            {{ Form::submit(trans('lang.editBtn'), ['class' => 'button']) }}
        {{ Form::close() }}
    @endif
@endsection
