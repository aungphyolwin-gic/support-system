<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Label;
use App\Models\Category;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return "hello";
        $authorize_uid = Auth::user()->id;
        if(Auth::user()->role == 2 ){
            $tickets = Ticket::all();
        }
        else if(Auth::user()->role == 1){
            $tickets = Ticket::where('user_id',$authorize_uid )->orWhere('assigned_id',$authorize_uid)->get();
        }
        else{
            $tickets = Ticket::where('user_id',$authorize_uid)->get();
        }

        return view('ticket.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $labels = Label::all();
        $categories = Category::all();
        return view('ticket.create', compact(['labels','categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request)
    {
        // return $request;
        $fileName = 'default';
        if($request->hasFile('file')){
            $file = $request->file;
            $fileName = 'report_'.uniqid().'.'.$file->extension();
            // return $fileName;
            $file->storeAs('public/upload_file',$fileName);
        }

        $ticket = new Ticket();
        $ticket->title = $request->title;
        $ticket->message = $request->message;
        $ticket->label_id = $request->label_id;
        $ticket->category_id = $request->category_id;
        $ticket->user_id = Auth::user()->id;
        $ticket->priority = $request->priority;
        $ticket->file = $fileName;
        // return $ticket;
        $ticket->save();

        return redirect()->route('ticket.index')->with("create","Ticket created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        $comments = $ticket->comment;
        // return $comments;
        return view('ticket.show', compact(['ticket','comments']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        // return $ticket;
        $labels = Label::all();
        $categories = Category::all();
        $agents = User::where('role','1')->get();
        return view('ticket.edit',compact(['ticket','labels','categories','agents']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTicketRequest  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        // return $request;
        $fileName = $ticket->file;
        if($request->hasFile('file')){
            if(Storage::exists('public/upload_file/'.$ticket->file)){
                Storage::delete('public/upload_file/'.$ticket->file);
            }
            $file = $request->file;
            $fileName = 'report_'.uniqid().'.'.$file->extension();
            // return $fileName;
            $file->storeAs('public/upload_file',$fileName);
        }
        $ticket->title = $request->title;
        $ticket->message = $request->message;
        $ticket->label_id = $request->label_id;
        $ticket->category_id = $request->category_id;
        $ticket->priority = $request->priority;
        $ticket->status = $request->status;
        $ticket->assigned_id = $request->assigned_id;
        $ticket->file =$fileName;
        $ticket->update();
        return redirect()->route('ticket.index')->with("update","Ticket data updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        if($ticket->file){
            // return "hello delete";
            // dd( 'public/upload_file/ '.$ticket->file);
            if(Storage::exists('public/upload_file/'.$ticket->file)){
                Storage::delete('public/upload_file/'.$ticket->file);
            }

            $ticket->delete();
            return redirect()->route('ticket.index')->with("delete","Ticket deleted successfully.");
        }
        return "there";
        return redirect()->route('ticket.index')->with("delete","Ticket delete failed.");
    }
}
