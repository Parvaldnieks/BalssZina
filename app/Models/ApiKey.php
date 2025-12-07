<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiKey extends Model
{
    protected $fillable = ['key', 'device_name', 'api_request_id'];

    public function request()
    {
        return $this->belongsTo(ApiRequest::class, 'api_request_id');
    }
}
