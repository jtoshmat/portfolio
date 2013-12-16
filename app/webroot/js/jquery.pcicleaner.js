/****************

Jquery Plugin for American Family Insurance to clean SS#, CC# from user input fields. To use:

1) Inlcude the minified file
2) Call $('ELEMENT').PCICleaner(); in the Document Ready
3) ???????
4) Profit!

Authored: Greg Tarnoff, Digital Marketing
Version 0.0.1
Last Updated Date: 4/8/2013

****************/
(function( $ ){
  var patternCC = /\s{0,}(\d{4}[ \_\-\.\/\\\*\=\+]{0,}){4}/;
  var patternAmex = /\s{0,}\d{4}[ \-\.\_\/\\\*\=\+]{0,}\d{6}[ \-\_\.\/\\\*\=\+]{0,}\d{5}[ \-\.\/\\\_\*\=\+]{0,}/;
  var patternSS = /\s{0,}\d{3}[ \-\.\_\/\\\*\=\+]{0,}\d{2}[ \-\.\_\/\\\*\=\+]{0,}\d{4}[ \-\.\/\\\_\*\=\+]{0,}/;
  var methods = {
    init : function(){
        this.keyup(function(){
          var text = $(this).val();
          if(methods.testSS(text)){ 
            return $(this).each(function(){
              methods.replaceIt('SS',text, this);
            });
          };
          if(methods.testCC(text)){
            return $(this).each(function(){
              methods.replaceIt('CC', text, this);
            });
          };
          if(methods.testAmex(text)){
           return $(this).each(function(){
            methods.replaceIt('Amex',text,this);
          });
          };
        });
    },
    testCC : function(string){
      if(string.match(patternCC)){
        return true;
      } return false;
    },
    testSS : function(string){
      if(string.match(patternSS)){
        return true;
      } return false;
    },
    testAmex : function(string){
      if(string.match(patternAmex)){
        return true;
      } return false;
    },
    replaceIt : function(type, text, that){
        var replaceText ="";
        switch (type){
          case 'SS':
            replaceText = text.replace(patternSS, ' XXX XX XXXX');
          break;
          case 'CC':
             replaceText = text.replace(patternCC, ' XXXX XXXX XXXX XXXX');
          break;
          default:
          replaceText = text.replace(patternAmex, ' XXXX XXXXXX XXXXX');
        };
        $(that).val(replaceText);
        $('body').prepend(methods.warning);
        $('#SSwarning').fadeIn().delay(1000);//.fadeOut('slow');
    },
    left :  ((window.innerWidth || document.documentElement.clientWidth)/2)-235,
    warning : function(){
      var box = "<div id='SSwarning' style='background:#ffffcc; padding:.5em; width:400px; margin: 0 auto; position:absolute; border:1px solid #333; color:#333; top: 20px; z-index:20000;left:"+ methods.left+"px;'>";
      box += "<p>It looks like you are entering a credit card or social security number. For your safety we have removed it. Please do not send these in email or using this form.</p>";
      box += "</div>";
      return box;
    }
  };

  $.fn.PCICleaner = function(method){
    if ( methods[method] ) {
      return methods[method].apply( this, Array.prototype.slice.call( arguments, 1 ));
    } else if ( typeof method === 'object' || ! method ) {
      return methods.init.apply( this, arguments );
    } else {
      $.error( 'Method ' +  method + ' does not exist on jQuery.PCICleaner' );
    };    
  };
})( jQuery );