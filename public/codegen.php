f<?php

$tableParam = @$_REQUEST['table'];

$write = array(
    'domain' => TRUE,
    'accessor' => TRUE,
    'factory' => TRUE,
    'update' => TRUE,
    'selection' => TRUE,
    'selector' => TRUE,
);


define('NEWLINE', "\r\n");
define('TAB', "    ");
$database = "svenskbrf";
$db = mysql_connect("localhost", "root", "root");
mysql_select_db($database, $db);

$tableNames = array();
foreach (get_results("show tables", $db) as $table) {
    $tableNames[$table["Tables_in_$database"]] = array();
}

mysql_select_db("information_schema", $db);
foreach (array_keys($tableNames) as $t) {
    $tableNames[$t]['refs'] = get_results("SELECT 
                REFERENCED_TABLE_NAME,
                REFERENCED_COLUMN_NAME,
                TABLE_NAME,
                COLUMN_NAME 
        FROM KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = '$database' AND REFERENCED_TABLE_NAME = '$t';", $db);
}
foreach (array_keys($tableNames) as $t) {
    $tableNames[$t]['fks'] = get_results("SELECT 
                #TABLE_NAME
                #COLUMN_NAME,
                #TABLE_NAME,
                #COLUMN_NAME 
            *
        FROM KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = '$database' AND TABLE_NAME = '$t';", $db);
}


mysql_select_db($database);
foreach (array_keys($tableNames) as $t) {
    $tableNames[$t]['cols'] = get_results("DESCRIBE `$t`", $db);
}


$fileAccessors = $fileSelectors = $fileMain = $mainInitFunction = NULL;

if (!$tableParam) {
$fileAccessors  = fopen("./../include/accessor_getters.php", "w");
fwrite($fileAccessors, "<?php".NEWLINE.NEWLINE);
$fileSelectors = fopen("./../include/selector_getters.php", "w");
fwrite($fileSelectors, "<?php".NEWLINE.NEWLINE);


     // create SvenskBRF main class
    $fileMain = fopen("./../application/SvenskBRF/Main.php", "w");
    $s = "<?php".NEWLINE.NEWLINE."abstract class SvenskBRF_Main".NEWLINE.
            "{".NEWLINE
            ;//"}".NEWLINE;
            fwrite($fileMain, $s);
$s="";
$mainInitFunction = TAB."static function init()".NEWLINE.TAB."{".NEWLINE;
}
foreach ($tableNames as $tableName => $tableDef) {
    // create domain file
    if ($tableParam && !in_array($tableName, array($tableParam))) {
        continue;
    }
    echo "";
    $className = get_class_name($tableName);
    $tabs = 1;
    if(!$tableParam) {
        $s = phpdoc_variable_ret($fileMain, $tabs, "The $tableName accessor", "Accessor_".$className);
        $s .= TAB."protected static \$_o".ucfirst($className)."Accessor;".NEWLINE.NEWLINE;
        fwrite($fileMain, $s);
        $mainInitFunction .= TAB.TAB."//AccessorRepository::getInstance()->setAccessor('$tableName', new Accessor_".ucfirst($className)."());".NEWLINE.
                            TAB.TAB."self::\$_o".ucfirst($className)."Accessor = AccessorRepository::getInstance()->getAccessor('$tableName');".NEWLINE.

                            TAB.TAB."SelectorRepository::getInstance()->setSelector('$tableName', new Selector_".ucfirst($className)."Selector('$tableName'));".NEWLINE.
                            TAB.TAB."self::\$_o".ucfirst($className)."Selector = SelectorRepository::getInstance()->getSelector('$tableName');".NEWLINE.

                            TAB.TAB."ObjectFactoryRepository::getInstance()->setObjectFactory('$tableName', new DomainFactory_".ucfirst($className)."Factory());".NEWLINE.
                            TAB.TAB."self::\$_o".ucfirst($className)."Factory = ObjectFactoryRepository::getInstance()->getObjectFactory('$tableName');".NEWLINE;
        $s = phpdoc_variable_ret($fileMain, $tabs, "The $tableName selector", "Selector_".$className.'Selector');
        $s .= TAB."protected static \$_o".ucfirst($className)."Selector;".NEWLINE.NEWLINE;
        fwrite($fileMain, $s);
        $s = phpdoc_variable_ret($fileMain, $tabs, "The $tableName factory", "DomainFactory_".$className);
        $s .= TAB."protected static \$_o".ucfirst($className)."Factory;".NEWLINE.NEWLINE;
        fwrite($fileMain, $s);
    }
    
    
    if ($write['domain'] || true) {
        $fileName = "./../application/Domain/$className".".php";
        $file_exists = file_exists($fileName);
        $file_exists = FALSE;
        
        require_once "./../application/Domain/DomainObject.php";
        $refClass = NULL;
        if ($file_exists) {
            require_once "./../application/Domain/$className".".php";
            $refClass = new ReflectionClass($className);
        }

        $file = fopen($fileName, $file_exists ? 'c+' : 'w');

        $s = 
            "<?php".NEWLINE.
            NEWLINE.

            // php doc
            "/**".NEWLINE.
            " * Domain object class for $className. ".NEWLINE.
            " *".NEWLINE.
            " * @see DomainObject".NEWLINE.
            " * @package JJ_OrderSystem".NEWLINE.
            " * @subpackage Domain".NEWLINE.
            " */".NEWLINE.
            "class $className extends DomainObject " . NEWLINE . "{" . NEWLINE;
        if ($file_exists && $write['domain']) {
            fseek($file, strlen($s));
        } else if ($write['domain']) {
            fwrite($file, $s);
        }
        $methods = array();
        $unique = array();
        $nullValues = array();


        // write properties
        foreach ($tableDef['cols'] as $result) {
            if ($result['Field'] === 'id') {
                continue;
            }

            $nullValues[$result['Field']] = @$result['Null'] === 'YES';
            $nullValues[ucfirst(get_class_name($result['Field']))] = @$result['Null'] === 'YES';
            $methods[$result['Field']] = $result['Type'];
            $unique[$result['Field']] = array_key_exists("Key", $result) && preg_match("/UNI/", $result['Key']);

             // write php doc
            $s = 
            TAB."/**".NEWLINE.
            TAB." * $className's '" . $result['Field'] ."' property. ".NEWLINE.
            TAB." *".NEWLINE.
            TAB." * @var ". get_type($result['Type']).NEWLINE.
            TAB." */".NEWLINE.
            TAB."private \$".  "_".  get_variable_prefix($result['Type']) . get_class_name($result['Field']).";".
            NEWLINE.NEWLINE;
            try {
                if ($write['domain']) {
                    if ($refClass && $refClass->getProperty("_".  get_variable_prefix($result['Type']) . get_class_name($result['Field']))) {
                        // this is when the file exists and the property exists
                        fseek($file, strlen($s), SEEK_CUR);
                        continue;
                    } else {
                        // this is when the file doesn't exist
                        throw new ReflectionException("");
                    }
                }
            } catch (ReflectionException $re) {

                $fp = ftell($file);
                $rest = fread($file, 100000);
                fseek($file, $fp);
                fwrite($file, $s . $rest);
                fseek($file, $fp + strlen($s));
            }

            $methods[$result['Field']] = $result['Type'];
            $unique[$result['Field']] = array_key_exists("Key", $result) && preg_match("/UNI/", $result['Key']);
        }

        // write property get/set
        $_mp = array();
        foreach ($methods as $fieldName => $fieldType) {
            $_mp[$fieldName] = $fieldType; 
            //continue;
            // write get and set methods
            // write php doc - GET
            $s = 
            TAB."/**".NEWLINE.
            TAB." * Get $className's '" . $fieldName ."' property. ".NEWLINE.
            TAB." *".NEWLINE.
            TAB." * @return ". get_type($fieldType).($nullValues[$fieldName]?'|null':'').NEWLINE.
            TAB." */".NEWLINE.

            TAB."function get".get_class_name($fieldName)."()".NEWLINE.TAB."{".NEWLINE;
            if (!$nullValues[$fieldName] && $fieldType != 'timestamp') {
                $s .= TAB.TAB."return (".get_type($fieldType).") \$this->_".get_variable_prefix($fieldType).get_class_name($fieldName).";".NEWLINE;
            } else if ($nullValues[$fieldName]) {
                $s .= TAB.TAB."return is_null(\$this->_".get_variable_prefix($fieldType).get_class_name($fieldName).") ? NULL : (" . get_type($fieldType) .") " . "\$this->_".get_variable_prefix($fieldType).get_class_name($fieldName).";".NEWLINE;
            } else {
                $s .= TAB.TAB."return strlen(\$this->_".get_variable_prefix($fieldType).get_class_name($fieldName).") ? (".get_type($fieldType).") \$this->_".get_variable_prefix($fieldType).get_class_name($fieldName)." : NULL;".NEWLINE;
            }
            $s .= TAB."}".NEWLINE.
            NEWLINE.
            TAB."/**".NEWLINE.
            TAB." * Set $className's '" . $fieldName ."' property. ".NEWLINE.
            TAB." *".NEWLINE.
            TAB." * @param ". get_type($fieldType). ($nullValues[$fieldName]?'|null':'') . " \$a_".get_variable_prefix($fieldType).  get_class_name($fieldName). NEWLINE.
            TAB." * @return void".NEWLINE;
            /*
             *         if (DomainWatcher::exists(get_class($this), $this->getId())) {
                            $mCompareValue = is_null($a_iProductExportLogId) ? NULL : ((int) $a_iProductExportLogId);
                            if ($this->_iProductExportLogId !== $mCompareValue) {
                                $this->_markModified();
                            }
                        }
             * 
             */
            $s .= TAB." */".NEWLINE.
            TAB."function set".get_class_name($fieldName)."(\$a_".  get_variable_prefix($fieldType).  get_class_name($fieldName).")".NEWLINE.TAB."{".NEWLINE;
            if (!$nullValues[$fieldName]) {
                $s .= TAB.TAB."if (!is_null(\$this->_".get_variable_prefix($fieldType).get_class_name($fieldName).") && \$this->_".get_variable_prefix($fieldType).get_class_name($fieldName) ." !== (".get_type($fieldType).") \$a_" . get_variable_prefix($fieldType).get_class_name($fieldName) . ") {".NEWLINE.
                TAB.TAB.TAB."\$this->_markModified();".NEWLINE.TAB.TAB."}".NEWLINE.
                TAB.TAB."\$this->_".get_variable_prefix($fieldType).get_class_name($fieldName)." = (".get_type($fieldType).") \$a_".get_variable_prefix($fieldType).get_class_name($fieldName).";".NEWLINE.TAB."}".NEWLINE;
            } else {
                $s .= TAB.TAB."if (DomainWatcher::exists(get_class(\$this), \$this->getId())) {".NEWLINE;
                $s .= TAB.TAB.TAB."\$mCompareValue = " . "is_null(\$a_".get_variable_prefix($fieldType).get_class_name($fieldName).") ? NULL : ((".get_type($fieldType).") \$a_".get_variable_prefix($fieldType).get_class_name($fieldName) .");".NEWLINE;
                $s .= TAB.TAB.TAB."if (\$mCompareValue !== \$this->_".get_variable_prefix($fieldType).get_class_name($fieldName).") {".NEWLINE;
                $s .= TAB.TAB.TAB.TAB."\$this->_markModified();".NEWLINE.TAB.TAB.TAB."}".NEWLINE
                        //.TAB.TAB.TAB."}".NEWLINE
                        .TAB.TAB."}".NEWLINE.
                //.TAB.TAB.NEWLINE.
                TAB.TAB."\$this->_".get_variable_prefix($fieldType).get_class_name($fieldName)." = is_null(\$a_".get_variable_prefix($fieldType).get_class_name($fieldName).") ? NULL : (".get_type($fieldType).") \$a_".get_variable_prefix($fieldType).get_class_name($fieldName).";".NEWLINE.TAB."}".NEWLINE;
            }
            $s .= NEWLINE;

            $name = $fieldName;
            $m = $fieldType;
            $plog = false;
            $by = false;
            
            if (is_array($tableDef['fks'])) {
                foreach ($tableDef['fks'] as $fkdef) {
                    if ($fkdef['REFERENCED_TABLE_NAME'] && $fkdef['REFERENCED_TABLE_NAME'] != $fkdef['TABLE_NAME'] && $fkdef['COLUMN_NAME'] == $name && $fkdef['CONSTRAINT_NAME']) {
            
                        $tabs = 1;
                        //$name = $fieldName;
                        //$m = $fieldType;
                        if ($plog) {
                            continue;
                        }
                        if ($tableName == 'president_log_comment' && $name == 'president_log_id') {
                            $plog = TRUE;
                        }
                        
                        if ($by) {
                            continue;
                        }
                        if ($tableName == 'president_log_comment' && $name == 'by_user_id') {
                            $by = TRUE;
                        }
                        
                        $s .= phpdoc_variable_ret($file, $tabs, "The "  .get_class_name(str_replace('_id', '', $name)) .".", get_class_name(str_replace('_id', '', $name))) ;
                        $s .= TAB . "private \$_o" . get_class_name(str_replace('_id', '', $name)) . ';'.NEWLINE.NEWLINE;

                        $s .= phpdoc_function_ret($file, $tabs, "".get_class_name(str_replace('_id', '', $name)), "Get the " . get_class_name(str_replace('_id', '', $name)).".");
                        
                        $s .= TAB."function get" . ucfirst(substr(get_class_name($name), 0, strlen(get_class_name($name)) - 2))."()" .NEWLINE. 
                                TAB."{".NEWLINE.
                                TAB.TAB."return \$this->_o" . "" . ucfirst(substr(get_class_name($name), 0, strlen(get_class_name($name)) - 2)) . ";".NEWLINE.// = \$a_o" . ucfirst(substr(get_class_name($name), 0, strlen(get_class_name($name)) - 2)) . '->getId();'.NEWLINE.
                                TAB."}".NEWLINE.NEWLINE;
                        //fwrite($file, $s);
                        
                        $s .= phpdoc_function_ret($file, $tabs, "void", "Set the " . get_class_name(str_replace('_id', '', $name)). ".", array(array(ucfirst(substr(get_class_name($name), 0, strlen(get_class_name($name)) - 2))."", "\$a_o".ucfirst(substr(get_class_name($name), 0, strlen(get_class_name($name)) - 2)))));
                        $s .= TAB."function set" . ucfirst(substr(get_class_name($name), 0, strlen(get_class_name($name)) - 2))."(\$a_o" . ucfirst(substr(get_class_name($name), 0, strlen(get_class_name($name)) - 2)) . ")" .NEWLINE. 
                                TAB."{".NEWLINE.
                                TAB.TAB."\$this->_" . get_variable_prefix($m) . ucfirst(substr(get_class_name($name), 0, strlen(get_class_name($name)) - 0)) . " = \$a_o" . ucfirst(substr(get_class_name($name), 0, strlen(get_class_name($name)) - 2)) . '->getId();'.NEWLINE.
                                TAB.TAB."\$this->_o" . ucfirst(substr(get_class_name($name), 0, strlen(get_class_name($name)) - 2)) . " = \$a_o"  . ucfirst(substr(get_class_name($name), 0, strlen(get_class_name($name)) - 2)).";".NEWLINE.
                                TAB."}".NEWLINE.NEWLINE;
                        
               
            }}}
            /*
             * 
             *  function setEmail($a_sEmail)
                {
                    if ($this->_sEmail !== (is_null($a_sEmail) ? NULL : (string) $a_sEmail)) {
                        $this->_markModified();
                    }
                    $this->_sEmail = is_null($a_sEmail) ? NULL : (string) $a_sEmail;
                }
             * 
             */
            
            
            try {
                if ($write['domain']) {
                    if ($refClass && $refClass->getMethod("get".get_class_name($fieldName))) {
                        $fp = ftell($file);
                        fseek($file, $fp);
                        fseek($file, strlen($s), SEEK_CUR);
                        continue;
                    } else {
                        throw new ReflectionException("");
                    }
                }
            } catch (ReflectionException $re) {
                $fp = ftell($file);
                $rest = fread($file, 100000);
                fseek($file, $fp);
                fwrite($file, $s . $rest);
            }



        }

        // write manager access and collection access
        $tabs = 1;
        $nc = 0;
        $nc2 = 0;
        // linkes tables
        foreach ($tableDef['refs'] as $tableRef) {
            //continue;
            $joined_table = $tableRef['TABLE_NAME'];

            $s = "";

            $joinedTableVariable = "\$_o".get_class_name($joined_table)."Collection";
            if (($tableName == "user" && $joinedTableVariable == "\$_oNoticeCollection")) {
                $nc++;
            }
            if ($tableName == 'president_log' && $joinedTableVariable == "\$_oPresidentLogCommentCollection") {
                $nc2++;
            }
            if ($nc >= 2) {
                continue;
            }
            if ($nc2 >= 2 ) {
                continue;
            }
            
            if ($joinedTableVariable === "\$_oPresidentLogCommentCollection") {
                echo "";
            }

            $s .= phpdoc_variable_ret($file, $tabs, "This " . $className . "'s " . get_class_name($joined_table) . " collection.", "Collection");
            $s .= TAB."private $joinedTableVariable;".NEWLINE.NEWLINE;
            $joinedTable = "\$this->_".substr($joinedTableVariable, 2);
            $s .= phpdoc_function_ret($file, $tabs, "Collection", "Get " . get_class_name($joined_table) . " collection.", array(), array(get_class_name($joined_table)));
            $s .=  
                TAB."function get".substr($joinedTableVariable, 3)."()".NEWLINE.TAB."{".NEWLINE.TAB.TAB."if (!isset($joinedTable)) {".NEWLINE.TAB.TAB.TAB.
                "$joinedTable = new Collection();".NEWLINE
                .
                TAB.TAB."}".NEWLINE .
                TAB.TAB."return $joinedTable;" .NEWLINE.
                TAB."}".NEWLINE.NEWLINE;
            ;

            try {
                if ($write['domain']){
                    if ($refClass && $refClass->getProperty("_o".get_class_name($joined_table)."Collection")) {
                        fseek($file, strlen($s), SEEK_CUR);
                        continue;
                    } else {
                        throw new ReflectionException("");
                    }
                }
            } catch (ReflectionException $re) {
                $fp = ftell($file);
                $rest = fread($file, 100000);
                fseek($file, $fp);
                fwrite($file, $s . $rest);
            }


        }

        
            // write the create method
            $s = NEWLINE.NEWLINE. 
                    TAB."public static function create(";
            $_args = array();
            foreach ($_mp as $fieldName => $fieldType) {
                $_args[] = "\$a_" . get_variable_prefix($fieldType) . ucfirst(get_class_name($fieldName));
            }
            $s .= implode(", ", $_args);
            $s .= ", \$a_bInstantCreation = FALSE)".NEWLINE;
            
            $s.=
                    TAB."{".NEWLINE;
            
            // set the args
            // create phpdoc too preferably
            $t=2;
            $s .= tabs($t)."\$oMethod = new ReflectionMethod(__METHOD__);".NEWLINE;
            $s .= tabs($t)."\$aData = array();".NEWLINE;
            $s .= tabs($t++)."foreach (\$oMethod->getParameters() as \$oMethodParameter) {".NEWLINE.
                    tabs($t++)."if (!\$oMethodParameter->isDefaultValueAvailable()) {".NEWLINE.
                    tabs($t--)."\$aData[substr(\$oMethodParameter->name, 3)] = \${\$oMethodParameter->name};".NEWLINE.
                    tabs($t--)."}".NEWLINE.
                    tabs($t)."}".NEWLINE.
                    tabs($t)."\$oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('$tableName')->createDomainObject(\$aData);".NEWLINE.
                    tabs($t++)."if (\$a_bInstantCreation) {".NEWLINE.
                    tabs($t--)."AccessorRepository::getInstance()->getAccessor('$tableName')->write(\$oObject);".NEWLINE.
                    tabs($t)."}".NEWLINE.
                    tabs($t--)."return \$oObject;".NEWLINE.
                    tabs($t)."}".NEWLINE.NEWLINE;
                    
            
            echo $s;
            fwrite($file, $s);
        
        
        // close domain object class
        if (!$file_exists && $write['domain']) fwrite($file, "}".NEWLINE);
        fclose($file);
    }
    
    

    
    #continue;
    
    
    if ($write['accessor']) {
        $refClass = NULL;
        $fileName = "./../application/Infrastructure/Accessor/" . $className . ".php";
        $file_exists = file_exists($fileName);
        $file_exists = FALSE;
        try {
            if ($file_exists) {
                require_once './../application/Infrastructure/Accessor.php';
                require_once $fileName;
                $refClass = new ReflectionClass("Accessor_$className");
            }
        } catch (ReflectionException $re) {}


        // generate manager class
        // OBS: när man själv genererar accessorn? då ska man inte skriva den, utan den ska ligga sist i klassen.
        // liksom övriga metoder?
        // man lägger alltså de nya metoderna sist i klassen hela tiden.
        // på så vis man kan bara skriva $rest på slutet.



        $file = fopen($fileName, $file_exists ? 'c+' : 'w');


        $s = "<?php". NEWLINE.NEWLINE.
        "/**".NEWLINE.
        " * Database accessor class for $className. ".NEWLINE.
        " *".NEWLINE.
        " * @see Accessor ".NEWLINE.
        " * @see $className".NEWLINE.
        " * @package JJIT_OrderSystem".NEWLINE.
        " * @subpackage Database_Accessor".NEWLINE.
        " */".NEWLINE.
        "class Accessor_" . $className . " extends Accessor".NEWLINE."{".NEWLINE;

        if (!$file_exists) {
            fwrite($file, $s);
        } else {
            fseek($file, strlen($s), SEEK_CUR);
        }



        // acessor methods
        foreach ($methods as $fieldName => $fieldType) {
            //continue;
            $uniqueField = $unique[$fieldName];
            $methodName = ($uniqueField ? ("get".($className)) : ("get".($className).'s')) ."By".get_class_name($fieldName);
            $returnType = $uniqueField ? $className : "Collection_{$className}Collection";
            $extra = $uniqueField ? "": "s";

            
            
            
             // write php doc - SET
            $s = TAB."/**".NEWLINE.
            TAB." * Get $className{$extra} by '" . $fieldName ."' property. ".NEWLINE.
            TAB." *".NEWLINE.
            TAB." * @param ". get_type($fieldType)." \$a_".get_variable_prefix($fieldType).  get_class_name($fieldName).NEWLINE.
            TAB." * @return Collection".NEWLINE.
            TAB." */".NEWLINE.
            TAB."function $methodName" . "(\$a_".get_variable_prefix($fieldType).get_class_name($fieldName).")".NEWLINE.
            TAB."{".NEWLINE;
            $varp = get_variable_prefix($fieldType);
            $fname = get_class_name($fieldName);
            $fieldNameClass = get_class_name($fieldName);
            $methodBody = TAB.TAB."\$o{$className}Selector = get{$className}Selector();".NEWLINE.
            TAB.TAB."\$o{$className}Selector->set$fieldNameClass(\$a_{$varp}{$fname});".NEWLINE.
            TAB.TAB."return \$this->readOne(\$o{$className}Selector);".NEWLINE;

            $methodBodyNONUNIQUE = TAB.TAB."\$o{$className}Selector = get{$className}Selector();".NEWLINE.
                                   TAB.TAB. "\$o{$className}Selector->set$fieldNameClass(\$a_{$varp}{$fname});".NEWLINE.
                                    TAB.TAB."\$o{$className}Collection = \$this->read(\$o{$className}Selector);".NEWLINE.
                                    TAB.TAB."return \$o{$className}Collection;".NEWLINE;


            $s .= $uniqueField ? $methodBody : $methodBodyNONUNIQUE;
            $s .= NEWLINE;
            $s .= TAB."}".NEWLINE.NEWLINE;

            try {
                if ($file_exists && $refClass->getMethod($methodName)) {

                    $fp = ftell($file);
                    $rest = fread($file, 1000000);
                    //var_dump($rest);
                    //echo "<hr />";
                    fseek($file, $fp);
                    fseek($file, strlen($s), SEEK_CUR);

                    continue;
                } else {
                    throw new ReflectionException("");
                }
            } catch (ReflectionException $re) {
                // no method, create it
                $fp = ftell($file);
                $rest = fread($file, 1000000);
                //var_dump($rest);
                fseek($file, $fp);
                fwrite($file, NEWLINE.NEWLINE.$s . $rest);
                fseek($file, $fp + strlen($s));
            }
        }
        
        
        
        
         // write createNew method
        $tabs = 1;
        
        //print_r($tableDef['fks']);
        $paramsTemp = array();
        $args = array();
        foreach ($methods as $name => $m) {
            if ($m === 'timestamp') {
                continue; // set automatically
            }
            if (is_array($tableDef['fks'])) {
                foreach ($tableDef['fks'] as $fkdef) {
                    if ($fkdef['REFERENCED_TABLE_NAME'] && $fkdef['REFERENCED_TABLE_NAME'] != $fkdef['TABLE_NAME'] && $fkdef['COLUMN_NAME'] == $name && $fkdef['CONSTRAINT_NAME']) {
                        // write
                        /*$tabs = 1;
                        
                        $s .= phpdoc_variable_ret($file, $tabs, "The "  .get_class_name(str_replace('_id', '', $name)) .".", get_class_name(str_replace('_id', '', $name))) ;
                        $s .= TAB . "private \$_o" . get_class_name(str_replace('_id', '', $name)) . ';'.NEWLINE.NEWLINE;

                        $s .= phpdoc_function_ret($file, $tabs, "".get_class_name(str_replace('_id', '', $name)), "Get the " . get_class_name(str_replace('_id', '', $name)).".");
                        
                        $s .= TAB."function get" . ucfirst(substr(get_class_name($name), 0, strlen(get_class_name($name)) - 2))."()" .NEWLINE. 
                                TAB."{".NEWLINE.
                                TAB.TAB."return \$this->_o" . "" . ucfirst(substr(get_class_name($name), 0, strlen(get_class_name($name)) - 2)) . ";".NEWLINE.// = \$a_o" . ucfirst(substr(get_class_name($name), 0, strlen(get_class_name($name)) - 2)) . '->getId();'.NEWLINE.
                                TAB."}".NEWLINE.NEWLINE;
                        //fwrite($file, $s);
                        
                        $s .= phpdoc_function_ret($file, $tabs, "void", "Set the " . get_class_name(str_replace('_id', '', $name)). ".", array(array(ucfirst(substr(get_class_name($name), 0, strlen(get_class_name($name)) - 2))."", "\$a_o".ucfirst(substr(get_class_name($name), 0, strlen(get_class_name($name)) - 2)))));
                        $s .= TAB."function set" . ucfirst(substr(get_class_name($name), 0, strlen(get_class_name($name)) - 2))."(\$a_o" . ucfirst(substr(get_class_name($name), 0, strlen(get_class_name($name)) - 2)) . ")" .NEWLINE. 
                                TAB."{".NEWLINE.
                                TAB.TAB."\$this->_" . get_variable_prefix($m) . ucfirst(substr(get_class_name($name), 0, strlen(get_class_name($name)) - 0)) . " = \$a_o" . ucfirst(substr(get_class_name($name), 0, strlen(get_class_name($name)) - 2)) . '->getId();'.NEWLINE.
                                TAB.TAB."\$this->_o" . ucfirst(substr(get_class_name($name), 0, strlen(get_class_name($name)) - 2)) . " = \$a_o"  . ucfirst(substr(get_class_name($name), 0, strlen(get_class_name($name)) - 2)).";".NEWLINE.
                                TAB."}".NEWLINE.NEWLINE;
                        */
                        //echo $s;
                    }
                }
            }
            
            $paramsTemp[] = array(get_type($m).($nullValues[$name]?"|null":""), "\$a_" . get_variable_prefix($m).get_class_name($name));
            $args[] = array("\$a_" . get_variable_prefix($m).get_class_name($name), $nullValues[$name] ? " = NULL":"");
        }
        $paramsRest = array();
        $params = array();
        foreach ($paramsTemp as $i => $par) {
            if ($args[$i][1]) {
                $paramsRest[] = $par;
            } else{
                $params[] = $par;
            }
        }
        foreach ($paramsRest as $par) {
            $params[] = $par;
        }
        
        
        $s .= NEWLINE.NEWLINE.phpdoc_function_ret($file, $tabs, $className, "Create a new $className.", $params);
        $s .= TAB."function createNew(";
        $restArgs = array();
        foreach ($args as $arg) {
            if ($arg[1]) {
                $restArgs[] = $arg; 
            } else {
                $s .= $arg[0] . ", ";
            }
        }
        if (!count($restArgs) && count($args)) {
            $s = substr($s, 0, strlen($s) - 2);
        } else if (count($restArgs)) {
            foreach ($restArgs as $arg) {
                $s .= $arg[0].$arg[1].", ";
            }
            $s = substr($s, 0, strlen($s) - 2);
        }
        $s .=")".NEWLINE.TAB."{".NEWLINE.TAB;
        $s.=TAB.
        "\$oReflectionMethod = new ReflectionMethod(__METHOD__);".NEWLINE.TAB.
        TAB."\$o".get_class_name($tableName)." = \$this->_oDomainObjectAssembler->createNew();".NEWLINE.TAB.
        TAB."foreach (\$oReflectionMethod->getParameters() as \$iParameterIndex => \$oMethodParameter) {".NEWLINE.TAB.
        TAB.TAB."if (\$iParameterIndex < func_num_args()) {".NEWLINE.TAB.
        TAB.TAB.TAB."\$o".get_class_name($tableName)."->{\"set\" . substr(\$oMethodParameter->getName(), 3)}(func_get_arg(\$iParameterIndex));".NEWLINE.TAB.
        TAB.TAB."} else {".NEWLINE.TAB.
        TAB.TAB.TAB."break;".NEWLINE.TAB.
        TAB.TAB."}".NEWLINE.TAB.
        TAB."}".NEWLINE.
        TAB.TAB."return \$o".get_class_name($tableName).";".NEWLINE.TAB.
        "}".NEWLINE.NEWLINE;
        
        // write method
        if ($file_exists) {
            // write method and rest
            $fp = ftell($file);
            $rest = fread($file, 100000);
            fseek($file, $fp);
            fwrite($file, $s);
            $fp = ftell($file);
            fwrite($file, $rest);
            fseek($file, $fp);
        }
        
        

        // write methods
        $tableRefsStr = "//array(new Accessor_Product(), array('linked_object', 'product_id', 'setProduct')), // gets product with product id
                //array(new Accessor_State(), array('linked_object', 'state_id', 'setState')), // gets product with product id
                //array(new Accessor_OrderRow(), array('dependent_objects', 'order_id', 'getOrderId')), // gets order rows by order id        
                //array(new Accessor_Order(), array('dependent_objects', 'customer_id', 'getCustomerId')), // gets orders customer id
                //array(new Accessor_ProductPackageVersionDefinition(), array('dependent_objects', 'product_package_version_id', 'getProductPackageVersionId')), // gets orders customer id";
        $tabs = 1;
        $init = NEWLINE.NEWLINE.phpdoc_function_ret($file, $tabs, "DomainObjectAssembler", "Initialize's this accessor's domain object assembler.").
        TAB."protected function _initializeDomainObjectAssembler()".NEWLINE.
        TAB."{".NEWLINE.
        TAB.TAB."return new DomainObjectAssembler(self::\$_rDatabaseConnection, '$tableName', '$className', new SelectionFactory_$className(), new DomainFactory_{$className}Factory(), new UpdateFactory_$className(), array(".NEWLINE.
        TAB.TAB.TAB."//array(new Accessor_Product(), array('linked_object', 'product_id', 'setProduct')), // gets product with product id".NEWLINE.
        TAB.TAB.TAB."//array(new Accessor_State(), array('linked_object', 'state_id', 'setState')), // gets product with product id".NEWLINE.
        TAB.TAB.TAB."//array(new Accessor_OrderRow(), array('dependent_objects', 'order_id', 'getOrderId')), // gets order rows by order id".NEWLINE.
        TAB.TAB.TAB."//array(new Accessor_Order(), array('dependent_objects', 'customer_id', 'getCustomerId')), // gets orders customer id".NEWLINE.
        TAB.TAB.TAB."//array(new Accessor_ProductPackageVersionDefinition(), array('dependent_objects', 'product_package_version_id', 'getProductPackageVersionId')), // gets orders customer id".NEWLINE.
        TAB.TAB."));".NEWLINE.
        TAB."}".NEWLINE.NEWLINE;
        

        $s=$init;
        if ($file_exists) {
            // if the file exists, just write what's left back to the class (this method already exists, redefined in this case)
            //fseek($file, strlen($s), SEEK_CUR);        
        } else {
            // create the init method if the file doesn't exist.
            fwrite($file, $s . NEWLINE);
        }

       
        
        if (!$file_exists) {
            fwrite($file, NEWLINE.NEWLINE."}".NEWLINE);
        }
        fclose($file);
    }
    
    
    if ($write['selector']) {
        // SELECTOR.PHP
        // generate selector class
        $fileName = "./../application/InfraStructure/Selector/{$className}Selector.php";
        $file_exists = file_exists($fileName);
        $file_exists = FALSE;
        $file = fopen("./../application/InfraStructure/Selector/{$className}Selector.php", $file_exists ? 'c+' : 'w');
        $s = "<?php". NEWLINE.NEWLINE.
        // php doc
        "/**".NEWLINE.
        " * Selector class for $className. ".NEWLINE.
        " *".NEWLINE.
        " * @see $className".NEWLINE.
        " * @see Selector".NEWLINE.
        " * @package JJ_OrderSystem".NEWLINE.
        " * @subpackage Selector".NEWLINE.
        " */".NEWLINE.

        "class Selector_" . $className . "Selector extends Selector ".NEWLINE."{".NEWLINE.
        NEWLINE;
        if (!$file_exists) {
            fwrite($file, $s);
        } else {
            fseek($file, strlen($s));
        }

        // write the same object properties as in the domain object, except...
        //set_include_path(get_include_path().PATH_SEPARATOR."./../application/Domain/");
        require_once './../application/Domain/'.'DomainObject'.'.php';
        require_once './../application/Domain/'.$className.'.php';
        $reflectionClass = new ReflectionClass($className);
        if ($file_exists) {
            require_once './../application/Infrastructure/Selector.php';
            require_once $fileName;
        }
        $refClass = $file_exists ? new ReflectionClass("Selector_$className" . "Selector") : NULL;
        $properties = array();
        foreach ($reflectionClass->getProperties() as $prop) {
            #$prop = new ReflectionProperty();
            if ($prop->getName() === '_iId') {
                continue;
            }
            $propName = $prop->getName();
            $dc = $prop->getDocComment();
            $match1 = preg_match_all("/\@var\s(int|float|bool|string).+/", $prop->getDocComment(), $match);
            if ($match1 && count($match)) {
                $properties[] = substr($prop->getName(), 2);
                $type = $match[1][0];
                if (in_array($type, array('int','string','bool', 'float'))) {
                    $s = NEWLINE.TAB.str_replace($className, $className." selector", $prop->getDocComment()).NEWLINE;
                    $properties['set'.substr($prop->getName(), 2)] = array("".$prop->getName(), $type);
                    $properties['get'.substr($prop->getName(), 2)] = array("".$prop->getName(), $type);

                    $s .= TAB."private \$" . $prop->getName().";".NEWLINE;

                    //exit;
                    if ($refClass && $refClass->hasProperty($prop->getName())) {
                        fseek($file, strlen($s), SEEK_CUR);
                    } else {
                        $fp = ftell($file);
                        $rest = fread($file, 1000000);
                        fseek($file, $fp);
                        fwrite($file, $s. $rest);
                    }
                }
            }
        }
        #print_r($properties);

        foreach ($reflectionClass->getMethods() as $method) {
            #$method = new ReflectionMethod();

            if (strpos($method->getDocComment(), "Collection") !== false
                    || strlen($method->getName())<4 || !in_array(substr($method->getName(),0,3), array('set','get'))
                    || $method->getName() === 'getId' || $method->getName() === 'setId') {
                continue;
            } else {
                if (!array_key_exists($method->getName(), $properties)) {
                    continue;
                }
            }

            $s = TAB.str_replace($className, $className." selector", $method->getDocComment()).NEWLINE;
            $params = $method->getParameters();
            $paramNames = array();

            $s .= TAB."function " . $method->getName() ."(";
            //TAB."function " . $method->getName() ."(";
            if (!empty($params)) {
                foreach ($params as $param) {
                    $paramNames[] = "\$".$param->name;
                }
                $s .= trim(implode(", ", $paramNames));
            }
            $s.= ")".NEWLINE.TAB."{".NEWLINE;
            //$write =true;
            if (count($paramNames)) {
                if (!in_array(substr($paramNames[0],3,1), array('f','s','i','b'))) {
                    continue;
                }

                if (!$nullValues[substr($method->getName(), 3)]) {
                    $s .= TAB.TAB."\$this->_".substr($paramNames[0], 3) . " = (" . $properties[$method->getName()][1].") " .$paramNames[0] .";".NEWLINE;
                    $s .= TAB.TAB."\$this->setSearchParameter('".substr(preg_replace('/([a-z])([A-Z])/e','"\\1"."_".strtolower("\\2")',substr($paramNames[0], 3)),2)."', \$this->_".substr($paramNames[0], 3).");".NEWLINE;
                } else {
                    // $this->_iOrderExportLogId = is_null($a_iOrderExportLogId) ? NULL : (int) $a_iOrderExportLogId;
                    //               $this->setSearchParameter('order_export_log_id', (int) $this->_iOrderExportLogId,                                                                                                                                   is_null($this->_iOrderExportLogId) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
                    $s .= TAB.TAB."\$this->_".substr($paramNames[0], 3) . " = is_null({$paramNames[0]}) ? NULL : (" . $properties[$method->getName()][1].") " .$paramNames[0] .";".NEWLINE;
                    $s .= TAB.TAB."\$this->setSearchParameter('".substr(preg_replace('/([a-z])([A-Z])/e','"\\1"."_".strtolower("\\2")',substr($paramNames[0], 3)),2)."', (". $properties[$method->getName()][1].") \$this->_".substr($paramNames[0], 3) . ", is_null(\$this->_".substr($paramNames[0], 3).") ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);".NEWLINE;
                }

            } else {

                if (!$nullValues[substr($method->getName(), 3)]) {
                    $s .= TAB.TAB."return (" . $properties[$method->getName()][1]. ") \$this->".$properties[$method->getName()][0].";".NEWLINE;
                } else {
                    $s .= TAB.TAB. "return is_null(\$this->".$properties[$method->getName()][0].") ? NULL : (" . $properties[$method->getName()][1]. ") \$this->".$properties[$method->getName()][0] . ";".NEWLINE;
                }
            }
            #print_r($properties);

            $s .= TAB."}".NEWLINE.NEWLINE;

            try {
                if ($refClass && $refClass->getMethod($method->getName())) {
                    fseek($file, strlen($s), SEEK_CUR);
                } else {
                    throw new ReflectionException("");

                }
            } catch (ReflectionException $e) {
                $fp = ftell($file);
                $rest = fread($file, 1000000);
                fseek($file, $fp);
                fwrite($file, $s.$rest);
            }
        }

        if (!$file_exists) {
            fwrite($file, "}".NEWLINE);
        }
        fclose($file);
    }
    
    
    
    if ($write['factory']) {
        // DOMAINFACTORY.PHP
        $file = fopen("./../application/InfraStructure/DomainFactory/" . $className . "Factory.php", 'w');
        fwrite($file, "<?php". NEWLINE.NEWLINE);
        // phpdoc

        fwrite($file, "/**".NEWLINE);
        fwrite($file, " * Object factory class for $className. ".NEWLINE);
        fwrite($file, " *".NEWLINE);
        fwrite($file, " * @see $className".NEWLINE);
        fwrite($file, " * @see DomainFactory".NEWLINE);
        fwrite($file, " * @package JJ_OrderSystem".NEWLINE);
        fwrite($file, " * @subpackage ObjectFactory".NEWLINE);
        fwrite($file, " */".NEWLINE);

        fwrite($file, "class DomainFactory_" . $className . "Factory extends DomainFactory".NEWLINE."{".NEWLINE);
        fwrite($file, TAB."/**".NEWLINE);
        fwrite($file, TAB." * Creates $className instance. ".NEWLINE);
        fwrite($file, TAB." *".NEWLINE);
        fwrite($file, TAB." * @param ". "array "."\$a_aRow ".NEWLINE);
        fwrite($file, TAB." * @return $className".NEWLINE);
        fwrite($file, TAB." */".NEWLINE);
        fwrite($file, TAB."function createDomainObject(array \$a_aRow = array())".NEWLINE.TAB."{".NEWLINE.TAB.TAB."return \$this->_createObject(\$a_aRow);".NEWLINE.TAB."}".NEWLINE);
        fwrite($file, "}".NEWLINE);
        fclose($file);
    }
    if ($write['update']) {
        // UPDATEFACTORY.PHP
        $file = fopen("./../application/InfraStructure/UpdateFactory/{$className}.php", 'w');
        $s = "<?php". NEWLINE.NEWLINE.
        // php doc
        "/**".NEWLINE.
        " * Update factory class for $className. ".NEWLINE.
        " *".NEWLINE.
        " * @see $className".NEWLINE.
        " * @see UpdateFactory".NEWLINE.
        " * @package JJ_OrderSystem".NEWLINE.
        " * @subpackage UpdateFactory".NEWLINE.
        " */".NEWLINE.
        "class UpdateFactory_$className extends UpdateFactory".NEWLINE."{".NEWLINE.
        TAB."function newUpdate(DomainObject \$a_oDomainObject)".NEWLINE.TAB."{".NEWLINE.
        TAB.TAB."\$aUpdate = array();".NEWLINE;
        fwrite($file, $s);
        foreach ($reflectionClass->getMethods() as $method) {
            #$method = new ReflectionMethod();

            if (strpos($method->getDocComment(), "Collection") !== false
                    || strlen($method->getName())<4 || !in_array(substr($method->getName(),0,3), array('set','get')) ||

                    !preg_match("/\@return\s(int|string|float|bool)/", $method->getDocComment())
                    ) {
                continue;
            }
            $sMethodName = $method->getName();
            if (strlen($sMethodName) > 3 && "set" != substr($sMethodName,0,3) && "getId" != $sMethodName) {
            //$aMethodsColumns[$sMethodName] = preg_replace("/([A-Z])/e", "'_'.strtolower(\\1)", $this->_getPropertyColumnMapping(substr($sMethodName, 3)));
            fwrite($file, TAB.TAB."\$aUpdate['". preg_replace("/([A-Z])/e", "'_'.strtolower('\\1')",lcfirst(substr($sMethodName, 3)))."'] = \$a_oDomainObject->$sMethodName();".NEWLINE);
            }
        }
        fwrite($file, TAB.TAB."return \$aUpdate;".NEWLINE);
        fwrite($file,TAB."}".NEWLINE."}".NEWLINE);
        fclose($file);
    }
    
    
    
    if ($write['selection']) {
        // create selection factories
        $file = fopen("./../application/Infrastructure/SelectionFactory/$className.php", "w");
        fwrite($file, "<?php".NEWLINE.NEWLINE);
        fwrite($file, "class SelectionFactory_$className extends SelectionFactory".NEWLINE."{".NEWLINE);
        fwrite($file, TAB."function _issueSelection(Selector \$a_oSelector)".NEWLINE.TAB."{".NEWLINE);
        fwrite($file,TAB.TAB."return parent::_newSelection(\$a_oSelector);".NEWLINE.TAB."}".NEWLINE."}".NEWLINE.NEWLINE);
        fclose($file);
    }
    
    
        // create files for getter functions
    $tabs = 0;
    if (!$tableParam) {
        phpdoc_function($fileAccessors, $tabs, "Accessor_$className", "Get a $tableName accessor");
        fwrite($fileAccessors, "function get".get_class_name($tableName)."Accessor()".NEWLINE);
        fwrite($fileAccessors,"{".NEWLINE);
        fwrite($fileAccessors,TAB."if (!AccessorRepository::getInstance()->hasAccessor('$tableName')) {".NEWLINE);
        fwrite($fileAccessors, TAB.TAB."AccessorRepository::getInstance()->setAccessor('$tableName', new Accessor_".  get_class_name($tableName)."());".NEWLINE);
        fwrite($fileAccessors, TAB."}".NEWLINE);
        fwrite($fileAccessors, TAB."return AccessorRepository::getInstance()->getAccessor('$tableName');".NEWLINE);
        fwrite($fileAccessors,"}".NEWLINE.NEWLINE);

        $tabs = 0;
        phpdoc_function($fileSelectors, $tabs, "Selector_$className".'Selector', "Get a $tableName selector");
        fwrite($fileSelectors, "function get".get_class_name($tableName)."Selector()".NEWLINE);
        fwrite($fileSelectors,"{".NEWLINE);
        fwrite($fileSelectors,TAB."return new Selector_".get_class_name($tableName)."Selector('$tableName');".NEWLINE);
        fwrite($fileSelectors,"}".NEWLINE.NEWLINE);
    }
    
    
   

}
if (!$tableParam) {
    fwrite($fileMain, $mainInitFunction.NEWLINE.TAB."}".NEWLINE);
    fwrite($fileMain, "}".NEWLINE);
    fclose($fileAccessors);
    fclose($fileSelectors);
}




































function get_results($query, $db) {
    $result = mysql_query($query);
    $rows = array();
    while (($row = mysql_fetch_assoc($result))) {
        $rows[] = $row;
    }
    
    
    return $rows;
}

function print_results($quuery, $db)
{
    print_r(get_results($quuery, $db));
}


function get_variable_prefix($type) {
    switch (get_type($type)) {
        case 'bool':
            return "b";
            break;
        case 'int':
            return "i";
            break;
        case 'float':
            return "f";
        default:
            return "s";
            break;
           
    }
}


function get_class_name($tableName) {
    return ucfirst(preg_replace("/_([a-z])/e", 'strtoupper("\\1")', $tableName));
}

function get_type($type) {
    if (preg_match("/tinyint\(1\)/", $type)) {
        return "bool";
    }
    if (preg_match("/int/", $type)) {
        return "int";
    } 
    if (preg_match("/float/", $type)) {
        return "float";
    } else{
        return "string";
    }
}

function phpdoc_function($file, &$tabs, $return, $description, array $parameters = array(), $see = array())
{
    $written = 0;
    $written += fwrite($file, tabs($tabs). "/**".NEWLINE);
    $written += fwrite($file, tabs($tabs). " * ". $description.NEWLINE);
    $written += fwrite($file, tabs($tabs). " * ".NEWLINE);
    if (count($see)) {
        foreach ($see as $s) {
            $written += fwrite($file, tabs($tabs) . " * " . "@see $s".NEWLINE);
        }
        $written += fwrite($file, tabs($tabs). " * ".NEWLINE);
    }
    if (count($parameters)) {
        foreach ($parameters as $p) {
            $written += fwrite($file, tabs($tabs) . " * " . "@param ". $p[0] . " " . $p[1].NEWLINE);
        }
        $written += fwrite($file, tabs($tabs) .  " * ".NEWLINE);
    }
    $written += fwrite($file, tabs($tabs). " * @return $return".NEWLINE);
    $written += fwrite($file, tabs($tabs). " */".NEWLINE);
    return $written;
}


function phpdoc_function_ret($file, &$tabs, $return, $description, array $parameters = array(), $see = array())
{
    $written = "";
    $written .= tabs($tabs). "/**".NEWLINE;
    $written .= tabs($tabs). " * ". $description.NEWLINE;
    $written .= tabs($tabs). " * ".NEWLINE;
    if (count($see)) {
        foreach ($see as $s) {
            $written .= tabs($tabs) . " * " . "@see $s".NEWLINE;
        }
        $written .= tabs($tabs). " * ".NEWLINE;
    }
    if (count($parameters)) {
        foreach ($parameters as $p) {
            $written .= tabs($tabs) . " * " . "@param ". $p[0] . " " . $p[1].NEWLINE;
        }
        $written .=  tabs($tabs) .  " * ".NEWLINE;
    }
    $written .= tabs($tabs). " * @return $return".NEWLINE;
    $written .= tabs($tabs). " */".NEWLINE;
    return $written;
}


function phpdoc_variable($file, &$tabs, $description, $type) {
    $written = 0;
    $written += fwrite($file, tabs($tabs). "/**".NEWLINE);
    $written += fwrite($file, tabs($tabs). " * ". $description.NEWLINE);
    $written += fwrite($file, tabs($tabs). " * ".NEWLINE);
    $written += fwrite($file, tabs($tabs). " * @var $type".NEWLINE);
    $written += fwrite($file, tabs($tabs). " */".NEWLINE);
    return $written;
}

function phpdoc_variable_ret($file, &$tabs, $description, $type) {
    $written = "";
    $written .= (tabs($tabs). "/**".NEWLINE);
    $written .= tabs($tabs). " * ". $description.NEWLINE;
    $written .= tabs($tabs). " * ".NEWLINE;
    $written .= tabs($tabs). " * @var $type".NEWLINE;
    $written .= tabs($tabs). " */".NEWLINE;
    return $written;
}

function tabs($tabs) {
    return str_repeat(TAB, $tabs);
}

mysql_close($db);
?>
