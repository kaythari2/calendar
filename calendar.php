<?php
class Calendar {
    private $dayLabels = array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");

    private $currentYear = 0;
    private $currentMonth = 0;
    private $currentDay = 0;
    private $currentDate = null;
    private $daysInMont = 0;
    private $naviHref = null;

    /**
     * Constructor
     */
    // public function __construct(){     
    //     $this->naviHref = htmlentities($_SERVER['PHP_SELF']);
    // }

    public function show() {
        $year = null;
        $month = null;

        if(null==$year&&isset($_GET['year'])) {
            $year = $_GET['year'];
        } else if(null==$year) {
            $year = date("Y", time());
        }

        if(null == $month&&isset($_GET['month'])) {
            $month=$_GET['month'];
        }else if(null==$month) {
            $month = date("m",time());
        }

        $this->currentYear=$year;
         
        $this->currentMonth=$month;
         
        $this->daysInMonth=$this->_daysInMonth($month,$year);  
         //display return content here...

         $content = '<table>'.
                    '<caption>'.
                    $this->_createCaption().
                    '</caption>';
         $content.='<thead>'.
                    '<tr>'.
                    $this->_createLabels().
                    '</tr>'.
                    '</thead>';
        $content.='<tbody>';
        $weeksInMonth = $this->_weeksInMonth($month,$year);
        // Create weeks in a month
        for( $i=0; $i<$weeksInMonth; $i++ ){
                                     
            $content.='<tr>';
            //Create days in a week
            for($j=0;$j<7;$j++){
                $content.=$this->_showDay($i*7+$j);
            }
            $content.='</tr>';
        }
         return $content;
    }

    private function _showDay($cellNumber) {
        if ($this->currentDay == 0) {
            $firstDayOfTheWeek = date('N', strtotime($this->currentYear.'-'.$this->currentMonth.'-01'));
            
            if (intval($cellNumber) == intval($firstDayOfTheWeek)) {
                $this->currentDay = 1;
            }
        }

        if(($this->currentDay!=0) && ($this->currentDay<=$this->daysInMonth)) {
            $this->currentDate = date('Y-m-d', strtotime($this->currentYear.'-'.$this->currentMonth.'-'.($this->currentDay)));
            $cellContent = $this->currentDay;
            $this->currentDay++;
        }else{
            $this->currentDate = null;
            $cellContent=null;
        }

        $classMei = ($cellNumber%7==6?'saturdays':($cellNumber%7==0?'sundays':' '));
        // printf($cellNumber.' cellnumber >>> '.$cellContent.' ---->'.$classMei.'<br>');

        // return '<td id="td-'.$this->currentDate.'" class="'.($cellNumber%7==1?' start ':($cellNumber%7==0?' end ':' ')).
        //         ($cellContent==null?'mask':'').'">'.$cellContent.'</td>';

        return '<td id="td-'.$this->currentDate.'" class='.$classMei.'>'.$cellContent.'</td>';
    }

    private function _createCaption() {
        $nextMonth = $this->currentMonth==12?1:intval($this->currentMonth)+1;

        $nextYear = $this->currentMonth==12?intval($this->currentYear)+1:$this->currentYear;

        $preMonth = $this->currentMonth==1?12:intval($this->currentMonth)-1;

        $preYear = $this->currentMonth==1?intval($this->currentYear)-1:$this->currentYear;

        return 
        '<div class="caption">'.
                '<a class="prev-btn" href="'.$this->naviHref.'?month='.sprintf('%02d',$preMonth).'&year='.$preYear.'"><</a>'.
                    '<span class="year-month">'.date('Y - M',strtotime($this->currentYear.'-'.$this->currentMonth.'-1')).'</span>'.
                '<a class="next-btn" href="'.$this->naviHref.'?month='.sprintf("%02d", $nextMonth).'&year='.$nextYear.'">></a>'.
            '</div>';
    }

    private function _createLabels() {
        $content='';
        foreach($this->dayLabels as $index=>$label) {
            $classMei = ($index%7==6?'saturdays':($index%7==0?'sundays':' '));
            // $content.='<th class="'.($label==6?'end title':'start title').' title">'.$label.'</th>'; //気になる labelのよりindexかも。。
            $content.='<th class="'.$classMei.' title">'.$label.'</th>'; 
        }

        return $content;
    }

    private function _weeksInMonth($month=null,$year=null) {
        if(null==($year)) {
            $year = date("Y", time());
        }

        if(null==($month)) {
            $month = date("m", time());
        }
        
        $daysInMonths = $this->_daysInMonth($month,$year);
        $numOfWeeks=($daysInMonths%7==0?0:1) + intval($daysInMonths/7);
        $monthEndingDay = date('N', strtotime($year.'-'.$month.'-'.$daysInMonths)); //ISO-8601形式の曜日。1（月）～7（日）
        $monthStartDay = date('N', strtotime($year.'-'.$month.'-01'));

        if($monthEndingDay<$monthStartDay) {
            $numOfWeeks++;
        }

        return $numOfWeeks;
    }

    private function _daysInMonth($month=null,$year=null) {
        if(null==($year))
            $year=date("Y", time());

        if(null==($month))
            $month=date("m", time());

        return date('t', strtotime($year.'-'.$month.'-01'));
    }
}