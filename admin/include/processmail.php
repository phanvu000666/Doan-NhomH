<?php
foreach ($_POST as $key => $value) {
    # value != array. strip whitespace from $value.
    if (!is_array($value)) {
        $value = trim($value);
    }
    if (!in_array($key, $expected)) {
        continue;
    }
    if (in_array($key, $required) && empty($value)) {
        //required  value is missing
        $missing[] = $key;
        $$key = "";
        continue;
    }

    $$key = $value;
}
