<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Container;
use App\Models\ShippingInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ShippingController extends Controller
{
    public function inputForm()
    {
        $user = Auth::user();
        $kode_bl = $user->role == 'customer' ? $user->kode_bl : '';

        $vessel_voyages = DB::table('vessels')->select('vessel_name', 'voyage')->get();

        Log::info('Input form accessed by user.', ['user_id' => $user->id, 'kode_bl' => $kode_bl]);

        return view('input', compact('kode_bl', 'vessel_voyages'));
    }

    public function submitInputForm(Request $request)
    {
        Log::info('submitInputForm called.', ['request' => $request->all()]);

        $request->validate([
            'bl' => 'required',
            'no_of_containers' => 'required',
            'type' => 'required',
            'shipper' => 'required',
            'consignee' => 'required',
            'notify_party' => 'required',
            'place_of_receipt' => 'required',
            'ocean_vessel_voy' => 'required',
            'port_of_loading' => 'required',
            'port_of_discharge' => 'required',
            'place_of_delivery' => 'required',
            'final_destination' => 'required',
            'gross_weight_total' => 'required',
            'net_weight_total' => 'required',
            'measurement_total' => 'required',
            'freight_and_charges' => 'required',
            'place_date_of_issue' => 'required',
            'date' => 'required',
            'description_of_goods' => 'required',
            'attached_sheet_description' => 'required',
            'hs_code' => 'required',
            'npwp' => 'required',
            'no_peb' => 'required',
            'tanggal_peb' => 'required',
            'container_no' => 'required',
            'seal_no' => 'required',
            'vgm.*' => 'file|mimes:pdf',
            'peb.*' => 'file|mimes:pdf',
        ]);

        $user = Auth::user();
        $bl = $request->bl;
        $no_of_containers = $request->no_of_containers;

        try {
            DB::transaction(function() use ($request, $bl, $user, $no_of_containers) {
                $type = $request->type;
                $shipper = $request->shipper;
                $consignee = $request->consignee;
                $notify_party = $request->notify_party;
                $place_of_receipt = $request->place_of_receipt;
                $ocean_vessel_voy = explode('|', $request->ocean_vessel_voy);
                $ocean_vessel = $ocean_vessel_voy[0] . ' - ' . $ocean_vessel_voy[1];
                $port_of_loading = $request->port_of_loading;
                $port_of_discharge = $request->port_of_discharge;
                $place_of_delivery = $request->place_of_delivery;
                $final_destination = $request->final_destination;
                $gross_weight_total = $request->gross_weight_total;
                $net_weight_total = $request->net_weight_total;
                $measurement_total = $request->measurement_total;
                $freight_and_charges = $request->freight_and_charges;
                $place_date_of_issue = $request->place_date_of_issue;
                $date = $request->date;
                $un_number = $request->un_number;
                $imo_number = $request->imo_number;
                $description_of_goods = $request->description_of_goods;
                $attached_sheet_description = $request->attached_sheet_description;
                $hs_code = $request->hs_code;
                $npwp = $request->npwp;
                $no_peb = $request->no_peb;
                $tanggal_peb = $request->tanggal_peb;
                $container_no = $request->container_no;
                $seal_no = $request->seal_no;

                Log::info('Processing input form data.', [
                    'bl' => $bl,
                    'user_id' => $user->id,
                    'data' => $request->all()
                ]);

                // Simpan file VGM
                $vgm_paths = [];
                if ($request->hasFile('vgm')) {
                    foreach ($request->file('vgm') as $file) {
                        $path = $file->store('uploads/' . $bl, 'public');
                        $vgm_paths[] = $path;
                    }
                }
                $vgm_paths_string = implode(',', $vgm_paths);

                // Simpan file PEB
                $peb_paths = [];
                if ($request->hasFile('peb')) {
                    foreach ($request->file('peb') as $file) {
                        $path = $file->store('uploads/' . $bl, 'public');
                        $peb_paths[] = $path;
                    }
                }
                $peb_paths_string = implode(',', $peb_paths);

                Log::info('Files uploaded successfully.', [
                    'vgm_paths' => $vgm_paths_string,
                    'peb_paths' => $peb_paths_string
                ]);

                // Simpan data ke database
                $shippingInfo = ShippingInfo::create([
                    'bl' => $bl,
                    'type' => $type,
                    'shipper' => $shipper,
                    'consignee' => $consignee,
                    'notify_party' => $notify_party,
                    'place_of_receipt' => $place_of_receipt,
                    'ocean_vessel' => $ocean_vessel,
                    'port_of_loading' => $port_of_loading,
                    'port_of_discharge' => $port_of_discharge,
                    'place_of_delivery' => $place_of_delivery,
                    'final_destination' => $final_destination,
                    'gross_weight' => $gross_weight_total,
                    'net_weight' => $net_weight_total,
                    'measurement' => $measurement_total,
                    'no_of_containers' => $no_of_containers,
                    'freight_and_charges' => $freight_and_charges,
                    'place_date_of_issue' => $place_date_of_issue,
                    'date' => $date,
                    'user_id' => $user->id,
                    'un_number' => $un_number,
                    'imo_number' => $imo_number,
                    'description_of_goods' => $description_of_goods,
                    'attached_sheet_description' => $attached_sheet_description,
                    'hs_code' => $hs_code,
                    'npwp' => $npwp,
                    'no_peb' => $no_peb,
                    'tanggal_peb' => $tanggal_peb,
                    'vgm' => $vgm_paths_string,
                    'peb' => $peb_paths_string,
                    'container_no' => $container_no,
                    'seal_no' => $seal_no,
                ]);

                Log::info('ShippingInfo created successfully.', ['bl' => $bl, 'id' => $shippingInfo->id]);
            });

            return redirect()->route('inputpage2', ['bl' => $bl]);

        } catch (\Exception $e) {
            Log::error('Error in submitInputForm.', ['error' => $e->getMessage()]);
            return back()->withErrors(['msg' => 'There was an error processing your request.']);
        }
    }

    public function submitContainer(Request $request)
    {
        Log::info('submitContainer called.', ['request' => $request->all()]);

        $user = Auth::user();
        $kode_bl = $user->kode_bl;

        try {
            DB::transaction(function () use ($request, $kode_bl) {
                $container_no = $request->container_no;
                $seal_no = $request->seal_no;
                $outer_quantity = $request->outer_quantity;
                $outer_package_type = $request->outer_package_type;
                $gross_weight = $request->gross_weight;
                $gross_meas = $request->gross_meas;
                $net_weight = $request->net_weight;

                Log::info('Container Data Check', [
                    'container_no' => $container_no,
                    'seal_no' => $seal_no,
                    'outer_quantity' => $outer_quantity,
                    'outer_package_type' => $outer_package_type,
                    'gross_weight' => $gross_weight,
                    'gross_meas' => $gross_meas,
                    'net_weight' => $net_weight,
                ]);

                if (is_array($container_no) && is_array($seal_no) && is_array($outer_quantity) && is_array($outer_package_type) && is_array($gross_weight) && is_array($gross_meas) && is_array($net_weight)) {
                    $total_outer_quantity = 0;
                    $total_outer_package_type = "";
                    $all_container_no = "";
                    $all_seal_no = "";

                    for ($i = 0; $i < count($container_no); $i++) {
                        // Periksa apakah semua kolom dalam tabel container telah terisi
                        if (empty($container_no[$i]) || empty($seal_no[$i]) || empty($outer_quantity[$i]) || empty($outer_package_type[$i]) || empty($gross_weight[$i]) || empty($gross_meas[$i]) || empty($net_weight[$i])) {
                            throw new \Exception("Semua kolom dalam tabel container harus diisi.");
                        }

                        Container::create([
                            'bl' => $kode_bl,
                            'container_no' => $container_no[$i],
                            'seal_no' => $seal_no[$i],
                            'outer_quantity' => $outer_quantity[$i],
                            'outer_package_type' => $outer_package_type[$i],
                            'gross_weight' => $gross_weight[$i],
                            'gross_meas' => $gross_meas[$i],
                            'net_weight' => $net_weight[$i],
                        ]);

                        $total_outer_quantity += floatval($outer_quantity[$i]);
                        $total_outer_package_type = $outer_package_type[$i]; // Asumsi semua paket tipe adalah sama

                        // Gabungkan semua container_no dan seal_no
                        $all_container_no .= $container_no[$i] . " ";
                        $all_seal_no .= $seal_no[$i] . " ";
                    }

                    $all_container_no = trim($all_container_no);
                    $all_seal_no = trim($all_seal_no);

                    $no_of_containers = $total_outer_quantity . ' ' . $total_outer_package_type;

                    // Update data no_of_containers, all_container_no, dan all_seal_no ke shipping_info
                    ShippingInfo::where('bl', $kode_bl)->update([
                        'no_of_containers' => $no_of_containers,
                        'container_no' => $all_container_no,
                        'seal_no' => $all_seal_no,
                    ]);

                    Log::info('ShippingInfo updated successfully.', ['bl' => $kode_bl]);
                } else {
                    throw new \Exception("Invalid input data.");
                }
            });

            return redirect()->route('inputpage2', ['bl' => $kode_bl]);

        } catch (\Exception $e) {
            Log::error('Error in submitContainer.', ['error' => $e->getMessage()]);
            return back()->withErrors(['msg' => 'There was an error processing your request.']);
        }
    }

    public function submitContainer2(Request $request) {
        Log::info('submitContainer2 called.', ['request' => $request->all()]);
    
        $validated = $request->validate([
            '_token' => 'required',
            'bl' => 'required',
            // tambahkan validasi lainnya sesuai kebutuhan
        ]);
    
        Log::info('Validation passed.', ['validated_data' => $validated]);
    
        try {
            Log::info('Processing data...');
    
            // Ambil data dari tabel container berdasarkan nomor BL
            $bl = $validated['bl'];
            $containerData = DB::table('container')
                ->select(
                    DB::raw('SUM(CAST(gross_weight AS FLOAT)) as total_gross_weight'),
                    DB::raw('SUM(CAST(gross_meas AS FLOAT)) as total_measurement'),
                    DB::raw('SUM(CAST(net_weight AS FLOAT)) as total_net_weight'),
                    DB::raw("GROUP_CONCAT(container_no SEPARATOR ' ') as all_container_no"),
                    DB::raw("GROUP_CONCAT(seal_no SEPARATOR ' ') as all_seal_no")
                )
                ->where('bl', $bl)
                ->first();
    
            if (!$containerData) {
                throw new \Exception("Container data not found for BL: $bl");
            }
    
            // Memastikan pemisah yang konsisten untuk ocean_vessel menggunakan "-"
            $oceanVesselVoy = explode('|', $request->ocean_vessel_voy);
            $oceanVessel = trim($oceanVesselVoy[0]) . ' - ' . trim($oceanVesselVoy[1]);
    
            Log::info('Calculated container data.', [
                'total_gross_weight' => $containerData->total_gross_weight,
                'total_measurement' => $containerData->total_measurement,
                'total_net_weight' => $containerData->total_net_weight,
                'no_of_containers' => $request->no_of_containers,
                'total_no_of_containers' => $request->total_no_of_containers,
                'all_container_no' => $containerData->all_container_no,
                'all_seal_no' => $containerData->all_seal_no
            ]);
    
            // Simpan file VGM
            $vgm_paths = [];
            if ($request->hasFile('vgm')) {
                foreach ($request->file('vgm') as $file) {
                    // Dapatkan nama asli file
                    $filename = $file->getClientOriginalName();
                    // Simpan file dengan nama asli
                    $path = $file->storeAs('uploads/' . $bl, $filename, 'public');
                    Log::info('VGM File Uploaded', ['path' => $path]);
                    $vgm_paths[] = $path;
                }
            }
            $vgm_paths_string = implode(',', $vgm_paths);
    
            // Simpan file PEB
            $peb_paths = [];
            if ($request->hasFile('peb')) {
                foreach ($request->file('peb') as $file) {
                    // Dapatkan nama asli file
                    $filename = $file->getClientOriginalName();
                    // Simpan file dengan nama asli
                    $path = $file->storeAs('uploads/' . $bl, $filename, 'public');
                    Log::info('PEB File Uploaded', ['path' => $path]);
                    $peb_paths[] = $path;
                }
            }
            $peb_paths_string = implode(',', $peb_paths);
    
            Log::info('Saving data...');
    
            // Pastikan imo_number dan un_number diatur ke string kosong jika tipe Non-DG
            if ($request->type == 'Non-DG') {
                $request->merge([
                    'imo_number' => '',
                    'un_number' => ''
                ]);
            }
    
            // Simpan data ke database atau lakukan tindakan lain yang diperlukan
            $data = [
                'bl' => $bl,
                'imo_number' => $request->imo_number,
                'un_number' => $request->un_number,
                'shipper' => $request->shipper,
                'consignee' => $request->consignee,
                'notify_party' => $request->notify_party,
                'place_of_receipt' => $request->place_of_receipt,
                'ocean_vessel' => $oceanVessel,
                'port_of_loading' => $request->port_of_loading,
                'port_of_discharge' => $request->port_of_discharge,
                'place_of_delivery' => $request->place_of_delivery,
                'final_destination' => $request->final_destination,
                'gross_weight' => $containerData->total_gross_weight,
                'net_weight' => $containerData->total_net_weight,
                'measurement' => $containerData->total_measurement,
                'no_of_containers' => $request->no_of_containers,
                'freight_and_charges' => $request->freight_and_charges,
                'place_date_of_issue' => $request->place_date_of_issue,
                'date' => $request->date,
                'user_id' => Auth::id(),
                'description_of_goods' => $request->description_of_goods,
                'attached_sheet_description' => $request->attached_sheet_description,
                'container_no' => $containerData->all_container_no,
                'seal_no' => $containerData->all_seal_no,
                'total_no_of_containers' => $request->total_no_of_containers,
                'hs_code' => $request->hs_code,
                'npwp' => $request->npwp,
                'no_peb' => $request->no_peb,
                'tanggal_peb' => $request->tanggal_peb,
                'vgm' => $vgm_paths_string,
                'peb' => $peb_paths_string,
                'type' => $request->type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
    
            DB::table('shipping_info')->insert($data);
    
            Log::info('Data saved successfully.', ['data' => $data]);
    
            // Redirect to review page
            return redirect()->route('review');
    
        } catch (\Exception $e) {
            Log::error('Error processing shipping info data.', ['error' => $e->getMessage()]);
    
            // Redirect back with error message
            return back()->withErrors(['msg' => 'Error processing data. Please check the logs for more details.']);
        }
    }
    
    
    public function inputPage2(Request $request)
    {
        $bl = $request->query('bl');
        $kode_bl = $bl;
        Log::info('inputPage2 accessed.', ['bl' => $bl]);

        // Ambil data container dari tabel container berdasarkan BL
        $containers = DB::table('container')
            ->where('bl', $bl)
            ->get();

        $data = DB::table('container')
            ->where('bl', $bl)
            ->select(
                DB::raw('SUM(CAST(gross_weight AS FLOAT)) as total_gross_weight'),
                DB::raw('SUM(CAST(gross_meas AS FLOAT)) as total_measurement'),
                DB::raw('SUM(CAST(net_weight AS FLOAT)) as total_net_weight'),
                DB::raw('GROUP_CONCAT(outer_quantity) as total_outer_quantity'),
                DB::raw('GROUP_CONCAT(outer_package_type) as total_outer_package_type'),
                DB::raw("GROUP_CONCAT(container_no SEPARATOR ' ') as all_container_no"),
                DB::raw("GROUP_CONCAT(seal_no SEPARATOR ' ') as all_seal_no")
            )
            ->first();

        // Pastikan bahwa variabel-variabel yang berisi nilai float tetap sebagai float
        $data->total_gross_weight = floatval($data->total_gross_weight);
        $data->total_measurement = floatval($data->total_measurement);
        $data->total_net_weight = floatval($data->total_net_weight);

        $total_outer_quantity_arr = explode(",", $data->total_outer_quantity);
        $total_outer_quantity_arr = array_map('floatval', $total_outer_quantity_arr);
        $total_quantity = array_sum($total_outer_quantity_arr);

        $total_outer_package_type_arr = explode(",", $data->total_outer_package_type);
        $outer_package_type = $total_outer_package_type_arr[0];

        $no_of_containers = $total_quantity . ' ' . $outer_package_type;

        $total_no_of_containers = strtoupper($this->convert_number_to_words($total_quantity)) . ' ' . strtoupper($outer_package_type) . ' ONLY';

        Log::info('Calculated container data.', [
            'total_gross_weight' => $data->total_gross_weight,
            'total_measurement' => $data->total_measurement,
            'total_net_weight' => $data->total_net_weight,
            'no_of_containers' => $no_of_containers,
            'total_no_of_containers' => $total_no_of_containers,
        ]);

        $vessel_voyages = DB::table('vessels')->select('vessel_name', 'voyage')->get();

        // Dapatkan kode_bl dari auth user atau dari parameter request
        $user = Auth::user();
        $kode_bl = $user->role == 'customer' ? $user->kode_bl : $bl;

        return view('inputpage2', compact(
            'data', 'no_of_containers', 'total_no_of_containers', 'bl', 'vessel_voyages', 'containers', 'kode_bl'
        ));
    }

    public function attachedSheet($bl)
    {
        $data = DB::table('shipping_info')->where('bl', $bl)->first();

        if (!$data) {
            return redirect()->route('review')->withErrors('Data not found');
        }

        return view('attachedsheet', compact('data'));
    }


    private function convert_number_to_words($number)
    {
        $hyphen      = '-';
        $conjunction = ' and ';
        $separator   = ', ';
        $negative    = 'negative ';
        $decimal     = ' point ';
        $dictionary  = array(
            0                   => 'zero',
            1                   => 'one',
            2                   => 'two',
            3                   => 'three',
            4                   => 'four',
            5                   => 'five',
            6                   => 'six',
            7                   => 'seven',
            8                   => 'eight',
            9                   => 'nine',
            10                  => 'ten',
            11                  => 'eleven',
            12                  => 'twelve',
            13                  => 'thirteen',
            14                  => 'fourteen',
            15                  => 'fifteen',
            16                  => 'sixteen',
            17                  => 'seventeen',
            18                  => 'eighteen',
            19                  => 'nineteen',
            20                  => 'twenty',
            30                  => 'thirty',
            40                  => 'forty',
            50                  => 'fifty',
            60                  => 'sixty',
            70                  => 'seventy',
            80                  => 'eighty',
            90                  => 'ninety',
            100                 => 'hundred',
            1000                => 'thousand',
            1000000             => 'million',
            1000000000          => 'billion',
            1000000000000       => 'trillion',
            1000000000000000    => 'quadrillion',
            1000000000000000000 => 'quintillion'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if ($number < 0) {
            return $negative . $this->convert_number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos((string)$number, '.') !== false) {
            list($number, $fraction) = explode('.', (string)$number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = floor($number / 10) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = floor($number / 100);
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . $this->convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = floor($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= $this->convert_number_to_words($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string)$fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }
    public function index()
    {
        // Mengambil data dari tabel shipping_info
        $result = ShippingInfo::all(); // Sesuaikan query ini jika Anda butuh kondisi khusus

        // Mengoper data ke tampilan view
        return view('main', compact('result'));
    }

}

