<?php

namespace App;

use App\BaseModel;

class InvenMasuk extends BaseModel
{
    public $incrementing = false;
    protected $table = 'inven_masuk';
    protected $primaryKey = 'idInvenMasuk';
    protected $fillable = array('idInvenMasuk','fk_form','api_uker','fk_barang','jumlah','api_penJawab','api_penerima','nomor','keterangan','isDelete','createdBy','createdDate','modifiedBy','modifiedDate');
    public $timestamps = false;

    public function BarangInven(){
    	return $this->belongsTo('App\BarangInven','fk_barang');
    }

    public function InvenStatus(){
    	return $this->hasMany('App\InvenStatus','fk_invenMasuk');
    }

    public function NamaForm(){
        return $this->belongsTo('App\NamaForm','fk_form');
    }
}
