<?php

namespace Modules\User\Entities;

use Modules\OnDiet\Entities\Branch;
use Modules\OnDiet\Entities\Vendor;
use Illuminate\Database\Eloquent\Model;

class WorkerProfile extends Model
{
    protected $guarded 				    	= ['id'];

    public function vendor()
    {
       return $this->belongsTo(Vendor::class, "vendor_id");
    }

    public function branch()
    {
       return $this->belongsTo(Branch::class, "branch_id");
    }
}
