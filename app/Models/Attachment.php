<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = ['ticket_id', 'path', 'name'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
