<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin-manager');

    }
    
    public function index(){
        $menu = view('dashboard.menubar');
        $datas = Event::orderBy('created_at', 'desc')->get();
        
        $content = view('dashboard.event.index',compact('datas'));
        return view('dashboard', compact('menu','content'));
    }

    public function create(){
        $model = new Event;
        $menu = view('dashboard.menubar');
        $content = view('dashboard.event.form',compact('model'));
        return view('dashboard', compact('menu','content'));
    }

    public function store(Request $request){
        $validator = Validator::make( $request->all(), [
                'judul' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'quota' => 'required'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }else{
            $data = new Event();
            $data->judul_event = $request->judul;
            $data->quota_event = $request->quota;
            $data->detail_event = $request->detail_event;
            $data->tgl_akhir_daftar = $request->tgl_akhir_daftar;
            $data->tgl_mulai_event = $request->tgl_mulai_event;
            $data->jam_mulai_event = $request->jam_mulai_event;
            $data->tgl_selesai_event = $request->tgl_selesai_event;
            $data->jam_selesai_event = $request->jam_selesai_event;
            $data->jenis_event = ($request->has('jenis_event'))? '1': '0';
            
            $image = $request->image;
            $imageName = Str::slug($request->judul, '-').'-'.date('dmYHis').rand(0, 99999).'.'.$image->guessExtension();
            $upload = $image->move(public_path('uploads/event'), $imageName);
            $data->image = $imageName;

            $data->save();
            alert()->success('Good Job', 'Successfully added a post !!');
            return redirect()->route('event.index')->with('message', 'Berhasil tambah data');
        }
    }

    public function edit($id)
    {
        $model = Event::findOrFail($id);
        $menu = view('dashboard.menubar');
        $content = view('dashboard.event.form',compact('model'));
        return view('dashboard', compact('menu','content'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make( $request->all(), [
                'judul' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg|max:2048',
                'quota' => 'required'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }else{
            
            $data = Event::findOrFail($id);
            $data->judul_event = $request->judul;
            $data->quota_event = $request->quota;
            $data->detail_event = $request->detail_event;
            $data->tgl_akhir_daftar = $request->tgl_akhir_daftar;
            $data->tgl_mulai_event = $request->tgl_mulai_event;
            $data->jam_mulai_event = $request->jam_mulai_event;
            $data->tgl_selesai_event = $request->tgl_selesai_event;
            $data->jam_selesai_event = $request->jam_selesai_event;
            $data->jenis_event = ($request->has('jenis_event'))? '1': '0';

            if ($request->has('image')) {
                $path = 'uploads/event/';
                if (file_exists(public_path($path.$data->image)) && !is_null($data->image) && $data->image != '') {
                    $del_image = unlink(public_path($path.$data->image));
                }

                //Upload new image
                $image = $request->image;

                $imageName = Str::slug($request->judul, '-').'-'.date('dmYHis').rand(0, 99999).'.'.$image->guessExtension();
                $upload = $image->move(public_path($path), $imageName);

                $data->image = $imageName;
            }

            $data->save();
            alert()->success('Good Job', 'Successfully added a post !!');
            return redirect()->route('event.index')->with('message', 'Berhasil edit data');
        }
    }

    public function show($id)
    {
        //Delete
        $data = Event::findOrFail($id);
        
        $path = 'uploads/event/';
        if (file_exists(public_path($path.$data->image)) && !is_null($data->image) && $data->image != '') {
            $del_image = unlink(public_path($path.$data->image));
        }else{
            $del_image = true;
        }

        if ($del_image) {
            $data->delete();
            return redirect()->route('event.index')->with('message', 'Berhasil hapus data');
        }else{
            return redirect()->route('event.index')->with('message', 'Delete image error : '.$del_image);
        }
        
    }

    public function destroy($id)
    {
        return 'delete';
    }

}
