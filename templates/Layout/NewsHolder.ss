<% cached $NewsCacheKey %>
  <section class="newsoverview">
    <% if $SortedNews %>
      <div class="loader">
        <div class="spinner">
          <div class="rect1"></div>
          <div class="rect2"></div>
          <div class="rect3"></div>
          <div class="rect4"></div>
          <div class="rect5"></div>
        </div>
      </div>
      <div class="newsoverview__ajax">
        <% include NewsArticles %>
      </div>
    <% else %>
      <p>Derzeit sind keine News vorhanden</p>
    <% end_if %>
  </section>
<% end_cached %>