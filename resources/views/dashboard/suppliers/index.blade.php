@extends('dashboard/layouts/main')

@section('container')
    @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show col-lg-11 mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="table-responsive col-lg-11 mb-3">
      <a href="/dashboard/suppliers/create" class="btn btn-primary mb-3 mt-3"><span data-feather="plus-circle"></span> Buat Katalog Baru</a>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h5>Katalog Buah</h5>
      </div>
        <table class="table table-stripped" id="suppliers_buah">
          <thead>
            <tr>
              <th></th>
              <th scope="col">#</th>
              <th scope="col">Nama Produk</th>
              <th scope="col">Harga Supplier</th>
              <th scope="col">Persentase</th>
              <th scope="col">Satuan</th>
              <th scope="col">Status</th>
              <th scope="col">Peminat</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($suppliers_buah as $supplier)       
                <tr data-child-value="Dibuat tanggal <b> {{ $supplier->created_at->format('d M Y') }} </b>
                </br>
                Diperbarui tanggal <b> {{ $supplier->updated_at->format('d M Y') }} </b>
                ">
                    <td class="dt-control"></td>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $supplier->nama_barang }}</td>
                    <td>Rp. <?= number_format($supplier->harga_pasok, 0, ',', '.') ?></td>
                    <td>{{ $supplier->persentase }}</td>
                    <td>/{{ $supplier->satuan->nama_satuan }}</td>
                    <td>
                      @if ($supplier->status_musim == 1)
                          Sedang Musim
                      @else
                          Tidak Musim
                      @endif
                    </td>
                    <td>
                      @if ($supplier->peminat == 1)
                          Tinggi
                      @else
                          Normal
                      @endif
                    </td>
                    <td>
                      <form action="/dashboard/suppliers/{{ $supplier->slug }}" method="POST" class="d-inline">
                        @method('put')
                        @csrf
                          @if ($supplier->status_musim == 1)
                              <input type="hidden" name="status_musim" value="0">
                              <button class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin akan menghapus {{ $supplier->nama_barang }} dari daftar musim?')"><span data-feather="star"></span></button>
                          @else
                          <input type="hidden" name="status_musim" value="1">
                              <button class="badge bg-success border-0" onclick="return confirm('Apakah anda yakin akan menambahkan {{ $supplier->nama_barang }} dalam daftar musim?')"><span data-feather="star"></span></button>
                          @endif
                      </form>
                      <form action="/dashboard/suppliers/{{ $supplier->slug }}" method="POST" class="d-inline">
                        @method('put')
                        @csrf
                          @if ($supplier->peminat == 1)
                              <input type="hidden" name="peminat" value="0">
                              <button class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin akan menghapus {{ $supplier->nama_barang }} dari daftar tinggi peminat?')"><span data-feather="thumbs-up"></span></button>
                          @else
                          <input type="hidden" name="peminat" value="1">
                              <button class="badge bg-success border-0" onclick="return confirm('Apakah anda yakin akan menambahkan {{ $supplier->nama_barang }} dalam daftar tinggi peminat?')"><span data-feather="thumbs-up"></span></button>
                          @endif
                      </form>
                        <a href="/dashboard/suppliers/{{ $supplier->slug }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                        <form action="/dashboard/suppliers/{{ $supplier->slug }}" method="POST" class="d-inline">
                          @method('delete')
                          @csrf
                          <button class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin akan menghapus katalog {{ $supplier->nama_barang }}?')"><span data-feather="x-circle"></span></button>
                        </form>
                    </td>
                </tr>
              @endforeach
          </tbody>
        </table>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mt-3 mb-3 border-bottom">
          <h5>Katalog Sayur</h5>
        </div>
          <table class="table table-stripped" id="suppliers_sayur">
            <thead>
              <tr>
                <th></th>
                <th scope="col">#</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Harga Supplier</th>
                <th scope="col">Persentase</th>
                <th scope="col">Satuan</th>
                <th scope="col">Status</th>
                <th scope="col">Peminat</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($suppliers_sayur as $supplier)       
                  <tr data-child-value="Dibuat tanggal <b> {{ $supplier->created_at->format('d M Y') }} </b>
                  </br>
                  Diperbarui tanggal <b> {{ $supplier->created_at->format('d M Y') }} </b>
                  ">
                      <td class="dt-control"></td>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $supplier->nama_barang }}</td>
                      <td>Rp. <?= number_format($supplier->harga_pasok, 0, ',', '.') ?></td>
                      <td>{{ $supplier->persentase }}</td>
                      <td>/{{ $supplier->satuan->nama_satuan }}</td>
                      <td>
                        @if ($supplier->status_musim == 1)
                            Sedang Musim
                        @else
                            Tidak Musim
                        @endif
                      </td>
                      <td>
                        @if ($supplier->peminat == 1)
                            Tinggi
                        @else
                            Normal
                        @endif
                      </td>
                      <td>
                        <form action="/dashboard/suppliers/{{ $supplier->slug }}" method="POST" class="d-inline">
                          @method('put')
                          @csrf
                            @if ($supplier->status_musim == 1)
                                <input type="hidden" name="status_musim" value="0">
                                <button class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin akan menghapus {{ $supplier->nama_barang }} dari daftar musim?')"><span data-feather="star"></span></button>
                            @else
                            <input type="hidden" name="status_musim" value="1">
                                <button class="badge bg-success border-0" onclick="return confirm('Apakah anda yakin akan menambahkan {{ $supplier->nama_barang }} dalam daftar musim?')"><span data-feather="star"></span></button>
                            @endif
                        </form>
                        <form action="/dashboard/suppliers/{{ $supplier->slug }}" method="POST" class="d-inline">
                          @method('put')
                          @csrf
                            @if ($supplier->peminat == 1)
                                <input type="hidden" name="peminat" value="0">
                                <button class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin akan menghapus {{ $supplier->nama_barang }} dari daftar tinggi peminat?')"><span data-feather="thumbs-up"></span></button>
                            @else
                            <input type="hidden" name="peminat" value="1">
                                <button class="badge bg-success border-0" onclick="return confirm('Apakah anda yakin akan menambahkan {{ $supplier->nama_barang }} dalam daftar tinggi peminat?')"><span data-feather="thumbs-up"></span></button>
                            @endif
                        </form>
                          <a href="/dashboard/suppliers/{{ $supplier->slug }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                          <form action="/dashboard/suppliers/{{ $supplier->slug }}" method="POST" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin akan menghapus katalog {{ $supplier->nama_barang }}?')"><span data-feather="x-circle"></span></button>
                          </form>
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
          var table = $('#suppliers_buah').DataTable();
          $('#suppliers_buah tbody').on('click', 'td.dt-control', function () {
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
          var table = $('#suppliers_sayur').DataTable();
          $('#suppliers_sayur tbody').on('click', 'td.dt-control', function () {
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