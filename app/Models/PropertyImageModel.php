<?php
namespace App\Models;

use CodeIgniter\Model;

class PropertyImageModel extends Model
{
    protected $table = 'property_images';
    protected $primaryKey = 'id';
    protected $allowedFields = ['property_id', 'image', 'created_at'];

    public function getAllWithImages()
    {
        return $this->select('properties.*, property_images.image as main_image')
            ->join('property_images', 'property_images.property_id = properties.id', 'left')
            ->groupBy('properties.id');
    }

}
?>