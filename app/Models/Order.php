<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use App\Models\User;
use App\Models\Location;
use App\Models\Payment;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = [ 'date'];

    public function service()
    {
        return $this->belongsToMany(Service::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'customer');
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'staff');
    }

    public function lokasi()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
