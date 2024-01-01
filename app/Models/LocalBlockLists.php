<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalBlockLists extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'rt', 'statement','hiddenBy','dateofreceivedMessage','index','notes','statu','file_name'
    ];

}
