@extends('dashboard/layouts/main')

@section('container')
    @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show col-lg-11 mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="table-responsive col-lg-11 mb-3">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h5>Katalog Buah</h5>
        </div>
        <table class="table table-stripped" id="allcatalogs_buah">
          <thead>
            <tr>
              <th></th>
              <th scope="col">#</th>
              <th scope="col">Nama Produk</th>
              <th scope="col">Harga Supplier</th>
              <th scope="col">Harga Jual</th>
              <th scope="col">Satuan</th>
              <th scope="col">Pemilik</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($allcatalogs_buah as $catalog)       
              <tr data-child-value="Dibuat tanggal <b> {{ $catalog->created_at->format('d M Y') }} </b>
              </br>
              Diperbarui tanggal <b> {{ $catalog->updated_at->format('d M Y') }} </b>
              ">
                    <td class="dt-control"></td>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $catalog->nama_barang }}</td>
                    <td>Rp. <?= number_format($catalog->barang->harga_pasok, 0, ',', '.') ?></td>
                    <td>Rp. <?= number_format($catalog->harga_barang, 0, ',', '.') ?></td>
                    <td>{{ $catalog->satuan->nama_satuan }}</td>
                    <td>{{ $catalog->user->nama }}</td>
                    <td>
                        <a href="/dashboard/allcatalogs/show/{{ $catalog->slug }}" class="badge bg-info m-1"><span data-feather="eye"></span></a>
                        {{-- <a href="/dashboard/allcatalogs/destroy/{{ $catalog->slug }}" class="badge bg-danger m-1" onclick="return confirm('Apakah anda yakin akan menghapus katalog {{ $catalog->title }}?')"><span data-feather="x-circle"></span></a> --}}
                    </td>
                </tr>
              @endforeach
          </tbody>
        </table>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h5>Katalog Sayur</h5>
        </div>
        <table class="table table-stripped" id="allcatalogs_sayur">
          <thead>
            <tr>
              <th></th>
              <th scope="col">#</th>
              <th scope="col">Nama Produk</th>
              <th scope="col">Harga Supplier</th>
              <th scope="col">Harga Jual</th>
              <th scope="col">Satuan</th>
              <th scope="col">Pemilik</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($allcatalogs_sayur as $catalog)       
              <tr data-child-value="Dibuat tanggal <b> {{ $catalog->created_at->format('d M Y') }} </b>
              </br>
              Diperbarui tanggal <b> {{ $catalog->created_at->format('d M Y') }} </b>
              ">
                    <td class="dt-control"></td>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $catalog->nama_barang }}</td>
                    <td>Rp. <?= number_format($catalog->barang->harga_pasok, 0, ',', '.') ?></td>
                    <td>Rp. <?= number_format($catalog->harga_barang, 0, ',', '.') ?></td>
                    <td>{{ $catalog->satuan->nama_satuan }}</td>
                    <td>{{ $catalog->user->nama }}</td>
                    <td>
                        <a href="/dashboard/allcatalogs/show/{{ $catalog->slug }}" class="badge bg-info m-1"><span data-feather="eye"></span></a>
                        {{-- <a href="/dashboard/allcatalogs/destroy/{{ $catalog->slug }}" class="badge bg-danger m-1" onclick="return confirm('Apakah anda yakin akan menghapus katalog {{ $catalog->title }}?')"><span data-feather="x-circle"></span></a> --}}
                    </td>
                </tr>
              @endforeach
          </tbody>
        </table>
      </div>
      
      
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
      
      <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.5/datatables.min.js"></script>
      <script>
        function format(value) {
          return '<div>' + value + '</div>';
        }

        $(document).ready( function () {
          var table = $('#allcatalogs_buah').DataTable();
          $('#allcatalogs_buah tbody').on('click', 'td.dt-control', function () {
          var tr = $(this).closest('tr');
          var row = table.row( tr );

          if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child(format(tr.data('child-value'))).show();
                tr.addClass('shown');
            }
        });
        });

        $(document).ready( function () {
          var table = $('#allcatalogs_sayur').DataTable();
          $('#allcatalogs_sayur tbody').on('click', 'td.dt-control', function () {
          var tr = $(this).closest('tr');
          var row = table.row( tr );

          if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child(format(tr.data('child-value'))).show();
                tr.addClass('shown');
            }
        });
        });
      </script>
@endsection