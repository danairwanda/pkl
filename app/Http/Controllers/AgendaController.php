<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AgendaKerja;
use Response;
use DB;
// use JWTAuth;
// use Tymon\JWTAuth\Exceptions\JWTException;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->middleware('jwt.auth', ['except' => ['authenticate']]);
    // }
     public function getAll()
    {
        $AgendaKerja = AgendaKerja::all();
        return Response::json($AgendaKerja,200);
    }
    
    public function index(Request $request)
    {
        
        if ($request->get('search')) {
            $agendaKerja = AgendaKerja::where("idAgendaKerja", "LIKE", "{$request->get('search')}%")->paginate(5);
        }else{
            $agendaKerja = AgendaKerja::where('isDeleted', 0)->paginate(5);
            // $agendaKerja = DB::table('agenda_kerja')->get();
        }

        $username_ws = "simpeg_master";
        $password_ws = "kertas_kosong";
        foreach ($agendaKerja as $key => $value) {
        
            $api_uker = $value["api_uker"];
            $ws_uri = "http://{$username_ws}:{$password_ws}@api.polinema.ac.id/simpeg/master/uker/format/json?kodeuker=".$api_uker;
            // $ws_uri = "http://{$username_ws}:{$password_ws}@api.polinema.ac.id/simpeg/pegawai/format/json?noPeg=".$api_uker;

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
                $agendaKerja[$key]['api_uker']=$result_api_polinema["namaUker"];

            }else{
                $agendaKerja[$key]['api_uker']="kode uker tidak ditemukan di api";

            }

        }

        foreach ($agendaKerja as $key => $value) {
        
            $param = $value["api_pegawai"];
            $ws_uri = "http://{$username_ws}:{$password_ws}@api.polinema.ac.id/simpeg/pegawai/daftar/format/json?noPeg=".$param;

            $ch = curl_init($ws_uri);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_USERPWD, $username_ws.':'.$password_ws);

            $result_api_polinema = curl_exec($ch);
            $result_api_polinema = json_decode($result_api_polinema);
            $result_api_polinema = array($result_api_polinema); 
            $result_api_polinema = (array) $result_api_polinema[0]->arr_data->$param; 
            if (!empty($result_api_polinema )&& is_array($result_api_polinema)) {
                # code...
                $agendaKerja[$key]['api_pegawai']=$result_api_polinema["namaPegawai"];

            }else{
                $agendaKerja[$key]['api_pegawai']="kode pegawai tidak ditemukan di api";

            }
        }
 

        return Response::json($agendaKerja,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $agenda = new AgendaKerja();
        // $agenda->idAgendaKerja = $agenda->newPrimaryKey('idAgendaKerja', 'agen'.date('Y').date('m'), 5);
        $agenda->api_uker = $request->api_uker;
        $agenda->api_pegawai = $request->api_pegawai;
        $agenda->tglAgenda = $request->tglAgenda;
        $agenda->rekapAgenda = $request->rekapAgenda;
        $agenda->isDeleted = $request->isDeleted;
        $agenda->createdBy = $request->createdBy;
        $agenda->createdDate = $request->createdDate;
        $agenda->modifiedBy = $request->modifiedBy;
        $agenda->modifiedDate = $request->modifiedDate;
        $success=$agenda->save();
        // return Response::json("error saving",500);
        // die();
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
        $agenda = AgendaKerja::find($primaryKey);
        if (is_null($agenda)) {
            return Response::json("not found",404);
        }
        return Response::json($agenda,200);
        
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
        $agenda = AgendaKerja::find($primaryKey);
        $agenda->idAgendaKerja = $request->input('idAgendaKerja');
        $agenda->api_uker = $request->input('api_uker');
        $agenda->api_pegawai = $request->input('api_pegawai');
        $agenda->tglAgenda = $request->input('tglAgenda');
        $agenda->rekapAgenda = $request->input('rekapAgenda');
        $agenda->isDeleted = $request->input('isDeleted');
        $agenda->createdBy = $request->input('createdBy');
        $agenda->createdDate = $request->input('createdDate');
        $agenda->modifiedBy = $request->input('modifiedBy');
        $agenda->modifiedDate = $request->input('modifiedDate');
        $success=$agenda->save();

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
        $agenda = AgendaKerja::find($primaryKey);
        if (is_null($agenda)) {
            return Response::json("not found",404);
        }
        $agenda->isDeleted = 1;
        $success=$agenda->save();

        if (!$success) {
            return Response::json("error deleting",500);
        }
        return Response::json("success",200);
    }
}
