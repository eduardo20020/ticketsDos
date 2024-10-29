<?php

namespace App\Services;
use PhpImap\Mailbox;
use Exception;
use App\Models\Ticket;


class ServiceGetCorreos
{
    protected $mailbox;

    public function __construct()
    {
        $email = getenv('MAIL_USERNAME'); // Asegúrate de tener las variables de entorno configuradas
        $password = getenv('MAIL_PASSWORD');
        $imapPath = '{imap.gmail.com:993/imap/ssl}INBOX';
        $attachmentsDir = __DIR__ . '/attachments';

        // Verifica si el directorio existe, si no lo crea
        if (!is_dir($attachmentsDir)) {
            mkdir($attachmentsDir, 0777, true); // Crea el directorio con permisos adecuados
        }

        try {
            $this->mailbox = new Mailbox($imapPath, $email, $password, $attachmentsDir);
        } catch (Exception $e) {
            throw new Exception('Error al conectar al correo: ' . $e->getMessage());
        }
    }


    public function getUnreadEmails()
    {
        // Obtiene los correos no leídos
        $mailsIds = $this->mailbox->searchMailbox('UNSEEN');
        $unreadEmails = [];

        if (!$mailsIds) {
            return $unreadEmails; // No hay correos no leídos
        }



        foreach ($mailsIds as $mailId) {
            $email = $this->mailbox->getMail($mailId);
            $unreadEmails[] = [
                'subject' => $email->subject,
                'from' => $email->fromAddress,
                'date' => $email->date,
                'body' => $email->textPlain,
            ];
        }



        // Iterar sobre cada correo no leído
        foreach ($unreadEmails as $email) {
            Ticket::create([
                'correo' => $email['from'], // Asumiendo que 'from' contiene el correo del remitente
                'asunto' => $email['subject'], // Asumiendo que 'subject' contiene el asunto del correo
                'mensaje' => $email['body'], // Asumiendo que 'body' contiene el contenido del correo
                'estado' => 'abierto',
                // 'agent_id' se puede dejar como nulo
            ]);
        }


        return $unreadEmails;
    }
}