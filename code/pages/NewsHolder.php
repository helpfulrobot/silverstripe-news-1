<?php
class NewsHolder extends Page {

  private static $singular_name = 'News Archiv';
  private static $description = 'Die News Übersichtsseite';
  private static $can_be_root = true;
  private static $allowed_children = ['NewsPage'];
  private static $default_child = 'NewsPage';
  // private static $icon = 'mysite/imgs/icons/PageIcon.png';
  public $hideSubnav = true;

  private static $db = [
    'NewsPerPage' => 'Int'
  ];

  private static $has_one = [];
  private static $belongs_to = [];
  private static $has_many = [];
  private static $many_many = [];
  private static $belongs_many_many = [];
  // private static $many_many_extraFields = [
    // 'RelationName' => ['FieldName' => 'FieldType']
  // ];

  // private static $searchable_fields = [];
  // private static $summary_fields = [];

  // private static $default_sort = 'Title';

  private static $defaults = [];

  public function populateDefaults() {
    parent::populateDefaults();
  }

  public function getLumberjackTitle() {
    return 'Newsbeiträge';
  }

  public function onBeforeWrite() {
    parent::onBeforeWrite();

    if(!$this->NewsPerPage) {
      $this->NewsPerPage = 5;
    }
  }

  public function onAfterWrite() {
    parent::onAfterWrite();
  }

  public function onBeforeDelete() {
    parent::onBeforeDelete();
  }

  public function onAfterDelete() {
    parent::onAfterDelete();
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
    $requiredFields = RequiredFields::create('Title');
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
    $fields->removeByName('Sections');
    $fields->removeByName('SectionTemplateID');
    $fields->removeByName('ContentToggle');
    $fields->removeByName('Content');

    $fields->insertAfter(NumericField::create('NewsPerPage', 'Einträge / Seite'), 'MenuTitle');

    return $fields;
  }

  // public function getSettingsFields() {
  //   $fields = parent::getSettingsFields();
  //   $fields->removeByName('ShowInSearch');
  //   return $fields;
  // }
}

class NewsHolder_Controller extends Page_Controller {

  private static $allowed_actions = [];

  public function init() {
    parent::init();
  }

  public function index(SS_HTTPRequest $request) {
    $data = [];

    $news = $this->Children()->sort('Created DESC');
    $pagination = PaginatedList::create(
        $news,
        $request
    )->setPageLength($this->NewsPerPage)
     ->setPaginationGetVar('s');

    $data['SortedNews'] = $pagination;
    
    if($news->first()) {
      $data['NewsCacheKey'] = max($pagination->getList()->column('LastEdited'));
    }

    if($request->isAjax()) {
      return $this->customise([
        'SortedNews' => $pagination,
        'NewsCacheKey' => $news->count() . '_' . max($pagination->getList()->column('LastEdited'))
      ])->renderWith('NewsArticles');
    }

    return $this->customise($data);
  }

  public function LatestNews($num = 3) {
    return $this->Children()->sort('Created DESC')->limit($num);
  }

  public function NewsCacheKey() {
    $count = $this->Children()->count();
    if($count) {
      $edited = max($this->Children()->column('LastEdited'));
    } else {
      $edited = null;
    }

    return $count . '_' . $edited;
  }
}