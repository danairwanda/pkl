<?php

namespace App;

use App\BaseModel;

class SwitchCore extends BaseModel
{
    public $incrementing = false;
    protected  $table = 'switch_core';
    protected $primaryKey = 'idSC';
    protected $fillable = array('idSC','fk_firewall','namaSC','ipSC','fk_merekSC','api_ruangSC','fk_kondisiSC','isDeleted','createdBy','createdDate','modifiedBy','modifiedDate');
    public $timestamps = false;

    public function KondisiAlat(){
    	return $this->belongsTo('App\KondisiAlat','fk_kondisiSC');
    }

    public function Firewall(){
    	return $this->belongsTo('App\Firewall','fk_firewall');
    }

    public function MerekAlat(){
    	return $this->belongsTo('App\MerekAlat','fk_merekSC');
    }

    public function SwitchSub(){
    	return $this->hasMany('App\SwitchSub','fk_SC');
    }
}
