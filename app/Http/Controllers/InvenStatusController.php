<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\InvenStatus;
use Response;

class InvenStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $invenStatus = InvenStatus::all();
        return Response::json($invenStatus,200);
    }
    public function index(Request $request)
    {
        // $invenStatus = InvenStatus::all();
        // return Response::json($invenStatus,200);
        $InvenStatus = InvenStatus::all();
        if ($request->get('search')) {
            $InvenStatus = InvenStatus::where("idInvenStatus", "LIKE", "{$request->get('search')}%")->paginate(5);
        }else{
            $InvenStatus = InvenStatus::paginate(5);
        }

        $username_ws = "simpeg_master";
        $password_ws = "kertas_kosong";
        foreach ($InvenStatus as $key => $value) {
            
            $api_pegawai = $value["api_pemeriksa"];
            $ws_uri = "http://{$username_ws}:{$password_ws}@api.polinema.ac.id/simpeg/pegawai/format/json?noPeg=".$api_pegawai;

            $ch = curl_init($ws_uri);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_USERPWD, $username_ws.':'.$password_ws);

            $pegawai = curl_exec($ch);
            $pegawai = json_decode($pegawai);
            $pegawai = (array) $pegawai[0]; 
            // username :simpeg_master pass: kertas_kosong
            //api.polinema.c.id/simpeg/master/uker/kodeuker/$api_uker/format/json
            // echo '<pre>'; print_r($pegawai) ;die ();
            if (!empty($pegawai )&& is_array($pegawai)) {
                # code...
                $InvenStatus[$key]['api_pemeriksa']=$pegawai["namaPegawai"];

            }else{
                $InvenStatus[$key]['api_pemeriksa']="kode pegawai tidak ditemukan di api";

            }

        }

        return Response::json($InvenStatus,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invenStatus = new InvenStatus;
        // $invenStatus->idInvenStatus = $request->idInvenStatus;
        $invenStatus->fk_invenMasuk = $request->fk_invenMasuk;
        $invenStatus->kodeItem = $request->kodeItem;
        $invenStatus->tglPemeriksaan = $request->tglPemeriksaan;
        $invenStatus->api_pemeriksa = $request->api_pemeriksa;
        $invenStatus->statusPeriksa = $request->statusPeriksa;
        $invenStatus->isDeleted = $request->isDeleted;
        $invenStatus->createdBy = $request->createdBy;
        $invenStatus->createdDate = $request->createdDate;
        $invenStatus->modifiedBy = $request->modifiedBy;
        $invenStatus->modifiedDate = $request->modifiedDate;
        $success=$invenStatus->save();

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
        $invenStatus = InvenStatus::find($primaryKey);
        if (is_null($invenStatus)) {
            return Response::json("not found",404);
        }
        Response::json($invenStatus,200);
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
    public function update(Request $request, $id)
    {
        $invenStatus = InvenStatus::find($primaryKey);

        $invenStatus->idInvenStatus = $request->input('idInvenStatus');
        $invenStatus->fk_invenMasuk = $request->input('fk_invenMasuk');
        $invenStatus->kodeItem = $request->input('kodeItem');
        $invenStatus->tglPemeriksaan = $request->input('tglPemeriksaan');
        $invenStatus->api_pemeriksa = $request->input('api_pemeriksa');
        $invenStatus->statusPeriksa = $request->input('statusPeriksa');
        $invenStatus->isDeleted = $request->input('isDeleted');
        $invenStatus->createdBy = $request->input('createdBy');
        $invenStatus->createdDate = $request->input('createdDate');
        $invenStatus->modifiedBy = $request->input('modifiedBy');
        $invenStatus->modifiedDate = $request->input('modifiedDate');
        $success=$invenStatus->save();

        if (!$success) {
            return Response::json("error updating",500);
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
        $invenStatus = InvenStatus::find($primaryKey);

        if (is_null($invenStatus)) {
            return Response::json("not found",404);
        }

        $invenStatus->isDeleted = 1;
        $success=$invenStatus->save();

        if (!$success) {
            return Response::json("error deleting",500);
        }
        return Response::json("success",200);
    }
}
