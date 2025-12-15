<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $cat_id
 * @property float $fee
 * @property float $salary
 * @property string $status
 * @property int $payment_status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Application extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'cat_id', 'fee', 'status', 'salary', 'payment_status'];

    public function cat() {
        return $this->belongsTo(Cat::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
