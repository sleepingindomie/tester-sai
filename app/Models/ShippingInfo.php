<?php
// File: app/Models/ShippingInfo.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingInfo extends Model
{
    use HasFactory;

    protected $table = 'shipping_info'; // Nama tabel di database

    protected $fillable = [
        'bl', 'type', 'shipper', 'consignee', 'notify_party', 'place_of_receipt',
        'ocean_vessel', 'port_of_loading', 'port_of_discharge', 'place_of_delivery',
        'final_destination', 'gross_weight', 'net_weight', 'measurement', 
        'no_of_containers', 'container_no', 'freight_and_charges', 'place_date_of_issue',
        'date', 'user_id', 'un_number', 'imo_number', 'description_of_goods', 
        'attached_sheet_description', 'hs_code', 'npwp', 'no_peb', 'tanggal_peb', 
        'vgm', 'peb'
    ];
}