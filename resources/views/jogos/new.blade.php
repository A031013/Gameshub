@extends('layouts.app')

@section("content")
    <section id="new" class=".col-12 .col-md-8">
        <h3>Uploading a new Game</h3>
        <section id="return">
            <a id="show_return" href="/dev-games" class="btn btn-primary">Return</a>
        </section>
        <form id="new_form" method="POST" enctype="multipart/form-data" action="{{ route('jogos.store') }}">
            @if($mensagem != null)
                @if($mensagem == "name")
                    <div class="alert alert-danger" role="alert">
                        There is already a game registered with that same name.
                    </div>
                @elseif($mensagem == "cats")
                    <div class="alert alert-danger" role="alert">
                        Your game must have at least 1 category up to maximum of 3 categories.
                    </div>
                @elseif($mensagem == "desc")
                    <div class="alert alert-danger" role="alert">
                        Your game description should have a minimum of 50 characters up to a maximum of 1000 characters.
                    </div>
                @elseif($mensagem == "req")
                    <div class="alert alert-danger" role="alert">
                        Your game requirements should have a minimum of 20 characters up to a maximum of 500 characters.
                    </div>
                @elseif($mensagem == "demo_game")
                    <div class="alert alert-danger" role="alert">
                        Your game should upload a demonstration, a complete versions of the game or both.
                    </div>
                @elseif($mensagem == "demo_game_ext")
                    <div class="alert alert-danger" role="alert">
                        Your demo and game should have one of the acceptable extensions: .exe, .zip or .7z.
                    </div>
                @elseif($mensagem == "cover")
                    <div class="alert alert-danger" role="alert">
                        Your game cover should have one of the acceptable extensions: .png, .jpg or .jpeg.
                    </div>
                @elseif($mensagem == "success")
                    <div class="alert alert-success" role="alert">
                        Your game has been added with success, thanks for your contribution to Gameshub!
                    </div>
                @endif
            @endif
            @csrf
            <div id="name_cont">
                <h5>Game Name</h5>
                <input id="nome" type="text" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" name="nome" value="{{ old('nome') }}" required minlength="5" maxlength="30" autofocus>
            </div>
            <div id="cat_cont">
                <h5>Your Game Category</h5>
                <p>Pick up to 3 categories that your game represents.</p>
                <div class="custom-control custom-checkbox">
                    <input name="action" type="checkbox" class="custom-control-input" id="action">
                    <label class="custom-control-label" for="action">Action</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input name="adventure" type="checkbox" class="custom-control-input" id="adventure">
                    <label class="custom-control-label" for="adventure">Adventure</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input name="rpg" type="checkbox" class="custom-control-input" id="rpg">
                    <label class="custom-control-label" for="rpg">RPG</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input name="simulation" type="checkbox" class="custom-control-input" id="simulation">
                    <label class="custom-control-label" for="simulation">Simulation</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input name="horror" type="checkbox" class="custom-control-input" id="horror">
                    <label class="custom-control-label" for="horror">Horror</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input name="strategy" type="checkbox" class="custom-control-input" id="strategy">
                    <label class="custom-control-label" for="strategy">Strategy</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input name="sports" type="checkbox" class="custom-control-input" id="sports">
                    <label class="custom-control-label" for="sports">Sports</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input name="idle" type="checkbox" class="custom-control-input" id="idle">
                    <label class="custom-control-label" for="idle">Idle Gaming</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input name="other" type="checkbox" class="custom-control-input" id="other">
                    <label class="custom-control-label" for="other">Other</label>
                </div>

            </div>
            <div id="description_cont">
                <h5>Description of the Game</h5>
                <textarea id="game-ckeditor" name="description" class="area" rows="4" cols="50" required autofocus></textarea>
            </div>
            <div id="require_cont">
                <h5>Requirements to run the Game</h5>
                <textarea id="rgame-ckeditor" name="require" class="area" rows="4" cols="50" required autofocus></textarea>
            </div>
            <div id="demo_cont">
                <h5>Upload a Demonstration of your Game</h5>
                <input type="file" name="demo" id="demo">
            </div>
            <div id="game_cont">
                <h5>Upload a Complete version of your Game</h5>
                <input type="file" name="game" id="game">
            </div>
            <div id="cover_cont">
                <h5>Select a Cover-Image for your Game</h5>
                <p>The allowed formats are: .png, .jpg and .jpeg.</p>
                <input type="file" name="cover" id="cover" required autofocus>
            </div>
            <div id="submit" class="form-group row mb-0">
                <button id="upload" type="submit" class="btn btn-primary">{{ __('Upload') }}</button>
            </div>
        </form>
    </section>
@endsection