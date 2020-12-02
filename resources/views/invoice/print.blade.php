
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    
    <link rel="stylesheet" href="{{asset('style.css')}}" media="all" />
    <script src="{{asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
  </head>
  <body>
    <header class="clearfix">
    <div>
      The report was created on a computer and is valid without the signature and seal.
    </div>
      <div id="logo">
        <a href="" class="btnPrint"><img src="{{asset('stisla/fiksioner.png')}}"></a>
      </div>
      <div id="company">
        <h2 class="name">Fiksioner Indonesia</h2>
        <div>Jalan Sangkuriang Dalam, R3, RT. 02 RW. 12,</div>
        <div>Kelurahan Dago, Kecamatan Coblong,</div>
        <div>Bandung 40132</div>
        <div>fiksionerid@gmail.com</div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">Daftar Hadir</div>
        </div>
        
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">No</th>
            <th class="no">ID</th>
            <th class="no">Nama</th>
            <th class="no">Asal</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($daftar as $item)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item->user_id}}</td>
            <td>{{$item->nama}}</td>
            <td>{{$item->asal}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      
    </main>
    
  </body>
  <script type="text/javascript">
  $('.btnPrint').click(function(){
    window.print();
  });
  </script>
</html>