<?php

namespace Modules\Attribute\Entities;

use Modules\Core\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Modules\Core\Traits\CasscadeAttach;
use Spatie\Translatable\HasTranslations;
use Modules\Core\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use HasTranslations,
        ScopesTrait    ,
        CasscadeAttach,
        ClearsResponseCache,
        
        SoftDeletes    ;

    public $translatable = ['name'];
    protected $guarded 				    	= ['id'];
    
    protected $casts = [
        'validation' => 'array',
       
    ];


    public $casscadeAttachs = ["icon"];

    public function options()
    {
        return $this->hasMany(Option::class, "attribute_id");
    }
    public function optionsAllow()
    {
        return $this->options()->where("status", 1);
    }

    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'category_attributes',
            "attribute_id",
            'category_id',    
        )
        ->withTimestamps();
    }

    public function scopeShowInSearch($query){
        $query->where("show_in_search", 1);
    }
}
