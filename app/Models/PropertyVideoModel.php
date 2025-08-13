<?php

namespace App\Models;

use CodeIgniter\Model;

class PropertyVideoModel extends Model
{
    protected $table = 'property_videos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['property_id', 'video'];
    public $timestamps = false; // if no created_at/updated_at
}
