<!--<link type="text/css" href="<?php echo $web_path; ?>jqry/jquery-ui-1.8.custom.css" rel="Stylesheet" />	-->
<link type="text/css" href="<?php echo $web_path; ?>jqry/themes/base/jquery.ui.all.css" rel="stylesheet" />
	<script type="text/javascript" src="<?php echo $web_path; ?>jqry/jquery-1.4.2.js"></script>
	<script type="text/javascript" src="<?php echo $web_path; ?>jqry/ui/jquery.ui.core.js"></script>
	<script type="text/javascript" src="<?php echo $web_path; ?>jqry/ui/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="<?php echo $web_path; ?>jqry/ui/jquery.ui.datepicker.js"></script>
<!--	<link type="text/css" href="<?php echo $web_path; ?>demos.css" rel="stylesheet" />-->
	<script type="text/javascript">
	$(function() {
		$(".datepick").datepicker({
			showOn: 'button',
			buttonImage: '<?php echo $web_path; ?>images/calendar.gif',
			buttonImageOnly: true,
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd-mm-yy',
			yearRange: '2008:2030',
//			maxDate: '0d'
		});
	});
	
	
		function displayDatepicker(){
		$(".datepick").datepicker({
			showOn: 'button',
			buttonImage: '<?php echo $web_path; ?>images/calendar.gif',
			buttonImageOnly: true,
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd-mm-yy',
			yearRange: '2000:2030'
		});
	}



  $(document).ready(function () {
    
        $("#installation_date").datepicker({
            showOn: 'button',
			buttonImage: '<?php echo $web_path; ?>images/calendar.gif',
			buttonImageOnly: true,
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd-mm-yy',
			yearRange: '2008:2030',
			maxDate: '0d',
            onSelect: function (date) {
                var date2 = $('#installation_date').datepicker('getDate');
                date2.setDate(date2.getDate() + 0);
         //       $('#dt2').datepicker('setDate', date2);
                //sets minDate to dt1 date + 1
                $('#date_of_failure').datepicker('option', 'minDate', date2);
				$('#date_of_failure').val('');
            }
			
        });
        $('#date_of_failure').datepicker({
            showOn: 'button',
			buttonImage: '<?php echo $web_path; ?>images/calendar.gif',
			buttonImageOnly: true,
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd-mm-yy',
			yearRange: '2008:2030',
			maxDate: '0d'/*,
            onClose: function () {
                var dt1 = $('#installation_date').datepicker('getDate');
                console.log(dt1);
                var dt2 = $('#date_of_failure').datepicker('getDate');
                if (dt2 <= dt1) {
                    var minDate = $('#date_of_failure').datepicker('option', 'minDate');
                    $('#date_of_failure').datepicker('setDate', minDate);
                }
            }*/,
            onSelect: function (date) {
                var date2 = $('#date_of_failure').datepicker('getDate');
                date2.setDate(date2.getDate() + 0);
         //       $('#dt2').datepicker('setDate', date2);
                //sets minDate to dt1 date + 1
                $('#veh_on_road').datepicker('option', 'minDate', date2);
				$('#veh_on_road').val('');
            }
        });
		
		
		 $("#veh_on_road").datepicker({
            showOn: 'button',
			buttonImage: '<?php echo $web_path; ?>images/calendar.gif',
			buttonImageOnly: true,
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd-mm-yy',
			yearRange: '2008:2030',
			maxDate: '0d'/*,
			onClose: function () {
                var dt1 = $('#installation_date').datepicker('getDate');
                console.log(dt1);
                var dt2 = $('#date_of_failure').datepicker('getDate');
                if (dt2 <= dt1) {
                    var minDate = $('#date_of_failure').datepicker('option', 'minDate');
                    $('#date_of_failure').datepicker('setDate', minDate);
                }
            }*/
			
        });
		
		
		
    });
	
	
	
	
function showDT(){
	$( "#date_of_failure" ).datepicker( "option", "minDate", null);
	$('#date_of_failure').datepicker({
            showOn: 'button',
			buttonImage: '<?php echo $web_path; ?>images/calendar.gif',
			buttonImageOnly: true,
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd-mm-yy',
			yearRange: '2008:2030',
			maxDate: '0d'
        });

}

</script>