<% with $PageByID($NewsArchivePage.ID).Controller %>
  <% if $Highlights %>
    <section class="news-highlights">
      <% loop $Highlights(2) %>
        <% include NewsArticle %>
      <% end_loop %>
    </section>
  <% end_if %>
<% end_with %>
