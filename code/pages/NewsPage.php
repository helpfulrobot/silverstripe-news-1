<?php
class NewsPage extends Page {

  private static $singular_name = 'Newsbeitrag';
  private static $description = 'Eine Newsseite';
  private static $can_be_root = false;
  private static $allowed_children = [];
  private static $default_child = '';
  // private static $icon = 'mysite/imgs/icons/PageIcon.png';

  private static $db = [];

  private static $has_one = [
    'Image' => 'Image'
  ];

  private static $belongs_to = [];
  private static $has_many = [];
  
  private static $many_many = [
    'Images' => 'Image',
    'Files' => 'File'
  ];

  private static $belongs_many_many = [];
  private static $many_many_extraFields = [
    'Images' => ['SortOrder' => 'Int'],
    'Files' => ['SortOrder' => 'Int']
  ];

  // private static $searchable_fields = [];
  // private static $summary_fields = [];

  private static $default_sort = 'Created DESC';

  private static $defaults = [
    'HideSidebar' => false
  ];

  public function populateDefaults() {
    parent::populateDefaults();
  }

  public function onBeforeWrite() {
    parent::onBeforeWrite();
  }

  public function onAfterWrite() {
    parent::onAfterWrite();

    $this->updateStaticCache();
  }

  public function onBeforeDelete() {
    parent::onBeforeDelete();
  }

  public function onAfterDelete() {
    parent::onAfterDelete();

    $this->updateStaticCache(true);
  }


  public function updateStaticCache($delete = false) {
    if(class_exists('URLArrayObject')) {
      $changedFields = $this->owner->getChangedFields(true, 2);
      unset($changedFields['WriteCount']);
      unset($changedFields['Version']);

      if(count($changedFields) || $delete) {
        $changedFields = $this->owner->getChangedFields(true, 2);
        $urlObject = new URLArrayObject();
        $urlObject->addUrls($this->dependentCachePages());
      }
    }
  }

  public function dependentCachePages() {
    // Seiten auf der gleichen Ebene sowie die Überseite werden automatisch aktualisiert
    // Dient dafür anderen Seiten zu aktualisieren auf deren Content dieser Seiten blockweise ausgegeben wird
    // Beispielsweise Top Leistungen, Neuest Nachrichten, ... auf der Startseite

    $urls = [];

    // Latest News Block
    $urls[SiteTree::get_by_link(RootURLController::get_homepage_link())->Link()] = 90;

    return $urls;
  }


  /*
  public function canCreate($member = null) {
    $can = Permission::check(['ADMIN', 'CMSACCESSLeftAndMain', 'SITETREEEDITALL']);
    return $can;
  }

  public function canEdit($member = null) {
    $can = Permission::check(['ADMIN', 'CMSACCESSLeftAndMain', 'SITETREEEDITALL']);
    return $can;
  }

  public function canDelete($member = null) {
    $can = Permission::check(['ADMIN', 'CMSACCESSLeftAndMain', 'SITETREEEDITALL']);
    return $can;
  }

  public function canView($member = null) {
    $can = Permission::check(['ADMIN', 'CMSACCESSLeftAndMain', 'SITETREEVIEWALL']);
    return $can;
  }
  */

  public function getCMSValidator() {
    // $requiredFields = parent::getCMSValidator();
    // $requiredFields->addRequiredField('FieldName');
    $requiredFields = RequiredFields::create('Title', 'Image');
    return $requiredFields;
  }

  /*
  public function validate() {
    $result = parent::validate();
    if($this->Value == 'Key') {
      $result->error('Custom Error Message');
    }
    return $result;
  }
  */

  public function getCMSFields() {
    $fields = parent::getCMSFields();
    $fields->insertAfter(
      UploadField::create('Image', 'Vorschaubild')
        ->setFolderName('news')
        ->setDisplayFolderName('news')
    , 'MenuTitle');

    $fields->insertAfter(Tab::create('Medien'), 'Main');
    $fields->addFieldsToTab('Root.Medien', [
      SortableUploadField::create('Images', 'Bilder')
        ->setFolderName('news')
        ->setDisplayFolderName('news'),
      SortableUploadField::create('Files', 'Dateien')
        ->setFolderName('news/files')
        ->setDisplayFolderName('news/files')
    ]);

    $fields->removeByName('Sektionen');

    return $fields;
  }

  public function getOGImage() {
    return $this->Image()->AbsoluteLink();
  }

  // public function getSettingsFields() {
  //   $fields = parent::getSettingsFields();
  //   $fields->removeByName('ShowInSearch');
  //   return $fields;
  // }
}

class NewsPage_Controller extends Page_Controller {

  private static $allowed_actions = [];

  public function init() {
    parent::init();
  }

  public function SortedImages() {
    return $this->Images()->sort('SortOrder');
  }

  public function SortedFiles() {
    return $this->Files()->sort('SortOrder');
  }
}