<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Daftar;
use Mail;

class DaftarController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(Daftar::latest()->get())
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('daftar.index');
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
            
            'name'     =>  'required',
            'email'     =>  'required',
            'sekolah'     =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $user_id = rand();

        $form_data = array(
            'user_id' => $user_id,
            'name'         =>  $request->name,
            'email'         =>  $request->email,
            'sekolah'         =>  $request->sekolah
        );

        Daftar::create($form_data);

        try{
            Mail::send('isiemail', ['userid' => $user_id, 'namane' => $request->name,], function ($message) use ($request)
        {
            $message->subject('Halooooo');
            $message->from('fiksionera@gmail.com', 'BOT FIKSIONER');
            $message->to($request->email);
        });
        }
        catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
        }

        return response()->json(['success' => 'Data Added successfully.']);
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
            $data = Daftar::findOrFail($id);
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
                'name'     =>  'required',
            'email'     =>  'required',
            'sekolah'     =>  'required'
            );

            $error = Validator::make($request->all(), $rules);

            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }

        $form_data = array(
            'user_id' => $request->user_id,
            'name'         =>  $request->name,
            'email'         =>  $request->email,
            'sekolah'         =>  $request->sekolah
        );
        Daftar::whereId($request->hidden_id)->update($form_data);

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
        $data = Daftar::findOrFail($id);
        $data->delete();
    }
}
