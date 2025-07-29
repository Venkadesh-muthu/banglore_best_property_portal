<?php

namespace App\Models;

use CodeIgniter\Model;

class DeveloperModel extends Model
{
    protected $table = 'developers';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'property_id',
        'name',
        'established_year',
        'completed_projects',
        'description',
        'image',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;             // Enable automatic timestamps
    protected $createdField = 'created_at';     // DB column for created time
    protected $updatedField = 'updated_at';     // DB column for updated time
}
