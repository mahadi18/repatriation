<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class Tweet extends Model {

}

//class Tweet extends Model implements StaplerableInterface
//{
//    use EloquentTrait;
//    // Add the 'avatar' attachment to the fillable array so that it's mass-assignable on this model.
//    protected $fillable = ['avatar', 'name', 'sku'];
//
//    public function __construct(array $attributes = array())
//    {
//        $this->hasAttachedFile('avatar', [
//            'styles' => [
//                'medium' => '300x300',
//                'thumb' => '100x100'
//            ]
//        ]);
//
//        parent::__construct($attributes);
//    }
//}
