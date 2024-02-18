<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentAssignment extends Model
{
    use HasFactory;

    protected $fillable = ['assignment'];

    protected $table = 'departments_assignments';
    

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
