@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" style="margin-bottom: 1%;">
                    <div class="card-body" style="background-color: #F1F1F2;">
                        <h1><strong>Status Request Number: {{$request->request_id}}</strong></h1>
                        <h5><strong>Requested by user: <a style="text-decoration: none;" href="/profile/show/{{$request->user}}">{{$request->nome}}</a></strong></h5>
                        <h5><strong>Date: {{date("m-d-Y", strtotime($request->data))}}</strong></h5>
                        <h2 style="margin-top: 30px;"><strong>Request Description</strong></h2>
                        <div id="request_description" style="color: black; background-color: white; padding-top: 20px;padding-bottom: 20px;"class="col md-10">
                            {!! $request->descricao !!}
                        </div>
                        <h2 style="margin-top: 30px;"><strong>User Personal Information</strong></h2>
                        <ul>
                            <li><strong>Date of Birth:</strong> {{date("m-d-Y", strtotime($request->data_nascimento))}}</li>
                            <li><strong>Phone:</strong> {{$request->telemovel}}</li>
                            <li><strong>Email Address:</strong> {{$request->email}}</li>
                            <li><strong>Address:</strong> {{$request->morada}} {{$request->cod_postal}}</li>
                        </ul>
                        <h2 style="margin-top: 30px;"><strong>Game Sample for Evaluation</strong></h2>
                        <h3 style="margin-left: 11%; margin-bottom: 30px;"><strong><a href="/requests/download/{{$request->jogo}}">Download</a></strong></h3>
                        @if($request->estado == 'Waiting Decision')
                            <center><a href="/requests/accept/{{$request->request_id}}" class="btn btn-success">Grant</a>
                            <a href="/requests/deny/{{$request->request_id}}" class="btn btn-danger">Deny</a></center>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
