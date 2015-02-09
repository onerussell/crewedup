FCKConfig.FullPage = false ;

FCKConfig.Debug = false ;
FCKConfig.AllowQueryStringDebug = true ;

FCKConfig.ProcessHTMLEntities   = true ;
FCKConfig.IncludeLatinEntities  = true ;
FCKConfig.IncludeGreekEntities  = true ;

FCKConfig.FillEmptyBlocks   = true ;

FCKConfig.FormatSource      = true ;
FCKConfig.FormatOutput      = true ;
FCKConfig.FormatIndentator  = '    ' ;

FCKConfig.ForceStrongEm = true ;
FCKConfig.GeckoUseSPAN  = true ;
FCKConfig.StartupFocus  = false ;
FCKConfig.ForcePasteAsPlainText = false ;
FCKConfig.AutoDetectPasteFromWord = true ;  // IE only.
FCKConfig.ForceSimpleAmpersand  = false ;
FCKConfig.TabSpaces     = 0 ;
FCKConfig.ShowBorders   = true ;
FCKConfig.UseBROnCarriageReturn = false ;   // IE only.
FCKConfig.ToolbarStartExpanded  = true ;
FCKConfig.ToolbarCanCollapse    = true ;
FCKConfig.IEForceVScroll = true ;
FCKConfig.IgnoreEmptyParagraphValue = true ;
FCKConfig.PreserveSessionOnFileBrowser = false ;
FCKConfig.FloatingPanelsZIndex = 10000 ;


FCKConfig.AutoDetectLanguage    = false ;
FCKConfig.DefaultLanguage       = 'en' ;
FCKConfig.UseBROnCarriageReturn = true ;    // IE only.

FCKConfig.ToolbarSets["Basic1"] = [
    ['Source'],
    ['Cut','Copy','Paste','PasteText','PasteWord'],
    ['Undo','-','Find','Replace'],
    ['Bold','Italic','Underline','StrikeThrough'],
    ['OrderedList','UnorderedList'],
    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'],
    ['Link','Unlink'],
    ['Image'],
    ['Style'],
    ['TextColor']
] ;

FCKConfig.ToolbarSets["Mini"] = [
['Source','Bold','Italic','Image']
];


FCKConfig.StylesXmlPath = FCKConfig.CustomConfigurationsPath + '.xml' ;

var _FileBrowserLanguage    = 'php' ;   // asp | aspx | cfm | lasso | perl | php | py
var _QuickUploadLanguage    = 'php' ;   // asp | aspx | cfm | lasso | php

//File Browser

FCKConfig.QuickUploadLanguage='php';
FCKConfig.LinkBrowserURL = FCKConfig.BasePath + 'filemanager/browser/default/browser.html?Connector=connectors/php/connector.php';
FCKConfig.ImageBrowserURL = FCKConfig.BasePath + 'filemanager/browser/default/browser.html?Type=Image&Connector=connectors/php/connector.php';
FCKConfig.FlashBrowserURL = FCKConfig.BasePath + 'filemanager/browser/default/browser.html?Type=Flash&Connector=connectors/php/connector.php';

//Quick Uploader
FCKConfig.LinkUpload = true ;
FCKConfig.LinkUploadURL = FCKConfig.BasePath + 'filemanager/upload/php/upload.php' ;
FCKConfig.LinkUploadAllowedExtensions   = "" ;          // empty for all
FCKConfig.LinkUploadDeniedExtensions    = ".(php|php3|php5|phtml|asp|aspx|ascx|jsp|cfm|cfc|pl|bat|exe|dll|reg|cgi)$" ;  // empty for no one

FCKConfig.ImageUpload = true ;
FCKConfig.ImageUploadURL = FCKConfig.BasePath + 'filemanager/upload/php/upload.php?Type=Image' ;
FCKConfig.ImageUploadAllowedExtensions  = ".(jpg|gif|jpeg|png)$" ;      // empty for all
FCKConfig.ImageUploadDeniedExtensions   = "" ;                          // empty for no one

FCKConfig.FlashUpload = true ;
FCKConfig.FlashUploadURL = FCKConfig.BasePath + 'filemanager/upload/php/upload.php?Type=Flash' ;
FCKConfig.FlashUploadAllowedExtensions  = ".(swf|fla)$" ;       // empty for all
FCKConfig.FlashUploadDeniedExtensions   = "" ;                  // empty for no one

FCKConfig.FlashUpload = true ;
FCKConfig.FlashUploadURL = FCKConfig.BasePath + 'filemanager/upload/php/upload.php?Type=Pdf' ;
FCKConfig.FlashUploadAllowedExtensions  = ".(pdf)$" ;       // empty for all
FCKConfig.FlashUploadDeniedExtensions   = "" ;                  // empty for no one



