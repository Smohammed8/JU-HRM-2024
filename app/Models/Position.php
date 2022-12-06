<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Position extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    protected $appends = ['position_info','name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'unit_id',
        'job_title_id',
        'total_employees',
        'available_for_placement',
        'position_type_id',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'unit_id' => 'integer',
        'job_title_id' => 'integer',
    ];

    public function getPositionInfoAttribute()
    {
        return $this->jobTitle->name.' at '.$this->unit->name;
    }

    public function getNameAttribute()
    {
        return $this->jobTitle->name;
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function jobTitle()
    {
        return $this->belongsTo(JobTitle::class);
    }

    /**
     * Get all of the minimumRequirements for the Position
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function minimumRequirements(): HasMany
    {
        return $this->hasMany(MinimumRequirement::class);
    }

    public function placementChoiceTwos(): HasMany
    {
        return $this->hasMany(PlacementChoice::class, 'choice_one_id', 'id');
    }
    public function placementChoiceOnes(): HasMany
    {
        return $this->hasMany(PlacementChoice::class, 'choice_two_id', 'id');
    }
    public function placementChoices()
    {
        return $this->placementChoiceOnes->merge($this->placementChoiceTwos);
    }

}
