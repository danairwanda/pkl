<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Gangguan;
use App\NamaForm;
use Response;

class GangguanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function getAll()
    {
        $Gangguan = Gangguan::all();
        return Response::json($Gangguan,200);
    }

    public function index(Request $request)
    {
        // $gangguan = Gangguan::all();
        // return Response::json($gangguan,200);
        $gangguan = Gangguan::all();
        if ($request->get('search')) {
            $gangguan = Gangguan::where("idGangguan", "LIKE", "{$request->get('search')}%")->paginate(5);
        }else{
            $gangguan = Gangguan::paginate(5);
        }

        foreach ($gangguan as $key => $value) {
            // $fk_provider = $value["fk_provider"];
            $NamaForm = NamaForm::all();
            $NamaForm = json_decode($NamaForm);
            $NamaForm = (array) $NamaForm[0]; 
            // echo '<pre>'; print_r($NamaForm) ;die ();
            if (!empty($NamaForm )&& is_array($NamaForm)) {
                $gangguan[$key]['fk_jenisForm']=$NamaForm["namaForm"];
            }else{
                $gangguan[$key]['fk_jenisForm']="kode form tidak ditemukan di api";
            }
        }
        return Response::json($gangguan,200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gangguan = new Gangguan;
        // $gangguan->idGangguan = $request->idGangguan;
        $gangguan->fk_jenisForm = $request->fk_jenisForm;
        $gangguan->tglMasukLaporan = $request->tglMasukLaporan;
        $gangguan->namaPelapor = $request->namaPelapor;
        $gangguan->api_pelapor = $request->api_pelapor;
        $gangguan->api_fkRuang = $request->api_fkRuang;
        $gangguan->penerimaLaporan = $request->penerimaLaporan;
        $gangguan->uraianGangguan = $request->uraianGangguan;
        $gangguan->sudahDitangani = $request->sudahDitangani;
        $gangguan->cetakGangguan = $request->cetakGangguan;
        $gangguan->isDeleted = $request->isDeleted;
        $gangguan->createdBy = $request->createdBy;
        $gangguan->createdDate = $request->nomerForm;
        $gangguan->modifiedBy = $request->modifiedBy;
        $gangguan->modifiedDate = $request->modifiedDate;
        $success=$gangguan->save();


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
        $gangguan = Gangguan::find($primaryKey);
        if (is_null($gangguan)) {
            return Response::json("not found",404);
        }
        return Response::json($gangguan,200);
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
        $gangguan = Gangguan::find($primaryKey);
        $gangguan->idGangguan = $request->input('idGangguan');
        $gangguan->fk_jenisForm = $request->input('fk_jenisForm');
        $gangguan->tglMasukLaporan = $request->input('tglMasukLaporan');
        $gangguan->namaPelapor = $request->input('namaPelapor');
        $gangguan->api_pelapor = $request->input('api_pelapor');
        $gangguan->api_fkRuang = $request->input('api_fkRuang');
        $gangguan->penerimaLaporan = $request->input('penerimaLaporan');
        $gangguan->uraianGangguan = $request->input('uraianGangguan');
        $gangguan->sudahDitangani = $request->input('sudahDitangani');
        $gangguan->cetakGangguan = $request->input('cetakGangguan');
        $gangguan->isDeleted = $request->input('isDeleted');
        $gangguan->createdBy = $request->input('createdBy');
        $gangguan->createdDate = $request->input('nomerForm');
        $gangguan->modifiedBy = $request->input('modifiedBy');
        $gangguan->modifiedDate = $request->input('modifiedDate');
        $success=$gangguan->save();

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
        $gangguan = Gangguan::find($primaryKey);
        if (is_null($gangguan)) {
            return Response::json("not found",404);
        }

        $gangguan->isDeleted = 1;
        $success=$gangguan->save();

        if (!$success) {
            return Response::json("error deleting",500);
        }
        return Response::json("success",200);
    }
}
