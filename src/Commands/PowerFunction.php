<?php
namespace Jakmall\Recruitment\Calculator\Commands;

use Illuminate\Console\Command;

class PowerFunction extends Command
{
    /**
     * @var string
     */
    protected $signature = 'pow {base : The base number} {exp : The exponent number}';
    /**
     * @var string
     */
    protected $description = "Exponent the given Number";
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
        $base=$this->getBaseNumber();
        $exp=$this->getExponentNumber();
        if($this->numericalCheck($base)===true and $this->numericalCheck($exp)===true) {
            $description       = $this->generateCommand($base,$exp);
            $resultCalculation = $this->calculateAll($base,$exp);
            $finalResult = strval($description)." = ".strval($resultCalculation);
        } else {
            $this->info("your input doesn't contains numerical");
            exit;
        }
        return $finalResult;
    }

    protected function getBaseNumber()
    {
        return $this->argument('base');
    }

    protected function getExponentNumber()
    {
        return $this->argument('exp');
    }

    protected function getOperator(): string
    {
        return '^';
    }

    protected function generateCommand($base,$exp)
    {
        return ($base. ' ^ '. $exp);
    }

    /**
     * @param array $numbers
     *
     * @return float|int
     */
    protected function calculateAll($base,$exp)
    {
        $result=pow($base,$exp);
        return $result;
    }

    protected function getCommandVerb(): string
    {
        return 'pow';
    }

    protected function numericalCheck($number)
    {
        if(!is_numeric($number))
        {
		    return false;
        }
		return true;
    }
}