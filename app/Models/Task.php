<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status_id',
        'created_by_id',
        'assigned_to_id'
    ];

    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'created_by_id');
    // }
    public function created_by()
    {
        return $this->belongsTo(User::class);
    }
}
