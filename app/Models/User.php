<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Use your table
    protected $table = 'etudiant';
    protected $primaryKey = 'id_etudiant';
    public $timestamps = false; // Set to true if you have created_at/updated_at

    // Set the fillable or guarded fields as needed
    protected $fillable = [
        'email_etu', 'password_etu', // add other fields as needed
    ];

    // Set the authentication password field
    public function getAuthPassword()
    {
        return $this->password_etu;
    }

    // Set the email field for authentication
    public function getAuthIdentifierName()
    {
        return 'email_etu';
    }
}
