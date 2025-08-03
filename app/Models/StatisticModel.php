<?php

namespace App\Models;

use CodeIgniter\Model;

class StatisticModel extends Model
{
    protected $table = 'statistics';
    protected $primaryKey = 'id';
    protected $allowedFields = ['number', 'caption', 'images', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
