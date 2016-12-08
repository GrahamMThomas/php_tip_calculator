<html>

<head>
  <title>PHP Test</title>
  <style>
    .calculator_style {
      float: left;
      margin: 5px;
      padding: 15px;
      max-width: 300px;
      height: 350px;
      border: 1px solid black;
    }
    
    .answer_style {
      float: left;
      margin: 5px;
      padding: 15px;
      min-width: 180px;
      max-width: 300px;
      height: 75px;
      border: 1px solid black;
      hidden: true;
    }
  </style>
</head>

<body>
  <div class="calculator_style">
    <h3>Tip Calculator</h3></br>
    <form id="tip_calculator_form" action="index.php" method="post">
      Bill Subtotal:
      <input type="text" name="bill_total" value=0>
      </br>
      </br>
      Tip Percentage:
      </br>
      </br>
      <!--- Change these to php -->
      <?php
for($x = 0; $x < 3; $x++)
{
    $tip_percent = 10+5*$x;
    echo $tip_percent . "%";
    echo "<input type=\"radio\" name=\"tip_percentage\" value=$tip_percent . \"%\">";
}
?>
        </br>
        </br>
        <input type="submit" name="submit" value="Calculate Now">
        </br>
    </form>

    <div id="answer_box" class="answer_style">
      <?php
if(isset($_POST["submit"]))
{
    if(validate_bill_total() && validate_tip_percentage())
    {
        calculate_tip();
    }
}

function validate_bill_total()
{
    $bill_total = intval($_POST["bill_total"]);
    if ($bill_total == 0)
    {
        echo "Please enter a valid bill total.";
        return false;
    }
    echo "Subtotal: " . intval($bill_total) . "</br>";
    return true;
}

function validate_tip_percentage()
{
    if(isset($_POST["tip_percentage"]))
    {
        return true;
    }
    else
    {
        echo "Please select a tip percentage.";
        return false;
    }
}

function calculate_tip()
{
    $tip = $_POST["bill_total"] * $_POST["tip_percentage"] * .01;
    $total = $_POST["bill_total"] + $tip;
    echo "Tip: $" . $tip . "</br>";
    echo "Total: $" . $total;
}
?>
    </div>
  </div>
</body>

</html>