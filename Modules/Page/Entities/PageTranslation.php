<?php

namespace Modules\Page\Entities;

use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model
{
    protected $fillable = ['description' , 'title' , 'slug' , 'seo_description' , 'seo_keywords' , 'page_id'];
}
