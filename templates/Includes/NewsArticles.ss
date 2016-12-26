<% loop $SortedNews %>
  <% include NewsArticle %>
<% end_loop %>
<% include Pagination Items=$SortedNews %>