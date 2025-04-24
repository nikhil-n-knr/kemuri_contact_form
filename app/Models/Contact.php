<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'contacts';

    protected $fillable = [
        'id',
        'name',
        'email',
        'subject',
        'message',
        'purpose',
        'short_description',
        'contacting_from',
        'company_name',
    ];
    

    public $incrementing = false; // Disable auto-increment
    protected $keyType = 'string'; // Use string for UUID
}