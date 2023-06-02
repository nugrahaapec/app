<?php

namespace App\Controllers\Admin;

use App\Models\StoreModel;
use App\Models\PerangkatModel;
use App\Models\PermintaanModel;
use App\Models\AsetModel;
use App\Models\UserModel;
use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->store = new StoreModel();
        $this->perangkat = new PerangkatModel();
        $this->permintaan = new PermintaanModel();
        $this->Aset = new AsetModel();
        $this->User = new UserModel();
    }

    public function index()
    {
        $result = $this->store->getDataAdmin();
        $lokasi = $this->store->getDataAdminL();
        $maintenance = $this->store->getAdminStatus();
        $maintenance1 = $this->store->getAdminStatus0();
        $data = [
            'title' => 'Dashboard',
            'result' => $result,
            'maintenance' => $maintenance,
            'maintenance1' => $maintenance1,
            'lokasi' => $lokasi,
        ];
        return view('Admin/index', $data);
    }

    public function data_user()
    {

        $query = $this->User->allUser();
        $data = [
            'title' => 'Data User',
            'query' => $query
        ];
        return view('Admin/data_user', $data);
    }

    public function create()
    {
        if (!$this->validate([
            'nikuser' => 'required|is_unique[user.nik_user]',
            'email_user' => 'required|is_unique[user.email_user]',
            'username' => 'required|is_unique[user.username]',
        ])) {
            return redirect()->to(base_url('DataUser'))->withInput()->with('error', 'Gagal Menyimpan Data.');
        }
        $data = [
            'nik_user' => $this->request->getVar('nikuser'),
            'nama_user' => $this->request->getVar('nama_user'),
            'username' => $this->request->getVar('username'),
            'email_user' => $this->request->getVar('email_user'),
            'pass_user' => sha1($this->request->getVar('pass_user')),
            'level_user' => $this->request->getVar('level_user'),
        ];
        $this->db->table('user')->insert($data);
        return redirect()->to(site_url('DataUser'))->with('success', 'Data user berhasil ditambah');
    }

    public function edit_user($id = null)
    {
        if ($id != null) {
            $query = $this->db->table('user')->getwhere(['nik_user' => $id]);
            if ($query->resultID->num_rows > 0) {
                $data['user'] = $query->getRow();
                $dataa = [
                    'title' => 'Edit User',
                    'user' => $data['user']
                ];
                return view('Admin/edit_user', $dataa);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data Tidak Ditemukan');
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data Tidak Ditemukan');
        }
    }

    public function update($id)
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
        $update = $this->db->table('user')->where(['nik_user' => $id])->update($data);

        if ($update) {
            $data1 = [
                'nik_user' => $this->request->getVar('nik_user'),
                'nama_user' => $this->request->getVar('nama_user'),
            ];
            $this->db->table('store')->where(['nik_user' => $id])->update($data1);
            $this->db->table('data_aset')->where(['nik_user' => $id])->update($data1);
            $this->db->table('cctv_network')->where(['nik_user' => $id])->update($data1);
        }
        return redirect()->to(site_url('DataUser'))->with('success', 'Data user berhasil diupdate');
    }

    public function hapus($id)
    {
        $this->db->table('user')->where(['nik_user' => $id])->delete();
        return redirect()->to(site_url('DataUser'))->with('success', 'Data user berhasil dihapus');
    }


    // STORE FUNCTION 


    public function data_store()
    {

        $builder = $this->db->table('store')->orderBy('nama_user');
        $query = $builder->get()->getResult();
        $query1 = $this->db->table('user')->where('level_user', 'technical support')->get()->getResultArray();

        $data = [
            'title' => 'Data Store',
            'query' => $query,
            'query1' => $query1
        ];
        return view('Admin/data_store', $data);
    }

    public function createStore()
    {
        if (!$this->validate([
            'kode_store' => 'required|is_unique[store.code_store]',
        ])) {
            return redirect()->to(base_url('DataStore'))->withInput()->with('error', "Kode Store "  . $this->request->getVar('kode_store') .  " Sudah Digunakan");
        }
        $data = [
            'code_store' => $this->request->getVar('kode_store'),
            'nama_store' => $this->request->getVar('nama_store'),
            'nama_user' => $this->request->getVar('nama_user'),
            'lokasi' => $this->request->getVar('lokasi'),
            'nik_user' => $this->request->getVar('nik_user'),
            'status' => $this->request->getVar('status')
        ];
        $save = $this->db->table('store')->insert($data);
        if ($save) {
            $this->db->table('master_store')->insert([
                'code_store' => $this->request->getVar('kode_store'),
                'nama_store' => $this->request->getVar('nama_store')
            ]);
        }
        return redirect()->to(site_url('DataStore'))->with('success', 'Data berhasil ditambah');
    }


    public function edit_store($id = null)
    {
        if ($id != null) {
            $query = $this->db->table('store')->getwhere(['code_store' => $id]);
            if ($query->resultID->num_rows > 0) {
                $data['store'] = $query->getRow();
                $data = [
                    'title' => 'Edit Store',
                    'store' => $data['store']
                ];
                return view('Admin/edit_store', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function updateStore($id)
    {
        if ($this->request->getPost('nama_user') == 'Pilih Technical Support') {
            $data = [
                'code_store' => $this->request->getVar('kode_store'),
                'nama_store' => $this->request->getVar('nama_store'),
            ];
            $this->db->table('store')->where(['code_store' => $id])->update($data);
        }
        if ($this->request->getPost('nama_user') != 'Pilih Technical Support') {
            $data = [
                'code_store' => $this->request->getVar('kode_store'),
                'nama_store' => $this->request->getVar('nama_store'),
                'nama_user' => $this->request->getVar('nama_user'),
                'nik_user' => $this->request->getVar('nik_user'),
            ];
        }
        $update = $this->db->table('store')->where(['code_store' => $id])->update($data);
        if ($update) {
            $data = [
                'code_store' => $this->request->getVar('kode_store'),
                'nama_store' => $this->request->getVar('nama_store'),
                'nama_user' => $this->request->getVar('nama_user'),
                'nik_user' => $this->request->getVar('nik_user'),
            ];

            $this->db->table('data_aset')->where(['code_store' => $id])->update($data);
        }
        return redirect()->to(site_url('DataStore'))->with('success', 'Data berhasil diupdate');
    }

    public function hapusStore($id)
    {
        $delete = $this->db->table('store')->where(['code_store' => $id])->delete();
        if ($delete) {
            $this->db->table('master_store')->where(['code_store' => $id])->delete();
            $this->db->table('data_aset')->where(['code_store' => $id])->delete();
            $this->db->table('cctv_network')->where(['code_store' => $id])->delete();
        }
        return redirect()->to(site_url('DataStore'))->with('success', 'Data store berhasil dihapus');
    }

    public function import()
    {
        $file = $this->request->getFile('upload');
        $extension = $file->getClientExtension();
        if ($extension == 'xlsx' || $extension == 'xls') {
            if ($extension == 'xls') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($file);
            $upload = $spreadsheet->getActiveSheet()->toArray();
            foreach ($upload as $key => $uploads) {
                if ($key == 0) {
                    continue;
                }
                $data =  [
                    'code_store' => $uploads[1],
                    'nama_store' => $uploads[2],
                    'nik_user' => $uploads[3],
                    'nama_user' => $uploads[4],
                    'lokasi' => $uploads[5],
                    'status' => 0,
                ];
                $mStore =  $this->db->table('master_store')->insert(['code_store' => $uploads[1], 'nama_store' => $uploads[2]]);
                if ($mStore) {
                    $this->store->insert($data);
                }
            }
            return redirect()->back()->with('success', 'File Berhasil Diupload');
        } else {
            return redirect()->back()->with('error', 'Format File Tidak Sesuai');
        }
    }

    public function export()
    {
        $user = $this->store->findALL();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode Store');
        $sheet->setCellValue('C1', 'Nama Store');
        $sheet->setCellValue('D1', 'Technical Support');
        $column = 2;
        foreach ($user as $key => $value) [
            $sheet->setCellValue('A' . $column, ($column - 1)),
            $sheet->setCellValue('B' . $column, $value['code_store']),
            $sheet->setCellValue('C' . $column, $value['nama_store']),
            $sheet->setCellValue('D' . $column, $value['nama_user']),
            $column++,
        ];

        $sheet->getStyle('A1:D1')->getFont()->setBold(true);
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformat-officedocument.spreadsheethtml.sheet');
        header('Content-Disposition: attachment;filename=Data_Store.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
    }

    public function updateBatch()
    {
        $file = $this->request->getFile('updateBatch');
        $extension = $file->getClientExtension();
        if ($extension == 'xlsx' || $extension == 'xls') {
            if ($extension == 'xls') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($file);
            $upload = $spreadsheet->getActiveSheet()->toArray();
            foreach ($upload as $key => $uploads) {
                if ($key == 0) {
                    continue;
                }
                $data =  [
                    'code_store' => $uploads[1],
                    'nama_store' => $uploads[2],
                    'nik_user' => $uploads[3],
                    'nama_user' => $uploads[4],
                ];

                $this->store->setData($data)->onConstraint('code_store', 'nama_store', 'nama_user', 'nik_user')->updateBatch();
                $this->Aset->setData($data)->onConstraint('code_store', 'nama_store', 'nama_user', 'nik_user')->updateBatch();
            }
            return redirect()->back()->with('success', 'Data Berhasil DIupdate');
        } else {
            return redirect()->back()->with('error', 'Format File Tidak Sesuai');
        }
    }
}
