<?php
/**
 * Created by PhpStorm.
 * User: wrujuta
 * Date: 3/6/19
 * Time: 4:42 PM
 */
main::start("example.csv");

class main
{
    static public function start($filename)
    {
        $records = csv::data($filename);
        $tables = html::generatetable($records);
        system::printPage($tables);
    }
}
class csv{

    public static function createFile($filename)
    {
        $file = fopen($filename,"r");
        $fieldNames = array();
        $count = 0;
        while(! feof($file))
        {
            $record=fgetcsv($file);
            if($count==0)
            {
                $fieldNames = $record;
                $data[] = recordFactory::create($fieldNames, $fieldNames);
            }
            else
            {
                $data[] = recordFactory::create($fieldNames,$record);
            }
            $count++;
        }
        fclose($file);
        return $data;
    }
}




class record{

    public function __construct(Array $fieldNames = null, $values = null)
    {

        $record = array_combine($fieldNames, $values);

        foreach ($record as $property => $value) {

            $this->createProperty($property, $value);

        }


        print_r($this);






    }

    public function returnArray() {

        $array = (array) $this;
        return $array;
    }


    public function createProperty($name='policyID', $value='119736') {

        $this->{$name} = $value;


    }
}


class recordFactory{

    public static function create (Array $fieldNames = null, Array $values= null){



        $record = new record($fieldNames, $values);

        return $record;


    }


}




