<?php
namespace Console;

use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Command extends SymfonyCommand
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function sortPolygons(InputInterface $input, OutputInterface $output)
    {        
        //getting file content...
        $filePath = $input->getArgument('file_path_to_JSON_file');
        $content = file_get_contents($filePath);

        //decoding json...
        $data = json_decode($content, false);        

        $arrPolygons = []; //an array of objects...
        $arrPolygonsVolume = []; //an array of polygon circumferences...

        foreach($data as $polygons)
        {            
             foreach($polygons as $polygon)
             {
                 array_push($arrPolygons, $polygon);                 
                 $arrX = [];
                 $arrY = [];                 
                 foreach($polygon as $points)
                 {                     
                     foreach($points as $point)
                     {
                        array_push($arrX, $point->x);
                        array_push($arrY, $point->y);                        
                     }                    
                 }    
                //calculating the circumference of the polygon...
                $volume = 0;
                $arrCoordinatesLength = sizeof($arrX);                     
                for($i = 0;$i < $arrCoordinatesLength; $i++)
                {                    
                    if(($i + 1) < $arrCoordinatesLength)
                    {
                        $volume += sqrt(pow($arrX[$i] - $arrX[$i + 1],2) + pow($arrY[$i] - $arrY[$i + 1],2)); //calculating one side of a polygon...                        
                    }
                }
                $volume += sqrt(pow($arrX[0]-$arrX[$arrCoordinatesLength-1],2) + pow($arrY[0]-$arrY[$arrCoordinatesLength-1],2)); //calculating last side of a polygon(last 2 points)...
                //insert the circumference of the polygon into an array...
                array_push($arrPolygonsVolume, $volume);                
             }
        }                   
        //sorting both arrays at the same time...
        for($i = 0; $i < sizeof($arrPolygonsVolume); $i++)
        {
            if(($i + 1) < sizeof($arrPolygonsVolume))
            {
                if($arrPolygonsVolume[$i] <= $arrPolygonsVolume[$i + 1])
                {                    
                    $temp = $arrPolygonsVolume[$i + 1];
                    $arrPolygonsVolume[$i + 1] = $arrPolygonsVolume[$i];
                    $arrPolygonsVolume[$i] = $temp;

                    $temp = $arrPolygons[$i + 1];
                    $arrPolygons[$i + 1] = $arrPolygons[$i];
                    $arrPolygons[$i] = $temp;
                }
            }
        }          
        //encoding to JSON...        
        unset($polygons);
        $polygons["poligoni"] = $arrPolygons;        
        $data = json_encode($polygons, JSON_PRETTY_PRINT);
        //saving results to file...        
        file_put_contents($filePath, $data);
    }
}
?>