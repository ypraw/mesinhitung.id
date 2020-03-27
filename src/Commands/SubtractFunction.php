<?php
namespace Jakmall\Recruitment\Calculator\Commands;

use Illuminate\Console\Command;

class SubtractFunction extends Command
{
    /**
     * @var string
     */
    protected $signature = 'subtract {numbers* : The numbers to be added}';
    /**
     * @var string
     */
    protected $description = "Subtract all given Numbers";
    protected $storage = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $result = $this->calculate();
        echo $result. "\n";
    }

    protected function calculate() {
        $number = $this->getInput();
        if(count($number) > 0 and $this->numericalCheck($number)===true) {
            $description       = $this->generateCommand($number);
            $resultCalculation = $this->calculateAll($number);
            $finalResult = strval($description)." = ".strval($resultCalculation);
        } else {
            $this->info('Please fill your numbers!');
            exit;
        }
        return $finalResult;
    }

    protected function getInput()
    {
        return $this->argument('numbers');
    }

    protected function getOperator(): string
    {
        return '-';
    }

    protected function generateCommand($arrayNumber)
    {
        return implode(' - ', $arrayNumber);
    }

    /**
     * @param array $numbers
     *
     * @return float|int
     */
    protected function calculateAll(array $numbers)
    {
        $result = reset($numbers);
        if(count($numbers) > 0) {
            foreach (array_slice($numbers,1) as $data){
                $result-= $data;
            }
        }
        return $result;
    }
    protected function getCommandVerb(): string
    {
        return 'Subtract';
    }
     protected function numericalCheck(array $numbers)
    {
        foreach ($numbers as $value) {
            if(!is_numeric($value)){
				return false;
            }
        }
		return true;
    }
}