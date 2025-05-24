<?php

namespace Modules\Advertisement\Entities;

use Modules\QSale\Entities\Ads;
use Modules\Core\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertisement extends Model
{
    use SoftDeletes, ScopesTrait;

    protected $fillable = ['image','link','status','start_at','end_at', "type", "info","ads_id"];
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'info' => "collection",
    ];

    public function ads(){
        $this->belongsTo(Ads::class, "ads_id");
    }
}
