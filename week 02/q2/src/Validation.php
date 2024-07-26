<?php

namespace app;

//use Validation\Exception;

class Validation
{
    private string $result;

    // validation variable in input function should set the mode of validation and if it has multi validation , it should be seprate with " , "
    // the modes are:
    //1-codemeli
    //2-phoneNum
    //3-email
    //4-number
    //5-alphabet
    //6-alphaNum
    //7-length -> it should be like this : ( length:10 )

    static function input(string $input, string $validation, bool $strictMode)
    {
        $result = "";
        $valModes = explode(",", $validation);
        foreach ($valModes as $mode) {
            if (explode(':',$mode)[0]==="length") {
                if (!(new Validation)->checkLength($input, (int)explode(":", $mode)[1])) {
                    $result .= "the length of input is invalid <br>";
                    if (!$strictMode) {
                        break;
                    }
                }
            } else {
                switch ($mode) {
                    case "codemeli":
                        if (!(new Validation)->check_codemeli($input)) {
                            $result .= "the codemeli input is invalid <br>";
                            if (!$strictMode) {
                                break 2;
                            }
                        }

                        break;
                    case "phoneNum":
                        if (!(new Validation)->isPhoneNum($input)) {
                            $result .= "the phone number is invalid <br>";
                            if (!$strictMode) {
                                break 2;
                            }
                        }
                        break;
                    case "email":
                        if (!(new Validation)->isEmail($input)) {
                            $result .= "the email is invalid <br>";
                            if (!$strictMode) {
                                break 2;
                            }
                        }

                        break;
                    case "number":
                        if (!(new Validation)->isNumber($input)) {
                            $result .= "the input is not number <br>";
                            if (!$strictMode) {
                                break 2;
                            }
                        }
                        break;
                    case "alphabet":
                        if (!(new Validation)->isAlphabet($input)) {

                            $result .= "the input is not alphabet <br>";
                            if (!$strictMode) {
                                break 2;
                            }
                        }
                        break;
                    case "alphaNum":
                        if (!(new Validation)->isAlphanum($input)) {
                            $result .= "the input is not the combine of alphabet and number <br>";
                            if (!$strictMode) {
                                break 2;
                            }
                        }
                        break;

                    default:
                        throw new Exception("Invalid validation mode");
                        break;
                }

            }
        }



        if (empty($result)) {
            echo "your input in valid ";
        }else{
            echo $result;
        }


    }


    public function check_codemeli(string $codeMeli): bool
    {
        if (preg_match('/^\d+$/', $codeMeli)) {
            if (strlen($codeMeli) == 10) {
                $rev = strrev($codeMeli);
                $sum = 0;
                $checkNum = 0;
                for ($i = 1; $i < strlen($rev); $i++) {
                    $sum += ($i + 1) * ((int)$rev[$i]);
                }
                if ($sum % 11 < 2) {
                    if ($sum % 11 === (int)$rev[0]) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    if (11 - ($sum % 11) === (int)$rev[0]) {
                        return true;
                    } else {
                        return false;
                    }
                }

            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function isPhoneNum(string $phoneNum): bool
    {
        if (preg_match("/((09)|(\+989))\d{9}/", $phoneNum)) {
            return true;
        } else {
            return false;
        }
    }

    public function isEmail(string $email): bool
    {
        if (preg_match("/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/", $email)) {
            return true;
        } else {
            return false;
        }
    }

    public function isNumber(string $number): bool
    {
        if (preg_match("/^\d+$/", $number)) {
            return true;
        } else {
            return false;
        }
    }

    public function isAlphabet(string $alphabet): bool
    {
        if (preg_match("/^[a-zA-Z]+$/", $alphabet)) {
            return true;
        } else {
            return false;
        }
    }

    public function isAlphanum(string $alphanum): bool
    {
        if (preg_match("/^(?=.*[a-zA-Z])(?=.*[0-9])[A-Za-z0-9]+$/", $alphanum)) {
            return true;
        } else {
            return false;
        }
    }
    public function checkLength(string $string, int $lenth): bool
    {
        if (strlen($string) == $lenth) {
            return true;
        } else {
            return false;
        }
    }
}
