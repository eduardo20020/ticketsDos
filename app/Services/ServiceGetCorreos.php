<?php

namespace App\Services;

use PhpImap\Mailbox;
use Exception;
use App\Models\Ticket;
use Illuminate\Support\Facades\Storage;

class ServiceGetCorreos
{
    protected $mailbox;

    public function __construct()
    {
        //$email = getenv('MAIL_USERNAME'); // Asegúrate de tener las variables de entorno configuradas
        //$password = getenv('MAIL_PASSWORD');
        $imapPath = '{outlook.office365.com:993/imap/ssl}INBOX';
        $attachmentsDir = __DIR__ . '/attachments';

        // Verifica si el directorio existe, si no lo crea
        if (!is_dir($attachmentsDir)) {
            mkdir($attachmentsDir, 0777, true); // Crea el directorio con permisos adecuados
        }

        try {
            $this->mailbox = new Mailbox($imapPath, 'noreply@grupodyasa.com', 'brfvhzqgcwzcdtxx', $attachmentsDir);
        } catch (Exception $e) {
            throw new Exception('Error al conectar al correo: ' . $e->getMessage());
        }
    }


    public function getUnreadEmails()
    {
        $mailsIds = $this->mailbox->searchMailbox('UNSEEN');
        $unreadEmails = [];

        if (!$mailsIds) {
            return $unreadEmails;
        }

        foreach ($mailsIds as $mailId) {
            $email = $this->mailbox->getMail($mailId);

            // Guarda el correo en la base de datos
            $ticket = Ticket::create([
                'correo' => $email->fromAddress,
                'asunto' => $email->subject,
                'mensaje' => $email->textPlain,
                'estado' => 'abierto',
            ]);

            foreach ($email->getAttachments() as $attachment) {
                if (strpos($attachment->mime, 'image') !== false) {
                    // Definimos la ruta en la carpeta 'attachments' dentro de 'public'
                    $filePath = 'attachments/' . $attachment->name;

                    // Guardamos el archivo en el disco 'public' para que esté accesible públicamente
                    Storage::disk('public')->put($filePath, $attachment->getContents());

                    // Guardamos la información en la base de datos
                    $ticket->attachments()->create([
                        'path' => $filePath,
                        'name' => $attachment->name,
                    ]);
                }
            }



            $unreadEmails[] = [
                'subject' => $email->subject,
                'from' => $email->fromAddress,
                'date' => $email->date,
                'body' => $email->textPlain,
            ];
        }

        return $unreadEmails;
    }
}
