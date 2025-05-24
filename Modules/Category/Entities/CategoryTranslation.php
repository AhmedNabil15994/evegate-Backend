<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    protected $fillable = [ 'title' , 'slug' , 'seo_description' , 'seo_keywords'];
}
