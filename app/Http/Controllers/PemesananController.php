<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventModel;
use App\Models\PemesanModel;
use App\Models\TiketModel;
use Session;

class PemesananController extends Controller
{
    //
    public function index()
    {
        $data = EventModel::all();
        return view('user.pages.booking.default', compact(['data']));
    }


    public function update(Request $req, $id)
    {

        $id_user = Session::get('id');
        $data = $req->except(['_token', '_method']);
        $data['id_pemesan'] = $id_user;
        $current_date = date('d-m-Y');
        $kode = 'BK-' . $id_user . $req->id_event . '-' . $current_date;
        if ($req->act == 'booking') {
            $model = TiketModel::updateOrCreate(
                [
                    'id_pemesan' => $id_user,
                    'id_event' => $req->id_event
                ],
                [
                    'kode' => $kode,
                ]
            );
            if ($model->save()) {
                return redirect()->back()->with('message_success', 'Terimah kasih telah tiket ' . $model->event->event);
            }
        } else {
            $model = TiketModel::where('id_pemesan', $id_user)->where('id_event', $req->id_event)->first();
            if ($model->delete()) {
                return redirect()->back()->with('message_success', 'Anda telah batalkan booking tiket ' . $model->event->event);
            }
        }
    }
}
