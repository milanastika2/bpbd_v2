<html>
<head>
    <title>website Bpbd.baliprov.go.id | Peserta Event</title>

    <link rel="icon" href="{{asset('/images/'.$Gsetting->default_img)}}" type="image/x-icon" />
    <link rel="stylesheet" href="{{asset('/assets/admin/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">


</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="row"> 
                <div class="col-md-12 text-center">
                    <img src="{{asset('/images/'.$Gsetting->logo)}}" width="100px">
                    <h3 class="text-center">Daftar Peserta Kegiatan BPBD Provinsi Bali</h3>
                    <h4 class="text-center">{{ $event->judul_event }}</h4>   
                </div>
                <hr>

                <div class="col-md-12" style="margin-top:30px;">
                    <ul>
                        <li>Kegiatan diadakan pada {{ $event->tgl_mulai_event }} {{ $event->jam_mulai_event }} s/d {{ $event->tgl_selesai_event }} {{ $event->jam_selesai_event }}</li>
                        <li>Daftar Peserta Kegiatan :</li>
                    </ul>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No Hp</th>
                            </tr>
                        <thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($datas as $data)
                                <tr>    
                                    <td>{{ $i++ }}</td>
                                    <td>{{$data->nama_peserta}}</td>
                                    <td>{{$data->email_peserta}}</td>
                                    <td>{{$data->no_hp_peserta}}</td>
                                </tr>
                            @endforeach
                        <tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    window.print();
</script>
</html>