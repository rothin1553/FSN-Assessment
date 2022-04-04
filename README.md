# FSN-Assessment
Code Assessment for Flower Shop Network

main.php contains all the code for FSN Assessment. 

Code breakdown:
main.php
  . Class Basket 
    . private attributes
      . basket - associate array of item and item count
      . price - associate array of price for each item 
      . delivery_fee - associate array of rule and delivery fee 
      . promotion - boolean of promotion 
    . methods
      . --construct - initialize all private attributes
      . b() - print out item and item count in basket 
      . order() take array of item code as parameter then add item to basket
      . calculate_promotion() check boolean of promotion then calculate specific rule for promotion 
      . get_total() calculate total including fee and promotion discount
      
 . testing
    . testing code and validate the class Basket with difference inputs 
    
To Run:
  . execute the php script to see the result of the testing and validating. 
