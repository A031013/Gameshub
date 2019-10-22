@extends('layouts.app')

@section("content")
    <section id="content_container" style="padding-top:20px;" class="container">
        @if(count($jogos) > 0)
            <section class="container section-data">
                <div class="span7">
                    <div class="widget stacked widget-table action-table">

                        <div class="widget-header">
                            <i class="icon-th-list"></i>
                            <h3>Developer Uploaded Games</h3>
                        </div>
                        <div class="widget-content">

                            <table id="tb_requests" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Demo</th>
                                    <th>Setup</th>
                                    <th>Rating</th>
                                    <th>Downloads</th>
                                    <th>Release Date</th>
                                    <th class="td-actions"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($jogos as $jogo)
                                    <tr>
                                        <td><a id="td_user" style="color: black; font-weight: bold; font-size: 15px; text-transform: uppercase" href="/jogo/{{$jogo->jogo_id}}">{{$jogo->nome}}</a></td>
                                        <td>{{$jogo->demo}}</td>
                                        <td>{{$jogo->instalador}}</td>
                                        <td>{{$jogo->rating}}/10</td>
                                        <td>{{$jogo->downloads}}</td>
                                        <td>{{date("d-m-Y", strtotime($jogo->data_lancamento))}}</td>
                                        <td  class="td-actions">
                                            <a href="dev-games/edit/{{$jogo->jogo_id}}" class="btn btn-primary">Edit</a>
                                            <a href="dev-games/destroy/{{$jogo->jogo_id}}" class="btn btn-danger">Remove</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div style="width: 100%; margin-top: 20px; margin-left: 42%">{{$jogos->links()}}</div>
            </section>
        @else
            <p>You havent uploaded anygames yet.</p>
        @endif
            <div style="margin-left: 42%; margin-top: 20px;">
                <a href="/dev-games/new" class="btn btn-primary">Upload a new Game</a>
            </div>
    </section>
@endsection