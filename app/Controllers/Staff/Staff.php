<?php

namespace App\Controllers\Staff;


use App\Models\PermintaanModel;
use App\Models\DoModel;
use App\Controllers\BaseController;

class Staff extends BaseController
{
    public function __construct()
    {
        $this->reqPerangkat = new PermintaanModel();
        $this->listDo = new DoModel();
    }

    public function index()
    {
        $newPermit = $this->reqPerangkat->getData();
        $newProses = $this->reqPerangkat->getDataProses();
        $newKirim = $this->reqPerangkat->getDataKirim();
        $builder = $this->db->table('tbl_newpermintaan');
        $hasil = $builder->distinct('code_permintaan')->select('code_permintaan')->where('status', 1)->CountAllResults();
        $hasil1 = $builder->distinct('code_permintaan')->select('code_permintaan')->where('status', 2)->CountAllResults();
        $hasil2 = $builder->distinct('code_permintaan')->select('code_permintaan')->where('status', 3)->CountAllResults();
        $data = [
            'title' => 'Dashboard',
            'data' => $newPermit + $hasil,
            'proses' => $newProses + $hasil1,
            'kirim' => $newKirim + $hasil2,
        ];
        return view('Staff/index', $data);
    }

    public function Proses()
    {
        $permintaan = $this->reqPerangkat->getPermintaan();
        $data = [
            'title' => 'Permintaan Perangkat Store',
            'request' => $permintaan
        ];
        return view('Staff/listPermintaan', $data);
    }

    public function NewProses()
    {
        $builder = $this->db->table('tbl_newpermintaan');
        $hasil = $builder->select('*')->where('status', 1)->orWhere('status', 2)->groupBy('code_permintaan')->orderBy('tanggal_permintaan DESC')->get()->getResultArray();
        $data = [
            'title' => 'Permintaan Perangkat New Store',
            'request' => $hasil
        ];
        return view('Staff/listPermintaanNew', $data);
    }

    public function Cancel($code)
    {
        $this->db->table('tbl_permintaan')->where('code_permintaan', $code)->update(['status' => 0, 'tanggal_proses' => date('Y-m-d')]);
        return redirect()->back()->with('success', 'Kode Permintaan ' . $code . ' Telah Di Cancel');
    }


    public function newCancel($code)
    {
        $this->db->table('tbl_newpermintaan')->where('code_permintaan', $code)->update(['status' => 0, 'tanggal_proses' => date('Y-m-d')]);
        return redirect()->back()->with('success', 'Kode Permintaan ' . $code . ' Telah Di Cancel');
    }

    public function ProsesPermintaan($code)
    {
        $result = $this->db->table('tbl_permintaan')->select('*')->join('master_perangkat', 'master_perangkat.id_perangkat = tbl_permintaan.code_perangkat')->where('tbl_permintaan.code_permintaan', $code)->get()->getResultArray();
        $data = [
            'title' => 'Proses Permintaan Perangkat',
            'result' => $result
        ];
        return view('Staff/prosesPermintaan', $data);
    }

    public function NewProsesPermintaan($code)
    {
        $result = $this->db->table('tbl_newpermintaan')->select('*')->join('master_perangkat', 'master_perangkat.id_perangkat = tbl_newpermintaan.code_perangkat')->where('tbl_newpermintaan.code_permintaan', $code)->get()->getResultArray();
        $data = [
            'title' => 'Proses Permintaan New Store',
            'result' => $result
        ];
        return view('Staff/newProsesPermintaan', $data);
    }

    public function ProsesPermintaanStore($code)
    {
        if (!$this->validate([
            'no_do' => 'required|is_unique[tbl_do.no_do]'
        ])) {
            return redirect()->back()->withInput()->with('error', 'Nomor DO ' . $this->request->getVar('no_do') . ' Sudah Digunakan');
        }
        $data = [
            $code_store         = $this->request->getVar('code_store'),
            $nama_store         = $this->request->getVar('nama_store'),
            $nik_user           = $this->request->getVar('nik_user'),
            $nama_user          = $this->request->getVar('nama_user'),
            $code_permintaan    = $this->request->getVar('code_permintaan'),
            $no_do              = $this->request->getVar('no_do'),
            $perangkat          = $this->request->getVar('perangkat'),
            $kategori           = $this->request->getVar('kategori'),
            $sn                 = $this->request->getVar('sn'),
            $merk               = $this->request->getVar('merk'),
            $tahun              = $this->request->getVar('tahun'),
            $tgl_proses         = $this->request->getVar('tanggal'),
            $approved           = $this->request->getVar('approved'),
            $ket                = $this->request->getVar('keterangan'),
            $jmlh = count($perangkat),
        ];
        $saveDo = $this->db->table('tbl_do')->insert(['no_do' => $this->request->getVar('no_do')]);
        if ($saveDo) {
            $update = $this->db->table('tbl_permintaan')->where('code_permintaan', $code)->update(['status' => 2, 'tanggal_proses' => date('Y-m-d')]);
        }
        if ($update) {
            for ($i = 0; $i < $jmlh; $i++) {
                $this->db->table('tbl_proses')->insert(
                    [
                        'code_store'         => $code_store,
                        'nama_store'         => $nama_store,
                        'nik_user'           => $nik_user,
                        'nama_user'          => $nama_user,
                        'code_permintaan'    => $code_permintaan,
                        'no_do'              => $no_do,
                        'kategori'           => $kategori[$i],
                        'perangkat'          => $perangkat[$i],
                        'sn'                 => $sn[$i],
                        'merk'               => $merk[$i],
                        'tahun'              => $tahun[$i],
                        'tgl_proses'         => $tgl_proses,
                        'approved'           => $approved,
                        'keterangan'          => $ket[$i],
                    ]
                );
            }
            return redirect()->to(site_url('/Proses'))->with('success', 'Permintaan berhasil di proses');
        } else {
            return redirect()->to(site_url('/Proses'))->with('error', 'Permintaan gagal di proses');
        }
    }

