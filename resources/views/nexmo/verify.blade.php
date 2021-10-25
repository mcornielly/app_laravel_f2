@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
        @component('components.logo')@endcomponent
            <div class="col-md-8 shadow-sm bg-white rounded">
                <div class="row">
                    <div class="col-md-6 p-0">
                        <img class="card-img" src="img/seguridad_1.jpg" alt="Card image cap" style="background-color: black;">
                    </div>
                    <div class="box-card  col-md-6">
                        <div class="title-header">{{ __('Confirma el código telefónico') }}</div>
                        <div class="card-body mt-1">
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('verify') }}">
                                @csrf
                                <div class="form-group row pt-2 pb-2">
                                    <label for="code" class="col-md-4 col-form-label">Código</label>
                                    <div class="col-md-12">
                                        <input id="code" type="number" class="form-control" name="code" value="{{ old('code') }}" required autofocus>

                                        @if ($errors->has('code'))
                                            <span class="help-block"><strong>{{ $errors->first('code') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12 offset-md-1 pt-3">
                                        <button type="submit" class="btn btn-primary">
                                            Verificar cuenta
                                        </button>
                                        <a href="{{ route('resend') }}" class="btn btn-secondary">
                                            Reenviar código
                                        </a>
                                    </div>
                                </div>
                            </form>
                            <div class="row col-md-12 text-right p-0" style="display: inline-block">
                                <span class="text-success">Tiempo para colocar el código: 05:00 min</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
