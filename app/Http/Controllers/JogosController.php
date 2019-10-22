<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use App\User;
use App\Jogo;
use Auth;
use DB;

class JogosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    public function index(Request $request)
    {
        $jogos = DB::select('select * from jogos INNER JOIN avaliacao_media ON avaliacao_media.jogo_id=jogos.jogo_id ORDER BY data_lancamento DESC');

        $jogos_array = array();
        foreach($jogos as $jogo){
            $cats = DB::select('select nome from categoria where jogo = ?', [$jogo->jogo_id]);
            array_push($jogos_array, array($jogo, $cats));
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        // Create a new Laravel collection from the array data
        $itemCollection = collect($jogos_array);

        // Define how many items we want to be visible in each page
        $perPage = 30;

        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

        // Create our paginator and pass it to the view
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);

        // set url path for generted links
        $paginatedItems->setPath($request->url());

        return view('jogos.index')->with('paginatedItems', $paginatedItems);
    }
    public function developerIndex()
    {
        $nome = Auth::user()->nome;
        if(Auth::user()->menber_status != 'Developer'){
            $jogos = DB::select('select * from jogos INNER JOIN avaliacao_media ON avaliacao_media.jogo_id=jogos.jogo_id ORDER BY data_lancamento DESC');
            return view('jogos.index')->with('jogos', $jogos);
        }

        $jogos = DB::table('jogos')->join(
            'avaliacao_media', 'jogos.jogo_id', '=', 'avaliacao_media.jogo_id'
            )->join(
            'download_media', 'jogos.jogo_id', '=', 'download_media.jogo_id'
        )->where('proprietario', $nome)->paginate(5);

        return view('dev.index')->with('jogos', $jogos);
    }

    public function create()
    {
        $mensagem = "";
        if(Auth::user()->menber_status != 'Developer'){
            $jogos = DB::select('select * from jogos INNER JOIN avaliacao_media ON avaliacao_media.jogo_id=jogos.jogo_id ORDER BY data_lancamento DESC');
            return view('jogos.index')->with('jogos', $jogos);
        }
        return view('jogos.new')->with('mensagem', $mensagem);
    }

    public function store(Request $request)
    {
        $mensagem = "";
        if(Auth::user()->menber_status != 'Developer'){
            $jogos = DB::select('select * from jogos INNER JOIN avaliacao_media ON avaliacao_media.jogo_id=jogos.jogo_id ORDER BY data_lancamento DESC');
            return view('jogos.index')->with('jogos', $jogos);
        }
        $game_name = $request->input('nome');
        $game_cat_action = $request->input('action');
        $game_cat_horror = $request->input('horror');
        $game_cat_adventure = $request->input('adventure');
        $game_cat_rpg = $request->input('rpg');
        $game_cat_simulation = $request->input('simulation');
        $game_cat_strategy = $request->input('strategy');
        $game_cat_sports = $request->input('sports');
        $game_cat_idle = $request->input('idle');
        $game_cat_other = $request->input('other');
        $game_description = $request->input('description');
        $game_requirements = $request->input('require');
        $game_demo = $request->hasFile('demo');
        $game_game = $request->hasFile('game');
        $game_cover = $request->hasFile('cover');
        $game_demo_name = null;
        $game_game_name = null;
        $game_cover_name = null;

        //Validations

        if($game_name){
            $search = DB::select("select * from jogos where nome = ?", [$game_name]);
            if($search != null){
                $mensagem = "name";
                return view('jogos.new')->with('mensagem', $mensagem);
            }
        }

        $count_cats = 0;
        $cats_array = array();
        if($game_cat_action){$count_cats = $count_cats + 1;array_push($cats_array, "Action");}
        if($game_cat_adventure){$count_cats = $count_cats + 1;array_push($cats_array, "Adventure");}
        if($game_cat_rpg){$count_cats = $count_cats + 1;array_push($cats_array, "RPG");}
        if($game_cat_simulation){$count_cats = $count_cats + 1;array_push($cats_array, "Simulation");}
        if($game_cat_horror){$count_cats = $count_cats + 1;array_push($cats_array, "Horror");}
        if($game_cat_strategy){$count_cats = $count_cats + 1;array_push($cats_array, "Strategy");}
        if($game_cat_sports){$count_cats = $count_cats + 1;array_push($cats_array, "Sports");}
        if($game_cat_idle){$count_cats = $count_cats + 1;array_push($cats_array, "Idle");}
        if($game_cat_other){$count_cats = $count_cats + 1;array_push($cats_array, "Other");}

        if($count_cats == 0 || $count_cats > 3){
           $mensagem = "cats";
           return view('jogos.new')->with('mensagem', $mensagem);
        }
        if(strlen($game_description) > 1500 || strlen($game_description) < 50){
            $mensagem = "desc";
            return view('jogos.new')->with('mensagem', $mensagem);
        }
        if(strlen($game_requirements) > 700 || strlen($game_requirements) < 20){
            $mensagem = "req";
            return view('jogos.new')->with('mensagem', $mensagem);
        }

        if($game_demo == false && $game_game == false){
            $mensagem = "demo_game";
            return view('jogos.new')->with('mensagem', $mensagem);
        }

        if($game_demo){
            $demo_extension = $request->file('demo')->getClientOriginalExtension();
            if($demo_extension != 'exe' && $demo_extension != 'rar' && $demo_extension != '7z'){
                $mensagem = "demo_game_ext";
                return view('jogos.new')->with('mensagem', $mensagem);
            }else{
                $game_demo_name = $game_name . "." . $demo_extension;
                $path = $request->file('demo')->storeAs('public/demos/', $game_demo_name);
            }
        }
        if($game_game){
            $game_extension = $request->file('game')->getClientOriginalExtension();
            if($game_extension != 'exe' && $game_extension != 'rar' && $game_extension != '7z'){
                $mensagem = "demo_game_ext";
                return view('jogos.new')->with('mensagem', $mensagem);
            }else{
                $game_game_name = $game_name . "." . $game_extension;
                $path = $request->file('game')->storeAs('public/games/', $game_game_name);
            }
        }
        if($game_cover){
            $cover_extension = $request->file('cover')->getClientOriginalExtension();
            if($cover_extension != 'png' && $cover_extension != 'jpg' && $cover_extension != 'jpeg'){
                $mensagem = "cover";
                return view('jogos.new')->with('mensagem', $mensagem);
            }else{
                $game_cover_name = $game_name . "." . $cover_extension;
                $path = $request->file('cover')->storeAs('public/img/jogos/', $game_cover_name);
            }
        }
        // END VALIDATION AND FILE STORAGE

        $game = new Jogo();
        $game->nome = $game_name;
        $game->proprietario = Auth::user()->nome;
        $game->descricao = $game_description;
        $game->requisitos = $game_requirements;
        $game->demo =  $game_demo_name;
        $game->instalador =  $game_game_name;
        $game->jogo_foto =  $game_cover_name;
        $game->data_lancamento = date("Y-m-d");
        $game->save();

        $search = DB::select("select * from jogos where nome = ?", [$game_name]);
        $id = $search[0]->jogo_id;
        foreach($cats_array as $cat){
            DB::table('categoria')->insert([
                'jogo'      => $id,
                'nome'      => $cat,
            ]);
        }
        DB::table('avaliacao_media')->insert([
            'jogo_id'      => $id,
        ]);
        DB::table('download_media')->insert([
            'jogo_id'      => $id,
        ]);

        $demo_size = filesize($request->file('demo'));
        $game_size = filesize($request->file('game'));
        $fullsize = $demo_size + $game_size;
        $fullsize = $this->formatSizeUnits($fullsize);

        DB::table('upload')->insert([
            'jogo_id'        => $id,
            'utilizador_id'  => Auth::user()->id,
            'data_upload'    => date("Y-m-d"),
            'tamanho'        => $fullsize,
        ]);
        $mensagem = "success";
        return view('jogos.new')->with('mensagem', $mensagem);
    }

    public function show($id)
    {
        $jogo = DB::select('select * from jogos inner join avaliacao_media on jogos.jogo_id = avaliacao_media.jogo_id inner join download_media on jogos.jogo_id = download_media.jogo_id where jogos.jogo_id = ?', [$id]);
        $jogo = $jogo[0];
        $cats = DB::select('select nome from categoria where jogo = ?', [$id]);
        $jogo = array($jogo, $cats);

        return view('jogos.show')->with('jogo', $jogo);
    }

    public function edit($id)
    {
        $mensagem = null;
        if(Auth::user()->menber_status != 'Developer'){
            $jogos = DB::select('select * from jogos INNER JOIN avaliacao_media ON avaliacao_media.jogo_id=jogos.jogo_id ORDER BY data_lancamento DESC');
            return view('jogos.index')->with('jogos', $jogos);
        }
        $jogo = DB::select('select * from jogos where jogo_id = ?', [$id]);
        $nome = Auth::user()->nome;
        if($jogo[0]->proprietario != $nome){
            $jogos = DB::table('jogos')->join(
                'avaliacao_media', 'jogos.jogo_id', '=', 'avaliacao_media.jogo_id'
            )->join(
                'download_media', 'jogos.jogo_id', '=', 'download_media.jogo_id'
            )->where('proprietario', $nome )->paginate(5);

            return redirect()->route('dev.index')->with('jogos', $jogos);
        }
        $jogo = array($jogo, $mensagem);


        return view('jogos.edit')->with('jogo', $jogo);
    }

    public function update(Request $request, $id)
    {
        $mensagem = "";
        if(Auth::user()->menber_status != 'Developer'){
            $jogos = DB::select('select * from jogos INNER JOIN avaliacao_media ON avaliacao_media.jogo_id=jogos.jogo_id ORDER BY data_lancamento DESC');
            return view('jogos.index')->with('jogos', $jogos);
        }
        $game_name = $request->input('nome');
        $game_cat_action = $request->input('action');
        $game_cat_adventure = $request->input('adventure');
        $game_cat_rpg = $request->input('rpg');
        $game_cat_simulation = $request->input('simulation');
        $game_cat_strategy = $request->input('strategy');
        $game_cat_sports = $request->input('sports');
        $game_cat_idle = $request->input('idle');
        $game_cat_other = $request->input('other');
        $game_description = $request->input('description');
        $game_requirements = $request->input('require');
        $game_cover = $request->hasFile('cover');
        $game_cover_name = null;
        $game_last_instance = DB::select('select * from jogos where jogo_id = ?', [$id]);;

        if($game_last_instance[0]->nome != $game_name){
            if($game_name){
                $search = DB::select("select * from jogos where nome = ?", [$game_name]);
                if($search != null){
                    $mensagem = "name";
                    $jogo = DB::select('select * from jogos where jogo_id = ?', [$id]);
                    $jogo = array($jogo, $mensagem);
                    return view('jogos.edit')->with('jogo', $jogo);
                }
            }
        }

        $count_cats = 0;
        $cats_array = array();
        if($game_cat_action){$count_cats = $count_cats + 1;array_push($cats_array, "Action");}
        if($game_cat_adventure){$count_cats = $count_cats + 1;array_push($cats_array, "Adventure");}
        if($game_cat_rpg){$count_cats = $count_cats + 1;array_push($cats_array, "RPG");}
        if($game_cat_simulation){$count_cats = $count_cats + 1;array_push($cats_array, "Simulation");}
        if($game_cat_strategy){$count_cats = $count_cats + 1;array_push($cats_array, "Strategy");}
        if($game_cat_sports){$count_cats = $count_cats + 1;array_push($cats_array, "Sports");}
        if($game_cat_idle){$count_cats = $count_cats + 1;array_push($cats_array, "Idle");}
        if($game_cat_other){$count_cats = $count_cats + 1;array_push($cats_array, "Other");}

        if($count_cats == 0 || $count_cats > 3){
            $mensagem = "cats";
            $jogo = DB::select('select * from jogos where jogo_id = ?', [$id]);
            $jogo = array($jogo, $mensagem);
            return view('jogos.edit')->with('jogo', $jogo);
        }
        if(strlen($game_description) > 1500 || strlen($game_description) < 50){
            $mensagem = "desc";
            $jogo = DB::select('select * from jogos where jogo_id = ?', [$id]);
            $jogo = array($jogo, $mensagem);
            return view('jogos.edit')->with('jogo', $jogo);
        }
        if(strlen($game_requirements) > 700 || strlen($game_requirements) < 20){
            $mensagem = "req";
            $jogo = DB::select('select * from jogos where jogo_id = ?', [$id]);
            $jogo = array($jogo, $mensagem);
            return view('jogos.edit')->with('jogo', $jogo);
        }

        if($game_cover){
            $cover_extension = $request->file('cover')->getClientOriginalExtension();
            if($cover_extension != 'png' && $cover_extension != 'jpg' && $cover_extension != 'jpeg'){
                $mensagem = "cover";
                $jogo = DB::select('select * from jogos where jogo_id = ?', [$id]);
                $jogo = array($jogo, $mensagem);
                return view('jogos.edit')->with('jogo', $jogo);
            }else{
                $game_cover_name = $game_name . "." . $cover_extension;
                $path = $request->file('cover')->storeAs('public/img/jogos/', $game_cover_name);
            }
        }

        $jogo = DB::table('jogos')->where('jogo_id', $id)->update(array(
                "nome" => $game_name,
                "descricao" => $game_description,
                "requisitos" => $game_requirements,
                "jogo_foto" => $game_cover_name,
            ));

        $delete_cats = DB::table('categoria')->where('jogo', '=', $id)->delete();
        foreach($cats_array as $cat){
            DB::table('categoria')->insert([
                'jogo'      => $id,
                'nome'      => $cat,
            ]);
        }

        $mensagem = "success";
        $jogo = DB::select('select * from jogos where jogo_id = ?', [$id]);
        $jogo = array($jogo, $mensagem);
        return view('jogos.edit')->with('jogo', $jogo);

    }

    public function destroy($id)
    {
        if(Auth::user()->menber_status != 'Developer'){
            $jogos = DB::select('select * from jogos INNER JOIN avaliacao_media ON avaliacao_media.jogo_id=jogos.jogo_id ORDER BY data_lancamento DESC');
            return view('jogos.index')->with('jogos', $jogos);
        }
        $jogo = DB::select('select * from jogos where jogo_id = ?', [$id]);
        $nome = Auth::user()->nome;
        if($jogo[0]->proprietario != $nome){
            $jogos = DB::table('jogos')->join(
                'avaliacao_media', 'jogos.jogo_id', '=', 'avaliacao_media.jogo_id'
            )->join(
                'download_media', 'jogos.jogo_id', '=', 'download_media.jogo_id'
            )->where('proprietario', $nome )->paginate(5);

            return redirect()->route('dev.index')->with('jogos', $jogos);
        }

        $delete_jogos = DB::table('jogos')->where('jogo_id', '=', $id)->delete();
        $delete_download = DB::table('download')->where('jogo_id', '=', $id)->delete();
        $delete_download_media = DB::table('download_media')->where('jogo_id', '=', $id)->delete();
        $delete_avaliacao = DB::table('avaliacao_jogo')->where('jogo_id', '=', $id)->delete();
        $delete_avaliacao_media = DB::table('avaliacao_media')->where('jogo_id', '=', $id)->delete();
        $delete_upload = DB::table('upload')->where('jogo_id', '=', $id)->delete();
        $delete_categorias = DB::table('categoria')->where('jogo', '=', $id)->delete();

        $jogos = DB::table('jogos')->join(
            'avaliacao_media', 'jogos.jogo_id', '=', 'avaliacao_media.jogo_id'
        )->join(
            'download_media', 'jogos.jogo_id', '=', 'download_media.jogo_id'
        )->where('proprietario', $nome )->paginate(5);

        return redirect()->route('dev.index')->with('jogos', $jogos);
    }
    public function vote($id)
    {
        $mensagem = "";
        $jogo = DB::select('select * from jogos where jogo_id = ?', [$id]);
        $jogo = array($jogo, $mensagem);
        return view('jogos.vote')->with('jogo', $jogo);
    }
    public function store_vote(Request $request,$id)
    {
        $check = DB::select('select * from avaliacao_jogo where jogo_id = ? AND utilizador_id = ?', [$id, Auth::user()->id]);

        if($check != null){
            $mensagem = "voted_already";
            $jogo = DB::select('select * from jogos where jogo_id = ?', [$id]);
            $jogo = array($jogo, $mensagem);
            return view('jogos.vote')->with('jogo', $jogo);
        }

        DB::table('avaliacao_jogo')->insert([
            'jogo_id'      => $id,
            'utilizador_id'      => Auth::user()->id,
            'rating'      => $request->rating,
            'data_avaliacao'      => date("Y-m-d"),
        ]);
        $mensagem = "success";
        $jogo = DB::select('select * from jogos where jogo_id = ?', [$id]);
        $jogo = array($jogo, $mensagem);
        return view('jogos.vote')->with('jogo', $jogo);

    }
    public function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
    public function download_jogo($game_id)
    {
        $jogo = DB::select('select * from jogos where jogo_id = ?', [$game_id]);
        $jogo = $jogo[0];
        DB::table('download')->insert([
            'jogo_id'        => $game_id,
            'utilizador_id'  => Auth::user()->id,
        ]);
        return response()->download(storage_path("app/public/games/{$jogo->instalador}"));

    }
    public function download_demo($game_id)
    {
        $jogo = DB::select('select * from jogos where jogo_id = ?', [$game_id]);
        $jogo = $jogo[0];
        DB::table('download')->insert([
            'jogo_id'        => $game_id,
            'utilizador_id'  => Auth::user()->id,
        ]);
        return response()->download(storage_path("app/public/demos/{$jogo->demo}"));

    }
}
