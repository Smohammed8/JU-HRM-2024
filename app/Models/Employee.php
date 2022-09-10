<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'father_name',
        'grand_father_name',
        'gender',
        'date_of_birth',
        'photo',
        'birth_city',
        'passport',
        'driving_licence',
        'blood_group',
        'eye_color',
        'phone_number',
        'alternate_email',
        'rfid',
        'employment_identity',
        'marital_status_id',
        'ethnicity_id',
        'religion_id',
        'unit_id',
        'employement_date',
        'salary_step',
        'job_title_id',
        'employment_type_id',
        'pention_number',
        'employment_status_id',
        'static_salary',
        'uas_user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'date_of_birth' => 'date',
        'photo' => 'integer',
        'driving_licence' => 'integer',
        'marital_status_id' => 'integer',
        'ethnicity_id' => 'integer',
        'religion_id' => 'integer',
        'unit_id' => 'integer',
        'employement_date' => 'date',
        'job_title_id' => 'integer',
        'employment_type_id' => 'integer',
        'employment_status_id' => 'integer',
    ];

    public function photo()
    {
        return $this->belongsTo(UploadFile::class);
    }

    public function drivingLicence()
    {
        return $this->belongsTo(UploadFile::class);
    }

    public function maritalStatus()
    {
        return $this->belongsTo(MaritalStatus::class);
    }

    public function ethnicity()
    {
        return $this->belongsTo(Ethnicity::class);
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function jobTitle()
    {
        return $this->belongsTo(JobTitle::class);
    }

    public function employmentType()
    {
        return $this->belongsTo(EmploymentType::class);
    }

    public function employmentStatus()
    {
        return $this->belongsTo(EmploymentStatus::class);
    }
}
