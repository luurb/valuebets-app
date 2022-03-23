<?php

namespace feed\classes;

//Class for init scraping from URL address 
class ScraperInit
{
    public $addr; // full URL address of scraped webpage
    public function __construct($addr)
    {
        $this->addr = $addr;
    }

    //Function for initialize scraping.
    public function scrapeInit()
    {
        //Configure and execute cURL session
        $ch = curl_init($this->addr);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        //Create new DOMDocument
        $html = new \DOMDocument();
        @ $html->loadHTML($response);
                    
        //Return DOMNodeList
        $domnode_tbody = $html->getElementsByTagName('tbody');
        $tbody_children_lists = array();

        //Create DOMNodeList from every tbody tag and save that to array
        foreach ($domnode_tbody as $tbody) {
            $tbody_children_lists [] = $tbody->childNodes;
        }

        //Now create DOMNodeList of children for every tr tag. 
        //Tr tag is located in every tbody_children_list in item nr 2 (item(1)).
        $tr_children_lists = array();
        foreach ($tbody_children_lists as $child_list) {
            $tr_children_lists [] = $child_list->item(1)->childNodes;
        }
        
        return $tr_children_lists;
    }
}
