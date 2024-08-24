<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\Farmer;
use App\Models\produks;
use Illuminate\Http\Request;

class FarmerController extends Controller
{
    protected $database;
    public function __construct()
    {
        $this->database = app('firebase.database');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $farmers = Farmer::where('id', '!=', 0);
        if (isset($search) && !empty($search)) {
            $farmers->where('nama_farmer', 'like', '%' . $search . '%');
        }

        $farmers = $farmers->paginate(10);
        return view('admin.farmer.index',[
            'farmers' => $farmers,
            'search' => $search
        ]);
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
     * @param  \App\Models\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function show(Farmer $farmer)
    {
        return view('admin.farmer.show',[
            'farmer' => $farmer
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function edit(Farmer $farmer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Farmer $farmer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Farmer $farmer)
    {
        Farmer::destroy($farmer->id);
        return response()->json(['message' => 'Berhasil Menghapus Data Farmer !']);
    }

    public function changeStatus($id){
        $farmer = Farmer::find($id);
        if ($farmer->isConfirm == 1) {
            $farmer->isConfirm = 0;
            $farmer->save();
            return response()->json(['message' => 'Berhasil Mengubah Status Farmer Menjadi NonAktif!']);
        }else{
            $farmer->isConfirm = 1;
            $farmer->save();
            return response()->json(['message' => 'Berhasil Mengubah Status Farmer Menjadi Aktif!']);
        }
    }

    public function showFarmerDashboard(Request $request,$id){


        $referenceHistory = $this->database->getReference('/history');
        $snapshotHistory = $referenceHistory->getSnapshot();
        $dataHistory = $snapshotHistory->getValue();

        $referenceRealtime = $this->database->getReference('/realtime');
        $snapshotRealtime = $referenceRealtime->getSnapshot();
        $dataRealtime = $snapshotRealtime->getValue();

        $no = 0;
        $result = [
            'dissolved_oxygen' => [],
            'nitrite' => [],
            'ph' => [],
            'salinity' => [],
            'temperature' => [],
            'total_ammonia_nitrogen' => [],
            'unionized_ammonia' => [],
            'datetime' => [],
        ];

        foreach (array_reverse($dataHistory, true) as $key => $value) {
            if ($no < 5) {
                    $result['dissolved_oxygen'][] = $value['dissolved_oxygen'];
                    $result['nitrite'][] = $value['nitrite'];
                    $result['ph'][] = $value['ph'];
                    $result['salinity'][] = $value['salinity'];
                    $result['temperature'][] = $value['temperature'];
                    $result['total_ammonia_nitrogen'][] = $value['total_ammonia_nitrogen'];
                    $result['unionized_ammonia'][] = $value['unionized_ammonia'];
                    $result['datetime'][] = $value['Date'] . ' ' . $value['Time'];
                $no++;
            }
        }
        $farmer = Farmer::find($id);
        $month = $request->month ?? '';
        return view('admin.farmer.dashboard-farmer',[
            'farmer' => $farmer,
            'month' => $month,
            'dataRealtime' => $dataRealtime,
            'result' => json_encode($result),
        ]);
    }

    public function farmerHistory(Request $request){

        $referenceHistory = $this->database->getReference('/history');
        $snapshotHistory = $referenceHistory->getSnapshot();
        $dataHistory = $snapshotHistory->getValue();
        return view('admin.farmer.history',[
            'dataHistorys' => array_reverse($dataHistory, true)
        ]);
    }
}
