<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Provider;
use Response;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $Provider = Provider::all();
        return Response::json($Provider,200);
    }

    public function index(Request $request)
    {
        // $provider = Provider::all();
        // return Response::json($provider,200);
        $provider = Provider::all();
        if ($request->get('search')) {
            $provider = Provider::where("idProvider", "LIKE", "{$request->get('search')}%")->paginate(5);
        }else{
            $provider = Provider::paginate(5);
        }
        return Response::json($provider,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $provider = new Provider;
        // $provider->idProvider = $request->idProvider;
        $provider->namaProvider = $request->namaProvider;
        $provider->isDeleted = $request->isDeleted;
        $provider->createdBy = $request->createdBy;
        $provider->createdDate = $request->createdDate;
        $provider->modifiedBy = $request->modifiedBy;
        $provider->modifiedDate = $request->modifiedDate;
        $success=$provider->save();
        
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
        $provider = Provider::find($primaryKey);
        if (is_null($provider)) {
            return Response::json("not found",404);
        }
        return Response::json($provider,200);
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
        $provider= Provider::find($primaryKey);
        $provider->idProvider = $request->input('idProvider');
        $provider->namaProvider = $request->input('namaProvider');
        $provider->isDeleted = $request->input('isDeleted');
        $provider->createdBy = $request->input('createdBy');
        $provider->createdDate = $request->input('createdDate');
        $provider->modifiedBy = $request->input('modifiedBy');
        $provider->modifiedDate = $request->input('modifiedDate');
        $success=$provider->save();
        
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
        $provider = Provider::find($primaryKey);
        if (is_null($provider)) {
            return Response::json("not found",404);
        }
            
        $barangInven->isDeleted = 1;
        $success=$provider->save();

        if (!$success) {
            return Response::json("error deleting",500);
        }
        return Response::json("success",200);
    }
}
