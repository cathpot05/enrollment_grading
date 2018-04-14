<?php
include "../../dbcon.php";
$rows = '';
$query = "SELECT COUNT(student_ID) as stud,sy_section_ID FROM enrolled_student";
$result = mysql_query($query);
if($result) 
{
    $rows = mysql_fetch_all($result);
}

?>


$(function() {
    //  morris Area chart on dashboard///
    Morris.Area({
        element: 'morris-area-chart',
        data: <?php echo json_encode($rows); ?>,
        xkey: 'sy_section_ID',
        ykeys: ['stud'],
        labels: ['Students'],
        pointSize: 5,
        hideHover: 'auto',
        resize: true
    });
    //  morris donut chart on dashboard///
    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Download Sales",
            value: 12
        }, {
            label: "In-Store Sales",
            value: 30
        }, {
            label: "Mail-Order Sales",
            value: 20
        }],
        resize: true
    });

    Morris.Bar({
        element: 'morris-bar-chart',
        data: <?php echo json_encode($rows);?>,
        xkey: 'sy_section_ID',
        ykeys: ['stud'],
        labels: ['Students'],
        hideHover: 'auto',
        resize: true
    });

});
