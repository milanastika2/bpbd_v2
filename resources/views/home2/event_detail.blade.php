@extends('welcome')

@section('event_detail') 
           
          <div class="single-post">
            
            <div class="post-title-area">
              <h2 class="post-title">
                {{$datas->judul_event}}
              </h2>
              <div class="post-meta">
                <span class="post-author">
                  Kapasitas <a>{{$datas->quota_event}} Orang</a>
                </span>   
                <span class="post-hits"><i class="fa fa-calendar-o"></i> Tanggal Mulai {{$datas->tgl_mulai_event}}</span>
                <span class="post-date"><i class="fa fa-clock-o"></i> 
                Jam {{$datas->jam_mulai_event}}</span>

                <span class="post-hits"><i class="fa fa-calendar-o"></i> Tanggal Selesai {{$datas->tgl_selesai_event}}</span>
                <span class="post-date"><i class="fa fa-clock-o"></i> 
                Jam {{$datas->jam_selesai_event}}</span>
                
              </div>
            </div><!-- Post title end -->

            <div class="post-content-area">
              <div class="post-media post-featured-image">
              <a href="{{asset('/uploads/event/'.$datas->image)}}" class="gallery-popup cboxElement">
                <img src="{{asset('/uploads/event/'.$datas->image)}}" class="img-responsive" alt="bpbd">
                </a>
              </div>
              <div class="entry-content">
                {!! $datas->detail_event !!}
              </div><!-- Entery content end -->

              <div class="tags-area clearfix">
                <div class="post-tags">
                  <h4>Form pendaftaran peserta</h4>
                  <h5>Tanggal Akhir Pendaftaran : {{ $datas->tgl_akhir_daftar }}</h5>
                  <form action="{{url('e-event/'.$datas->id.'/register')}}" method="post">
                  {{csrf_field()}}
                    <div class="alert alert-success">
                      <p>Note : Setiap email atau no hp peserta hanya bisa di daftarkan sekali pada 1 kegiatan.</p>
                    </div>
                    <div class="form-group">
                      <label>Nama Lengkap (*)</label>
                      <input type="text" class="form-control" name="nama_peserta" require>
                    </div>
                    <div class="form-group">
                      <label>Email (*)</label>
                      <input type="email" class="form-control" name="email_peserta" require>
                    </div>
                    <div class="form-group">
                      <label>No Hp (*)</label>
                      <input type="text" class="form-control" name="no_hp_peserta" require>
                    </div>
                    
                    <div class="form-group">
                      
                    </div>
                    <div class="form-group">
                      <button class="btn btn-success">Simpan</button>
                    </div>
                  </form>
                </div>
              </div><!-- Tags end -->
              
              
            </div><!-- post-content end -->
          </div><!-- Single post end -->
 

@stop


<div class="gap-40"></div>
 