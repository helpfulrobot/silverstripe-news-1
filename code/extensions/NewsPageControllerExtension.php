<?php
class NewsPageControllerExtension extends DataExtension {

  public function onAfterInit() {
    global $moduleNews;
    Requirements::javascript($moduleNews . '/js/news.js');
    Requirements::css($moduleNews . '/css/news.css');
  }

  public function NewsArchivePage() {
    return NewsHolder::get()->first();
  }
}
