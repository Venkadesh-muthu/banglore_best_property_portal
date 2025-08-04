<?php

namespace App\Models;

use CodeIgniter\Model;

class ResourceModel extends Model
{
    protected $table      = 'resources';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'title', 'slug', 'category', 'image', 'short_description', 'description',
        'meta_title', 'meta_description', 'meta_keywords',
        'tags', 'is_featured', 'is_new', 'read_time',
        'publish_date', 'status', 'author_name'
    ];
}
