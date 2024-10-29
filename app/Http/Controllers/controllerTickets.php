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
        return view("TICKETS.crearNuevoTicket");
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
            "estado" => $request->input("status"),
        ]);

        // Redirigir a la vista del dashboard con un mensaje de éxito
        return redirect()->route('dashboard')->with('success', 'Ticket creado exitosamente.');
    }


    public function show($id)
    {
        $agentes = User::all();
        $ticket = Ticket::findOrFail($id); // Busca el ticket por ID
        return view('ticket', compact('ticket', 'agentes')); // Pasa el ticket a la vista
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
    
        return redirect()->route('dashboard')->with('success', 'Usuario eliminado exitosamente.');
    }



    public function ticketid($id)
    {
        $ticket = Ticket::findOrFail($id);
    
        return view('TICKETS.ticket', compact('ticket'));
    }

}
