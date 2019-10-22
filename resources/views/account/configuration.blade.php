@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Configuration Panel</div>
                <div class="card-body">
                    @if(@$mensagem == 'picture')
                        <div class="alert alert-success" role="alert">
                            Your profile picture has been changed with success!
                        </div>
                    @endif
                    @if(@$mensagem == 'username')
                        <div class="alert alert-success" role="alert">
                            Username has been changed with success!
                        </div>
                    @endif
                    @if(@$mensagem == 'password')
                        <div class="alert alert-success" role="alert">
                            Password has been changed with success!
                        </div>
                    @endif
                    @if(@$mensagem == 'email')
                        <div class="alert alert-success" role="alert">
                            Your email has been changed with success!
                        </div>
                    @endif
                    @if(@$mensagem == 'bio')
                        <div class="alert alert-success" role="alert">
                            Your biography has been changed with success!
                        </div>
                    @endif
                    @if(@$mensagem == 'morada')
                        <div class="alert alert-success" role="alert">
                            Your address has been changed with success!
                        </div>
                    @endif
                    @if(@$mensagem == 'erro')
                        <div class="alert alert-danger" role="alert">
                            There has been problem in the last request. Please try again.
                        </div>
                    @endif
                    @if(@$mensagem == 'request')
                         <div class="alert alert-success" role="alert">
                             Your request has been sent with success! Please wait up to 3 days for a response.
                         </div>
                    @endif
                    @if(@$mensagem == 'decision_request')
                        <div class="alert alert-danger" role="alert">
                            You cant have more then one request in evaluation. Please wait for a positive or negative decision before sending another request!
                        </div>
                    @endif
                    @if(@$mensagem == 'no_need_request')
                        <div class="alert alert-danger" role="alert">
                            Your request was block because you already have a developer status or higher!
                        </div>
                    @endif
                    <div id="options" class="col-md-3">
                        <h4>Options Panel</h4>
                        <ul>
                            <li><a id="a_pic" class="a_picker" onclick="toggle_visibility('pic', 'a_pic');">Change Profile Picture</a></li>
                            <li><a id="a_user" class="a_picker" onclick="toggle_visibility('user', 'a_user');">Change Username</a></li>
                            <li><a id="a_pass" class="a_picker" onclick="toggle_visibility('pass', 'a_pass');">Change Password</a></li>
                            <li><a id="a_mail" class="a_picker" onclick="toggle_visibility('mail', 'a_mail');">Change E-Mail Address</a></li>
                            <li><a id="a_address" class="a_picker" onclick="toggle_visibility('address', 'a_address');">Change Address</a></li>
                            <li><a id="a_date" class="a_picker" onclick="toggle_visibility('date', 'a_date');">Change Date of Birth</a></li>
                            <li><a id="a_bio" class="a_picker" onclick="toggle_visibility('bio', 'a_bio');">Change Biography</a></li>
                            @if( Auth::user()->menber_status != 'Developer')
                                <li><a id="a_request" class="a_picker" onclick="toggle_visibility('request', 'a_request');">Request Developer Status</a></li>
                            @endif
                        </ul>
                    </div>
                    <div id="forms" class="col-md-8">
                        @if (@$mensagem == null)
                            <section id="config_info">
                                <div id="img"><img class="lazy" id="card-img" src="{{ URL::to('/') }}/storage/img/lazy.gif" data-src="{{ URL::to('/') }}/storage/img/config.jpg" data-srcset="{{ URL::to('/') }}/storage/img/config.jpg"/></div>
                                <h4>Configuration Notice</h4>
                                <p>In Gameshub, we recommend you to act with caution when using configuration/requesting services. As you already know if a user changes in username, he's older username is available for use by new or older accounts, meaning that you must not misspell your new username in an effort to pass "username unique" validation therefore changing your username with success. If you misspell, you risk your username being taken by another user by the time you notice the mistake.</p>
                                <h4>Developer Status Request</h4>
                                <p>Any user can request a developer status and therefore contribute to the community. A user that wants the status granted must fill up a form with his personal information along with he's first uploaded game. Our team will check the user credibility and he's ownership on the game uploaded.</p>
                                <p>This processing can last up to 3 days and you will receive a email notifing you that your request was or wanst granted.</p>
                            </section>
                        @endif
                        @if(@$mensagem == 'no_picture')
                            <form id="pic" class="picker" method="POST" enctype="multipart/form-data" action="{{ route('profiles.change_picture') }}">
                                <div class="alert alert-danger" role="alert">
                                    You need to select a picture to be able to change your current profile picture!
                                </div>
                                @csrf
                                <div class="form-group row">
                                    <label for="picture" class="col-md-4 col-form-label text-md-right">{{ __('Profile Picture') }}</label>
                                    <div class="col-md-6">
                                        <input type="file" name="picture" id="picture" required autofocus>
                                        @if ($errors->has('foto'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('foto') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" style="margin-left: 20px;" class="btn btn-primary">
                                            {{ __('Change') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @elseif(@$mensagem == 'extension_picture')
                            <form id="pic" class="picker" method="POST" enctype="multipart/form-data" action="{{ route('profiles.change_picture') }}">
                                <div class="alert alert-danger" role="alert">
                                    Wrong file extension! The only allowed extensions for a profile picture are jpeg, jpg and png.
                                </div>
                                @csrf
                                <div class="form-group row">
                                    <label for="picture" class="col-md-4 col-form-label text-md-right">{{ __('Profile Picture') }}</label>
                                    <div class="col-md-6">
                                        <input type="file" name="picture" id="picture" required autofocus>
                                        @if ($errors->has('foto'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('foto') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" style="margin-left: 20px;" class="btn btn-primary">
                                            {{ __('Change') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <form id="pic" class="picker" style="display: none;" method="POST" enctype="multipart/form-data" action="{{ route('profiles.change_picture') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="picture" class="col-md-4 col-form-label text-md-right">{{ __('Profile Picture') }}</label>
                                    <div class="col-md-6">
                                        <input type="file" name="picture" id="picture" required autofocus>
                                        @if ($errors->has('foto'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('foto') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" style="margin-left: 20px;" class="btn btn-primary">
                                            {{ __('Change') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endif
                        @if(@$mensagem == 'same_username')
                            <form id="user" class="picker" style="" method="POST" action="{{ route('profiles.change_username') }}">
                                <div class="alert alert-danger" role="alert">
                                    Theres already a user registrated with that same username!
                                </div>
                                @csrf
                                <div class="form-group row">
                                    <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('New Username') }}</label>
                                    <div class="col-md-6">
                                        <input id="nome" type="text" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" name="nome" value="{{Auth::user()->nome}}" required autofocus>
                                        @if ($errors->has('nome'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nome') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" style="margin-left: 20px;" class="btn btn-primary">
                                            {{ __('Change Username') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <form id="user" class="picker" style="display: none;" method="POST" action="{{ route('profiles.change_username') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('New Username') }}</label>
                                    <div class="col-md-6">
                                        <input id="nome" type="text" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" name="nome" value="{{Auth::user()->nome}}" required autofocus>
                                        @if ($errors->has('nome'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nome') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" style="margin-left: 20px;" class="btn btn-primary">
                                            {{ __('Change Username') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endif
                        @if(@$mensagem == 'wrong_current_password')
                            <form id="pass" class="picker" method="POST" action="{{ route('profiles.change_password') }}">
                                <div class="alert alert-danger" role="alert">
                                    You entered the wrong current password!
                                </div>
                                @csrf
                                <div class="form-group row">
                                    <label for="old_password" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="old_password" type="password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" name="old_password" required>

                                        @if ($errors->has('old_password'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="new_password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="new_password" type="password" class="form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}" name="new_password" required>

                                        @if ($errors->has('new_password'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="rep_new_password" class="col-md-4 col-form-label text-md-right">{{ __('Repeat New Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="rep_new_password" type="password" class="form-control{{ $errors->has('rep_new_password') ? ' is-invalid' : '' }}" name="rep_new_password" required>

                                        @if ($errors->has('rep_new_password'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rep_new_password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" style="margin-left: 65px;" class="btn btn-primary">
                                            {{ __('Change') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @elseif(@$mensagem == 'repeat_password')
                            <form id="pass" class="picker" method="POST" action="{{ route('profiles.change_password') }}">
                                <div class="alert alert-danger" role="alert">
                                    The "New Password" and "Repeat New Password" inputs must be identical!
                                </div>
                                @csrf
                                <div class="form-group row">
                                    <label for="old_password" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="old_password" type="password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" name="old_password" required>
                                        @if ($errors->has('new_password'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="new_password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="new_password" type="password" class="form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}" name="new_password" required>
                                        <span class="invalid-feedback" role="alert">
                                            <strong>The "New Password" and "Repeat New Password" inputs must be identical!</strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="rep_new_password" class="col-md-4 col-form-label text-md-right">{{ __('Repeat New Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="rep_new_password" type="password" class="form-control{{ $errors->has('rep_new_password') ? ' is-invalid' : '' }}" name="rep_new_password" required>

                                        @if ($errors->has('rep_new_password'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rep_new_password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" style="margin-left: 65px;" class="btn btn-primary">
                                            {{ __('Change') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <form id="pass" class="picker" style="display: none;" method="POST" action="{{ route('profiles.change_password') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="old_password" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

                                <div class="col-md-6">
                                    <input id="old_password" type="password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" name="old_password" required>

                                    @if ($errors->has('old_password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="new_password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                                <div class="col-md-6">
                                    <input id="new_password" type="password" class="form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}" name="new_password" required>

                                    @if ($errors->has('new_password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="rep_new_password" class="col-md-4 col-form-label text-md-right">{{ __('Repeat New Password') }}</label>

                                <div class="col-md-6">
                                    <input id="rep_new_password" type="password" class="form-control{{ $errors->has('rep_new_password') ? ' is-invalid' : '' }}" name="rep_new_password" required>

                                    @if ($errors->has('rep_new_password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rep_new_password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" style="margin-left: 65px;" class="btn btn-primary">
                                        {{ __('Change') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        @endif
                        @if(@$mensagem == 'same_email')
                            <form id="mail" class="picker" method="POST" action="{{ route('profiles.change_mail') }}">
                            <div class="alert alert-danger" role="alert">
                                Theres already a user with the same email address! User email must be unique.
                            </div>
                            @csrf
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{Auth::user()->email}}" name="email" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" style="margin-left: 55px;" class="btn btn-primary">
                                        {{ __('Change') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        @else
                            <form id="mail" class="picker" style="display: none;" method="POST" action="{{ route('profiles.change_mail') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{Auth::user()->email}}" name="email" required>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" style="margin-left: 55px;" class="btn btn-primary">
                                            {{ __('Change') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endif
                        <form id="address" class="picker" style="display: none;" method="POST" action="{{ route('profiles.change_address') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="morada" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                                <div class="col-md-6">
                                    <input id="morada" type="text" class="form-control{{ $errors->has('morada') ? ' is-invalid' : '' }}" name="morada" value="{{Auth::user()->morada}}" required>

                                    @if ($errors->has('morada'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('morada') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="cod_postal" class="col-md-4 col-form-label text-md-right">{{ __('Postcode') }}</label>

                                <div class="col-md-6">
                                    <input id="cod_postal" type="text" class="form-control{{ $errors->has('cod_postal') ? ' is-invalid' : '' }}" name="cod_postal" value="{{Auth::user()->cod_postal}}" required>

                                    @if ($errors->has('cod_postal'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cod_postal') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" style="margin-left: 55px;" class="btn btn-primary">
                                        {{ __('Change') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <form id="date" class="picker" style="display: none;" method="POST" action="{{ route('profiles.change_date_birth') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="data_nascimento" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                                <div class="col-md-6">
                                    <input id="data_nascimento" type="date" value="{{Auth::user()->data_nascimento}}" class="form-control{{ $errors->has('data_nascimento') ? ' is-invalid' : '' }}" name="data_nascimento" value="{{ old('data_nascimento') }}" min="1900-01-01" max=<?php echo date('Y-m-d');?> required>

                                    @if ($errors->has('data_nascimento'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('data_nascimento') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" style="margin-left: 55px;" class="btn btn-primary">
                                        {{ __('Change') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        @if(@$mensagem == 'limits_bio')
                            <form id="bio" class="picker" method="POST" action="{{ route('profiles.change_biography') }}">
                                <div class="alert alert-danger" role="alert">
                                    A user biography must have atleast 50 characters and cannot surpass 1500 characters!
                                </div>
                                @csrf
                                <div class="form-group">
                                    <h4 style="font-weight: bold">{{ __('Biography') }}</h4>
                                    <textarea id="article-ckeditor" name="biography" class="area" rows="4" cols="50">{{Auth::user()->biography}}</textarea>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" style="margin-left: 35px;" class="btn btn-primary">
                                            {{ __('Change') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <form id="bio" class="picker" style="display: none;" method="POST" action="{{ route('profiles.change_biography') }}">
                            @csrf
                            <div class="form-group">
                                <h4 style="font-weight: bold">{{ __('Biography') }}</h4>
                                <textarea id="bio-ckeditor" name="biography" class="form-control" rows="4" cols="50">{{Auth::user()->biography}}</textarea>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" style="margin-left: 35px;" class="btn btn-primary">
                                        {{ __('Change') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        @endif
                        @if( Auth::user()->menber_status != 'Developer')
                            @if(@$mensagem == 'extension_request' || @$mensagem == 'agree_request' || @$mensagem == 'limits_request')
                                <form id="request" class="picker" method="POST" enctype="multipart/form-data" action="{{ route('profiles.request_developer_status') }}">
                                    @if(@$mensagem == 'limits_request')
                                        <div class="alert alert-danger" role="alert">
                                            A request description must have atleast 50 characters and cannot surpass 1500 characters!
                                        </div>
                                    @elseif(@$mensagem == 'extension_request')
                                        <div class="alert alert-danger" role="alert">
                                            A request game can only be of the following extensions: .exe, .zip, .7z !
                                        </div>
                                    @elseif(@$mensagem == 'agree_request')
                                        <div class="alert alert-danger" role="alert">
                                            You must agree with the terms and policies of Gameshub in order to submit the request!
                                        </div>
                                    @endif
                                    @csrf
                                    <div class="form-group row">
                                        <p>Phone number is a requirement for our team to verify your identity. Phone Number should have a pattern of 9 digits.</p>
                                        <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                                        <div class="col-md-6">
                                            <input id="phone" type="number" pattern="[0-9]{9}" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>

                                            @if ($errors->has('phone'))
                                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('phone') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <h4>Description</h4>
                                        <p>Write about your experience as a developer or the company you represent. Good descriptions give a higher chance of the request being granted.</p>
                                        <textarea id="description-ckeditor" name="description" class="area" rows="4" cols="50"></textarea>
                                    </div>
                                    <div class="form-group row">
                                        <label for="ficheiro" class="col-md-4 col-form-label text-md-right">{{ __('First Game to Upload') }}</label>
                                        <div class="col-md-6">
                                            <input type="file" name="ficheiro" id="ficheiro" required autofocus>
                                            @if ($errors->has('ficheiro'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('ficheiro') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <h4 style="text-align: center;">Terms & Policies</h4>
                                        <p>Parts of this website offer an opportunity for users to post and exchange opinions and information in certain areas of the website. Gameshub does not filter, edit, publish or review Comments prior to their presence on the website. Comments do not reflect the views and opinions of Gameshub,its agents and/or affiliates. Comments reflect the views and opinions of the person who post their views and opinions. To the extent permitted by applicable laws, Gameshub shall not be liable for the Comments or for any liability, damages or expenses caused and/or suffered as a result of any use of and/or posting of and/or appearance of the Comments on this website.</p>
                                        <p>Gameshub reserves the right to monitor all Comments and to remove any Comments which can be considered inappropriate, offensive or causes breach of these Terms and Conditions.</p>
                                        <p>You hereby grant Gameshub a non-exclusive license to use, reproduce, edit and authorize others to use, reproduce and edit any of your Comments in any and all forms, formats or media.</p>
                                        <input type="checkbox" style="margin-left:17%"  class="form-check-input" id="agree" name="agree" required>
                                        <label class="form-check-label" style="margin-left:22%" for="agree">I Agree with the Terms and Policies</label>
                                    </div>
                                    <div class="form-group row mb-0">
                                       <div class="col-md-6 offset-md-4">
                                           <button type="submit" class="btn btn-primary">
                                               {{ __('Send') }}
                                           </button>
                                       </div>
                                    </div>
                               </form>
                            @else
                                <form id="request" class="picker" style="display: none;" method="POST" enctype="multipart/form-data" action="{{ route('profiles.request_developer_status') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <p>Phone number is a requirement for our team to verify your identity. Phone Number should have a pattern of 9 digits.</p>
                                        <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                                        <div class="col-md-6">
                                            <input id="phone" type="number" pattern="[0-9]{9}" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>

                                            @if ($errors->has('phone'))
                                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('phone') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <h4>Description</h4>
                                        <p>Write about your experience as a developer or the company you represent. Good descriptions give a higher chance of the request being granted.</p>
                                        <textarea id="description-ckeditor" name="description" class="form-control" rows="4" cols="50"></textarea>
                                    </div>
                                    <div class="form-group row">
                                        <label for="ficheiro" class="col-md-4 col-form-label text-md-right">{{ __('First Game to Upload') }}</label>
                                        <div class="col-md-6">
                                            <input type="file" name="ficheiro" id="ficheiro" required autofocus>
                                            @if ($errors->has('ficheiro'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ficheiro') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <h4 style="text-align: center;">Terms & Policies</h4>
                                        <p>Parts of this website offer an opportunity for users to post and exchange opinions and information in certain areas of the website. Gameshub does not filter, edit, publish or review Comments prior to their presence on the website. Comments do not reflect the views and opinions of Gameshub,its agents and/or affiliates. Comments reflect the views and opinions of the person who post their views and opinions. To the extent permitted by applicable laws, Gameshub shall not be liable for the Comments or for any liability, damages or expenses caused and/or suffered as a result of any use of and/or posting of and/or appearance of the Comments on this website.</p>
                                        <p>Gameshub reserves the right to monitor all Comments and to remove any Comments which can be considered inappropriate, offensive or causes breach of these Terms and Conditions.</p>
                                        <p>You hereby grant Gameshub a non-exclusive license to use, reproduce, edit and authorize others to use, reproduce and edit any of your Comments in any and all forms, formats or media.</p>
                                        <input type="checkbox" style="margin-left:17%"  class="form-check-input" id="agree" name="agree" required>
                                        <label class="form-check-label" style="margin-left:22%" for="agree">I Agree with the Terms and Policies</label>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Send') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        @else
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
