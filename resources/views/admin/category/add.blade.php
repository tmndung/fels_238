@extends('templates.admin.master')

@section('content')
    <div class="col-md-12 padding-0">
        <div class="col-md-12">
        <h2 class="tit"><i class="fa fa-list"></i>  @lang('lang.add_category')</h2>
        
        @include ('common.errors')

        {{ Form::open(['route' => 'admin.category.store']) }}
            {{ Form::label('left', trans('lang.name') . ': (*)', ['class' => 'left-login']) }}
            <div class="right-login">
                {{ Form::text('name', '', ['class' => 'input-right form-control']) }}
                <br/><br/>
            </div>
            <div class="clr"></div>
            {{ Form::label('left', trans('lang.parent'), ['class' => 'left-login']) }}
            <div class="right-login">
                {{ Form::select('parent_id', $categories, config('setting.default_parent_id'), ['class' => 'form-control input-right']) }}
                <br/><br/>
            </div>
            <div class="clr"></div> 
            {{ Form::submit(trans('lang.addBtn'), ['class' => 'button']) }}
        {{ Form::close() }}
    </div>
</div>
@endsection
