<html>

<head>
  <title>Tip Calculator</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
</head>

<script type="text/javascript">
  function toggle_other_tip_box(value) {
    if (value == 'show') {
      document.getElementById('other_tip').style.display = 'inline';
    } else {
      document.getElementById('other_tip').style.display = 'none';
    }
  }
</script>

<body>
  <div class="calculator_style">
    <h3>Tip Calculator</h3></br>
    <form id="tip_calculator_form" action="index.php" method="post">
      <?php

# Allow values to persist between submissions if all values are not filled
check_bill_total_field();
check_tip_percentage_field();
check_field_reset();

generate_input_fields();
generate_tip_radio_buttons();
generate_other_tip_radio_button();

echo '</br></br><input type="submit" name="submit" value=""></br></form>';

#On Button Submission
if(isset($_POST["submit"]))
{
    if(validate_bill_total() && validate_tip_percentage())
    {
        echo '<div id="answer_box" class="answer_style">';
        calculate_tip();
        echo '</div>';
    }
}

function check_bill_total_field()
{
    if (isset($_POST['bill_total']) && intval($_POST['bill_total']) > 0)
    {
        $GLOBALS['error_in_bill_total'] = false;
        $GLOBALS['previous_bill_total'] = $_POST['bill_total'];
    }
    else{
        $GLOBALS['error_in_bill_total'] = true;
        $GLOBALS['previous_bill_total'] = 0;
    }
}

function check_tip_percentage_field()
{
    if (!isset($_POST['tip_percentage']))
    {
        $GLOBALS['error_in_tip_radio'] = true;
        $GLOBALS['previous_tip_percentage'] = 0;
        $GLOBALS['previous_other_tip_percentage'] = 0;
    }
    else
    {
        $GLOBALS['error_in_tip_radio'] = false;
        $GLOBALS['previous_tip_percentage'] = $_POST['tip_percentage'];
        $GLOBALS['previous_other_tip_percentage'] = $_POST['other_tip_input'];
    }
}

function check_field_reset()
{
    if(isset($_POST['tip_percentage']) && isset($_POST['bill_total']) && intval($_POST['bill_total']) > 0)
    {
        $GLOBALS['previous_bill_total'] = 0;
        $GLOBALS['previous_tip_percentage'] = 0;
        $GLOBALS['previous_other_tip_percentage'] = 0;
    }
}

function generate_input_fields()
{
    #Sets color if the previous input was incorrect
        if ($GLOBALS['error_in_bill_total']) $billing_text_type = "error_text";
    if (!$GLOBALS['error_in_bill_total']) $billing_text_type = "normal_text";
    echo "<p class=\"$billing_text_type\"> Bill Subtotal: <input type=\"text\" name=\"bill_total\"  value=\"" . $GLOBALS['previous_bill_total'] . "\"></p>";
    
    if ($GLOBALS['error_in_tip_radio']) $billing_text_type = "error_text";
    if (!$GLOBALS['error_in_tip_radio']) $billing_text_type = "normal_text";
    echo "<p class=\"$billing_text_type\"> Tip Percentage: </p>";
}

function generate_tip_radio_buttons()
{
    for($x = 0; $x < 3; $x++)
    {
        $is_checked = "";
        $tip_percent_to_display = 10+5*$x;
        if ($tip_percent_to_display == $GLOBALS['previous_tip_percentage']) $is_checked = 'CHECKED';
        echo $tip_percent_to_display . "%";
        echo "<input type=\"radio\" name=\"tip_percentage\" value=$tip_percent_to_display . \"%\" onclick=\"toggle_other_tip_box('hide');\" $is_checked> ";
    }
}

function generate_other_tip_radio_button()
{
 $is_checked = "";
    if ($GLOBALS['previous_tip_percentage'] != '0' && 
        $GLOBALS['previous_tip_percentage'] != '10' && 
        $GLOBALS['previous_tip_percentage'] != '15' &&
        $GLOBALS['previous_tip_percentage'] != '20') 
        {
            $is_checked = "CHECKED";
        }

    echo "</br>Other";
    echo "<input type=\"radio\" name=\"tip_percentage\" value='Other' . onclick=\"toggle_other_tip_box('show');\" \"%\" $is_checked> ";
    echo '<div id="other_tip"> <input type="text" style="width: 60px" name="other_tip_input" value=\'' . $GLOBALS['previous_other_tip_percentage'] . '\'></div>';

    if ($is_checked == "CHECKED")
    {
        echo "<script>toggle_other_tip_box('show')</script>";
    }
    else{
        echo "<script>toggle_other_tip_box('hide')</script>";
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
    
    echo "Subtotal: ";
    echo money_format('$%i', $_POST["bill_total"]);
    echo "</br>";
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
    $tip_percentage = $_POST["tip_percentage"];
    if ($tip_percentage == "Other")
    {
        $tip_percentage = $_POST['other_tip_input'];
    }
    $tip = $_POST["bill_total"] * $tip_percentage * .01;
    $total = $_POST["bill_total"] + $tip;
    echo "Tip: ";
    echo money_format('$%i', $tip);
    echo "</br>";
    echo "Total: ";
    echo money_format('$%i', $total);
}
?>
  </div>
</body>

</html>