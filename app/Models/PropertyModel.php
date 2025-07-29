<?php
namespace App\Models;
use CodeIgniter\Model;

class PropertyModel extends Model
{
    protected $table = 'properties';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'location',
        'start_price',
        'end_price',
        'property_type',
        'property_type_detail',
        'possession_date',

        //Review fields
        'land_area',
        'avg_land_area',
        'clubhouse_area',
        'avg_clubhouse_area',
        'park_area',
        'avg_park_area',
        'open_area',
        'avg_open_area',
        'units',
        'avg_units',
        'price_per_sqft',
        'avg_price_per_sqft',
        'clubhouse_factor',
        'avg_clubhouse_factor',
        'metro_distance',
        'avg_metro_distance',
        'road_width',
        'avg_road_width',
        'unit_density',
        'avg_unit_density',

        'created_at',
        'updated_at'
    ];

}

?>