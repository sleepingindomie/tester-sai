<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $user_id = Auth::id();
        $user_role = Auth::user()->role;

        // Inisialisasi kode_bl untuk customer
        $kode_bl = "";
        if ($user_role == 'customer') {
            $kode_bl = Auth::user()->kode_bl;
        }

        // Menambahkan kolom locked ke tabel shipping_info_corrections jika belum ada
        if (!DB::getSchemaBuilder()->hasColumn('shipping_info_corrections', 'locked')) {
            DB::statement("ALTER TABLE shipping_info_corrections ADD COLUMN locked BOOLEAN DEFAULT 0");
        }

        // Query untuk mengambil data dari tabel shipping_info berdasarkan user_id dan role
        if ($user_role == 'superadmin' || $user_role == 'admin') {
            $result = DB::table('shipping_info')
                        ->join('users', 'shipping_info.user_id', '=', 'users.id')
                        ->select('shipping_info.id', 'shipping_info.bl', 'shipping_info.locked', 'shipping_info.ocean_vessel', 'shipping_info.shipper', 'shipping_info.peb', 'shipping_info.vgm', 'shipping_info.progress', 'shipping_info.created_at', DB::raw("'original' as source"))
                        ->get();

            $corrections_result = DB::table('shipping_info_corrections')
                                    ->join('users', 'shipping_info_corrections.user_id', '=', 'users.id')
                                    ->select('shipping_info_corrections.id', 'shipping_info_corrections.bl', 'shipping_info_corrections.locked', 'shipping_info_corrections.ocean_vessel', 'shipping_info_corrections.shipper', 'shipping_info_corrections.peb', 'shipping_info_corrections.vgm', 'shipping_info_corrections.progress', 'shipping_info_corrections.created_at', DB::raw("'edited' as source"))
                                    ->get();

            $result = $result->merge($corrections_result);
        } else {
            $result = DB::table('shipping_info')
                        ->where('user_id', $user_id)
                        ->select('id', 'bl', 'locked', 'hs_code', 'npwp', 'tanggal_peb', 'no_peb', 'peb', 'vgm', 'imo_number', 'un_number', 'progress', 'created_at', DB::raw("'original' as source"))
                        ->get();

            $corrections_result = DB::table('shipping_info_corrections')
                                    ->where('user_id', $user_id)
                                    ->select('id', 'bl', 'locked', 'hs_code', 'npwp', 'tanggal_peb', 'no_peb', 'peb', 'vgm', 'imo_number', 'un_number', 'progress', 'created_at', DB::raw("'edited' as source"))
                                    ->get();

            $result = $result->merge($corrections_result);
        }

        // Query untuk mengambil data dari tabel vessels
        $vessels_data = DB::table('vessels')
                        ->select('vessel_name')
                        ->distinct()
                        ->get();

        return view('review', compact('user_role', 'kode_bl', 'result', 'vessels_data'));
    }

    public function confirmProgress(Request $request)
    {
        $id = intval($request->input('id'));
        $source = $request->input('source');

        if ($source == 'original') {
            DB::table('shipping_info')->where('id', $id)->update(['progress' => 'Completed']);
        } elseif ($source == 'edited') {
            DB::table('shipping_info_corrections')->where('id', $id)->update(['progress' => 'Completed']);
        }

        return redirect()->route('review');
    }

    public function getVoyages(Request $request)
    {
        $vessel_name = $request->input('vessel_name');
        Log::info("getVoyages called with vessel_name: $vessel_name");
    
        $voyages = DB::table('shipping_info')
                    ->where('ocean_vessel', 'LIKE', '%' . $vessel_name . '%')
                    ->select(DB::raw('SUBSTRING_INDEX(ocean_vessel, " - ", -1) as voyage'))
                    ->distinct()
                    ->get();
    
        Log::info("Voyages found: " . $voyages->toJson());
    
        $options = '<option value="">Select Voyage</option>';
        foreach ($voyages as $voyage) {
            $options .= '<option value="' . $voyage->voyage . '">' . $voyage->voyage . '</option>';
        }
        return response()->json($options);
    }

    public function viewFile(Request $request)
    {
        $fileType = $request->input('file');
        $bl = $request->input('bl');
        $source = $request->input('source', 'original'); // parameter untuk membedakan file asli dan yang telah diedit

        if (empty($fileType) || empty($bl)) {
            Log::error('Invalid request parameters.', ['fileType' => $fileType, 'bl' => $bl]);
            return response("Invalid request.", 400);
        }

        // Tentukan tabel berdasarkan parameter source
        $table = $source == 'edited' ? 'shipping_info_corrections' : 'shipping_info';
        Log::info('Determined table for query.', ['table' => $table, 'source' => $source]);

        // Mengambil informasi file dari kolom yang sesuai
        $shippingInfo = DB::table($table)->where('bl', $bl)->first();

        if (!$shippingInfo) {
            Log::error('File not found.', ['bl' => $bl, 'table' => $table]);
            return response("File not found.", 404);
        }

        Log::info('Shipping info found.', ['shippingInfo' => $shippingInfo]);

        $filePaths = [];
        if ($fileType == 'peb') {
            $filePaths = explode(',', $shippingInfo->peb);
        } elseif ($fileType == 'vgm') {
            $filePaths = explode(',', $shippingInfo->vgm);
        }

        Log::info('File paths extracted.', ['filePaths' => $filePaths]);

        $fileList = '';
        foreach ($filePaths as $filePath) {
            $filePath = trim($filePath);
            $fullPath = storage_path('app/public/' . $filePath); // Menggunakan storage_path
            Log::info('Checking file.', ['fullPath' => $fullPath]);

            if (file_exists($fullPath)) {
                Log::info('File exists.', ['fullPath' => $fullPath]);
                $fileList .= '<a href="' . asset('storage/' . $filePath) . '" class="list-group-item list-group-item-action" target="_blank">' . basename($filePath) . '</a>';
            } else {
                Log::error('File not found.', ['fullPath' => $fullPath]);

                // Tambahkan log untuk listing semua file di dalam directory untuk debugging
                if (is_dir(dirname($fullPath))) {
                    $filesInDirectory = scandir(dirname($fullPath));
                    Log::error('Files in directory:', ['files' => $filesInDirectory]);
                } else {
                    Log::error('Directory not found:', ['directory' => dirname($fullPath)]);
                }

                $fileList .= '<p class="list-group-item list-group-item-danger">File not found: ' . basename($filePath) . '</p>';
            }
        }

        return response()->json($fileList);
    }

    public function lockUnlock(Request $request)
    {
        $id = intval($request->input('id'));
        $action = $request->input('action');

        $locked = $action === 'lock' ? true : false;

        DB::table('shipping_info')->where('id', $id)->update(['locked' => $locked]);

        return redirect()->route('review');
    }

    public function view(Request $request)
    {
        $id = intval($request->input('id'));
        $user_id = Auth::id();
        $user_role = Auth::user()->role;

        $data = null;

        if ($user_role == 'superadmin' || $user_role == 'admin') {
            $data = DB::table('shipping_info')->where('id', $id)->first();
        } else {
            $data = DB::table('shipping_info')->where('id', $id)->where('user_id', $user_id)->where('locked', false)->first();
        }

        if (!$data) {
            if ($user_role == 'superadmin' || $user_role == 'admin') {
                $data = DB::table('shipping_info_corrections')->where('id', $id)->first();
            } else {
                $data = DB::table('shipping_info_corrections')->where('id', $id)->where('user_id', $user_id)->where('locked', false)->first();
            }

            if (!$data) {
                return response("No data found or you do not have permission to view this data.", 403);
            }
        }

        if ($data->locked) {
            return redirect()->route('notfound');
        }

        $description_of_goods = htmlspecialchars_decode(str_replace(['\r\n', '\n', '\r'], ["\r\n", "\n", "\r"], $data->description_of_goods));

        return view('view', compact('data', 'description_of_goods'));
    }
}
