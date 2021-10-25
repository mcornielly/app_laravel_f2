@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @component('components.logo')@endcomponent
        <div class="col-md-8">
            <div class="box-card shadow-sm p-3 mb-5 bg-white rounded">
                <div class="title-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">Número de Teléfono</label>

                            <div class="col-md-6">
                                {{-- <input type="tel" id="phone"> --}}
                                <input id="phone_number" type="tel" class="form-control @error('phone_number') is-invalid @enderror" phone_number="phone_number"
                                    name="phone_number"
                                    value="{{ old('phone_number') }}"
                                    autocomplete="phone_number" autofocus>

                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-color btn-block">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    $(document).ready(function() {
        $('#phone').intlTelInput({
            container: 'body',
            utilsScript: "https://rawgit.com/Bluefieldscom/intl-tel-input/master/lib/libphonenumber/build/utils.js"
        });
    });
    // var input = document.querySelector("#phone");
    // window.intlTelInput(input, {
    //   // allowDropdown: false,
    //   // autoHideDialCode: false,
    //   // autoPlaceholder: "off",
    //   // dropdownContainer: document.body,
    //   // excludeCountries: ["us"],
    //   // formatOnDisplay: false,
    //   // geoIpLookup: function(callback) {
    //   //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
    //   //     var countryCode = (resp && resp.country) ? resp.country : "";
    //   //     callback(countryCode);
    //   //   });
    //   // },
    //   // hiddenInput: "full_number",
    //   // initialCountry: "auto",
    //   // localizedCountries: { 'de': 'Deutschland' },
    //   // nationalMode: false,
    //   onlyCountries: ['us', 'ca', 've', 'co', 'do'],
    //   // placeholderNumberType: "MOBILE",
    //   // preferredCountries: ['cn', 'jp'],
    //   // separateDialCode: true,
    //   utilsScript: "build/js/utils.js",
    // });
  </script>
