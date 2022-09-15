@extends('user.master_page')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Daftar Event</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                @include('notification')
            </div>
            @foreach ($data as $item)
                <div class="col-md-4">
                    <form action="{{url('booking/'.$item->id)}}" method="post">
                        {{ csrf_field() }}
                        @method('put')
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{$item->event}}</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="hidden" value="{{$item->id}}" name="id_event" id="">
                                    <img src="{{$item->banner}}" style="width: 100%">
                                </div>
                                <div class="form-group">
                                    <p>{{$item->about_event}}</p>
                                    <p>Tanggal Event {{date('d-m-Y', strtotime($item->tgl_event))}}</p>
                                </div>                            
                            </div>
                            <div class="card-footer">
                                @if(!empty($item->getTiket->where('id_pemesan', Session::get('id'))->first()))
                                    <button type="submit" class="btn btn-danger float-right" name="act" value="c_booking" onclick="return confirm('Apakah anda akan membatalkan booking tiket {{$item->event}}')">Batalkan Booking</button>
                                @else
                                    <button type="submit" class="btn btn-primary float-right" name="act" value="booking" onclick="return confirm('Apakah anda akan membooking tiket {{$item->event}}')">Booking</button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</section>
@stop