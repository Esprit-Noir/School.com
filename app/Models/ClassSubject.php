<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSubject extends Model
{
    use HasFactory;
    protected $table = 'class_subject';

    static public function getClassSubjects()
    {
        return self::select('class_subject.*', 'users.name as created_by_name')
            ->where('class_subject.is_deleted', '=', 0)
            ->join('users', 'users.id', 'class_subject.created_by')
            ->orderBy('id')
            ->paginate(20);
    }
}
