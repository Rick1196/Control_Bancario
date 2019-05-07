@extends('layouts.app')

@section('content')
<section class="hero">
        <figure class="image">
            <img src="{{asset('img/font.jpg')}}">
        </figure>
</section>
</section class="section">
    <div class="container has-text-centered">
            <h2 class="title">Sistema de Banca en linea</h2>
            <p>Sistema bancario en linea, la manera mas sencilla para la gestion bancaria de toda una organización.</p>
    </div>
    @guest
    <div class="hero-body">
        <div class="container has-text-centered">
            <div class="column is-6 is-offset-3">
                <h1 class="title">
                    SCB
                </h1>
                <h2 class="subtitle">
                   La mejor plataforma de banca en line
                </h2>
                <div class="box">
                    <div class="field is-grouped">
                        <p class="control">
                            
                            <div class="buttons">
                                <a class="button is-light is-large is-fullwidth" href="{{ route('login')}}">
                                        {{ __('Iniciar sesion') }}
                                </a>
                            </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @else
        <div id="app">
            @if(Auth::user()->hasRole('cliente'))
                <div><clientes user="{{ Auth::user()->id }}"></clientes></div>
            @elseif(Auth::user()->hasRole('atm'))
                <div><atms user="{{ Auth::user()->id }}"></atms></div>
            @elseif(Auth::user()->hasRole('cajero'))
                <div><cajeros user="{{ Auth::user()->id }}"></cajeros></div>
            @elseif(Auth::user()->hasRole('admin'))
                <div>
                    <nav-adm></nav-adm>
                    <admins></admins>
                    <workers></workers>
                    <clients></clients>
                    <cuentas></cuentas>
                    <reportes-view></reportes-view>
                </div>
            @elseif(Auth::user()->hasRole('auditor'))
                <div><auditores user="{{ Auth::user()->id }}"></auditores></div>
            @endif
        </div>
    @endguest
</section>
@endsection
