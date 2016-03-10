# ArrayToCsv

  $array = [['name'=>'baschet', 'firstname'=>'benjamin'],['name'=>'baschet', 'firstname'=>'benjamin']] ;
  $csv = new \Service\ArrayToCsv($array);
  $csv->setFilename('test.csv'); // file.csv by default if not defined
  $csv->download(); // to download the file
  $csv->getCsvData(); // output => name;firstname\nbaschet;benjamin\nbaschet;benjamin
