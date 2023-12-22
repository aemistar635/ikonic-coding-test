<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use App\Models\Request as R;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $requests = \App\Models\Request::where('user_sender_id',Auth::id())->pluck('user_receiver_id')->toArray();
        $connections = Connection::where('user_id',Auth::id())->pluck('user_id')->toArray();
        $data['users'] = User::where('id','!=', Auth::id())->whereNotIn('id',$requests)->whereNotIn('id',$connections)->get();

        return view('home')->with('data',$data);

    }
    public function getSendRequestData()
    {
        $requests = \App\Models\Request::where('user_sender_id',Auth::id())->pluck('user_receiver_id')->toArray();
        $connections = Connection::where('user_id',Auth::id())->pluck('user_id')->toArray();
        $data['users'] = User::where('id','!=', Auth::id())->whereIn('id',$requests)->get();
        return  view('send_request')->with('data',$data);
    }

    public function getReceivedRequestData()
    {

        $data['requests'] = \App\Models\Request::leftJoin('users as sender', 'requests.user_sender_id', '=', 'sender.id')
    ->where('user_receiver_id', '=', Auth::id())
    ->where('status','=','pending')
    ->select(
        'requests.id as request_id',
        'requests.user_sender_id',
        'requests.user_receiver_id',
        'sender.name as receiver_name',
        'sender.email as receiver_email'
       
    )
    ->get();
        
    // dd($data['requests']);
        return  view('received_request')->with('data',$data);
    }

    public function getConnectionData()
    {
        $data['requests'] = \App\Models\Connection::with(['users'])->get();
        // $data['requests'] = \App\Models\Connection::with(['users'=>function($q){
        //     $q->where('id','=',Auth::id());
        // }])->get();
        return  view('connection')->with('data',$data);
    }
    public function sendRequest($id){
       $request1 = new R();
       $request1->user_sender_id = Auth::id();
       $request1->user_receiver_id = $id;
       $request1->save();
       return back();
    }

    public function withdarwRequest($id){
        $request =  \App\Models\Request::where('user_receiver_id',$id)->where('user_sender_id',Auth::id())->delete();
       return back();
    }
    public function acceptRequest($id){
        // dd($id) ; return ;
        $request = \App\Models\Request::find($id);
        $connection = new Connection();
        $connection->user_id = Auth::id();
        $connection->request_id = (int)$id;
        $connection->friend_id = $request->user_sender_id;
        $connection->save();
        $request =  \App\Models\Request::where('id',(int)$id)->update(['status'=>'accepted']);
        return back();
    }

    public function removeConnection($id){
        $connection = \App\Models\Connection::find($id);
        \App\Models\Request::where('id',$connection->friend_id)->delete();
        \App\Models\Connection::where('id',$id)->delete();
        return back();
    }
}
