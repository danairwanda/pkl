<?php

namespace App;

use App\BaseModel;
use DB;

class AgendaKerja extends BaseModel
{
	public $incrementing = false;
    protected $table 			= 'agenda_kerja';
    protected $primaryKey		= 'idAgendaKerja';
    protected $fillable			= array('idAgendaKerja','api_uker','api_pegawai','tglAgenda','rekapAgenda','isDeleted','createdBy','createdDate','modifiedBy','modifiedDate');
    public 	  $timestamps = false;

    public function AgendaDetails(){
    	return $this->hasMany('App\AgendaDetail','fk_rekapAgenda');
    }
}
