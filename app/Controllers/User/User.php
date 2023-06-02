<?php

namespace App\Controllers\User;

use App\Models\StoreModel;
use App\Models\PerangkatModel;
use App\Models\PermintaanModel;
use App\Models\AsetModel;
use App\Controllers\BaseController;

class User extends BaseController
{
    public function __construct()
    {
        $this->store = new StoreModel();
        $this->perangkat = new PerangkatModel();
        $this->permintaan = new PermintaanModel();
        $this->Aset = new AsetModel();
    }

    public function index()
    {
        $result = $this->store->getDataAll();
        $lokasi = $this->store->lokasi2();
        $lokasi1 = $this->store->lokasi();
        $maintenance = $this->store->getStatus1();
        $maintenance1 = $this->store->getStatus0();
        $board = $this->Aset->order_by();
        $data = [
            'title' => 'Dashboard',
            'result' => $result,
            'maintenance' => $maintenance,
            'maintenance1' => $maintenance1,
            'lokasi' => $lokasi,
            'lokasi1' => $lokasi1,
            'board' => $board,
        ];
        return view('User/Index', $data);
    }

    public function status()
    {
        $result = $this->Aset->group_by();
        $hasil = $this->store->where('nik_user', session('nik_user'))->findAll();
        $hasil1 = $this->perangkat->orderby('nama_perangkat')->findAll();
        $data = [
            'title' => 'Status Perangkat',
            'hasil' => $hasil,
            'dataperangkat' => $hasil1,
            'dataa' => $result
        ];
        return view('User/Status', $data);
    }

    public function perangkat()
    {
        $hasil = $this->store->where('nik_user', session('nik_user'))->findAll();
        $hasil1 = $this->perangkat->orderby('nama_perangkat')->findAll();
        $data = [
            'title' => 'Data Perangkat',
            'hasil' => $hasil,
            'dataperangkat' => $hasil1
        ];
        return view('User/Perangkat', $data);
    }

    public function SavePerangkat()
    {
        $data = [
            $code_store         = $this->request->getVar('code_store'),
            $nik_user           = $this->request->getVar('nik_user'),
            $nama_store         = $this->request->getVar('nama_store'),
            $nama_user          = $this->request->getVar('nama_user'),
            $kategori           = $this->request->getVar('kategori'),
            $perangkat          = $this->request->getVar('perangkat'),
            $merk               = $this->request->getVar('merk'),
            $sn                 = $this->request->getVar('sn'),
            $status             = $this->request->getVar('status'),
            $tahun             = $this->request->getVar('tahun'),

            $jmlh = count($kategori),
        ];
        for ($i = 0; $i < $jmlh; $i++) {
            $this->db->table('data_aset')->insert(
                [
                    'code_store' => $code_store,
                    'nik_user' => $nik_user,
                    'nama_store' => $nama_store,
                    'nama_user' => $nama_user,
                    'kategori' => $kategori[$i],
                    'perangkat' => $perangkat[$i],
                    'merk' => $merk[$i],
                    'sn' => $sn[$i],
                    'tahun' => $tahun[$i],
                    'status' => $status
                ]

            );
        }

        return redirect()->to(site_url('Perangkat'))->with('success', 'Data Berhasil DIsimpan');
    }

    public function FormMaintenance()
    {
        $hasil = $this->store->where(['nik_user' => session('nik_user'), 'lokasi' => 1, 'status' => 0])->findAll();
        $data = [
            'title' => 'Maintenance Perangkat',
            'store' => $hasil
        ];
        return view('User/FormMaintenance', $data);
    }

    public function cctv_network()
    {
        $hasil = $this->store->where('nik_user', session('nik_user'))->findAll();
        $data = [
            'title' => 'Data CCTV & Network',
            'hasil' => $hasil
        ];

        return view('User/Other', $data);
    }

    public function permintaan()
    {
        $hasil = $this->store->where('nik_user', session('nik_user'))->findAll();
        $hasil1 = $this->perangkat->orderby('nama_perangkat')->findAll();
        $data = [
            'title' => 'Permintaan Perangkat',
            'hasil' => $hasil,
            'dataperangkat' => $hasil1
        ];
        return view('User/Permintaan', $data);
    }

