<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Mailers\AppMailer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TicketsController extends Controller
{
    

    public function create()
    {
    
        return view('tickets.create');
    }


    public function store(Request $request, AppMailer $mailer)
    {
        $this->validate($request, [
            'cus_name'  => 'required',
            'phone'     => 'required',
            'email'     => 'required',
            'message'   => 'required'
            ]);

            $ticket = new Ticket([
                'cus_name'     => $request->input('cus_name'),
                'email'     => $request->input('email'),
                'phone'     => $request->input('phone'),
                'user_id'   => Auth::user()->id,
                'ticket_id' => rand(2,5000),
                'message'   => $request->input('message'),
                'status'    => "Open",
            ]);

            $ticket->save();

            // $mailer->sendTicketInformation(Auth::user(), $ticket);

            return redirect()->back()->with("status", "A ticket with ID: #$ticket->ticket_id has been opened.");
    }


    public function userTickets()
    {
        $tickets = Ticket::where('user_id', Auth::user()->id)->paginate(10);

        return view('tickets.user_tickets', compact('tickets'));
    }



    public function show($ticket_id)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();

        $comments = $ticket->comments;

        return view('tickets.show', compact('ticket'));
    }
    function search(Request $request){

       
        if( isset($_GET['query']) && strlen($_GET['query']) > 1){

            $search_text = $_GET['query'];
            $tickets = DB::table('tickets')->where('cus_name','LIKE','%'.$search_text.'%')->paginate(2);
            return view('tickets.user_tickets',['tickets'=>$tickets]);
            
        }else{
             return view('search');
        }
        return view('search');
    }

}


