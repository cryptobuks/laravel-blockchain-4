<?php

namespace Tavux\LaravelBlockchain;


use Illuminate\Database\Eloquent\Model;

class BlockchainAddress extends Model
{
    protected $fillable = [
        'address',
        'object_id',
        'object_type'
    ];


    protected $hidden = [
        'object_id',
        'object_type'
    ];

}
