<div class="border-search block bg-color-search">
    @foreach ($courses as $course)
        <div class="row-search">
            <div class="row item-search block">
                <a class="col-sm-3" href="{{ route('elearning.courses.show', ['id' => $course->id]) }}">
                    {{ Html::image($course->picture_path, 'image', ['class' => 'img-item-search']) }}
                </a>
                <div class="detail-item-search col-sm-9">
                    <h3 class="h3-item-search"><a href="{{ route('elearning.courses.show', ['id' => $course->id]) }}" class="color-2">{{ $course->name }}</a></h3>
                    <a href="{{ route('elearning.category.show', [ 'id' => $course->category->id ]) }}"><i class="fa fa-list" aria-hidden="true"></i>  {{ $course->category->name }}</a>
                    <p class="information-search">{{ str_limit($course->information, 40) }}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>
