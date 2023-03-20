@extends('dashboard/layouts/main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h5>Data Toko</h5>
    </div>

    @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show col-lg-10" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="table-responsive col-lg-10 mb-3">
      {{-- <a href="/dashboard/users/create" class="btn btn-primary mb-3"><span data-feather="plus-circle"></span> Tambah Data Toko</a> --}}
        <table class="table table-stripped" id="users">
          <thead>
            <tr>
              <th></th>
              <th scope="col">#</th>
              <th scope="col">Nama Toko</th>
              <th scope="col">Email</th>
              <th scope="col">Nomor Telepon</th>
              <th scope="col">Status Toko</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($users->skip(1) as $user)
                @if ($user->is_active == 1)
                  <tr data-child-value="
                    <b>Username:</b>
                    <br/>
                    {{ $user->username }}
                    <br/>
                    <b>Alamat Toko:</b>
                    <br/>
                    {{ $user->alamat }}
                    ">
                @else
                  <tr data-child-value="
                    <b>Username:</b>
                    <br/>
                    {{ $user->username }}
                    <br/>
                    <b>Alamat Toko:</b>
                    <br/>
                    {{ $user->alamat }}
                    "
                    class="bg-danger text-light">
                @endif       
                    <td class="dt-control"></td>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->telp }}</td>
                    <td>
                        @if ($user->is_active == 1)
                            Aktif
                        @else
                            Nonaktif
                        @endif
                    </td>
                    <td>
                        <a href="/dashboard/users/{{ $user->id }}" class="badge bg-info"><span data-feather="eye"></span></a>
                        {{-- <a href="/dashboard/users/{{ $user->id }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a> --}}
                        <form action="/dashboard/users/{{ $user->id }}" method="POST" class="d-inline">
                          @method('put')
                          @csrf
                            @if ($user->is_active == 1)
                                <input type="hidden" name="is_active" value="0">
                                <button class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin akan menonaktifkan {{ $user->nama }}?')"><span data-feather="x-circle"></span></button>
                            @else
                            <input type="hidden" name="is_active" value="1">
                                <button class="badge bg-success border-0" onclick="return confirm('Apakah anda yakin akan mengaktifkan {{ $user->nama }}?')"><span data-feather="check"></span></button>
                            @endif
                        </form>
                        <form action="/dashboard/users/reset/{{ $user->id }}" method="POST" class="d-inline">
                          @method('put')
                          @csrf
                          <button class="badge bg-secondary border-0" onclick="return confirm('Apakah anda yakin akan reset kata sandi untuk {{ $user->name }}?')"><span data-feather="key"></span></button>
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
          var table = $('#users').DataTable();
          $('#users tbody').on('click', 'td.dt-control', function () {
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