<?php

namespace Generator\Services;

use Generator\Models\CanFilterService;

class VariableFilter 
{

    const REGEX_FUNCTION = "#((.*)\(|.*)#";
    const REGEX_PARAMS  = "#\"(?<params>(.*?))\"#";

    
    public function __construct(?CanFilterService $useFilterService = null){
        if(is_null($useFilterService)){
            $this->createDefaultUseFilterService();
        }
        else{
            $this->useFilterService = $useFilterService;
        }
    }

    public function createDefaultUseFilterService(){
        $this->useFilterService = new UseFilter();
    }

    public function parseFilter($string){
        preg_match(self::REGEX_FUNCTION, $string, $matchFunction);
        preg_match_all(self::REGEX_PARAMS, $string, $matchParams);

        if(empty($matchFunction)){
            // TODO : Thrwo error
        }

        return [
            end($matchFunction),
            $matchParams['params']
        ];
    }

    /**
     *
     * @param string $str
     * @return string
     */
    public function cleanFiltersForString(string $str) : string{
        $filters = explode('|', $str);
        return $filters[0];
    }

    /**
     *
     * @param string $str
     * @return array
     */
    public function getFiltersFromString(string $str) : array {
        $filters = explode('|', $str);
        if(count($filters) > 1) {
            array_shift($filters);
        }

        return $filters;

    }

    /**
     *
     * @param int|string $value
     * @param array $filters
     * @return int|string
     */
    public function applyFilters($value, array $filters) {

        foreach($filters as $filter){
            list($function, $params) = $this->parseFilter($filter);
            
            if(!method_exists($this->useFilterService, $function)){
                continue;
            }
            
            array_unshift($params, $value);

            $value = call_user_func_array([$this->useFilterService, $function], $params);
        }

        return $value;
    }
    
}
