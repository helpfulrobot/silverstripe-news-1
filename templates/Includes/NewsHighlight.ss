<% with $PageByID($NewsPageID).Controller %>
  <% if $Highlight %>
    <% with $Highlight %>
      <% include NewsArticle %>
    <% end_with %>
  <% end_if %>
<% end_with %>
