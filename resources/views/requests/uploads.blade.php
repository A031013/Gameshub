@extends('layouts.app')

@section("content")
    <section id="content_container" style="padding-top:20px;" class="container">
        @if(count($uploads) > 0)
            <section class="container section-data">
                <div class="span7">
                    <div class="widget stacked widget-table action-table">

                        <div class="widget-header">
                            <i class="icon-th-list"></i>
                            <h3>Status Request Table</h3>
                        </div>
                        <div class="widget-content">

                            <table id="tb_requests" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Game</th>
                                    <th>Owner</th>
                                    <th>Demo</th>
                                    <th>Game</th>
                                    <th>Size</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($uploads as $upload)
                                    <tr>
                                        <td><a id="td_jogo" style="color: black; font-weight: bold; font-size: 15px" href="/jogo/{{$upload->jogo_id}}">{{$upload->nome}}</a></td>
                                        <td>{{$upload->proprietario}}</td>
                                        <td>{{$upload->demo}}</td>
                                        <td>{{$upload->instalador}}</td>
                                        <td>{{$upload->tamanho}}</td>
                                        <td>{{date("m-d-Y", strtotime($upload->data_upload))}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div style="width: 100%; margin-top: 20px; margin-left: 42%">{{$uploads->links()}}</div>
            </section>
        @else
            <p>There are no status requests avaiable at this moment.</p>
        @endif
    </section>
@endsection