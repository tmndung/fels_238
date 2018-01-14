<ul>
    <li class="full-width clearfix">
        <div class="col-sm-3 col-xs-12 color-3-bold">
            @lang('lang.word')
        </div>
        <div class="col-sm-4 col-xs-12 color-1-bold">
            @lang('lang.pronunciation')
        </div>
        <div class="col-sm-4 col-xs-12 color-2-bold">
            @lang('lang.explain')
        </div>
        <div class="col-sm-1 col-xs-12 color-4-bold">
            @lang('lang.learned')
        </div>
    </li>
    @foreach ($data['wordLists'] as $word)
        <li class="full-width clearfix">
            <div class="col-sm-3 col-xs-12">{{ $word->name }}</div>
            <div class="col-sm-4 col-xs-12">{{ $word->pronunciation }}</div>
            <div class="col-sm-4 col-xs-12">{{ $word->explain }}</div>
            <div class="col-sm-1 col-xs-12">
                @if ($data['isActiveCourse'] && in_array($word->id, $data['idWordListsLearned']))
                    <img src="{{ config('setting.checkIcon') }}" class="check-icon">
                @else
                    <div class="lock"><i class="fa fa-lock"></i></div>
                @endif
            </div>
        </li>
    @endforeach
</ul>
