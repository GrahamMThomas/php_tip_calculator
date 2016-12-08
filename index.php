<html>

<head>
  <title>PHP Test</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
  </head>

<body>
  <div class="calculator_style">
    <h3>Tip Calculator</h3></br>
    <form id="tip_calculator_form" action="index.php" method="post">
      <?php
# Allow values to persist between submissions if all values are not filled
    if (!isset($_POST['bill_total']))
    {
        $previous_bill_total = 0;
    }
    else{
        $previous_bill_total = $_POST['bill_total'];
    }

    if (!isset($_POST['tip_percentage']))
    {
        $previous_tip_percentage = 0;
    }
    else
    {
        $previous_tip_percentage = $_POST['tip_percentage'];
    }

    if(isset($_POST['tip_percentage']) && isset($_POST['bill_total']) && $_POST['bill_total'] != '0')
    {
        $previous_bill_total = 0;
        $previous_tip_percentage = 0;
    }
    
    ?>
        Bill Subtotal:
        <input type="text" name="bill_total" value=<?php echo $previous_bill_total?>>
        </br>
        </br>
        Tip Percentage:
        </br>
        </br>
        <!--- Change these to php -->
        <?php
    for($x = 0; $x < 3; $x++)
    {
        $is_checked = "";
        $tip_percent_to_display = 10+5*$x;
        if ($tip_percent_to_display == $previous_tip_percentage) $is_checked = 'CHECKED';
        echo $tip_percent_to_display . "%";
        echo "<input type=\"radio\" name=\"tip_percentage\" value=$tip_percent_to_display . \"%\" $is_checked> ";
    }
    ?>
          </br>
          </br>
          <input type="submit" name="submit" value="">
          </br>
    </form>

      <?php
    if(isset($_POST["submit"]))
    {
        if(validate_bill_total() && validate_tip_percentage())
        {
            echo '<div id="answer_box" class="answer_style">';
            calculate_tip();
            echo '</div>';
        }
    }
    
    function validate_bill_total()
    {
        $bill_total = intval($_POST["bill_total"]);
        if ($bill_total <= 0)
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
</body>

</html>