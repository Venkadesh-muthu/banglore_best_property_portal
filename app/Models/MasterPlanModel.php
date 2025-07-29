<?php
namespace App\Models;

use CodeIgniter\Model;

class MasterPlanModel extends Model
{
    protected $table = 'master_plan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['property_id', 'master_plan_image', 'created_at'];
    public $useTimestamps = false;

    /**
     * Join master_plan with properties and return property data with master plan image
     */
    public function getAllWithMasterPlan()
    {
        return $this->select('properties.*, master_plan.master_plan_image as master_plan_image')
            ->join('properties', 'properties.id = master_plan.property_id', 'left')
            ->groupBy('properties.id');
    }
}
