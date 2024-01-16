<?php 

namespace App\Services\v1;

use Illuminate\Http\Request;
use App\Models\Post;

class PostQuery{
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

    //map request params to operators
    protected $operatorMap = [
        'eq' => '=',
        'like' => 'LIKE',
        'ilike' => 'not LIKE',
        'gt' => '>',
        'gte' => '>=',
        'lt' => '<',
        'lte' => '<=',
    ];

    public function transform(Request $request){
        $paramArray = [];
        //go  throw all possible params
        foreach($this->safeParams as $parm => $operators){

            //get the value of the request param from query if isset
            $query = $request->query($parm);
            if(!($query)){
                continue;
            }
            //map the request param to the database column
            $column = $this->columnMap[$parm] ?? $parm;

            //if the request param has multiple opeartors
            foreach($operators as $operator){
                
                if(isset($query[$operator])){
                    if($operator == 'like' || $operator == 'ilike'){
                        $query[$operator] = "%{$query[$operator]}%";
                    }
                    $paramArray[] = [ $column, $this->operatorMap[$operator], $query[$operator] ];
                }
            }

            
        }
        return $paramArray;
    }
}