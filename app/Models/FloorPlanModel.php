<?php

namespace App\Models;

use CodeIgniter\Model;

class FloorPlanModel extends Model
{
    protected $table = 'floor_plans';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'property_id',
        'bhk_type',
        'price',
        'saleable_area',
        'entrance_direction',
        'carpet_area',
        'efficiency',
        'floor_height',
        'bathroom_count',
        'balcony_count'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
}
