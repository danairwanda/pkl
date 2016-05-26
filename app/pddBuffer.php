<?php

namespace App;

use App\BaseModel;
class pddBuffer extends BaseModel
{
	public $incrementing = false;
    protected $table = 'pdd_buffer';
    protected $primaryKey = 'idBuffer';
    protected $fillable = array('idBuffer','namaPdd','tglBuffer','remoteAddress','fileBuffer','indexAwal','indexAkhir','jmlDataBuffer','indexBuffer','totalLogAkhir','tglIntegrasi1','tglIntegrasi2','totalIntegrasi','caraKirim','caraIntegrasi','statusIntegrasi','ketBuffer');
    public $timestamps = false;
}
