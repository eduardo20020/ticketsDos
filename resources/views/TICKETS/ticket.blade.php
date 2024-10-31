<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ticket #{{$ticket->id}}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="space-y-6">
                        <!-- Información General del Ticket -->
                        <div class="bg-gray-100 p-4 rounded-lg  m-6">
                            <span class="font-semibold text-lg">{{mb_strtoupper($ticket->asunto, 'UTF-8')}}</span> <br>
                            <span class="font-semibold">De:</span> {{$ticket->correo}}
                        </div>

                        <!-- Mensaje del Ticket -->
                        <div class="bg-gray-100 p-4 rounded-lg m-6">
                            <span class="font-semibold text-lg">Mensaje:</span>
                            <p>{{$ticket->mensaje}}</p>

                            <h6>Adjuntos:</h6>
                            @if ($ticket->attachments->isEmpty())
                            <p>No hay adjuntos.</p>
                            @else
                            <ul>
                                @foreach ($ticket->attachments as $attachment)
                                <img src="{{ asset('storage/' . $attachment->path) }}" alt="" class="w-full max-w-xs h-auto rounded-lg shadow-md my-6">
                                @endforeach
                            </ul>
                            @endif
                        </div>

                        <!-- Formulario de Gestión del Ticket -->
                        <form action="{{ route('actualizarTicket',$ticket->id) }}" method="POST">
                            @csrf

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                                <!-- Etiqueta -->
                                <div>
                                    <label class="font-semibold text-lg">Etiqueta:</label>
                                    <input type="text" name="etiqueta" class="w-full border-gray-300 rounded">
                                </div>

                                <div class="flex justify-between">
                                    <!-- Agente -->
                                    <div class="px-4">
                                        <label class="font-semibold text-lg">Agente:</label>
                                        <select name="agente" class="w-full border-gray-300 rounded">
                                            @if (isset($ticket->agente->name))
                                            <option value="{{ $ticket->agente->id }}">{{ $ticket->agente->name}}</option>
                                            @else
                                            <option value="">Seleccionar agente</option>
                                            @endif

                                            @foreach ($agentes as $agente)
                                            <option value="{{$agente->id}}">{{$agente->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Estado -->
                                    <div class="px-4">
                                        <label class="font-semibold text-lg">Estado:</label>
                                        <select name="estado" class="w-full border-gray-300 rounded">
                                            @if (isset($ticket->estado))
                                            <option value="{{ $ticket->estado }}">{{ $ticket->estado}}</option>
                                            @else
                                            <option value="">Seleccionar estado</option>
                                            @endif
                                            <option value="abierto">Abierto</option>
                                            <option value="cerrado">Cerrado</option>
                                        </select>
                                    </div>

                                    <!-- Tipo -->
                                    <div class="px-4">
                                        <label class="font-semibold text-lg">Tipo:</label>
                                        <select name="tipo" class="w-full border-gray-300 rounded">
                                            @if (isset($ticket->tipo))
                                            <option value="{{ $ticket->tipo }}">{{ $ticket->tipo }}</option>
                                            @else
                                            <option value="">Seleccionar tipo</option>
                                            @endif
                                            <option value="requerimiento">Requerimiento</option>
                                            <option value="incidente">Incidente</option>
                                        </select>
                                    </div>

                                    <!-- Prioridad -->
                                    <div class="px-4">
                                        <label class="font-semibold text-lg">Prioridad:</label>
                                        <select name="prioridad" class="w-full border-gray-300 rounded">
                                            @if (isset($ticket->prioridad))
                                            <option value="{{ $ticket->prioridad }}">{{ $ticket->prioridad }}</option>
                                            @else
                                            <option value="">Prioridad</option>
                                            @endif
                                            <option value="baja">Baja</option>
                                            <option value="media">Media</option>
                                            <option value="alta">Alta</option>
                                            <option value="urgente">Urgente</option>
                                        </select>
                                    </div>

                                    <!-- Grupo -->
                                    <div class="px-4">
                                        <label class="font-semibold text-lg">Grupo:</label>
                                        <select name="grupo" class="w-full border-gray-300 rounded">
                                            @if (isset($ticket->grupo))
                                            <option value="{{ $ticket->grupo }}">{{ $ticket->grupo }}</option>
                                            @else
                                            <option value="">Seleccionar grupo</option>
                                            @endif
                                            <option value="cadereyta">Cadereyta</option>
                                            <option value="garcia">Garcia</option>
                                            <option value="beta">Beta</option>
                                            <option value="pabellon">Pabellon</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Nota -->
                                <div class="col-span-1 sm:col-span-2 lg:col-span-3">
                                    <label class="font-semibold text-lg">Nota:</label>
                                    <textarea name="nota" class="w-full border-gray-300 rounded"></textarea>
                                </div>
                            </div>

                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition ease-in-out duration-150">Actualizar</button>
                        </form>


                        <!-- Botón Eliminar -->
                        <form action="{{ route('delTicket', $ticket->id) }}" method="POST"
                            onsubmit="return confirm('¿Estás seguro de que deseas eliminar este ticket?');" class="mt-6">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 text-white font-bold py-2 px-4 rounded hover:bg-red-600">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>