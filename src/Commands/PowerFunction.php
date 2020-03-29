<?php
namespace Jakmall\Recruitment\Calculator\Commands;

use Illuminate\Console\Command;

class PowerFunction extends Command
{
    /**
     * @var string
     */
    protected $signature = 'pow {base : The base number} {exp* : The exponent number}';
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

    protected function calculate()
    {
        $base=$this->getBaseNumber();
        $exp=$this->getExponentNumber();
        // var_dump($base);
        if (count($exp)==1 and $this->numericalCheck($base)===true and $this->numericalCheck($exp[0])===true) {
            $description       = $this->generateCommand($base, $exp[0]);
            $resultCalculation = $this->calculateAll($base, $exp[0]);
            $finalResult = strval($description)." = ".strval($resultCalculation);
        } elseif (count($exp)>1) {
            $this->error('Something went wrong!, your exponent number too much:(');
        } else {
            $this->error("your input doesn't contains numerical");
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

    protected function generateCommand($base, $exp)
    {
        return ($base. ' ^ '. $exp);
    }

    /**
     * @param array $numbers
     *
     * @return float|int
     */
    protected function calculateAll($base, $exp)
    {
        $result=pow($base, $exp);
        return $result;
    }

    protected function getCommandVerb(): string
    {
        return 'pow';
    }

    protected function numericalCheck($number)
    {
        if (!is_numeric($number)) {
            return false;
        }
        return true;
    }
}
