$(document).ready(function() {
  if ($('.newsoverview .pagination').length) {
    $('main').on('click','.newsoverview .pagination a', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        paginate(url);
    });

    var paginate = function (url) {
      var param = '&ajax=1',
        ajaxUrl = (url.indexOf(param) === -1) ? 
                   url + '&ajax=1' : 
                   url,
        cleanUrl = url.replace(new RegExp(param+'$'),'');

      $.ajax({
        url: ajaxUrl,
        beforeSend: function(xhr) {
          $('.newsoverview .loader').fadeIn('fast');
        }
      }).done(function(response) {
        $('.newsoverview__ajax').html(response);
        $('html, body').animate({
          scrollTop: $('.newsoverview__ajax').offset().top
        });
        window.history.pushState(
          {url: cleanUrl},
          document.title,
          cleanUrl
        );
        $('.newsoverview .loader').fadeOut('fast');
      }).fail(function(xhr) {
        alert('Error: ' + xhr.responseText);
        $('.newsoverview .loader').fadeOut('fast');
      });
    };
  }
});