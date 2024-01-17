<?php 

namespace App\Filters\v1;

use Illuminate\Http\Request;
use App\Filters\BaseFilter;

class CommentFilter extends BaseFilter{
    //validation rules
    protected $safeParams = [
        'content' => ['like', 'ilike', 'eq'],
        'postId' => ['eq'],
    ];

    //map request params to database columns
    protected $columnMap = [
        'postId' => 'post_id',
    ];
}