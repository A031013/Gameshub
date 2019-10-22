@extends('layouts.app')

@section("content")
    @if($jogo)
        <?php $mensagem = $jogo[1];
        $jogo = $jogo[0]; ?>
    @endif
    <section id="vote" class=".col-12 .col-md-8">
        <section id="return">
            <a id="show_return" href="/jogo/{{$jogo[0]->jogo_id}}" class="btn btn-primary">Return</a>
        </section>
        <h3>Vote for {{$jogo[0]->nome}}</h3>
        <form id="vote_form" method="POST" enctype="multipart/form-data" action="{{ route('jogos.store_vote', $jogo[0]->jogo_id) }}">
            @if($mensagem != null)
                @if($mensagem == "voted_already")
                    <div class="alert alert-danger" role="alert">
                        Theres already a vote under your account related to this game! You can not vote more then once.
                    </div>
                @elseif($mensagem == "success")
                    <div class="alert alert-success" role="alert">
                        Your vote has been sent to our team with success. Thanks for the contribute!
                    </div>
                @endif
            @endif
            @csrf
            <p>Voting is great way of giving feedback to the developers of the game, letting them know if they need to improve or stick to the game core.</p>
            <p>Please be cautious voting since once you do so, you can no longer vote for this version of the respective game.</p>
            <label for="sel1">Rating 1-10:</label>
            <select class="form-control" id="rating" name="rating" required>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
            </select>
            <div id="submit" class="form-group row mb-0">
                <button id="vote_btn" type="submit" class="btn btn-primary">{{ __('Vote') }}</button>
            </div>
        </form>
    </section>
@endsection