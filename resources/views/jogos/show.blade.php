@extends('layouts.app')

@section('content')
    @if($jogo)
        <?php $cats = $jogo[1];
        $jogo = $jogo[0]; ?>
    @endif
    <section class="row">
        <section id="jogo_cont" class="container">
            <section id="return">
                <a id="show_return" href="/" class="btn btn-primary">Return</a>
            </section>
            <section id="img_cont" class="inline">
                <img class="lazy" src="{{ URL::to('/') }}/storage/img/lazy.gif" data-src="{{ URL::to('/') }}/storage/img/jogos/{{ $jogo->jogo_foto }}" data-srcset="{{ URL::to('/') }}/storage/img/jogos/{{ $jogo->jogo_foto }}">
            </section>
            <section id="info_cont" class="inline">
                <h1>{{$jogo->nome}}</h1>
                <div class="row">
                    <ul style="list-style: none; margin-bottom: 5px; margin-top: -10px;">
                        @foreach($cats as $cat)
                            <li style="float: left;margin-left: -15px;margin-right: 25px; border-radius: 5px; padding: 2px 10px 2px 10px; background-color: darkgray;color: white;">{{$cat->nome}}</li>
                        @endforeach
                    </ul>
                </div>
                <h4>Description</h4>
                {!!$jogo->descricao!!}
            </section>
            <section id="small_info_cont" class="inline">
                <p id="date">Released on {{$jogo->data_lancamento}} by {{$jogo->proprietario}}</p>
                <div id="rating">{{$jogo->rating}}<small>/10</small></div>
                <div id="downloads">
                    <p> Download Count: {{$jogo->downloads}}</p><br>
                    @guest
                    @else
                        <a id="link" href="/jogo/vote/{{$jogo->jogo_id}}">Vote Now</a>
                    @endguest
                </div>

            </section>
            <section id="req_cont" class="inline">
                <h4>Requirements</h4>
                {!!$jogo->requisitos!!}
            </section>
        </section>
    </section>
    <section class="row">
        <section id="downloads" class="col-md-12">
            <h4>Downloads</h4>
            @if($jogo->instalador != null && $jogo->demo != null)
                <a id="demo2" href="/jogo/download/demo/{{$jogo->jogo_id}}" class="down_btn">Demo</a>
                <a id="inst2" href="/jogo/download/games/{{$jogo->jogo_id}}" class="down_btn">Full Game</a>
            @elseif($jogo->instalador != null)
                <a id="inst" href="/jogo/download/games/{{$jogo->jogo_id}}" class="down_btn">Full Game</a>
            @else
                <a id="demo" href="/jogo/download/demo/{{$jogo->jogo_id}}" class="down_btn">Demo</a>
            @endif
        </section>
    </section>
@endsection
