<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class Subject extends Model
{
    use HasFactory;
    protected $table = 'subject';

    static public function getSubject()
    {
        $return = self::select('subject.*', 'users.name as created_by_name')
            ->where('subject.is_deleted', '=', 0);
        if (!empty(Request::get('name'))) {
            $return = $return->where('subject.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('type'))) {
            $return = $return->where('subject.type', '=', Request::get('type'));
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('subject.created_at', '=', Request::get('date'));
        }
        $return = $return->join('users', 'users.id', 'subject.created_by')
            ->orderBy('id')
            ->paginate(20);

        return $return;

    }
}
