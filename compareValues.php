<?php
 
/*

This example accepts two lines of input from STDIN
The first line consists of two integers separated by a space. The first integer is a total number of values that we wish to compare. The second number is the deviation we want to find
The second line consists of a series of integers separated by a space.

The desire is to count the total number of integers whos are wtihin the specified deviation
Additionally, the desire is to minimize the computational time complexity as best you can

*/
 
 
//Grab everything from STDIN
$lines = array();

while( $line = fgets(STDIN)){
   
    //Set the line number
    array_push($lines, $line);
}
// End Grabbing STDIN

//Grab the requirements from the first line
$requirements = explode(" ", $lines[0]);

//Grab the values from the second line
$values = explode(" ", $lines[1]);

//sort the values descending (making it easier for comparing)
arsort($values);

//create a new CompareValues object
$theAnswer = new compareValues($values, $requirements[1], $requirements[0]);

//Tell us the answer already
$theAnswer->tellMeNOW();


class compareValues{
    
    //Initialize variables
    private $matches = 0; //total matches
    private $haystack = array(); //will house our values
    private $tot = ""; //Total number of values
    private $dev = ""; //Desired Deviation
    
    //parse method that will take the current node and compare its values to the others left in the stack
    private function parse($currentNode){ 
        
        //grab the current node
        $temp = $currentNode;
        
        //loop through while the current index (temp is less than the total indexes)
        while( $temp < $this->tot){
            
            //incremenet the count and use it as a next value index
            $temp++;
            
            //if the current value minus the next value is equal do the desired deviation
            if(abs($this->haystack[$currentNode] - ($this->haystack[$temp])) == $this->dev){
                
                //increment the matches
                $this->matches++;
            }
           
        }
        
        //set next node
        $next = $currentNode + 1;
        
        //if the next node is less than the total number of numbers we wish to compare, through the next node!
        if( $next < $this->tot){
        
            //Call parse on the next node
            $this->parse($next);
        }
        
    }
    
    //Constructor
    public function __construct($values, $deviation, $total){
        
        //Set the private variables
        $this->haystack = $values;
        $this->tot = $total-1;  //we subtract 1 as the last index will have nothing to compare to
        $this->dev = $deviation;
        
        //call the parse method
        $this->parse(0, $matches);
        
    }
    
    //Tell us the answer
    public function tellMeNOW(){
        echo $this->matches;
    }
    
}
?>