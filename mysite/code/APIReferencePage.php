<?php

/**
 * Page type for controlling the fields and serverside functionality of individual reference pages for the API
 */

class APIReferencePage extends Page {
	
	public static $db = array(
		'EndpointURL' => 'Varchar(50)',
		'SupportedFormats' => 'Varchar(50)',
		'RateLimited' => 'Varchar(10)'
	);

	public static $has_one = array(
	);
	
	public static $has_many = array(
		'UrlParameters' => 'UrlParameters',
	);
	
	// Get the fields for the CMS
	public function getCMSFields() {
		$fields = parent::getCMSFields();
		
		$fields->removeFieldFromTab('Root.Main', 'Content');
		$fields->addFieldToTab('Root.MethodOverview', new TextField('EndpointURL'));
		$fields->addFieldToTab('Root.MethodOverview', new TextField('SupportedFormats'));
		$fields->addFieldToTab('Root.MethodOverview', new TextField('RateLimited'));
		
		// URL Parameters Grid
		$urlGridColumns = new GridFieldDataColumns(); 
		$urlGridColumns->setDisplayFields(array( 
			'ParameterName' => 'Name', 
			'DataType' => 'Data Type',
			'Description' => 'Description'
		));
		$urlGridFieldConfig = GridFieldConfig::create()->addComponents( 
			new GridFieldToolbarHeader(), 
			new GridFieldAddNewButton('toolbar-header-right'), 
			new GridFieldSortableHeader(), 
			//new GridFieldDataColumns(), 
			new GridFieldPaginator(10), 
			new GridFieldEditButton(), 
			new GridFieldDeleteAction(), 
			new GridFieldDetailForm(),
			$urlGridColumns 
		);
		$itemsInGrid = DataList::create('UrlParameters'); // get a list of object you want to show
		$gridField = new GridField("UrlParameters", "Url Parmeters", $itemsInGrid, $urlGridFieldConfig);	
		
		// POST Parameters Grid
		

		$fields->addFieldToTab("Root.Parameters", $gridField); // add the grid field to a tab in the CMS
		
		return $fields;
	}
	
}

class APIReferencePage_Controller extends Page_Controller {
	
}