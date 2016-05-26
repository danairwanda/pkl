<?php

namespace App;

use App\BaseModel;

class KondisiAlat extends BaseModel
{
    public $incrementing = false;
    protected  $table = 'kondisi_alat';
    protected  $primaryKey = 'idKondisiAlat';
    protected  $fillable = array('idKondisiAlat','kondisi','isDeleted','createdBy','createdDate','modifiedBy','modifiedDate');
    public $timestamps = false;

    public function Firewall(){
    	return $this->hasMany('App\Firewall','fk_kondisiFW');
    }

    public function SwitchCore(){
    	return $this->hasMany('App\SwitchCore','fk_kondisiSC');
    }

    public function SwitchSub(){
    	return $this->hasMany('App\SwitchSub','fk_kondisiSS');
    }

    public function Hub(){
    	return $this->hasMany('App\Hub','fk_kondisiHub');
    }

    public function AccessPoint(){
    	return $this->hasMany('App\AccessPoint','fk_kondisiAP');
    }
}
