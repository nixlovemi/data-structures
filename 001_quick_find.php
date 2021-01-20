<?php
/*
Example: array of integers

$arr idx: 0 | 1 | 2 | 3 | 4 | 5 | 6 | 7 | 8 | 9 
$arr vlr: 0 | 1 | 1 | 8 | 8 | 0 | 0 | 1 | 8 | 8
{0, 5, 6}  {1, 2, 7}  {3, 4, 8, 9} = connected components

Cost model: number of array accesses (read/write)
initialize = N (size of the array)
union      = N (size of the array)
find       = 1

Defect: union too expensive (N array accesses)
		trees are flat, but too expensive to keep them flat
*/

class UnionFind
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
	
	# if both have the same value
	public function isConnected(int $p, int $q)
	{
		return ($this->_intArr[$p] == $this->_intArr[$q]);
	}
	
	# if im connecting two elements, change all elements connected to P to Q
	public function union(int $p, int $q)
	{
		$valP = $this->_intArr[$p];
		$valQ = $this->_intArr[$q];
		
		for($i=0; $i<count($this->_intArr); $i++)
		{
			if($this->_intArr[$i] == $valP)
			{
				$this->_intArr[$i] = $valQ;
			}
		}
	}
}

$UF = new UnionFind(5);
$UF->union(1, 2);
$UF->union(2, 4);

$ret1_4 = $UF->isConnected(1, 4);
$ret0_4 = $UF->isConnected(0, 4);
var_dump($ret1_4, $ret0_4);