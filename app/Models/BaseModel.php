<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\SetorScope;

class BaseModel extends Model
{
    protected $guarded = [];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new SetorScope);
    }
}
