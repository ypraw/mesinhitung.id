<?php
namespace Jakmall\Recruitment\Calculator\Commands;

use Illuminate\Console\Command;

class MultiplyFunction extends Command
{
    /**
     * @var string
     */
    protected $signature = 'multiply {numbers* : The numbers to be added}';
    /**
     * @var string
     */
    protected $description = "Multiply all given Numbers";
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
            $this->info("your input doesn't contains numerical");
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
        return '*';
    }

    protected function generateCommand($arrayNumber)
    {
        return implode(' * ', $arrayNumber);
    }

    /**
     * @param array $numbers
     *
     * @return float|int
     */
    protected function calculateAll(array $numbers)
    {
        $result = null;
        if(count($numbers) > 0) {
            $result = array_product($numbers);
        }
        return $result;
    }

    protected function getCommandVerb(): string
    {
        return 'Add';
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