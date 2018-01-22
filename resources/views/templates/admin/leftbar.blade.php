<!-- start:Left Menu -->
<div id="left-menu">
  <div class="sub-left-menu scroll">
    <ul class="nav nav-list">
            <li><div class="left-bg"></div></li>
            <li class="time">
                <h1 class="animated fadeInLeft"></h1>
                <p class="animated fadeInRight"></p>
            </li>
            <li class="active ripple animated fadeInLeft">
                <a class="nav-header" href="{{ route('admin.users.index') }}">
                    <span class="fa-user fa"></span>@lang('lang.users')
                    <span class="text-right"></span>
                </a>
            </li>
            <li class="ripple animated fadeInLeft">
                <a class="nav-header" href="{{ route('admin.category.index') }}">
                    <span class="fa-list-ul fa"></span>@lang('lang.categories')
                    <span class="text-right"></span>
                </a>
            </li>
            <li class="ripple animated fadeInLeft">
                <a class="nav-header" href="{{ route('admin.courses.index') }}">
                    <span class="fa fa-map fa"></span>@lang('lang.courses')
                    <span class="text-right"></span>
                </a>
            </li>
            <li class="ripple animated fadeInLeft">
                <a class="nav-header" href="{{ route('admin.wordlist.index') }}">
                    <span class="fa fa-list-alt"></span>@lang('lang.wordlists')
                    <span class="text-right"></span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- end: Left Menu -->
