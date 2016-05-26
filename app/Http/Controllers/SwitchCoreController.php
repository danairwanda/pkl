<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SwitchCore;
use App\Firewall;
use App\MereKAlat;
use App\KondisiAlat;
use Response;

class SwitchCoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $SwitchCore = SwitchCore::all();
        return Response::json($SwitchCore,200);
    }

    public function index(Request $request)
    {
        // $switchCore = SwitchCore::all();
        // return Response::json($switchCore,200);
        $switchCore = SwitchCore::all();
        if ($request->get('search')) {
            $switchCore = SwitchCore::where("idSC", "LIKE", "{$request->get('search')}%")->paginate(5);
        }else{
            $switchCore = SwitchCore::paginate(5);
        }

         foreach ($switchCore as $key => $value) {
            // $fk_provider = $value["fk_provider"];
            $Firewall = Firewall::all();
            $Firewall = json_decode($Firewall);
            $Firewall = (array) $Firewall[0]; 
            // echo '<pre>'; print_r($Firewall) ;die ();
            if (!empty($Firewall )&& is_array($Firewall)) {
                $switchCore[$key]['fk_firewall']=$Firewall["namaFirewall"];
            }else{
                $switchCore[$key]['fk_firewall']="kode form tidak ditemukan di api";
            }
        }

        foreach ($switchCore as $key => $value) {
            // $fk_provider = $value["fk_provider"];
            $MerekAlat = MerekAlat::all();
            $MerekAlat = json_decode($MerekAlat);
            $MerekAlat = (array) $MerekAlat[0]; 
            // echo '<pre>'; print_r($MerekAlat) ;die ();
            if (!empty($MerekAlat )&& is_array($MerekAlat)) {
                $switchCore[$key]['fk_merekSC']=$MerekAlat["namaMerek"];
            }else{
                $switchCore[$key]['fk_merekSC']="kode merek tidak ditemukan di api";
            }
        }

        foreach ($switchCore as $key => $value) {
            // $fk_provider = $value["fk_provider"];
            $KondisiAlat = KondisiAlat::all();
            $KondisiAlat = json_decode($KondisiAlat);
            $KondisiAlat = (array) $KondisiAlat[0]; 
            // echo '<pre>'; print_r($KondisiAlat) ;die ();
            if (!empty($KondisiAlat )&& is_array($KondisiAlat)) {
                $switchCore[$key]['fk_kondisiSC']=$KondisiAlat["kondisi"];
            }else{
                $switchCore[$key]['fk_kondisiSC']="kode form tidak ditemukan di api";
            }
        }
        return Response::json($switchCore,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $switchCore = new SwitchCore;
        // $switchCore->idSC = $request->idSC;
        $switchCore->fk_firewall = $request->fk_firewall;
        $switchCore->namaSC = $request->namaSC;
        $switchCore->ipSC = $request->ipSC;
        $switchCore->fk_merekSC = $request->fk_merekSC;
        $switchCore->api_ruangSC = $request->api_ruangSC;
        $switchCore->fk_kondisiSC = $request->fk_kondisiSC;
        $switchCore->isDeleted = $request->isDeleted;
        $switchCore->createdBy = $request->createdBy;
        $switchCore->createdDate = $request->createdDate;
        $switchCore->modifiedBy = $request->modifiedBy;
        $switchCore->modifiedDate = $request->modifiedDate;
        $success=$switchCore->save();
        
        if (!$success) {
            return Response::json("error saving",500);
        }
        return Response::json("success",200);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($primaryKey)
    {
        $switchCore = SwitchCore::find($primaryKey);
        if (is_null($switchCore)) {
            return Response::json("not found",404);
        }
        return Response::json($switchCore,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $primaryKey)
    {
        $switchCore = SwitchCore::find($primaryKey);
        $switchCore->idSC = $request->input('idSC');
        $switchCore->fk_firewall = $request->input('fk_firewall');
        $switchCore->namaSC = $request->input('namaSC');
        $switchCore->ipSC = $request->input('ipSC');
        $switchCore->fk_merekSC = $request->input('fk_merekSC');
        $switchCore->api_ruangSC = $request->input('api_ruangSC');
        $switchCore->fk_kondisiSC = $request->input('fk_kondisiSC');
        $switchCore->isDeleted = $request->input('isDeleted');
        $switchCore->createdBy = $request->input('createdBy');
        $switchCore->createdDate = $request->input('createdDate');
        $switchCore->modifiedBy = $request->input('modifiedBy');
        $switchCore->modifiedDate = $request->input('modifiedDate');
        $success=$switchCore->save();
        
        if (!$success) {
            return Response::json("error saving",500);
        }
        return Response::json("success",200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($primaryKey)
    {
        $switchCore = SwitchCore::find($primaryKey);
        if (is_null($switchCore)) {
            return Response::json("not found",404);
        }
            
        $barangInven->isDeleted = 1;
        $success=$switchCore->save();

        if (!$success) {
            return Response::json("error deleting",500);
        }
        return Response::json("success",200);
    }
}
