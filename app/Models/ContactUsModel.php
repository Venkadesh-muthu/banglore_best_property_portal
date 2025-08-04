<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactUsModel extends Model
{
    protected $table      = 'contact_us';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'location',
        'open_days',
        'open_hours',
        'email',
        'phone',
        'created_at'
    ];
}
