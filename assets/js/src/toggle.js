$(document).ready(function () {

  function customToggle(url, formClass, statusOn, statusOff) {
    $(document).on("change", formClass, function (e) {
      e.preventDefault();

      var id = $(this).attr('id');
      var label = $("[for='toggle-" + id + "']");

      $.ajax({
        url: url + id,
        data: $(this).serialize(),
        type: 'post',
        dataType: 'json',
        success: function (data) {
          if (data.option === 1 || data.option === statusOn) {
            label.text(statusOn.capitalize());
          }
          else {
            label.text(statusOff.capitalize());
          }
        }
      })
    });
  }

  //OPTION TOGGLE
  customToggle('/admin/option_toggle/', '.option-toggle', 'on', 'off');

  //TILT TOGGLE
  customToggle('/user/tilt_toggle/', '.tilt-toggle', 'verified', 'tilted');

  //STATUS TOGGLE
  customToggle('/admin/status_toggle/', '.status-toggle', 'public', 'not public');
});