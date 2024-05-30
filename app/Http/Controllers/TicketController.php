<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Train;
use App\Models\Track;
use App\Models\Price;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->authorize('isAdmin');

        // if (Gate::allows('isAdmin')) {
        return view('dashboard.ticket.index', [
            'tickets' => Ticket::all()->load('price'),
            'trains' => Train::all(),
            'tracks' => Track::all()
        ]);
        // } else {
        //     // akses logic untuk user selain role admin
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.dashboard.ticket.index', [
        //     'trains' => Train::all(),
        //     'tracks' => Track::all()
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'train_id' => ['required'],
            'track_id' => ['required'],
            'price' => ['required'],
            'departure_time' => ['required'],
        ]);
    
        try {
            // Retrieve travel_time from Track model
            $track = Track::findOrFail($validatedData['track_id']);
            $travelTime = $track->travel_time;
    
            // Parse travel_time to hours, minutes, and seconds
            list($hours, $minutes, $seconds) = explode(':', $travelTime);
    
            // Calculate arrival_time
            $departureTime = new \DateTime($validatedData['departure_time']);
            $arrivalTime = clone $departureTime;
            $arrivalTime->add(new \DateInterval("PT{$hours}H{$minutes}M{$seconds}S"));
    
            $validatedData['arrival_time'] = $arrivalTime->format('H:i:s');
    
            // Check if there's a ticket with the same details
            $validateSameTicket = Ticket::where('train_id', $validatedData['train_id'])
                                        ->where('track_id', $validatedData['track_id'])
                                        ->where('departure_time', $validatedData['departure_time'])
                                        ->first();
    
            if ($validateSameTicket) {
                return redirect('/tickets')->with('sameTicket', 'Ticket dengan data tersebut sudah ada di database! jika ingin mengubah harga, masuk ke bagian harga!')->withInput();
            }
    
            // Create ticket
            $ticket = Ticket::create($validatedData);
    
            // Create price for the ticket
            Price::create([
                'ticket_id' => $ticket->id,
                'price' => $validatedData['price']
            ]);
    
            return redirect('/tickets')->with('success', 'Tiket berhasil ditambahkan');
        } catch (\Exception $e) {
            // Handle the exception and log the error
            Log::error('Error creating ticket: ' . $e->getMessage());
            return redirect('/tickets')->with('error', 'Error calculating arrival time. Please check your inputs.');
        }
    }
    
        

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->destroy($ticket->id);
        return redirect('/tickets')->with('delete', "Tiket berhasil dihapus!");
    }
}
