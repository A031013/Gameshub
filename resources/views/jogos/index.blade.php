@extends('layouts.app')

@section("content")

    <section id="index" style="padding-top:20px;" class="row">
        @if($paginatedItems)
            <section id="menu" class="col-2" style="">
                <div style="position: fixed;">
                    <h4>Filtos:</h4>
                    <ul style="list-style: none">
                        <li><a id="a_todos" style="color: darkgray" class="a_picker" onclick="toggle_visibility_jogos('todos', 'a_todos');">All</a></li>
                        <li><a id="a_action" class="a_picker" onclick="toggle_visibility_jogos('action', 'a_action');">Action</a></li>
                        <li><a id="a_adventure" class="a_picker" onclick="toggle_visibility_jogos('adventure', 'a_adventure');">Adventure</a></li>
                        <li><a id="a_rpg" class="a_picker" onclick="toggle_visibility_jogos('rpg', 'a_rpg');">RPG</a></li>
                        <li><a id="a_simulation" class="a_picker" onclick="toggle_visibility_jogos('simulation', 'a_simulation');">Simulation</a></li>
                        <li><a id="a_horror" class="a_picker" onclick="toggle_visibility_jogos('horror', 'a_horror');">Horror</a></li>
                        <li><a id="a_strategy" class="a_picker" onclick="toggle_visibility_jogos('strategy', 'a_strategy');">Strategy</a></li>
                        <li><a id="a_sports" class="a_picker" onclick="toggle_visibility_jogos('sports', 'a_sports');">Sports</a></li>
                        <li><a id="a_idle" class="a_picker" onclick="toggle_visibility_jogos('idle', 'a_idle');">Idle</a></li>
                        <li><a id="a_other" class="a_picker" onclick="toggle_visibility_jogos('other', 'a_other');">Other</a></li>
                    </ul>
                </div>
            </section>
            <section id="todos" class="col-10">
                <h2 id="header" style="text-align: center;">Most recent games uploaded</h2>
                <div class="row">
                    @foreach($paginatedItems as $jogo)
                    <div id="jogo" class="col-3">
                        <div class="product-list">
                            <a href="{{ route('jogo.show', $jogo[0]->jogo_id) }}">
                                <div class="card">
                                    <img class="lazy" id="card-img" src="{{ URL::to('/') }}/storage/img/lazy.gif" data-src="{{ URL::to('/') }}/storage/img/jogos/{{ $jogo[0]->jogo_foto }}" data-srcset="{{ URL::to('/') }}/storage/img/jogos/{{ $jogo[0]->jogo_foto }}"/>
                                </div>
                                <h5 class="card-title text-center"><a href="#">{{$jogo[0]->nome}}</a> </h5>
                            </a>
                            <div id="rating">{{$jogo[0]->rating}}<small>/10</small></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            <section id="action" style="display:none;" class="col-10">
                <h2 id="header" style="text-align: center;">Action Games</h2>
                <div class="row">
                    <?php $count = 0; ?>
                    @foreach($paginatedItems as $key => $jogo)
                        @foreach($jogo[1] as $cat)
                            @if($cat->nome == 'Action')
                                <?php $count = $key + 1; ?>
                                <div id="jogo" class="col-md-3">
                                    <div class="product-list">
                                        <a href="{{ route('jogo.show', $jogo[0]->jogo_id) }}">
                                            <div class="card">
                                                <img class="lazy" id="card-img" src="{{ URL::to('/') }}/storage/img/lazy.gif" data-src="{{ URL::to('/') }}/storage/img/jogos/{{ $jogo[0]->jogo_foto }}" data-srcset="{{ URL::to('/') }}/storage/img/jogos/{{ $jogo[0]->jogo_foto }}"/>
                                            </div>
                                            <h5 class="card-title text-center"><a href="#">{{$jogo[0]->nome}}</a> </h5>
                                        </a>
                                        <div id="rating">{{$jogo[0]->rating}}<small>/10</small></div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                </div>
                @if($count == 0)
                    <p>There are no Action Games avaiable at this moment.</p>
                @endif
            </section>
            <section id="adventure" style="display:none;" class="col-10">
                <h2 id="header" style="text-align: center;">Adventure Games</h2>
                <div class="row">
                    <?php $count = 0; ?>
                    @foreach($paginatedItems as $key => $jogo)
                        @foreach($jogo[1] as $cat)
                            @if($cat->nome == 'Adventure')
                                <?php $count = $key + 1; ?>
                                <div id="jogo" class="col-md-3">
                                    <div class="product-list">
                                        <a href="{{ route('jogo.show', $jogo[0]->jogo_id) }}">
                                            <div class="card">
                                                <img class="lazy" id="card-img" src="{{ URL::to('/') }}/storage/img/lazy.gif" data-src="{{ URL::to('/') }}/storage/img/jogos/{{ $jogo[0]->jogo_foto }}" data-srcset="{{ URL::to('/') }}/storage/img/jogos/{{ $jogo[0]->jogo_foto }}"/>
                                            </div>
                                            <h5 class="card-title text-center"><a href="#">{{$jogo[0]->nome}}</a> </h5>
                                        </a>
                                        <div id="rating">{{$jogo[0]->rating}}<small>/10</small></div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                </div>
                @if($count == 0)
                    <p>There are no Adventure Games avaiable at this moment.</p>
                @endif
            </section>
            <section id="rpg" style="display:none;" class="col-10">
                <h2 id="header" style="text-align: center;">RPG Games</h2>
                <div class="row">
                    <?php $count = 0; ?>
                    @foreach($paginatedItems as $key => $jogo)
                        @foreach($jogo[1] as $cat)
                            @if($cat->nome == 'RPG')
                                <?php $count = $key + 1; ?>
                                <div id="jogo" class="col-md-3">
                                    <div class="product-list">
                                        <a href="{{ route('jogo.show', $jogo[0]->jogo_id) }}">
                                            <div class="card">
                                                <img class="lazy" id="card-img" src="{{ URL::to('/') }}/storage/img/lazy.gif" data-src="{{ URL::to('/') }}/storage/img/jogos/{{ $jogo[0]->jogo_foto }}" data-srcset="{{ URL::to('/') }}/storage/img/jogos/{{ $jogo[0]->jogo_foto }}"/>
                                            </div>
                                            <h5 class="card-title text-center"><a href="#">{{$jogo[0]->nome}}</a> </h5>
                                        </a>
                                        <div id="rating">{{$jogo[0]->rating}}<small>/10</small></div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                </div>
                @if($count == 0)
                    <p>There are no RPG Games avaiable at this moment.</p>
                @endif
            </section>
            <section id="simulation" style="display:none;" class="col-10">
                <h2 id="header" style="text-align: center;">Simulation Games</h2>
                <div class="row">
                    <?php $count = 0; ?>
                    @foreach($paginatedItems as $key => $jogo)
                        @foreach($jogo[1] as $cat)
                            @if($cat->nome == 'Simulation')
                                <?php $count = $key + 1; ?>
                                <div id="jogo" class="col-md-3">
                                    <div class="product-list">
                                        <a href="{{ route('jogo.show', $jogo[0]->jogo_id) }}">
                                            <div class="card">
                                                <img class="lazy" id="card-img" src="{{ URL::to('/') }}/storage/img/lazy.gif" data-src="{{ URL::to('/') }}/storage/img/jogos/{{ $jogo[0]->jogo_foto }}" data-srcset="{{ URL::to('/') }}/storage/img/jogos/{{ $jogo[0]->jogo_foto }}"/>
                                            </div>
                                            <h5 class="card-title text-center"><a href="#">{{$jogo[0]->nome}}</a> </h5>
                                        </a>
                                        <div id="rating">{{$jogo[0]->rating}}<small>/10</small></div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                </div>
                @if($count == 0)
                    <p>There are no Simulation Games avaiable at this moment.</p>
                @endif
            </section>
            <section id="horror" style="display:none;" class="col-10">
                <h2 id="header" style="text-align: center;">Horror Games</h2>
                <div class="row">
                    <?php $count = 0; ?>
                    @foreach($paginatedItems as $key => $jogo)
                        @foreach($jogo[1] as $cat)
                            @if($cat->nome == 'Horror')
                                <?php $count = $key + 1; ?>
                                <div id="jogo" class="col-md-3">
                                    <div class="product-list">
                                        <a href="{{ route('jogo.show', $jogo[0]->jogo_id) }}">
                                            <div class="card">
                                                <img class="lazy" id="card-img" src="{{ URL::to('/') }}/storage/img/lazy.gif" data-src="{{ URL::to('/') }}/storage/img/jogos/{{ $jogo[0]->jogo_foto }}" data-srcset="{{ URL::to('/') }}/storage/img/jogos/{{ $jogo[0]->jogo_foto }}"/>
                                            </div>
                                            <h5 class="card-title text-center"><a href="#">{{$jogo[0]->nome}}</a> </h5>
                                        </a>
                                        <div id="rating">{{$jogo[0]->rating}}<small>/10</small></div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                </div>
                @if($count == 0)
                    <p>There are no Horror Games avaiable at this moment.</p>
                @endif
            </section>
            <section id="strategy" style="display:none;" class="col-10">
                <h2 id="header" style="text-align: center;">Strategy Games</h2>
                <div class="row">
                    <?php $count = 0; ?>
                    @foreach($paginatedItems as $key => $jogo)
                        @foreach($jogo[1] as $cat)
                            @if($cat->nome == 'Strategy')
                                <?php $count = $key + 1; ?>
                                <div id="jogo" class="col-md-3">
                                    <div class="product-list">
                                        <a href="{{ route('jogo.show', $jogo[0]->jogo_id) }}">
                                            <div class="card">
                                                <img class="lazy" id="card-img" src="{{ URL::to('/') }}/storage/img/lazy.gif" data-src="{{ URL::to('/') }}/storage/img/jogos/{{ $jogo[0]->jogo_foto }}" data-srcset="{{ URL::to('/') }}/storage/img/jogos/{{ $jogo[0]->jogo_foto }}"/>
                                            </div>
                                            <h5 class="card-title text-center"><a href="#">{{$jogo[0]->nome}}</a> </h5>
                                        </a>
                                        <div id="rating">{{$jogo[0]->rating}}<small>/10</small></div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                </div>
                @if($count == 0)
                    <p>There are no Strategy Games avaiable at this moment.</p>
                @endif
            </section>
            <section id="sports" style="display:none;" class="col-10">
                <h2 id="header" style="text-align: center;">Sports Games</h2>
                <div class="row">
                    <?php $count = 0; ?>
                    @foreach($paginatedItems as $key => $jogo)
                        @foreach($jogo[1] as $cat)
                            @if($cat->nome == 'Sports')
                                <?php $count = $key + 1; ?>
                                <div id="jogo" class="col-md-3">
                                    <div class="product-list">
                                        <a href="{{ route('jogo.show', $jogo[0]->jogo_id) }}">
                                            <div class="card">
                                                <img class="lazy" id="card-img" src="{{ URL::to('/') }}/storage/img/lazy.gif" data-src="{{ URL::to('/') }}/storage/img/jogos/{{ $jogo[0]->jogo_foto }}" data-srcset="{{ URL::to('/') }}/storage/img/jogos/{{ $jogo[0]->jogo_foto }}"/>
                                            </div>
                                            <h5 class="card-title text-center"><a href="#">{{$jogo[0]->nome}}</a> </h5>
                                        </a>
                                        <div id="rating">{{$jogo[0]->rating}}<small>/10</small></div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                </div>
                @if($count == 0)
                    <p>There are no Sports Games avaiable at this moment.</p>
                @endif
            </section>
            <section id="idle" style="display:none;" class="col-10">
                <h2 id="header" style="text-align: center;">Idle Games</h2>
                <div class="row">
                    <?php $count = 0; ?>
                    @foreach($paginatedItems as $key => $jogo)
                        @foreach($jogo[1] as $cat)
                            @if($cat->nome == 'Idle')
                                <?php $count = $key + 1; ?>
                                <div id="jogo" class="col-md-3">
                                    <div class="product-list">
                                        <a href="{{ route('jogo.show', $jogo[0]->jogo_id) }}">
                                            <div class="card">
                                                <img class="lazy" id="card-img" src="{{ URL::to('/') }}/storage/img/lazy.gif" data-src="{{ URL::to('/') }}/storage/img/jogos/{{ $jogo[0]->jogo_foto }}" data-srcset="{{ URL::to('/') }}/storage/img/jogos/{{ $jogo[0]->jogo_foto }}"/>
                                            </div>
                                            <h5 class="card-title text-center"><a href="#">{{$jogo[0]->nome}}</a> </h5>
                                        </a>
                                        <div id="rating">{{$jogo[0]->rating}}<small>/10</small></div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                </div>
                @if($count == 0)
                    <p>There are no Idle Games avaiable at this moment.</p>
                @endif
            </section>
            <section id="other" style="display:none;" class="col-10">
                <h2 id="header" style="text-align: center;">Other Games</h2>
                <div class="row">
                    <?php $count = 0; ?>
                    @foreach($paginatedItems as $key => $jogo)
                        @foreach($jogo[1] as $cat)
                            @if($cat->nome == 'Other')
                                <?php $count = $key + 1; ?>
                                <div id="jogo" class="col-md-3">
                                    <div class="product-list">
                                        <a href="{{ route('jogo.show', $jogo[0]->jogo_id) }}">
                                            <div class="card">
                                                <img class="lazy" id="card-img" src="{{ URL::to('/') }}/storage/img/lazy.gif" data-src="{{ URL::to('/') }}/storage/img/jogos/{{ $jogo[0]->jogo_foto }}" data-srcset="{{ URL::to('/') }}/storage/img/jogos/{{ $jogo[0]->jogo_foto }}"/>
                                            </div>
                                            <h5 class="card-title text-center"><a href="#">{{$jogo[0]->nome}}</a> </h5>
                                        </a>
                                        <div id="rating">{{$jogo[0]->rating}}<small>/10</small></div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                </div>
                @if($count == 0)
                    <p>There are no Other Games avaiable at this moment.</p>
                @endif
            </section>
        @else
            <p>There are no Games avaiable at this moment.</p>
        @endif
    </section>
    <script type="text/javascript">

        function toggle_visibility_jogos(id , target) {
            var form_target = document.getElementById(id);
            var button_target  = document.getElementById(target);

            var buttons = document.getElementsByClassName("a_picker");
            for(var x = 0;  x < buttons.length; x++){
                buttons[x].style.color = 'black';
                buttons[x].style.fontWeight = 'bold';
            }

            var forms = document.getElementsByClassName("col-10");
            for(var i = 0;  i < forms.length; i++){
                forms[i].style.display = 'none';
            }

            form_target.style.display = 'block';
            button_target.style.color = "darkgrey";
            button_target.style.fontWeight = "bold";
            focus();
        }
        function focus() {
            var elmnt = document.getElementById("header");
            elmnt.scrollIntoView();
        }

    </script>
@endsection
