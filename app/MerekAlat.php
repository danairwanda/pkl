<?php

namespace App;

use App\BaseModel;
class MerekAlat extends BaseModel
{
    public $incrementing = false;
    protected $table = 'merek_alat';
    protected $primaryKey = 'idMerekAlat';
    protected $fillable = array('idMerekAlat','namaMerek','singkatanMerek','isDeleted','createdBy','createdDate','modifiedBy','modifiedDate');
    public $timestamps = false;

    public function Firewall(){
    	return $this->hasMany('App\Firewall');
    }

    public function SwitchCore(){
    	return $this->hasMany('App\SwitchCore');
    }

    public function SwitchHub(){
    	return $this->hasMany('App\SwitchHub');
    }

    public function Hub(){
    	return $this->hasMany('App\Hub');
    }

    public function AccessPoint(){
    	return $this->hasMany('App\AccessPoint');
    }
}
