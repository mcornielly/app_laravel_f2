@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
        @component('components.logo')@endcomponent
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Confirma el código telefónico') }}</div>

                    <div class="card-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('verify') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="code" class="col-md-4 col-form-label text-md-right">Código</label>
                                <div class="col-md-6">
                                    <input id="code" type="number" class="form-control" name="code" value="{{ old('code') }}" required autofocus>

                                    @if ($errors->has('code'))
                                        <span class="help-block"><strong>{{ $errors->first('code') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Verificar cuenta
                                    </button>
                                    <a href="{{ route('resend') }}" class="btn btn-secondary">
                                        Reenviar código
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
