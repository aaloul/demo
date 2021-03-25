<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "logo", "email", "phone", "mobile", "fax", "state", "city", "address", "latitude", "longitude", "postcode"
    ];

    public function images()
    {
        return $this->hasMany(PharmacyImage::class);
    }
}
