<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Firewall;
use App\Provider;
use App\MerekAlat;
use App\KondisiAlat;
use Response;

class FirewallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $Firewall = Firewall::all();
        return Response::json($Firewall,200);
    }

    public function index(Request $request)
    {
        // $firewall = Firewall::all();
        // return Response::json($firewall,200);
        $Firewall = Firewall::all();
        if ($request->get('search')) {
            $Firewall = Firewall::where("idFirewall", "LIKE", "{$request->get('search')}%")->paginate(5);
        }else{
            $Firewall = Firewall::paginate(5);
        }


        foreach ($Firewall as $key => $value) {
            $fk_provider = $value["fk_provider"];
            $Provider = Provider::all();
            $Provider = json_decode($Provider);
            $Provider = (array) $Provider[0]; 
            // echo '<pre>'; print_r($Provider) ;die ();
            if (!empty($Provider )&& is_array($Provider)) {
                $Firewall[$key]['fk_provider']=$Provider["namaProvider"];
            }else{
                $Firewall[$key]['fk_provider']="kode provider tidak ditemukan di api";
            }
        }

        foreach ($Firewall as $key => $value) {
            // $fk_provider = $value["fk_provider"];
            $MerekAlat = MerekAlat::all();
            $MerekAlat = json_decode($MerekAlat);
            $MerekAlat = (array) $MerekAlat[0]; 
            // echo '<pre>'; print_r($MerekAlat) ;die ();
            if (!empty($MerekAlat )&& is_array($MerekAlat)) {
                $Firewall[$key]['fk_merekFW']=$MerekAlat["namaMerek"];
            }else{
                $Firewall[$key]['fk_merekFW']="kode merek tidak ditemukan di api";
            }
        }

        foreach ($Firewall as $key => $value) {
            // $fk_provider = $value["fk_provider"];
            $KondisiAlat = KondisiAlat::all();
            $KondisiAlat = json_decode($KondisiAlat);
            $KondisiAlat = (array) $KondisiAlat[0]; 
            // echo '<pre>'; print_r($KondisiAlat) ;die ();
            if (!empty($KondisiAlat )&& is_array($KondisiAlat)) {
                $Firewall[$key]['fk_kondisiFW']=$KondisiAlat["kondisi"];
            }else{
                $Firewall[$key]['fk_kondisiFW']="kode merek tidak ditemukan di api";
            }
        }


        return Response::json($Firewall,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $firewall = new Firewall;
        // $firewall->idFirewall = $request->idFirewall;
        $firewall->fk_provider = $request->fk_provider;
        $firewall->namaFirewall = $request->namaFirewall;
        $firewall->ipFirewall = $request->ipFirewall;
        $firewall->fk_merekFW = $request->fk_merekFW;
        $firewall->api_ruangFW = $request->api_ruangFW;
        $firewall->fk_kondisiFW = $request->fk_kondisiFW;
        $firewall->isDeleted = $request->isDeleted;
        $firewall->createdBy = $request->createdBy;
        $firewall->createdDate = $request->createdDate;
        $firewall->modifiedBy = $request->modifiedBy;
        $firewall->modifiedDate = $request->modifiedDate;
        $success=$firewall->save();
        
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
        $firewall = Firewall::find($primaryKey);
        if (is_null($firewall)) {
            return Response::json("not found",404);
        }
        return Response::json($firewall,200);
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
        $firewall = Firewall::find($primaryKey);
        $firewall->idFirewall = $request->input('idFirewall');
        $firewall->fk_provider = $request->input('fk_provider');
        $firewall->namaFirewall = $request->input('namaFirewall');
        $firewall->ipFirewall = $request->input('ipFirewall');
        $firewall->fk_merekFW = $request->input('fk_merekFW');
        $firewall->api_ruangFW = $request->input('api_ruangFW');
        $firewall->fk_kondisiFW = $request->input('fk_kondisiFW');
        $firewall->isDeleted = $request->input('isDeleted');
        $firewall->createdBy = $request->input('createdBy');
        $firewall->createdDate = $request->input('createdDate');
        $firewall->modifiedBy = $request->input('modifiedBy');
        $firewall->modifiedDate = $request->input('modifiedDate');
        $success=$firewall->save();
        
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
        $firewall = Firewall::find($primaryKey);
        if (is_null($firewall)) {
            return Response::json("not found",404);
        }

        $firewall->isDeleted = 1;
        $success=$firewall->save();

        if (!$success) {
            return Response::json("error deleting",500);
        }
        return Response::json("success",200);
    }
}
