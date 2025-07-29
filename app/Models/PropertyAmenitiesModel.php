<?php
namespace App\Models;

use CodeIgniter\Model;

class PropertyAmenitiesModel extends Model
{
    protected $table = 'property_amenities';
    protected $primaryKey = 'id';
    protected $allowedFields = ['property_id', 'amenities_json', 'created_at', 'updated_at'];
    public $useTimestamps = true;
}

?>