<?php
/*
Data structure: array of integers
Interpretation: id[i] is parent of i
Root of i is id[ id[i] ]...

Ex:
0  1  9    6  7  8
   2  4    5
      3
	  
array idx: 0 1 2 3 4 5 6 7 8 9
array vlr: 0 1 1 4 9 6 6 7 8 9

Cost model: number of array accesses (read/write)
initialize = N (size of the array)
union      = N (size of the array + including time to find roots)
find       = N

Defect: trees can get tall
		find too expensive (could be N array accesses)
		
>> There are times that can be fast AND times that can be slow.
*/

class QuickUnionLa
{
	private $_intArr = [];
	
	# start the array with key = value = size-1
	public function __construct(int $size)
	{
		for($i=0; $i<$size; $i++)
		{
			$this->_intArr[$i] = $i;
		}
	}
	
	# chase parent pointers until reach root
	private function root(int $i)
	{
		while($i != $this->_intArr[$i])
		{
			$i = $this->_intArr[$i];
		}
		return $i;
	}
	
	# if both have the same root
	public function isConnected(int $p, int $q)
	{
		return ($this->root($p) == $this->root($q));
	}
	
	# change root of $p to point to root of $q
	public function union(int $p, int $q)
	{
		$rootP = $this->root($p);
		$rootQ = $this->root($q);
		
		$this->_intArr[$rootP] = $rootQ;
	}
}

$QULA = new QuickUnionLa(5);
$QULA->union(0, 1);
$QULA->union(1, 3);

$ret_03 = $QULA->isConnected(0, 3);
$ret_24 = $QULA->isConnected(2, 4);

echo "<pre>";
var_dump($ret_03, $ret_24);
echo "</pre>";