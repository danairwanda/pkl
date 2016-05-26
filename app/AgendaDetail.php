<?php

namespace App;

use App\BaseModel;

class AgendaDetail extends BaseModel
{
	public $incrementing = false;
    protected $table 		= 'detil_agenda_kerja';
    protected $primaryKey 	= 'idDetilAgenda';
    protected $fillable		= array('idDetilAgenda','fk_rekapAgenda','detilAgenda','screenshoot','isDeleted','createdBy','createdDate','modifiedBy','modifiedDate');
    public $timestamps	= false;	

    public function AgendaKerja(){
    	return $this->belongsTo('App\AgendaKerja','fk_rekapAgenda');
    }
}
