<?php

namespace App\Models\Contact;

use Illuminate\Database\Eloquent\Model;

class Contactus extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = ['name', 'email', 'subject', 'read_or_not', 'message', 'ip_address', 'user_agent', 'referrer', 'country', 'city', 'send_email', 'agree', 'status'];
}
