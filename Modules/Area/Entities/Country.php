<?php

namespace Modules\Area\Entities;

use Modules\Core\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Modules\Core\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Country extends Model implements TranslatableContract
{
  	use Translatable , SoftDeletes , ScopesTrait;
	use ClearsResponseCache;
    protected $with 					    = ['translations'];
  	protected $fillable 					= ['status'];
  	public $translatedAttributes 	= [ 'title' , 'slug' ];
    public $translationModel 			= CountryTranslation::class;

	public function cities()
    {
        return $this->hasMany(City::class);
    }

}
