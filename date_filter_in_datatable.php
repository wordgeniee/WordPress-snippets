 <?php
 // Add following code in php file above datatable 

$start_date = isset($_SESSION['start_date']) ? $_SESSION['start_date'] : ''; //store details in session 
$end_date = isset($_SESSION['end_date']) ? $_SESSION['end_date'] : '';
?>
 <div>
	<input type="text" id="fini" name="min" placeholder="Start date" value='<?php echo $start_date; ?>'> to 	       
			            
	<input type="text" id="ffin" name="max" placeholder="End date" value='<?php echo $end_date; ?>'>
</div>
 
<!-- Add following code in js file -->
<!-- Add date filter in datatable column -->
 
 jQuery.fn.dataTableExt.afnFiltering.push(
			function( oSettings, aData, iDataIndex ) {
				var start =document.getElementById('start_date').value;
				var end = document.getElementById('end_date').value;
				var iStartDateCol = 3;
				var iEndDateCol = 3;

				start=start.substring(6,10) + start.substring(3,5)+ start.substring(0,2);
				
				end=end.substring(6,10) + end.substring(3,5)+ end.substring(0,2);
				
				var datstart=aData[iStartDateCol].substring(6,10) + aData[iStartDateCol].substring(3,5)+ aData[iStartDateCol].substring(0,2);
				var datend=aData[iEndDateCol].substring(6,10) + aData[iEndDateCol].substring(3,5)+ aData[iEndDateCol].substring(0,2);
				
				if ( start === "" && end === "" )
				{
					return true;
				}
				else if ( start <= datstart && end === "")
				{
					return true;
				}
				else if ( end >= datend && end === "")
				{
					return true;
				}
				else if (start <= datstart && end >= datend)
				{
					return true;
				}
				return false;
			}
		);