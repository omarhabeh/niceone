<form class="form-default" role="form" action="{{ route('addresses.update', $address_data->id) }}" method="POST">
    @csrf
    <div class="p-3">
        <div class="row">
            <div class="col-md-2">
                <label>{{ translate('Full name')}}</label>
            </div>
            <div class="col-md-10">
                <input type="text" class="form-control mb-3" placeholder="{{ translate('Full Name') }}" name="name" required value="{{$address_data->Full_name}}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label>{{ translate('Country')}}</label>
            </div>
            <div class="col-md-10">
                <div class="mb-3">
                    <select class="form-control aiz-selectpicker" data-live-search="true" data-placeholder="{{ translate('Select your country')}}" name="country" id="edit_country" required>
                        @foreach (\App\Country::where('status', 1)->get() as $key => $country)
                        <option value="{{ $country->name }}" @if($address_data->country == $country->name) selected @endif>
                            {{ $country->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <label>{{ translate('City')}}</label>
            </div>
            <div class="col-md-10">
                <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="city" required>

                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label>{{ Lang::locale() == 'sa' ? translate('اسم الحي') : translate('Neighborhood name')}}</label>
            </div>
            <div class="col-md-10">
                <input type="text" class="form-control mb-3" placeholder="{{ Lang::locale() == 'sa' ? translate('اسم الحي') : translate('Your Neighborhood name')}}" name="Neighborhood_name" value="{{ $address_data->neighbourhood_name }}" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label>{{ Lang::locale() == 'sa' ? translate('اسم الشارع') : translate('Street name')}}</label>
            </div>
            <div class="col-md-10">
                <input type="text" class="form-control mb-3" placeholder="{{ Lang::locale() == 'sa' ? translate('اسم الشارع') : translate('Street name')}}" name="street_name" value="{{ $address_data->street_name }}" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label>{{ Lang::locale() == 'sa' ? translate('رقم الشقة (اختياري)') : translate('Apt No. (optional)')}}</label>
            </div>
            <div class="col-md-10">
                <input type="text" class="form-control mb-3" placeholder="{{ Lang::locale() == 'sa' ? translate('رقم الشقة (اختياري)') : translate('Apt No. (optional)')}}" name="apt_no" value="">
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-md-2">
                <label>{{ translate('Postal code')}}</label>
            </div>
            <div class="col-md-10">
                <input type="text" class="form-control mb-3" placeholder="{{ translate('Your Postal Code')}}" value="{{ $address_data->postal_code }}" name="postal_code" value="" required>
            </div>
        </div> --}}
        <div class="row">
            <div class="col-md-2">
                <label>{{ translate('Phone')}}</label>
            </div>
            <div class="col-md-10">
                <input type="text" class="form-control mb-3" placeholder="{{ translate('+966')}}" value="{{ $address_data->phone }}" name="phone" value="" required>
            </div>
        </div>
        <div class="form-group text-right">
            <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
        </div>
    </div>
</form>
