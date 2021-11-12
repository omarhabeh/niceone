@extends('frontend.layouts.app')
@section('title')@endsection

@section('stylesheets')

    <!-- Other Tags -->

    <!-- Moyasar Styles -->
    <link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.2.0/moyasar.css">

    <!-- Moyasar Scripts -->
    <script  language="JavaScript" type="text/javascript" src="https://polyfill.io/v3/polyfill.min.js?features=fetch"></script>
    <script language="JavaScript" type="text/javascript"  src="https://cdn.moyasar.com/mpf/1.2.0/moyasar.js"></script>
@endsection

@section('meta')@endsection

@section('content')
    <section class="pt-5 mb-4">

        <div class="container">

            <div class="row">

                <div class="col-xl-8 mx-auto">

                    <div class="row aiz-steps arrow-divider">

                        <div class="col done">

                            <div class="text-center text-success">

                                <i class="la-3x mb-2 las la-shopping-cart"></i>

                                <h3 class="fs-14 fw-600 d-none d-lg-block text-capitalize">{{ translate('1. My Cart')}}</h3>

                            </div>

                        </div>

                        <div class="col done">

                            <div class="text-center text-success">

                                <i class="la-3x mb-2 las la-map"></i>

                                <h3 class="fs-14 fw-600 d-none d-lg-block text-capitalize">{{ translate('2. Shipping info')}}</h3>

                            </div>

                        </div>

                        <div class="col done">

                            <div class="text-center text-success">

                                <i class="la-3x mb-2 las la-truck"></i>

                                <h3 class="fs-14 fw-600 d-none d-lg-block text-capitalize">{{ translate('3. Delivery info')}}</h3>

                            </div>

                        </div>

                        <div class="col active">

                            <div class="text-center text-primary">

                                <i class="la-3x mb-2 las la-credit-card"></i>

                                <h3 class="fs-14 fw-600 d-none d-lg-block text-capitalize">{{ translate('4. Payment')}}</h3>

                            </div>

                        </div>

                        <div class="col">

                            <div class="text-center">

                                <i class="la-3x mb-2 opacity-50 las la-check-circle"></i>

                                <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50 text-capitalize">{{ translate('5. Confirmation')}}</h3>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
    <div class="mysr-form"></div>



@endsection
@section('script')

    <script>
        Moyasar.init({
            // Required
            // Specify where to render the form
            // Can be a valid CSS selector and a reference to a DOM element
            element: '.mysr-form',

            // Required
            // Amount in the smallest currency unit
            // For example:
            // 10 SAR = 10 * 100 Halalas
            // 10 KWD = 10 * 1000 Fils
            // 10 JPY = 10 JPY (Japanese Yen does not have fractions)
           amount:  '{{($order->grand_total)*100}}',

            // Required
            // Currency of the payment transation
            currency: '{{$Currency->code}}',

            // Required
            // A small description of the current payment process
            description:'Order Code:{{$order->code}}',

            // Required
            // publishable_api_key: 'pk_test_bxpFktkVC1ug6LwhRZUH3HmNiQHGYXvpRQ5PRe7Z',
            publishable_api_key: '{{$Moyasar_SECRET_KEY}}',

            // Required
            // This URL is used to redirect the user when payment process has completed
            // Payment can be either a success or a failure, which you need to verify on you system (We will show this in a couple of lines)
            callback_url:  "{{route('moyasar_order_confirmed')}}",

            // Optional
            // Required payments methods
            // Default: ['creditcard', 'applepay', 'stcpay']
            methods: [
                'creditcard',
                'stcpay',
                // 'applepay',
            ],
            // applepay: {
            //     country: 'SA',
            //     label: 'Awesome Cookie Store',
            //     validate_merchant_url: 'https://mystore.com/checkout/applepay/validate-merchant',
            // },
            supported_networks: [
                'mada',
                'visa',
                'mastercard',
                'amex'
            ],
        });
    </script>
@endsection
