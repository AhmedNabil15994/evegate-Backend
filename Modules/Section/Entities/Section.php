<?php

namespace Modules\Section\Entities;

use Modules\Core\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Modules\Core\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Section\Entities\SectionTranslation;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Section extends Model implements TranslatableContract
{
  	use Translatable , SoftDeletes , ScopesTrait, ClearsResponseCache;

    protected $with               = [ 'translations' ];
  	protected $fillable 		  = [ 'status' , 'color', "image"];
  	public $translatedAttributes  = [ 'description' , 'title' , 'slug'];
    public $translationModel 	  = SectionTranslation::class;

    


    public function scopeExcludeBase($query)
		{
//				return $query->WhereNotIn('id',[1,2,3,4]);
                return $query;
		}



}
