//This is for the contact form.

$(function() {

  // Get the form.
  var form = $('#ajax-contact');

  // Get the messages div.
  var formMessages = $('#form-messages');

  // Set up an event listener for the contact form.
  $(form).submit(function(e) {
    // Stop the browser from submitting the form.
    e.preventDefault();

    // Serialize the form data.
    var formData = $(form).serialize();

    // Submit the form using AJAX.
    $.ajax({
      type: 'POST',
      url: $(form).attr('action'),
      data: formData
    })
    .done(function(response) {
      // Make sure that the formMessages div has the 'success' class.
      $(formMessages).removeClass('alert');
      $(formMessages).addClass('success');

      // Set the message text.
      $(formMessages).text(response);

      // Clear the form.
      $('#name').val('');
      $('#email').val('');
      $('#message').val('');
    })
    .fail(function(data) {
      // Make sure that the formMessages div has the 'error' class.
      $(formMessages).removeClass('success');
      $(formMessages).addClass('alert');

      // Set the message text.
      if (data.responseText !== '') {
        $(formMessages).text(data.responseText);
      } else {
        $(formMessages).text('Houve um erro no envio. Verifique que introduziu correctamente os seus dados ou tente novamente mais tarde.');
      }
    });

  });

});
