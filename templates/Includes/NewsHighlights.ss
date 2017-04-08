<% with $PageByID($NewsArchivePage.ID).Controller %>
  <% if $Highlights %>
    <% loop $Highlights(2) %>
      <% include NewsArticle %>
    <% end_loop %>
  <% end_if %>
<% end_with %>
