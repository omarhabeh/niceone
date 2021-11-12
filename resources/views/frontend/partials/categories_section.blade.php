

<section class="mb-4">
    <div class="container">
        <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">
            <div class="d-flex mb-3 align-items-baseline border-bottom">
                <h3 class="h5 fw-700 mb-0">
                    <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Category') }}</span>
                </h3>
            </div>
            <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="5" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true'>
                @foreach (\App\Category::where('level', 0)->orderBy('order_level', 'desc')->get()->take(11) as $key => $category)
                <div class="carousel-box">
{{-- {{$category->id}} --}}
                    <div class="aiz-card-box border border-light rounded hov-shadow-md mt-1 mb-2 has-transition bg-white">
                        <div class="position-relative">
                            <a href="{{ route('products.category', $category->slug) }}" class="d-block">
                                <img
                                    class="img-fit lazyload mx-auto h-140px h-md-210px"
                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                    data-src="{{ uploaded_asset($category->banner) }}"
                                    alt="{{ $category->getTranslation('name') }}"
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                >
                            </a>

                        </div>
                        
                        <div class="p-md-3 p-2 text-center">
                            
                            <h3 class="fw-600 fs-16 text-truncate-2 lh-1-4 mb-0 ">
                                <a href="{{ route('products.category', $category->slug) }}" class="d-block text-reset">{{$category->getTranslation('name') }}</a>
                            </h3>
                        </div>
                    </div>
                    {{-- @include('frontend.partials.cat_box_1',['category' => $category]) --}}
                </div>    
                @endforeach
               
                
            </div>
        </div>
    </div>
</section>
