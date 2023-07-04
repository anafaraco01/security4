<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foo extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Kazaam function
     */
    public function kazaam()
    {
        if ($this->wombat) {
            return $this->thud;
        } else {
            return $this->thud * 3.1415927;
        }
    }

    /**
     * Relationship function
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
