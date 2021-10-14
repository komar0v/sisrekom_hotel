<?php

namespace App\Controllers;

class Cosine_Sim extends BaseController
{
	public function index()
	{
		echo(200);
	}

    protected $data_a;
    protected $data_b;

    public function __construct(array $data_a, array $data_b)
    {
        $this->data_a = $data_a;
        $this->data_b = $data_b;
    }

   
    // Mengambil nilai similaritas
    // Rentang hasil: 0 - 1
    // Rumus: sum(ai * bi) / (root(sum(ai^2)) * root(sum(bi^2)))
    
    public function calculate(): float
    {
        $top = $this->getTop();
        $div = $this->getDivider();

        return $top / $div;
    }

    private function getTop(): float
    {
        $data_a = $this->data_a;
        $data_b = $this->data_b;

        $sum = 0;
        foreach ($data_a as $i => $a) {
            $b = isset($data_b[$i]) ? $data_b[$i] : null;

            // Jika salah satu dari a atau b nilainya null ...
            if (is_null($a) || is_null($b)) {
                continue; // ... skip
            }

            $sum += $a * $b;
        }

        return $sum;
    }

    //Nilai pembagi
    //Rumus: root(sum(ai^2)) * root(sum(bi^2))

    private function getDivider(): float
    {
        $data_a = $this->data_a;
        $data_b = $this->data_b;

        $root_sum_square_a = $this->rootSumSquares($data_a);
        $root_sum_square_b = $this->rootSumSquares($data_b);

        return $root_sum_square_a * $root_sum_square_b;
    }

    private function rootSumSquares(array $data): float
    {
        // Kalkulasi nilai kuadrat masing-masing item dari data
        // [1, null, 2] -> [1, 0, 4] (null diubah jadi 0)
        $squares = array_map(function($x) {
            return is_null($x) ? 0 : $x * $x;
        }, $data);

        // Summary hasil kuadrat
        // [1, 0, 4] -> 5
        $sum_squares = array_sum($squares);

        // Kembalikan akar dari summary
        return sqrt($sum_squares);
    }

    public static function calc(array $data_a, array $data_b): float
    {
        return (new static($data_a, $data_b))->calculate();
    }
}
