<?php

namespace App;

use App\BaseModel;

class Gangguan extends BaseModel
{
    public $incrementing = false;
    protected $table = 'gangguan';
    protected $primaryKey = 'idGangguan';
    protected $fillable = array('idGangguan','fk_jenisForm','tglMasukLaporan','namaPelapor','api_pelapor','api_fkRuang','penerimaLaporan','uraianGangguan','sudahDitangani','cetakGangguan','isDeleted','createdBy','createdDate','modifiedBy','modifiedDate');
    public $timestamps = false;

    public function NamaForm(){
    	return $this->belongsTo('App\NamaForm','fk_jenisForm');
    }

    public function Penanganan(){
    	return $this->hasMany('App\Penanganan');
    }

}
