<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory;
    use SoftDeletes;
    // protected $dates = ['deleted_at'];
    protected $guarded = [];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function invoicesAttachment()
    {
        return $this->hasOne(invoicesAttachment::class);
    }

    public function invoicesDetails()
    {
        return $this->hasOne(invoicesDetail::class);
    }
}
