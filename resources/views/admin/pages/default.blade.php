@extends('admin.master_page')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Daftar Tiket</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    @include('notification')
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <form action="{{ url('filter') }}" method="post">
                            <div class="card-header">
                                <h4 class="card-title">Form Check In</h4>
                            </div>
                            <div class="card-body">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="text" name="code" class="form-control"
                                        placeholder="Scan barcode or type kode booking" name="kode-booking">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Check Booking</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            @if (empty($tiket))
                                <h3 style="text-align: center">Data check in kosong</h3>
                                <p style="text-align: center">Silahkan masukan kode tiket di form check in <br> Kemudian,
                                    klik tombol check in <br>Jika data ditemukan akan ditampilkan.</p>
                            @else
                                <table>
                                    <tr>
                                        <td>Kode</td>
                                        <td>:</td>
                                        <td>{{ $tiket->kode }}</td>
                                    </tr>
                                    <tr>
                                        <td>Event</td>
                                        <td>:</td>
                                        <td>{{ $tiket->event->event }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal</td>
                                        <td>:</td>
                                        <td>{{ date('d-m-Y', strtotime($tiket->event->tgl_event)) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Booking</td>
                                        <td>:</td>
                                        <td>{{ $tiket->pemesan->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Booking</td>
                                        <td>:</td>
                                        <td>{{ date('d-m-Y', strtotime($tiket->created_at)) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>:</td>
                                        <td>{{ $tiket->status }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            @if ($tiket->status == 'unchecked')
                                                <form action="{{url('check-in/'.$tiket->id)}}" method="post">
                                                    @method('put')
                                                    {{csrf_field()}}
                                                    <button type="submit" class="btn btn-primary">Belum Check In</button>
                                                </form>
                                            @else
                                                <button type="button" class="btn btn-danger">Sudah Check In</button>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"> Tabel data tiket</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Event</th>
                                        <th>Pemesan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($no = 1)
                                    @forelse ($data as $item)
                                        <tr>
                                            <th>{{ $no++ }}</th>
                                            <th>{{ $item->kode }}</th>
                                            <th>{{ $item->event->event }}</th>
                                            <th>{{ $item->pemesan->name }}</th>
                                            <th>{{ $item->status }}</th>
                                            <th>
                                                @if (Session::get('level') == 'admin')
                                                    <form action="{{ url('tiket-delete/' . $item->id) }}" method="post">
                                                        @method('delete')
                                                        {{ csrf_field() }}
                                                        <a href="#" onclick="update('{{ $item->id }}')"
                                                            class="btn btn-warning">update</a>
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Apakah anda akan menghapus tiket {{ $item->kode }}')">delete</button>
                                                    </form>
                                                @else
                                                    <button type="button" class="btn btn-danger">Admin Only</button>
                                                @endif
                                            </th>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form action="#" method="post" id='form_data'>
            {{ csrf_field() }}
            @method('put')
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Pengguna</label>
                            <select name="id_pemesan" class="form-control select2" id="id_pemesan" required>
                                <option value="">Pilihlah Pengguna</option>
                                @foreach ($user as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Event</label>
                            <select name="id_event" class="form-control select2" id="id_event" required>
                                <option value="">Pilihlah Event</option>
                                @foreach ($event as $item)
                                    <option value="{{ $item->id }}">{{ $item->event }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" class="form-control select" id="status" required>
                                <option value="">Pilihlah status</option>
                                @foreach ($status as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop

@section('js')
    <script>
        function update(id) {
            $.ajax({
                url: "{{ url('filter') }}/" + id + "/edit",
                dataType: 'json',
                success: function(result) {
                    console.log(result);
                    $('#exampleModalLabel').text(result.kode);
                    $('#id_pemesan').val(result.id_pemesan).trigger('change');
                    $('#id_event').val(result.id_event).trigger('change');
                    $('#status').val(result.status).trigger('change');
                    $('#form_data').attr('action', "{{ url('tiket-update') }}/" + id);
                    $('#exampleModal').modal('show');
                }
            });
        }
    </script>
@stop
