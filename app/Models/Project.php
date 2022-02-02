<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['project_name','created_by','updated_by','deleted_by'];

    public static function boot() {
        parent::boot();
  
        // create a event to happen on updating
        static::updating(function($table)  {
            $table->updated_by = auth()->user()->id;
        });
  
        // create a event to happen on deleting
        static::deleting(function($table)  {
            $table->deleted_by = auth()->user()->id;
        });
  
        // create a event to happen on saving
        static::creating(function($table)  {
            if (Auth::user()) {
                $table->created_by = auth()->user()->id;
            }
        });
      }

}
