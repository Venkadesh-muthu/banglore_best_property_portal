<?php

namespace App\Models;

use CodeIgniter\Model;

class AboutModel extends Model
{
    protected $table = 'about_content';
    protected $primaryKey = 'id';
    protected $allowedFields = ['heading', 'paragraphs_left', 'paragraphs_right', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
