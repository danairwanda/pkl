<?php

namespace App;

use App\BaseModel;

class AccessPoint extends BaseModel
{
    public $incrementing = false;
    protected $table = 'access_point';
    protected $primaryKey = 'idAP';
    protected $fillable = array('idAP','fk_hub','namaAp','fk_merekAp','ipAp','fk_kondisiAP','api_ruangAP','isDeleted','createdBy','createdDate','modifiedBy','modifiedDate');
    public $timestamps = false;

    public function KondisiAlat(){
    	return $this->belongsTo('App\KondisiAlat','fk_kondisiAP');
    }

    public function MerekAlat(){
    	return $this->belongsTo('App\MerekAlat','fk_merekAp');
    }

    public function Hub(){
    	return $this->belongsTo('App\Hub','fk_hub');
    }
}
