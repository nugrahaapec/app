<?php

namespace Config;

use App\Controllers\Staff\Staff;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;
use App\Filters\AuthFilter;
use App\Filters\TechFilter;
use App\Filters\AdminFilter;
use App\Filters\StaffFilter;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'auth'          => AuthFilter::class,
        'tech'          => TechFilter::class,
        'admin'         => AdminFilter::class,
        'staff'         => StaffFilter::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     */
    public array $globals = [
        'before' => [
            'tech' => ['except' => ['/']],
            'staff' => ['except' => ['/']],
            'admin' => ['except' => ['/']],
            'csrf',
            // 'honeypot',
            // 'invalidchars',
        ],
        'after' => [
            'tech' => ['except' => [
                'User', 'perangkat', 'logout', 'Status', 'Other', 'SaveOther', 'SavePerangkat', 'EditProfile/*', 'UpdateProfile/*', 'PermintaanPerangkat', 'SavePermintaan', 'FormMaintenance', 'FormMaintenance/*', 'Maintenance', 'SaveCctv/*', 'SaveMaintenance/*', 'ReportFormMaintenance', 'addStore', 'SaveCctv/*', 'ReportPermintaan', 'PrintRpt_maintenance', 'PrintRpt_maintenance/*', 'Konfirmasi', 'Conf/*', 'load/*', 'PermintaanNewStore', 'SaveNewPermintaan', 'Confirm/*'
            ]],
            'staff' => ['except' => [
                'Staff', 'logout', 'Proses', 'Cancel/*', 'NewProsesPermintaan/*', 'ProsesPermintaan/*', 'ProsesPermintaanStore/*', 'cekSN', 'Laporan', 'NewProses', 'print/*', 'PrintDo', 'ProsesNewStore/*', 'NewPrint', 'PrintNew/*', 'LaporanNew'
            ]],
            'admin' => ['except' => [
                'Admin', 'DataUser', 'EditUser/*', 'CreateUser', 'Delete/*', 'Update/*', 'DataStore', 'CreateStore', 'EditStore/*', 'UpdateStore/*', 'HapusStore/*', 'Upload', 'UpdateBatch', 'MPerangkat', 'HapusPerangkat/*', 'TambahPerangkat', 'Reset', 'StatusPerangkat', 'JumlahPerangkat'
            ]],
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don’t expect could bypass the filter.
     */
    public array $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     */
    public array $filters = [
        'auth' => [
            'before' =>
            [
                'Staff', 'logout', 'Proses', 'Cancel/*', 'NewProsesPermintaan/*', 'ProsesPermintaan/*', 'ProsesPermintaanStore/*', 'cekSN', 'Laporan', 'NewProses', 'print/*', 'PrintDo', 'ProsesNewStore/*', 'NewPrint',     'User', 'perangkat', 'logout', 'Status', 'Other', 'SaveOther', 'SavePerangkat', 'EditProfile/*', 'UpdateProfile/*', 'PermintaanPerangkat', 'SavePermintaan', 'FormMaintenance', 'FormMaintenance/*', 'Maintenance', 'SaveCctv/*', 'SaveMaintenance/*', 'ReportFormMaintenance', 'addStore', 'SaveCctv/*', 'ReportPermintaan', 'PrintRpt_maintenance', 'PrintRpt_maintenance/*', 'Konfirmasi', 'Conf/*', 'load/*', 'PermintaanNewStore', 'SaveNewPermintaan', 'Confirm/*', 'LaporanNew', 'Admin', 'DataUser', 'EditUser/*', 'CreateUser', 'Delete/*', 'Update/*', 'DataStore', 'CreateStore', 'EditStore/*', 'UpdateStore/*', 'HapusStore/*', 'Upload', 'UpdateBatch', 'MPerangkat', 'HapusPerangkat/*', 'TambahPerangkat', 'Reset', 'StatusPerangkat', 'JumlahPerangkat'

            ]
        ]
    ];
}
