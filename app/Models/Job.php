<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employer;

class Job extends Model
{
    protected $table = 'jobs';
    protected $primaryKey = 'JobID';
    public $timestamps = false;

    public function employer()
    {
        return $this->belongsTo(Employer::class, 'EmployerID', 'EmployerID');
    }
}
