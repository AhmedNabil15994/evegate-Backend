<?php

namespace Modules\QSale\Entities;

use Modules\User\Entities\User;
use Modules\Core\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use UsesUuid;
    protected $guarded = ['id'];

    protected $casts = [
        'owner' => 'array',
        "transaction"    => "array"
    ];

    public function order()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
