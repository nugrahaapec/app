<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{

    public function login()
    {
        $data = [
            'title' => 'Log in'
        ];
        return view('auth/login', $data);
    }

    public function loginProses()
    {
        $user = new UserModel();
        $username = $_POST['user'];
        $password = $_POST['pass'];
        $dataUser = $user->where(['username' => $username,])->orWhere(['email_user' => $username])->first();
        if ($dataUser) {
            if (sha1($password) == $dataUser->pass_user) {
                $params = [
                    'id_user'      => $dataUser->id_user,
                    'nik_user'      => $dataUser->nik_user,
                    'nama_user'     => $dataUser->nama_user,
                    'level_user'    => $dataUser->level_user,
                ];
                session()->set($params);

                if (session('level_user') == 'staff') {
                    return redirect()->to(site_url('Staff'));
                }
                if (session('level_user') == 'admin') {
                    return redirect()->to(site_url('Admin'));
                }
                if (session('level_user') == 'technical support') {
                    return redirect()->to(site_url('User'));
                }
            } else {
                return redirect()->back()->withInput()->with('error', 'Password Salah !');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Email atau Username Salah !');
        }
    }

    public function logout()
    {

        session_destroy();
        return redirect()->to(site_url('/'))->with('logout', 'Anda telah keluar.');;
    }

    public function Destroy()
    {
        session()->destroy();
        return redirect()->to(site_url('/'))->with('logout', 'Data user berhasil diupdate, Silahkan Login Kembali');;
    }
}
