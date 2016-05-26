<?php

namespace App;

use App\BaseModel;

class Penanganan extends BaseModel
{
    public $incrementing = false;
    protected $table = 'penanganan';
    protected $primaryKey = 'idPenanganan';
    protected $fillable = array('idPenanganan','fk_gangguan','fk_jenisForm','tglPenanganan','api_teknisi','uraianPenanganan','isDeleted','createdBy','createdDate','modifiedBy','modifiedDate');
    public $timestamps = false;

    public function NamaForm(){
    	return $this->belongsTo('App\NamaForm','fk_jenisForm');
    }

    public function Gangguan(){
    	return $this->belongsTo('App\Gangguan','fk_gangguan');
    }
}
