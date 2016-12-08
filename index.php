<html>

<head>
  <title>PHP Test</title>
</head>

<body>
  <h3>Tip Calculator</h3></br>
  <form id="tip_calculator_form" action="index.php" method="post">
    Bill Subtotal:
    <input type="text" name="bill_total">
    </br>
    Tip Percentage:
    </br>
    10%
    <!--- Change these to php -->
    <input type="radio" name="tip_percentage" value="10%"> 15%
    <input type="radio" name="tip_percentage" value="15%"> 20%
    <input type="radio" name="tip_percentage" value="20%">
    </br>
    <input type="submit" name="submit" value="Calculate Now">
    </br>
    Tip:
  </form>
  <!---
  <?php
if(isset($_POST["submit"]))
{
    $tip = $_POST["bill_total"] * $_POST["tip_percentage"] * .01;
    $total = $_POST["bill_total"] + $tip;
    echo "Calculating $" . $_POST["bill_total"] . " tip at " . $_POST["tip_percentage"] . " percent!";
    echo "Tip: $" . $tip . "\n";
    echo "Total: $" . $total . "\n";
}
?>
-->
</body>

</html>