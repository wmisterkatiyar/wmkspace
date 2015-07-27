/**
* Copyright (c) 2015
* Author : MisterKatiyar Bhalendra (MisterKatiyar.in)
* Company : Social Command (SocialCommand.in)
*/

(function(mk){

  mk.common_words = function( string1, string2 ) {

    var commonWords = 0;

    // assign smalled string for iteration operation
    if ( string1.length > string2.length ) {
      loopString = string2;
      searchString = string1;
    } else {
      loopString = string1;
      searchString = string2;
    }

    // loop thru all space sepawords
    loopString.split(" ").forEach(function(word){
      if (searchString.match(word))
        commonWords++;
    });

    return commonWords;
  }

})(window.mk = window.mk || {});
