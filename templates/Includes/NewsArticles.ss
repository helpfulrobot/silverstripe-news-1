<% loop $SortedNews %>
  <article class="newsoverview__news cf">
    <a href="$Link" class="news__img">
      $Image.FocusFill(425,309)
    </a>
    <div class="news__info">
      <small>$Created.DateGER</small>
      <h2><a href="$Link" title="$Title">$MenuTitle<i class="fa fa-long-arrow-right"></i></a></h2>
      <p>$Content.Summary(100)</p>
    </div>
  </article>
<% end_loop %>
<% include Pagination Items=$SortedNews %>