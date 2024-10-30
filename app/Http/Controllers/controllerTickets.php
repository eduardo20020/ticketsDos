<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;

use Illuminate\Http\Request;

class controllerTickets extends Controller
{
    //
    public function index()
    {
        return view("dashboard");
    }

    public function vistaCrearTicket()
    {
        $usuarios = User::all();
        return view("TICKETS.crearNuevoTicket", compact("usuarios"));
    }


    public function CrearTicket(Request $request)
    {
        // Validar los datos entrantes


        // Crear el ticket
        Ticket::create([
            "correo" => $request->input("email"),
            "asunto" => $request->input("subject"),
            "mensaje" => $request->input("message"),
            "id_agente" => $request->input("agent"),
            "estado" => $request->input("estado"),


            "etiqueta" => $request->input("etiqueta"),
            "tipo" => $request->input("tipo"),
            "prioridad" => $request->input("prioridad"),
            "grupo" => $request->input("grupo"),

        ]);

        // Redirigir a la vista del dashboard con un mensaje de éxito
        return redirect()->route('dashboard')->with('success', 'Ticket creado exitosamente.');
    }


    public function show($id)
    {
        $agentes = User::all();
        $ticket = Ticket::findOrFail($id); // Busca el ticket por ID
        return view('TICKETS.ticket', compact('ticket', 'agentes')); // Pasa el ticket a la vista
    }




    public function actualizarTicket(Request $request, $id)
    {
        $agentes = User::all();
        // Validar los datos del formulario


        // Buscar el ticket por su ID
        $ticket = Ticket::findOrFail($id);

        // Actualizar los campos del ticket con los datos del formulario
        $ticket->etiqueta = $request->input('etiqueta');
        $ticket->id_agente = $request->input('agente');
        $ticket->estado = $request->input('estado');
        $ticket->tipo = $request->input('tipo');
        $ticket->prioridad = $request->input('prioridad');
        $ticket->grupo = $request->input('grupo');
        $ticket->nota = $request->input('nota');

        // Guardar los cambios en la base de datos
        $ticket->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('ticket', $id)->with('success', 'Ticket actualizado exitosamente.');
    }





    public function destroy($id)
    {

        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->route('dashboard')->with('success', 'Usuario eliminado exitosamente.');
    }











    public function getFiltros(Request $request)
    {
        $query = Ticket::query();

        if ($request->filled('fecha')) {
            switch ($request->fecha) {
                case 'hoy':
                    $query->whereDate('created_at', today());
                    break;
                case 'ayer':
                    $query->whereDate('created_at', today()->subDay());
                    break;
                case 'hace_7_dias':
                    $query->whereDate('created_at', '>=', today()->subDays(7));
                    break;
                case 'hace_30_dias':
                    $query->whereDate('created_at', '>=', today()->subDays(30));
                    break;
            }
        }
        // Aplica el filtro por Estado si está presente
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        // Aplica el filtro por Agente si está presente
        if ($request->filled('agente')) {
            $query->where('id_agente', $request->agente);
        }

        // Aplica el filtro por Grupo si está presente
        if ($request->filled('grupo')) {
            $query->where('grupo', $request->grupo);
        }

        // Ejecuta la consulta con todos los filtros combinados
        $tickets = $query->get();

        // Obtener la lista de agentes para el dropdown
        $agentes = User::orderBy('created_at', 'desc')->get();

        return view('TICKETS.ticketsFiltrados', compact('tickets', 'agentes'));
    }






    public function ticketid($id)
    {
        $ticket = Ticket::findOrFail($id);
        $agentes = User::all();

        return view('TICKETS.ticket', compact('ticket', 'agentes'));
    }
}
