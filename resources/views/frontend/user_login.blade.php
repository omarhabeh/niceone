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
                        <div class="phone-card border-0">
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
                        <div class="main-card border-0">
                            <form class="form-default" role="form" action="{{ route('emaillogin') }}" method="POST" id="EmailForm">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="الايميل الالكتروني" name="email" required style="direction: ltr;">
                                    <button class="btn btn-dark email" type="submit">{{Lang::locale() == 'sa' ? "ارسال " : translate('Send')}}</button>
                                </div>
                            </form>
                            <small class="text-danger" id="emailerror"></small>
                            <form class="form-default" role="form" action="{{ route('emailotp') }}" method="POST" id="EmailotpForm">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="ارسل رمز التحقق" name="otp" id="otp" >
                                    <button class="btn btn-dark" type="submit">{{Lang::locale() == 'sa' ? "ارسل رمز التحقق " : translate('Send')}}</button>
                                </div>
                            </form>
                            <small class="text-danger" id="emailerror"></small>
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
            console.log(data);
              $('#error').text('');
              $('.phonenumber').hide();
              $('#otpForm').show();
           },
           error:function(data){
                $('#error').text('Phone number not valid');
                console.log(data);
                $('.phonenumber').prop( "disabled", false );
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
            else{
                window.location.reload();
            }
           },
           error:function(data){
                   $('#error').text('Phone number not valid');
           }
         });
    });
    /* email form */
    $('#EmailotpForm').hide();
    $("#EmailForm").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr('action');
    $('.email').prop( "disabled", true );
    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {
              $('#emailerror').text('');
              $('.email').hide();
              $('#EmailotpForm').show();
           },
           error:function(data){
                   $('#emailerror').text('Email not valid');
                   $('.email').prop( "disabled", false );
           }
         });
    });

    $("#EmailotpForm").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr('action');
    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {
            $('#emailerror').text('');
            if(data['error']){
                $('#emailerror').text(data['error']);
            }
            location.reload(); 
           },
           error:function(data){
                   $('#error').text('Email not valid');
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
