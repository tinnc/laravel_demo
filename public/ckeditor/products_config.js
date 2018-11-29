/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'vi';
	// config.uiColor = '#AADC6E';
	config.skin = 'kama';
	config.enterMode = CKEDITOR.ENTER_BR;
	//config.toolbar = 'basic';
	config.uiColor = '#3188CD';
	config.basicEntities = false;
	config.entities = false;
	config.setReadOnly = true;
	config.toolbar =    [

    ['Source','-','Preview'],

    ['Cut','Copy','Paste','PasteText','PasteFromWord'],

    ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],

    ['Link','Unlink','Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe','Maximize'],
    
    '/',

    ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],

    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],

    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],

    ['Format','Font','FontSize'],

    ['TextColor','BGColor']

    ];
        

    config.filebrowserBrowseUrl = '/projectAdminLaravel/public/ckfinder/ckfinder.html';
   
    config.filebrowserImageBrowseUrl = '/projectAdminLaravel/public/ckfinder/ckfinder.html?type=Images';

    config.filebrowserFlashBrowseUrl = '/projectAdminLaravel/public/ckfinder/ckfinder.html?type=Flash';

    config.filebrowserUploadUrl = '/projectAdminLaravel/public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';

    config.filebrowserImageUploadUrl = '/projectAdminLaravel/public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';

    config.filebrowserFlashUploadUrl = '/projectAdminLaravel/public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';

};
