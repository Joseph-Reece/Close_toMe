<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Chat;
use App;
use Illuminate\Http\Request;

use App\Notifications\ReplyQuery;
use Illuminate\Support\Facades\Notification;

class ChatsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web,client');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        $id = $user->id;
        $chat = Chat::all();


        if ($user->hasRole('superadministrator|doctor|receptionist')) {
            $department = App\User::find($id)->doctor->department_id;
            // Get chats with no replies
            $noreply = Chat::where([
                ['Status', 'Pending'],
                ['department_id', $department]
            ])->get();

            $replied = Chat::where([
                ['Status', 'Replied'],
                ['department_id', $department]
            ])->get();
            return view('Chats.list')
                ->with('replied_chat', $replied)
                ->with('chat', $noreply);
        }

        if ($user->hasRole('patient')) {
            $chats = Chat::where([
                ['client_id', $user->id],
                ['Status', 'Pending']
            ])->get();

            $Replied_chats = Chat::where([
                ['client_id', $user->id],
                ['Status', 'Pending']
            ])->get();

            return view('Chats.list')
                ->with('chat', $chats)
                ->with('replied_chat', $Replied_chats);
            //  return $user->id;


        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $client = Auth::user()->id;
        $chats = Chat::where('client_id', $client)->get();
        $departments = App\department::all();
        return view('Chats.add-query')
            ->with('department', $departments)
            ->with('chat', $chats);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [

            'department' => 'required',
            'query' => 'string|required'
        ]);


        $chat = new Chat;
        $chat->client_id = Auth::user()->id;
        $chat->department_id = $request->input('department');
        $chat->query = $request->input('query');


        $chat->save();

        Notification::send($request->user(), new ReplyQuery($chat));


        return redirect('/client')->with('success', 'Query Submitted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Chat $chat)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        //
        $user = Auth::user();
        if ($user->isA('patient')) {
            # code...
            if ($user->owns($chat)) {
                # code...
                $departments = App\department::all();
                return view('Chats.show')
                    ->with('departments', $departments)
                    ->with('chat', $chat);
            }
        }
        if ($user->isA('doctor|superadministrator')) {
            # code...
            $departments = App\department::all();
            return view('Chats.show')
                ->with('departments', $departments)
                ->with('chat', $chat);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        //
        $user = Auth::user();
        if ($user->isA('doctor|superadministrator')) {
            # code...

            $response = $request->input('response');
                if ($request->has($response)) {
                $this->validate($request, [

                    'response' => 'string',
                ]);
                # code...
                $reply = $chat;
                $reply->response = $response;
                $reply->user_id = $user->id;
                $reply->Status = 'Replied';

                $reply->save();
                }else {
                # code...
                $dep = $chat;
                $dep->department_id = $request->input('department');
                $dep->save();
                }




            return redirect('/chat')->with('success', 'Query Updated Successfully');
        }

        if ($user->isA('patient')) {
            # code...
            $this->validate($request, [

                'department' => 'required',
                'query' => 'string|required'
            ]);


            $reply = $chat;
            $reply->department_id = $request->input('department');
            $reply->query = $request->input('query');

            $reply->save();

            return redirect('/client')->with('success', 'Query Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        //
    }
}
