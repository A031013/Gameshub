<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\File;
use Auth;


class Request_statusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', []);
    }

    public function index()
    {
        $user_status = Auth::user()->menber_status;
        if($user_status != 'Admin'){
            return redirect()->route('jogos.index');
        }
        $requests = DB::table('request_statuses')->join('users', 'request_statuses.user', '=', 'users.id')->paginate(10);
        return view('requests.index')->with(['requests' => $requests]);
    }
    public function view($id)
    {
        $user_status = Auth::user()->menber_status;
        if($user_status != 'Admin'){
            return redirect()->route('jogos.index');
        }
        $request = DB::select("select * from request_statuses INNER JOIN users ON users.id=request_statuses.user WHERE request_statuses.request_id = $id");
        if($request != null){
            $request = $request[0];
        }

        return view('requests.view')->with(['request' => $request]);
    }

    public function accept($id)
    {
        $user_status = Auth::user()->menber_status;
        if($user_status != 'Admin'){
            return redirect()->route('jogos.index');
        }

        $update_request = DB::update("UPDATE request_statuses SET estado = ? WHERE request_id = $id", ['Granted']);
        $user = DB::select("SELECT user FROM request_statuses WHERE request_id = $id");
        $user = $user[0]->user;

        $update_user = DB::update("UPDATE users SET menber_status = ? WHERE id = $user", ['Developer']);

        if($update_request == true && $update_user == true){
            return redirect()->route('requests.index');
        }


    }

    public function deny($id)
    {
        $user_status = Auth::user()->menber_status;
        if($user_status != 'Admin'){
            return redirect()->route('jogos.index');
        }

        $update = DB::update("UPDATE request_statuses SET estado = ? WHERE request_id = $id", ['Denied']);
        if($update == true){
            return redirect()->route('requests.index');
        }

    }

    public function download($game_name)
    {
        $user_status = Auth::user()->menber_status;
        if($user_status != 'Admin'){
            return redirect()->route('jogos.index');
        }

        $headers = array(
            "Content-Type: application/octet-stream",
            "Content-Length:  . filesize($game_name)",
        );
        return response()->download(storage_path("app/public/games/{$game_name}"));

    }
    public function uploads(Request $request)
    {
        $user_status = Auth::user()->menber_status;
        if($user_status != 'Admin'){
            return redirect()->route('jogos.index');
        }
        $uploads = DB::select('select * from upload INNER JOIN jogos ON jogos.jogo_id=upload.jogo_id ORDER BY upload.data_upload DESC');

        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        // Create a new Laravel collection from the array data
        $itemCollection = collect($uploads);

        // Define how many items we want to be visible in each page
        $perPage = 5;

        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

        // Create our paginator and pass it to the view
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);

        // set url path for generted links
        $paginatedItems->setPath($request->url());

        $uploads = $paginatedItems;

        return view('requests.uploads')->with(['uploads' => $uploads]);
    }
}
