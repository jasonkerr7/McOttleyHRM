<?php

namespace McPersona\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeDependent extends Model
{
    protected $table = 'employee_dependent';
	public $timestamps = false;
	protected $dates = ['dob'];
}
