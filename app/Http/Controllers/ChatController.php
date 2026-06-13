<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'module' => 'required|string',
            'role' => 'required|string',
            'message' => 'required|string',
        ]);

        DB::table('chat_messages')->insert([
            'user_id' => Auth::id(),
            'module' => $request->module,
            'role' => $request->role,
            'message' => $request->message,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true]);
    }

    public function history($module)
    {
        $messages = DB::table('chat_messages')
            ->where('user_id', Auth::id())
            ->where('module', $module)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }

    public function clear($module)
    {
        DB::table('chat_messages')
            ->where('user_id', Auth::id())
            ->where('module', $module)
            ->delete();

        return response()->json(['success' => true]);
    }
}
