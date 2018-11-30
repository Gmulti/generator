<?php

namespace Generator\Models\Generator\Base;

use Generator\Helpers\Spinning;
use Generator\Factory\ManyContextGeneratorFactory;
use Generator\Factory\TextGeneratorFactory;

use Generator\Models\ContextGenerator\Base\ManyContextGeneratorInterface;
use Generator\Models\ContextGenerator\Base\TextGeneratorInterface;


class BaseGenerator implements GeneratorInterface
{
    protected $textGenerators;

    public function __construct(array $textGenerators = [], $factories = [])
    {
        $this->setTextGenerators($textGenerators);

        if( ! array_key_exists( "ManyContextGenerator", $factories ) ){
            $this->setDefaultManyContextGeneratorFactory();
        }
        else{
            $this->manyContextGeneratorFactory = $factories["ManyContextGenerator"];
        }

        if( ! array_key_exists( "TextGenerator", $factories ) ){
            $this->setDefaultTextGeneratorFactory();
        }
        else{
            $this->textGeneratorFactory = $factories["TextGenerator"];

        }
    }

    public function setDefaultTextGeneratorFactory(){
        $this->textGeneratorFactory = new TextGeneratorFactory();
    }

    public function setDefaultManyContextGeneratorFactory(){
        $this->manyContextGeneratorFactory = new ManyContextGeneratorFactory();
    }

    /**
     *
     * @param array $textGenerators
     * @return void
     */
    public function setTextGenerators(array $textGenerators)
    {
        $this->textGenerators = $textGenerators;
        return $this;
    }

    /**
     *
     * @return array
     */
    public function getTextGenerators() : array
    {
        return $this->textGenerators;
    }

    /**
     *
     * @return void
     */
    protected function getSetupTextGenerators()
    {
        foreach ($this->getTextGenerators() as $key => $contextGenerator) {
            if(!array_key_exists('class', $contextGenerator)){
                continue;
            }
        
            if (array_key_exists('class', $contextGenerator) && is_string($contextGenerator['class'])) {
                $contextGenerator['class'] = new $contextGenerator['class']();
            }

            if ($contextGenerator['class'] instanceof ManyContextGeneratorInterface) {
                $contextGenerator = $this->manyContextGeneratorFactory->constructManyContextGenerator($contextGenerator);
            }
            else if ($contextGenerator['class'] instanceof TextGeneratorInterface) {
                $contextGenerator = $this->textGeneratorFactory->constructTextGenerator($contextGenerator);
            }

            yield $contextGenerator;
        }
    }

    public function countWords()
    {
        $count = 0;
        foreach ($this->getSetupTextGenerators() as $key => $textGenerator) {
            $count += $textGenerator->countWords();
        }

        return $count;
    }

    /**
     *
     * @param any $data
     * @return string
     */
    public function generate($data) : string
    {
        $str = '';
        foreach ($this->getSetupTextGenerators() as $key => $textGenerator) {
            if (array_key_exists('data', $textGenerator)) {
                $str .= $textGenerator->generate($textGenerator['data']);
            } else {
                $str .= $textGenerator->generate($data);
            }
        }

        $str = Spinning::process($str);
        $variableToString = generator_get_service('VariableToString');
        $str = $variableToString->setDataset($data)->replace($str , $data); 
        
        return $str;
    }
}
