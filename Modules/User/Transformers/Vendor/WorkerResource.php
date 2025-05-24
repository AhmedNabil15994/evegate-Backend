<?php

namespace Modules\User\Transformers\Vendor;

use  Illuminate\Http\Resources\Json\JsonResource;

class WorkerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
           'id'            => $this->id,
           'name'          => $this->name,
           'email'         => $this->email,
           'mobile'        => "0".$this->phone_code ."".$this->mobile,
           'image'         => url($this->image),
           "is_active"     => $this->is_active,
           "vendor_id"     => $this->workerProfile && $this->workerProfile->vendor ? $this->workerProfile->vendor->translateOrDefault(locale())->title : "---", 
           "branch_id"     => $this->workerProfile && $this->workerProfile->branch? $this->workerProfile->branch->translateOrDefault(locale())->title : "---", 
           'deleted_at'    => $this->deleted_at,
           'created_at'    => date('d-m-Y' , strtotime($this->created_at)),
       ];
    }
}
