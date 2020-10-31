<?php


namespace Api\V1\Subscribers\Models;


use Illuminate\Database\Eloquent\Model;
use Database\Factories\SubscriberFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscriber extends Model
{
    use HasFactory;


    protected $table = "subscribers";

    protected $fillable = [
        "email",
        "name"
    ];

    public $timestamps = true;


    protected static function newFactory()
    {
        return SubscriberFactory::new();
    }

    public function getRouteKeyName()
    {
        return "email";
    }
}
