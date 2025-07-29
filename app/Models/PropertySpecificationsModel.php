<?php
namespace App\Models;

use CodeIgniter\Model;

class PropertySpecificationsModel extends Model
{
    protected $table = 'property_specifications';
    protected $primaryKey = 'id';
    protected $allowedFields = ['property_id', 'specifications_json', 'created_at', 'updated_at'];
    public $useTimestamps = true;
}

?>