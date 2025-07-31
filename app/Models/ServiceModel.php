<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'icon',
        'title',
        'slug',
        'short_description',
        'long_description',
        'image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'created_at'
    ];
}
