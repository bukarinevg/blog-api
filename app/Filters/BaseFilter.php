<?php 
namespace App\Filters;

use Illuminate\Http\Request;

class BaseFilter{

    protected $safeParams = [];
    protected $columnMap = [];
    
    protected $operatorMap = [
        'eq' => '=',
        'neq' => '!=',
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

?>