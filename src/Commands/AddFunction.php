<?php
namespace Jakmall\Recruitment\Calculator\Commands;

use Illuminate\Console\Command;

class AddFunction extends Command
{
    /**
     * @var string
     */
    protected $signature = 'add {numbers* : The numbers to be added}';
    /**
     * @var string
     */
    protected $description = "Add all given Numbers";
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
        if(count($number) > 0) {
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
        return '+';
    }

    protected function generateCommand($arrayNumber)
    {
        return implode(' + ', $arrayNumber);
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
            $result = array_sum($numbers);
        }
        return $result;
    }
    protected function getCommandVerb(): string
    {
        return 'Add';
    }
}