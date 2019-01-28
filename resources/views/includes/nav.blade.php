<?php $categories = \App\Models\Category::with('subCategories')->get() ?>
<header class="navigation">
    <div class="title-bar" data-responsive-toggle="main-menu" data-hide-for="medium">
        <button class="menu-icon float-right" type="button" data-toggle="main-menu"></button>
        <a href="/" class="logo float-left"></a>
    </div>

    <div class="top-bar" id="main-menu">
        <div class="top-bar-title show-for-medium">
            <a href="/" class="logo"></a>
        </div>
        <div class="top-bar-left">
            <ul class="drilldown  menu vertical medium-horizontal" data-dropdown-menu
                data-disable-hover="true" data-click-open="true">
                <li><a href="#">Acme Products</a></li>
                @if(count($categories))
                    <li>
                        <a href="#">Categories</a>
                        <ul class="menu vertical sub dropdown">
                            @foreach ($categories as $category)
                                <li>
                                    <a href="#">{{ $category->name }}</a>
                                    @if(count($category->subCategories))
                                        <ul class="menu sub dropdown">
                                            @foreach ($category->subCategories as $subCategory)
                                                <li>
                                                    <a href="#">{{ $subCategory->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
        <div class="top-bar-right">
            <ul class="menu vertical medium-horizontal">
                    <li><a href="#">User Name</a></li>
                    <li><a href='/login'>Sign in</a></li>
                <li><a href='/register'>Register</a></li>
                <li><a href='/cart'>Cart</a></li>
            </ul>
        </div>
    </div>
</header>