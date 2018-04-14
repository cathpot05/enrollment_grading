<?php
include "../dbcon.php";


$rows = '';
$query = "Select count(enrolled_student.student_ID) AS students, sy.schoolYear from SY INNER JOIN enrolled_student ON sy.ID = enrolled_student.sy_ID ORDER BY schoolYear ASC";
$result = mysql_query($sql);
$total_rows =  mysql_num_rows($result);
if($result) 
{
    $rows = mysql_fetch_array($result);
}


?>
//morris area chart

$(function () {

    Morris.Area({
        element: 'morris-area-chart',
        data: <?php echo json_encode($rows);?>,
        xkey: 'schoolYear',
        ykeys: ['students'],
        labels: ['Students'],
        pointSize: 3,
        hideHover: 'auto',
        resize: true
    });
    //morris bar chart
    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: '2006',
            a: 95
        }, {
            y: '2007',
            a: 75
        }, {
            y: '2008',
            a: 50
        }, {
            y: '2009',
            a: 75
        }, {
            y: '2010',
            a: 50
        }, {
            y: '2011',
            a: 2
        }, {
            y: '2012',
            a: 100
        }],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Series A'],
        hideHover: 'auto',
        resize: true
    });
	
	Morris.Line({
        element: 'morris-line-chart',
        data: [{
            y: '2006',
            a: 100,
            b: 90
        }, {
            y: '2007',
            a: 75,
            b: 65
        }, {
            y: '2008',
            a: 50,
            b: 40
        }, {
            y: '2009',
            a: 75,
            b: 65
        }, {
            y: '2010',
            a: 50,
            b: 40
        }, {
            y: '2011',
            a: 75,
            b: 65
        }, {
            y: '2012',
            a: 100,
            b: 90
        }],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B'],
        hideHover: 'auto',
        resize: true
    });

});
