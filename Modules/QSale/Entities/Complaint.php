<?php

namespace Modules\QSale\Entities;

use Modules\User\Entities\User;
use Modules\Core\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use UsesUuid;
    protected $guarded = ["id"];

    public function ads()
    {
        return $this->belongsTo(Ads::class, "ads_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
