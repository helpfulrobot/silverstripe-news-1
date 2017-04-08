<% cached $LastEdited %>
  <article class="newsoverview__news cf">
    <a href="$Link" class="news__img">
      $Image.FocusFill(425,309)
    </a>
    <div class="news__info">
      <small>$Created.DateGER</small>
      <h2><a href="$Link" title="$Title">$MenuTitle</a></h2>
      <p>$Content.Summary(100)</p>
      <% if not $HideReadOn %>
        <a href="$Link" title="$Title"><%t NEWS.ReadOn "read on" %> <i class="fa fa-angle-double-right"></i></a>
      <% end_if %>
    </div>
  </article>
<% end_cached %>