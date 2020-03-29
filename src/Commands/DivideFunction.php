<?php
namespace Jakmall\Recruitment\Calculator\Commands;

use Illuminate\Console\Command;

class DivideFunction extends Command
{
    /**
     * @var string
     */
    protected $signature = 'Divide {numbers* : The numbers to be devided}';
    /**
     * @var string
     */
    protected $description = "Divide all given Numbers";
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

    protected function calculate()
    {
        $number = $this->getInput();
        if (count($number) > 0 and $this->numericalCheck($number)===true) {
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

    protected function generateCommand($arrayNumber)
    {
        return implode(' / ', $arrayNumber);
    }

    /**
     * @param array $numbers
     *
     * @return float|int
     */
    protected function calculateAll(array $numbers)
    {
        // $result = null;
        if (count($numbers) > 0) {
            // $result = array_product($numbers);
            $initial=array_shift($numbers);
            $result=array_reduce($numbers, function ($rDiv, $value) {
                return $value == 0 ? $rDiv : ($rDiv / $value);
            }, $initial);
        }
        return $result;
    }

    protected function numericalCheck(array $numbers)
    {
        foreach ($numbers as $value) {
            if (!is_numeric($value)) {
                return false;
            }
        }
        return true;
    }
}
