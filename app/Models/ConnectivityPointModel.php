<?php
namespace App\Models;
use CodeIgniter\Model;

class ConnectivityPointModel extends Model
{
    protected $table = 'property_connectivity_points';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'property_id',
        'name',
        'distance',
        'travel_time',
        'category',
        'lat',
        'lng'
    ];
}
