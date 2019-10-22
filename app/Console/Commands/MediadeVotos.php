<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Jogo;

class MediadeVotos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'media:votos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Efetua a media dos votos e downloads de todos os jogos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //Media de ratings por jogo
        $games = DB::select('select DISTINCT jogo_id from avaliacao_jogo');
        foreach($games as $game){
            $ratings = DB::select('select * from avaliacao_jogo where jogo_id = ?', [$game->jogo_id]);
            $count = count($ratings);
            $sum = 0;
            foreach($ratings as $rating){
                $sum = $sum + $rating->rating;
            }
            $media = $sum / $count;
            DB::table('avaliacao_media')->where('jogo_id',$game->jogo_id)->update(array(
                'rating'=>intval(round($media)),
            ));
        }
        //Media de downloads de jogo => user
        $downloads = DB::select('select distinct jogo_id, utilizador_id from download ');
        $jogos = DB::select('select distinct jogo_id from download ');
        foreach($jogos as $jogo){
            $count = 0;
            foreach($downloads as $down){
                if($jogo->jogo_id == $down->jogo_id){
                    $count++;
                }
            }
            DB::table('download_media')->where('jogo_id',$jogo->jogo_id)->update(array(
                'downloads'=>$count,
            ));
        }
    }
}
