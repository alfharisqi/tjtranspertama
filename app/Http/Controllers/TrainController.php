<?php

namespace App\Http\Controllers;

use App\Models\Train;
use Illuminate\Http\Request;

class TrainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.train.index', [
            'trains' => Train::all()
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
        $validatedData = $request->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'peron' => ['required', 'min:3', 'max:10'],
        ]);

        $check = Train::where('name', $validatedData['name'])->first();

        if ($check) {
            return redirect('/trains')->with('sameTrain', 'Maskapai tersebut sudah ada di database!');
        }

        Train::create($validatedData);

        return redirect('/trains')->with('store', 'Data Maskapai Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Train  $train
     * @return \Illuminate\Http\Response
     */
    public function show(Train $train)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Train  $train
     * @return \Illuminate\Http\Response
     */
    public function edit(Train $train)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Train  $train
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Train $train)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'peron' => ['required', 'min:1', 'max:3'],
        ]);

        $check = Train::where('id', '!=', $train->id)->where('name', $validatedData['name'])->where('peron', $validatedData['peron'])->first();

        if ($check) {
            return redirect('/trains')->with('sameTrain', 'Maskapai tersebut sudah ada di database!');
        }

        $train->update($validatedData);

        return redirect('/trains')->with('update', 'Data Maskapai Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Train  $train
     * @return \Illuminate\Http\Response
     */
    public function destroy(Train $train)
    {
        $train->delete();
        return redirect('/trains')->with('delete', 'Data Maskapai Berhasil Dihapus');
    }
}
