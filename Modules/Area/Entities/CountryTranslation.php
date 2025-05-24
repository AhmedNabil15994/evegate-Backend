<?php

namespace Modules\Area\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\ClearsResponseCache;

class CountryTranslation extends Model
{
    use ClearsResponseCache;
    protected $fillable = [ 'title' , 'slug' ];
}
