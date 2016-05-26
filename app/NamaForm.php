<?php

namespace App;

use App\BaseModel;

class NamaForm extends BaseModel
{
    public $incrementing = false;
    protected $table = 'nama_form';
    protected $primaryKey = 'idNamaForm';
    protected $fillable = array('idNamaForm','api_uker','nomerForm','namaForm','template','isDeleted','createBy','createdDate','modifiedBy','modifiedDate');
    public $timestamps = false;

    public function Gangguan(){
    	return $this->hasMany('App\Gangguan','fk_jenisForm');
    }

    public function Penanganan(){
    	return $this->hasMany('App\Penanganan','fk_gangguan');
    }

    public function InvenMasuk(){
    	return $this->hasMany('App\InvenMasuk','fk_form');
    }
}
