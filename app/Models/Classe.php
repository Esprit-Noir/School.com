<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;
class Classe extends Model
{
    use HasFactory;
    protected $table = 'class';

    static public function getClasses()
    {
        $return = self::select('class.*', 'users.name as created_by_name')
                    ->where('class.is_deleted', '=', 0);
                     if (!empty(Request::get('name')))
                     {
                         $return = $return->where('class.name', 'like', '%'.Request::get('name').'%');
                     }
                    if (!empty(Request::get('date')))
                    {
                        $return = $return->whereDate('class.created_at', '=', Request::get('date'));
                    }
                     $return = $return->join('users', 'users.id', 'class.created_by')
                    ->orderBy('id')
                    ->paginate(20);

        return $return;

    }
}
