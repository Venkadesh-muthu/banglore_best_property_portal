<?php
namespace App\Models;

use CodeIgniter\Model;

class MicroMarketDocumentModel extends Model
{
    protected $table = 'micro_market_documents';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'property_id',
        'title',
        'image',
        'description',
        'link_text',
        'link_url',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}

?>