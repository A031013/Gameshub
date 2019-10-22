<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Request_status;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use phpDocumentor\Reflection\Types\Null_;

class ProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', []);
    }

    public function show($id)
    {
        $user = DB::select('select * from users where id = ?', [$id]);
        $user = $user[0];
        return view('account.profile')->with(['user' => $user]);
    }
    public function configuration()
    {
        if(session('mensagem') != null){
            return view('account.configuration')->with('mensagem', session('mensagem'));
        };

        return view('account.configuration');
    }

    public function change_picture(Request $request)
    {
        $username = Auth::user()->nome;
        $user_id = Auth::user()->id;
        $mensagem = null;
        /*
        $extension = $request->file('picture')->getClientOriginalExtension();
        $fileNameToStore = "sem_foto.".$extension;
        $path = $request->file('picture')->storeAs('public/img/jogos', $fileNameToStore);
        */
        if($request->hasFile('picture')){
            //Get just extension
            $extension = $request->file('picture')->getClientOriginalExtension();
            if($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg'){
                //Filename to Store
                $fileNameToStore = $username.".".$extension;

                $image_path = "/img/perfis/".$fileNameToStore;

                $update = DB::update("UPDATE users SET foto = ? WHERE id = $user_id", [$fileNameToStore]);
                if($update == true){
                    if(File::exists($image_path)) {
                        File::delete($image_path);
                    }
                    //Upload Image
                    $path = $request->file('picture')->storeAs('public/img/perfis', $fileNameToStore);
                    if($path == true){
                        $mensagem = "picture";
                        return redirect('/profile/configuration')->with('mensagem', $mensagem);
                    }else{
                        $mensagem = "erro";
                        return redirect('/profile/configuration')->with('mensagem', $mensagem);
                    }
                }else{
                    $mensagem = "erro";
                    return redirect('/profile/configuration')->with('mensagem', $mensagem);
                }
            }else{
                $mensagem = "extension_picture";
                return redirect('/profile/configuration')->with('mensagem', $mensagem);
            }
        } else {
            $mensagem = "no_picture";
            return redirect('/profile/configuration')->with('mensagem', $mensagem);
        }
    }
    public function change_username(Request $request)
    {
        $new_username = $request->input('nome');
        $search = DB::select('select * from users where nome = ?', [$new_username]);
        $user_id = Auth::user()->id;
        $mensagem = null;

        if($search == NULL){
            $update = DB::update("UPDATE users SET nome = ? WHERE id = $user_id", [$new_username]);
            if($update == true){
                $mensagem = "username";
                return redirect('/profile/configuration')->with('mensagem', $mensagem);
            }else{
                $mensagem = "erro";
                return redirect('/profile/configuration')->with('mensagem', $mensagem);
            }

        }else{
            $mensagem = "same_username";
            return redirect('/profile/configuration')->with('mensagem', $mensagem);
        }

    }
    public function change_password(Request $request)
    {
        $user_id = Auth::user()->id;
        $password = $request->input('old_password');
        $new_password = $request->input('new_password');
        $rep_new_password = $request->input('rep_new_password');

        $mensagem = null;
        $check = Hash::check($password, Auth::user()->password);
        if($check == true){
            if($new_password == $rep_new_password){
                $hash_password = Hash::make($new_password);
                $update = DB::update("UPDATE users SET password = ? WHERE id = $user_id", [$hash_password]);
                if($update == true){
                    $mensagem = "password";
                    return redirect('/profile/configuration')->with('mensagem', $mensagem);
                }else{
                    $mensagem = "erro";
                    return redirect('/profile/configuration')->with('mensagem', $mensagem);
                }
            }else{
                $mensagem = "repeat_password";
                return redirect('/profile/configuration')->with('mensagem', $mensagem);
            }
        }else{
            $mensagem = "wrong_current_password";
            return redirect('/profile/configuration')->with('mensagem', $mensagem);
        }
    }
    public function change_mail(Request $request)
    {
        $email = $request->input('email');
        $search = DB::select('select * from users where email = ?', [$email]);
        $user_id = Auth::user()->id;
        $mensagem = null;

        if($search == NULL){
            $update = DB::update("UPDATE users SET email = ? WHERE id = $user_id", [$email]);
            if($update == true){
                $mensagem = "email";
                return redirect('/profile/configuration')->with('mensagem', $mensagem);
            }else{
                $mensagem = "erro";
                return redirect('/profile/configuration')->with('mensagem', $mensagem);
            }

        }else{
            $mensagem = "same_email";
            return redirect('/profile/configuration')->with('mensagem', $mensagem);
        }
    }
    public function change_date_birth(Request $request)
    {
        $data = $request->input('data_nascimento');
        $user_id = Auth::user()->id;
        $mensagem = null;

        $update = DB::update("UPDATE users SET data_nascimento = ? WHERE id = $user_id", [$data]);
        if($update == true){
            $mensagem = "email";
            return redirect('/profile/configuration')->with('mensagem', $mensagem);
        }else{
            $mensagem = "erro";
            return redirect('/profile/configuration')->with('mensagem', $mensagem);
        }
    }
    public function change_biography(Request $request)
    {
        $bio = $request->input('article-ckeditor');
        $user_id = Auth::user()->id;
        $mensagem = null;


        if(strlen($bio) > 1500 || strlen($bio) < 50){
            $mensagem = "limits_bio";
            return redirect('/profile/configuration')->with('mensagem', $mensagem);
        }else{
            $update = DB::update("UPDATE users SET biography = ? WHERE id = $user_id", [$bio]);
            if($update == true){
                $mensagem = "bio";
                return redirect('/profile/configuration')->with('mensagem', $mensagem);
            }else{
                $mensagem = "erro";
                return redirect('/profile/configuration')->with('mensagem', $mensagem);
            }
        }
        #return redirect('/');
        #return view('account.configuration');
    }
    public function change_address(Request $request)
    {
        $address = $request->input('morada');
        $zipcode = $request->input('cod_postal');
        $user_id = Auth::user()->id;
        $mensagem = null;
        $update = DB::update("UPDATE users SET morada = ? , cod_postal = ? WHERE id = $user_id", [$address, $zipcode]);

        if($update == true){
            $mensagem = "morada";
            return redirect('/profile/configuration')->with('mensagem', $mensagem);
        }else{
            $mensagem = "erro";
            return redirect('/profile/configuration')->with('mensagem', $mensagem);
        }
    }
    public function request_developer_status(Request $request)
    {

        $mensagem = null;
        $number = $request->input('phone');
        $description = $request->input('description');
        $agree = $request->input('agree');
        $user_id = Auth::user()->id;

        //Check User status
        if(Auth::user()->menber_status == 'Admin' || Auth::user()->menber_status == 'Developer'){
            $mensagem = "no_need_request";
            return redirect('/profile/configuration')->with('mensagem', $mensagem);
        }
        //Check for possible existing requests
        $search = DB::select('select * from request_statuses where user = ? AND estado = ?', [$user_id, 'Waiting Decision']);
        if($search != NULL){
            $mensagem = "decision_request";
            return redirect('/profile/configuration')->with('mensagem', $mensagem);
        }

        if($agree == 'on'){
            if(strlen($description) > 1500 || strlen($description) < 50){
                $mensagem = "limits_request";
                return redirect('/profile/configuration')->with('mensagem', $mensagem);
            }else{
                if($request->hasFile('ficheiro')){
                    $fileNameWithExt = $request->file('ficheiro')->getClientOriginalName();
                    //Get just extension
                    $extension = $request->file('ficheiro')->getClientOriginalExtension();
                    //Get just filename
                    $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                    if($extension == 'exe' || $extension == 'rar' || $extension == '7z'){
                        //Filename to Store
                        $fileNameToStore = $filename.".".$extension;

                        $image_path = "/games/".$fileNameToStore;
                        //Upload Image
                        $path = $request->file('ficheiro')->storeAs('public/games/', $fileNameToStore);
                        if($path == true){
                            $req = new Request_status();
                            $req->user = $user_id;
                            $req->telemovel = $number;
                            $req->descricao = $description;
                            $req->jogo = $fileNameToStore;
                            $req->data = date("Y-m-d");
                            $req->save();
                            $mensagem = "request";
                            return redirect('/profile/configuration')->with('mensagem', $mensagem);
                        }else{
                            $mensagem = "erro";
                            return redirect('/profile/configuration')->with('mensagem', $mensagem);
                        }
                    }else{
                        $mensagem = "extension_request";
                        return redirect('/profile/configuration')->with('mensagem', $mensagem);
                    }
                } else {
                    $mensagem = "erro";
                    return redirect('/profile/configuration')->with('mensagem', $mensagem);
                }
            }
        }else{
            $mensagem = "agree_request";
            return redirect('/profile/configuration')->with('mensagem', $mensagem);
        }

    }

}
