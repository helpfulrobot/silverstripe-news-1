<% cached $Items.Pages.Count, $Items.CurrentPage, $ID, $Hash %>
  <% if $Items.MoreThanOnePage %>
    <div class="pagination $ExtraClass">
      <% if $Items.NotFirstPage %>
        <a class="pagination__prev" href="$Items.PrevLink<% if $Hash %>\#$Hash<% end_if %>"><i class="fa fa-angle-left"></i></a>
      <% end_if %>
      <% loop $Items.Pages %>
        <% if $CurrentBool %>
          <span class="pagination__current">$PageNum</span>
        <% else %>
          <% if $Link %>
            <a class="pagination__link" href="$Link<% if $Up.Hash %>\#$Up.Hash<% end_if %>">$PageNum</a>
          <% else %>
            <span>...</span>
          <% end_if %>
        <% end_if %>
      <% end_loop %>
      <% if $Items.NotLastPage %>
        <a class="pagination__next" href="$Items.NextLink<% if $Hash %>\#$Hash<% end_if %>"><i class="fa fa-angle-right"></i></a>
      <% end_if %>
    </div>
  <% end_if %>
<% end_cached %>