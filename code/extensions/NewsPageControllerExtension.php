<?php
class NewsPageControllerExtension extends DataExtension {
  
  private static $allowed_actions = [
  ];

  public function onBeforeInit() {
    global $moduleNews;
    // - Requirements Management CSS Files
    $moduleCSSFiles = Session::get('SFModuleCSSFiles');

    if(!$moduleCSSFiles) {
      $moduleCSSFiles = [];
    }

    $requiredCSSFiles = array_flip([
      $moduleNews . '/css/news.css',
    ]);

    $requiredCSSFiles = array_merge($moduleCSSFiles, $requiredCSSFiles);

    Session::set('SFModuleCSSFiles', $requiredCSSFiles);

    // - Requirements Management JS Files
    $moduleJSFiles = Session::get('SFModuleJSFiles');

    if(!$moduleJSFiles) {
      $moduleJSFiles = [];
    }

    $requiredJSFiles = array_flip([
      $moduleNews . '/js/news.js',
    ]);

    $requiredJSFiles = array_merge($moduleJSFiles, $requiredJSFiles);

    Session::set('SFModuleJSFiles', $requiredJSFiles);
  }
}
