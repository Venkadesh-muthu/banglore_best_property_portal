<?php

namespace App\Models;

use CodeIgniter\Model;

class FeatureModel extends Model
{
    protected $table = 'features';
    protected $primaryKey = 'id';
    protected $allowedFields = ['icon', 'title', 'description', 'image', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
