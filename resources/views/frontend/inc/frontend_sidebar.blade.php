<div class="d-block d-lg-none aiz-sidebar-wrap categories_sidebar" id="categories_sidebar">
    <div class="aiz-sidebar left c-scrollbar ">
        <div class="aiz-side-nav-logo-wrap ">
            <a href="{{ route('home') }}" class="d-block text-left">
                @if(get_setting('system_logo_white') != null)
                    <img class="mw-100" src="{{ uploaded_asset(get_setting('system_logo_white')) }}" class="brand-icon" alt="{{ get_setting('site_name') }}">
                @else
                    <img class="" src="{{ static_asset('assets/img/logo_light_version.png') }}" class="brand-icon" alt="{{ get_setting('site_name') }}">
                @endif
            </a>
        </div>
        <div class="aiz-side-nav-wrap">

		<div class="divider">
        </div>

            <ul class="aiz-side-nav-list  frontend-mobile-menue" id="main-menu" data-toggle="aiz-side-menu">
                @if ( get_setting('header_menu_labels') !=  null )
                @foreach (json_decode( get_setting('header_menu_labels'), true) as $key => $value)
                <li class="aiz-side-nav-item ">
                        <a href="#" class="aiz-side-nav-link">
                            <i class="las aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text ">   {{ translate($value) }}</span>
                        </a>
                </li>
                @endforeach
                @endif

				@foreach (\App\Category::where('level', 0)->orderBy('order_level', 'desc')->get()->take(12) as $key => $category)
				    @php
					$sub_cats_num = count(\App\Utility\CategoryUtility::get_immediate_children_ids($category->id));
                    @endphp

					@if($sub_cats_num>0)
					<li class="aiz-side-nav-item">
                        <a href="#"  class="aiz-side-nav-link ">
                            <i class="las aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text"> {{ $category->getTranslation('name') }} </span>
							<span class="aiz-side-nav-arrow"> </span>
						</a>
						<ul class="aiz-side-nav-list level-2">
								 	@foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($category->id) as $key => $second_level_categoty)
											<li class="aiz-side-nav-item">
												<a class="aiz-side-nav-link" href="{{ route('products.category', \App\Category::find($second_level_categoty)->slug) }}" class="">
													<span class="aiz-side-nav-text">{{ \App\Category::find($second_level_categoty)->getTranslation('name') }}</span>
												</a>
											</li>
									@endforeach
						</ul>
					</li>
					@else
					<li class="aiz-side-nav-item">
						<a href="{{ route('products.category', $category->slug) }}" class="aiz-side-nav-link">
                            <i class="las aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text"> {{ $category->getTranslation('name') }} </span>
						</a>
					@endif
                    </li>

                @endforeach

            </ul><!-- .aiz-side-nav -->
        </div><!-- .aiz-side-nav-wrap -->
    </div><!-- .aiz-sidebar -->
    <div class="aiz-sidebar-overlay"></div>
</div><!-- .aiz-sidebar -->
