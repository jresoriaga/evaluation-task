<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'deals';
    protected $guarded = ['id'];
    protected $fillable = ['submission_date', 'account_id', 'deal_name', 'iso_id', 'sales_stage'];

    // Define the relationship to Account
    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class, 'account_id');
    }

    // Define the relationship to Iso
    public function iso()
    {
        return $this->belongsTo(\App\Models\Iso::class, 'iso_id');
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}