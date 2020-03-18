<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Radius extends Model
{
    //

    protected $connection = 'radius_mysql';

    protected $table = 'radcheck';

    /**
     * timestamps
     *
     * 資料表不存在 created_at and updated_at 欄位，設定忽略時間標記欄位
     */
    public $timestamps = false;
    
    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'attribute', 'op', 'value'];
}
