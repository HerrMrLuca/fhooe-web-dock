<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><!-- TODO: Place a title here --></title>
</head>
<body>
<?php

    $all_money = 0;

    if (isset($_POST["textArea"]) && mb_strlen($_POST["textArea"]) !== 0) {
        $money = $_POST["textArea"];

        //"/((( |^)([1-9])([0-9]*))| 0),([0-9])([0-9]) EUR\b|( |^)([1-9])([0-9]*),-|( |^)([0-9])([0-9]*) EUR\b/"
        //"/( ([1-9])([0-9]*)),([0-9])([0-9]) EUR\b| ([0-9])([0-9]*),-| ([0-9])([0-9]*) EUR\b/"

        if (preg_match_all("/((( |^)([1-9])([0-9]*))| 0),([0-9])([0-9]) EUR\b|( |^)([1-9])([0-9]*),-|( |^)([0-9])([0-9]*) EUR\b/", $money, $matches)) {

            foreach ($matches[0] as $i) {

                $match_money = trim($i, "EUR");
                $match_money = trim($match_money);
                $match_money = str_replace(",", ".", $match_money);
                $match_money = str_replace("-" , "0", $match_money);
                GLOBAL $all_money;
                $all_money += $match_money;
            }

        }
        echo "<p>$all_money</p>";
    } else {
        echo "<p>Error: No input specified.</p>";
    }


// TODO: see hype2ue-t1-ue1-regex/example for an example, how to implement this exercise

// TODO: Declare and initialize a variable, that holds the sum of EUROs

// TODO: Get the data from the form in index.html. Check if the given key exists in $_POST (isset())

// TODO: Create a regular expression that matches the required criteria using preg_match_all (see PHP Documentation)
// TODO: @see https://regex101.com/ for an explanation
// TODO: Use the text snippet in teststring.txt to test your regex on http://www.phpliveregex.com/.
// TODO: It shows all valid and invalid test cases and they should sum up to 1000 EUR, if your regex is accurate.

// TODO: Build the sum of all valid amounts.
// TODO: Either loop with foreach or in a similar way over matching amounts of money in the result of preg_match_all()
// TODO: or build a regex in a way, that you can use array_sum().
// TODO: If needed, use var_dump() to see, what $matches returned by preg_match_all() looks like.
// TODO: @see output of phpliveregex.com.

// TODO: Additional hints for building the sum.
// TODO: Use str_replace() to change commas "," to decimal points "." to be able to sum up the money in PHP
// TODO: Depending on your regular expression, you may need to replace " EUR" with "" to get plain numbers.
// TODO: OPTIONAL challenge: You can do both steps at once with preg_replace_callback_array() (see PHP Documentation)

// TODO: Finally display the text used for testing and the resulting amount (echo).
// TODO: Use number_format() for formatting the sum.
// TODO: Use htmlentities() or a similar function to avoid XSS, if you return the text input.

?>
    <a href="index.html">Start Over</a>
</body>
</html>
