<?php
class Basket
{
    // private attributes
    private $basket; // associate array
    private $price; // associate array
    private $delivery_fee; // associate array
    private $promotion; // boolean

    // constuctor to initialize the basket var
    function __construct()
    {
        // initilize basket to zeros 
        $this->basket = array(
            "RF1" => 0,
            "GF1" => 0,
            "BF1" => 0,
        );

        // initilize prices
        $this->price = array(
            "RF1" => 32.95,
            "GF1" => 24.95,
            "BF1" => 7.95,
        );

        // initilize deliver fee
        $this->delivery_fee = array(
            90.0 => 2.95,
            50.0 => 4.95,
        );

        $this->promotion = true; 
    }

    // use for debug to see the basket 
    function b()
    {
        print_r($this->basket);
    }

    // add order to basket, take an array of product code(s) as parameter
    function order($product_codes)
    {
        foreach($product_codes as &$code)
        {
            if(array_key_exists($code, $this->basket)) // verify existence
            {
                $this->basket[$code]+=1;
            }
        }
    }

    // calculate promotion (offer)
    function calculate_promotion()
    {
        $promotion_value = 0.0; 
        if($this->promotion)
        {
            // charging 3/2 for every 2 red flowers
            $promotion_value = floor($this->basket["RF1"] / 2) * $this->price["RF1"] * 0.5;
        }

        return $promotion_value;
    }

    // calculate total accounting delivery and offer 
    function get_total()
    {
        $total = 0.0;

        // loop through basket to accumulate all item and price
        foreach($this->basket as $item_code => $item_count)
        {
            $total += $this->price[$item_code] * $item_count;
        }

        // make adjustment with promotion offer
        $total -= $this->calculate_promotion(); 

        // assume free delivery 
        $deliver_fee = 0.0;
        foreach($this->delivery_fee as $rule => $fee)
        {
            if($total < $rule) // rule is descending order, 
            {
                $deliver_fee = $fee;
            }
        }
        $total += $deliver_fee;
        
        return $total;
    }
}
?>

<?php

// Testing function for the Basket class above. 
function testing($message, $expect_value, $actual_value)
{
    print("Test for ".$message."\n");
    print("Expected value: " . $expect_value . "\n");
    print("Actual value  : " . $actual_value . "\n");
    print("Test Result   : " . (abs($expect_value - $actual_value) < 1e-7 ? "Passed" : "Failed") . "\n\n");
}

$dev_flower1 = new Basket();
$dev_flower1->order(Array("BF1", "BF1", "RF1", "RF1", "RF1"));
testing("BF1, BF1, RF1, RF1, RF1", 98.275, $dev_flower1->get_total());

$dev_flower2 = new Basket();
$dev_flower2->order(Array("BF1", "GF1"));
testing("BF1, GF1", 37.85, $dev_flower2->get_total());

$dev_flower3 = new Basket();
$dev_flower3->order(Array("RF1", "RF1"));
testing("RF1, RF1", 54.375, $dev_flower3->get_total());

$dev_flower4 = new Basket();
$dev_flower4->order(Array("RF1", "GF1"));
testing("RF1, GF1", 60.85, $dev_flower4->get_total());

$dev_flower1 = new Basket();
$dev_flower1->order(Array("RF1", "RF1", "RF1", "RF1", "RF1"));
testing("BF1, BF1, RF1, RF1, RF1", 131.80, $dev_flower1->get_total());

?>