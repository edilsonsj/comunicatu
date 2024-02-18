<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
    ];

    protected $table = 'departments';

    public function assignments()
    {
        return $this->hasMany(DepartmentAssignment::class, 'department_id');
    }
}
