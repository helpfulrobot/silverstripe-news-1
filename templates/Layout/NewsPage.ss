<% cached $LastEdited, $SectionsCacheKey %>
  <% if $Content || $Form %>
    <div class="page__text">
      $Form
      $Content
    </div>
    <div class="page__images cf">
      <a href="$Image.Fit(1280,1024).Url" class="lightbox" rel="news">
        $Image.FocusFill(279,210)
      </a>
      <% loop $SortedImages %>
        <a href="$Fit(1280,1024).Url" class="lightbox" rel="news">
          $FocusFill(279,210)
        </a>
      <% end_loop %>
    </div>
    <% if $SortedFiles %>
      <ul class="page__files cf">
        <% loop $SortedFiles %>
          <li>$FAFileIcon <span><a href="$Link">$Title ($Extension, $Size)</a></span></li> 
        <% end_loop %>
      </ul>
    <% end_if %>
  <% end_if %>
  <% if $Sections %>
    <% include Sections %>
  <% end_if %>
<% end_cached %>