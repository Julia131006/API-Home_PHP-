<?php

namespace src\Builders;

use Spatie\DataTransferObject\DataTransferObjectError;
use src\Exceptions\ApiExceptions;
use src\Exceptions\ApiBuilderException;
use src\Models\Image;
use \Exception;

class ImagesResultsBuilder 
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

            foreach($this->response as $image){
                $result[] = new Image($image);
            }

        } catch(Exception $e){
            throw new ApiBuilderException('Wrong Api Response');
        }
        return $result;
    }



}