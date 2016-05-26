<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Penanganan;
use App\NamaForm;
use Response;

class PenangananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $Penanganan = Penanganan::all();
        return Response::json($Penanganan,200);
    }

    public function index(Request $request)
    {
        // $penanganan = Penanganan::all();
        // return Response::json($penanganan,200);
        $penanganan = Penanganan::all();
        if ($request->get('search')) {
            $penanganan = Penanganan::where("idPenanganan", "LIKE", "{$request->get('search')}%")->paginate(5);
        }else{
            $penanganan = Penanganan::paginate(5);
        }

        foreach ($penanganan as $key => $value) {
            // $fk_provider = $value["fk_provider"];
            $NamaForm = NamaForm::all();
            $NamaForm = json_decode($NamaForm);
            $NamaForm = (array) $NamaForm[0]; 
            // echo '<pre>'; print_r($NamaForm) ;die ();
            if (!empty($NamaForm )&& is_array($NamaForm)) {
                $penanganan[$key]['fk_jenisForm']=$NamaForm["namaForm"];
            }else{
                $penanganan[$key]['fk_jenisForm']="kode form tidak ditemukan di api";
            }
        }
        return Response::json($penanganan,200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $penanganan = new Penanganan;
        // $penanganan->idPenanganan = $request->idPenanganan;
        $penanganan->fk_gangguan = $request->fk_gangguan;
        $penanganan->fk_jenisForm = $request->fk_jenisForm;
        $penanganan->tglPenanganan = $request->tglPenanganan;
        $penanganan->api_teknisi = $request->api_teknisi;
        $penanganan->uraianPenanganan = $request->uraianPenanganan;
        $penanganan->isDeleted = $request->isDeleted;
        $penanganan->createdBy = $request->createdBy;
        $penanganan->createdDate = $request->nomerForm;
        $penanganan->modifiedBy = $request->modifiedBy;
        $penanganan->modifiedDate = $request->modifiedDate;
        $success=$penanganan->save();


        if (!$success) {
            return Response::json("error saving",500);
        }
        return Response::json("succes",200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($primaryKey)
    {
        $penanganan = Penanganan::find($primaryKey);
        if (is_null($penanganan)) {
            return Response::json("not found",404);
        }
        return Response::json($penanganan,200);
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
        $penanganan = Penanganan::find($primaryKey);
        $penanganan->idPenanganan = $request->input('idPenanganan');
        $penanganan->fk_gangguan = $request->input('fk_gangguan');
        $penanganan->fk_jenisForm = $request->input('fk_jenisForm');
        $penanganan->tglPenanganan = $request->input('tglPenanganan');
        $penanganan->api_teknisi = $request->input('api_teknisi');
        $penanganan->uraianPenanganan = $request->input('uraianPenanganan');
        $penanganan->isDeleted = $request->input('isDeleted');
        $penanganan->createdBy = $request->input('createdBy');
        $penanganan->createdDate = $request->input('nomerForm');
        $penanganan->modifiedBy = $request->input('modifiedBy');
        $penanganan->modifiedDate = $request->input('modifiedDate');
        $success=$penanganan->save();

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
        $penanganan = Penanganan::find($primaryKey);
        if (is_null($penanganan)) {
            return Response::json("not found",404);
        }

        $penanganan->isDeleted = 1;
        $success=$penanganan->save();

        if (!$success) {
            return Response::json("error deleting",500);
        }
        return Response::json("success",200);
    }
}
