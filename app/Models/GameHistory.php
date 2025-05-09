<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameHistory extends Model
{
    protected $fillable = ['user_id', 'game_name', 'result', 'amount'];
    public function ranking()
    {
        $ranking = GameHistory::select('user_id')
            ->selectRaw('SUM(amount) as total')
            ->where('result', 'win')
            ->groupBy('user_id')
            ->orderByDesc('total')
            ->take(10)
            ->with('user')
            ->get();

        return view('games.ranking', compact('ranking'));
    }

}
