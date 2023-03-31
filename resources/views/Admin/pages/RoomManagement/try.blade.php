 <!-- jQuery library -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
<!-- jQuery datepicker library -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>

<label for="date">Date:</label>
<input type="text" id="date" name="date">

<input type="text" id="datepicker" name="datepicker">
<script>
//     var disabledDates = [
//   "2023-03-24",
//   "2023-03-27",
//   "2023-04-01"
// ];

var start_disabledDates = [];
var end_disabledDates = [];
function getDisabledDates() {
  // Send an AJAX request to your Laravel route to get the disabled dates
  $.ajax({
    url: '{{ route("get.date", "1") }}',
    type: 'GET',
    dataType: 'json',
    success: function(response) {
      start_disabledDates = response.start;
      end_disabledDates = response.end;
      // Disable the dates returned by the server
      // $.each(response.start, function(index, value) {
      //   $('#datepicker')
      //     .find('option[value="' + value + '"]')
      //     .attr('disabled', true);
      // });
    }
  });
}

$(function(){
  var start = moment(start_disabledDates);
  var end = moment(end_disabledDates);
  $("#datepicker").datepicker({
    format: 'yyyy-mm-dd',
    beforeShowDay:function(date){

      // Format the date as "yyyy-mm-dd"
      var year = date.getFullYear();
      var month = (date.getMonth() + 1).toString().padStart(2, "0");
      var day = date.getDate().toString().padStart(2, "0");
      var formattedDate = year + "-" + month + "-" + day;
    
      var d = moment(date);

      //if ($.inArray(formattedDate, disabledDates) != -1) {
      if (d.isSameOrAfter(start) && d.isSameOrBefore(end)) {
        return [false, "disabled-date", "This date is disabled"];
      } else {
        return [true, ""];
      }

    }
  });
});

window.onload = function() {
  // Call the setAppointmentDates function on page load
  getDisabledDates();
};







</script>