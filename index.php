<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
 <h3>Tip Calculator</h3></br>
 <form>
 Bill Subtotal:
 <input type="text" name="bill_total">
 </br>
 Tip Percentage:
 </br>
 10%
 <input type="radio" name="tip_percentage" value="10%">
 15%
 <input type="radio" name="tip_percentage" value="15%">
 20%
 <input type="radio" name="tip_percentage" value="20%">
 </br>
 <input type="submit" name="submit">
 </form>
 <?php 
    calculate_tip();
    function calculate_tip()
    {
        echo "Calculated!";
    }
  ?> 
 </body>
</html>