@extends('admin.master_page')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Laporan Tiket</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                          <h4>Tabel Tiket</h4>
                        </div>
                        <div class="card-body">
                          <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="checked-tab" data-toggle="tab" href="#checked" role="tab" aria-controls="checked" aria-selected="true">Sudah Check In</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="uncheck-tab" data-toggle="tab" href="#uncheck" role="tab" aria-controls="uncheck" aria-selected="false">Belum Check In</a>
                            </li>
                         </ul>
                          <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="checked" role="tabpanel" aria-labelledby="checked-tab">
                                <table class="table table-striped" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Event</th>
                                            <th>Pemesan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($no = 1)
                                        @forelse ($checked as $item)
                                            <tr>
                                                <th>{{ $no++ }}</th>
                                                <th>{{ $item->kode }}</th>
                                                <th>{{ $item->event->event }}</th>
                                                <th>{{ $item->pemesan->name }}</th>
                                                <th>{{ $item->status }}</th>
                                               
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="uncheck" role="tabpanel" aria-labelledby="uncheck-tab">
                                <table class="table table-striped" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Event</th>
                                            <th>Pemesan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($no = 1)
                                        @forelse ($unchecked as $item)
                                            <tr>
                                                <th>{{ $no++ }}</th>
                                                <th>{{ $item->kode }}</th>
                                                <th>{{ $item->event->event }}</th>
                                                <th>{{ $item->pemesan->name }}</th>
                                                <th>{{ $item->status }}</th>
                                                
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
               
            </div>
        </div>



    </section>

@stop
