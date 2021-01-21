<?php
/*
Objective: divide the original array into half until it gets with just 1 element, then sort the smallest array back to the original
Ex:

[9, 5, 6 ,2 ,1 ,3, 8, 4, 7]

[9, 5, 6, 2]  [1, 3, 8, 4, 7]

[9, 5]  [6, 2]  [1, 3]  [8, 4, 7]

						[8]  [4, 7]
						
Uses more memory (copy the original array n times)
*/

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class MergeSort
{
	public static function merge(array $array1, array $array2) {
		$result = [];
  
		$i = 0;
		$j = 0;

		# move pointer to compare elements of the two arrays
		while($i < count($array1) && $j < count($array2))
		{
			# if the element of array 1 is smaller than array 2
			# get the value and then add 1 to $i
			if($array1[$i] < $array2[$j]) {
				$result[] = $array1[$i];
				$i++;
			}
			else
			{
				# get the value of array2 and add 1 to $j
				$result[] = $array2[$j];
				$j++;
			}
		}

		# move any leftover to result from array1
		while($i < count($array1))
		{
			$result[] = $array1[$i];
			$i++;
		}

		# move any leftover to result from array2
		while($j < count($array2))
		{
			$result[] = $array2[$j];
			$j++;
		}

		return $result;
	}
	
	public static function merge_sort(array $arr)
	{
		# exit condition
		if(count($arr) <= 1)
		{
			return $arr;
		}

		$medIdx = count($arr) / 2;
		
		$leftArr  = MergeSort::merge_sort(array_slice($arr, 0, $medIdx));
		$rightArr = MergeSort::merge_sort(array_slice($arr, $medIdx));
		
		return MergeSort::merge($leftArr, $rightArr);
		// return array_merge($leftArr, $rightArr);
	}
}

$arr = [9, 5, 6 ,2 ,1 ,3, 8, 4, 7];
# $arr = ['B', 'C', 'A', 'F', 'G', 'R', 'Q', 'U', 'Z'];
echo "<pre>";
print_r(MergeSort::merge_sort($arr));