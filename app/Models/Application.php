<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    public function job()        { return $this->belongsTo(Job::class,        'JobID',       'JobID'); }
public function jobSeeker()  { return $this->belongsTo(JobSeeker::class,  'SeekerID',    'SeekerID'); }
public function resume()     { return $this->belongsTo(Resume::class,     'ResumeID',    'ResumeID'); }

}