    public function SavePermintaan()
    {

        $data = [
            $code_permintaan    = $this->request->getVar('code_permintaan'),
            $code_store         = $this->request->getVar('code_store'),
            $nik_user           = $this->request->getVar('nik_user'),
            $nama_store         = $this->request->getVar('nama_store'),
            $nama_user          = $this->request->getVar('nama_user'),
            $data_perangkat     = $this->request->getVar('perangkat'),
            $merk               = $this->request->getVar('merk'),
            $kategori           = $this->request->getVar('kategori'),
            $sn                 = $this->request->getVar('sn'),
            $keterangan         = $this->request->getVar('keterangan'),
            $tanggal_permintaan = $this->request->getVar('tanggal'),
            $status             = $this->request->getVar('status'),
            $jmlh = count($data_perangkat),
        ];
        for ($i = 0; $i < $jmlh; $i++) {
            $this->permintaan->save(
                [
                    'code_permintaan' => $code_permintaan,
                    'code_store' => $code_store,
                    'nik_user' => $nik_user,
                    'nama_store' => $nama_store,
                    'nama_user' => $nama_user,
                    'code_perangkat' => $data_perangkat[$i],
                    'merk' => $merk[$i],
                    'kategori' => $kategori[$i],
                    'sn' => $sn[$i],
                    'keterangan' => $keterangan[$i],
                    'tanggal_permintaan' => $tanggal_permintaan,
                    'status' => $status
                ]
            );
        }
        return redirect()->to(site_url('PermintaanPerangkat'))->with('success', 'Permintaan Anda Telah Dikirim');
    }

