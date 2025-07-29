<?php

namespace App\Models;

use CodeIgniter\Model;

class LegalApprovalModel extends Model
{
    protected $table = 'legal_approvals';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'property_id',
        'title',
        'approved_by',
        'status',
        'document_file',
        'created_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = ''; // Not tracking updates for now
}
