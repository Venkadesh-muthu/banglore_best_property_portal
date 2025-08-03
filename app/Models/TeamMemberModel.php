<?php

namespace App\Models;

use CodeIgniter\Model;

class TeamMemberModel extends Model
{
    protected $table = 'team_members';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'designation', 'bio', 'photo', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
