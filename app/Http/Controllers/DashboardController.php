<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;
        $kode_bl = Auth::user()->kode_bl ?? '';

        Log::info('Index method called', ['role' => $role, 'kode_bl' => $kode_bl]);

        return view('main', compact('role', 'kode_bl'));
    }

    public function main()
    {
        $user = Auth::user();
        $kode_bl = $user->role == 'customer' ? $user->kode_bl : null;
        $result = $this->getShippingInfo(); // Panggil metode getShippingInfo

        if ($result->isEmpty()) {
            Log::info('No data received from getShippingInfo method');
        } else {
            Log::info('Data received from getShippingInfo method:', ['result' => $result->toArray()]);
        }

        return view('main', compact('kode_bl', 'result'));
    }

    public function getShippingInfo()
    {
        $user_id = Auth::id();
        $user_role = Auth::user()->role;

        Log::info('getShippingInfo method called', ['user_id' => $user_id, 'user_role' => $user_role]);

        $result = collect(); // Inisialisasi dengan koleksi kosong
        if ($user_role == 'superadmin' || $user_role == 'admin') {
            DB::enableQueryLog();
            $result = DB::table('shipping_info')
                        ->select('id', 'bl', 'ocean_vessel', 'shipper', 'progress')
                        ->get();

            $queries = DB::getQueryLog();
            Log::info('Executed queries:', $queries);

            if ($result->isEmpty()) {
                Log::info('Query returned no results');
            } else {
                Log::info('Shipping Info Query Result:', ['result' => $result->toArray()]);
            }
        } else {
            Log::info('User role is not authorized to view shipping info', ['user_role' => $user_role]);
        }

        return $result;
    }
}
