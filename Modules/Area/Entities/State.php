<?php

namespace Modules\Area\Entities;

use Modules\Core\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Modules\Core\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class State extends Model implements TranslatableContract
{
    use Translatable , SoftDeletes , ScopesTrait;
    use ClearsResponseCache;

    protected $with 					    = ['translations'];
  	protected $fillable 					= ['status' , 'city_id'];
  	public $translatedAttributes 	= [ 'title' , 'slug' ];
    public $translationModel 			= StateTranslation::class;

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
