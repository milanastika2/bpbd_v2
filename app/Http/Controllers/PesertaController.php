<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Peserta;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PesertaController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin-manager');

    }
    
    public function index(Request $request){
        $event = Event::findOrFail($request->id);
        $datas = Peserta::join('event', 'event.id', '=', 'peserta_event.id_event')
            ->where('event.id', $event->id)
            ->get();

        $menu = view('dashboard.menubar');
        $content = view('dashboard.event.peserta',compact('datas', 'event'));
        return view('dashboard', compact('menu','content'));
    }

    public function create(Request $request){
        $event = Event::findOrFail($request->id);
        $model = new Peserta;
        $menu = view('dashboard.menubar');
        $content = view('dashboard.event.peserta_form',compact('model', 'event'));
        return view('dashboard', compact('menu','content'));
    }

    public function store(Request $request){
        $validator = Validator::make( $request->all(), [
                'nama_peserta' => 'required',
                'email_peserta' => 'required',
                'no_hp_peserta' => 'required'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }else{
            //count quota event
            $event = Event::findOrFail($request->id_event);
            $quota = $event->quota_event;

            //total peserta terakhir
            $total = Peserta::where('id_event', $request->id_event)->count();
            $total = $total + 1;

            if($total <= $quota){
                $data = new Peserta();
                $data->id_event = $request->id_event;
                $data->nama_peserta = $request->nama_peserta;
                $data->email_peserta = $request->email_peserta;
                $data->no_hp_peserta = $request->no_hp_peserta;
                $data->save();
                alert()->success('Good Job', 'Successfully added a post !!');
                return redirect()->back()->with('message', 'Berhasil tambah data');
            }else{
                alert()->error('Quota Sudah Penuh', 'Jumlah peserta sudah maksimal !!');
                return redirect()->back()->with('message', 'Jumlah peserta sudah maksimal !!');
            }
            
        }
    }
}
