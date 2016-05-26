<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use App\BaseModel;

class Coba extends BaseModel
{
	public $incrementing = false;
	protected $table = 'coba';

	protected $primaryKey = 'id';
	public $timestamps = false;

	// protected $fillable = array('idAgendaKerja');
	
    // protected $fillable = array('idAgendaKerja','api_uker','api_pegawai','tglAgenda','rekapAgenda','isDeleted','createdBy','createdDate','modifiedBy','modifiedDate');
protected $fillable = array('test');
}
