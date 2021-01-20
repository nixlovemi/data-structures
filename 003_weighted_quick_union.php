<?php
/*
Data structure: array of integers
				array with the size of that tree
Interpretation: id[i] is parent of i
Root of i is id[ id[i] ]...

Ex:
0  1  9    6  7  8
   2  4    5
      3
	  
array idx: 0 1 2 3 4 5 6 7 8 9
array vlr: 0 1 1 4 9 6 6 7 8 9

Running time:
	Find: takes times proportional to depth of p and q
	Union: takes constant time, given roots
	Proposition: depth of any node x is at most lg N
	
Cost model: number of array accesses (read/write)
initialize = N (size of the array)
union      = lg N
find       = lg N
*/

class QuickUnionW
{
	private $_intArr  = [];
	private $_sizeArr = [];
	
	# start the array with key = value = size-1
	public function __construct(int $size)
	{
		for($i=0; $i<$size; $i++)
		{
			$this->_intArr[$i]  = $i;
			$this->_sizeArr[$i] = 1;
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
		$rootI = $this->root($p);
		$rootJ = $this->root($q);
		if($rootI == $rootJ)
		{
			return;
		}
		
		# link the root of the smaller tree to the bigger one
		if($this->_sizeArr[$rootI] < $this->_sizeArr[$rootJ])
		{
			$this->_intArr[$rootI]   = $rootJ;
			$this->_sizeArr[$rootJ] += $this->_sizeArr[$rootI];
		}
		else
		{
			$this->_intArr[$rootJ]   = $rootI;
			$this->_sizeArr[$rootI] += $this->_sizeArr[$rootJ];
		}
	}
}

$QULA = new QuickUnionW(5);
$QULA->union(0, 1);
$QULA->union(1, 3);

$ret_03 = $QULA->isConnected(0, 3);
$ret_24 = $QULA->isConnected(2, 4);

echo "<pre>";
var_dump($ret_03, $ret_24);
echo "</pre>";