<?php

namespace App;

use App\BaseModel;

class InvenStatus extends BaseModel
{
	public $incrementing = false;
    protected $table = 'inven_status';
    protected $primaryKey = 'idInvenStatus';
    protected $fillable = array('idInvenStatus','fk_invenMasuk','kodeItem','tglPemeriksaan','api_pemeriksa','statusPeriksa','isDeleted','createdBy','createdDate','modifiedBy','modifiedDate');
    public $timestamps = false;

    public function InvenMasuk(){
    	return $this->belongsTo('App\InvenMasuk','fk_invenMasuk');
    }
}
