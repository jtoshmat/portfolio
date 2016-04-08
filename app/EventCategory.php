<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    protected $dates = ['deleted_at'];
    protected $table = 'categories';
    protected $fillable = [];
    protected $primaryKey = 'category_id';
    public static $getCategoriesRules = array(
        'orgid' => 'required|exists:categories,orgid',
        'action' => array('required', 'regex:/^(get)|(create)$/i'),
        //'category_id' => 'sometimes|exists:categories,category_id',
    );

}
