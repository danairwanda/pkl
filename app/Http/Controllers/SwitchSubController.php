<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SwitchSub;
use App\SwitchCore;
use App\MerekAlat;
use App\KondisiAlat;
use Response;

class SwitchSubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $SwitchSub = SwitchSub::all();
        return Response::json($SwitchSub,200);
    }

    public function index(Request $request)
    {
        // $switchSub = $SwitchSub::all();
        // return Response::json($switchSub);
        // $switchSub = SwitchSub::all();
        if ($request->get('search')) {
            $switchSub = SwitchSub::where("idSwitchSub", "LIKE", "{$request->get('search')}%")->paginate(5);
        }else{
            $switchSub = SwitchSub::paginate(5);
        }

        foreach ($switchSub as $key => $value) {
            // $fk_provider = $value["fk_provider"];
            $SwitchCore = SwitchCore::all();
            $SwitchCore = json_decode($SwitchCore);
            $SwitchCore = (array) $SwitchCore[0]; 
            // echo '<pre>'; print_r($SwitchCore) ;die ();
            if (!empty($SwitchCore )&& is_array($SwitchCore)) {
                $switchSub[$key]['fk_SC']=$SwitchCore["namaSC"];
            }else{
                $switchSub[$key]['fk_SC']="kode switch core tidak ditemukan di api";
            }
        }

        foreach ($switchSub as $key => $value) {
            // $fk_provider = $value["fk_provider"];
            $MerekAlat = MerekAlat::all();
            $MerekAlat = json_decode($MerekAlat);
            $MerekAlat = (array) $MerekAlat[0]; 
            // echo '<pre>'; print_r($MerekAlat) ;die ();
            if (!empty($MerekAlat )&& is_array($MerekAlat)) {
                $switchSub[$key]['fk_merekSS']=$MerekAlat["namaMerek"];
            }else{
                $switchSub[$key]['fk_merekSS']="kode merek core tidak ditemukan di api";
            }
        }
        foreach ($switchSub as $key => $value) {
            // $fk_provider = $value["fk_provider"];
            $KondisiAlat = KondisiAlat::all();
            $KondisiAlat = json_decode($KondisiAlat);
            $KondisiAlat = (array) $KondisiAlat[0]; 
            // echo '<pre>'; print_r($KondisiAlat) ;die ();
            if (!empty($KondisiAlat )&& is_array($KondisiAlat)) {
                $switchSub[$key]['fk_kondisiSS']=$KondisiAlat["kondisi"];
            }else{
                $switchSub[$key]['fk_kondisiSS']="kode kondisi core tidak ditemukan di api";
            }
        }
        return Response::json($switchSub,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $switchSub = new SwitchSub;
        // $switchSub->idSubSwitch = $request->idSubSwitch;
        $switchSub->fk_SC = $request->fk_SC;
        $switchSub->fk_switchSub = $request->fk_switchSub;
        $switchSub->namaSS = $request->namaSS;
        $switchSub->ipSS = $request->ipSS;
        $switchSub->fk_merekSS = $request->fk_merekSS;
        $switchSub->api_ruangSS = $request->api_ruangSS;
        $switchSub->fk_kondisiSS = $request->fk_kondisiSS;
        $switchSub->isDeleted = $request->isDeleted;
        $switchSub->createdBy = $request->createdBy;
        $switchSub->createdDate = $request->createdDate;
        $switchSub->modifiedBy = $request->modifiedBy;
        $switchSub->modifiedDate = $request->modifiedDate;
        $success=$switchSub->save();
        
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
        $switchSub = SwitchSub::find($primaryKey);
        if (is_null($switchSub)) {
            return Response::json("not found",404);
        }
        return Response::json($switchSub,200);
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
        $switchSub = SwitchSub::find($primaryKey);
        $switchSub->idSubSwitch = $request->input('idSubSwitch');
        $switchSub->fk_SC = $request->input('fk_SC');
        $switchSub->fk_switchSub = $request->input('fk_switchSub');
        $switchSub->namaSS = $request->input('namaSS');
        $switchSub->ipSS = $request->input('ipSS');
        $switchSub->fk_merekSS = $request->input('fk_merekSS');
        $switchSub->api_ruangSS = $request->input('api_ruangSS');
        $switchSub->fk_kondisiSS = $request->input('fk_kondisiSS');
        $switchSub->isDeleted = $request->input('isDeleted');
        $switchSub->createdBy = $request->input('createdBy');
        $switchSub->createdDate = $request->input('createdDate');
        $switchSub->modifiedBy = $request->input('modifiedBy');
        $switchSub->modifiedDate = $request->input('modifiedDate');
        $success=$switchSub->save();
        
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
    public function destroy($id)
    {
        $switchSub = SwitchSub::find($primaryKey);
        if (is_null($switchSub)) {
            return Response::json("not found",404);
        }
            
        $barangInven->isDeleted = 1;
        $success=$switchSub->save();

        if (!$success) {
            return Response::json("error deleting",500);
        }
        return Response::json("success",200);
    }
}
