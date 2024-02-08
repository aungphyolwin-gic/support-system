<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Label;
use App\Models\Category;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use Illuminate\Support\Facades\Storage;

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
        $tickets = Ticket::all();
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
        $ticket->priority = $request->priority;
        $ticket->file = $fileName;
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
        //
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
        return view('ticket.edit',compact(['ticket','labels','categories']));
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
