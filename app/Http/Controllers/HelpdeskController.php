<?php

namespace App\Http\Controllers;

use App\Models\Helpdesk;
use App\Models\vw_Helpdesk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;

class HelpdeskController extends Controller
{
    public function index()
    {
        // dd(Auth::user()->email);
        $hld = Helpdesk::where('email_pengirim_layanan', '=', Auth::user()->email)
            ->get();
        $hld_count = $hld->count();
        $vwhld_open = vw_Helpdesk::where('status', 'Open')
            ->where('email_pengirim_layanan', '=', Auth::user()->email)
            ->get();
        $vwhld_open_count = $vwhld_open->count();
        $vwhld_wia = vw_Helpdesk::where('status', 'WIA')
            ->where('email_pengirim_layanan', '=', Auth::user()->email)
            ->get();
        $vwhld_wia_count = $vwhld_wia->count();
        $vwhld_done = vw_Helpdesk::where('status', 'Closed')
            ->where('email_pengirim_layanan', '=', Auth::user()->email)
            ->get();
        $vwhld_done_count = $vwhld_done->count();
        $vwhld_cancelled = vw_Helpdesk::where('status', 'Cancelled')
            ->where('email_pengirim_layanan', '=', Auth::user()->email)
            ->get();
        $vwhld_cancelled_count = $vwhld_cancelled->count();

        return view('helpdesk.index', compact([
            'hld',
            'vwhld_open',
            'vwhld_wia',
            'vwhld_done',
            'vwhld_cancelled',
            'hld_count',
            'vwhld_open_count',
            'vwhld_wia_count',
            'vwhld_done_count',
            'vwhld_cancelled_count'
        ]));
    }

    public function create()
    {
        return view('layouts.frontend.helpdesk');
    }

    public function save(Request $request)
    {
        if ($request->hasFile('lampiran_layanan')) {
            $file = $request->file('lampiran_layanan');
            if (strtolower(($file->getClientOriginalExtension()) == 'pdf')) {
                $validatedData = $request->validate([
                    'lampiran_layanan' => [
                        'required',
                        'mimes:pdf',
                        'mimetypes:application/pdf',
                        'max:5120', // 5120 KB (5 MB) max size
                        function ($attribute, $value, $fail) {
                            // Custom validation to prevent dangerous extensions like .PhP56
                            if (preg_match('/\.php[0-9]*$/i', $value->getClientOriginalExtension())) {
                                $fail('Invalid file extension.');
                            }
                        },
                    ],
                ]);
            } else {
                return redirect('/daftarlayanan')->with('message', 'Format File yang diupload tidak sesuai ketentuan.');
            }

            if ($validatedData) {
                $file1 = $request->file('lampiran_layanan');

                if ($file1->isValid()) {
                    $filename1 = "LampiranLayanan-" . time() . '.' . '.pdf';
                    $path1 = $file1->storeAs('public/helpdesk', $filename1);

                    // Replace 'public/' with 'storage/' in the path
                    $path1 = str_replace('public/', 'storage/', $path1);

                    // Merge the file path into the request
                    $request->merge([
                        'lampiran_layanan' => $path1,
                        'status' => 'Open',
                        'filename' => $filename1,
                        'lampiran_layanan_path' => $path1,
                        'pesan_layanan' => $request->pesan_layanan,
                        'last_updated_date' => now(),
                        'created_date' => now(),
                        'updated_date' => now()
                    ]);

                    // Save to the database
                    // dd($request);
                    Helpdesk::create($request->except(['_token']));

                    return redirect('/daftarlayanan')->with('message', 'Bantuan Layanan telah berhasil kami terima.');
                } else {
                    return redirect('/daftarlayanan')->with('message', 'Bantuan Layanan tidak berhasil terkirim.');
                }
            }
        } else {
            return redirect('/daftarlayanan')->with('message', 'Bantuan Layanan tidak berhasil terkirim.');
        }
    }

    public function update($id)
    {

        $help = Helpdesk::find($id);
        // dd($help);
        return view('helpdesk.update', compact(['help']));
    }

    public function savelayanan($id, Request $request)
    {
        // dd($request->all());
        $help = Helpdesk::find($id);
        $request->merge([
            'status' => $request->status,
            'pesan_layanan' => $request->pesan_layanan . '<br /> Feedback: <br />' . $request->pesan_layanan_pre,
            'last_updated_date' => date('Y-m-d H:i:s'),
            'updated_date' => date('Y-m-d H:i:s')
        ]);
        $help->update($request->except(['_token', 'pesan_layanan_pre']));
        // dd($help);
        return redirect('/daftarlayanan')->with('Berhasil', 'Bantuan Layanan telah berhasil diperbaharui');
    }

    public function closed($id)
    {
        // dd($request->all());
        $help = Helpdesk::where('id', $id)->update([
            'status' => 'Closed',
            'closed_date' => date('Y-m-d H:i:s'),
            'last_updated_date' => date('Y-m-d H:i:s'),
            'updated_date' => date('Y-m-d H:i:s')
        ]);
        // $help->update([
        // 'status' => 'Closed',
        // 'closed_date' => date('Y-m-d H:i:s'),
        // 'last_updated_date' => date('Y-m-d H:i:s'),
        // 'updated_date' => date('Y-m-d H:i:s')
        // ]);

        // $help->update($request->except(['_token']));
        // dd($help);
        $hld = Helpdesk::all();
        return view('helpdesk.index', compact(['hld']));
    }

    public function helpdeskexport() {}
}
