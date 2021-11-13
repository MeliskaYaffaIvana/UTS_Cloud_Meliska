<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Oracle;

class gambarController extends Controller
{   
     public function oracle()
    {
        $data = new Oracle;
        return $data;
    }
    
    public function uploadFile(Request $request, $fileName)
    {
            $result ='';
            $file = $request->file($fileName);
            $name = $file->getClientOriginalName();
            // $tmp_name = $file['tmp_name'];

            $extension = explode('.',$name);
            $extension = strtolower(end($extension));

            $key = rand().'-'. $fileName;
            $tmp_file_name = "{$key}.{$extension}";
            $tmp_file_path = "tempat-gambar/";
            $file->move($tmp_file_path,$tmp_file_name);

            $result = 'tempat-gambar'.'/'.$tmp_file_name;
        return $result;
    }

    public function index()
    {
        $data= DB::table('gambar')->get();
        return view('index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $foto = $this->uploadFile($request, 'foto');
        $file_name = $foto;
        $upOracle = $this->oracle()->upFileOracle($file_name);
        DB::table('gambar')->insert(
            [
            'foto'=>$upOracle['message'],
            ]
        );
        return redirect()->route('gambar.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
