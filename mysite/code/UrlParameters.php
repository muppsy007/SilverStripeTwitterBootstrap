<?php

class UrlParameters extends DataObject {
	
	static $db = array(
		'ParameterName' => 'Varchar(50)',
		'DataType' => "Enum('Integer, String, Boolean, Date, DateTime, Number')",
		'Description' => 'Text'
	);
	
	public function getCMSFields_forPopup() {
		$fields = new FieldList();

		$fields->push( new TextField( 'ParameterName', 'Name' ) );
		$fields->push( new DropdownField('DataType') );
		$fields->push( new TextareaField( 'Description' ) );

		return $fields;
	}
}
