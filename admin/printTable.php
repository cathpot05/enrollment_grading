<?php
include "../dbcon.php";

$sql = $_GET['sql'];
$header = $_GET['header'];
$result = mysqli_query($con,$sql);

if(mysqli_num_rows($result)>0)
{
?>
	<center>
						<br>
							<h3><strong>PRUDECIA D. FULE MEMORIAL NATIONAL HIGH SCHOOL</strong></h3>
								<i>Brgy. San Nicolas, San Pablo City</i>
								<br>
								<br>	 
								</center>
								<strong>
								<h3><?php echo $header; ?></h3>
								</strong>
	<table width=100% rules=all border=1>
        <thead>
            <tr>
				<?php
				$colArr = array();
				while($col = mysqli_fetch_field($result))
				{
					?>
						<th><?php echo str_replace('_',' ',$col->name); ?></th>
					<?php
					$colArr[] = $col->name;
				}
				
				?>
            </tr>
        </thead>
        <tbody>
		<?php
		$colCount = mysqli_num_fields($result);
		while($row = mysqli_fetch_array($result))
		{
			?>
			<tr>
			<?php
			for($i=0; $i<$colCount; $i++)
			{
			?>
			<td><?php echo $row[$colArr[$i]]; ?></td>
			<?php
			}
			?>
			</tr>
			<?php
		}
		?>
		</tbody>
	</table>
	<br><br><br>
	<center><i>****************************** Nothing Follows ******************************</i></center>
	<?php
}
?>