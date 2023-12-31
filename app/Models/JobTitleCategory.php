<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LdapRecord\Models\Relations\HasMany;

class JobTitleCategory extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function jobTitleButtonView($crud = false)
    {
        if (!backpack_user()->canany(['job_title_category.job_title.index', 'job_title_category.job_title.icrud'])) {
            return null;
        }
        $route =  route('job-title-category/{job_title_category}/job-title.index', ['job_title_category' => $this->id]); // custome toute here
        return '<a class="btn btn-sm btn-link"  href="' . $route . '" data-toggle="tooltip" title="Print ID"><i class="la la-list"></i>Job Title </a>';
    }

    public function fieldOfStudyButtonView($crud = false)
    {

        if (!backpack_user()->canany(['job_title_category.field_of_study.index', 'job_title_category.field_of_study.icrud'])) {
            return null;
        }
        $route =  route('job-title-category/{job_title_category}/related-work.index', ['job_title_category' => $this->id]); // custome toute here
        return '<a class="btn btn-sm btn-link"  href="' . $route . '" data-toggle="tooltip" title="Print ID"><i class="la la-list"></i>Field of studies</a>';
    }

    /**
     * Get all of the fieldOfStudies for the JobTitleCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fieldOfStudies()
    {
        return $this->hasMany(RelatedWork::class, 'job_title_categorie_id', 'id');
    }
}
