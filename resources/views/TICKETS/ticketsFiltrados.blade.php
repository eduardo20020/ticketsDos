<x-app-layout>

    @include('layouts.filtro')

    @foreach ($tickets as $ticket)
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex items-center justify-between item">
                    <div class="container">
                        <a href="{{route('ticketid', $ticket->id)}}">
                            <span class="font-semibold text-lg">{{strtoupper($ticket->asunto)}}</span> #{{$ticket->id}}
                            <p>{{$ticket->correo}}</p><br>
                            <p>Creación: {{$ticket->created_at}}</p>
                        </a>
                    </div>
                    <form action="{{ route('delTicket', $ticket->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este ticket?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 font-bold py-2 px-4 rounded hover:bg-red-600">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</x-app-layout>