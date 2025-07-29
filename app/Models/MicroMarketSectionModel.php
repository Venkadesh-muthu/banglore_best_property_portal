<?php
namespace App\Models;

use CodeIgniter\Model;

class MicroMarketSectionModel extends Model
{
    protected $table = 'micro_market_sections';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'property_id',
        'section_title',
        'section_image',
        'section_description',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}

?>