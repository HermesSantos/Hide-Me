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

    function vinculateUser(Request $request)
    {
        $data = $request->all();
        DB::table('user_events')
            ->insert([
                'user_id' => Auth::id(),
                'event_id' => $data['event_id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
    }

    function getOwnerEvents()
    {
        $events = DB::table('events')
            ->where('user_id', Auth::id())
            ->get();
        return response()->json($events, 200);
    }
}
