@extends('layouts.app')

@section("content")
    <section id="content_container" class="row">
        <div class="col-2"></div>
        <section id="about_cont" class="col-8">
            <img id="about" src="{{ URL::to('/') }}/storage/img/about.png">
            <p>Welcome to Gameshub, your number one source for all things video games. We're dedicated to giving you the very best of games, with a focus on developer feedback, gamers communication, young developers.</p>
            <p>Founded in 2019 by Bruno Monteiro and João Ribeiro, Gameshub has come a long way from its beginnings in ismai. When we first started out, our passion for game development drove them to create a application so that Gameshub can offer you a unique way to get some feed back from your games even at yearly stages. We now serve customers all over the world, and are thrilled that we're able to turn our passion into our own website.</p>
            <p>We hope you enjoy our products as much as we enjoy offering them to you. If you have any questions or comments, please don't hesitate to contact us.</p>
            <p>Sincerely,</p>
            <p>Bruno Monteiro & João Ribeiro</p>
        </section>
        <div class="col-2"></div>
    </section>
@endsection
