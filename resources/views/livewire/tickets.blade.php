<div>
    <h2 class="pb-3" style="font-weight:bold">Support Tickets</h3>

        @foreach ($tickets as $ticket)

            <div class="card mb-2 p-2">
                <div class="card-body">
                    <h6 class="card-text">{{ $ticket->question }}</h6>
                </div>

                <div class="row col-md-12">
                    <button class='btn ml-auto {{ $active == $ticket->id ? 'btn-success' : 'btn-primary' }}'
                        type="submit" wire:click="$emit('ticketSelected', {{ $ticket->id }})">
                        {{ $active == $ticket->id ? 'Selected' : 'View Comments' }}
                    </button>
                </div>
            </div>

        @endforeach
</div>
