<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\NamaForm;
use Response;

class NamaFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $NamaForm = NamaForm::all();
        return Response::json($NamaForm,200);
    }

    public function index(Request $request)
    {
        // $namaForm = NamaForm::all();
        // return Response::json($namaForm,200);
        $NamaForm = NamaForm::all();
        if ($request->get('search')) {
            $NamaForm = NamaForm::where("idNamaForm", "LIKE", "{$request->get('search')}%")->paginate(5);
        }else{
            $NamaForm = NamaForm::paginate(5);
        }

        $username_ws = "simpeg_master";
        $password_ws = "kertas_kosong";
        foreach ($NamaForm as $key => $value) {
            # code...

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
                $NamaForm[$key]['api_uker']=$result_api_polinema["namaUker"];

            }else{
                $NamaForm[$key]['api_uker']="kode uker tidak ditemukan di api";

            }

        }
        return Response::json($NamaForm,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $namaForm = new NamaForm;
        // $namaForm->idNamaForm = $request->idNamaForm;
        $namaForm->api_uker = $request->api_uker;
        $namaForm->nomerForm = $request->nomerForm;
        $namaForm->namaForm = $request->namaForm;
        $namaForm->template = $request->template;
        $namaForm->isDeleted = $request->isDeleted;
        $namaForm->createdBy = $request->createdBy;
        $namaForm->createdDate = $request->nomerForm;
        $namaForm->modifiedBy = $request->modifiedBy;
        $namaForm->modifiedDate = $request->modifiedDate;
        $success=$namaForm->save();

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
        $namaForm = NamaForm::find($primaryKey);
        if (is_null($namaForm)) {
            return Response::json("not found",404);
        }
        return Response::json($namaForm,200);
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
        $namaForm = NamaForm::find($primaryKey);
        $namaForm->idNamaForm = $request->input('idNamaForm');
        $namaForm->api_uker = $request->input('api_uker');
        $namaForm->nomerForm = $request->input('nomerForm');
        $namaForm->namaForm = $request->input('namaForm');
        $namaForm->template = $request->input('template');
        $namaForm->isDeleted = $request->input('isDeleted');
        $namaForm->createdBy = $request->input('createdBy');
        $namaForm->createdDate = $request->input('nomerForm');
        $namaForm->modifiedBy = $request->input('modifiedBy');
        $namaForm->modifiedDate = $request->input('modifiedDate');
        $success=$namaForm->save();

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
        $namaForm = NamaForm::find($primaryKey);
        if (is_null($namaForm)) {
            return Response::json("not found",404);
        }

        $namaForm->isDeleted = 1;
        $success=$namaForm->save();

        if (!$success) {
            return Response::json("error deleting",500);
        }
        return Response::json("success",200);
    }

}
