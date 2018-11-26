@extends('layouts.app')

@section('content')
<section class="hero">
        <figure class="image">
            <img src="https://d500.epimg.net/cincodias/imagenes/2017/09/06/ahorros/1504683040_977295_1504683264_noticia_normal.jpg">
        </figure>
</section>
</section class="section">
    <div class="container has-text-centered">
            <h2 class="title">Sistema de Banca en linea</h2>
            <p>Sistema bancario en linea, la manera mas sencilla para la gestion bancaria de toda una organización.</p>
    </div>
    @guest
        <div class="columns is-centered" style="padding: 2rem">
            
            <div class="column">
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-2by1">
                            <img src="https://images.pexels.com/photos/167635/pexels-photo-167635.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="Placeholder image">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="media">
                            <div class="media-content">
                                <p class="title is-4">John Smith</p>
                                <p class="subtitle is-6">@johnsmith</p>
                            </div>
                        </div>

                        <div class="content">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec iaculis mauris.
                            <a>@bulmaio</a>.
                            <a href="#">#css</a>
                            <a href="#">#responsive</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column">
                    <div class="card">
                        <div class="card-image">
                            <figure class="image is-2by1">
                                <img src="https://images.pexels.com/photos/167635/pexels-photo-167635.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="Placeholder image">
                            </figure>
                        </div>
                        <div class="card-content">
                            <div class="media">
                                <div class="media-content">
                                    <p class="title is-4">John Smith</p>
                                    <p class="subtitle is-6">@johnsmith</p>
                                </div>
                            </div>

                            <div class="content">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec iaculis mauris.
                                <a>@bulmaio</a>.
                                <a href="#">#css</a>
                                <a href="#">#responsive</a>
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
                </div>
            @elseif(Auth::user()->hasRole('auditor'))
                <div><auditores user="{{ Auth::user()->id }}"></auditores></div>
            @endif
        </div>
    @endguest
</section>
@endsection
