<?php

namespace App;

use App\BaseModel;

class pddError extends BaseModel
{
	public $incrementing = false;
    protected $table = 'pdd_error';
    protected $primaryKey = 'idErrPdd';
    protected $fillable = array('idErrPdd','tglErrPdd','namaPdd','ketErrPdd','diSelesaikan');
    public $timestamps = false;
}
