<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\InvenMasuk;
use App\BarangInven;
use App\NamaForm;
use Response;

class InvenMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $InvenMasuk = InvenMasuk::all();
        return Response::json($InvenMasuk,200);
    }

    public function index(Request $request)
    {
        // $invenMasuk = InvenMasuk::all();
        // return Response::json($invenMasuk,200);
        $InvenMasuk = InvenMasuk::all();
        if ($request->get('search')) {
            $InvenMasuk = InvenMasuk::where("idInvenMasuk", "LIKE", "{$request->get('search')}%")->paginate(5);
        }else{
            $InvenMasuk = InvenMasuk::paginate(5);
        }

        $username_ws = "simpeg_master";
        $password_ws = "kertas_kosong";
        foreach ($InvenMasuk as $key => $value) {
    
            $api_uker = $value["api_uker"];
            $ws_uri = "http://{$username_ws}:{$password_ws}@api.polinema.ac.id/simpeg/master/uker/format/json?kodeuker=".$api_uker;

            $ch = curl_init($ws_uri);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_USERPWD, $username_ws.':'.$password_ws);

            $result_api_polinema = curl_exec($ch);
            $result_api_polinema = json_decode($result_api_polinema);
            $result_api_polinema = (array) $result_api_polinema[0]; 
            // username :simpeg_master pass: kertas_kosong
            //api.polinema.c.id/simpeg/master/uker/kodeuker/$api_uker/format/json
            // echo '<pre>'; print_r($result_api_polinema) ;die ();
            if (!empty($result_api_polinema )&& is_array($result_api_polinema)) {
                # code...
                $InvenMasuk[$key]['api_uker']=$result_api_polinema["namaUker"];

            }else{
                $InvenMasuk[$key]['api_uker']="kode uker tidak ditemukan di api";

            }
        }

        foreach ($InvenMasuk as $key => $value) {
        
            $api_pegawai = $value["api_penerima"];
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
                $agendaKerja[$key]['api_penerima']=$pegawai["namaPegawai"];

            }else{
                $agendaKerja[$key]['api_penerima']="kode uker tidak ditemukan di api";

            }

        }



            foreach ($InvenMasuk as $key => $value) {
                $barangInven = BarangInven::all();
                $barangInven = json_decode($barangInven);
                $barangInven = (array) $barangInven[0]; 
                if (!empty($barangInven )&& is_array($barangInven)) {
                    $InvenMasuk[$key]['fk_barang']=$barangInven["namaBarang"];
                }else{
                    $InvenMasuk[$key]['fk_barang']="kode barang tidak ditemukan di api";
                }

            }

            foreach ($InvenMasuk as $key => $value) {
                $NamaForm = NamaForm::all();
                $NamaForm = json_decode($NamaForm);
                $NamaForm = (array) $NamaForm[0]; 
                if (!empty($NamaForm )&& is_array($NamaForm)) {
                    $InvenMasuk[$key]['fk_form']=$NamaForm["namaForm"];
                }else{
                    $InvenMasuk[$key]['fk_form']="kode form tidak ditemukan di api";
                }

            }
        return Response::json($InvenMasuk,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invenMasuk = new InvenMasuk;
        // $invenMasuk->idInvenMasuk = $request->idInvenMasuk;
        $invenMasuk->fk_form = $request->fk_form;
        $invenMasuk->api_uker = $request->api_uker;
        $invenMasuk->fk_barang = $request->fk_barang;
        $invenMasuk->jumlah = $request->jumlah;
        $invenMasuk->api_penJawab = $request->api_penJawab;
        $invenMasuk->api_penerima = $request->api_penerima;
        $invenMasuk->nomor = $request->nomor;
        $invenMasuk->keterangan = $request->keterangan;
        $invenMasuk->isDelete = $request->isDelete;
        $invenMasuk->createdBy = $request->createdBy;
        $invenMasuk->createdDate = $request->createdDate;
        $invenMasuk->modifiedBy = $request->modifiedBy;
        $invenMasuk->modifiedDate = $request->modifiedDate;
        $success=$invenMasuk->save();

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
        $invenMasuk = InvenMasuk::find($primaryKey);
        if (is_null($invenMasuk)) {
            return Response::json('not found',404);
        }
        return Response::json($invenMasuk,200);
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
        $invenMasuk = InvenMasuk::find($primaryKey);

        $invenMasuk->idInvenMasuk = $request->input('idInvenMasuk');
        $invenMasuk->fk_form = $request->input('fk_form');
        $invenMasuk->api_uker = $request->input('api_uker');
        $invenMasuk->fk_barang = $request->input('fk_barang');
        $invenMasuk->jumlah = $request->input('jumlah');
        $invenMasuk->api_penJawab = $request->input('api_penJawab');
        $invenMasuk->api_penerima = $request->input('api_penerima');
        $invenMasuk->nomor = $request->input('nomor');
        $invenMasuk->keterangan = $request->input('keterangan');
        $invenMasuk->isDelete = $request->input('isDelete');
        $invenMasuk->createdBy = $request->input('createdBy');
        $invenMasuk->createdDate = $request->input('createdDate');
        $invenMasuk->modifiedBy = $request->input('modifiedBy');
        $invenMasuk->modifiedDate = $request->input('modifiedDate');
        $success=$invenMasuk->save();

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
        $invenMasuk = InvenMasuk::find($primaryKey);

        if (is_null($invenMasuk)) {
            return Response::json("not found",404);
        }

        $invenMasuk->isDelete = 1;
        $success=$invenMasuk->save();

        if (!$success) {
            return Response::json("error deleting",500);
        }
        return Response::json("success",200);

    }
}
