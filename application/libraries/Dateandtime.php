<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dateandtime {
    var $weekDayTH;
    var $weekDayShortTH;
    var $monthTH;
    var $monthShortTH;


    var $weekDayEN;
    var $weekDayShortEN;
    var $monthEN;
    var $monthShortEN;
    
    var $chineseZodiac;
    
    public function __construct() {
        $this->weekDayTH = array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
	$this->weekDayShortTH = array("อา","จ","อ","พ","พฤ","ศ","ส");
	$this->monthTH = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
	$this->monthShortTH = array("ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
	
	
	$this->weekDayEN = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
	$this->weekDayShortEN = array("SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT");
	$this->monthEN = array("January","February","March","April","May","June","July","August","September","October","November","December");
	$this->monthShortEN = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
        
        $this->chineseZodiac = array("ชวด", "ฉลู", "ขาล", "เถาะ", "มะโรง", "มะเส็ง", "มะเมีย", "มะแม", "วอก", "ระกา", "จอ", "กุล");
    }
    
    public function getDateList()
    {
        $data = array();
        for($i=1; $i<=31; $i++) array_push($data, $i);
        return $data;
    }
    
    public function getMonthList($l="en")
    {
        $data["en"] = $this->monthEN;
        $data["th"] = $this->monthTH;
        return $data[$l];
    }
    
    public function getYearList($s = 1900, $e = 2100, $t = "AD")
    {
        $data = array();
        if ($t=="BE") {
            $s = $s + 543;
            $e = $e + 543;
        }
        for($i=$s; $i<=$e; $i++) array_push($data, $i);
        return $data;
    }
    
    public function getWeekDay($i, $l="en") {
        $weekDay["en"] = $this->weekDayEN;
        $weekDay["th"] = $this->weekDayTH;
        return $weekDay[$l][$i];
    }
    
    public function getMonthName($i, $l="en") {
        $monthName["en"] = $this->monthEN;
        $monthName["th"] = $this->monthTH;
        return $monthName[$l][$i-1];
    }
    
    public function getMonthShortName($i, $l="en") {
        $monthName["en"] = $this->monthShortEN;
        $monthName["th"] = $this->monthShortTH;
        return $monthName[$l][$i-1];
    }
    
    public function AD2BE($i) {
        return $i+543;
    }
    
    public function getChineseZodiac($y) {
        $year = $this->AD2BE($y);
        return (((($year % 12) + 6) % 12)==0?12: ((($year % 12) + 6) % 12));
    }
    
    public function getChineseZodiacName($cz) {
        $czList = $this->chineseZodiac;
        return $czList[$cz-1];
    }
}
