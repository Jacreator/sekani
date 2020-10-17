<?php

/**
 * @param $request
 * @param array $rules
 */
function coreValidator($request, $rules = [])
{
    foreach ($request as $item => $item_value) {

        if (array_key_exists($item, $rules)) {

            foreach ($rules[$item] as $rule => $rule_value) {

                if (is_int($rule)) {
                    $rule = $rule_value;
                }
                switch ($rule) {

                    case 'required':
                        if (empty($item_value) && $rule_value) {
                            addError($item, ucwords($item) . ' required');
                        }
                        break;

                    case 'min':
                        if (strlen($item_value) < $rule_value) {
                            addError($item, ucwords($item) . ' should be minimum ' . $rule_value . ' characters');
                        }
                        break;

                    case 'max':
                        if (strlen($item_value) > $rule_value) {
                            addError($item, ucwords($item) . ' should be maximum ' . $rule_value . ' characters');
                        }
                        break;

                    case 'numeric':
                        if ($rule_value && !ctype_digit($item_value)) {
                            addError($item, ucwords($item) . ' should be numeric');
                        }
                        break;

                    case 'alpha':
                        if ($rule_value && !ctype_alpha($item_value)) {
                            addError($item, ucwords($item) . ' should be alphabetic characters');
                        }
                        break;

                    case 'email':
                        if ($rule_value && !filter_var($item_value, FILTER_VALIDATE_EMAIL)) {
                            addError($item, ucwords($item) . ' must be valid');
                        }
                        break;

                    case 'trim':
                        trim($item_value);
                        break;

                    case 'replace':
                        preg_replace('/[^A-Za-z0-9\-]/', '', $item_value);
                        break;

                    case 'strip':
                        stripcslashes($item_value);
                        break;

                    case 'html':
                        htmlspecialchars($item_value);
                        break;
                }
            }
        }
    }
} //End of validation 

/***
 * @param $item
 * @param $error
 * Add Error Method
 */
function addError($item, $error)
{
    $_errors[$item][] = $error;
} //End


/***
 * @param $_errors
 * @return array|false
 * Error Check Method
 */
function error($_errors)
{
    if (empty($_errors)) {
        return false;
    }
    return $_errors;

} //End


/***
 * @param $errors
 * Error Loop Method
 */
function errorLoop($errors)
{
    foreach ($errors as $errorList) {
        return json_encode($errorList);
    }
}

/**
 * this check the database for any presence of information
 *
 * @param $table
 * @param array $condition
 * @return array|null
 */
function existing($table, $condition = [])
{
    return selectOne($table, $condition);
}

