    <section class="gry-bg py-5">
        <div class="profile">
            <div class="container">
                <div class="row toprow">
                    <div class="col">
                        <i class="la la-user"></i>
                        <p >{{translate('login') }}</p>
                        <p class="text-muted text-center">{{ Lang::locale() == 'sa' ? translate('اختر الوسيلة المناسبة') : translate('choose login method')}}</p>
                    </div>
                </div>
                <div class="row bottomrow">
                    <div class="col">
                        {{-- Update --}}
                        <div class="row methods">
                            <div class="col" onclick="showEmail()">
                                <div class="card">
                                    <i class="la la-envelope"></i>
                                    <p>{{translate('Email')}}</p>
                                </div>
                            </div>
                            <div class="col" onclick="showPhone()">
                                <div class="card">
                                    <i class="la la-phone"></i>
                                    <p>{{translate('Phone')}}</p>
                                </div>
                            </div>
                        </div>
                        {{-- End Update --}}
                        <div class="phone-card">
                            <form class="form-default" role="form" action="{{ route('smslogin') }}" method="POST" id="smsform">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="+96655555555" name="phone" required style="direction: ltr;">
                                    <button class="btn btn-dark phonenumber" type="submit">{{Lang::locale() == 'sa' ? "ارسال " : translate('Send')}}</button>                               
                                </div>
                                <small class="text-danger" id="error"></small>
                            </form>
                            <form class="form-default" role="form" action="{{ route('smsotp') }}" method="POST" id="otpForm">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="ارسل رمز التحقق" name="otp" id="otp" >
                                    <button class="btn btn-dark" type="submit">{{Lang::locale() == 'sa' ? "ارسل رمز التحقق " : translate('Send')}}</button>                               
                                </div>
                                <small class="text-danger" id="error"></small>
                            </form>
                            
                        </div>
                        <div class="card main-card">
                            <div class="text-center pt-4">
                                <h1 class="h4 fw-600">
                                    {{ translate('Login to your account.')}}
                                </h1>
                            </div>
                            <div class="px-4 py-3 py-lg-4">
                                <div class="">
                                    <form class="form-default" role="form" action="{{ route('login') }}" method="POST" id="LoginForm">
                                        @csrf
                                        <div class="form-group">
                                            @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                                <input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ translate('Email Or Phone')}}" name="email" id="email">
                                            @else
                                                <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                            @endif
                                            @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                                <span class="opacity-60">{{  translate('Use country code before number') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ translate('Password')}}" name="password" id="password">
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-6">
                                                <label class="aiz-checkbox">
                                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <span class=opacity-60>{{  translate('Remember Me') }}</span>
                                                    <span class="aiz-square-check"></span>
                                                </label>
                                            </div>
                                            <div class="col-6 text-right">
                                                <a href="{{ route('password.request') }}" class="text-reset opacity-60 fs-14">{{ translate('Forgot password?')}}</a>
                                            </div>
                                        </div>

                                        <div class="mb-5">
                                            <button type="submit" class="btn btn-primary btn-block fw-600">{{  translate('Login') }}</button>
                                        </div>
                                    </form>
                                    @if (env("DEMO_MODE") == "On")
                                        <div class="mb-5">
                                            <table class="table table-bordered mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td>{{ translate('Seller Account')}}</td>
                                                        <td>
                                                            <button class="btn btn-info btn-sm" onclick="autoFillSeller()">{{ translate('Copy credentials') }}</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ translate('Customer Account')}}</td>
                                                        <td>
                                                            <button class="btn btn-info btn-sm" onclick="autoFillCustomer()">{{ translate('Copy credentials') }}</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ translate('Delivery Boy Account')}}</td>
                                                        <td>
                                                            <button class="btn btn-info btn-sm" onclick="autoFillDeliveryBoy()">{{ translate('Copy credentials') }}</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif

                                    @if(get_setting('google_login') == 1 || get_setting('facebook_login') == 1 || get_setting('twitter_login') == 1)
                                        <div class="separator mb-3">
                                            <span class="bg-white px-3 opacity-60">{{ translate('Or Login With')}}</span>
                                        </div>
                                        <ul class="list-inline social colored text-center mb-5">
                                            @if (get_setting('facebook_login') == 1)
                                                <li class="list-inline-item">
                                                    <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="facebook">
                                                        <i class="lab la-facebook-f"></i>
                                                    </a>
                                                </li>
                                            @endif
                                            @if(get_setting('google_login') == 1)
                                                <li class="list-inline-item">
                                                    <a href="{{ route('social.login', ['provider' => 'google']) }}" class="google">
                                                        <i class="lab la-google"></i>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (get_setting('twitter_login') == 1)
                                                <li class="list-inline-item">
                                                    <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="twitter">
                                                        <i class="lab la-twitter"></i>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <p class="text-muted mb-0">{{ translate('Dont have an account?')}}</p>
                                    <a href="{{ route('user.registration') }}">{{ translate('Register Now')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@section('scriptPopup')
    <script>
     $('#otpForm').hide();
    $("#smsform").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr('action');
    $('.phonenumber').prop( "disabled", true );
    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {
              $('#error').text('');
              $('.phonenumber').hide();
              $('#otpForm').show();
           },
           error:function(data){
                   $('#error').text('Phone number not valid');
           }
         });
    });
    $("#otpForm").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr('action');
    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {
            $('#error').text('');
            if(data['error']){
                $('#error').text(data['error']);
            }
            window.location.href = '/';
           },
           error:function(data){
                   $('#error').text('Phone number not valid');
           }
         });
    });
    </script>
    <script type="text/javascript">
        function autoFillSeller(){
            $('#email').val('seller@example.com');
            $('#password').val('123456');
        }
        function autoFillCustomer(){
            $('#email').val('customer@example.com');
            $('#password').val('123456');
        }
        function autoFillDeliveryBoy(){
            $('#email').val('deliveryboy@example.com');
            $('#password').val('123456');
        }
        // default state
        $('.phone-card').hide();
        $('.main-card').hide();
        
        //functions to show the email/phone
        function showEmail(){
            $('.main-card').show();
            $('.phone-card').hide();
        }
        function showPhone(){
            $('.main-card').hide();
            $('.phone-card').show();
        }
    </script>
@endsection
