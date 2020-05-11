<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    const COST = 'cost';
    const SELECT = 'select';
    const NAME = 'NAME';
    protected $guarded = [];
}
