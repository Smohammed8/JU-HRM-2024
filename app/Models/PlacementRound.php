<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlacementRound extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'round',
        'year',
        'status',
        'is_open',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'is_open'=>'boolean',
    ];


    public function placementChoicesButtonView($crud = false)
    {
        $route =  route('placement-round/{placement_round}/placement-choice.index',['placement_round'=>$this->id]); // custome toute here
        return '<a class="btn btn-sm btn-link"  href="' . $route . '" data-toggle="tooltip" title="Placement choice"><i class="la la-list"></i>Placement Choices </a>';
    }


    public function placementResultButtonView($crud = false)
    {
        $route =  route('result'); // custome toute here
        return '<a class="btn btn-sm btn-link"  href="' . $route . '" data-toggle="tooltip" title="Placement result with analysis"><i class="la la-th-list"></i> Placement Analysis </a>';
    }

    public function committeeButtonView($crud = false)
    {

        $route =  backpack_url('committee'); // custome toute here
        return '<a class="btn btn-sm btn-link"  href="' . $route . '" data-toggle="tooltip" title="List of committees who approved placement"><i class="fa fa-users"></i> Committees </a>';
    }


    public function complainButtonView($crud = false)
    {
        

        $route =  backpack_url('complaint'); // custome toute here

        return '<a class="btn btn-sm btn-link"  href="' . $route . '" data-toggle="tooltip" title="Employee complians after placement made"><i class="la la-user-tie"></i> Complains </a>';
    }

 public function getLeg($crud = false)
 {
    $route  = route('legistlation');
        return '<a class="btn btn-sm btn-link"  href="'.$route.'" data-toggle="tooltip" title="Download"><i class="la la-download"></i> Legislation PDF </a>';
 }


}
