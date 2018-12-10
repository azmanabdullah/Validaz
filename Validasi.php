<?php

   // @author Azman Abdullah
   

   class Validasi{
         protected $errors = [];
         private $errorOnly = [];
         private $pesanCostum = [];
         private $fileFormat = [];

         
         public function __construct()
         {
            echo "<style> .object{ text-transform:capitalize !important; } </style>";
            
         }
      
      public function open($inputName)
      {
         return $this->errorOnly[$inputName];
      }
         
      public function openCheck($inputName)
      {
         if(!empty($this->errorOnly[$inputName])):
            return true;
         else:
            return false;
         endif;
      }

      public static function inputValue($inputName)
      {
         return isset($_POST[$inputName]) ? $_POST[$inputName] : '';
      }
     
      public function hasErrors()
      {
         if(!empty($this->errors) || $this->errors != null){
            return true;
         }else{
            return false;
         }
      }

      

      // untuk menambahkan pesan error
      private function addError($error)
      {
         
         $this->errors[] = $error;
         
      }
      public function getErrors()
      {
         
         return $this->errors;
      }


      public function setPesan($index,$pesan)
      {  
         $index = explode('|',$index);
         $this->pesanCostum[$index[0]][$index[1]] = $pesan;
         
      }

      public function init($array = [])
      {
         
         
         
         foreach($array as $key => $val)
         {
            foreach($val as $keyVal => $valValue)
            {
               switch($keyVal)
               {
                  case 'angka':
                     if($valValue){                        
                        if(!empty($_POST[$key]))
                        {
                           $this->addError('<b class="object">'. $key.'</b>.'.' hanya boleh angka');
                        $this->errorOnly[$key] = '<b class="object">'. $key.'</b>'.' hanya boleh angka';
                        }
                     }
                  break;
                  case 'fileSize':
                     if($_FILES[$key]['size'] > $valValue ){
                        $this->addError('<b class="object">'.$key.'</b> '.'ukurannya terlalu besar');
                     $this->errorOnly[$key] = '<b class="object">'.$key.'</b> '.'ukurannya terlalu besar';
                     }
                  break;
                 case 'fileFormat':
                  if(explode('|',$valValue))
                  {
                     $this->fileFormat = explode('|',$valValue);
                  }else{
                     $this->fileFormat = $valValue;
                  }
                  
                  if(!in_array(strtolower(end(explode('.',$_FILES[$key]['name']))), $this->fileFormat))
                  {
                     $this->addError('<b class="object">'.$key.'</b> '.' Formatnya tidak disetujui, format yang disarankan <b>'.implode(' ',$this->fileFormat).'</b>');
                     $this->errorOnly[$key] = '<b class="object">'.$key.'</b> '.' Formatnya tidak disetujui, format yang disarankan <b>'.implode(' ',$this->fileFormat).'</b>';
                  }

                 break;
                  case 'wajib':
                     if($keyVal){
                        if(empty($_POST[$key]) || !trim($_POST[$key]) || $_FILES[$key]['error'] == 4):                        
                           if($this->pesanCostum['wajib']['true'] != null || !empty($this->pesanCostum['wajib']['true'])):
                              $this->addError('<b class="object">'.$key.'</b> '.$this->pesanCostum['wajib']['true']);
                              $this->errorOnly[$key] = '<b class="object">'.$key.'</b> '.$this->pesanCostum['wajib']['true'];
                           else:
                              $this->addError('<b class="object">'.$key.'</b>'.' wajib dimasukan');
                              $this->errorOnly[$key] = '<b class="object">'.$key.'</b>'.' wajib dimasukan';
                           endif;
                           
                        endif;
                     }
                  break;
                  case 'min':
                     if(!empty($_POST[$key])):
                        if(strlen($_POST[$key]) < $valValue):
                           $this->addError('<b class="object">'.$key.'</b>'. ' minimal '.$valValue. ' karakter');
                           $this->errorOnly[$key] = '<b class="object">'.$key.'</b>'. ' minimal '.$valValue. ' karakter';
                        endif;
                     endif;
                  break;
                  case 'format':
                     if($valValue == 'email'):
                        if(!empty($_POST[$key])):
                           if(stristr($_POST[$key],'@',false)):
                              $email = stristr($_POST[$key],'@',false);
                              if(stristr($email,'.',true) == false):
                                 if(!empty($this->pesanCostum['format']['email']) || $this->pesanCostum['format']['email'] != null):
                                    $this->addError($this->pesanCostum['format']['email']);
                                    $this->errorOnly[$key] = $this->pesanCostum['format']['email'];
                                 else:
                                    $this->errorOnly[$key] = '<b class="object">'. $key. '</b>'. ' bukan format email yang benar';
                                    $this->addError('<b class="object">'. $key. '</b>'. ' bukan format email yang benar' );
                                 endif;
                              endif;
                           else:
                          
                              if(!empty($this->pesanCostum['format']['email']) || $this->pesanCostum['format']['email'] != null):
                                 $this->addError($this->pesanCostum['format']['email']);
                                 $this->errorOnly[$key] = $this->pesanCostum['format']['email'];
                              else:
                                 $this->errorOnly[$key] = '<b class="object">'. $key. '</b>'. ' bukan format email yang benar';
                                 $this->addError('<b class="object">'. $key. '</b>'. ' bukan format email yang benar' );
                              endif;

                           endif;
                        endif; 
                     endif;
                  break;

               }
            }

         }
      }



   }


