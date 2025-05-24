<?php

namespace Modules\User\Entities;

use Modules\Area\Entities\{Country, City, State};
use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Modules\Core\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Company extends Model
{
    use  ClearsResponseCache;

    protected $guarded = ["id"];

    protected $casts = [
        'socials' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }



    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            Category::class,
            "company_categories",
            "company_id",
            "category_id",
        )->withTimestamps();
    }
}
