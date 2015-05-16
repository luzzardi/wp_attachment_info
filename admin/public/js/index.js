jQuery(document).ready(function($) {
  $(document).on('change', '#attachments', function() {
    var $this = $(this),
        value = $this.val(),
        data = $this.data();
      $.ajax({
        url: '/wp-admin/admin-post.php',
        type: 'POST',
        data: {
          action: data.action,
          id: value
        },
        success: function(data) {
          $('#result').html(data);
        }
      });
  });
});
