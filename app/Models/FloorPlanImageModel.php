<?php

namespace App\Models;

use CodeIgniter\Model;

class FloorPlanImageModel extends Model
{
    protected $table = 'floor_plan_images';
    protected $primaryKey = 'id';

    protected $allowedFields = ['floor_plan_id', 'image'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
}
