<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruas;
use App\Models\User;
use App\Models\Data;
use App\Models\v_kondisi_sta;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function dashboard($tahun)
    {
        $data = [];
        // if (Auth::check()) {
        //     $tahun_login = Auth::user()->tahun_login;
        //     // $data=DB::table('ruas')->where('tahun', Auth::user()->tahun_login)->get();
        //     $jml_ruas = Ruas::where('tahun',$tahun_login)->get()->count();
        //     $jml_sta = Data::where('tahun',$tahun_login)->get()->count();
        //     // $jml_ruas = Ruas::where('tahun','2022')->count();
        //     // $jml_sta = Data::where('tahun','2022')->count();
        //     $jml_panjang = Ruas::sum('panjang');
        //     $total = v_kondisi_sta::count();
        //     $jml_baik = v_kondisi_sta::where('hasil_kondisi', 'Baik')->count();
        //     $jml_sedang = v_kondisi_sta::where('hasil_kondisi', 'Sedang')->count();
        //     $jml_ringan = v_kondisi_sta::where('hasil_kondisi', 'Ringan')->count();
        //     $jml_berat = v_kondisi_sta::where('hasil_kondisi', 'Berat')->count(); 

        //     $jml_mantap = $jml_baik + $jml_sedang;
        //     $jml_tdk_mantap = $jml_ringan + $jml_berat;
        //     $p_mantap = round($jml_mantap / $total * 100,2);
        //     $p_tdk_mantap = round($jml_tdk_mantap / $total * 100,2);

        //     $p_baik = round($jml_baik / $total * 100,2);
        //     $p_sedang = round($jml_sedang / $total * 100,2);
        //     $p_ringan = round($jml_ringan / $total * 100,2);
        //     $p_berat = round($jml_berat / $total * 100,2);

        //     $dt_baik = ['jml_baik'=>$jml_baik, 'p_baik'=>$p_baik];
        //     $dt_sedang = ['jml_sedang'=>$jml_sedang, 'p_sedang'=>$p_sedang];
        //     $dt_ringan = ['jml_ringan'=>$jml_ringan, 'p_ringan'=>$p_ringan];
        //     $dt_berat = ['jml_berat'=>$jml_berat, 'p_berat'=>$p_berat];

        //     $dt_mantap = ['jml_mantap'=>$jml_mantap, 'p_mantap'=>$p_mantap];
        //     $dt_tdk_mantap = ['jml_tdk_mantap'=>$jml_tdk_mantap, 'p_tdk_mantap'=>$p_tdk_mantap];
        //     $data['jml_ruas'] = $jml_ruas;
        //     $data['jml_sta'] = $jml_sta;
        //     $data['panjang'] = $jml_panjang;
        //     $data['jml_baik'] = $jml_baik;
        //     $data['p_baik'] = $p_baik;
        //     $data['jml_sedang'] = $jml_sedang;
        //     $data['p_sedang'] = $p_sedang;
        //     $data['jml_ringan'] = $jml_ringan;
        //     $data['p_ringan'] = $p_ringan;
        //     $data['jml_berat'] = $jml_berat;
        //     $data['p_berat'] = $p_berat;
        //     $data['jml_mantap'] = $jml_mantap;
        //     $data['p_mantap'] = $p_mantap;
        //     $data['jml_tdk_mantap'] = $jml_tdk_mantap;
        //     $data['p_tdk_mantap'] = $p_tdk_mantap;

        //     return response()->json($data);
        // }
        // $tahun_login = Auth::user()->tahun_login;
        // $data=DB::table('ruas')->where('tahun', Auth::user()->tahun_login)->get();
        // $jml_ruas = Ruas::where('tahun',$tahun_login)->get()->count();
        // $jml_sta = Data::where('tahun',$tahun_login)->get()->count();
        // $tahun = Data::distinct()->pluck('tahun');
        $jml_ruas = Ruas::where('tahun', $tahun)->count();
        $jml_sta = Data::where('tahun', $tahun)->count();
        $jml_panjang = Ruas::where('tahun', $tahun)->sum('panjang');
        $total = v_kondisi_sta::count();
        $jml_baik = v_kondisi_sta::where('tahun', $tahun)->where('hasil_kondisi', 'Baik')->count();
        $jml_sedang = v_kondisi_sta::where('tahun', $tahun)->where('hasil_kondisi', 'Sedang')->count();
        $jml_ringan = v_kondisi_sta::where('tahun', $tahun)->where('hasil_kondisi', 'Ringan')->count();
        $jml_berat = v_kondisi_sta::where('tahun', $tahun)->where('hasil_kondisi', 'Berat')->count();

        $jml_mantap = $jml_baik + $jml_sedang;
        $jml_tdk_mantap = $jml_ringan + $jml_berat;
        $p_mantap = round($jml_mantap / $total * 100, 2);
        $p_tdk_mantap = round($jml_tdk_mantap / $total * 100, 2);

        $p_baik = round($jml_baik / $total * 100, 2);
        $p_sedang = round($jml_sedang / $total * 100, 2);
        $p_ringan = round($jml_ringan / $total * 100, 2);
        $p_berat = round($jml_berat / $total * 100, 2);

        $dt_baik = ['jml_baik' => $jml_baik, 'p_baik' => $p_baik];
        $dt_sedang = ['jml_sedang' => $jml_sedang, 'p_sedang' => $p_sedang];
        $dt_ringan = ['jml_ringan' => $jml_ringan, 'p_ringan' => $p_ringan];
        $dt_berat = ['jml_berat' => $jml_berat, 'p_berat' => $p_berat];

        $dt_mantap = ['jml_mantap' => $jml_mantap, 'p_mantap' => $p_mantap];
        $dt_tdk_mantap = ['jml_tdk_mantap' => $jml_tdk_mantap, 'p_tdk_mantap' => $p_tdk_mantap];
        $data['jml_ruas'] = $jml_ruas;
        $data['jml_sta'] = $jml_sta;
        $data['panjang'] = $jml_panjang;
        $data['jml_baik'] = $jml_baik;
        $data['p_baik'] = $p_baik;
        $data['jml_sedang'] = $jml_sedang;
        $data['p_sedang'] = $p_sedang;
        $data['jml_ringan'] = $jml_ringan;
        $data['p_ringan'] = $p_ringan;
        $data['jml_berat'] = $jml_berat;
        $data['p_berat'] = $p_berat;
        $data['jml_mantap'] = $jml_mantap;
        $data['p_mantap'] = $p_mantap;
        $data['jml_tdk_mantap'] = $jml_tdk_mantap;
        $data['p_tdk_mantap'] = $p_tdk_mantap;
        $data['tahun'] = $tahun;

        return response()->json($data);
        // return view('home', compact('jml_ruas','jml_panjang','jml_sta','dt_baik','dt_sedang','dt_ringan','dt_berat','dt_mantap','dt_tdk_mantap'));
    }


    public function semua_peta()
    {
        $geoJsonContent = File::get(public_path('kobar_ruas.geojson'));
        $results = json_decode($geoJsonContent, true);
        // dd($results);
        foreach ($results['features'] as $r => $re) {
            $hitung = count($re['geometry']['coordinates'][0]);
            $hit = round($hitung / 2);
            $final['line'][$r]['no_ruas'] = $re['properties']['No__Regist'];
            $final['line'][$r]['awal'][0] = $re['geometry']['coordinates'][0][0][1];
            $final['line'][$r]['awal'][1] = $re['geometry']['coordinates'][0][0][0];
            $final['line'][$r]['tengah'][0] = $re['geometry']['coordinates'][0][$hit][1];
            $final['line'][$r]['tengah'][1] = $re['geometry']['coordinates'][0][$hit][0];
            $final['line'][$r]['akhir'][0] = $re['geometry']['coordinates'][0][$hitung - 1][1];
            $final['line'][$r]['akhir'][1] = $re['geometry']['coordinates'][0][$hitung - 1][0];
            $final['line'][$r]['nama'] = $re['properties']['Nama_Ruas'];
            $final['line'][$r]['panjang'] = $re['properties']['Panjang'];
            $final['line'][$r]['jarak'] = $re['properties']['JARAK'];
            foreach ($re['geometry']['coordinates'][0] as $key => $value) {
                $final['line'][$r]['coordinates'][$key][0] = (float)$value[1];
                $final['line'][$r]['coordinates'][$key][1] = (float)$value[0];
            }
        }

        return response()->json($final);
    }

    public function saturuas($id)
    {
        $ruas = Ruas::find($id);  
        // dd($ruas);
        $geoJsonContent = File::get(public_path('kobar_ruas.geojson'));
        $results = json_decode($geoJsonContent, true);
        $final = [];
        foreach ($results['features'] as $r => $re) {
            $noruas = $re['properties']['No__Regist'];
            if ($noruas == $ruas->no_ruas) {
                foreach ($re['geometry']['coordinates'][0] as $key => $value) {
                    $final['line'][$r]['coordinates'][$key][0] = (float)$value[1];
                    $final['line'][$r]['coordinates'][$key][1] = (float)$value[0];
                }
            }
        }

        return response()->json($final);
    }

    public function list_ruas($tahun)
    {
        $ruas = Ruas::where('tahun', $tahun)->get();
        return response()->json($ruas);
    }

    public function list_sta($id)
    {
        $sta = Data::where('id_ruas', $id)->get();
        return response()->json($sta);
    }

    public function getCenter($id)
    {
        $ruas = Ruas::find($id);
        return response()->json($ruas);
    }

    public function peta_ruas($id)
    {
        $ruas = Ruas::find($id);
        $geoJsonContent = File::get(public_path('kobar.geojson'));
        $decodedGeoJson = json_decode($geoJsonContent, true);
        $geo = [];
        $nilai_pencarian = $ruas->no_ruas;
        $results = array_filter($decodedGeoJson['features'], function ($feature) use ($nilai_pencarian) {
            return isset($feature['properties']['No__Regist']) && $feature['properties']['No__Regist'] == $nilai_pencarian;
        });
        $r = [];
        foreach ($results as $re) {
            array_push($r, $re);
        }
        // dd($r);
        $hitung = count($r);
        // dd($r[$hitung-1]['geometry']['coordinates']['0']);
        $hit = round($hitung / 2);
        // dd($hit);
        $geo['awal'] =  $r['0']['geometry']['coordinates']['0']['0'];
        $geo['akhir'] =  $r['1']['geometry']['coordinates']['0']['0'];
        $geo['coordinates'] =  $r['0']['geometry']['coordinates']['0'];
        $geo['type'] = "FeatureCollection";
        $geo['name'] = "kobar1";
        $geo['crs']['type'] = "name";
        $geo['crs']['properties']['name'] = "urn:ogc:def:crs:OGC:1.3:CRS84";
        $geo['features'] = $r;

        return response()->json($geo);
    }

    public function detailSta($id)
    {
        $sta = Data::find($id);
        return response()->json($sta);
    }

    public function store_detsta(Request $request)
    {
        // $qKeys = range(1, 22);  // Assuming q1, q2, ..., q22

        // $qValues = [];

        // foreach ($qKeys as $qKey) {
        //     $key = 'q' . $qKey;
        //     if ($request->has($key)) {
        //         $qValues[$key] = $request->input($key);
        //     }
        // }
        $sta = Data::find($request->itemid);
        switch ($request->q1) {
            case "Baik\/Rapat":
                $sta->susunan =  1;
                break;
            case "Retak":
                $sta->susunan =  2;
                break;
            default:
                break;
        }
        switch ($request->q2) {
            case "Baik\/Tidak Ada":
                $sta->kondisi =  1;
                break;
            case "Aspal berlebihan":
                $sta->kondisi =  2;
                break;
            case "Lepas-lepas":
                $sta->kondisi =  3;
                break;
            case "hancur":
                $sta->kondisi =  4;
                break;
            default:
                break;
        }
        switch ($request->q3) {
            case "Tidak ada":
                $sta->penurunan =  1;
                break;
            case "< 10% Luas":
                $sta->penurunan =  2;
                break;
            case "10-30% Luas":
                $sta->penurunan =  3;
                break;
            case "> 30% Luas":
                $sta->penurunan =  4;
                break;
            default:
                break;
        }
        switch ($request->q4) {
            case "Tidak ada":
                $sta->tambalan =  1;
                break;
            case "< 10% Luas":
                $sta->tambalan =  2;
                break;
            case "10-30% Luas":
                $sta->tambalan =  3;
                break;
            case "> 30% Luas":
                $sta->tambalan =  4;
                break;
            default:
                break;
        }
        switch ($request->q5) {
            case "Tidak ada":
                $sta->jenis =  1;
                break;
            case "Tidak Berhubungan":
                $sta->jenis =  2;
                break;
            case "Saling Berhubungan (berbidang Luas)":
                $sta->jenis =  3;
                break;
            case "Saling Berhubungan (berbidang Sempit)":
                $sta->jenis =  4;
                break;
            default:
                break;
        }
        switch ($request->q6) {
            case "Tidak ada":
                $sta->lebar =  1;
                break;
            case "Halus < 1 mm":
                $sta->lebar =  2;
                break;
            case "Sedang 1-3 mm":
                $sta->lebar =  1;
                break;
            case "Lebar > 3 mm":
                $sta->lebar =  2;
                break;
            default:
                break;
        }
        switch ($request->q7) {
            case "Tidak ada":
                $sta->luas =  1;
                break;
            case "< 10% Luas":
                $sta->luas =  2;
                break;
            case "10-30% Luas":
                $sta->luas =  3;
                break;
            case "> 30% Luas":
                $sta->luas =  4;
                break;
            default:
                break;
        }
        switch ($request->q8) {
            case "Tidak ada":
                $sta->jumlah =  1;
                break;
            case "< 1 / 100 m":
                $sta->jumlah =  2;
                break;
            case "1 - 5 / 100 m":
                $sta->jumlah =  3;
                break;
            case "> 5 / 100 m":
                $sta->jumlah =  4;
                break;
            default:
                break;
        }
        switch ($request->q9) {
            case "Tidak ada":
                $sta->ukuran =  1;
                break;
            case "Kecil - Dangkal":
                $sta->ukuran =  2;
                break;
            case "Kecil - Dalam":
                $sta->ukuran =  3;
                break;
            case "Besar - Dangkal":
                $sta->ukuran =  4;
                break;
            case "Besar - Dalam":
                $sta->ukuran =  5;
                break;
            default:
                break;
        }
        switch ($request->q10) {
            case "Tidak ada":
                $sta->bekas_roda =  1;
                break;
            case "< 1 cm dalam":
                $sta->bekas_roda =  2;
                break;
            case "1 - 3 cm dalam":
                $sta->bekas_roda =  3;
                break;
            case "> 3 cm dalam":
                $sta->bekas_roda =  4;
                break;
            default:
                break;
        }
        switch ($request->q11) {
            case "Tidak ada":
                $sta->kerusakan_kr =  1;
                break;
            case "Ringan":
                $sta->kerusakan_kr =  2;
                break;
            case "Ringan":
                $sta->kerusakan_kr =  3;
                break;
            default:
                break;
        }
        switch ($request->q12) {
            case "Tidak ada":
                $sta->kerusakan_kn =  1;
                break;
            case "Ringan":
                $sta->kerusakan_kn =  2;
                break;
            case "Berat":
                $sta->kerusakan_kn =  3;
                break;
            default:
                break;
        }
        switch ($request->q13) {
            case "Tidak ada":
                $sta->kondisi_b_kr =  1;
                break;
            case "Baik / Rata":
                $sta->kondisi_b_kr =  2;
                break;
            case "Bekas roda /  Erosi ringan":
                $sta->kondisi_b_kr =  3;
                break;
            case "Bekas Roda / Erosi Berat":
                $sta->kondisi_b_kr =  4;
                break;
            default:
                break;
        }
        switch ($request->q14) {
            case "Tidak ada":
                $sta->kondisi_b_kn =  1;
                break;
            case "Baik / Rata":
                $sta->kondisi_b_kn =  2;
                break;
            case "Bekas roda /  Erosi ringan":
                $sta->kondisi_b_kn =  3;
                break;
            case "Bekas Roda / Erosi Berat":
                $sta->kondisi_b_kn =  4;
                break;
            default:
                break;
        }
        switch ($request->q15) {
            case "Tidak ada":
                $sta->permukaan_kr =  1;
                break;
            case "Diatas permukaan jalan":
                $sta->permukaan_kr =  2;
                break;
            case "Rata dengan permukaan jalan":
                $sta->permukaan_kr =  3;
                break;
            case "Dibawah permukaan jalan":
                $sta->permukaan_kr =  4;
                break;
            case "> 10 cm dibawah permikaan jalan":
                $sta->permukaan_kr =  5;
                break;
            default:
                break;
        }
        switch ($request->q16) {
            case "Tidak ada":
                $sta->permukaan_kn =  1;
                break;
            case "Diatas permukaan jalan":
                $sta->permukaan_kn =  2;
                break;
            case "Rata dengan permukaan jalan":
                $sta->permukaan_kn =  3;
                break;
            case "Dibawah permukaan jalan":
                $sta->permukaan_kn =  4;
                break;
            case "> 10 cm dibawah permikaan jalan":
                $sta->permukaan_kn =  5;
                break;
            default:
                break;
        }
        switch ($request->q17) {
            case "Tidak ada":
                $sta->kondisi_s_kr =  1;
                break;
            case "Bersih":
                $sta->kondisi_s_kr =  2;
                break;
            case "Tertutup/Tersumbat":
                $sta->kondisi_s_kr =  3;
                break;
            case "Erosi":
                $sta->kondisi_s_kr =  4;
                break;
            default:
                break;
        }
        switch ($request->q18) {
            case "Tidak ada":
                $sta->kondisi_s_kn =  1;
                break;
            case "Longsor\/Runtuh":
                $sta->kondisi_s_kn =  2;
                break;
            default:
                break;
        }
        switch ($request->q19) {
            case "Tidak ada":
                $sta->kerusakan_l_kr =  1;
                break;
            case "Longsor\/Runtuh":
                $sta->kerusakan_l_kr =  2;
                break;
            default:
                break;
        }
        switch ($request->q20) {
            case "Tidak ada":
                $sta->kerusakan_l_kn =  1;
                break;
            case "Longsor\/Runtuh":
                $sta->kerusakan_l_kn =  2;
                break;
            default:
                break;
        }
        switch ($request->q21) {
            case "Tidak ada":
                $sta->trotoar_kr =  1;
                break;
            case "Baik\/Aman":
                $sta->trotoar_kr =  2;
                break;
            case "Berbahaya":
                $sta->trotoar_kr =  3;
                break;
            default:
                break;
        }
        switch ($request->q22) {
            case "Tidak ada":
                $sta->trotoar_kn =  1;
                break;
            case "Baik\/Aman":
                $sta->trotoar_kn =  2;
                break;
            case "Berbahaya":
                $sta->trotoar_kn =  3;
                break;
            default:
                break;
        }
        $sta->save();
        return response()->json($request->itemid);
    }

    public function detailFoto($id)
    {
        $sta = Data::find($id);
        return response()->json($sta);
    }

    public function simpanPickGambar(Request $request)
    {
        $file = base64_decode($request->image);
        $filegambar = "perfil-" . time() . ".jpg";
        $foto = Data::find($request->id);
        if ($request->ke == '1') {
            $foto->gambar_1 = $filegambar;
        } elseif ($request->ke == '2') {
            $foto->gambar_2 = $filegambar;
        } elseif ($request->ke == '3') {
            $foto->gambar_3 = $filegambar;
        }
        $foto->save();
        Storage::disk('foto_sta')->put($foto->id_ruas . '/' . $filegambar, $file);
        return response()->json('sukses');
    }

    public function simpanGambar(Request $request)
    {
        $file = $request->image;
        $extension = $file->getClientOriginalExtension();
        $filegambar = $file->getFilename() . '.' . $extension;
        $foto = Data::find($request->id);
        if ($request->ke == '1') {
            $foto->gambar_1 = $filegambar;
        } elseif ($request->ke == '2') {
            $foto->gambar_2 = $filegambar;
        } elseif ($request->ke == '3') {
            $foto->gambar_3 = $filegambar;
        }
        $foto->save();
        Storage::disk('foto_sta')->put($foto->id_ruas . '/' . $filegambar, File::get($file));
        return response()->json('sukses');
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $selectedYear = $request->tahun_login;
        $user = User::where('email', $username)->first();

        if ($user != null) {
            $passwordMatch = Hash::check($request->password, $user->password);

            if ($passwordMatch) {
                $user->update(['tahun_login' => $selectedYear]);

                return response()->json('success');
            } else {
                return response()->json('gagal1');
            }
        } else {
            return response()->json('gagal2');
        }
    }

    public function store_sta(Request $request)
    {
        $id_jalan = $request->id_jalan;
        $jenis_jalan = $request->jenis_jalan;
        if ($request->bukan_sta == null) {
            $centang = 0;
        } else {
            $centang = 1;
        }
        if ($jenis_jalan == 1) {
            $aspal = new Data;
            $aspal->id_ruas           = $request->id_jalan;
            $aspal->nama_sta          = $request->nama_sta;
            $aspal->d_patok           = $request->d_patok;
            $aspal->k_patok           = $request->k_patok;
            $aspal->catatan           = $request->catatan;
            $aspal->tanggal           = $request->tgl;
            $aspal->surveyor_1        = $request->surveyor_1;
            $aspal->surveyor_2        = $request->surveyor_2;
            $aspal->susunan           = $request->susunan;
            $aspal->kondisi           = $request->kondisi;
            $aspal->penurunan         = $request->penurunan;
            $aspal->tambalan          = $request->tambalan;
            $aspal->jenis             = $request->jenis;
            $aspal->lebar             = $request->lebar;
            $aspal->luas              = $request->luas;
            $aspal->jumlah            = $request->jumlah;
            $aspal->ukuran            = $request->ukuran;
            $aspal->bekas_roda        = $request->bekas_roda;
            $aspal->kerusakan_kr      = $request->kerusakan_kr;
            $aspal->kerusakan_kn      = $request->kerusakan_kn;
            $aspal->kondisi_b_kr      = $request->kondisi_b_kr;
            $aspal->kondisi_b_kn      = $request->kondisi_b_kn;
            $aspal->permukaan_kr      = $request->permukaan_kr;
            $aspal->permukaan_kn      = $request->permukaan_kn;
            $aspal->kondisi_s_kr      = $request->kondisi_s_kr;
            $aspal->kondisi_s_kn      = $request->kondisi_s_kn;
            $aspal->kerusakan_l_kr    = $request->kerusakan_l_kr;
            $aspal->kerusakan_l_kn    = $request->kerusakan_l_kn;
            $aspal->trotoar_kr        = $request->trotoar_kr;
            $aspal->trotoar_kn        = $request->trotoar_kn;
            $aspal->jenis_jalan       = 1;
            $aspal->kemiringan        = NULL;
            $aspal->pnurunan          = NULL;
            $aspal->erosi             = NULL;
            $aspal->ukuran_terbanyak  = NULL;
            $aspal->tebal             = NULL;
            $aspal->distribusi        = NULL;
            $aspal->j_lubang          = NULL;
            $aspal->u_lubang          = NULL;
            $aspal->bks_roda          = NULL;
            $aspal->bergelombang      = NULL;
            $aspal->k_bahu_kr         = NULL;
            $aspal->k_bahu_kn         = NULL;
            $aspal->p_bahu_kr         = NULL;
            $aspal->p_bahu_kn         = NULL;
            $aspal->k_saluran_kr      = NULL;
            $aspal->k_saluran_kn      = NULL;
            $aspal->lereng_kr         = NULL;
            $aspal->lereng_kn         = NULL;
            $aspal->trtr_kr           = NULL;
            $aspal->trtr_kn           = NULL;
            $aspal->centang           = $centang;
            $aspal->save();
        } elseif ($jenis_jalan == 2) {
            $aspal = new Data;
            $aspal->id_ruas           = $request->id_jalan;
            $aspal->nama_sta          = $request->nama_sta;
            $aspal->d_patok           = $request->d_patok;
            $aspal->k_patok           = $request->k_patok;
            $aspal->catatan           = $request->catatan;
            $aspal->tanggal           = $request->tgl;
            $aspal->surveyor_1        = $request->surveyor_1;
            $aspal->surveyor_2        = $request->surveyor_2;
            $aspal->susunan           = $request->susunan;
            $aspal->kondisi           = $request->kondisi;
            $aspal->penurunan         = $request->penurunan;
            $aspal->tambalan          = $request->tambalan;
            $aspal->jenis             = $request->jenis;
            $aspal->lebar             = $request->lebar;
            $aspal->luas              = $request->luas;
            $aspal->jumlah            = $request->jumlah;
            $aspal->ukuran            = $request->ukuran;
            $aspal->bekas_roda        = $request->bekas_roda;
            $aspal->kerusakan_kr      = $request->kerusakan_kr;
            $aspal->kerusakan_kn      = $request->kerusakan_kn;
            $aspal->kondisi_b_kr      = $request->kondisi_b_kr;
            $aspal->kondisi_b_kn      = $request->kondisi_b_kn;
            $aspal->permukaan_kr      = $request->permukaan_kr;
            $aspal->permukaan_kn      = $request->permukaan_kn;
            $aspal->kondisi_s_kr      = $request->kondisi_s_kr;
            $aspal->kondisi_s_kn      = $request->kondisi_s_kn;
            $aspal->kerusakan_l_kr    = $request->kerusakan_l_kr;
            $aspal->kerusakan_l_kn    = $request->kerusakan_l_kn;
            $aspal->trotoar_kr        = $request->trotoar_kr;
            $aspal->trotoar_kn        = $request->trotoar_kn;
            $aspal->jenis_jalan       = 1;
            $aspal->kemiringan        = NULL;
            $aspal->pnurunan          = NULL;
            $aspal->erosi             = NULL;
            $aspal->ukuran_terbanyak  = NULL;
            $aspal->tebal             = NULL;
            $aspal->distribusi        = NULL;
            $aspal->j_lubang          = NULL;
            $aspal->u_lubang          = NULL;
            $aspal->bks_roda          = NULL;
            $aspal->bergelombang      = NULL;
            $aspal->k_bahu_kr         = NULL;
            $aspal->k_bahu_kn         = NULL;
            $aspal->p_bahu_kr         = NULL;
            $aspal->p_bahu_kn         = NULL;
            $aspal->k_saluran_kr      = NULL;
            $aspal->k_saluran_kn      = NULL;
            $aspal->lereng_kr         = NULL;
            $aspal->lereng_kn         = NULL;
            $aspal->trtr_kr           = NULL;
            $aspal->trtr_kn           = NULL;
            $aspal->centang           = $centang;
            $aspal->save();
        } elseif ($jenis_jalan == 3) {
            $kerikil = new Kerikil;
            $kerikil->id_ruas           = $request->id_jalan;
            $kerikil->nama_sta          = $request->nama_sta;
            $kerikil->d_patok           = $request->d_patok;
            $kerikil->k_patok           = $request->k_patok;
            $kerikil->catatan           = $request->catatan;
            $kerikil->tanggal           = $request->tgl;
            $kerikil->surveyor_1        = $request->surveyor_1;
            $kerikil->surveyor_2        = $request->surveyor_2;
            $kerikil->susunan           =  NULL;
            $kerikil->kondisi           =  NULL;
            $kerikil->penurunan         =  NULL;
            $kerikil->tambalan          =  NULL;
            $kerikil->jenis             =  NULL;
            $kerikil->lebar             =  NULL;
            $kerikil->luas              =  NULL;
            $kerikil->jumlah            =  NULL;
            $kerikil->ukuran            =  NULL;
            $kerikil->bekas_roda        =  NULL;
            $kerikil->kerusakan_kr      =  NULL;
            $kerikil->kerusakan_kn      =  NULL;
            $kerikil->kondisi_b_kr      =  NULL;
            $kerikil->kondisi_b_kn      =  NULL;
            $kerikil->permukaan_kr      =  NULL;
            $kerikil->permukaan_kn      =  NULL;
            $kerikil->kondisi_s_kr      =  NULL;
            $kerikil->kondisi_s_kn      =  NULL;
            $kerikil->kerusakan_l_kr    =  NULL;
            $kerikil->kerusakan_l_kn    =  NULL;
            $kerikil->trotoar_kr        =  NULL;
            $kerikil->trotoar_kn        =  NULL;
            $kerikil->jenis_jalan       = 3;
            $kerikil->kemiringan        = $request->_kemiringan;
            $kerikil->pnurunan          = $request->_pnurunan;
            $kerikil->erosi             = $request->_erosi;
            $kerikil->ukuran_terbanyak  = $request->_ukuran_terbanyak;
            $kerikil->tebal             = $request->_tebal;
            $kerikil->distribusi        = $request->_distribusi;
            $kerikil->j_lubang          = $request->_j_lubang;
            $kerikil->u_lubang          = $request->_u_lubang;
            $kerikil->bks_roda          = $request->_bks_roda;
            $kerikil->bergelombang      = $request->_bergelombang;
            $kerikil->k_bahu_kr         = $request->_k_bahu_kr;
            $kerikil->k_bahu_kn         = $request->_k_bahu_kn;
            $kerikil->p_bahu_kr         = $request->_p_bahu_kr;
            $kerikil->p_bahu_kn         = $request->_p_bahu_kn;
            $kerikil->k_saluran_kr      = $request->_k_saluran_kr;
            $kerikil->k_saluran_kn      = $request->_k_saluran_kn;
            $kerikil->lereng_kr         = $request->_lereng_kr;
            $kerikil->lereng_kn         = $request->_lereng_kn;
            $kerikil->trtr_kr           = $request->_trtr_kr;
            $kerikil->trtr_kn           = $request->_trtr_kn;
            $kerikil->centang           = $centang;
            $kerikil->save();
        } elseif ($jenis_jalan == 4) {
            $kerikil = new Kerikil;
            $kerikil->id_ruas           = $request->id_jalan;
            $kerikil->nama_sta          = $request->nama_sta;
            $kerikil->d_patok           = $request->d_patok;
            $kerikil->k_patok           = $request->k_patok;
            $kerikil->catatan           = $request->catatan;
            $kerikil->tanggal           = $request->tgl;
            $kerikil->surveyor_1        = $request->surveyor_1;
            $kerikil->surveyor_2        = $request->surveyor_2;
            $kerikil->susunan           =  NULL;
            $kerikil->kondisi           =  NULL;
            $kerikil->penurunan         =  NULL;
            $kerikil->tambalan          =  NULL;
            $kerikil->jenis             =  NULL;
            $kerikil->lebar             =  NULL;
            $kerikil->luas              =  NULL;
            $kerikil->jumlah            =  NULL;
            $kerikil->ukuran            =  NULL;
            $kerikil->bekas_roda        =  NULL;
            $kerikil->kerusakan_kr      =  NULL;
            $kerikil->kerusakan_kn      =  NULL;
            $kerikil->kondisi_b_kr      =  NULL;
            $kerikil->kondisi_b_kn      =  NULL;
            $kerikil->permukaan_kr      =  NULL;
            $kerikil->permukaan_kn      =  NULL;
            $kerikil->kondisi_s_kr      =  NULL;
            $kerikil->kondisi_s_kn      =  NULL;
            $kerikil->kerusakan_l_kr    =  NULL;
            $kerikil->kerusakan_l_kn    =  NULL;
            $kerikil->trotoar_kr        =  NULL;
            $kerikil->trotoar_kn        =  NULL;
            $kerikil->jenis_jalan       = 4;
            $kerikil->kemiringan        = $request->_kemiringan;
            $kerikil->pnurunan          = $request->_pnurunan;
            $kerikil->erosi             = $request->_erosi;
            $kerikil->ukuran_terbanyak  = $request->_ukuran_terbanyak;
            $kerikil->tebal             = $request->_tebal;
            $kerikil->distribusi        = $request->_distribusi;
            $kerikil->j_lubang          = $request->_j_lubang;
            $kerikil->u_lubang          = $request->_u_lubang;
            $kerikil->bks_roda          = $request->_bks_roda;
            $kerikil->bergelombang      = $request->_bergelombang;
            $kerikil->k_bahu_kr         = $request->_k_bahu_kr;
            $kerikil->k_bahu_kn         = $request->_k_bahu_kn;
            $kerikil->p_bahu_kr         = $request->_p_bahu_kr;
            $kerikil->p_bahu_kn         = $request->_p_bahu_kn;
            $kerikil->k_saluran_kr      = $request->_k_saluran_kr;
            $kerikil->k_saluran_kn      = $request->_k_saluran_kn;
            $kerikil->lereng_kr         = $request->_lereng_kr;
            $kerikil->lereng_kn         = $request->_lereng_kn;
            $kerikil->trtr_kr           = $request->_trtr_kr;
            $kerikil->trtr_kn           = $request->_trtr_kn;
            $kerikil->centang           = $centang;
            $kerikil->save();
        }

        return response()->json('sukses');
    }

    public function store_rni(Request $request)
    {
        $sta = Data::find($request->id_sta);
        if (!$sta) {
            return response()->json(['error' => 'Record not found'], 404);
        }
        $sta->lokasi_dr           =  $request->lokasi_dr;
        $sta->lokasi_ke           =  $request->lokasi_ke;
        $sta->t_jalan         =  $request->t_jalan;
        $sta->median          =  $request->median;
        $sta->p_tahun             =  $request->p_tahun;
        $sta->p_jenis             =  $request->p_jenis;
        $sta->p_lebar              =  $request->p_lebar;
        $sta->b_kr_jenis            =  $request->b_kr_jenis;
        $sta->b_kr_lebar            =  $request->b_kr_lebar;
        $sta->b_kn_jenis        =  $request->b_kn_jenis;
        $sta->b_kn_lebar      =  $request->b_kn_lebar;
        $sta->ss_kr_jenis      =  $request->ss_kr_jenis;
        $sta->ss_kr_kondisi      =  $request->ss_kr_kondisi;
        $sta->ss_kr_lebar      =  $request->ss_kr_lebar;
        $sta->ss_kr_dalam      =  $request->ss_kr_dalam;
        $sta->ss_kn_jenis      =  $request->ss_kn_jenis;
        $sta->ss_kn_kondisi      =  $request->ss_kn_kondisi;
        $sta->ss_kn_lebar      =  $request->ss_kn_lebar;
        $sta->ss_kn_dalam    =  $request->ss_kn_dalam;
        $sta->t_kr    =  $request->t_kr;
        $sta->t_kn        =  $request->t_kn;
        $sta->a_vertical        =  $request->a_vertical;
        $sta->a_horizontal        =  $request->a_horizontal;
        $sta->tl_kr        =  $request->tl_kr;
        $sta->tl_kn        =  $request->tl_kn;
        $sta->save();
        return response()->json('sukses');
    }
}
