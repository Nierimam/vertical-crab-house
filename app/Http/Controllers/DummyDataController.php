<?php

namespace App\Http\Controllers;

use App\Models\DummyData;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DummyDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DummyData  $dummyData
     * @return \Illuminate\Http\Response
     */
    public function show(DummyData $dummyData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DummyData  $dummyData
     * @return \Illuminate\Http\Response
     */
    public function edit(DummyData $dummyData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DummyData  $dummyData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DummyData $dummyData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DummyData  $dummyData
     * @return \Illuminate\Http\Response
     */
    public function destroy(DummyData $dummyData)
    {
        //
    }

    public function insertData()
    {
        $data = new DummyData();
        $data->do = rand(5, 10); // Dummy data
        $data->tds = rand(250, 350); // Dummy data
        $data->amonia = rand(0, 1) / 100; // Dummy data
        $data->suhu = rand(20, 30); // Dummy data
        $data->salinitas = rand(30, 40); // Dummy data
        $data->ph = rand(7, 8); // Dummy data
        $data->created_at = Carbon::now();
        $data->save();

        return response()->json(['message' => 'Data inserted successfully']);
    }

    public function fetchData()
    {
        $latestData = DummyData::orderBy('created_at', 'desc')->first();
        return response()->json($latestData);
    }

    public function fetchDataAll()
    {
        $data = DummyData::orderBy('created_at', 'desc')->limit(5)->get();
        $result = [
            'do' => [],
            'tds' => [],
            'amonia' => [],
            'suhu' => [],
            'salinitas' => [],
            'ph' => [],
        ];
        foreach ($data as $key => $value) {
            $result['do'][] = $value->do;
            $result['tds'][] = $value->tds;
            $result['amonia'][] = $value->amonia;
            $result['suhu'][] = $value->suhu;
            $result['salinitas'][] = $value->salinitas;
            $result['ph'][] = $value->suhu;
        }
        return response()->json($result);
    }
}
