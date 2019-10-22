@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="img_cont" class="col md-10">
                        <div id="img">
                            <img class="lazy" src="{{ URL::to('/') }}/storage/img/lazy.gif" data-src="{{ URL::to('/') }}/storage/img/perfis/{{ $user->foto }}" data-srcset="{{ URL::to('/') }}/storage/img/perfis/{{ $user->foto }}"/>
                        </div>
                        <h1 id="nickname">{{$user->nome}}</h1>
                        <h1 id="account_type">{{ $user->menber_status }}</h1>
                    </div>
                    <div  id="info" class="col md-10">
                        {!! $user->biography !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
