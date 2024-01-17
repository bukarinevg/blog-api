<?php 

namespace App\Filters\v1;

use Illuminate\Http\Request;
use App\Filters\BaseFilter;

class PostFilter extends BaseFilter{
    //validation rules
    protected $safeParams = [
        'type' => ['eq'],
        'title' => ['like', 'ilike', 'eq'],
        'content' => ['like', 'ilike', 'eq'],
        'slug' => ['like', 'ilike', 'eq'],
        'publishedAt' => ['eq', 'gt', 'gte', 'lt', 'lte'],
    ];

    //map request params to database columns
    protected $columnMap = [
        'publishedAt' => 'published_at',
        'userId' => 'user_id',
    ];

}