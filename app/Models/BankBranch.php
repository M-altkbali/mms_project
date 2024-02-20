<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankBranch extends Model
{
    use HasFactory;

    protected $fillable = [
        'BranchName'
    ];

    public function Employee()
    {
        return $this->belongsTo('App\Models\Employee');
    }
}
