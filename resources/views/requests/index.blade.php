@extends('layouts.app')

@section("content")
    <section id="content_container" style="padding-top:20px;" class="container">
        @if(count($requests) > 0)
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
                                    <th>User</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th class="td-actions"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requests as $request)
                                        <tr>
                                            <td><a id="td_user" href="/profile/show/{{$request->user}}">{{$request->nome}}</a></td>
                                            <td>{{$request->telemovel}}</td>
                                            @if($request->estado == 'Denied')
                                                <td style="color: red;">{{$request->estado}}</td>
                                            @elseif($request->estado == 'Granted')
                                                <td style="color: green;">{{$request->estado}}</td>
                                            @else
                                                <td>{{$request->estado}}</td>
                                            @endif
                                            <td>{{date("m-d-Y", strtotime($request->data))}}</td>
                                            <td  class="td-actions">
                                                <a href="/requests/view/{{$request->request_id}}" class="btn btn-primary">View</a>
                                                @if($request->estado == 'Waiting Decision')
                                                    <a href="/requests/accept/{{$request->request_id}}" class="btn btn-success">Grant</a>
                                                    <a href="/requests/deny/{{$request->request_id}}" class="btn btn-danger">Deny</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div style="width: 100%; margin-top: 20px; margin-left: 42%">{{$requests->links()}}</div>
            </section>
        @else
            <p>There are no status requests avaiable at this moment.</p>
        @endif
    </section>
@endsection
