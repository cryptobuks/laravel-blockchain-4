<?php

namespace Tavux\LaravelBlockchain;

use Illuminate\Database\Eloquent\Model;

class BlockchainWallet extends Model
{
    use HasBlockchainAddress;

    protected $fillable = [
        'balance',
        'currency',
        'user_id'
    ];

    protected $hidden = [
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
