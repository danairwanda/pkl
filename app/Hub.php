<?php

namespace App;

use App\BaseModel;

class Hub extends BaseModel
{
    public $incrementing = false;
    protected $table = 'hub';
    protected $primaryKey = 'idHub';
    protected $fillable = array('idHub','fk_SS','parentHub','namaHub','fk_merekHub','api_ruangHub','fk_kondisiHub','isDeleted','createdBy','createdDate','modifiedBy','modifiedDate');
    public $timestamps = false;

    public function Hub(){
    	return $this->hasMany('parentHub','idHub');
    }

    public function KondisiAlat(){
    	return $this->belongsTo('App\KondisiAlat','fk_kondisiHub');
    }

    public function MerekAlat(){
    	return $this->belongsTo('App\MerekAlat','fk_merekHub');
    }

    public function SwitchSub(){
    	return $this->belongsTo('App\SwitchSub','fk_kondisiSS');
    }

    public function AccessPoint(){
    	return $this->hasMany('App\AccessPoint','fk_hub');
    }

}
