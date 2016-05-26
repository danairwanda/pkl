<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Hub;
use App\SwitchSub;
use App\MerekAlat;
use App\KondisiAlat;
use Response;

class HubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $hub = Hub::all();
        return Response::json($hub,200);
    }
    public function index(Request $request)
    {
        // $hub = Hub::all();
        // return Response::json($hub,200);
        // if (!empty($Request)) {
        //     $hub = Hub::all();
        // }
        if ($request->get('search')) {
            $hub = Hub::where("idHub", "LIKE", "{$request->get('search')}%")->paginate(5);
        }else{
            $hub = Hub::paginate(5);
        }

        foreach ($hub as $key => $value) {
            // $fk_provider = $value["fk_provider"];
            $SwitchSub = SwitchSub::all();
            $SwitchSub = json_decode($SwitchSub);
            $SwitchSub = (array) $SwitchSub[0]; 
            // echo '<pre>'; print_r($SwitchSub) ;die ();
            if (!empty($SwitchSub )&& is_array($SwitchSub)) {
                $hub[$key]['fk_SS']=$SwitchSub["namaSS"];
            }else{
                $hub[$key]['fk_SS']="kode form tidak ditemukan di api";
            }
        }

        foreach ($hub as $key => $value) {
            // $fk_provider = $value["fk_provider"];
            $MerekAlat = MerekAlat::all();
            $MerekAlat = json_decode($MerekAlat);
            $MerekAlat = (array) $MerekAlat[0]; 
            // echo '<pre>'; print_r($MerekAlat) ;die ();
            if (!empty($MerekAlat )&& is_array($MerekAlat)) {
                $hub[$key]['fk_merekHub']=$MerekAlat["namaMerek"];
            }else{
                $hub[$key]['fk_merekHub']="kode merek tidak ditemukan di api";
            }
        }

         foreach ($hub as $key => $value) {
            // $fk_provider = $value["fk_provider"];
            $KondisiAlat = KondisiAlat::all();
            $KondisiAlat = json_decode($KondisiAlat);
            $KondisiAlat = (array) $KondisiAlat[0]; 
            // echo '<pre>'; print_r($KondisiAlat) ;die ();
            if (!empty($KondisiAlat )&& is_array($KondisiAlat)) {
                $hub[$key]['fk_kondisiHub']=$KondisiAlat["kondisi"];
            }else{
                $hub[$key]['fk_kondisiHub']="kode kondisi tidak ditemukan di api";
            }
        }
        return Response::json($hub,200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hub = new Hub;
        // $hub->idHub = $request->idHub;
        $hub->fk_SS = $request->fk_SS;
        $hub->parentHub = $request->parentHub;
        $hub->namaHub = $request->namaHub;
        $hub->fk_merekHub = $request->fk_merekHub;
        $hub->api_ruangHub = $request->api_ruangHub;
        $hub->fk_kondisiHub = $request->fk_kondisiHub;
        $hub->isDeleted = $request->isDeleted;
        $hub->createdBy = $request->createdBy;
        $hub->createdDate = $request->createdDate;
        $hub->modifiedBy = $request->modifiedBy;
        $hub->modifiedDate = $request->modifiedDate;
        $success=$hub->save();
        
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
        $hub = Hub::find($primaryKey);
        if (is_null($hub)) {
            return Response::json("not found",404);
        }
        return Response::json($hub,200);
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
        $hub = Hub::find($primaryKey);
        $hub->idHub = $request->input('idHub');
        $hub->fk_SS = $request->input('fk_SS');
        $hub->parentHub = $request->input('parentHub');
        $hub->namaHub = $request->input('namaHub');
        $hub->fk_merekHub = $request->input('fk_merekHub');
        $hub->api_ruangHub = $request->input('api_ruangHub');
        $hub->fk_kondisiHub = $request->input('fk_kondisiHub');
        $hub->isDeleted = $request->input('isDeleted');
        $hub->createdBy = $request->input('createdBy');
        $hub->createdDate = $request->input('createdDate');
        $hub->modifiedBy = $request->input('modifiedBy');
        $hub->modifiedDate = $request->input('modifiedDate');
        $success=$hub->save();
        
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
        $hub = Hub::find($primaryKey);
        if (is_null($hub)) {
            return Response::json("not found",404);
        }
            
        $barangInven->isDeleted = 1;
        $success=$hub->save();

        if (!$success) {
            return Response::json("error deleting",500);
        }
        return Response::json("success",200);
    }
}