    public function NewProsesPermintaanStore($code)
    {
        if (!$this->validate([
            'no_do' => 'required|is_unique[tbl_do.no_do]'
        ])) {
            return redirect()->back()->withInput()->with('error', 'Nomor DO ' . $this->request->getVar('no_do') . ' Sudah Digunakan');
        }
        $data = [
            $code_store         = $this->request->getVar('code_store'),
            $nama_store         = $this->request->getVar('nama_store'),
            $nik_user           = $this->request->getVar('nik_user'),
            $nama_user          = $this->request->getVar('nama_user'),
            $code_permintaan    = $this->request->getVar('code_permintaan'),
            $no_do              = $this->request->getVar('no_do'),
            $perangkat          = $this->request->getVar('perangkat'),
            $kategori           = $this->request->getVar('kategori'),
            $sn                 = $this->request->getVar('sn'),
            $merk               = $this->request->getVar('merk'),
            $tahun              = $this->request->getVar('tahun'),
            $tgl_proses         = $this->request->getVar('tanggal'),
            $approved           = $this->request->getVar('approved'),
            $ket                = $this->request->getVar('keterangan'),
            $jmlh = count($perangkat),
        ];
        $saveDo = $this->db->table('tbl_do')->insert(['no_do' => $this->request->getVar('no_do')]);
        if ($saveDo) {
            $update = $this->db->table('tbl_newpermintaan')->where('code_permintaan', $code)->update(['status' => 2, 'tanggal_proses' => date('Y-m-d')]);
        }
        if ($update) {
            for ($i = 0; $i < $jmlh; $i++) {
                $this->db->table('tbl_newproses')->insert(
                    [
                        'code_store'         => $code_store,
                        'nama_store'         => $nama_store,
                        'nik_user'           => $nik_user,
                        'nama_user'          => $nama_user,
                        'code_permintaan'    => $code_permintaan,
                        'no_do'              => $no_do,
                        'kategori'           => $kategori[$i],
                        'perangkat'          => $perangkat[$i],
                        'sn'                 => $sn[$i],
                        'merk'               => $merk[$i],
                        'tahun'              => $tahun[$i],
                        'tgl_proses'         => $tgl_proses,
                        'approved'           => $approved,
                        'keterangan'          => $ket[$i],
                    ]
                );
            }
            return redirect()->to(site_url('/NewProses'))->with('success', 'Permintaan berhasil di proses');
        } else {
            return redirect()->to(site_url('/NewProses'))->with('error', 'Permintaan gagal di proses');
        }
    }


    public function Laporan()
    {
        $listDo = $this->listDo->getData();
        $data = [
            'title' => 'History Permintaan Perangkat Existing Store',
            'listDo' => $listDo,
        ];
        return view('Staff/laporan', $data);
    }

    public function newLaporan()
    {
        $listDo = $this->db->table('tbl_newproses')->select('*')->get()->getResultArray();
        $data = [
            'title' => 'History Permintaan Perangkat New Store',
            'listDo' => $listDo,
        ];
        return view('Staff/laporanNew', $data);
    }

    public function PrintDo()
    {
        $permintaan = $this->reqPerangkat->Print();
        $data = [
            'title' => 'Print Delivery Order',
            'request' => $permintaan
        ];
        return view('Staff/PrintDo', $data);
    }

    public function NewPrint()
    {
        $builder = $this->db->table('tbl_newpermintaan')->join('tbl_newproses', 'tbl_newpermintaan.code_permintaan = tbl_newproses.code_permintaan');
        $hasil = $builder->select('*')->where('tbl_newpermintaan.status', 3)->groupBy('tbl_newpermintaan.code_permintaan')->orderBy('tbl_newproses.tgl_proses DESC')->get()->getResultArray();
        $data = [
            'title' => 'Print Delivery Order New Store',
            'request' => $hasil
        ];
        return view('Staff/NewPrint', $data);
    }


    // public function cekSN()
    // {
    //     // $sn  = $this->request->getVar('sn');
    //     if ($_GET['sn']) {
    //         # code...
    //         $data['sn'] = $this->listDo->getRow();
    //         return $this->response->setJSON($data);
    //     }
    // }

    public function print($store)
    {
        if ($store != null) {
            $query = $this->db->table('tbl_proses')->getwhere(['code_permintaan' => $store]);
            $result = $this->db->table('tbl_proses')->where(['code_permintaan' => $store])->get()->getResultArray();
            if ($query->resultID->num_rows > 0) {
                $data['store'] = $query->getRow();
                $dataa = [
                    'store' => $data['store'],
                    'result' => $result
                ];
                return view('Staff/print', $dataa);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data Tidak Ditemukan');
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data Tidak Ditemukan');
        }
    }


    public function PrintNew($store)
    {
        if ($store != null) {
            $query = $this->db->table('tbl_newproses')->getwhere(['code_permintaan' => $store]);
            $result = $this->db->table('tbl_newproses')->where(['code_permintaan' => $store])->get()->getResultArray();
            if ($query->resultID->num_rows > 0) {
                $data['store'] = $query->getRow();
                $dataa = [
                    'store' => $data['store'],
                    'result' => $result
                ];
                return view('Staff/printNew', $dataa);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data Tidak Ditemukan');
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data Tidak Ditemukan');
        }
    }
}
