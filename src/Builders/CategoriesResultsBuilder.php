<?php

namespace src\Builders;

use Spatie\DataTransferObject\DataTransferObjectError;
use src\Exceptions\ApiExceptions;
use src\Exceptions\ApiBuilderException;
use src\Models\Category;
use \Exception;

class CategoriesResultsBuilder 
{
    private ?array $response;

    public function __construct(?array $response)
    {
        $this->response = $response;
    }

    public function build():array
    {
        $result = [];
        if(is_null($this->response)){
            return $result;
        }
        try{

            foreach($this->response as $category){
                $result[] = new Category($category);
            }

        } catch(Exception $e){
            throw new ApiBuilderException('Wrong Api Response');
        }
        return $result;
    }



}