<?php

use App\Models\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Project extends Model implements AuditableContract {
    use \OwenIt\Auditing\Auditable, HasFactory;

    public $incrementing = false;
    protected $keytype = 'string';

    protected $fillable = ['name', 'description', 'status'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}