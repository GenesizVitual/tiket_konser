<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemesanModel;
use App\Models\User;
use App\Models\TiketModel;
use App\Models\EventModel;
use Illuminate\Database\Eloquent\Model;

class TiketController extends Controller
{
    //

    private $status = [
        'checked',
        'unchecked'
    ];


    public function daftar_booking(Request $req)
    {
        $user = User::all()->sortBy('username');
        $event = EventModel::all()->sortBy('event');
        $data = TiketModel::all();
        $status = $this->status;
        $tiket = [];


        if ($req->code) {
            $tiket = TiketModel::where('kode', $req->code)->first();
        }

        return view('admin.pages.default', compact(['data', 'tiket', 'user', 'event', 'status']));
    }

    public function show(Request $req, $id)
    {
        $data = TiketModel::find($id);
        return response()->json($data);
    }

    public function update_checkIn(Request $req, $id)
    {
        $data = TiketModel::find($id);
        $check_event_date = date('Y-m-d');
        if ($data->event->tgl_event != $check_event_date) {
            return redirect('dashboard')->with('message_fail', 'Even belum dimulai atau telah dilewati');
        }
        if ($data->status == 'unchecked') {
            $data->status = 'checked';
        }
        if ($data->save()) {
            return redirect('dashboard')->with('message_success', 'Tiket No:' . $data->kode . ' telah berhasil check in');
        }
    }

    public function update(Request $req, $id)
    {
        $data = $req->except(['_token', '_method']);
        $model = TiketModel::find($id);
        if ($model->update($data)) {
            return redirect('dashboard')->with('message_success', 'Anda telah diubah');
        }
    }

    public function destroy(Request $req, $id)
    {
        $model = TiketModel::find($id);
        if ($model->delete()) {
            return redirect('dashboard')->with('message_success', 'Data Tiket telah dihapus');
        }
    }

    public function report(Request $req)
    {
        $checked = TiketModel::all()->where('status','checked');
        $unchecked = TiketModel::all()->where('status','unchecked');
        return view('admin.pages.report',compact('checked','unchecked'));       
    }
}
