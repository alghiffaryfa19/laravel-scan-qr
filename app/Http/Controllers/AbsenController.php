<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Absen;

class AbsenController extends Controller
{
    public function generateInvoice()
{
    $daftar = Absen::all();
    return view('invoice.print', compact('daftar'));
    

    
}
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(Absen::latest()->get())
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('absen.index');
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
        $rules = array(
            
            'nama'     =>  'required',
            'asal'     =>  'required',
            'user_id'     =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $user_id = rand();

        $form_data = array(
            'user_id' => $request->user_id,
            'nama'         =>  $request->nama,
            'asal'         =>  $request->asal
        );

        Absen::create($form_data);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Absen::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
            $rules = array(
                'nama'     =>  'required',
            'asal'     =>  'required',
            'user_id'     =>  'required'
            );

            $error = Validator::make($request->all(), $rules);

            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }

        $form_data = array(
            'nama' => $request->nama,
            'asal'         =>  $request->asal,
            'user_id'         =>  $request->user_id
        );
        Absen::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Absen::findOrFail($id);
        $data->delete();
    }
}
