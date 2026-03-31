<?php
// Your code here!
$pass="1234567890Admin";
echo "pass:".$pass."<br>";

    $pa1 = array('a', 'b', 'c', 'd', 'e',  'f',    'g',    'h',    'i',    'j',    'k',    'l',    'm',    'n',    'o',    'p',    'q',    'r',    's',    't',    'u',    'v',    'w',    'x',    'y',    'z',    'A',    'B',    'C',    'D',    'E',    'F',    'G',    'H',    'I',    'J',    'K',    'L',    'M',    'N',    'O',    'P',    'Q',    'R',    'S',    'T',    'U',    'V',    'W',    'X',    'Y',    'Z',    'ñ',    'Ñ');
    $pa2 = array('174', '175',  '176',  '177',  '178',  '179',  '180',  '181',  '182',  '183',  '184',  '185',  '186',  '187',  '188',  '189',  '190',  '191',  '192',  '193',  '194',  '195',  '196',  '197',  '198',  '199',  '142',  '143',  '144',  '145',  '146',  '147',  '148',  '149',  '150',  '151',  '152',  '153',  '154',  '155',  '156',  '157',  '158',  '159',  '160',  '161',  '162',  '163',  '164',  '165',  '166',  '167',  '318',  '286');

    $pa3 = array('0',   '1',    '2',    '3',    '4',    '5',    '6',    '7',    '8',    '9');
    $pa4 = array('[',   '#',    '^',    'æ',    '&',    ']',    '»',    '«',    '<',    '>');

    $pa5 = array('[',   '#',    '^',    'æ',    '&',    ']',    '»',    '«',    '<',    '>');
    $pa6 = array('125', '126',  '127',  '128',  '129',  '130',  '131',  '132',  '133',  '134');

    $pa10 = array('$',   '+',    '*',    '.',    '!',    '%',    '@',    '/',    '-',    '_',    '?',    '&',    '"',    '#',    '(',    ')',    '=',    '¡',    '¿',    '[',    ']',    '¬',    '{',    '}');
    $pa11 = array('113', '120',  '119',  '123',  '110',  '114',  '141',  '124',  '122',  '172',  '140',  '115',  '111',  '112',  '117',  '118',  '138',  '238',  '268',  '168',  '170',  '249',  '200',  '202');

    $pa7 = str_replace($pa3, $pa4, $pass);
    $pa8 = str_replace($pa5, $pa6, $pa7);

    $pa9 = str_replace($pa1, $pa2, $pa8);

    $pa12 = str_replace($pa10, $pa11, $pa9);

    $passf = $pa12;

    $cont = strlen($pass);

    if ($cont == 8) {
  $cam =substr($passf,3,3).substr($passf,9,3).substr($passf,15,3).substr($passf,21,3).substr($passf,18,3).substr($passf,12,3).substr($passf,6,3).substr($passf,0,3);
  //echo json_encode(array("message" => $cam));
}else{
if ($cont == 9) {
  $cam =substr($passf,3,3).substr($passf,9,3).substr($passf,15,3).substr($passf,21,3).substr($passf,24,3).substr($passf,18,3).substr($passf,12,3).substr($passf,6,3).substr($passf,0,3);
  //echo json_encode(array("message" => $cam));
  }else{
         if ($cont == 10) {
       $cam =substr($passf,3,3).substr($passf,9,3).substr($passf,15,3).substr($passf,21,3).substr($passf,27,3).substr($passf,24,3).substr($passf,18,3).substr($passf,12,3).substr($passf,6,3).substr($passf,0,3);
       //echo json_encode(array("message" => $cam));
       }else{
              if ($cont == 11) {
              $cam =substr($passf,3,3).substr($passf,9,3).substr($passf,15,3).substr($passf,21,3).substr($passf,27,3).substr($passf,30,3).substr($passf,24,3).substr($passf,18,3).substr($passf,12,3).substr($passf,6,3).substr($passf,0,3);
            //echo json_encode(array("message" => $cam));
            }else{
                   if ($cont == 12) {
                   $cam =substr($passf,3,3).substr($passf,9,3).substr($passf,15,3).substr($passf,21,3).substr($passf,27,3).substr($passf,33,3).substr($passf,30,3).substr($passf,24,3).substr($passf,18,3).substr($passf,12,3).substr($passf,6,3).substr($passf,0,3);
                 //echo json_encode(array("message" => $cam));
                 }else{
                        if ($cont == 13) {
                        $cam =substr($passf,3,3).substr($passf,9,3).substr($passf,15,3).substr($passf,21,3).substr($passf,27,3).substr($passf,33,3).substr($passf,36,3).substr($passf,30,3).substr($passf,24,3).substr($passf,18,3).substr($passf,12,3).substr($passf,6,3).substr($passf,0,3);
                      //echo json_encode(array("message" => $cam));
                      }else{
                             if ($cont == 14) {
                             $cam =substr($passf,3,3).substr($passf,9,3).substr($passf,15,3).substr($passf,21,3).substr($passf,27,3).substr($passf,33,3).substr($passf,39,3).substr($passf,36,3).substr($passf,30,3).substr($passf,24,3).substr($passf,18,3).substr($passf,12,3).substr($passf,6,3).substr($passf,0,3);
                           //echo json_encode(array("message" => $cam));
                           }else{
                                  if ($cont == 15) {
                                  $cam =substr($passf,3,3).substr($passf,9,3).substr($passf,15,3).substr($passf,21,3).substr($passf,27,3).substr($passf,33,3).substr($passf,39,3).substr($passf,42,3).substr($passf,36,3).substr($passf,30,3).substr($passf,24,3).substr($passf,18,3).substr($passf,12,3).substr($passf,6,3).substr($passf,0,3);
                                //echo json_encode(array("message" => $cam));
                                }else{
                                  if ($cont == 16) {
                                  $cam =substr($passf,3,3).substr($passf,9,3).substr($passf,15,3).substr($passf,21,3).substr($passf,27,3).substr($passf,33,3).substr($passf,39,3).substr($passf,45,3).substr($passf,42,3).substr($passf,36,3).substr($passf,30,3).substr($passf,24,3).substr($passf,18,3).substr($passf,12,3).substr($passf,6,3).substr($passf,0,3);
                                     //echo json_encode(array("message" => $cam));
                                  }else{
                                     if ($cont == 17) {
                                     $cam =substr($passf,3,3).substr($passf,9,3).substr($passf,15,3).substr($passf,21,3).substr($passf,27,3).substr($passf,33,3).substr($passf,39,3).substr($passf,45,3).substr($passf,48,3).substr($passf,42,3).substr($passf,36,3).substr($passf,30,3).substr($passf,24,3).substr($passf,18,3).substr($passf,12,3).substr($passf,6,3).substr($passf,0,3);
                                     //echo json_encode(array("message" => $cam));
                                     }else{
                                       if ($cont == 18) {
                                       $cam =substr($passf,3,3).substr($passf,9,3).substr($passf,15,3).substr($passf,21,3).substr($passf,27,3).substr($passf,33,3).substr($passf,39,3).substr($passf,45,3).substr($passf,51,3).substr($passf,48,3).substr($passf,42,3).substr($passf,36,3).substr($passf,30,3).substr($passf,24,3).substr($passf,18,3).substr($passf,12,3).substr($passf,6,3).substr($passf,0,3);
                                       //echo json_encode(array("message" => $cam));
                                       }else{
                                          if ($cont == 19) {
                                          $cam =substr($passf,3,3).substr($passf,9,3).substr($passf,15,3).substr($passf,21,3).substr($passf,27,3).substr($passf,33,3).substr($passf,39,3).substr($passf,45,3).substr($passf,51,3).substr($passf,54,3).substr($passf,48,3).substr($passf,42,3).substr($passf,36,3).substr($passf,30,3).substr($passf,24,3).substr($passf,18,3).substr($passf,12,3).substr($passf,6,3).substr($passf,0,3);
                                          //echo json_encode(array("message" => $cam));
                                          }else{
                                             if ($cont == 20) {
                                             $cam =substr($passf,3,3).substr($passf,9,3).substr($passf,15,3).substr($passf,21,3).substr($passf,27,3).substr($passf,33,3).substr($passf,39,3).substr($passf,45,3).substr($passf,51,3).substr($passf,57,3).substr($passf,54,3).substr($passf,48,3).substr($passf,42,3).substr($passf,36,3).substr($passf,30,3).substr($passf,24,3).substr($passf,18,3).substr($passf,12,3).substr($passf,6,3).substr($passf,0,3);
                                             //echo json_encode(array("message" => $cam));
                                             }else{
                                                if ($cont == 21) {
                                                $cam =substr($passf,3,3).substr($passf,9,3).substr($passf,15,3).substr($passf,21,3).substr($passf,27,3).substr($passf,33,3).substr($passf,39,3).substr($passf,45,3).substr($passf,51,3).substr($passf,57,3).substr($passf,60,3).substr($passf,54,3).substr($passf,48,3).substr($passf,42,3).substr($passf,36,3).substr($passf,30,3).substr($passf,24,3).substr($passf,18,3).substr($passf,12,3).substr($passf,6,3).substr($passf,0,3);
                                                //echo json_encode(array("message" => $cam));
                                                }else{
                                                   if ($cont == 22) {
                                                   $cam =substr($passf,3,3).substr($passf,9,3).substr($passf,15,3).substr($passf,21,3).substr($passf,27,3).substr($passf,33,3).substr($passf,39,3).substr($passf,45,3).substr($passf,51,3).substr($passf,57,3).substr($passf,63,3).substr($passf,60,3).substr($passf,54,3).substr($passf,48,3).substr($passf,42,3).substr($passf,36,3).substr($passf,30,3).substr($passf,24,3).substr($passf,18,3).substr($passf,12,3).substr($passf,6,3).substr($passf,0,3);
                                                   //echo json_encode(array("message" => $cam));
                                                   }else{
                                                      if ($cont == 23) {
                                                      $cam =substr($passf,3,3).substr($passf,9,3).substr($passf,15,3).substr($passf,21,3).substr($passf,27,3).substr($passf,33,3).substr($passf,39,3).substr($passf,45,3).substr($passf,51,3).substr($passf,57,3).substr($passf,63,3).substr($passf,66,3).substr($passf,60,3).substr($passf,54,3).substr($passf,48,3).substr($passf,42,3).substr($passf,36,3).substr($passf,30,3).substr($passf,24,3).substr($passf,18,3).substr($passf,12,3).substr($passf,6,3).substr($passf,0,3);
                                                      //echo json_encode(array("message" => $cam));
                                                      }else{
                                                         if ($cont == 24) {
                                                         $cam =substr($passf,3,3).substr($passf,9,3).substr($passf,15,3).substr($passf,21,3).substr($passf,27,3).substr($passf,33,3).substr($passf,39,3).substr($passf,45,3).substr($passf,51,3).substr($passf,57,3).substr($passf,63,3).substr($passf,69,3).substr($passf,66,3).substr($passf,60,3).substr($passf,54,3).substr($passf,48,3).substr($passf,42,3).substr($passf,36,3).substr($passf,30,3).substr($passf,24,3).substr($passf,18,3).substr($passf,12,3).substr($passf,6,3).substr($passf,0,3);
                                                         //echo json_encode(array("message" => $cam));
                                                         }else{
                                                           if ($cont == 25) {
                                                           $cam =substr($passf,3,3).substr($passf,9,3).substr($passf,15,3).substr($passf,21,3).substr($passf,27,3).substr($passf,33,3).substr($passf,39,3).substr($passf,45,3).substr($passf,51,3).substr($passf,57,3).substr($passf,63,3).substr($passf,69,3).substr($passf,72,3).substr($passf,66,3).substr($passf,60,3).substr($passf,54,3).substr($passf,48,3).substr($passf,42,3).substr($passf,36,3).substr($passf,30,3).substr($passf,24,3).substr($passf,18,3).substr($passf,12,3).substr($passf,6,3).substr($passf,0,3);
                                                           //echo json_encode(array("message" => $cam));
                                                           }else{
                                                              if ($cont == 26) {
                                                              $cam =substr($passf,3,3).substr($passf,9,3).substr($passf,15,3).substr($passf,21,3).substr($passf,27,3).substr($passf,33,3).substr($passf,39,3).substr($passf,45,3).substr($passf,51,3).substr($passf,57,3).substr($passf,63,3).substr($passf,69,3).substr($passf,75,3).substr($passf,72,3).substr($passf,66,3).substr($passf,60,3).substr($passf,54,3).substr($passf,48,3).substr($passf,42,3).substr($passf,36,3).substr($passf,30,3).substr($passf,24,3).substr($passf,18,3).substr($passf,12,3).substr($passf,6,3).substr($passf,0,3);
                                                              //echo json_encode(array("message" => $cam));
                                                              }else{
                                                                if ($cont == 27) {
                                                                $cam =substr($passf,3,3).substr($passf,9,3).substr($passf,15,3).substr($passf,21,3).substr($passf,27,3).substr($passf,33,3).substr($passf,39,3).substr($passf,45,3).substr($passf,51,3).substr($passf,57,3).substr($passf,63,3).substr($passf,69,3).substr($passf,75,3).substr($passf,78,3).substr($passf,72,3).substr($passf,66,3).substr($passf,60,3).substr($passf,54,3).substr($passf,48,3).substr($passf,42,3).substr($passf,36,3).substr($passf,30,3).substr($passf,24,3).substr($passf,18,3).substr($passf,12,3).substr($passf,6,3).substr($passf,0,3);
                                                                //echo json_encode(array("message" => $cam));
                                                                }else{
                                                                   if ($cont == 28) {
                                                                   $cam =substr($passf,3,3).substr($passf,9,3).substr($passf,15,3).substr($passf,21,3).substr($passf,27,3).substr($passf,33,3).substr($passf,39,3).substr($passf,45,3).substr($passf,51,3).substr($passf,57,3).substr($passf,63,3).substr($passf,69,3).substr($passf,75,3).substr($passf,81,3).substr($passf,78,3).substr($passf,72,3).substr($passf,66,3).substr($passf,60,3).substr($passf,54,3).substr($passf,48,3).substr($passf,42,3).substr($passf,36,3).substr($passf,30,3).substr($passf,24,3).substr($passf,18,3).substr($passf,12,3).substr($passf,6,3).substr($passf,0,3);
                                                                   //echo json_encode(array("message" => $cam));
                                                                   }else{
                                                                      if ($cont == 29) {
                                                                      $cam =substr($passf,3,3).substr($passf,9,3).substr($passf,15,3).substr($passf,21,3).substr($passf,27,3).substr($passf,33,3).substr($passf,39,3).substr($passf,45,3).substr($passf,51,3).substr($passf,57,3).substr($passf,63,3).substr($passf,69,3).substr($passf,75,3).substr($passf,81,3).substr($passf,84,3).substr($passf,78,3).substr($passf,72,3).substr($passf,66,3).substr($passf,60,3).substr($passf,54,3).substr($passf,48,3).substr($passf,42,3).substr($passf,36,3).substr($passf,30,3).substr($passf,24,3).substr($passf,18,3).substr($passf,12,3).substr($passf,6,3).substr($passf,0,3);
                                                                      //echo json_encode(array("message" => $cam));
                                                                      }else{
                                                                         if ($cont == 30) {
                                                                         $cam =substr($passf,3,3).substr($passf,9,3).substr($passf,15,3).substr($passf,21,3).substr($passf,27,3).substr($passf,33,3).substr($passf,39,3).substr($passf,45,3).substr($passf,51,3).substr($passf,57,3).substr($passf,63,3).substr($passf,69,3).substr($passf,75,3).substr($passf,81,3).substr($passf,87,3).substr($passf,84,3).substr($passf,78,3).substr($passf,72,3).substr($passf,66,3).substr($passf,60,3).substr($passf,54,3).substr($passf,48,3).substr($passf,42,3).substr($passf,36,3).substr($passf,30,3).substr($passf,24,3).substr($passf,18,3).substr($passf,12,3).substr($passf,6,3).substr($passf,0,3);
                                                                         //echo json_encode(array("message" => $cam));
                                                                         }else{
                                                                            if ($cont >30) {
                                                                         $cam =1;
                                                                         echo json_encode(array("message" => "la contraseña no debe tener mas de 30 caracteres"));
                                                                         }else{
                                                                               $cam =1;
                                                                         echo json_encode(array("message" => "la contraseña debe tener mas de 7 caracteres"));
                                                                         }
                                                                         }
                                                                      }
                                                                   }
                                                                }
                                                              }
                                                           }
                                                         }
                                                      }
                                                   }
                                                }
                                             }
                                          }
                                       }
                                     }
                                  }
                                }
                           }
                        }
                   }
              }
         }
    }
}

echo "<br>passf:".$passf;
echo "<br>cam:".$cam;

?>
