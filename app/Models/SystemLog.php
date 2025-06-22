<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemLog extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'description',
        'ip_address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function log($action, $description, $userId = null)
    {
        self::create([
            'user_id' => $userId ?? auth()->id(),
            'action' => $action,
            'description' => $description,
            'ip_address' => request()->ip()
        ]);
    }
}
