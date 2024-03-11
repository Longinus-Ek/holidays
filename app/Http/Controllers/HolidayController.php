<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Holiday;
use Yajra\DataTables\DataTables;

class HolidayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.holiday.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $holiday = Holiday::all();

        return DataTables::of($holiday)
            ->addColumn('action', function($item){
                return '<div style="text-align: center">
                            <a type="button" class="info_bubble" title="Editar" onclick="opentabCadastroPortaCliche(\''.$item['_id'].'\')"><i class="fa-regular fa-pen-to-square" style="color: var(--menu-primary); font-size: 25px;"></i></a>
                        </div>';
            })
            ->addColumn('action', function($item){
                return date_format($item->date, 'd/m/Y');
            })
            ->make(true);
    }

    public function validateHoliday($request)
    {
        $request->validate([
            'title' => 'required|max:200',
            'description' => 'required',
            'date' => 'required',
            'location' => 'required',
        ], [
            'title.required' => 'You need to provide the title',
            'description.required' => 'You need to provide the description',
            'date.required' => 'You need to provide the date',
            'location.required' => 'You need to provide the location',
        ]);
    }
    public function attrHoliday($holiday, $request)
    {
        $holiday->title = $request->title;
        $holiday->description = $request->description;
        $holiday->date = $request->date;
        $holiday->location = $request->location;
        $holiday->participants = $request->participants;
        $holiday->save();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            
            $this->validateHoliday($request);
            $holidat = new Holiday();
            $this->attrHoliday($holiday, $request);
            return response()->json(['success' => true, 'message' => 'Holiday has been created!']);
        }catch(Exception $e){
            return response()->json(['error' => true, 'message' => 'Error on create holiday!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Holiday::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $this->validateHoliday($request);
            $holiday = Holiday::find($id);
            $this->attrHoliday($holiday, $request);
            return response()->json(['success' => true, 'message' => 'Holiday has been updated!']);
        }catch(Exception $e){
            return response()->json(['error' => true, 'message' => 'Error on update holiday!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $holiday = Holiday::find($id);
            $holiday->delete();
            return response()->json(['success' => true, 'message' => 'Holiday has been deleted!']);
        }catch(Exception $e){
            return response()->json(['error' => true, 'message' => 'Error on delete holiday!']);
        }
    }
}