    public function EditProfile($nik)
    {
        if ($nik != null) {
            $query = $this->db->table('user')->getwhere(['nik_user' => $nik]);
            if ($query->resultID->num_rows > 0) {
                $data['user'] = $query->getRow();
                $dataa = [
                    'title' => 'Edit Profile',
                    'user' => $data['user']
                ];
                return view('User/EditProfile', $dataa);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data Tidak Ditemukan');
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data Tidak Ditemukan');
        }
    }

    public function UpdateProfile($nik)
    {
        if ($this->request->getPost('pass_user') == '') {
            $data = [
                'nik_user' => $this->request->getVar('nik_user'),
                'nama_user' => $this->request->getVar('nama_user'),
                'username' => $this->request->getVar('username'),
                'email_user' => $this->request->getVar('email_user'),
                'level_user' => $this->request->getVar('level_user')
            ];
        }
        if ($this->request->getPost('pass_user') != '') {
            $data = [
                'nik_user' => $this->request->getVar('nik_user'),
                'nama_user' => $this->request->getVar('nama_user'),
                'username' => $this->request->getVar('username'),
                'pass_user' => sha1($this->request->getVar('pass_user')),
                'email_user' => $this->request->getVar('email_user'),
                'level_user' => $this->request->getVar('level_user')
            ];
        }
        $update = $this->db->table('user')->where(['nik_user' => $nik])->update($data);
        if ($update) {
            $data = [
                'nik_user' => $this->request->getVar('nik_user'),
                'nama_user' => $this->request->getVar('nama_user'),
            ];
            $this->db->table('data_aset')->where(['nik_user' => $nik])->update($data);
        }
        return redirect()->back()->with('success', 'Data Berhasil Diupdate');
    }

    public function SaveOther()
    {
        if (!$this->validate([
            'code_store' => 'required|is_unique[cctv_network.code_store]'
        ])) {
            return redirect()->back()->with('error', 'Kode Store ' . $this->request->getVar('code_store') . ' Sudah Terdaftar');
        }
        $this->db->table('cctv_network')->insert([
            'code_store'         => $this->request->getVar('code_store'),
            'nik_user'           => $this->request->getVar('nik_user'),
            'nama_store'         => $this->request->getVar('nama_store'),
            'nama_user'          => $this->request->getVar('nama_user'),
            'kategori'           => $this->request->getVar('kategori'),
            'dvr'                => $this->request->getVar('dvr'),
            'monitor'            => $this->request->getVar('monitor'),
            'ups'                => $this->request->getVar('ups'),
            'tipe'               => $this->request->getVar('tipe'),
            'jumlah'             => $this->request->getVar('jumlah'),
            'kategori1'          => $this->request->getVar('kategori1'),
            'sdwan'              => $this->request->getVar('sdwan'),
            'wifi'               => $this->request->getVar('wifi'),
            'phone'              => $this->request->getVar('phone'),
            'status'             => $this->request->getVar('status')
        ]);
        return redirect()->to(site_url('Other'))->with('success', 'Data berhasil disimpan');
    }

    public function SaveMaintenance($id)
    {
        $data = [
            $id_data            = $this->request->getVar('id_data'),
            $id                 = $this->request->getVar('code_store'),
            $nik_user           = $this->request->getVar('nik_user'),
            $nama_store         = $this->request->getVar('nama_store'),
            $nama_user          = $this->request->getVar('nama_user'),
            $kategori           = $this->request->getVar('kategori'),
            $perangkat          = $this->request->getVar('perangkat'),
            $merk               = $this->request->getVar('merk'),
            $sn                 = $this->request->getVar('sn'),
            $tahun              = $this->request->getVar('tahun'),
            $status             = $this->request->getVar('status'),
            $jmlh = count($kategori),

        ];
        for ($i = 0; $i < $jmlh; $i++) {
            $update = $this->db->table('data_aset')->wherein('id_data', $id_data)->where('code_store', $id)->ignore()->update(
                [
                    'id_data' => $id_data[$i],
                    'code_store' => $id,
                    'nik_user' => $nik_user,
                    'nama_store' => $nama_store,
                    'nama_user' => $nama_user,
                    'kategori' => $kategori[$i],
                    'perangkat' => $perangkat[$i],
                    'merk' => $merk[$i],
                    'sn' => $sn[$i],
                    'tahun' => $tahun[$i],
                    'status' => $status[$i],
                ]
            );
            if ($update) {
                $data = [
                    'status' => 1,
                ];
                $this->db->table('store')->where(['code_store' => $id])->update($data);
            }
        }
        return redirect()->to(base_url('FormMaintenance'))->with('maintenance', 'Data Berhasil Dimaintenance');
    }

    public function Maintenance()
    {
        $hasil = $this->db->table('cctv_network')->where(['nik_user' => session('nik_user'), 'status' => 0])->get()->getResultArray();
        $data = [
            'title' => 'Maintenance CCTV & Network',
            'store' => $hasil
        ];
        return view('User/Maintenance', $data);
    }

    public function SaveCctv($id)
    {

        $this->db->table('cctv_network')->where('code_store', $id)->update(
            $data = [
                'code_store'         => $this->request->getVar('code_store'),
                'nik_user'           => $this->request->getVar('nik_user'),
                'nama_store'         => $this->request->getVar('nama_store'),
                'nama_user'          => $this->request->getVar('nama_user'),
                'kategori'           => $this->request->getVar('kategori'),
                'dvr'                => $this->request->getVar('dvr'),
                'monitor'            => $this->request->getVar('monitor'),
                'ups'                => $this->request->getVar('ups'),
                'tipe'               => $this->request->getVar('tipe'),
                'jumlah'             => $this->request->getVar('jumlah'),
                'kategori1'          => $this->request->getVar('kategori1'),
                'sdwan'              => $this->request->getVar('sdwan'),
                'wifi'               => $this->request->getVar('wifi'),
                'phone'              => $this->request->getVar('phone'),
                'status'             => $this->request->getVar('status')
            ]
        );

        return redirect()->to(base_url('Maintenance'))->with('success', 'Data Berhasil Dimaintenance');
    }

    public function ReportFormMaintenance()
    {
        $hasil = $this->store->where(['nik_user' => session('nik_user'), 'status' => 1])->findAll();
        $data = [
            'title' => 'Cetak Form Maintenance',
            'hasil' => $hasil
        ];
        return view('User/ReportFormMaintenance', $data);
    }

    public function ReportPermintaan()
    {
        // $query = $this->db->table('tbl_permintaan')->join('master_perangkat', 'master_perangkat.id_perangkat = tbl_permintaan.code_perangkat')->where('nik_user', session('nik_user'))->orderby('nama_store')->get()->getResultArray();
        $query = $this->db->table('tbl_proses')->join('tbl_permintaan', 'tbl_proses.code_permintaan = tbl_permintaan.code_permintaan')->where('tbl_proses.nik_user', session('nik_user'))->get()->getResultArray();
        $data = [
            'title' => 'History Permintaan Perangkat',
            'result' => $query
        ];
        return view('User/ReportPermintaan', $data);
    }

    public function addStore()
    {
        if (!$this->validate([
            'code_store' => 'required|is_unique[store.code_store]'
        ])) {
            return redirect()->to(site_url('User'))->withInput()->with('error', 'Kode Store ' . $this->request->getVar('code_store') . ' Sudah Terdaftar');
        }
        $data = [
            'code_store'         => $this->request->getVar('code_store'),
            'nik_user'           => $this->request->getVar('nik_user'),
            'nama_store'         => $this->request->getVar('nama_store'),
            'nama_user'          => $this->request->getVar('nama_user'),
            'lokasi     '        => $this->request->getVar('lokasi'),
        ];
        $save = $this->db->table('store')->insert($data);

        if ($save) {
            $data1 = [
                'code_store'         => $this->request->getVar('code_store'),
                'nama_store'         => $this->request->getVar('nama_store'),
            ];
            $this->db->table('master_store')->insert($data1);
            return redirect()->to(site_url('User'))->with('success', 'Store Berhasil DItambah');
        } else {
            return redirect()->to(site_url('User'))->withInput()->with('error', 'Kode Store ' . $this->request->getVar('code_store') . ' Sudah Terdaftar');
        }
    }

    public function PrintRpt($store)
    {
        if ($store != null) {
            $query = $this->db->table('store')->getwhere(['nama_store' => $store]);
            if ($query->resultID->num_rows > 0) {
                $data['store'] = $query->getRow();
                $dataa = [
                    'title' => 'Print Form Maintenance',
                    'store' => $data['store']
                ];
                return view('User/Print/PrintRpt_Maintenance', $dataa);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data Tidak Ditemukan');
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data Tidak Ditemukan');
        }
    }

    public function confirmasiPerangkat()
    {
        $result = $this->db->table('tbl_proses')->select('*')->join('tbl_permintaan', 'tbl_permintaan.code_permintaan = tbl_proses.code_permintaan')->where(['tbl_permintaan.nik_user' => session('nik_user'), 'tbl_permintaan.status' => 2])->groupBy('no_do')->get()->getResultArray();
        $result1 = $this->db->table('tbl_newproses')->select('*')->join('tbl_newpermintaan', 'tbl_newpermintaan.code_permintaan = tbl_newproses.code_permintaan')->where(['tbl_newpermintaan.nik_user' => session('nik_user'), 'tbl_newpermintaan.status' => 2])->groupBy('no_do')->get()->getResultArray();
        $list = $this->db->table('tbl_proses')->where('nik_user', session('nik_user'))->get()->getResultArray();
        $list1 = $this->db->table('tbl_newproses')->where('nik_user', session('nik_user'))->get()->getResultArray();
        $data = $this->db->table('tbl_permintaan');
        $dataq = $this->db->table('tbl_newpermintaan');
        $hasil = $data->distinct('code_permintaan')->select('code_permintaan')->where('status', 2)->where('nik_user', session('nik_user'))->CountAllResults();
        $hasil1 = $dataq->distinct('code_permintaan')->select('code_permintaan')->where('status', 2)->where('nik_user', session('nik_user'))->CountAllResults();
        $data = [
            'title' => 'Konfirmasi Perangkat',
            'result' => $result,
            'result1' => $result1,
            'list' => $list,
            'list1' => $list1,
            'hasil' => $hasil,
            'hasil1' => $hasil1,
        ];
        return view('User/Confirmasi', $data);
    }

    public function Conf($do)
    {
        $data = [
            $code_store         = $this->request->getVar('code_store'),
            $nik_user           = $this->request->getVar('nik_user'),
            $nama_store         = $this->request->getVar('nama_store'),
            $nama_user          = $this->request->getVar('nama_user'),
            $kategori           = $this->request->getVar('kategori'),
            $perangkat          = $this->request->getVar('perangkat'),
            $merk               = $this->request->getVar('merk'),
            $sn                 = $this->request->getVar('sn'),
            $tahun              = $this->request->getVar('tahun'),
            $status             = $this->request->getVar('status'),
            $jml = count($perangkat)
        ];
        for ($i = 0; $i < $jml; $i++) {
            $save = $this->db->table('data_aset')->insert(
                [
                    'code_store' => $code_store,
                    'nik_user' => $nik_user,
                    'nama_store' => $nama_store,
                    'nama_user' => $nama_user,
                    'kategori' => $kategori[$i],
                    'perangkat' => $perangkat[$i],
                    'merk' => $merk[$i],
                    'sn' => $sn[$i],
                    'tahun' => $tahun[$i],
                    'status' => $status
                ]
            );
        }
        if ($save) {
            $this->db->table('tbl_permintaan')->where(['code_permintaan' => $do])->update(['status' => 3]);
            return redirect()->to(site_url('Konfirmasi'))->with('success', 'Perangkat telah berhasil ditambahkan');
        } else {
            return redirect()->to(site_url('Konfirmasi'))->with('error', 'Gagal ');
        }
    }

    public function Confirm($do)
    {
        $data = [
            $code_store         = $this->request->getVar('code_store'),
            $nik_user           = $this->request->getVar('nik_user'),
            $nama_store         = $this->request->getVar('nama_store'),
            $nama_user          = $this->request->getVar('nama_user'),
            $kategori           = $this->request->getVar('kategori'),
            $perangkat          = $this->request->getVar('perangkat'),
            $merk               = $this->request->getVar('merk'),
            $sn                 = $this->request->getVar('sn'),
            $tahun              = $this->request->getVar('tahun'),
            $status             = $this->request->getVar('status'),
            $jml = count($perangkat)
        ];
        for ($i = 0; $i < $jml; $i++) {
            $save = $this->db->table('data_aset')->insert(
                [
                    'code_store' => $code_store,
                    'nik_user' => $nik_user,
                    'nama_store' => $nama_store,
                    'nama_user' => $nama_user,
                    'kategori' => $kategori[$i],
                    'perangkat' => $perangkat[$i],
                    'merk' => $merk[$i],
                    'sn' => $sn[$i],
                    'tahun' => $tahun[$i],
                    'status' => $status
                ]
            );
        }
        if ($save) {
            $this->db->table('tbl_newpermintaan')->where(['code_permintaan' => $do])->update(['status' => 3]);
            return redirect()->to(site_url('Konfirmasi'))->with('success', 'Perangkat telah berhasil ditambahkan');
        } else {
            return redirect()->to(site_url('Konfirmasi'))->with('error', 'Gagal ');
        }
    }

    public function newStore()
    {
        $hasil = $this->store->where('nik_user', session('nik_user'))->findAll();
        $hasil1 = $this->perangkat->orderby('nama_perangkat')->findAll();
        $data = [
            'title' => 'Perangkat New Store',
            'hasil' => $hasil,
            'dataperangkat' => $hasil1
        ];
        return view('User/PermintaanNewStore', $data);
    }

    public function SaveNewPermintaan()
    {

        $data = [
            $code_permintaan    = $this->request->getVar('code_permintaan'),
            $code_store         = $this->request->getVar('code_store'),
            $nik_user           = $this->request->getVar('nik_user'),
            $nama_store         = $this->request->getVar('nama_store'),
            $nama_user          = $this->request->getVar('nama_user'),
            $data_perangkat     = $this->request->getVar('perangkat'),
            $merk               = $this->request->getVar('merk'),
            $kategori           = $this->request->getVar('kategori'),
            $sn                 = $this->request->getVar('sn'),
            $keterangan         = $this->request->getVar('keterangan'),
            $tanggal_permintaan = $this->request->getVar('tanggal'),
            $status             = $this->request->getVar('status'),
            $jmlh = count($data_perangkat),
        ];
        for ($i = 0; $i < $jmlh; $i++) {
            $this->db->table('tbl_newpermintaan')->insert(
                [
                    'code_permintaan' => $code_permintaan,
                    'code_store' => $code_store,
                    'nik_user' => $nik_user,
                    'nama_store' => $nama_store,
                    'nama_user' => $nama_user,
                    'code_perangkat' => $data_perangkat[$i],
                    'merk' => $merk[$i],
                    'kategori' => $kategori[$i],
                    'sn' => $sn[$i],
                    'keterangan' => $keterangan[$i],
                    'tanggal_permintaan' => $tanggal_permintaan,
                    'status' => $status
                ]
            );
        }
        return redirect()->to(site_url('PermintaanNewStore'))->with('success', 'Permintaan Anda Telah Dikirim');
    }
}
