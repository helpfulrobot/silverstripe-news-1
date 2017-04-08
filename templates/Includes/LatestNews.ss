<% with $PageByID($NewsArchivePage.ID).Controller %>
  <% cached $NewsCacheKey %>
    <% if $LatestNews %>
      <section class="latestnews cf">
        <% if $Up.SectionTitle %>
          <div class="latestnews__title">
            <strong>$SectionTitle</strong>
          </div>
        <% end_if %>
        <% loop $LatestNews($Up.Num) %>
          <article class="latestnews__news cf">
            <a href="$Link" class="news__img">
              $Image.FocusFill(426,320)
            </a>
            <div class="news__info">
              <small>$Created.DateGER</small>
              <h3><a href="$Link" title="$Title">$MenuTitle</a></h3>
              <p>$Content.Summary(25)</p>
            </div>
          </article>
        <% end_loop %>
        <% if $Up.ArchiveLink && $Children.Count > $Up.Num %>
          <div class="latestnews__more">
            <a class="btn neutral" href="$Link" title="mehr News anzeigen">zum Newsarchiv</a>
          </div>
        <% end_if %>
      </section>
    <% end_if %>
  <% end_cached %>
<% end_with %>