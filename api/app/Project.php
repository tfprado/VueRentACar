<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    // protected $fillable = [
    //     'title', 'description', 'owner_id'
    // ];
    // or everything but these are fillable
    protected $guarded = [];

    protected static function boot()
    {
        // Calling model class boot method.
        parent::boot();

        static::created(function ($project){
            // only executed after a new project is created
            Mail::to($project->owner->email)->send(
                new ProjectCreated($project)
            );
        });
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function addTask($task)
    {
        $this->tasks()->create($task);
    }
}
