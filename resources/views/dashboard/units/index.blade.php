@extends('dashboard/layouts/main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h5>Satuan Produk</h5>
    </div>

    @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show col-lg-6" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="table-responsive col-lg-6 mb-3">
      <a href="/dashboard/units/create" class="btn btn-primary mb-3"><span data-feather="plus-circle"></span> Buat Satuan Baru</a>
        <table class="table table-stripped" id="units">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama Satuan</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($units as $unit)       
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $unit->nama_satuan }}</td>
                    <td>
                        <a href="/dashboard/units/{{ $unit->slug }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                        <form action="/dashboard/units/{{ $unit->slug }}" method="POST" class="d-inline">
                          @method('delete')
                          @csrf
                          <button class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin akan menghapus satuan {{ $unit->nama_satuan }}?')"><span data-feather="x-circle"></span></button>
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
        $(document).ready( function () {
          $('#units').DataTable();
        });
      </script>

@endsection