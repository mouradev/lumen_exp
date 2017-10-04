<?php
  
namespace App\Http\Controllers;
  
use App\Game;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
  
  
class GameController extends Controller{  
      
    public function index() {
        $Games = Game::all();
        $all_games = [];
        foreach($Games as $key => $game) {
            $all_games[$key]['name'] = $game->name;
            $all_games[$key]['genre'] = $game->genre;
            if($game->users) {
                foreach($game->users as $k => $user) {
                    $all_games[$key]['users'][$k]['id'] = $user->id;            
                    $all_games[$key]['users'][$k]['name'] = $user->name;            
                }
            }else {
                $all_games[$key]['users'] = [];
            }
        }

        return response()->json($all_games);
    }

    public function createGame(Request $request){
  
        $this->validate($request, [
            'name' => 'required|unique:games|max:255',
            'genre' => 'required',
        ]);   

        $Game = Game::create([
            'name' => $request->input('name'), 
            'genre' => $request->input('genre')
        ]);

        return response()->json($Game);
  
    }

    public function addUser($id, $user_id) {
        $Game = Game::find($id);

        $Game->users()->attach($user_id);

        return response()->json([
            'name' => $Game->name,
            'users' => $Game->users
        ]);
    }

    public function removeUser($id, $user_id) {
        $Game = Game::find($id);

        $Game->users()->detach($user_id);

        return response()->json([
            'name' => $Game->name,
            'users' => $Game->users
        ]);
    }
}
?>
