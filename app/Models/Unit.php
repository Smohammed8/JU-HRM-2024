<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
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
        'acronym',
        'email',
        'telephone',
        'extension_line',
        'location',
        'seal',
        'teter',
        'vision',
        'mission',
        'objective',
        'building_number',
        'office_number',
        'motto',
        'value_list',
        'parent_unit_id',
        'reports_to_id',
        'organization_id',
        'chair_man_type_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'seal' => 'integer',
        'teter' => 'integer',
        'parent_unit_id' => 'integer',
        'reports_to_id' => 'integer',
        'organization_id' => 'integer',
    ];

    public function seal()
    {
        return $this->belongsTo(UploadFile::class);
    }

    public function teter()
    {

     return $this->belongsTo(UploadFile::class);
    }

    public function chairManType() {

        return $this->belongsTo(Employee::class);
    }

    public function parentUnit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function reportsTo()
    {
        return $this->belongsTo(Unit::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }


    public function viewOffice($crud = false)
    {

        $route =  backpack_url('job-grade'); // custome toute here

        return '<a class="btn btn-sm btn-link"  href="' . $route . '" data-toggle="tooltip" title="View Positions"><i class="la la-flag"></i> Positions </a>';
    }



    public function viewEmployee($crud = false)
    {

        $route =  backpack_url('job-grade'); // custome toute here

        return '<a class="btn btn-sm btn-link"  href="' . $route . '" data-toggle="tooltip" title="View employee"><i class="la la-users"></i> Employee </a>';
    }



    public function childs() {

        return $this->hasMany(Self::class,'parent_unit_id','id') ;

    }
}
