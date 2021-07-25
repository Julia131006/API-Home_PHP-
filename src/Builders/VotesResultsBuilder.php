<?php

namespace src\Builders;

use Spatie\DataTransferObject\DataTransferObjectError;
use src\Exceptions\ApiExceptions;
use src\Exceptions\ApiBuilderException;
use src\Models\Vote;
use \Exception;

class VotesResultsBuilder 
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

            foreach($this->response as $vote){
                $result[] = new Vote($vote);
            }

        } catch(Exception $e){
            throw new ApiBuilderException('Wrong Api Response');
        }
        return $result;
    }



}