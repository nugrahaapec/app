<?php

namespace App\Controllers\Admin;

use App\Models\StoreModel;
use App\Models\PerangkatModel;
use App\Models\PermintaanModel;
use App\Models\AsetModel;
use App\Models\UserModel;
use App\Controllers\BaseController;
// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Other extends BaseController
{
    public function __construct()
    {
        $this->store = new StoreModel();
        $this->perangkat = new PerangkatModel();
        $this->permintaan = new PermintaanModel();
        $this->Aset = new AsetModel();
        $this->User = new UserModel();
    }

    public function perangkat()
    {
        $DataAset = $this->Aset->DataAset();
        $data = [
            'title' => 'Master Perangkat',
            'data' => $DataAset
        ];
        return view('Admin/perangkat', $data);
    }

    public function hapus($id)
    {
        $this->db->table('master_perangkat')->where(['id_perangkat' => $id])->delete();
        return redirect()->to(site_url('MPerangkat'))->with('success', 'Data perangkat telah dihapus.');
    }
    public function tambah()
    {
        $data = [
            'nama_perangkat' => $this->request->getVar('perangkat'),
        ];
        $this->perangkat->save($data);
        return redirect()->to(base_url('MPerangkat'))->with('succes', 'Data perangkat berhasil ditambah.');
    }

    public function reset()
    {
        $this->store->reset();
        return redirect()->to(base_url('Admin'))->with('success', 'Periode maintenance telah di reset');
    }

    public function status()
    {
        $status = $this->Aset->status();
        $data = [
            'title' => 'Status Perangkat',
            'status' => $status
        ];
        return view('Admin/status', $data);
    }

    public function jumlah()
    {
        $group =  $this->db->table('data_aset')->groupBy('code_store')->get()->getResultArray();
        $hasil =  $this->db->table('data_aset')->get()->getResultArray();
        $data = [
            'title' => 'Jumlah Perangkat Store',
            'group' => $group,
            'hasil' => $hasil
        ];
        return view('Admin/jumlah', $data);
    }
}
