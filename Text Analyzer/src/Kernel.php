<?php

namespace src;

use src\Analyser\TextAnalyser;

class Kernel
{
    /**
     * @var TextAnalyser
     */
    private  $analyser;

    /**
     * @param TextAnalyser $analyser
     */
    public function __construct(TextAnalyser $analyser)
    {
        $this->analyser = $analyser;
    }

    /**
     * @param array $request
     *
     * @return void
     */
    public function handleRequest(array $request){

       echo json_encode($this->analyser->analise($request['comment']));

    }
}
