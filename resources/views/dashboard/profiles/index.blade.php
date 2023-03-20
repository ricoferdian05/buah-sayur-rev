@extends('dashboard/layouts/main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h5>Profil Website</h5>
    </div>

    @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show col-lg-11" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="table-responsive col-lg-11 mb-3">
        <table class="table table-stripped" id="profiles">
          <thead>
            <tr>
              <th></th>
              <th scope="col">#</th>
              <th scope="col">Profil Singkat</th>
              <th scope="col">Alamat</th>
              <th scope="col">Nomor Telepon</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($profiles as $profile)       
                <tr data-child-value="
                  <b>Sosial Media:</b>
                  <br/>
                  Email: {{ $profile->email }}
                  <br/>
                  Whatsapp (Nomor): {{ $profile->whatsapp }}
                  <br/>
                  Whatsapp (Link): {{ $profile->link_whatsapp }}
                  <br/>
                  Facebook: {{ $profile->link_facebook }}
                  <br/>
                  Instagram: {{ $profile->link_instagram }}
                  <br/>
                  Youtube (Channel): {{ $profile->link_youtube }}
                  <br/>
                  Youtube (Video): {{ $profile->link_embed }}
                  ">
                    <td class="dt-control"></td>
                    <td>{{ $loop->iteration }}</td>
                    <td>{!! $profile->profil !!}</td>
                    <td>{!! $profile->alamat !!}</td>
                    <td>{{ $profile->telp }}</td>
                    <td>
                        <a href="/dashboard/profiles/{{ $profile->id }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
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
          var table = $('#profiles').DataTable();
          $('#profiles tbody').on('click', 'td.dt-control', function () {
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