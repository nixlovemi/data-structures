<?php
/*
The idea is to run through the array enough times to float the higher value to the "top" of the array (keep doing until no swap is necessary).
The algorithm is quadratic so it's not good for a huge quantity of elements.

n² at worst case
*/

class BubbleSort
{
	public static function swap(array $array1, int $index1, int $index2)
	{
		$temp            = $array1[$index1];
		$array1[$index1] = $array1[$index2];
		$array1[$index2] = $temp;
		
		return $array1;
	}
	
	public static function bubble_sort(array $array)
	{
		for($i = count($array); $i > 0; $i--) {
			$noSwaps = true;
			
			for($j = 0; $j < $i - 1; $j++){
			  if($array[$j] > $array[$j + 1]){
				$array   = BubbleSort::swap($array, $j, $j + 1);
				$noSwaps = false;
			  }
			}
			
			if($noSwaps) break;
		}
		
		return $array;
	}
}

$arr    = [9, 5, 4, 7, 2, 3, 6];
$arrRet = BubbleSort::bubble_sort($arr);
echo "<pre>";
print_r($arrRet);