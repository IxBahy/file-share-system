<?php

namespace App\Http\Controllers;

use App\Drive;
use Illuminate\Http\Request;
use App\Auth;

class DriveController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files=Drive::all();
        return view('drive.index')->with('files',$files);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('drive.create');
    }

    public function public()
    {
        $files=Drive::all();
        return view('drive.public')->with('files',$files);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "title"=>'required|min:4',
            "description"=>'required|min:4',
            "fileInput"=>'required|file|mimes:png,jpg'
        ]);
        $newDrive= new Drive();

        $newDrive->title = $request->title;

        $newDrive->description = $request->description;
        $newDrive->authorID=  $request->authorID;

        $fileData = $request->file('fileInput');

        $fileName = time(). $fileData->getClientOriginalName();

        $destinationPath = public_path() ."/files/" ;

        $fileData->move( $destinationPath , $fileName );


        $newDrive->file= $fileName;

        $newDrive->save();
        return redirect()->back()->with('done','insert True');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Drive  $drive
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $drive=Drive::find($id);
        return view('drive.show')->with('drive',$drive);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Drive  $drive
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $drive=Drive::find($id);
        return view('drive.update')->with('drive',$drive);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Drive  $drive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            "title"=>'required|min:4',
            "description"=>'required|min:4',

        ]);
        $newDrive=Drive::find($id);

        $newDrive->title = $request->title;

        $newDrive->description = $request->description;

        $fileData = $request->file('fileInput');

        if(!empty($fileData)){
            unlink(public_path('files/').$newDrive->file);
            $fileName = time(). $fileData->getClientOriginalName();

            $destinationPath = public_path() ."/files/" ;

            $fileData->move( $destinationPath , $fileName );

            $newDrive->file= $fileName;

        }else{
            $newDrive->file= $newDrive->file;
        }
    
    
    $newDrive->save();
        return redirect('/drive')->with('done','Update True');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Drive  $drive
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newDrive=Drive::find($id);
        unlink(public_path('files/').$newDrive->file);
        $newDrive->delete();
        return redirect('/drive')->with('done','Delete True');
    }


    public function download($id){
        $newDrive=Drive::where('id',$id)->firstOrFail();
        $pathFile=public_path('files/'.$newDrive->file);
        return response()->download($pathFile);
    }

    public function share ($id){
        $drive=Drive::where('id',$id)->firstOrFail();

        if($drive->private==0){
            $drive->private=1;
        }
        else if  ($drive->private==1){
            $drive->private=0;
        };
        $drive->save();
        return redirect('/drive')->with('done',' privacy settings updated');
    }

}
