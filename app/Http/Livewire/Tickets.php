<?php

namespace App\Http\Livewire;

use App\Models\SupportTicket;
use Livewire\Component;

class Tickets extends Component
{
    //Instances
    public $active;
    protected $listeners = [
        'ticketSelected', //if emited comes here in specified listener and should have its function 
    ];


    //Methods
    public function ticketSelected($ticketId)
    {
        $this->active = $ticketId;
    }

    public function render()
    {
        return view('livewire.tickets', [

            'tickets' => SupportTicket::all(),
        ]);
    }
}
