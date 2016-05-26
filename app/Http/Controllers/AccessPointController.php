<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AccessPoint;
use App\KondisiAlat;
use App\MerekAlat;
use App\Hub;
use Response;

class AccessPointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $accessPoint = AccessPoint::all();
        return Response::json($accessPoint,200);
    }

    public function index(Request $request)
    {
        // $accessPoint = AccessPoint::all();
        // return Response::json($accessPoint,200);
        if ($request->get('search')) {
            $accessPoint = AccessPoint::where("idAP", "LIKE", "{$request->get('search')}%")->paginate(5);
        }else{
            $accessPoint = AccessPoint::paginate(5);
           
        }
         foreach ($accessPoint as $key => $value) {
                $hub = Hub::all();
                $hub = json_decode($hub);
                $hub = (array) $hub[0]; 
                if (!empty($hub )&& is_array($hub)) {
                    $accessPoint[$key]['fk_hub']=$hub["namaHub"];

                }else{
                    $accessPoint[$key]['fk_hub']="kode hub tidak ditemukan di api";

                }
            }

            foreach ($accessPoint as $key => $value) {
                $kondisiAlat = KondisiAlat::all();
                $kondisiAlat = json_decode($kondisiAlat);
                $kondisiAlat = (array) $kondisiAlat[0]; 
                if (!empty($kondisiAlat )&& is_array($kondisiAlat)) {
                    $accessPoint[$key]['fk_kondisiAP']=$kondisiAlat["kondisi"];

                }else{
                    $accessPoint[$key]['fk_kondisiAP']="kode kondisi tidak ditemukan di api";

                }
            }

            foreach ($accessPoint as $key => $value) {
                $MerekAlat = MerekAlat::all();
                $MerekAlat = json_decode($MerekAlat);
                $MerekAlat = (array) $MerekAlat[0]; 
                if (!empty($MerekAlat )&& is_array($MerekAlat)) {
                    $accessPoint[$key]['fk_merekAp']=$MerekAlat["namaMerek"];

                }else{
                    $accessPoint[$key]['fk_merekAp']="kode merek tidak ditemukan di api";

                }
            }
        return Response::json($accessPoint,200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $accessPoint = new AccessPoint;
        // $accessPoint->idAP = $request->idAP;
        $accessPoint->fk_hub = $request->fk_hub;
        $accessPoint->namaAp = $request->namaAp;
        $accessPoint->fk_merekAp = $request->fk_merekAp;
        $accessPoint->ipAp = $request->ipAp;
        $accessPoint->fk_kondisiAP = $request->fk_kondisiAP;
        $accessPoint->api_ruangAP = $request->api_ruangAP;
        $accessPoint->isDeleted = $request->isDeleted;
        $accessPoint->createdBy = $request->createdBy;
        $accessPoint->createdDate = $request->createdDate;
        $accessPoint->modifiedBy = $request->modifiedBy;
        $accessPoint->modifiedDate = $request->modifiedDate;
        $success=$accessPoint->save();
        
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
        $accessPoint = AccessPoint::find($primaryKey);
        if (is_null($accessPoint)) {
            return Response::json("not found",404);
        }
        return Response::json($accessPoint,200);
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
        $accessPoint = AccessPoint::find($primaryKey);
        $accessPoint->idAP = $request->input('idAP');
        $accessPoint->fk_hub = $request->input('fk_hub');
        $accessPoint->namaAp = $request->input('namaAp');
        $accessPoint->fk_merekAp = $request->input('fk_merekAp');
        $accessPoint->ipAp = $request->input('ipAp');
        $accessPoint->fk_kondisiAP = $request->input('fk_kondisiAP');
        $accessPoint->api_ruangAP = $request->input('api_ruangAP');
        $accessPoint->isDeleted = $request->input('isDeleted');
        $accessPoint->createdBy = $request->input('createdBy');
        $accessPoint->createdDate = $request->input('createdDate');
        $accessPoint->modifiedBy = $request->input('modifiedBy');
        $accessPoint->modifiedDate = $request->input('modifiedDate');
        $success=$accessPoint->save();
        
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
        $accessPoint = AccessPoint::find($primaryKey);
        if (is_null($accessPoint)) {
            return Response::json("not found",404);
        }
            
        $barangInven->isDeleted = 1;
        $success=$accessPoint->save();

        if (!$success) {
            return Response::json("error deleting",500);
        }
        return Response::json("success",200);
    }
}
