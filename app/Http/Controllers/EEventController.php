<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Peserta;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use App\Theme;
use App\Gsetting;


class EEventController extends Controller
{
    
    public function ListEvent(){
        $tgl = date('Y-m-d');

        $datas = Event::where('tgl_akhir_daftar', '<=', $tgl)
                ->where('jenis_event', '0')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        
        $theme = Theme::find(1);
        $title_info = "e-Event BPBD Provinsi Bali";  

        if($theme->status == 1){
            //$data['catNews'] = view('home.category',compact('news'));
            $data['event'] = view('home2.event', compact('datas', 'title_info'));
            $data['addvert'] = view('home.addvert');
            $data['follow-us'] = view('home.social');
            $data['popular'] = view('home.popular'); 
            $data['subscribe'] = view('home.subscribe');
            return view('welcome', $data);
        }elseif ($theme->status == 2){
            //$data2['catNews'] = view('home2.category',compact('news'));
            $data2['addvert'] = view('home2.addvert');
            $data2['event'] = view('home2.event', compact('datas', 'title_info')); 
            $data2['follow-us'] = view('home2.social');
            $data2['popular'] = view('home2.popular'); 
            $data2['subscribe'] = view('home2.subscribe'); 
            $data2['Infografy'] = view('home2.info_gunung');
            return view('welcome2', $data2);
        }elseif ($theme->status == 3) {
            $data3['addvert'] = view('home3.addvert');
            $data3['follow-us'] = view('home3.social');
            $data3['popular'] = view('home3.popular'); 
            $data3['subscribe'] = view('home3.subscribe');
            $data3['event'] = view('home2.event', compact('datas', 'title_info'));
            return view('welcome3',$data3);   
        }elseif ($theme->status == 4) {
            $view4['follow-us'] = view('home4.social');
            $view4['popular'] = view('home4.popular');
            $view4['follow-us2'] = view('home4.follow-us');
            $view4['subscribe'] = view('home4.subscribe');
            $view4['addvert'] = view('home4.addvert');
            $view4['event'] = view('home2.event', compact('datas', 'title_info'));
            return view('welcome4',$view4);   
        }
    }

    public function DetailEvent($id){
        $datas = Event::findOrFail($id);
        $theme = Theme::find(1);
        $title_info = "e-Event BPBD Provinsi Bali";  

        if($theme->status == 1){
            //$data['catNews'] = view('home.category',compact('news'));
            $data['event_detail'] = view('home2.event_detail', compact('datas', 'title_info'));
            $data['addvert'] = view('home.addvert');
            $data['follow-us'] = view('home.social');
            $data['popular'] = view('home.popular'); 
            $data['subscribe'] = view('home.subscribe');
            return view('welcome', $data);
        }elseif ($theme->status == 2){
            //$data2['catNews'] = view('home2.category',compact('news'));
            $data2['addvert'] = view('home2.addvert');
            $data2['event_detail'] = view('home2.event_detail', compact('datas', 'title_info')); 
            $data2['follow-us'] = view('home2.social');
            $data2['popular'] = view('home2.popular'); 
            $data2['subscribe'] = view('home2.subscribe'); 
            $data2['Infografy'] = view('home2.info_gunung');
            return view('welcome2', $data2);
        }elseif ($theme->status == 3) {
            $data3['addvert'] = view('home3.addvert');
            $data3['follow-us'] = view('home3.social');
            $data3['popular'] = view('home3.popular'); 
            $data3['subscribe'] = view('home3.subscribe');
            $data3['event_detail'] = view('home2.event_detail', compact('datas', 'title_info'));
            return view('welcome3',$data3);   
        }elseif ($theme->status == 4) {
            $view4['follow-us'] = view('home4.social');
            $view4['popular'] = view('home4.popular');
            $view4['follow-us2'] = view('home4.follow-us');
            $view4['subscribe'] = view('home4.subscribe');
            $view4['addvert'] = view('home4.addvert');
            $view4['event_detail'] = view('home2.event_detail', compact('datas', 'title_info'));
            return view('welcome4',$view4);   
        }
    }

    public function RegisterEvent(Request $request, $id){
        $event = Event::findOrFail($id);
        $quota = $event->quota_event;
        
        $get_peserta = Peserta::where('email_peserta', $request->email_peserta)
        ->orWhere('no_hp_peserta', $request->no_hp_peserta)
        ->get();

        if($get_peserta){
            alert()->error('Gagal mendaftar peserta', 'Nama atau Email sudah terdaftar !!');
            return redirect()->back()->with('message', 'Nama atau Email sudah terdaftar !!');
        }else{
            //total peserta terakhir
            $total = Peserta::where('id_event', $event->id)->count();
            $total = $total + 1;

            if($total <= $quota){
                $data = new Peserta();
                $data->id_event = $event->id;
                $data->nama_peserta = $request->nama_peserta;
                $data->email_peserta = $request->email_peserta;
                $data->no_hp_peserta = $request->no_hp_peserta;
                $data->save();
                alert()->success('Good Job', 'Berhasil mendaftar !!');
                return redirect()->back()->with('message', 'Berhasil tambah data');
            }else{
                alert()->error('Quota Sudah Penuh', 'Jumlah peserta sudah maksimal !!');
                return redirect()->back()->with('message', 'Jumlah peserta sudah maksimal !!');
            }
        }
    }
}
