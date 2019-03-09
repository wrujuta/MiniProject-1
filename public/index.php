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
       $records= csv::getRecords($filename);



       foreach($records as $record) {
          $array = $record->returnArray();
           $keys = array_keys($array);
          print_r($keys);
       }


    }
}

class csv{

    static public function getRecords($filename) {


        $file = fopen($filename, "r");
        $fieldNames = array();
        $count = 0;
        while (!feof($file)) {
            $record = (fgetcsv($file));
             if($count == 0) {
                 $fieldNames = $record;
             }
                 else{

                     $records[] = recordFactory::create($fieldNames, $record);
                 }

             $count++;

        }

        fclose($file);
        return $records;



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




