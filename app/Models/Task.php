<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','status','assigned_to','department_id','priority','due_date'];

    public function assignee(){ return $this->belongsTo(User::class,'assigned_to'); }
    public function department(){ return $this->belongsTo(Department::class); }
    public function comments(){ return $this->hasMany(TaskComment::class); }
    public function tags()
    {
        return $this->belongsToMany(\App\Models\Tag::class, 'task_tags')->withTimestamps();
    }
}
