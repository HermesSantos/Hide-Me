<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserEventController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }
    function createEvent(Request $request)
    {
        try {
            $data = $request->all();
            $event_created = DB::table('events')
                ->insert([
                    'name' => $data['event_name'],
                    'date_event' => Carbon::now(),
                    'user_id' => Auth::id(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            if ($event_created) {
                return response()->json(['message' => 'Evento Criado Com Sucesso!'], 201);
            }
        } catch (\Throwable $th) {
            return response()->json(
                ['error' => $th->getMessage()]
            );
        }
    }
}
